<?php
  session_start();
  include("./php/mysql_connect.php");

$name = $_POST['name']
 $walk=$_POST['walk'];
 $teamname = $_SESSION['login_session']['teamName'];
 $time = date("Y-m-d");
 $sql = "insert into teamgoal (,walk,water,sleep,time)";
 $sql = $sql. "values('$name','$walk','$sleep','$time')";
 if(! $sql )
{
  die('Could not update data: ' . mysqli_error());
}

 if($mysqli->query($sql)){
  echo '입력에 성공했습니다.';
 }

 else{
  echo '에러가 발생했습니다. 다시 시도해 주세요.';
  echo("<script>location.replace('./mypage.php');</script>");
  echo "Query: " . $sql . "\n";
  echo "Errno: " . $mysqli->errno . "\n";
  echo "Error: " . $mysqli->error . "\n";
exit;
 }
?>
