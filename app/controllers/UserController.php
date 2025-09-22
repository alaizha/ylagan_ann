<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: UsersController
 * 
 * Automatically generated via CLI.
 */
class UsersController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->library('Pagination'); // 
    }
    public function index()
    {
        $this->call->model('UsersModel');
        $this->call->library('Pagination'); // 

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
            'first_link'     => '<span class="px-3 py-1 bg-emerald-600 text-green rounded hover:bg-emerald-700">⏮ First</span>',
            'last_link'      => '<span class="px-3 py-1 bg-emerald-600 text-green rounded hover:bg-emerald-700">Last ⏭</span>',
            'next_link'      => '<span class="px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Next →</span>',
            'prev_link'      => '<span class="px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">← Prev</span>',
            'cur_tag_open'   => '<span class="px-3 py-1 bg-emerald-600 text-white rounded">',
            'cur_tag_close'  => '</span>',
            'num_tag_open'   => '<span class="px-3 py-1 border border-gray-300 rounded hover:bg-gray-100">',
            'num_tag_close'  => '</span>',
            'page_delimiter' => '&page='
        ]);

        $this->pagination->initialize($total_rows, $records_per_page, $page, 'users?q='.urldecode($q));
        $data['page'] = $this->pagination->paginate();

        $this->call->view('users/index', $data);
    }

    public function create()
    {
        if ($this->io->method() == 'post') {

            $username =$this->io->post('username');
            $email =$this->io->post('email');
            $data = array(
                'username' => $username,
                'email' => $email
            );
            if($this->UsersModel->insert($data)) {
                redirect();
            } else {
                echo "Error inserting record.";
            }
        }else{
            $this->call->view('users/create');
        }
    }

    function update($id)
    {
        $user = $this->UsersModel->find($id);
        if (!$user) {
            echo "User not found.";
            return;
        }
        if($this->io->method() == "post") {
            $username =$this->io->post("username");
            $email =$this->io->post("email");
            $data = array(
                'username' => $username,
                'email' => $email
            );
            if($this->UsersModel->update($id, $data)) {
                redirect();
            } else {
                echo "Error updating record.";
            }
        } else {
            $data['user'] = $user;
            $this->call->view('users/update', $data);
        }
    }

    function delete($id)
    {
        if($this->UsersModel->delete($id)) {
            redirect();
        } else {
            echo "Error deleting record.";
        }
    }
}