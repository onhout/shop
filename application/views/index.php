<?php

include('nav.php');
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="3"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="4"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <?
                    $random_array = [];
                    for ($i =0; $i<5; $i++){
                        $random = rand(0, count($all_products)-1);
                        for($j=0; $j<count($random_array); $j++){
                            if ($random_array[$j]==$random){
                                $random=rand(0, count($all_products)-1);
                            }
                        }
                        array_push($random_array, $random);
                    }
                    echo '<div class="item active">';
                    echo '<a href="'.base_url().'/show/'.$all_products[$random_array[0]]['id'].'">';
                    echo '<img src="'.base_url().explode(', ', $all_products[$random_array[0]]['image_link'])[0].'">';
                    echo '</a>';
                    echo '<div class="carousel-caption"><h2 class="text-info">'.$all_products[$random_array[0]]['name'].' ONLY $'.$all_products[$random_array[0]]['price'].'!</h2></div>';
                    echo '</div>';
                    echo '<div class="item">';
                    echo '<a href="'.base_url().'/show/'.$all_products[$random_array[1]]['id'].'">';
                    echo '<img src="'.base_url().explode(', ', $all_products[$random_array[1]]['image_link'])[0].'" alt="...">';
                    echo '</a>';
                    echo '<div class="carousel-caption"><h2 class="text-info">'.$all_products[$random_array[1]]['name'].' ONLY $'.$all_products[$random_array[1]]['price'].'!</h2></div>';
                    echo '</div>';
                    echo '<div class="item">';
                    echo '<a href="'.base_url().'/show/'.$all_products[$random_array[2]]['id'].'">';
                    echo '<img src="'.base_url().explode(', ', $all_products[$random_array[2]]['image_link'])[0].'" alt="...">';
                    echo '</a>';
                    echo '<div class="carousel-caption"><h2 class="text-info">'.$all_products[$random_array[2]]['name'].' ONLY $'.$all_products[$random_array[2]]['price'].'!</h2></div>';
                    echo '</div>';
                    echo '<div class="item">';
                    echo '<a href="'.base_url().'/show/'.$all_products[$random_array[3]]['id'].'">';
                    echo '<img src="'.base_url().explode(', ', $all_products[$random_array[3]]['image_link'])[0].'" alt="...">';
                    echo '</a>';
                    echo '<div class="carousel-caption"><h2 class="text-info">'.$all_products[$random_array[3]]['name'].' ONLY $'.$all_products[$random_array[3]]['price'].'!</h2></div>';
                    echo '</div>';
                    echo '<div class="item">';
                    echo '<a href="'.base_url().'/show/'.$all_products[$random_array[4]]['id'].'">';
                    echo '<img src="'.base_url().explode(', ', $all_products[$random_array[4]]['image_link'])[0].'" alt="...">';
                    echo '</a>';
                    echo '<div class="carousel-caption"><h2 class="text-info">'.$all_products[$random_array[4]]['name'].' ONLY $'.$all_products[$random_array[4]]['price'].'!</h2></div>';
                    echo '</div>';
                    ?>
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
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

        </div>



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