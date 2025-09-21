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

    public function UsersData()
    {
        $this->call->model('UsersModel');

        $page = 1;
        if(isset($_GET['page']) && ! empty($_GET['page'])) {
            $page = $this->io->get('page');
        }

        $q = '';
        if(isset($_GET['q']) && ! empty($_GET['q'])) {
            $q = trim($this->io->get('q'));
        }

        $records_per_page = 10;

        $user = $this->UsersModel->page($q, $records_per_page, $page);
        $data['user'] = $user['records'];
        $total_rows = $user['total_rows'];

        $this->pagination->set_options([
            'first_link'     => '⏮ First',
            'last_link'      => 'Last ⏭',
            'next_link'      => 'Next →',
            'prev_link'      => '← Prev',
            'page_delimiter' => '&page='
        ]);
        $this->pagination->set_theme('bootstrap');
        $this->pagination->initialize($total_rows, $records_per_page, $page, 'users?q='.$q);
        $data['page'] = $this->pagination->paginate();

       $data['users'] = $this->UsersModel->all();
        $this->call->view('users/UsersData', $data);
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