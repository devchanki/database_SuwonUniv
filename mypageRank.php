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
$time_month = date("Y-m");






$sql_rank = "SELECT name, sum(walk)
              FROM healthinfo WHERE name in
              (
                SELECT name
                FROM userinfo
                WHERE teamname
                like '{$_SESSION['login_session']['teamName']}'
              )
              AND time like '{$time}'
              GROUP BY name
              ORDER BY sum(walk) DESC";

$res_rank = $dbconnection ->query($sql_rank);

$sql_rank_month = "SELECT name, sum(walk)
              FROM healthinfo WHERE name in
              (
                SELECT name
                FROM userinfo
                WHERE teamname
                like '{$_SESSION['login_session']['teamName']}'
              )
              AND time like '{$time_month}%'
              GROUP BY name
              ORDER BY sum(walk) DESC";

              $res_rank_month = $dbconnection ->query($sql_rank_month);
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
      margin-left: 10px;
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
    .card input{
      border-style: none;
      border-bottom : 3px dotted #282C34;
      padding-left: 5px;
      font-size : .5rem;
      outline: none;
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
    text-align: center;
    width: 100%;
    display: inline-block;
    border-radius: .4rem;
    background-color: #E0E2E3;
  }

  }
  .main_page .status_bar{
    text-align: center;
    background-color: #E0E2E3;
    padding: 15px 10px;
    border-radius: .4rem;
    width: 100%;
    display: block;
  }
 .today_rank, .monthly-rank{
    background-color: #00C2FF;
    margin-top: 20px;
    text-align: center;
  }
  .dashboard{
    width : 100%;
    background-color : ivory;

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

  input{
    border-style: none;
    border-bottom : 3px dotted #282C34;
    padding-left: 5px;
    font-size : 1rem;
    outline: none;
  }
  </style>

  <body>
    <div class="left_menu">
      <a href="./mypage_dashboard.php">Dashboard</a>
      <a href="./mypage.php">건강정보 입력</a>
      <a href="#Team">팀 내의 경쟁순위</a>
      <a href="#게시판">게시판</a>

      <a href="./logout.php" style="float : right">logout</a>
    </div>



<div class="main_page">
      <div class="status_bar">
        <h2><?=$_SESSION['login_session']['teamName']; ?>(팀)에 속해 계시는 <?=$_SESSION['login_session']['name']; ?>님 반갑습니다.</h2>
      </div>
</div>

      <div class="today_rank">
        <h2>금일 팀 내의 걸음 순위 입니다.<br>
          입력하지 않은 사람은 목록에서 제외됩니다.<br>
          팀 이름 : <?=$_SESSION['login_session']['teamName'];?>
        </h2>

        <h3>
        <?php


      while($row = mysqli_fetch_row($res_rank)) {

          echo "이름: ".$row[0]; echo "    ";

          echo "걸음의 합: " .$row[1];

          echo "<br />";

      }

      ?>
      </h3>
      </div>

<div class="monthly-rank">
  <h2>월간 순위입니다.</h2>
    <?php
      while($row = mysqli_fetch_row($res_rank_month)) {

          echo "이름: ".$row[0]; echo "    ";

          echo "걸음의 합: " .$row[1]; echo "     ";
          echo "월 평균 걸음수 : " .number_format((float)$row[1]/30, 2, '.', '');;
          echo "<br />";

      }
      ?>
</div>







  </body>
</html>
