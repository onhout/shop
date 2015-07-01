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
    <link rel="stylesheet" href="<?=base_url()?>/assets/bower_components/bootstrap-material-design/dist/css/material-fullpalette.min.css">
    <link rel="stylesheet" href="<?=base_url()?>/assets/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css">
    <script src="<?=base_url()?>/assets/bower_components/jquery/dist/jquery.js"></script>
    <script src="<?=base_url()?>/assets/bower_components/bootstrap/dist/js/bootstrap.js"></script>
    <script src="<?=base_url()?>/assets/bower_components/bootstrap-material-design/dist/js/material.min.js"></script>
    <script src="<?=base_url()?>/assets/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>
<!--    <script src="--><?//base_url()?><!--/assets/js/script.js"></script>-->
    <style> .carousel {background-image: url("<?=base_url()?>assets/image/concrete_seamless.png")}
            .carousel-inner > .item > a > img{ margin: auto; height:450px; }
            .carousel-caption{top: 0; bottom: auto;}
    </style>
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target="#bs-example-navbar-collapse-1" data-canvas="body">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?=base_url()?>">E-Commerce</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse">
            <?
            if($this->session->userdata('userName')){
                echo '<p class="navbar-text">Hello '.$this->session->userdata('userName').'!</p>';
            } else {
                echo '<p class="navbar-text">Welcome!</p>';
            }
            ?>
            <!--<ul class="nav navbar-nav">
                <li <?php /*echo (uri_string()=='admin/orders')?'class="active"':'class=""'*/?>><a href="<?/*=base_url()*/?>admin/orders">Orders</a></li>
                <li <?php /*echo (uri_string()=='admin/products')?'class="active"':'class=""'*/?>><a href="<?/*=base_url()*/?>admin/products">Products</a></li>
                <li <?php /*echo (uri_string()=='admin/users')?'class="active"':'class=""'*/?>><a href="<?/*=base_url()*/?>admin/users">Users</a> </li>
            </ul>-->
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categories<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <form>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
                                <input type="text" class="form-control" placeholder="Search" aria-describedby="basic-addon1">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Go!</button>
                                </span>
                            </div>
                        </form>
                        <?php
                        echo ($currentCategory == 'all')? '<li role="presentation" class="active"><a href="'.base_url().'products/all/1">All <span class="badge pull-right">'.count($this->product->get_all_products()).'</span></a></li>':
                            '<li role="presentation"><a href="'.base_url().'products/all/1">All <span class="badge pull-right">'.count($this->product->get_all_products()).'</span></a></li>';
                        foreach($categories as $category){
                            echo ($currentCategory == $category['name'])?'<li role="presentation" class="active"><a href="'.base_url().'products/'.$category['name'].'/1">'.$category['name'].'<span class="badge pull-right">':
                                '<li><a href="'.base_url().'products/'.$category['name'].'/1">'.$category['name'].'<span class="badge pull-right">';
                            $num = 0;
                            foreach($categoriesJunction as $junction){
                                if ($category['id'] == $junction['category_id']){
                                    $num++;
                                }
                            }
                            echo $num.'</span></a></li>';
                        }
                        ?>
                    </ul>
                </li>
                <?php
                if ($this->session->userdata('admin_level')==9){
                    echo '<li><a href="'.base_url().'admin/products">Edit</a></li>';
                    echo '<li><a href="'.base_url().'users/dashboard/'.$this->session->userdata('userID').'">Dashboard</a></li>';
                    echo '<li><a href="'.base_url().'users/logoff">Log Off</a></li>';
                } else if ($this->session->userdata('admin_level')==1){
                    echo '<li><a href="'.base_url().'users/dashboard/'.$this->session->userdata('userID').'">Dashboard</a></li>';
                    echo '<li><a href="'.base_url().'cart"><i class="mdi-action-shopping-cart"></i><span class="badge">'.count($this->session->userdata('cart')).'</span></a></li>';
                    echo '<li><a href="'.base_url().'users/logoff">Log Off</a></li>';
                }else {
                    echo '<li><a href="'.base_url().'cart"><i class="mdi-action-shopping-cart"></i><span class="badge">'.count($this->session->userdata('cart')).'</span></a></li>';
                    echo '<li><a href="'.base_url().'register">Register</a></li>';
                    echo '<li><a href="'.base_url().'login">Log in</a></li>';
                }
                ?>

            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<nav class="navmenu navmenu-default navmenu-fixed-left offcanvas" id="bs-example-navbar-collapse-1" role="navigation">
    <ul class="nav navmenu-nav">

        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categories<span class="caret"></span></a>
            <ul class="dropdown-menu">
                <form>
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
                        <input type="text" class="form-control" placeholder="Search" aria-describedby="basic-addon1">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Go!</button>
                                </span>
                    </div>
                </form>
                <?php
                echo ($currentCategory == 'all')? '<li role="presentation" class="active"><a href="'.base_url().'products/all/1">All <span class="badge pull-right">'.count($this->product->get_all_products()).'</span></a></li>':
                    '<li role="presentation"><a href="'.base_url().'products/all/1">All <span class="badge pull-right">'.count($this->product->get_all_products()).'</span></a></li>';
                foreach($categories as $category){
                    echo ($currentCategory == $category['name'])?'<li role="presentation" class="active"><a href="'.base_url().'products/'.$category['name'].'/1">'.$category['name'].'<span class="badge pull-right">':
                        '<li><a href="'.base_url().'products/'.$category['name'].'/1">'.$category['name'].'<span class="badge pull-right">';
                    $num = 0;
                    foreach($categoriesJunction as $junction){
                        if ($category['id'] == $junction['category_id']){
                            $num++;
                        }
                    }
                    echo $num.'</span></a></li>';
                }
                ?>
            </ul>
        </li>
        <?php
        if ($this->session->userdata('admin_level')==9){
            echo '<li><a href="'.base_url().'admin/products">Edit</a></li>';
            echo '<li><a href="'.base_url().'users/dashboard/'.$this->session->userdata('userID').'">Dashboard</a></li>';
            echo '<li><a href="'.base_url().'users/logoff">Log Off</a></li>';
        } else if ($this->session->userdata('admin_level')==1){
            echo '<li><a href="'.base_url().'users/dashboard/'.$this->session->userdata('userID').'">Dashboard</a></li>';
            echo '<li><a href="'.base_url().'cart"><i class="mdi-action-shopping-cart"></i><span class="badge">'.count($this->session->userdata('cart')).'</span></a></li>';
            echo '<li><a href="'.base_url().'users/logoff">Log Off</a></li>';
        }else {
            echo '<li><a href="'.base_url().'cart"><i class="mdi-action-shopping-cart"></i><span class="badge">'.count($this->session->userdata('cart')).'</span></a></li>';
            echo '<li><a href="'.base_url().'register">Register</a></li>';
            echo '<li><a href="'.base_url().'login">Log in</a></li>';
        }
        ?>

    </ul>
</nav><!-- /.navbar-collapse -->
</body>
</html>