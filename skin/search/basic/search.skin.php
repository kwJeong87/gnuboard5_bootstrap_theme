<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가


?>
<?php
    if ($stx) {
        if ($board_count) {
     ?>
<!-- 전체검색 시작 { -->
<div class="row mt-2">
    <div class="col-12">
        <div class="alert alert-primary" role="alert">
            <h2 class="h5"><strong><?php echo $stx ?></strong> 전체검색 결과</h2>
            <ul>
                <li>게시판 <?php echo $board_count ?>개</li>
                <li>게시물 <?php echo number_format($total_count) ?>개</li>
                <li><?php echo number_format($page) ?>/<?php echo number_format($total_page) ?> 페이지 열람 중</li>
            </ul>
        </div>
    </div>    
</div>
<div class="row mt-2">
    <div class="col-12">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a href="?<?php echo $search_query ?>&amp;gr_id=<?php echo $gr_id ?>" <?php echo $sch_all ?> >전체게시판</a>
            </li>
            <?php echo $str_board_list; ?>
        </ul>
    </div>    
</div>
<?php
    } else {
    ?>
<div class="empty_list">검색된 자료가 하나도 없습니다.</div>
<?php } }  ?>
    <?php if ($stx && $board_count) { ?><section class="sch_res_list"><?php }  ?>
    <?php
    $k=0;
    for ($idx=$table_index, $k=0; $idx<count($search_table) && $k<$rows; $idx++) {
     ?>
        <ul class="list-group mt-2">
        <?php
        for ($i=0; $i<count($list[$idx]) && $k<$rows; $i++, $k++) {
         ?>
            <li class="list-group-item">
                <div class="sch_tit">
                    <a href="<?php echo $list[$idx][$i]['href'] ?>&wr_id=<?php echo $list[$idx][$i]['wr_id'] ?>" target="_blank"><?php echo $list[$idx][$i]['subject'] ?></a>
                </div>
                <p><?php echo $list[$idx][$i]['content'] ?></p>
            </li>
        <?php }  ?>
        </ul>
    <?php }		//end for?>
    <?php if ($stx && $board_count) {  ?></section><?php }  ?>

    <?php echo $write_pages ?>

<!-- } 전체검색 끝 -->