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
            <?=($userInfo['address']==NULL)?'Please add your address if you haven\'t done so.':'' ?>
            <form class="form-horizontal" action="<?=base_url()?>users/update_user/<?=$userInfo['id']?>" method="post">
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Name:</label>
                    <div class="col-sm-9">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="<?=$userInfo['name']?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email:</label>
                    <div class="col-sm-9">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="<?=$userInfo['email']?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-sm-3 control-label">Address:</label>
                    <div class="col-sm-9">
                        <input type="text" name="address" class="form-control" id="address" placeholder="Address" value="<?echo ($userInfo['address']!=NULL)?($userInfo['address']):'null'?>"/>
                    </div>
                </div>
                <p>*Updating password is optional</p>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Password:</label>
                    <div class="col-sm-9">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="confpw" class="col-sm-3 control-label">Confirm:</label>
                    <div class="col-sm-9">
                        <input type="password" name="confpw" class="form-control" id="confpw" placeholder="Confirm Password"/>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary pull-right">Update</button>
                </div>
            </form>
            <?=$this->session->flashdata('errors')?>
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