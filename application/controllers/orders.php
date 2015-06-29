<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // $this->output->enable_profiler();
    }

    public function add_order(){
        if (!$this->session->userdata('userID')){
            redirect('/login');
        } else {
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
        $laka['order'] = $this->order->get_order($orderID);
        $laka['orderID'] = $orderID;
        $this->load->view('showorder', $laka);
    }

    public function edit_order($orderID){
        $this->order->edit_order($orderID, $this->input->post('status'));
        redirect('/admin/orders');
    }

    public function delete_order($orderID){
        $this->order->delete_order($orderID);
        redirect('/admin/orders');
    }

}
