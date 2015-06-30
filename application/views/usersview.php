<?php
/**
 * Created by PhpStorm.
 * User: pl
 * Date: 5/4/15
 * Time: 18:16
 */
include('adminnav.php');
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>User Email</th>
                    <th>Date Registered</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    <?
                    foreach($users as $user){
                        echo '<tr>';
                        echo '<td><a href="'.base_url().'users/dashboard/'.$user['id'].'">'.$user['id'].'</a></td>';
                        echo '<td>'.$user['name'].'</td>';
                        echo '<td><a href="'.base_url().'users/dashboard/'.$user['id'].'">'.$user['email'].'</a></td>';
                        echo '<td>'.$user['created_at'].'</td>';
                        echo '<td><a href="users/remove_user/'.$user['id'].'">Remove</a></td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>