<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$list_count = (is_array($list) && $list) ? count($list) : 0;

?>
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <?php for ($i=0; $i<$list_count; $i++) {  ?>
        <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i?>" <?php if($i==0) echo 'class="active"';?>></li>
        <?php }  ?>
    </ol>
    <div class="carousel-inner">
        <?php for ($i=0; $i<$list_count; $i++) {  ?>
        <div class="carousel-item border <?php if($i==0) echo 'active';?>">
            <img src="<?php echo $list[$i]['wr_3']?>" class="d-block w-100 rounded" style="height:500px;object-fit: cover;">
            <div class="carousel-caption d-none d-md-block" style="bottom:70px;background-color:rgba(50,50,50,0.7)">
                <h5><?php echo $list[$i]['wr_subject']?></h5>
            </div>
        </div>
        <?php }  ?>
        <?php if ($list_count == 0) { //게시물이 없을 때  ?>
        <p class="empty_li">게시물이 없습니다.</p>
        <?php }  ?>
    </div>
    <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </button>
</div>
<script>
    $('.carousel').carousel({
        interval: 3000
    })
</script>