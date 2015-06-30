<?php
/**
 * Created by PhpStorm.
 * User: pl
 * Date: 6/28/15
 * Time: 04:45
 */

class Order extends CI_Model{
    public function add_order($order, $itemlist){
        $queryorder = 'INSERT INTO orders(user_id, created_at, updated_at, status) VALUES (?, now(), now(), ?)';
        $valuesorder = array($order['user_id'], $order['status']);
        $this->db->query($queryorder, $valuesorder);
        $id=mysql_insert_id();
        for ($i = 0; $i< count($itemlist); $i++){
            $query_item_list = 'INSERT INTO item_list(order_id, user_id, products_id, quantity) VALUES(?, ?, ?, ?)';
            $values_item_list = array($id, $order['user_id'], $itemlist[$i]['itemID'], $itemlist[$i]['quantity']);
            $this->db->query($query_item_list, $values_item_list);
        }
    }

    public function get_order($orderID){
        $query = "SELECT item_list.quantity as orderQuantity, products.image_link, products_id, products.name as productName, price, orders.created_at, item_list.user_id, users.email FROM orders JOIN users ON orders.user_id = users.id JOIN item_list ON orders.id=item_list.order_id JOIN products ON item_list.products_id=products.id WHERE orders.id='$orderID'";
        return $this->db->query($query)->result_array();
    }

    public function get_all_orders(){
        $query = "SELECT orders.id, users.email, users.id as userID , orders.created_at, orders.status FROM orders JOIN users ON orders.user_id=users.id";
        return $this->db->query($query)->result_array();
    }

    public function get_user_orders($userID){
        $query = "SELECT orders.id as orderID, orders.created_at, status FROM orders JOIN users ON users.id = orders.user_id WHERE users.id = '$userID'";
        return $this->db->query($query)->result_array();
    }

    public function edit_order($orderID, $status){
        $query = "UPDATE orders SET orders.status = '$status' WHERE orders.id = $orderID";
        $this->db->query($query);
    }


    public function delete_order($orderID){
        $query = "DELETE FROM orders WHERE id='$orderID'";
        $this->db->query($query);
    }
}