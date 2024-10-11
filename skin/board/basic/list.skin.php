<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 3;

if ($is_checkbox) $colspan++;

?>
<!-- 게시판 목록 시작 { -->
<div class="row mt-2">
    <div class="col-12">
        <div class="card rounded-0">
            <div class="card-body p-0">
                <form name="fboardlist" id="fboardlist" action="<?php echo G5_BBS_URL; ?>/board_list_update.php" onsubmit="return fboardlist_submit(this,false);" method="post">
                    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
                    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
                    <input type="hidden" name="stx" value="<?php echo $stx ?>">
                    <input type="hidden" name="spt" value="<?php echo $spt ?>">
                    <input type="hidden" name="sca" value="<?php echo $sca ?>">
                    <input type="hidden" name="sst" value="<?php echo $sst ?>">
                    <input type="hidden" name="sod" value="<?php echo $sod ?>">
                    <input type="hidden" name="page" value="<?php echo $page ?>">
                    <input type="hidden" name="sw" value="">
                    <div class="table-responsive-sm">
                        <table class="table table-sm mb-0">
                            <thead>
                            <tr>
                                <?php if ($is_checkbox) { ?>
                                <th scope="col" class="all_chk chk_box">
                                    <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);" class="selec_chk">
                                    <label for="chkall">
                                        <span></span>
                                    </label>
                                </th>
                                <?php } ?>
                                <th scope="col">번호</th>
                                <th scope="col">제목</th>
                                <th scope="col">조회</th>
                                <th scope="col">날짜</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            for ($i=0; $i<count($list); $i++) {
                            ?>
                            <tr>
                                <?php if ($is_checkbox) { ?>
                                <td>
                                    <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>" class="selec_chk">
                                    <label for="chk_wr_id_<?php echo $i ?>">
                                        <span></span>
                                    </label>
                                </td>
                                <?php } ?>
                                <td>
                                <?php
                                    if ($list[$i]['is_notice']) // 공지사항
                                        echo '<strong class="notice_icon">공지</strong>';
                                    else if ($wr_id == $list[$i]['wr_id'])
                                        echo "<span class=\"bo_current\">열람중</span>";
                                    else
                                        echo $list[$i]['num'];
                                    ?>
                                </td>
                                <td>
                                    <a href="<?php echo $list[$i]['href'] ?>">
                                        <?php echo $list[$i]['subject'] ?>
                                    </a>
                                </td>
                                <td><?php echo $list[$i]['wr_hit'] ?></td>
                                <td><?php echo $list[$i]['wr_2'] ?></td>
                            </tr>
                            <?php } ?>                        
                            </tbody>
                            <?php if (count($list) == 0) { echo '<tr><td colspan="'.$colspan.'">게시물이 없습니다.</td></tr>'; } ?>
                        </table>
                    </div>                    
                </form>
            </div>
        </div>        
    </div>
</div>
<div class="row mb-2 mt-2">
    <div class="col-12 text-right ">
        <div class="btn-group btn-group-sm">                        
            <?php if ($is_admin == 'super' || $is_auth) {  ?>
                <?php if ($is_checkbox) { ?>	
                <button type="button" value="선택삭제" onclick="fboardlist_submit(document.fboardlist,this.value)" class="btn btn-secondary">
                    <i class="fas fa-trash" aria-hidden="true"></i> 선택삭제
                </button>
                <button type="button" value="선택복사" onclick="fboardlist_submit(document.fboardlist,this.value)" class="btn btn-secondary">
                    <i class="far fa-copy" aria-hidden="true"></i> 선택복사
                </button>
                <button type="button" value="선택이동" onclick="fboardlist_submit(document.fboardlist,this.value)" class="btn btn-secondary">
                    <i class="fas fa-arrows-alt" aria-hidden="true"></i> 선택이동
                </button>
                <?php } ?>
            <?php }  ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <!-- 페이지 -->
        <div class="btn-toolbar">
            <?php echo $write_pages; ?>
        </div>
        
        <!-- 페이지 -->        
    </div>
</div>
<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fboardlist;
    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f,pressed) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(pressed == "선택복사") {
        select_copy("copy");
        return;
    }

    if(pressed == "선택이동") {
        select_copy("move");
        return;
    }

    if(pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;

        f.removeAttribute("target");    
        f.action = g5_bbs_url+"/board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == "copy")
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = g5_bbs_url+"/move.php";
    f.submit();
}

</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->