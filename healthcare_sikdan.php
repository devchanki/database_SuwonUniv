<?php
  session_start();

  header("Content-Type:text/html;charset=utf-8");

 $host = '127.0.0.1';
 $user = 'root';
 $pw = 'chanki';
 $dbName = 'healthcare';
 $port = 3306;
 $mysqli = new mysqli($host, $user, $pw, $dbName,$port);
 if($mysqli === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
  }
 $memberid = $_SESSION['login_session']['memberId'];
 $name = $_SESSION['login_session']['name'];
 $food = $_POST['sikdan'];
 $calorie = $_POST['calorie'];
 $time = $_POST['date'];
 $sql = "insert into sikdan(food,calorie,time,memberId)";
 $sql = $sql. "values('$food','$calorie','$time','$memberid')";
 if(! $sql )
{
  die('Could not update data: ' . mysqli_error());
}

 if($mysqli->query($sql)){
  echo '입력에 성공했습니다..';
  echo("<script>location.replace('./mypage.php');</script>");
 }

 else{
  echo '에러가 발생했습니다. 다시 시도해 주세요.';
  //echo("<script>location.replace('./mypage.php');</script>");
  echo "Query: " . $sql . "\n";
  echo "Errno: " . $mysqli->errno . "\n";
  echo "Error: " . $mysqli->error . "\n";
exit;
 }
?>
