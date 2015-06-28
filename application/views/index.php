<?php

include('nav.php');
?>

<div class="container">
    <div class="row">
        <div class="col-md-2 thumbnail">
            <form>
                <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
                    <input type="text" class="form-control" placeholder="Search" aria-describedby="basic-addon1">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Go!</button>
                </span>
                </div>
            </form>
            <div class="leftnav" style="margin-top: 20px;">
                <h4 class="text-center">Categories</h4>
                <ul class="nav nav-pills nav-stacked">
                    <?php
                    echo ($currentCategory == 'all')? '<li role="presentation" class="active"><a href="'.base_url().'products/all/1">All <span class="badge pull-right">'.count($this->product->get_all_products()).'</span></a></li>':
                    '<li role="presentation"><a href="'.base_url().'products/all/1">All <span class="badge pull-right">'.count($this->product->get_all_products()).'</span></a></li>';
                        foreach($categories as $category){
                            echo ($currentCategory == $category['name'])?'<li role="presentation" class="active"><a href="'.base_url().'products/'.$category['name'].'/1">'.$category['name'].'<span class="badge pull-right">':
                                '<li role="presentation"><a href="'.base_url().'products/'.$category['name'].'/1">'.$category['name'].'<span class="badge pull-right">';
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
            </div>
        </div>
        <div class="col-md-9">

            <?php
            function determingitemcount($start, $end, $current){
                return ($end-$start < 12)?$end:$current;
            }
            echo '<div class="row">';
                for ($i=$startingCount; $i<determingitemcount($startingCount, $totalCount, $currentCount); $i++){
                    echo '<div class="col-sm-3">';
                    echo '<div class="thumbnail">';
                    $imagelink = explode(', ', $products[$i]['image_link']);
                    echo '<a href="'.base_url().'show/'.$products[$i]['id'].'"><img src="'.base_url().$imagelink[0].'" style="height:150px;"></a>';
                    echo '<h4>'.$products[$i]['name'].'<span style="position: absolute; top:5px; left:20px; background-color:white">$'.$products[$i]['price'].'</span></h4>';
                    echo '</div>';
                    echo '</div>';
                }
            echo '</div>';
            ?>
            <nav>
                <ul class="pagination">
                    <li>
                        <a href="<?=base_url().'products/'; echo $currentCategory.'/'; echo ($pagenum-1==0)?1:($pagenum-1)?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php for ($i=0; $i<$pages; $i++){
                        echo ($pagenum == ($i+1))?'<li class="active"><a href="'.base_url().'products/'.$currentCategory.'/'.($i+1).'">'.($i+1).'</a></li>':
                            '<li><a href="'.base_url().'products/'.$currentCategory.'/'.($i+1).'">'.($i+1).'</a></li>';
                    }
                    ?>
                    <li>
                        <a href="<?=base_url().'products/'; echo $currentCategory.'/'; echo ($pagenum+1>$pages)?$pagenum:($pagenum+1)?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- Modal -->
            <!--<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                        </div>
                        <div class="modal-body">
                            <script>
                                var data = <?/*=json_encode($products)*/?>
                            </script>
                            <?/*print_r($products)*/?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Add to cart</button>
                        </div>
                    </div>
                </div>
            </div>-->

        </div>
    </div>
</div>