<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->output->enable_profiler();
	}

	public function index()
	{
		$this->load->view('index');
	}

	public function show()
	{
		$this->load->view('show');
	}

	public function getAll()
	{
		
	}

	public function carts()
	{
		$this->load->view('carts');
	}

    public function edit_product_route($id){
        $laka['product'] = $this->product->get_product($id);
        $laka['categories'] = $this->product->get_categories();
        $this->load->view('editproducts', $laka);
    }

    public function add_new_product(){
        $this->sanitize(); //form submission rules
        if($this->form_validation->run()==false){
            $this->session->set_flashdata('errors', validation_errors()); //flash data to display errors
            redirect(base_url().'/admin/products/add'); //if fail, redirect
        } elseif ($this->session->userdata('admin_level') == 9){ //check against if user is admin
            $category = $this->input->post('category'); //setting category
            $filestring = ''; //
            foreach($this->upload_product_img() as $string){ //the upload function will return a location string when called
                $filestring .= $this->createFolderPath($this->input->post('name')) . '/' . $string .', '; //concatenate folder name using product name and a comma for multiple pictures corresponding to the current product
            }

            $product=[ //populate product fields
                "name"=>$this->input->post('name'),
                "description"=>$this->input->post('description'),
                "quantity" =>$this->input->post('quantity'),
                "price" =>$this->input->post('price'),
                "image_link" => $filestring
            ];
            $this->product->add_product($product, $category); //add to database
            $this->upload_product_img(); //add to folder picture
            redirect(base_url().'admin/products');
        } else {
            redirect('/');
        }
    }

    private function createFolderPath($foldername){
        $folder = str_replace(' ', '','assets/image/'.$foldername);
        if (!is_dir($folder)){
            mkdir($folder, 0775, TRUE); //make a folder using the post name
        }
        return $folder; //return folder name as a string
    }

    public function upload_product_img(){
        $files_path=[];
        $this->load->library('upload');
        $files = $_FILES;
        $cpt = count($_FILES['userfile']['name']);
        for($i=0; $i<$cpt; $i++) //THE STRUCTURE OF $_FILES IS REALLY WEIRD, HAD TO REWRITE THE ENTIRE STRUCTURE TO PROPERLY LOOP THRU
        {
            $_FILES['userfile']['name']= $files['userfile']['name'][$i];
            $_FILES['userfile']['type']= $files['userfile']['type'][$i];
            $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
            $_FILES['userfile']['error']= $files['userfile']['error'][$i];
            $_FILES['userfile']['size']= $files['userfile']['size'][$i];
            array_push($files_path, $files['userfile']['name'][$i]);
            $this->upload->initialize($this->set_upload_options());
            $this->upload->do_upload();
        }
        return $files_path;
    }
    private function set_upload_options(){ //just a function to set the upload options
        $config = [
            "upload_path" => $this->createFolderPath($this->input->post('name')),
            "allowed_types" => 'gif|jpg|png'
        ];
        return $config;
    }

    public function sanitize(){ //sanitizing the new product form
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        $this->form_validation->set_rules('category', 'Category', 'callback_category_check');
        $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required');
        $this->form_validation->set_rules('price', 'Price', 'trim|required');
        $this->form_validation->set_message('category_check', 'Please choose a category');
        $this->form_validation->set_error_delimiters('<div class="text-center text-danger">', '</div>');
    }

    public function category_check(){ //callback function from sanitize
        return ($this->input->post('category')=="")?false:true;
    }

    public function remove_product($id){ //remote product
        if ($this->session->userdata['admin_level'] == 9){
            $product = $this->product->get_product($id);
            $this->product->remove_product($id);
            $this->deleteFolder('assets/image/'.$product['name']);
            redirect(base_url().'/admin/products');
        } else {
            redirect('/');
        }
    }

    public function deleteFolder($path){
        if(is_dir($path)){ //if path is directory
            $files = array_diff(scandir($path), array('.', '..')); //scan all files and delete '.' and '..' directories
            foreach($files as $file){ //recursion delete
                $this->deleteFolder(realpath($path).'/'.$file); //delete the real path of each file
            }
            return rmdir($path);
        } elseif(is_file($path)){ //if path is file
            return unlink($path); //delete
        }
        return false; //base case
    }

    public function update_product(){
        $this->session->set_userdata('admin_level', 9);
        if ($this->session->userdata('admin_level') == 9){ //check against if user is admin
            $category = $this->input->post('category'); //setting category
            $product=[ //populate product fields
                "name"=>$this->input->post('name'),
                "description"=>$this->input->post('description'),
                "quantity" =>$this->input->post('quantity'),
                "price" =>$this->input->post('price'),
            ];
            $this->product->update_product($product, $category); //update to database
            redirect(base_url().'admin/products');
        } else {
            redirect('/');
        }
    }

}


//end of main controller