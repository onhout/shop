<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class main extends CI_Controller{
    public function index(){
        redirect('/products/1');
    }

    public function show_products($currentpage){
        $laka['categories'] = $this->product->get_categories();
        $laka['products'] = $this->product->get_all_products();
        $itemsPerPage = 12;
        $laka['totalCount'] = count($laka['products']);
        $laka['pages'] = ceil($laka['totalCount']/$itemsPerPage);
        $laka['startingCount'] = ($currentpage-1)*$itemsPerPage;
        $laka['currentCount'] = $currentpage*$itemsPerPage;
        $laka['pagenum'] = $currentpage;
        $laka['categoriesJunction'] = $this->product->get_category_product_junction();

        $this->load->view('index', $laka);
    }

    public function products_as_categories($categories){
        $laka['categories'] = $this->product->get_categories();
        $laka['products'] = $this->product->get_all_products();
        $laka['categoriesJunction'] = $this->product->get_category_product_junction();
        $this->load->view('index', $laka);
    }

}