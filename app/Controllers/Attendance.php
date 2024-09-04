<?php

namespace App\Controllers;

use App\Models\PublicModel;
use App\Models\AdminModel;
use CodeIgniter\Controller;

class Attendance extends BaseController
{
    protected $publicModel;
    protected $adminModel;
    protected $session;
    protected $formValidation;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->publicModel = new PublicModel();
        $this->adminModel = new AdminModel();
        $this->session = session();
        $this->formValidation = \Config\Services::validation();

        is_weekends();
        is_logged_in();
        is_checked_in();
        is_checked_out();
    }

    public function index()
    {
        // Attendance Form
        $data['title'] = 'Attendance Form';
        $session = session();
        
        $data['account'] = $this->publicModel->getAccount($session->get('username'));
        $locationModel = new \App\Models\LocationModel();
        $data['location'] = $locationModel->findAll();


        $shiftModel = new \App\Models\ShiftModel();
        $shift = $data['account']['shift'];
        $resultShift = (new \App\Models\ShiftModel())->find($shift);

        if ($resultShift) {
            $data['startTime'] = $resultShift['start'];
            $data['endTime'] = $resultShift['end'];
        }


        // If Weekends
        if (is_weekends()) {
            $data['weekends'] = true;
            return view('templates/header', $data)
                . view('templates/sidebar')
                . view('templates/topbar')
                . view('attendance/index', $data)
                . view('templates/footer');
        } else {
            $data['in'] = true;
            $data['weekends'] = false;
           

            // If haven't Time In Today
            if (!is_checked_in()) {
                //echo "<br> Not checked ind";exit;                
                $data['in'] = false;

                $validation = \Config\Services::validation();
                $validation->setRules([
                    'work_shift' => 'required|trim',
                    'location'   => 'required|trim'
                ]);

                if (!$validation->withRequest($this->request)->run()) {
                    $shift = $data['account']['shift'];
                    
                    $resultShift = $shiftModel->find($shift);
                    $data['startTime'] = $resultShift['start'];
                    $data['endTime'] = $resultShift['end'];

                    return view('templates/header', $data)
                        . view('templates/sidebar')
                        . view('templates/topbar')
                        . view('attendance/index', $data)
                        . view('templates/footer');
                } else {
                    $shift = $data['account']['shift'];
                    $resultShift = $shiftModel->find($shift);
                    $startTime = $resultShift['start'];

                    $username = $session->get('username');
                    $employee_id = $data['account']['id'];
                    $department_id = $data['account']['department_id'];
                    $shift_id = $this->request->getPost('work_shift');
                    $location_id = $this->request->getPost('location');
                    $iTime = time();
                    $notes = $this->request->getPost('notes');
                    $lack = 'None';

                    // Time In Time
                    $inStatus = (date('H:i:s', $iTime) <= $startTime) ? 'On Time' : 'Late';

                    // Check Notes
                    if (!$notes) {
                        $lack = 'Notes';
                    }

                    // Config Upload
                    $file = $this->request->getFile('image');
                    if ($file && $file->isValid()) {
                        $image = $file->getRandomName();
                        $file->move(FCPATH . 'images/attendance/', $image);

                        $value = [
                            'username'      => $username,
                            'employee_id'   => $employee_id,
                            'department_id' => $department_id,
                            'shift_id'      => $shift_id,
                            'location_id'   => $location_id,
                            'in_time'       => $iTime,
                            'notes'         => $notes,
                            'image'         => $image,
                            'lack_of'       => $lack,
                            'in_status'     => $inStatus
                        ];
                    } else {
                        if ($lack != '') {
                            $lack .= ',image';
                        } else {
                            $lack = 'image';
                        }

                        $value = [
                            'username'      => $username,
                            'employee_id'   => $employee_id,
                            'department_id' => $department_id,
                            'shift_id'      => $shift_id,
                            'location_id'   => $location_id,
                            'in_time'       => $iTime,
                            'notes'         => $notes,
                            'lack_of'       => $lack,
                            'in_status'     => $inStatus
                        ];
                    }

                    $this->_checkIn($value);
                    return redirect()->to('/attendance');
                }
            }
            // If Checked In
            else {               

                $data['disable'] = is_checked_out();
                return view('templates/header', $data)
                    . view('templates/sidebar')
                    . view('templates/topbar')
                    . view('attendance/index', $data)
                    . view('templates/footer');
            }
        }
    }

    private function _checkIn($value)
    {
        $attendanceModel = new \App\Models\AttendanceModel();
        $attendanceModel->insert($value);

        if ($attendanceModel->affectedRows() > 0) {
            session()->setFlashdata('message', '<div class="alert alert-success" role="alert">Stamped attendance for today</div>');
        } else {
            session()->setFlashdata('message', '<div class="alert alert-danger" role="alert">Failed to stamp your attendance!</div>');
        }

        return redirect()->to('/attendance');
    }

    public function checkOut()
    {
        $session = session();
        $username = $session->get('username');
        $today = date('Y-m-d', time());

        $attendanceModel = new \App\Models\AttendanceModel();
        $querySelect = $attendanceModel->select('attendance.username, attendance.employee_id, attendance.shift_id, attendance.in_time, shift.start, shift.end')
            ->join('shift', 'attendance.shift_id = shift.id')
            ->where('attendance.username', $username)
            ->where('FROM_UNIXTIME(attendance.in_time, "%Y-%m-%d")', $today)
            ->orderBy('in_time', 'DESC')
            ->first();        

        $oTime = time();
        $outStatus = (date('H:i:s', $oTime) >= $querySelect['end']) ? 'Over Time' : 'Early';

        $value = [
            'out_time'   => $oTime,
            'out_status' => $outStatus
        ];

        $result = $attendanceModel->update($querySelect['employee_id'], $value);
        echo var_dump($value);
        echo "<br>";
        echo var_dump($result); exit;
        return redirect()->to('/attendance');
    }
    public function history()
    {
        $data['title'] = 'Attendance History';
        $session = session();
        
        $data['account'] = $this->publicModel->getAccount($session->get('username'));
        $data['e_id'] = $data['account']['id'];
        
        $data['data'] = $this->attendance_details_data($data['e_id']);

        return view('templates/table_header', $data)
            . view('templates/sidebar')
            . view('templates/topbar')
            . view('attendance/history', $data)
            . view('templates/table_footer');
    }
    private function attendance_details_data($e_id)
    {
        $start = $this->request->getGet('start');
        $end = $this->request->getGet('end');
        
        $data['attendance'] = $this->publicModel->getEmpAttendance($e_id, $start, $end);

        $data['start'] = $start;
        $data['end'] = $end;

        return $data;
    }
}
