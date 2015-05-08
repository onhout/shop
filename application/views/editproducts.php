<?php
/**
 * Created by PhpStorm.
 * User: pl
 * Date: 5/6/15
 * Time: 13:17
 */

include('adminnav.php');

?>
<script>
    $(function(){
        $("#selectcategory").change(function(){
            if ($("#selectcategory").val()!=""){
                $("#addcategory").prop('disabled', true).val("");
            } else {
                $("#addcategory").prop('disabled', false);
            }
        })
    })
</script>

<div class="container">
    <div class="col-md-8 col-md-offset-2">
        <div class="imagegroup" style="display: inline-block;">
            <?php
            $imagelinks = (explode(', ', $product['image_link']));
            foreach($imagelinks as $link){
                if ($link !==""){
                    echo '<img src="'.base_url().$link.'" class="img-rounded col-sm-6" >';
                }
            }
            ?>
        </div>
        <form action="<?=base_url()?>products/update_product" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?=$product['product_name']?>" readonly>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea rows="5" class="form-control" id="description" name="description"><?=$product['description']?></textarea>
            </div>
            <div class="form-group">
                <label for="selectcategory">Categories</label>
                <select id="selectcategory" class="form-control" name="category">
                    <?php
                    echo '<option></option>';
                    foreach($categories as $category){
                        echo '<option value="'.$category['name'].'" ';
                        if ($category['name'] == $product['category_name']){
                            echo 'selected';
                        }
                        echo '>'.$category['name'].'</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="addcategory">Or add new category:</label>
                <input type="text" id="addcategory" class="form-control" name="category" disabled>
            </div>
            <div class="col-xs-6 form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" class="form-control" value="<?=$product['quantity']?>">
            </div>
            <div class="col-xs-6 form-group">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" class="form-control" value="<?=$product['price']?>">
            </div>
            <div class="form-group">
                <label for="uploadimage">Upload Images</label>
                <input type="file" id="uploadimage" name="userfile[]" multiple="multiple">
            </div>
            <button type="submit" class="btn btn-primary">Update Product</button>
            <button type="reset" class="btn btn-default pull-right">Cancel</button>
        </form>
    </div>
</div>