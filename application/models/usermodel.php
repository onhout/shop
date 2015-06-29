<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: pl
 * Date: 5/4/15
 * Time: 16:35
 */

class Usermodel extends CI_Model{

    public function login($user){
        $query = "SELECT * FROM users WHERE email=? AND password=?";
        return $this->db->query($query, $user)->row_array();
    }

    public function checklogin($user){
        $email = $user['email'];
        $password = sha1($user['password']);
        return $this->db->query("SELECT email FROM users WHERE email='$email' AND password='$password'")->row_array()?true:false;
    }

    public function register($user){
        $password = sha1($user['password']);
        $query = "INSERT INTO users(name, email, password, admin_level, created_at, updated_at) VALUES(?, ?, ?, ?, now(), now())";
        $values = array($user['name'], $user['email'], $password, 1);
        $this->db->query($query, $values);
        /*if($this->checkUser($user)==false){

        }*/
    }

    public function checkUser($user){
        $email = $user['email'];
        return $this->db->query("SELECT email from users WHERE email='$email'")->row_array()?false:true;
    }

    public function get_user($userID){
        $query = "SELECT * FROM users WHERE id = '$userID'";
        return $this->db->query($query)->row_array();
    }
}