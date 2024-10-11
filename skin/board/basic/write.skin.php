<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

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
<!-- 게시물 작성/수정 시작 { -->
<form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" class="mt-3">
    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <?php
    $option = '';
    $option_hidden = '';
    if ($is_notice || $is_html || $is_secret || $is_mail) { 
        $option = '';
        if ($is_notice) {
            $option .= PHP_EOL.'<input type="checkbox" id="notice" name="notice"  class="form-check-input" value="1" '.$notice_checked.'>'.PHP_EOL.'<label class="form-check-label" for="notice">공지</label>';
        }
        if ($is_html) {
            if ($is_dhtml_editor) {
                $option_hidden .= '<input type="hidden" value="html1" name="html" class="form-check-input">';
            } else {
                $option .= PHP_EOL.'<input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" class="form-check-input" value="'.$html_value.'" '.$html_checked.'>'.PHP_EOL.'<label class="form-check-label" for="html">html</label>';
            }
        }
        if ($is_secret) {
            if ($is_admin || $is_secret==1) {
                $option .= PHP_EOL.'<input type="checkbox" id="secret" name="secret"  class="form-check-input" value="secret" '.$secret_checked.'>'.PHP_EOL.'<label class="form-check-label" for="secret">비밀글</label>';
            } else {
                $option_hidden .= '<input type="hidden" name="secret" value="secret">';
            }
        }
        if ($is_mail) {
            $option .= PHP_EOL.'<input type="checkbox" id="mail" name="mail"  class="form-check-input" value="mail" '.$recv_email_checked.'>'.PHP_EOL.'<label class="form-check-label" for="mail">답변메일받기</label>';
        }
    }
    echo $option_hidden;
    ?>
    <?php if ($is_category) { ?>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">분류(필수)</label>
            <div class="col-sm-10">
                <select name="ca_name" id="ca_name" required class="form-control">
                    <option value="">분류를 선택하세요</option>
                    <?php echo $category_option ?>
                </select>
            </div>
        </div>
    <?php } ?>

    <?php if ($is_name) { ?>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">이름(필수)</label>
            <div class="col-sm-10">
                <input type="text" name="wr_name" value="<?php echo $name ?>" required class="form-control" placeholder="이름">
            </div>
        </div>
    <?php } ?>
    
    <?php if ($is_password) { ?>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">비밀번호(필수)</label>
            <div class="col-sm-10">
                <input type="password" name="wr_password" required class="form-control" placeholder="비밀번호">
            </div>
        </div>
    <?php } ?>
    
    <?php if ($is_email) { ?>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">이메일</label>
            <div class="col-sm-10">
                <input type="text" name="wr_email" value="<?php echo $email ?>" required class="form-control" placeholder="이메일">
            </div>
        </div>
    <?php } ?>                        
    
    <?php if ($is_homepage) { ?>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">홈페이지</label>
            <div class="col-sm-10">
                <input type="text" name="wr_homepage" value="<?php echo $homepage ?>" class="form-control" placeholder="홈페이지" maxlength="50">
            </div>
        </div>
    <?php } ?>                    
    
    <?php if ($option) { ?>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">옵션</label>
            <div class="col-sm-10">
                <div class="form-check">
                    <?php echo $option ?>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">제목(필수)</label>
        <div class="col-sm-10">
            <input type="text" name="wr_subject" value="<?php echo $subject ?>" class="form-control" placeholder="제목" maxlength="255" required>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">내용(필수)</label>
        <div class="col-sm-10">
            <textarea name="wr_content" rows="10" class="form-control"></textarea>
        </div>
    </div>

    
    <?php for ($i=1; $is_link && $i<=G5_LINK_COUNT; $i++) { ?>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">링크  #<?php echo $i ?></label>
            <div class="col-sm-10">
                <input type="text" name="wr_link<?php echo $i ?>" value="<?php if($w=="u"){ echo $write['wr_link'.$i]; } ?>" class="form-control">
            </div>
        </div>
    <?php } ?>

    <?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">파일 #<?php echo $i+1 ?></label>
            <div class="col-sm-10">
                <input type="file" name="bf_file[]" value="<?php if($w=="u"){ echo $write['wr_link'.$i]; } ?>">
                <?php if ($is_file_content) { ?>
                <input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="full_input frm_input" size="50" placeholder="파일 설명을 입력해주세요.">
                <?php } ?>
                <?php if($w == 'u' && $file[$i]['file']) { ?>
                <span class="file_del">
                    <input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
                </span>
                <?php } ?>
            </div>
        </div>
    <?php } ?>


    <?php if ($is_use_captcha) { //자동등록방지  ?>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">자동등록방지</label>
            <div class="col-sm-10">
                <?php echo captcha_html2()  ?>
            </div>
        </div>
    <?php } ?>

    <div class="form-group row">
        <div class="col-sm-12 text-right">
            <a href="<?php echo get_pretty_url($bo_table); ?>" class="btn btn-normal">취소</a>
            <button type="submit" id="btn_submit" accesskey="s" class="btn btn-primary">작성완료</button>
        </div>                            
    </div>
</form>
<script>
    <?php if($write_min || $write_max) { ?>
    // 글자수 제한
    var char_min = parseInt(<?php echo $write_min; ?>); // 최소
    var char_max = parseInt(<?php echo $write_max; ?>); // 최대
    check_byte("wr_content", "char_count");

    $(function() {
        $("#wr_content").on("keyup", function() {
            check_byte("wr_content", "char_count");
        });
    });

    <?php } ?>
    function html_auto_br(obj)
    {
        if (obj.checked) {
            result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
            if (result)
                obj.value = "html2";
            else
                obj.value = "html1";
        }
        else
            obj.value = "";
    }

    function fwrite_submit(f)
    {
        <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

        var subject = "";
        var content = "";
        $.ajax({
            url: g5_bbs_url+"/ajax.filter.php",
            type: "POST",
            data: {
                "subject": f.wr_subject.value,
                "content": f.wr_content.value
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function(data, textStatus) {
                subject = data.subject;
                content = data.content;
            }
        });

        if (subject) {
            alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
            f.wr_subject.focus();
            return false;
        }

        if (content) {
            alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
            if (typeof(ed_wr_content) != "undefined")
                ed_wr_content.returnFalse();
            else
                f.wr_content.focus();
            return false;
        }

        if (document.getElementById("char_count")) {
            if (char_min > 0 || char_max > 0) {
                var cnt = parseInt(check_byte("wr_content", "char_count"));
                if (char_min > 0 && char_min > cnt) {
                    alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
                    return false;
                }
                else if (char_max > 0 && char_max < cnt) {
                    alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
                    return false;
                }
            }
        }

        <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }
</script>
<!-- } 게시물 작성/수정 끝 -->