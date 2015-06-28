<?php
/**
 * Created by PhpStorm.
 * User: pl
 * Date: 6/27/15
 * Time: 20:24
 */

include('nav.php');

?>

<div class="container">
    <div class="col-md-8 col-md-offset-2">
        <h3>Shopping Cart</h3>
        <?
        if (count($cartItems)==0){
            echo '<h5>Your shopping cart is currently empty, click <a href="/">here</a> to go add something!</h5>';
        }
        ?>
        <table class="table">
            <thead>
            <tr>
                <th>Info</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
            </thead>
            <tbody>
            <?
                $total = 0;
                foreach($cartItems as $items){
                    echo '<tr>';
                    echo '<td><a href="'.base_url().'show/'.$items['id'].'"><img src="'.substr($items['image_link'], 0, (strpos($items['image_link'], ','))).'" width="100px"> '.$items['name'].'</a></td>';
                    echo '<td>$'.$items['price'].'</td>';
                    echo '<td>
                    <p>
                    <form class="form-inline pull-right" action="carts/update_cart_item" method="post">
                        <input type="hidden" value="'.$items['id'].'" name="itemID">
                        <input class="text-center form-control" value="'.$items['cartQuantity'].'" name="itemQuantity">
                        <button class="btn btn-info" type="submit">Update</button>
                    </form>
                    </p>
                    </td>';
                    echo '</tr>';
                    $total+=$items['price']*$items['cartQuantity'];
                }
            ?>
            </tbody>
        </table>
        <hr>
        <h2 class="text-right">Total: $<?=$total?></h2>
        <button class="btn btn-primary pull-right">Checkout</button>
    </div>
</div>