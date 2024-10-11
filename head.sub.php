<?php
// 이 파일은 새로운 파일 생성시 반드시 포함되어야 함
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$g5_debug['php']['begin_time'] = $begin_time = get_microtime();

if (!isset($g5['title'])) {
    $g5['title'] = $config['cf_title'];
    $g5_head_title = $g5['title'];
}
else {
    // 상태바에 표시될 제목
    $g5_head_title = implode(' | ', array_filter(array($g5['title'], $config['cf_title'])));
}

$g5['title'] = strip_tags($g5['title']);
$g5_head_title = strip_tags($g5_head_title);

// 현재 접속자
// 게시판 제목에 ' 포함되면 오류 발생
$g5['lo_location'] = addslashes($g5['title']);
if (!$g5['lo_location'])
    $g5['lo_location'] = addslashes(clean_xss_tags($_SERVER['REQUEST_URI']));
$g5['lo_url'] = addslashes(clean_xss_tags($_SERVER['REQUEST_URI']));
if (strstr($g5['lo_url'], '/'.G5_ADMIN_DIR.'/') || $is_admin == 'super') $g5['lo_url'] = '';

/*
// 만료된 페이지로 사용하시는 경우
header("Cache-Control: no-cache"); // HTTP/1.1
header("Expires: 0"); // rfc2616 - Section 14.21
header("Pragma: no-cache"); // HTTP/1.0
*/


?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- 관리자에서 등록한 메타태그 -->
    <?php if($config['cf_add_meta']) echo $config['cf_add_meta'].PHP_EOL;?>
    <script>
    // 자바스크립트에서 사용하는 전역변수 선언
    var g5_url       = "<?php echo G5_URL ?>";
    var g5_bbs_url   = "<?php echo G5_BBS_URL ?>";
    var g5_is_member = "<?php echo isset($is_member)?$is_member:''; ?>";
    var g5_is_admin  = "<?php echo isset($is_admin)?$is_admin:''; ?>";
    var g5_is_mobile = "<?php echo G5_IS_MOBILE ?>";
    var g5_bo_table  = "<?php echo isset($bo_table)?$bo_table:''; ?>";
    var g5_sca       = "<?php echo isset($sca)?$sca:''; ?>";
    var g5_editor    = "<?php echo ($config['cf_editor'] && $board['bo_use_dhtml_editor'])?$config['cf_editor']:''; ?>";
    var g5_cookie_domain = "<?php echo G5_COOKIE_DOMAIN ?>";
    <?php if(defined('G5_USE_SHOP') && G5_USE_SHOP) { ?>
    var g5_shop_url = "<?php echo G5_SHOP_URL; ?>";
    <?php } ?>
    <?php if(defined('G5_IS_ADMIN')) { ?>
    var g5_admin_url = "<?php echo G5_ADMIN_URL; ?>";
    <?php } ?>
    </script>
    <?php add_javascript('<script src="'.G5_JS_URL.'/common.js?ver='.G5_JS_VER.'"></script>', 0);?>

    <title><?php echo $g5_head_title; ?></title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL?>/bootstrap.min.css">
    <?php if($g5['title']=='로그인') :?>
    <link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL?>/signin.css">
    <?php else :?>
    <link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL?>/dashboard.css">
    <?php endif;?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- jQuery & Bootstrap -->
    <script src="<?php echo G5_THEME_JS_URL?>/jquery-3.5.1.min.js"></script>
    <script src="<?php echo G5_THEME_JS_URL?>/bootstrap.bundle.min.js"></script>
</head>
<body <?php if($g5['title']=='로그인') echo 'class="text-center"';?>>        