<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 캡챠 HTML 코드 출력
function captcha_html2($class="captcha")
{
    if(is_mobile())
        $class .= ' m_captcha';

    $html = "\n".'<script>var g5_captcha_url  = "'.G5_CAPTCHA_URL.'";</script>';
    //$html .= "\n".'<script>var g5_captcha_path = "'.G5_CAPTCHA_PATH.'";</script>';
    $html .= "\n".'<script src="'.G5_CAPTCHA_URL.'/kcaptcha.js"></script>';
    $html .= "\n".'<img src="'.G5_CAPTCHA_URL.'/img/dot.gif" alt="" id="captcha_img">';
    $html .= '<div class="input-group mb-3">';
    $html .= '<input type="text" class="form-control" placeholder="자동등록방지 숫자를 입력하세요" name="captcha_key" size="6" max-length="6" id="captcha_key" required>';
    $html .= '<div class="input-group-append">
                            <button type="button" class="btn btn-default" id="captcha_mp3">
                                <span class="fas fa-play"></span>
                            </button>
                            <button type="button" class="btn btn-default" id="captcha_reload">
                                <span class="fas fa-redo-alt"></span>
                            </button>
                        </div>';
    $html .= '</div>';
    return $html;
}

?>

    <div class="login-box">
        <div class="login-logo">
			<a href="/"><b>JEONG</b>87</a>
		</div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg text-xs">회원가입 시 등록하신 이메일 주소를 입력해 주세요.<br>
                해당 이메일로 아이디와 비밀번호 정보를 보내드립니다.</p>

                <form name="fpasswordlost" action="<?php echo $action_url ?>" method="post">
                    <input type="hidden" name="cert_no" value="">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="mb_email" size="30" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    
                        <?php echo captcha_html2();  ?>
                    
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">인증메일 보내기</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <p class="mt-3 mb-1">
                    <a href="/bbs/login.php">로그인</a>
                </p>
                <p class="mb-0">
                    <a href="/bbs/register.php" class="text-center">회원가입</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <script>
    function fpasswordlost_submit(f)
    {
        <?php echo chk_captcha_js();  ?>

        return true;
    }
    </script>