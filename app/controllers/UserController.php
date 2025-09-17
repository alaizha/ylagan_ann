<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: UserController
 * 
 * Automatically generated via CLI.
 */
class UserController extends Controller {
    public function __construct()
    {
        parent::__construct();
    }

    
    public function UsersData() {
    $userModel = new UsersModel();

    $limit = 5;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $limit;
    $search = $_GET['search'] ?? '';

    $data['users'] = $this->UsersModel->getUsers($limit, $offset, $search);
    $data['total_pages'] = ceil($this->UsersModel->countUsers($search) / $limit);
    $data['page'] = $page;

}


   public function create()
{
    if ($this->io->method() === 'post') {
        
        $username = $this->io->post('username');
        $email = $this->io->post('email');

        $data = [
            'username' => $username,
            'email'    => $email
        ];

        $userModel = new UsersModel();

        if ($userModel->insert($data)) {
            return redirect('users/UsersData'); 
        } else {
            echo 'Error inserting data';
        }
    } else {
        return $this->call->view('users/create');
    }
}


  public function update($id)
{
    $userModel = new UsersModel();

    if ($this->io->method() === 'post') {
        $username = $this->io->post('username');
        $email    = $this->io->post('email');

        $data = [
            'username' => $username,
            'email'    => $email
        ];

        if ($userModel->update($id, $data)) {
            return redirect('users/UsersData');
        } else {
            echo "Error updating user.";
        }

    } else {
        $data['user'] = $userModel->find($id);

        if (!$data['user']) {
            echo "User not found!";
            return;
        }

        return $this->call->view('users/update', $data);
    }
}



public function delete($id)
{
    $userModel = new UsersModel();

    if ($userModel->delete($id)) {
        return redirect('users/UsersData');
    } else {
        echo "Error deleting user.";
    }
}
}