<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가


add_javascript('<script src="'.G5_JS_URL.'/jquery.register_form.js"></script>', 0);


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

<!-- 회원정보 입력/수정 시작 { -->
<div class="row">
    <div class="col-12">
        <!-- form start -->
        <form id="fregisterform" name="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" name="w" value="<?php echo $w ?>">
            <input type="hidden" name="url" value="<?php echo $urlencode ?>">
            <input type="hidden" name="agree" value="<?php echo $agree ?>">
            <input type="hidden" name="agree2" value="<?php echo $agree2 ?>">
            <input type="hidden" name="cert_type" value="<?php echo $member['mb_certify']; ?>">
            <input type="hidden" name="cert_no" value="">
            <div class="card mt-2">
                <div class="card-header">사이트 이용정보 입력</div>
                <!-- /.card-header -->							
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">아이디</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="mb_id" value="<?php echo $member['mb_id'] ?>" minlength="3" maxlength="20" placeholder="아이디" <?php echo $required ?> <?php echo $readonly ?> id="reg_mb_id">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">비밀번호 (필수)</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="mb_password" minlength="3" maxlength="20" placeholder="비밀번호" <?php echo $required ?>>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">비밀번호 확인 (필수)</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="mb_password_re" minlength="3" maxlength="20" placeholder="비밀번호 확인" <?php echo $required ?>>
                        </div>
                    </div>
                </div>						
            </div>
            <div class="card mt-2">
                <div class="card-header">개인정보 입력</div>
                <!-- /.card-header -->							
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">이름 (필수)</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="mb_name" value="<?php echo $member['mb_name'] ?>"  size="10" placeholder="이름" value="<?php echo get_text($member['mb_name']) ?>" <?php echo $required ?> <?php echo $readonly; ?>>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">닉네임 (필수)</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="mb_nick" minlength="3" maxlength="20" placeholder="닉네임" <?php echo $required ?> value="<?php echo isset($member['mb_nick'])?get_text($member['mb_nick']):''; ?>" id="reg_mb_nick">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">E-mail (필수)</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="mb_email" value="<?php echo isset($member['mb_email'])?$member['mb_email']:''; ?>" size="70" maxlength="100" placeholder="E-mail" <?php echo $required ?> id="reg_mb_email">
                        </div>
                    </div>
                </div>						
            </div>
            <div class="card mt-2">
                <div class="card-header">기타 개인설정</div>
                <!-- /.card-header -->							
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">메일링서비스</label>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input type="checkbox" name="mb_mailling" value="1" id="reg_mb_mailling" <?php echo ($w=='' || $member['mb_mailling'])?'checked':''; ?> class="form-check-input" id="Check1">
                                <label class="form-check-label" for="Check1">정보 메일을 받겠습니다.</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">자동등록방지</label>
                        <div class="col-sm-10">
                            <?php echo captcha_html2(); ?>
                        </div>
                    </div>
                </div>						
            </div>
            <div class="mt-2 mb-2 text-right">
                <a href="<?php echo G5_URL ?>" class="btn btn-normal">취소</a>
                <button type="submit" id="btn_submit" class="btn btn-primary" accesskey="s"><?php echo $w==''?'회원가입':'정보수정'; ?></button>					
            </div>						
        </form>
    </div>			
</div>

<script>
// submit 최종 폼체크
function fregisterform_submit(f)
{
    // 회원아이디 검사
    if (f.w.value == "") {
        var msg = reg_mb_id_check();
        if (msg) {
            alert(msg);
            f.mb_id.select();
            return false;
        }
    }

    if (f.w.value == "") {
        if (f.mb_password.value.length < 3) {
            alert("비밀번호를 3글자 이상 입력하십시오.");
            f.mb_password.focus();
            return false;
        }
    }

    if (f.mb_password.value != f.mb_password_re.value) {
        alert("비밀번호가 같지 않습니다.");
        f.mb_password_re.focus();
        return false;
    }

    if (f.mb_password.value.length > 0) {
        if (f.mb_password_re.value.length < 3) {
            alert("비밀번호를 3글자 이상 입력하십시오.");
            f.mb_password_re.focus();
            return false;
        }
    }

    // 이름 검사
    if (f.w.value=="") {
        if (f.mb_name.value.length < 1) {
            alert("이름을 입력하십시오.");
            f.mb_name.focus();
            return false;
        }

        /*
        var pattern = /([^가-힣\x20])/i;
        if (pattern.test(f.mb_name.value)) {
            alert("이름은 한글로 입력하십시오.");
            f.mb_name.select();
            return false;
        }
        */
    }

    // 닉네임 검사
    if ((f.w.value == "") || (f.w.value == "u" && f.mb_nick.defaultValue != f.mb_nick.value)) {
        var msg = reg_mb_nick_check();
        if (msg) {
            alert(msg);
            f.mb_nick.select();
            return false;
        }
    }

    // E-mail 검사
    if ((f.w.value == "") || (f.w.value == "u" && f.mb_email.defaultValue != f.mb_email.value)) {
        var msg = reg_mb_email_check();
        if (msg) {
            alert(msg);
            f.mb_email.select();
            return false;
        }
    }

    <?php echo chk_captcha_js();  ?>
    document.getElementById("btn_submit").disabled = "disabled";
    return true;
}
</script>

<!-- } 회원정보 입력/수정 끝 -->