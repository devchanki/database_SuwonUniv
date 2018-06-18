<?php
session_start();
header("Content-Type:text/html;charset=utf-8");

 $host = '127.0.0.1';
 $user = 'root';
 $pw = 'chanki';
 $dbName = 'healthcare';
 $port = 3306;
 $mysqli = new mysqli($host, $user, $pw, $dbName,$port);
 $id=$_POST['team'];


   $sql = "SELECT * FROM teamname WHERE teamname = '{$id}'";

   $res = $mysqli -> query($sql);

   $row = mysqli_fetch_row($res);


 $memberid = $_SESSION['login_session']['memberId'];

 if($mysqli == false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

 $mysqli->set_charset("utf8");
if( $_SESSION['login_session']['director'] == 'true')
  {
  echo "<script> alert('팀장은 팀을 바꿀 수 없습니다. 새로운 팀을 생성하세요'); location.href='./mypage.php'; </script>";
  return;
}else if (!$row){
    echo "<script> alert('존재하는 팀 이름이 아닙니다.'); location.href='./mypage.php'; </script>";
}
else{
 $sql_auth = "UPDATE userinfo SET teamname='{$id}',auth='false' WHERE memberId like {$memberid}";
}


       if( $res_auth = $mysqli ->query($sql_auth)){
         echo "<script> alert('팀 이름이 바뀌었습니다. 상태바에 있는 팀 이름은 로그아웃 후 적용됩니다. 팀장의 승인이 있을때까지 로그인이 불가합니다.'); location.href='./logout.php'; </script>";
       }

       else{
         echo "<script> alert('실패했습니다.'); location.href='./myinfo.php'; </script>";
        echo "Query: " . $sql . "\n";
        echo "Errno: " . $mysqli->errno . "\n";
        echo "Error: " . $mysqli->error . "\n";
      exit;
       }


?>
