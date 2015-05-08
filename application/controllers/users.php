<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Users extends CI_Controller{
    public function __construct(){
        parent::__construct();

    }

    public function orders_route(){
        $this->load->view('orders_view');
    }

    public function login_route(){
        $this->load->view('login');
    }

    public function product_route(){
        $laka['products'] = $this->product->get_all_products();
        $this->load->view('productsview', $laka);
    }

    public function add_product_route(){
        $laka['categories'] = $this->product->get_categories();
        $this->load->view('newproduct', $laka);
    }

    public function users_route(){
        $this->load->view('usersview');
    }

    public function login(){
        $this->form_validation->set_rules('email', 'Email', 'trim|required|callback_usernamecheck');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_message('usernamecheck', 'Please check your fields and try again');
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('errors', validation_errors());
            redirect ('/login');
        } else {

        }
    }

    public function usernamecheck(){
        $user = [
            "email" => $this->input->post('email'),
            "password" => md5($this->input->post('password'))
        ];
        return (!$this->usersmodel->login($user))?false:true;
    }
}