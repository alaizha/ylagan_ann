<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Auth extends Controller {
    public function __construct() {
        parent::__construct();
        $this->call->library('auth'); // load your Auth library
    }

    public function login() {
        // show login view
        $this->call->view('auth/login');
    }

    public function process_login() {
        $username = $this->io->post('username');
        $password = $this->io->post('password');

        if ($this->auth->login($username, $password)) {
            redirect('dashboard'); // adjust this path to your dashboard
        } else {
            set_flash_alert('Invalid username or password.');
            redirect('auth/login');
        }
    }

    public function logout() {
        $this->auth->logout();
        redirect('auth/login');
    }
}
