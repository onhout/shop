<?php
/**
 * Created by PhpStorm.
 * User: pl
 * Date: 5/4/15
 * Time: 17:37
 */
include('adminnav.php');
?>

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <form>
                <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
                    <input type="text" class="form-control" placeholder="Search" aria-describedby="basic-addon1">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Go!</button>
                    </span>
                </div>
            </form>
        </div>
        <div class="col-md-3 col-md-offset-6">
            <form action="<?=base_url()?>admin/products/add">
                <div class="form-group">
                    <button class="btn btn-primary form-control" type="submit">Add a new product</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-responsive">
                <thead>
                <tr>
                    <th>Picture</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Inventory Count</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($products as $product){
                        echo '<tr>';
                        echo '<td><a href="'.base_url().'admin/products/edit/'.$product['id'].'"><img src="'.base_url().substr($product['image_link'], 0, strpos($product['image_link'], ',')).'" width="75px"></a></td>';
                        echo '<td>'.$product['id'].'</td>';
                        echo '<td>'.$product['name'].'</td>';
                        echo '<td>'.$product['quantity'].'</td>';
                        echo '<td><a href="'.base_url().'admin/products/remove/'.$product['id'].'">Remove</a></td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>