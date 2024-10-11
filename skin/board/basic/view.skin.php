<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>
<!-- 게시물 읽기 시작 { -->
<h2 class="pt-3 pb-2 border-bottom">
    <?php
        if ($category_name) echo $view['ca_name']; // 분류 출력 끝
        echo cut_str(get_text($view['wr_subject']), 70); // 글제목 출력 
    ?>
</h2>
<div class="row mt-2">
    <div class="col-12">
        <?php $torrent = json_decode($view['wr_1'],true);?>
        <?php foreach($torrent as $t) :?>
        <div class="card mb-1">
            <div class="card-header">
                토렌트파일 :
                <a href="<?php echo $t['down_link']?>" target="_blank"><?php echo $view['wr_subject'].'.torrent'?> (<?php echo $t['size']?>)</a>
            </div>
            <div class="card-header">
                마그넷링크 :
                <?php $magnet_text = end(explode(':', $t['magnet_link']));?>
                <a href="<?php echo $t['magnet_link']?>"><?php echo $magnet_text?></a>
            </div>
        </div>
        <?php endforeach;?>
        <p class="mt-1">
            <?php
                $arr = explode('/',$view['wr_3']);
                if(count($arr)==5){
                    $imgUrl = ltrim($view['wr_3'],'.');
                    echo "<img src='{$imgUrl}' class='img-fluid'>";
                }
            ?>
        </p>
        <p>            
            <?php echo $view['content']; ?>
        </p>
        <ul class="list-inline text-muted card-text" style="font-size:12px">
            <li class="list-inline-item">
                작성자 : <?php echo $view['name'] ?>
            </li>
            <li class="list-inline-item">
                조회 : <i class="fa fa-eye" aria-hidden="true"></i> <?php echo number_format($view['wr_hit']) ?>회
            </li>
            <li class="list-inline-item">
                작성일 : <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $view['wr_2'] ?>
            </li>
        </ul>
    </div>
</div>

<div class="row mt-2 mb-2 text-right">
    <div class="col-12">        
        <div class="btn-group btn-group-sm">
            <a href="<?php echo $list_href ?>" class="btn btn-secondary">목록</a>
            <?php if ($prev_href || $next_href) { ?>                
                <?php if ($prev_href) { ?><a href="<?php echo $prev_href ?>" class="btn btn-secondary">이전글</a><?php } ?>
                <?php if ($next_href) { ?><a href="<?php echo $next_href ?>" class="btn btn-secondary">다음글</a><?php } ?>
            <?php } ?>
            <?php if($update_href || $delete_href || $copy_href || $move_href || $search_href) { ?>
                <?php if ($update_href) { ?><a href="<?php echo $update_href ?>" class="btn btn-secondary">수정<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><?php } ?>
                <?php if ($delete_href) { ?><a href="<?php echo $delete_href ?>" onclick="del(this.href); return false;" class="btn btn-secondary">삭제<i class="fa fa-trash-o" aria-hidden="true"></i></a><?php } ?>
                <?php if ($copy_href) { ?><a href="<?php echo $copy_href ?>" onclick="board_move(this.href); return false;" class="btn btn-secondary">복사<i class="fa fa-files-o" aria-hidden="true"></i></a><?php } ?>
                <?php if ($move_href) { ?><a href="<?php echo $move_href ?>" onclick="board_move(this.href); return false;" class="btn btn-secondary">이동<i class="fa fa-arrows" aria-hidden="true"></i></a><?php } ?>
            <?php } ?>
        </div>    
    </div>
</div>
<script>
function board_move(href)
{
    window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
}
</script>
<!-- } 게시글 읽기 끝 -->