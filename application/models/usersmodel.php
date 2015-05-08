<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: pl
 * Date: 5/4/15
 * Time: 16:35
 */

class Usersmodel extends CI_Model{
    public function login($user){
        $query = "SELECT * FROM ecommerce.users WHERE email=? AND password=?";
        return $this->db->query($query, $user)->row_array();
    }

    public function checklogin($user){
        $email = $user['email'];
        $password = $user['email'];
        return $this->db->query("SELECT email FROM ecommerce.users WHERE email='$email' AND password='$password'")->row_array()?true:false;
    }
}