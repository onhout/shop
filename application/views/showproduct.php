<?php
include('nav.php');
?>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <?
                $tempStr = substr($product['image_link'], 0, -2);
                $imgs = explode(', ', $tempStr);
                for ($i=0; $i<count($imgs); $i++){
                    echo '<img width="300px" src="'.base_url().$imgs[$i].'">';
                }
            ?>
        </div>
        <div class="col-md-5">
            <h1><?=$product['name']?></h1>
            <hr>
            <h4 class="text-success">Price: <span>$<?=$product['price']?></span></h4>
            <hr>
            <p><?=$product['description']?></p>
        </div>
        <div class="col-md-3">
            <div class="thumbnail">
                <h3 class="text-center">Add to cart</h3>
                <p class="text-center">$<?=$product['price']?></p>
                <form action="<?=base_url()?>carts/add_to_cart" method="post">
                    <input type="hidden" value="<?=$product['id']?>" name="itemID">
                    <div class="form-group text-center">
                        <label for="quantity">Quantity: </label>
                        <select id="quantity" class="form-control-static" name="quantity">
                            <? for($i=0; $i<10; $i++){
                                echo '<option value="'.($i+1).'">'.($i+1).'</option>';
                            }?>
                        </select>
                        <hr>
                        <button class="btn btn-primary center-block form-control">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>