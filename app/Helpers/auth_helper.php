<?php

use CodeIgniter\HTTP\RedirectResponse;

/**
 * Check if the admin user is logged in.
 * If not, redirect to the login page.
 *
 * @return RedirectResponse|null
 */

function isUserLoggedIn()
{
    $session = session();

    if (!$session->has('username') || !$session->get('username') && (!$session->has('role_id') || $session->get('username') == 2)) {
        return redirect()->to('/login')->send();
    }
    return null;
}

function isAdminloggedin(){
    //role_id == 1 for  admin
    $session = session();

    if ($session->has('role_id') && $session->get('role_id') !== 1) {    
        return redirect()->to('/login')->send();
    }

    return null;
}
