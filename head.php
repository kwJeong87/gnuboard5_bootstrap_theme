<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH.'/head.sub.php');

?>
<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="<?php echo G5_URL?>"><?php echo $config['cf_title']; ?> 포트폴리오</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
        data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control form-control-dark w-100" type="text" name="outStx" placeholder="검색어를 입력해주세요" aria-label="Search">
    <ul class="navbar-nav px-3" style="flex-direction:row">
        <li class="nav-item text-nowrap">
            <a href="javascript:fsearchbox_submit()" class="nav-link"><i class="bi bi-search"></i> 검색</a>
        </li>
    </ul>
    <form name="fsearchbox" method="get" action="<?php echo G5_BBS_URL ?>/search.php">
    <input type="hidden" name="sfl" value="wr_subject">
    <input type="hidden" name="sop" value="or">
    <input type="hidden" name="stx" value="">
    </form>
    <script>
        document.querySelector('input[name=outStx]').addEventListener("keydown", function(event) {
            // If the user presses the "Enter" key on the keyboard
            if (event.key === "Enter") {
                // Cancel the default action, if needed
                event.preventDefault();
                // Trigger the button element with a click
                fsearchbox_submit();
            }
        });

        function fsearchbox_submit(){
            var f = document.querySelector('form[name=fsearchbox]');
            var outStx = document.querySelector('input[name=outStx]');
            var outStxValue = outStx.value.trim();
            if (outStxValue.length < 2) {
                alert("검색어는 두글자 이상 입력하십시오.");
                outStx.select();
                outStx.focus();
                return false;
            }

            // 검색에 많은 부하가 걸리는 경우 이 주석을 제거하세요.
            var cnt = 0;
            for (var i = 0; i < outStxValue.length; i++) {
                if (outStxValue.charAt(i) == ' ')
                    cnt++;
            }

            if (cnt > 1) {
                alert("빠른 검색을 위하여 검색어에 공백은 한개만 입력할 수 있습니다.");
                outStx.select();
                outStx.focus();
                return false;
            }

            f.stx.value = outStxValue;
            f.submit();
        }
    </script>
</nav>
<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="sidebar-sticky pt-3">
                <ul class="nav flex-column">
                    <?php
                        $menu_datas = get_menu_db(0, true);
                        $gnb_zindex = 999; // gnb_1dli z-index 값 설정용
                        $i = 0;                    
                        foreach( $menu_datas as $row ){
                            if( empty($row) ) continue;
                            $add_class = (isset($row['sub']) && $row['sub']) ? 'dropdown' : '';
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>">
                        <?php
                        $icon = '';
                        switch($row['me_name']){
                            case '영화' : $icon = '<i class="bi bi-film"></i>';
                            break;
                            case '드라마' : $icon = '<i class="bi bi-tv"></i>';
                            break;
                            case '예능' : $icon = '<i class="bi bi-camera-video"></i>';
                            break;
                        }
                        ?>
                        <?php echo $icon ?>
                        <?php echo $row['me_name'] ?>
                        </a>
                    </li>
                    <?php $i++;}   //end foreach $row ?>
                </ul>
                <ul class="nav flex-column mt-3">
                    <?php if ($is_member) {  ?>
                        <li class="nav-item">
                            <a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=<?php echo G5_BBS_URL ?>/register_form.php" class="nav-link">정보수정</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo G5_BBS_URL ?>/logout.php" class="nav-link pl-3">로그아웃</a>
                        </li>
                        <?php if ($is_admin) {  ?>
                            <li class="nav-item">
                                <a href="<?php echo correct_goto_url(G5_ADMIN_URL); ?>" class="nav-link pl-3">관리자</a>
                            </li>
                        <?php }  ?>
                    <?php } else {  ?>
                        <li class="nav-item">
                            <a href="<?php echo G5_BBS_URL ?>/register.php" class="nav-link">회원가입</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo G5_BBS_URL ?>/login.php" class="nav-link pl-3">로그인</a>
                        </li>
                    <?php }  ?>
                </ul>
            </div>
        </nav>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
