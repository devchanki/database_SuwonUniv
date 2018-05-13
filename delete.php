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
 $name= $_SESSION['login_session']['memberId'];
 $sql[0] = "DELETE FROM userinfo WHERE memberId like '{$name}'";
 $sql[1] = "DELETE FROM healthinfo WHERE memberId like '{$name}'";
 $sql[2] = "DELETE FROM shorttable WHERE memberId like '{$name}'";

  for($i=0 ; $i<3; $i++){
  $mysqli->query($sql[$i]);
  }

  echo("<script>location.replace('./index.html');</script>");


?>
