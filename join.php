<?php
 $host = '127.0.0.1';
 $user = 'chanki0508';
 $pw = '';
 $dbName = 'mysql';
 $port = 3306;
 $mysqli = new mysqli($host, $user, $pw, $dbName,$port);
 $email=$_POST['email'];
 $password=md5($_POST['password']);
 $memberId=1;
 
 $sql = "insert into usertable (email, password,memberId)";
 echo $sql;
 echo $email;
 echo $password;
 $sql = $sql. "values('$email','$password','$memberId')";
 if($mysqli->query($sql)){
  echo 'success inserting';
 }else{
  echo 'fail to insert sql';
 }
?>