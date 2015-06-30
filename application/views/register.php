<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration Page</title>
    <link rel="stylesheet" href="<?=base_url()?>/assets/bower_components/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="<?=base_url()?>/assets/bower_components/bootstrap-material-design/dist/css/material-fullpalette.min.css">
    <script src="<?=base_url()?>/assets/bower_components/jquery/dist/jquery.js"></script>
</head>
<body>
<div class="container">
    <div class="col-md-6 col-md-offset-3">
        <h1 class="text-center">Register</h1>
        <form action="users/register" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="password">Confirm Password:</label>
                <input type="password" name="confpw" class="form-control" placeholder="Confirm Password">
            </div>
            <button type="submit" class="btn btn-primary pull-right">Register</button>
            <?=$this->session->flashdata('errors')?>
        </form>
    </div>
</div>
</body>
</html>