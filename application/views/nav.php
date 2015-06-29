<?php
/**
 * Created by PhpStorm.
 * User: pl
 * Date: 5/4/15
 * Time: 11:49
 */


?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php ?></title>
    <link rel="stylesheet" href="<?=base_url()?>/assets/bower_components/bootstrap/dist/css/bootstrap.css">
    <script src="<?=base_url()?>/assets/bower_components/jquery/dist/jquery.js"></script>
    <script src="<?base_url()?>/assets/bower_components/bootstrap/dist/js/bootstrap.js"></script>
<!--    <script src="--><?//base_url()?><!--/assets/js/script.js"></script>-->

</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?=base_url()?>">E-Commerce</a>
            <?
                if($this->session->userdata('userName')){
                    echo '<p class="navbar-text">Hello '.$this->session->userdata('userName').'!</p>';
                } else {
                    echo '<p class="navbar-text">Welcome!</p>';
                }
            ?>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <!--<ul class="nav navbar-nav">
                <li <?php /*echo (uri_string()=='admin/orders')?'class="active"':'class=""'*/?>><a href="<?/*=base_url()*/?>admin/orders">Orders</a></li>
                <li <?php /*echo (uri_string()=='admin/products')?'class="active"':'class=""'*/?>><a href="<?/*=base_url()*/?>admin/products">Products</a></li>
                <li <?php /*echo (uri_string()=='admin/users')?'class="active"':'class=""'*/?>><a href="<?/*=base_url()*/?>admin/users">Users</a> </li>
            </ul>-->
            <ul class="nav navbar-nav navbar-right">
                <?php
                if ($this->session->userdata('admin_level')==9){
                    echo '<li><a href="'.base_url().'admin/products">Edit</a></li>';
                    echo '<li><a href="'.base_url().'users/dashboard/'.$this->session->userdata('userID').'">Dashboard</a></li>';
                    echo '<li><a href="'.base_url().'users/logoff">Log Off</a></li>';
                } else if ($this->session->userdata('admin_level')==1){
                    echo '<li><a href="'.base_url().'users/dashboard/'.$this->session->userdata('userID').'">Dashboard</a></li>';
                    echo '<li><a href="'.base_url().'cart">Shopping Cart('.count($this->session->userdata('cart')).')</a></li>';
                    echo '<li><a href="'.base_url().'users/logoff">Log Off</a></li>';
                }else {
                    echo '<li><a href="'.base_url().'cart">Shopping Cart('.count($this->session->userdata('cart')).')</a></li>';
                    echo '<li><a href="'.base_url().'register">Register</a></li>';
                    echo '<li><a href="'.base_url().'login">Log in</a></li>';
                }
                ?>

            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
</body>
</html>