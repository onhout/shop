<?php
/**
 * Created by PhpStorm.
 * User: pl
 * Date: 6/28/15
 * Time: 18:50
 */

include('nav.php');
?>

<div class="container">
    <h1>Dashboard</h1>
    <div class="row">
        <div class="col-md-4">
            <h1>Name: <?=$userInfo['name']?></h1>
            <h3>Email: <?=$userInfo['email']?></h3>
        </div>
        <div class="col-md-8">
            <h1 class="text-center">Order History</h1>
            <?
            if (!$user_order){
                echo '<h4 class="text-center">Your order history is currently empty...</h4>';
            }
            ?>
            <table class="table">
                <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Order Date</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?
                foreach ($user_order as $items){
                    echo '<tr>';
                    echo '<td><a href="'.base_url().'orders/show/'.$items['orderID'].'">'.$items['orderID'].'</a></td>';
                    echo '<td>'.$items['created_at'].'</td>';
                    echo '<td>'.$items['status'].'</td>';
                    echo '</tr>';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>