<?php
if (!defined('_INDEX_')) define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_THEME_PATH.'/head.php');// echo 'thema index파일';
include_once(G5_LIB_PATH.'/latest.lib.php');
?>
<div class="row mt-3">
    <div class="col-12">
        <div class="alert alert-primary" role="alert">
            안녕하세요. 여기는 JEONG87 포트폴리오용 싸이트 입니다. Bootstrap & 그누보드5로 제작 되였습니다.
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <?php echo latest('theme/carousel', 't1', 5);	?> 
    </div>
</div>
<div class="row mt-2 mb-5">
    <div class="col-6">
        <?php echo latest('theme/basic', 't2', 5);	?>
    </div>
    <div class="col-6">
        <?php echo latest('theme/basic', 't3', 5);	?>
    </div>
</div>
<?php
include_once(G5_THEME_PATH.'/tail.php');