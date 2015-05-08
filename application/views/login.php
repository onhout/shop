<?php
/**
 * Created by PhpStorm.
 * User: pl
 * Date: 5/4/15
 * Time: 11:51
 */

?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Login Page</title>
    <link rel="stylesheet" href="<?=base_url()?>/assets/bower_components/bootstrap/dist/css/bootstrap.css">
    <script src="<?=base_url()?>/assets/bower_components/jquery/dist/jquery.js"></script>
</head>
<body>
<div class="container">
    <div class="col-md-6 col-md-offset-3">
        <h1 class="text-center">Admin Login Page</h1>
        <form action="users/login" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary pull-right">Login</button>
            <?=$this->session->flashdata('errors')?>
        </form>
    </div>
</div>
</body>
</html>