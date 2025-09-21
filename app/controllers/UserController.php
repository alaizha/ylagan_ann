<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: UserController
 * Handles CRUD operations and pagination for users.
 */
class UserController extends Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->call->model('UsersModel');       // ✅ load model once
        $this->call->library('Pagination');     // ✅ load pagination once
    }

    /**
     * Display paginated users list with search
     */
   public function UsersData()
{
    $this->call->model('UsersModel');
    $this->call->library('Pagination'); // make sure pagination is loaded

    $page = 1;
    if ($this->io->get('page')) {
        $page = (int) $this->io->get('page');
    }

    $q = '';
    if ($this->io->get('q')) {
        $q = trim($this->io->get('q'));
    }

    $records_per_page = 10;

    // fetch paginated records
    $user = $this->UsersModel->page($q, $records_per_page, $page);
    $data['user'] = $user['records'];
    $total_rows   = $user['total_rows'];

    // ✅ Use $this->call->pagination instead of $this->pagination
    $this->call->pagination->set_options([
        'first_link'     => '⏮ First',
        'last_link'      => 'Last ⏭',
        'next_link'      => 'Next →',
        'prev_link'      => '← Prev',
        'page_delimiter' => '&page='
    ]);
    $this->call->pagination->set_theme('bootstrap');
    $this->call->pagination->initialize($total_rows, $records_per_page, $page, 'users?q='.$q);

    // pass pagination HTML to view
    $data['page'] = $this->call->pagination->paginate();

    // also load all users if needed
    $data['users'] = $this->UsersModel->all();

    // render view
    $this->call->view('users/UsersData', $data);
}


    /**
     * Create a new user
     */
    public function create()
    {
        if ($this->io->method() === 'post') {
            $username = trim($this->io->post('username'));
            $email    = trim($this->io->post('email'));

            $data = [
                'username' => $username,
                'email'    => $email
            ];

            if ($this->UsersModel->insert($data)) {
                return redirect('users/UsersData'); 
            } else {
                echo '❌ Error inserting data';
            }
        } else {
            return $this->call->view('users/create');
        }
    }

    /**
     * Update an existing user
     */
    public function update($id)
    {
        if ($this->io->method() === 'post') {
            $username = trim($this->io->post('username'));
            $email    = trim($this->io->post('email'));

            $data = [
                'username' => $username,
                'email'    => $email
            ];

            if ($this->UsersModel->update($id, $data)) {
                return redirect('users/UsersData');
            } else {
                echo "❌ Error updating user.";
            }

        } else {
            $data['user'] = $this->UsersModel->find($id);

            if (!$data['user']) {
                echo "❌ User not found!";
                return;
            }

            return $this->call->view('users/update', $data);
        }
    }

    /**
     * Delete a user
     */
    public function delete($id)
    {
        if ($this->UsersModel->delete($id)) {
            return redirect('users/UsersData');
        } else {
            echo "❌ Error deleting user.";
        }
    }
}
