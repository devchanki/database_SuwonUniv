<?php
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
 $email=$_POST['email'];
 $password=md5($_POST['password']);
 $userName=$_POST['userName'];
 $teamName=$_POST['teamName'];
 $director=$_POST['director'];



 $sql = "insert into userInfo (email, password ,name, teamname,director)";
 $sql = $sql. "values('$email','$password','$userName', '$teamName','$director')";
 if(! $sql )
{
  die('Could not update data: ' . mysqli_error());
}

 if($mysqli->query($sql)){
  echo '회원가입에 성공하셨습니다. 로그인 페이지로 이동합니다.';
  echo("<script>location.replace('./index.html');</script>");
 }

 else{
  echo '에러가 발생했습니다. 다시 한번 확인후 가입해주세요.';
  echo("<script>location.replace('./index.html');</script>");
  echo "Query: " . $sql . "\n";
  echo "Errno: " . $mysqli->errno . "\n";
  echo "Error: " . $mysqli->error . "\n";
exit;
 }
?>
