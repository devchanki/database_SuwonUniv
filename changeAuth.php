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

 $sql_auth = "UPDATE userinfo SET auth='true' WHERE memberid={$id}";



       if( $res_auth = $mysqli ->query($sql_auth)){
         echo "<script> alert('승인이 성공적으로 완료되었습니다.'); location.href='./gamdok.php'; </script>";
       }

       else{
         echo "<script> alert('실패했습니다.'); location.href='./gamdok.php'; </script>";
        echo "Query: " . $sql . "\n";
        echo "Errno: " . $mysqli->errno . "\n";
        echo "Error: " . $mysqli->error . "\n";
      exit;
       }


?>
