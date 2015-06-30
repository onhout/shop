<?php
/**
 * Created by PhpStorm.
 * User: pl
 * Date: 5/4/15
 * Time: 11:43
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
            <select class="form-control" name="status">
                <option value="showall">Show All</option>
                <option value="Processing">Processing</option>
                <option value="Shipped">Shipped</option>
                <option value="Canceled">Canceled</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-responsive">
                <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Email</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($orders as $order){
                    echo '<tr>';
                    echo '<td><a href="'.base_url().'orders/show/'.$order['id'].'">'.$order['id'].'</a></td>';
                    echo '<td><a href="'.base_url().'users/dashboard/'.$order['userID'].'">'.$order['email'].'</a></td>';
                    echo '<td>'.$order['created_at'].'</td>';
                    echo '<td>'.$order['status'].'</td>';
                    echo '</tr>';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <nav>
            <ul class="pagination">
                <li>
                    <a href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li>
                    <a href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>