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
$monthly = date("Y-m");

//password 받아온 값을 md5 해쉬화 해서 db랑 비교.

$sql_sum = " SELECT sum(walk),sum(water), sum(sleep) FROM healthinfo WHERE time like '{$time}' and memberId like '{$_SESSION['login_session']['memberId']}' ";
$res_sum = $dbconnection ->query($sql_sum);
$row = mysqli_fetch_row($res_sum);

$sql_monthly_sum = " SELECT sum(walk),sum(water), sum(sleep) FROM healthinfo WHERE time like '{$monthly}%' and memberId like '{$_SESSION['login_session']['memberId']}' ";
$res_monthly_sum = $dbconnection ->query($sql_monthly_sum);
$mrow = mysqli_fetch_row($res_monthly_sum);

$sql_sikdan = " SELECT food, calorie,num FROM sikdan WHERE time like '{$time}' and memberId like '{$_SESSION['login_session']['memberId']}' ";
$res_sikdan = $dbconnection ->query($sql_sikdan);

$sql_weight = " SELECT bodypart, name, times , num FROM weight WHERE time like '{$time}' and memberId like '{$_SESSION['login_session']['memberId']}' ";
$res_weight = $dbconnection ->query($sql_weight);

$sql_goal = "SELECT sum(dailygoal) FROM teaminfo where time like '{$time}' and teamname like '{$_SESSION['login_session']['teamName']}'";
$res_goal = $dbconnection->query($sql_goal);
$goal = mysqli_fetch_row($res_goal);

$sql_mon_goal = "SELECT sum(monthlygoal)
                  FROM teaminfo where time like '{$monthly}%'
                  and teamname like '{$_SESSION['login_session']['teamName']}'";
$res_mon_goal = $dbconnection->query($sql_mon_goal);
$mon_goal = mysqli_fetch_row($res_mon_goal);

$sql_date = "SELECT time FROM healthinfo WHERE time like '{$monthly}%' and memberId like '{$_SESSION['login_session']['memberId']}' group by time";
$res_date = $dbconnection->query($sql_date);


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
    /* background-color: #454545; */
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
      padding: 10px 10px;
      border-radius: .4rem;
      display: block;
    }
    .dashboard , .sikdan,.weight, .dashboard_mon, .goal, .date-name{
      text-align: center;
      width : 100%;
      display: inline-block;
      border-radius: .4rem;
      background-color : #E0E2E3;
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
      /* display: inline-flex; */
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
      /* display: inline-flex; */
      padding: 10px;
      text-align: center;
      vertical-align: top;
      border-right: 1px solid #ccc;
      border-bottom: 1px solid #ccc;
      color: white;
      background-color: #454545;
      width: 100px;
  }
  a{
    text-decoration: none;
    color: white;
  }
  </style>

  <body>
    <div class="left_menu">
      <a href="./mypage_dashboard.php">Dashboard</a>
      <a href="./mypage.php">건강정보 입력</a>
      <a href="./mypageRank.php">팀 내의 경쟁순위</a>
      <a href="./shorttable.php">게시판</a>

      <a href="./logout.php" style="float : right">logout</a>
      <a href="./myinfo.php" style="float : right">개인 설정</a>
      <a href="./gamdok.php" style="float : right">감독 메뉴</a>
    </div>

    <div class="main_page">
      <div class="status_bar">
      <h4>  <?=$_SESSION['login_session']['teamName']; ?>(팀)에 속해 계시는 <?=$_SESSION['login_session']['name']; ?>님 반갑습니다.
      <?php if ($_SESSION['login_session']['director'] == "true") {print "직책 : 감독";} else {print "일반 사용자입니다";}?></h4>
    </div>

    <div class="">

    </div>

    <div class="dashboard">
        <h3>오늘의 건강정보 : <?=$time?></h3>
        <div class="card">
          <img src="walk.png" alt="walk" style="width:100%">
          <div class="container">
            <h4><b>걸은 양 : <?=$row[0]?> (Km)</b></h4>
          </div>
        </div>

        <div class="card">
          <img src="water.png" alt="Water" style="width:100%">
            <div class="container">
            <h4><b>물의 양 : <?=$row[1]?> (L)</b></h4>
          </div>
        </div>

        <div class="card">
          <img src="sleep.jpg" alt="sleep" style="width:100%">
          <div class="container">
            <h4><b>수면 양 :<?=$row[2]?> (시간) </b></h4>
          </div>
        </div>
    </div>

    <div class="dashboard_mon">
        <h3>월간 누적 건강정보 : <?=$time?></h3>
        <div class="card">
          <img src="walk.png" alt="walk" style="width:100%">
          <div class="container">
            <h4><b>걸은 양 : <?=$mrow[0]?> (Km)</b></h4>
          </div>
        </div>

        <div class="card">
          <img src="water.png" alt="Water" style="width:100%">
            <div class="container">
            <h4><b>물의 양 : <?=$mrow[1]?> (L)</b></h4>
          </div>
        </div>

        <div class="card">
          <img src="sleep.jpg" alt="sleep" style="width:100%">
          <div class="container">
            <h4><b>수면 양 :<?=$mrow[2]?> (시간) </b></h4>
          </div>
        </div>
    </div>

    <div class="goal">
      <h4>감독이 준 목표치에요. </h4>
      <h4>일간 목표치:<?=$goal[0]?></h4>
      <h4>월간 목표치:<?=$mon_goal[0]?></h4><br>

      <h4>달성도</h4>
      <?php
      if($goal[0]==0){
        echo "일간달성도: 목표값이 없어 나눌수 없어요~"; echo "<br>";
      }else{
      echo "일간 달성도:"; echo $row[0] / $goal[0] * 100; echo "%"; echo "<br>";
    }
      if($mon_goal[0]==0)
      {echo "월간 달성도 :목표값이 없어 나눌수 없어요~";echo "<br>";
      }else{
      echo "월간 달성도:"; echo $mrow[0] / $mon_goal[0] * 100; echo "%";echo "<br>";
    }
      ?>

    </div>

      <div class="sikdan">
        <h4>식단 checklist 입니다.</h4>
        <?php
        while($row = mysqli_fetch_row($res_sikdan)) {
          echo "<table>";
          echo "<tr>";
          echo "<th>음식이름</th> <td> {$row[0]} </td>";
          echo "<th>칼로리</th> <td> {$row[1]} </td>";
          echo "<td> <a href ='deleteSikdan.php?id={$row[2]}'>삭제하기</a> </td>";
          echo "</tr>";
          echo "</table>";
        }

        ?>
      </div>

        <div class="weight">
          <h4>근력운동 알림장</h4>
          <?php
          while($row = mysqli_fetch_row($res_weight)) {
            echo "<table>";
            echo "<tr>";
            echo "<th>운동 부위</th> <td> {$row[0]} </td>";
            echo "<th>운동 이름</th> <td> {$row[1]} </td>";
            echo "<th>횟수</th> <td> {$row[2]} </td>";
            echo "<td> <a href ='deleteWeight.php?id={$row[3]}'>삭제하기</a> </td>";
            echo "</tr>";
            echo "</table>";
          }

          ?>

      </div>
      <div class="date-name">
        <h4>이번달 내가 운동한 날짜에요</h4>
        <?php    while($date_array = mysqli_fetch_row($res_date)) {
          echo "<table>";
          echo "<tr>";
          echo "<th>날짜</th> <td> {$date_array[0]} </td>";
          echo "</tr>";
          echo "</table>";
        } ?>
      </div>
  </body>
</html>
