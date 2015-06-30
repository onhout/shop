<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // $this->output->enable_profiler();
    }

    public function orders_route(){
        if ($this->session->userdata('admin_level')!=9){
            redirect('/');
        }else {
            $laka['orders'] = $this->order->get_all_orders();
            $this->load->view('orders_view', $laka);
        }
    }

    public function add_order(){
        if($this->session->userdata('userID')){
            $userAddress = $this->usermodel->get_user($this->session->userdata('userID'))['address'];
        }
        if (!$this->session->userdata('userID')){
            redirect('/login');
        } else if (empty($this->session->userdata('cart'))){
            redirect('/cart');
        }else if ($userAddress == NULL) {
            redirect('/users/dashboard/'.$this->session->userdata('userID'));
        }else {
            $order = [
                "user_id" => $this->session->userdata('userID'),
                "status" => 'Processing'
            ];
            $itemList = $this->session->userdata('cart');
            $this->order->add_order($order,$itemList);
            $this->session->set_userdata('cart', []);
            redirect('/users/dashboard/'.$this->session->userdata('userID'));
        }
    }

    public function show_order($orderID){
        if ($this->session->userdata('admin_level')==9){
            $laka['order'] = $this->order->get_order($orderID);
            $laka['orderID'] = $orderID;
            $this->load->view('showorder', $laka);
        } else {
            redirect('/');
        }

    }

    public function edit_order($orderID){
        $this->order->edit_order($orderID, $this->input->post('status'));
        redirect('/admin/orders');
    }

    public function delete_order($orderID){
        if ($this->session->userdata('admin_level')==9){
            $this->order->delete_order($orderID);
            redirect('/admin/orders');
        } else {
            redirect('/');
        }

    }

}
