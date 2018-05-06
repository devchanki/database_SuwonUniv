<?php
session_start();

if(!isset($_SESSION['login_session'])){
  header("Location:./index.html");
}

if(!isset($_SESSION['login_session'])){
  header("Location:./index.html");
}
$host = 'localhost';
$user = 'root';
$pw = 'chanki';
$dbname = 'healthcare';
$dbconnection = new mysqli($host, $user, $pw, $dbname);
$dbconnection->set_charset("utf8");
$time = date("Y-m-d");

//password 받아온 값을 md5 해쉬화 해서 db랑 비교.

$sql_water = " SELECT sum(water) FROM healthinfo WHERE time like '{$time}' and name like '{$_SESSION['login_session']['name']}' ";
$res_water = $dbconnection ->query($sql_water);

$sum_water = mysqli_fetch_array($res_water);
$water_sum = $sum_water["sum(water)"];

$sql_walk = " SELECT sum(walk) FROM healthinfo WHERE time like '{$time}' and name like '{$_SESSION['login_session']['name']}' ";
$res_walk = $dbconnection ->query($sql_walk);

$sum_walk = mysqli_fetch_array($res_walk);
$walk_sum = $sum_walk["sum(walk)"];

$sql_sleep = " SELECT sum(sleep) FROM healthinfo WHERE time like '{$time}' and name like '{$_SESSION['login_session']['name']}' ";
$res_sleep = $dbconnection ->query($sql_sleep);

$sum_sleep = mysqli_fetch_array($res_sleep);
$sleep_sum = $sum_sleep["sum(sleep)"];

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>당신의 건강정보</title>
  </head>

  <style>
  body {
    margin:0;
    padding:0;
    margin-top:0px;
    padding-top : 0px ;
  }
  .left_menu {
    height: 15%;
    width: 100%;
    display: block;
    z-index: 1;
    background-color: #454545;
    overflow: hidden;
    margin: 0px;
    padding: 0px;
    font-size: 1.2rem;
    clear:both;
    }
    .input_button{
      display: inline;
    }
    .input_button input{
      display: inline-block;
      background-color: #282C34;
      padding: 5px;
      border-radius : .4rem;
      font-size : .8rem;
      color : white;
      }
    }

    form{
      display: inline;
    }

    .left_menu a {
    padding: 10px 8px 15px 16px;
    text-decoration: none;
    font-size: 1.2rem;
    color: white;
    display: inline-block;
  }

  .left_menu a:hover {
    color: #f1f1f1;
  }
  .main_page{
    width: 100%;
  }
  .status_bar{
    text-align: center;
    background-color: #E0E2E3;
    padding: 15px 10px;
    border-radius: .4rem;
    width: 100%;
    display: block;
  }
  .dashboard{
    text-align: center;
    width : 100%;
    display: inline-block;
    border-radius: .4rem;
    background-color : #00C2FF;
    margin-top: 40px;
  }
  .card {
    margin: 15px 10px 5px 10px;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    width: 200px;
    height: 200px;
    display: inline-block;
  }

  .card:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
  }

  .container {
    padding: 2px 16px;
  }
  form{
    background-color: ivory;
  }
  </style>

  <body>
    <div class="left_menu">
      <a href="./mypage_dashboard.php">Dashboard</a>
      <a href="./mypage.php">건강정보 입력</a>
      <a href="./mypageRank.php">팀 내의 경쟁순위</a>
      <a href="#게시판">게시판</a>

      <a href="./logout.php" style="float : right">logout</a>
    </div>

    <div class="main_page">
      <div class="status_bar">
        <?=$_SESSION['login_session']['teamName']; ?>(팀)에 속해 계시는 <?=$_SESSION['login_session']['name']; ?>님 반갑습니다.
      </div>

      <div class="dashboard">
        <h3>오늘의 건강정보 : <?=$time?></h3>
        <div class="card">
          <img src="walk.png" alt="walk" style="width:100%">
          <div class="container">
          <h4><b>걸은 양 : <?=$walk_sum?> (Km)</b></h4>
        </div>
      </div>

      <div class="card">
        <img src="water.png" alt="Water" style="width:100%">
          <div class="container">
          <h4><b>물의 양 : <?=$water_sum?> (L)</b></h4>
        </div>
      </div>

      <div class="card">
        <img src="sleep.jpg" alt="sleep" style="width:100%">
        <div class="container">
          <h4><b>수면 양 :<?=$sleep_sum?> (시간) </b></h4>
        </div>
      </div>
      </div>

    </div>



  </body>
</html>
