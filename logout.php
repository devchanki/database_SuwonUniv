<?php
//세션 제거
unset($_SESSION['login_session']);

//세션 제거 확인 후 메인페이지로 이동
if(!isset($_SESSION['login_session'])){
  header("Location:./index.html");
}
?>
