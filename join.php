<?php
header("Content-Type:text/html;charset=utf-8");

 $host = '127.0.0.1';
 $user = 'chanki0508';
 $pw = '';
 $dbName = 'mysql';
 $port = 3306;
 $mysqli = new mysqli($host, $user, $pw, $dbName,$port);
 $email=$_POST['email'];
 $password=md5($_POST['password']);
 $userName=$_POST['userName'];


 
 $sql = "insert into userInfo (email, password ,name)";
 $sql = $sql. "values('$email','$password','$userName')";
 if($mysqli->query($sql)){
  echo '회원가입에 성공하셨습니다. 로그인 페이지로 이동합니다.';
  echo("<script>location.replace('https://database-chanki0508.c9users.io');</script>"); 
 }
 else{
  echo '에러가 발생했습니다. 다시 한번 확인후 가입해주세요.';
 }
?>