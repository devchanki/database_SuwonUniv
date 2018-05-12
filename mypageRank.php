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
    background-color: #454545;
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

    display: block;
  }
 .today_rank, .monthly-rank{
    background-color: #E0E2E3;
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
  .table, .table1{

    text-align: center;
    margin: 10px;
  }
  table {
    border-collapse: separate;
    border-spacing: 0;
    text-align: left;
    line-height: 1.5;
    border-top: 1px solid #ccc;
    border-left: 1px solid #ccc;
    margin : auto;
  }
  table th {
      display: inline-flex;
      padding: 10px;
      font-weight: bold;
      text-align: center;
      vertical-align: top;
      border-right: 1px solid #ccc;
      border-bottom: 1px solid #ccc;
      border-top: 1px solid #fff;
      border-left: 1px solid #fff;
      background: #eee;

  }
  table td {
      display: inline-flex;
      padding: 10px;
      text-align: center;
      vertical-align: top;
      border-right: 1px solid #ccc;
      border-bottom: 1px solid #ccc;
      color: white;
      background-color: #454545;
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
      <a href="./mypageRank.php">팀 내의 경쟁순위</a>
      <a href="./shorttable.php">게시판</a>

      <a href="./logout.php" style="float : right">logout</a>
      <a href="./gamdok.php" style="float : right">감독 메뉴</a>
    </div>



<div class="main_page">
      <div class="status_bar">
        <h4><?=$_SESSION['login_session']['teamName']; ?>(팀)에 속해 계시는 <?=$_SESSION['login_session']['name']; ?>님 반갑습니다.
        <?php if ($_SESSION['login_session']['director'] == "true") {print "직책 : 감독";} else {print "일반 사용자입니다";}?></h4>
      </div>
</div>

      <div class="today_rank">
        <h3>금일 팀 내의 걸음 순위 입니다.<br>
          입력하지 않은 사람은 목록에서 제외됩니다.<br>
          팀 이름 : <?=$_SESSION['login_session']['teamName'];?>
        </h3>

        <h3>
          <div class="table">
            <?php


          while($row = mysqli_fetch_row($res_rank)) {
            echo "<table>";
            echo "<tr>";
            echo "<th>이름</th> <td> {$row[0]} </td>";
            echo "<th>걸은 거리</th> <td> {$row[1]} km</td>";
            echo "</tr>";
            echo "</table>";
        }

          ?>
          </div>

      </h3>
      </div>

<div class="monthly-rank">
  <h3>월간 순위입니다. 아무도 없을 경우 표시되지 않습니다.</h3>
  <div class="table1">


    <?php
      while($row = mysqli_fetch_row($res_rank_month)) {
          echo "<table>";
          echo "<tr>";
          echo "<th>이름: </th> <td> {$row[0]} </td>";

          echo "<th>걸은 거리 (km): </th> <td> {$row[1]} km</td>";
          echo "<th>월 평균 걸은 거리 (km): </th> <td> " ; echo number_format((float)$row[1]/date("t"), 2, '.', ''); echo "km</td>";
          echo "</tr>";
          echo "</table>";
      }
      ?>
      </div>
</div>







  </body>
</html>
