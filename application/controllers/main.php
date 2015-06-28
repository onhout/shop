<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class main extends CI_Controller{
    public function index(){
        redirect('/products/all/1');
    }

    public function show_products($categories, $currentpage){
        if(!$this->session->userdata('cart')){
            $this->session->set_userdata('cart', []);
        }
        $laka['categories'] = $this->product->get_categories();
        $laka['products'] = $this->product->get_all_products();
        foreach ($laka['categories'] as $category){
            if ($category['name'] == $categories){
                $currentCategoryID = $category['id'];
            }
        }

        $laka['categoriesJunction'] = $this->product->get_category_product_junction();
        if ($categories == 'all'){
            $laka['currentCategory'] = 'all';
            $laka['products'] = $this->product->get_all_products();
        } else {
            $laka['products'] = [];
            foreach ($laka['categoriesJunction'] as $cata){
                if ($cata['category_id'] == $currentCategoryID){
                    array_push($laka['products'], $this->product->get_product($cata['product_id']));
                }
            }
            $laka['currentCategory'] = $categories;
        }

        $itemsPerPage = 12;
        $laka['totalCount'] = count($laka['products']);
        $laka['pages'] = ceil($laka['totalCount']/$itemsPerPage);
        $laka['startingCount'] = ($currentpage-1)*$itemsPerPage;
        $laka['currentCount'] = $currentpage*$itemsPerPage;
        $laka['pagenum'] = $currentpage;

        $this->load->view('index', $laka);
    }
}