<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
$list_count = (is_array($list) && $list) ? count($list) : 0;

?>
<div class="card">
    <div class="card-header">
        <a href="<?php echo get_pretty_url($bo_table); ?>"><?php echo $bo_subject ?></a>
    </div>
    <div class="card-body">
        <ul class="list-unstyled">
        <?php for ($i=0; $i<$list_count; $i++) {  ?>
            <li>
                <?php
                echo "<a href=\"".get_pretty_url($bo_table, $list[$i]['wr_id'])."\"> ";
                echo $list[$i]['subject'];
                echo "</a>";
                ?>
            </li>
        <?php }  ?>
        <?php if ($list_count == 0) { //게시물이 없을 때  ?>
            <li>게시물이 없습니다.</li>
        <?php }  ?>
        </ul>
        <p class="text-muted">
            <a href="<?php echo get_pretty_url($bo_table); ?>"><?php echo $bo_subject ?>더보기</a>
        </p>
    </div>
</div>