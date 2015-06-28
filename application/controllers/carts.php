<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Carts extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // $this->output->enable_profiler();
    }

    public function cart()
    {
        $laka['cartItems'] = [];
        if ($this->session->userdata('cart')>0){
            foreach($this->session->userdata('cart') as $ds){
                $temp = $this->product->get_product($ds['itemID']);
                $temp['cartQuantity'] = $ds['quantity'];
                array_push($laka['cartItems'], $temp);
            }
        }
        $this->load->view('cart', $laka);
    }

    public function add_to_cart(){
        $cartItems = $this->session->userdata('cart');
        $laka = [
            'itemID' => $this->input->post('itemID'),
            'quantity' => $this->input->post('quantity')
        ];
        for ($i=0; $i<count($cartItems); $i++){
            if ($cartItems[$i]['itemID'] == $this->input->post('itemID')){
                $cartItems[$i]['quantity']+=$this->input->post('quantity');
                $this->session->set_userdata('cart', $cartItems);
                redirect('/cart');
            }
        }
        array_push($cartItems, $laka);
        $this->session->set_userdata('cart', $cartItems);
        redirect('/cart');
    }

    public function update_cart_item(){
        $cartItems = $this->session->userdata('cart');
        if ($this->input->post('itemQuantity')==0){
            for ($i=0; $i<count($cartItems); $i++){
                if ($cartItems[$i]['itemID']==$this->input->post('itemID')){
                    unset($cartItems[$i]);
                    $this->session->set_userdata('cart', $cartItems);
                }
            }
        } else {
            for ($i=0; $i<count($cartItems); $i++){
                if ($cartItems[$i]['itemID'] == $this->input->post('itemID')){
                    $cartItems[$i]['quantity'] = $this->input->post('itemQuantity');
                    $this->session->set_userdata('cart', $cartItems);
                }
            }
        }
        redirect('/cart');
    }
}