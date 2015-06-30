<?php
/**
 * Created by PhpStorm.
 * User: pl
 * Date: 5/4/15
 * Time: 17:48
 */
include('adminnav.php');
?>
<script>
    $(function(){
        $("#selectcategory").change(function(){
            if ($("#selectcategory").val()!=""){
                console.log($("#selectcategory").val());
                $("#addcategory").prop('disabled', true).val("");
            } else {
                $("#addcategory").prop('disabled', false);
            }
        })
    })
</script>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form method="post" action="<?=base_url()?>products/add_new_product" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea rows="5" class="form-control" id="description" name="description"></textarea>
                </div>
                <div class="form-group">
                    <label for="selectcategory">Categories</label>
                    <select id="selectcategory" class="form-control" name="category">
                        <?php
                        echo '<option selected></option>';
                        foreach($categories as $category){
                            echo '<option value="'.$category['name'].'">'.$category['name'].'</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="addcategory">Or add new category:</label>
                    <input type="text" id="addcategory" class="form-control" name="category">
                </div>
                <div class="col-xs-6 form-group">
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" class="form-control">
                </div>
                <div class="col-xs-6 form-group">
                    <label for="price">Price:</label>
                    <input type="text" id="price" name="price" class="form-control">
                </div>
                <div class="form-group">
                    <label for="uploadimage">Upload Images</label>
                    <input type="file" id="uploadimage" name="userfile[]" multiple="multiple">
                </div>
                <button type="submit" class="btn btn-primary">New Product</button>
                <button type="reset" class="btn btn-default pull-right">Cancel</button>
            </form>
            <?=$this->session->flashdata('errors');?>
        </div>
    </div>
</div>

