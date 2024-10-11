<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
<!-- 로그인 시작 { -->
<form class="form-signin" action="<?php echo $login_action_url ?>" method="post">
	<input type="hidden" name="url" value="<?php echo $login_url ?>">
	<h1 class="h3 mb-3 font-weight-normal"><a href="<?php echo G5_URL?>"><?php echo $config['cf_title']; ?></a></h1>
	<label class="sr-only">아이디</label>
	<input type="text" class="form-control" name="mb_id" placeholder="아이디" max_length="20" required autofocus>
	<label class="sr-only">비밀번호</label>
	<input type="password" class="form-control" name="mb_password" placeholder="비밀번호" max_length="20" required>
	<div class="checkbox mb-3">
		<label for="login_auto_login">
			<input type="checkbox" id="login_auto_login" name="auto_login"> 자동로그인
		</label>
	</div>
	<button class="btn btn-lg btn-primary btn-block" type="submit">로그인</button>
	<p class="mt-5 mb-3 text-muted">
		<a href="<?php echo G5_BBS_URL ?>/password_lost.php">PW 찾기</a><br/>
		<a href="<?php echo G5_BBS_URL ?>/register.php" class="text-center">회원가입</a>
	</p>
</form>



<script>
	$(function(){
		$("#login_auto_login").click(function(){
			if (this.checked) {
				this.checked = confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?");
			}
		})
	})
</script>
<!-- } 로그인 끝 -->
