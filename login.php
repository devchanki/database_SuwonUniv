<?php

  session_start();



  $host = 'localhost';
  $user = 'root';
  $pw = 'chanki';
  $dbname = 'healthcare';
  $dbconnection = new mysqli($host, $user, $pw, $dbname);
  $dbconnection->set_charset("utf8");
  $password = md5($_POST['pw']);

 //password 받아온 값을 md5 해쉬화 해서 db랑 비교.

  $sql = "SELECT * FROM userInfo WHERE email = '{$_POST['email']}' AND password = '{$password}'";

  $res = $dbconnection ->query($sql);

  if($res->num_rows == 1){

    $userInfo = $res->fetch_array(MYSQLI_ASSOC);

    $_SESSION['login_session'] = array();
    $_SESSION['login_session']['email'] = $userInfo['email'];
    $_SESSION['login_session']['name'] = $userInfo['name'];
    $_SESSION['login_session']['memberId'] = $userInfo['memberId'];
    $_SESSION['login_session']['teamName'] = $userName['teamName'];


  if(isset($_SESSION['login_session'])){
    header("Location:./mypage.php");
  }

}else{
  echo "<script>alert('로그인에 실패했습니다.'); location.href='/index.html'; </script>";
}

?>
