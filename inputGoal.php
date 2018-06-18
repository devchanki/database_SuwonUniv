<?php
  session_start();

  header("Content-Type:text/html;charset=utf-8");

 $host = '127.0.0.1';
 $user = 'root';
 $pw = 'chanki';
 $dbName = 'healthcare';
 $port = 3306;
 $mysqli = new mysqli($host, $user, $pw, $dbName,$port);
 $con = $_POST['time'];
 if($mysqli == false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
  }
  $walk=$_POST['daily'];
  $teamname = $_SESSION['login_session']['teamName'];
  $time = date("Y-m-d");
  $sql = "insert into teaminfo (teamname,dailygoal,monthlygoal,time)";
  if($con == 'true'){
  $sql = $sql. "values('$teamname','$walk','0','$time')";
  }else {
    $sql = $sql. "values('$teamname','0','$walk','$time')";
  }
 if(! $sql )
{
  die('Could not update data: ' . mysqli_error());
}

 if($mysqli->query($sql)){
  echo "<script> alert('목표치 할당되었습니다!'); location.href='/gamdok.php'; </script>";;
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
