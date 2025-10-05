<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->library('auth');
        $this->call->library('session');
    }

    // Show login form
    public function login()
    {
        $error = null;

        if ($this->form_validation->submitted()) {
            $username = $this->io->post('username');
            $password = $this->io->post('password');

            if ($this->auth->login($username, $password)) {
                redirect('dashboard'); // redirect after login
            } else {
                $error = "Incorrect username or password.";
            }
        }

        $this->call->view('auth/login', ['error' => $error]);
    }

    // Show register form
    public function register()
    {
        $success = null;
        $error = null;

        if ($this->form_validation->submitted()) {
            $username = $this->io->post('username');
            $email = $this->io->post('email');
            $password = $this->io->post('password');

            if ($this->auth->register($username, $email, $password)) {
                $success = "Registration successful! You can now log in.";
            } else {
                $error = "Registration failed. Try again.";
            }
        }

        $this->call->view('auth/register', ['success' => $success, 'error' => $error]);
    }

    public function logout()
    {
        $this->auth->logout();
        redirect('auth/login');
    }
}
