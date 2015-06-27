<?php
class Product extends CI_Model
{

	public function get_all_products()
    {
        return $this->db->query("SELECT * FROM products")->result_array();
    }

	public function get_product($product_id)
    {
        return $this->db->query("SELECT products.id, products.name AS name, description, quantity, price, image_link, categories.name AS category_name FROM products JOIN products_categories ON products.id = products_categories.product_id JOIN categories ON categories.id = products_categories.category_id WHERE products.id = ?", array($product_id))->row_array();
    }

    public function get_category_product_junction(){
        return $this->db->query("SELECT * FROM products_categories") ->result_array();
    }

    public function add_product($product, $category)
    {
        $productname = $product['name'];
        $dbcategory_id = $this->get_last_categoryID($category) ;
        $last_product_id = $this->get_last_productID($productname);

        if (!$last_product_id){
            $query = "INSERT INTO products (name, description, quantity, price, image_link) VALUES (?,?,?,?,?)";
            $values = array($product['name'], $product['description'], $product['quantity'], $product['price'], $product['image_link']);
            $this->db->query($query, $values);
            $last_product_id = $this->get_last_productID($productname);
        }

        if (!$dbcategory_id){
            $querycategory = "INSERT INTO categories(name) VALUES('$category')";
            $valuescategory = $category;
            $this->db->query($querycategory, $valuescategory);
            $dbcategory_id = $this->get_last_categoryID($category);
        }

        $this->db->query("INSERT INTO products_categories(product_id, category_id) VALUES('$last_product_id', '$dbcategory_id')");
    }

    protected function get_last_productID($product){
        $object = $this->db->query("SELECT id FROM products WHERE name='$product'")->row_array();
        return $object?$object['id']:null;
    }

    protected function get_last_categoryID($category){
        $object = $this->db->query("SELECT id FROM categories WHERE name='$category'")->row_array();
        return $object?$object['id']:null;
    }

    public function get_categories(){
        return $this->db->query('SELECT * FROM categories')->result_array();
    }

    public function remove_product($id){
        $this->db->query("DELETE FROM products_categories WHERE product_id = '$id'");
        $this->db->query("DELETE FROM products WHERE id = '$id'");
    }

    public function update_product($product, $category){
        $productname = $product['name'];
        $product_id = $this->get_last_productID($productname);
        $category_id = $this->get_last_categoryID($category);
        $updateproduct = "UPDATE products SET products.name = ?, description=?, quantity=?, price=? WHERE id='$product_id'";
        $updatecategory = "UPDATE products_categories SET category_id = '$category_id' WHERE product_id = '$product_id'";
        $this->db->query($updateproduct, $product);
        $this->db->query($updatecategory);

    }
}
?>