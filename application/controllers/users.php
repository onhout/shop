<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Users extends CI_Controller{
    public function __construct(){
        parent::__construct();

    }

    public function orders_route(){
        if ($this->session->userdata('admin_level')!=9){
            redirect('/');
        }else {
            $this->load->view('orders_view');
        }
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
        $laka['categories'] = $this->product->get_categories();
        $this->load->view('newproduct', $laka);
    }

    public function users_route(){
        if ($this->session->userdata('admin_level')!=9){
            redirect('/');
        } else {
            $this->load->view('usersview');
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
            $this->session->set_userdata('admin_level', $loggedInUser['admin_level']);
            if ($loggedInUser['admin_level']==9){
                redirect('/admin/products');
            } else{
                redirect('/dashboard');
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