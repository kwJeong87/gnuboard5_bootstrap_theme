<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- 회원가입약관 동의 시작 { -->
<div class="row">                        
    <div class="col-12">
        <div class="alert alert-danger alert-dismissible mt-2 mb-2">
            <i class="fa fa-check-circle" aria-hidden="true"></i> 회원가입약관 및 개인정보 수집 및 이용의 내용에 동의하셔야 회원가입 하실 수 있습니다.
        </div>
        <form  name="fregister" id="fregister" action="<?php echo $register_action_url ?>" onsubmit="return fregister_submit(this);" method="POST" autocomplete="off">
            <div class="card">
                <div class="card-header">회원가입약관</div>
                <div class="card-body">                                        
                    <div class="form-group">
                        <textarea class="form-control" readonly><?php echo get_text($config['cf_stipulation']) ?></textarea>
                    </div>
                    <div class="form-group mb-0">
                        <fieldset class="fregister_agree">
                            <div class="form-check">
                                <input type="checkbox" name="agree" value="1" id="agree11" class="form-check-input">
                                <label for="agree11"><span></span><b class="sound_only">회원가입약관의 내용에 동의합니다.</b></label>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>

            <div class="card mt-2">
                <div class="card-header">개인정보 수집 및 이용</div>
                <div class="card-body">
                    <table class="table table-sm table-bordered">
                        <thead>
                        <tr>
                            <th>목적</th>
                            <th>항목</th>
                            <th>보유기간</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>이용자 식별 및 본인여부 확인</td>
                            <td>아이디, 이름, 비밀번호<?php echo ($config['cf_cert_use'])? ", 생년월일, 휴대폰 번호(본인인증 할 때만, 아이핀 제외), 암호화된 개인식별부호(CI)" : ""; ?></td>
                            <td>회원 탈퇴 시까지</td>
                        </tr>
                        <tr>
                            <td>고객서비스 이용에 관한 통지,<br>CS대응을 위한 이용자 식별</td>
                            <td>연락처 (이메일, 휴대전화번호)</td>
                            <td>회원 탈퇴 시까지</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="form-group mb-0 mt-2">
                        <fieldset class="fregister_agree">
                            <div class="form-check">
                                <input type="checkbox" name="agree2" value="1" id="agree21" class="form-check-input">
                                <label for="agree21"><span></span><b class="sound_only">개인정보 수집 및 이용의 내용에 동의합니다.</b></label>
                            </div>
                        </fieldset>
                    </div>                                        
                </div>
            </div>

            <div id="fregister_chkall" class="chk_all fregister_agree form-group text-right">
                <div class="form-check">
                    <input type="checkbox" name="chk_all" id="chk_all" class="form-check-input">
                    <label for="chk_all"><span></span>회원가입 약관에 모두 동의합니다</label>
                </div>
            </div>
                
            <div class="btn_confirm mb-2 text-right">
                <a href="<?php echo G5_URL ?>" class="btn_close btn btn-light">취소</a>
                <button type="submit" class="btn_submit btn btn-primary">회원가입</button>
            </div>

        </form>
    </div>
</div>
<script>
function fregister_submit(f)
{
    if (!f.agree.checked) {
        alert("회원가입약관의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
        f.agree.focus();
        return false;
    }

    if (!f.agree2.checked) {
        alert("개인정보 수집 및 이용의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
        f.agree2.focus();
        return false;
    }

    return true;
}

jQuery(function($){
    // 모두선택
    $("input[name=chk_all]").click(function() {
        if ($(this).prop('checked')) {
            $("input[name^=agree]").prop('checked', true);
        } else {
            $("input[name^=agree]").prop("checked", false);
        }
    });
});

</script>
<!-- } 회원가입 약관 동의 끝 -->
