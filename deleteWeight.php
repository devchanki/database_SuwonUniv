<?php
header("Content-Type:text/html;charset=utf-8");

 $host = '127.0.0.1';
 $user = 'root';
 $pw = 'chanki';
 $dbName = 'healthcare';
 $port = 3306;
 $mysqli = new mysqli($host, $user, $pw, $dbName,$port);
 $id=$_GET['id'];
 if($mysqli == false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

 $mysqli->set_charset("utf8");

 $sql_weight= "delete from weight WHERE num={$id};";



       if( $res_auth = $mysqli ->query($sql_weight)){
         echo "<script> alert('삭제 완료하였습니다.'); location.href='./mypage_dashboard.php'; </script>";
       }

       else{
         echo "<script> alert('실패했습니다.'); location.href='./mypage_dashboard.php'; </script>";
        echo "Query: " . $sql . "\n";
        echo "Errno: " . $mysqli->errno . "\n";
        echo "Error: " . $mysqli->error . "\n";
      exit;
       }


?>
