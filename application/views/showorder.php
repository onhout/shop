<?php
/**
 * Created by PhpStorm.
 * User: pl
 * Date: 6/28/15
 * Time: 14:50
 */

include('nav.php');
?>


<div class="container">
    <div class="row">
        <div class="col-md-4">
            <h1>Order ID:<?=$orderID?></h1>
            <h2>Order Time: <p><?=$order[0]['created_at']?></p></h2>
            <h3>User email:<a href="<?=base_url()?>users/dashboard/<?=$order[0]['user_id']?>"> <?=$order[0]['email']?></a></h3>
            <?
                if($this->session->userdata('admin_level')==9){
                    echo
            '<form action="'.base_url().'admin/orders/edit/'.$orderID.'" method="post" class="form-inline">
                <div class="form-group">
                    <select name="status" class="form-control">
                        <option value="Processing">Processing</option>
                        <option value="Shipped">Shipped</option>
                        <option value="Canceled">Canceled</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>';
                    echo '<a href="'.base_url().'admin/orders/delete/'.$orderID.'">Delete Order</a>';
                }
            ?>

        </div>
        <div class="col-md-8">
            <table class="table">
                <thead>
                <tr>
                    <th>Pic</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
                </thead>
                <tbody>
                <?
                $total = 0;
                foreach($order as $items){
                    echo '<tr>';
                    echo '<td><a href="'.base_url().'show/'.$items['products_id'].'"><img src="'.base_url().substr($items['image_link'], 0, strpos($items['image_link'], ',')).'" width="75px"></a></td>';
                    echo '<td><a href="'.base_url().'show/'.$items['products_id'].'">'.$items['productName'].'</a></td>';
                    echo '<td>'.$items['orderQuantity'].'</td>';
                    echo '<td>$'.$items['price'].'</td>';
                    echo '</tr>';
                    $total+=$items['price']*$items['orderQuantity'];
                }
                ?>
                </tbody>
            </table>
            <hr>
            <h2 class="pull-right">Total: $<?=$total?></h2>
        </div>
    </div>
</div>