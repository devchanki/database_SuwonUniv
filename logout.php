<?php
//세션 제거
session_start();       //세션시작
session_unset();     // 현재 연결된 세션에 등록되어 있는 모든 변수의 값을 삭제한다
session_destroy();  //현재의 세션을 종료한다


//세션 제거 확인 후 메인페이지로 이동
if(!isset($_SESSION['login_session'])){
  echo '에러가 발생했습니다. 로그인을 하고 들어와주세요.';
  header("Location:./index.html");
}
?>
