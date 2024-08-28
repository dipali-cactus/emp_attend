<?php 

use CodeIgniter\I18n\Time;
use CodeIgniter\Config\Services;

function is_logged_in()
{
    $session = Services::session();
    $uri = Services::uri();
    $request = Services::request();
    
    if (!$session->get('username')) {
        return redirect()->to('/auth');
    } else {
        $role_id = $session->get('role_id');
        $menu = $uri->getSegment(1);

        $db = \Config\Database::connect();
        $queryMenu = $db->table('user_menu')->where('menu', $menu)->get()->getRowArray();
        $menu_id = $queryMenu['id'] ?? null;

        $userAccess = $db->table('user_access')
                         ->where(['role_id' => $role_id, 'menu_id' => $menu_id])
                         ->get();

        if ($userAccess->getNumRows() < 1) {
            return redirect()->to('/auth/blocked');
        }
    }
}

function is_weekends()
{

    $today = (new Time('now', 'Asia/Manila'))->format('l');
    //$today = (new Time('now', 'Asia/Manila'))->getDayName();
    $weekends = ['Saturday', 'Sunday'];
    
    return in_array($today, $weekends);
}

function is_checked_in()
{
    $session = Services::session();
    $db = \Config\Database::connect();
    $username = $session->get('username');
    $today = (new Time('now', 'Asia/Manila'))->toDateString();

    $query = $db->table('attendance')
                ->select("FROM_UNIXTIME(`in_time`, '%Y-%m-%d') AS `date`")
                ->where('username', $username)
                ->where("FROM_UNIXTIME(`in_time`, '%Y-%m-%d')", $today)
                ->get();
                
    return $query->getNumRows() > 0;
}

function is_checked_out()
{
    $session = Services::session();
    $db = \Config\Database::connect();
    $username = $session->get('username');
    $today = (new Time('now', 'Asia/Manila'))->toDateString();

    $query = $db->table('attendance')
                ->where('out_time !=', 0)
                ->where("out_status IS NOT NULL OR out_status != ''")
                ->where('username', $username)
                ->where("FROM_UNIXTIME(`in_time`, '%Y-%m-%d')", $today)
                ->get();
                
    return $query->getNumRows() > 0;
}
