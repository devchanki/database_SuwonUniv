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
 $mysqli->set_charset("utf8");

 $sql_director = "select * from userinfo WHERE teamname LIKE '{$teamName}'";
 $res_director = $mysqli ->query($sql_director);


 $sql = "insert into userInfo (email, password ,name, teamname,director,auth)";

 if($director == 'true'){
     if($res_director->num_rows){
       echo "<script> alert('이미 존재하는 팀에 팀장이 될 수 없습니다. 새로운 팀을 만드세요'); location.href='/index.html'; </script>";
       return;
     }

     else{
         $sql = $sql. "values('$email','$password','$userName', '$teamName','$director','true')";
    }
  }
 else{
   $sql = $sql. "values('$email','$password','$userName', '$teamName','$director','false')";
 }

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
