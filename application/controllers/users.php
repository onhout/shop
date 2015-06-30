<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Users extends CI_Controller{
    public function __construct(){
        parent::__construct();

    }

    public function login_route(){
        $this->load->view('login');
    }

    public function product_route(){
        if ($this->session->userdata('admin_level')!=9){
            redirect('/');
        }else{
            $laka['products'] = $this->product->get_all_products();
            $this->load->view('productsview', $laka);
        }

    }

    public function add_product_route(){
        if ($this->session->userdata('admin_level')==9){
            $laka['categories'] = $this->product->get_categories();
            $this->load->view('newproduct', $laka);
        } else {
            redirect('/');
        }

    }

    public function users_route(){
        if ($this->session->userdata('admin_level')!=9){
            redirect('/');
        } else {
            $laka['users'] = $this->usermodel->get_all_users();
            $this->load->view('usersview', $laka);
        }
    }

    public function dashboard($userID){
        if ($this->session->userdata('userID')==$userID || $this->session->userdata('admin_level') == 9){
            $laka['userInfo'] = $this->usermodel->get_user($userID);
            $laka['user_order'] = $this->order->get_user_orders($userID);
            $this->load->view('dashboard', $laka);
        } else {
            redirect('/');
        }
    }

    public function update_user($userID){
        $this->form_validation->set_rules('confpw', 'Confirm Password', 'matches[password]');
        if ($this->form_validation->run()==FALSE){
            $this->session->set_flashdata('errors', validation_errors());
            redirect('/users/dashboard/'.$userID);
        }
        if($this->session->userdata('userID')==$userID || $this->session->userdata('admin_level')==9){
            $user = [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address'),
                'password' => ''
            ];
            if ($this->input->post('password')){
                $user['password'] = sha1($this->input->post('password'));
            }
            $this->usermodel->update_user($userID, $user);
            redirect('/users/dashboard/'.$userID);
        } else {
            redirect('/');
        }
    }

    public function remove_user($userID){
        if ($this->session->userdata('admin_level')==9){
            $this->usermodel->remove_user($userID);
            redirect('admin/users');
        } else {
            redirect('/');
        }
    }

    public function register_route(){
        $this->load->view('register');
    }

    public function register(){
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|callback_checkregister');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('confpw', 'Confirm Password', 'required|matches[password]');
        if ($this->form_validation->run()==FALSE){
            $this->session->set_flashdata('errors', validation_errors());
            redirect('/register');
        } else{
            $user = [
                'name'=>$this->input->post('name'),
                'email'=>$this->input->post('email'),
                'password'=>$this->input->post('password')
            ];
            $this->usermodel->register($user);
            redirect('/login');
        }
    }


    public function login(){
        $this->form_validation->set_rules('email', 'Email', 'trim|required|callback_usernamecheck');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_message('usernamecheck', 'Please check your fields and try again');
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('errors', validation_errors());
            redirect ('/login');
        } else {
            $user = [
                "email" => $this->input->post('email'),
                "password" => sha1($this->input->post('password'))
            ];
            $loggedInUser = $this->usermodel->login($user);
            $this->session->set_userdata('userID', $loggedInUser['id']);
            $this->session->set_userdata('userName', $loggedInUser['name']);
            $this->session->set_userdata('admin_level', $loggedInUser['admin_level']);
            if ($loggedInUser['admin_level']==9){
                redirect('/admin/products');
            } else{
                redirect('/users/dashboard/'.$this->session->userdata('userID'));
            }
        }
    }

    public function usernamecheck(){
        $user = [
            "email" => $this->input->post('email'),
            "password" => $this->input->post('password')
        ];
        return ($this->usermodel->checklogin($user))?true:false;
    }

    public function logoff(){
        $this->session->sess_destroy();
        redirect('/');
    }
}