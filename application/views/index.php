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
                    <li role="presentation" class="active"><a href="#">All <span class="badge pull-right"><?= count($products)?></span></a></li>
                    <?php
                        foreach($categories as $category){
                            echo '<li role="presentation"><a href="#">'.$category['name'].'<span class="badge pull-right">';
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
                    echo '<img src="'.base_url().$imagelink[0].'" style="height:150px;">';
                    echo '<h4>'.$products[$i]['name'].'<span style="position: absolute; top:5px; left:20px; background-color:white">$'.$products[$i]['price'].'</span></h4>';
                    echo '</div>';
                    echo '</div>';
                }
            echo '</div>';
            ?>
            <nav>
                <ul class="pagination">
                    <li>
                        <a href="<?=base_url().'products/'; echo ($pagenum-1==0)?1:($pagenum-1)?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php for ($i=0; $i<$pages; $i++){
                        echo ($pagenum == ($i+1))?'<li class="active"><a href="'.base_url().'products/'.($i+1).'">'.($i+1).'</a></li>':
                            '<li><a href="'.base_url().'products/'.($i+1).'">'.($i+1).'</a></li>';

                    }
                    ?>
                    <li>
                        <a href="<?=base_url().'products/'; echo ($pagenum+1>$pages)?$pagenum:($pagenum+1)?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>