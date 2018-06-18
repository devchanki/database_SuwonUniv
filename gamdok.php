<?php
session_start();

if( $_SESSION['login_session']['director'] =='false'){
  echo "<script>alert('감독이 아닙니다. 감독만 사용할 수 있는 메뉴입니다.'); location.href='/mypage.php'; </script>";
}

  $host = 'localhost';
  $user = 'root';
  $pw = 'chanki';
  $dbname = 'healthcare';
  $dbconnection = new mysqli($host, $user, $pw, $dbname);
  $dbconnection->set_charset("utf8");
  $time=date("Y-m-d");
  $monthly=date("Y-m");


  $sql_auth_name = "SELECT name,memberId FROM userinfo WHERE teamname like '{$_SESSION['login_session']['teamName']}' and auth like 'true' ";
  $res_name = $dbconnection ->query($sql_auth_name);

  $sql_unauth_name = "SELECT name,memberId FROM userinfo WHERE teamname like '{$_SESSION['login_session']['teamName']}' and auth like 'false' ";
  $res_unauth_name = $dbconnection ->query($sql_unauth_name);

  $sql_goal = "SELECT sum(dailygoal) FROM teaminfo where time like '{$time}' and teamname like '{$_SESSION['login_session']['teamName']}'";
  $res_goal = $dbconnection->query($sql_goal);
  $goal = mysqli_fetch_row($res_goal);

  $sql_mon_goal = "SELECT sum(monthlygoal) FROM teaminfo where time like '{$monthly}%' and teamname like '{$_SESSION['login_session']['teamName']}'";
  $res_mon_goal = $dbconnection->query($sql_mon_goal);
  $mon_goal = mysqli_fetch_row($res_mon_goal);




  $sql_goal_list = "SELECT ANY_VALUE(name), sum(walk),ANY_VALUE(memberId)
                FROM healthinfo WHERE name in
                (
                  SELECT name
                  FROM userinfo
                  WHERE teamname
                  like '{$_SESSION['login_session']['teamName']}'
                )
                AND time like '{$time}'
                GROUP BY memberId";

                $sql_mon_list = "SELECT ANY_VALUE(name), sum(walk),ANY_VALUE(memberId)
                              FROM healthinfo WHERE name in
                              (
                                SELECT name
                                FROM userinfo
                                WHERE teamname
                                like '{$_SESSION['login_session']['teamName']}'
                              )
                              AND time like '{$monthly}%'
                              GROUP BY memberId";
$daily_goal = $dbconnection->query($sql_goal_list);
$monthly_goal = $dbconnection->query($sql_mon_list);
?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>감독 페이지</title>
    <style>
    .team-member , .daily , .unauth,.goal,.list{
      text-align: center;
      width: 100%;
      display: inline-block;
      border-radius: .4rem;
      background-color: #E0E2E3;
      margin-top: 40px;
      padding-bottom: 10px;
    }
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
      .left_menu a {
      padding: 10px 8px 15px 16px;
      text-decoration: none;
      font-size: 1.2rem;
      color: white;
      display: inline-block;
      }
      .main_page{
        text-align: center;
        width: 100%;
        display: inline-block;
        border-radius: .4rem;
        background-color: #E0E2E3;
      }

    .status_bar{
      text-align: center;
      background-color: #E0E2E3;
      padding: 5px 10px;
      border-radius: .4rem;
      display: block;
    }

    .table{

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
        width: 100px;
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
        width: 150px;
        padding: 10px;
        text-align: center;
        vertical-align: top;
        border-right: 1px solid #ccc;
        border-bottom: 1px solid #ccc;
        color: white;
        background-color: #454545;
    }
    .card {
      margin: 15px 10px 5px 10px;
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
      transition: 0.3s;
      width: 200px;
      height: 200px;
      display: inline-block;
    }
    a{
      text-decoration: none;
      color: red;
    }
    .input_button{
      display: inline;
    }
    input[type="radio"] {
    display:none;
    }

    input[type="radio"] + label {
        color:black;
        font-family:Arial, sans-serif;
    }

    input[type="radio"] + label span {
        display:inline-block;
        width:19px;
        height:19px;
        margin:-2px 10px 0 0;
        vertical-align:middle;
        background:url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/210284/check_radio_sheet.png) -38px top no-repeat;
        cursor:pointer;
      }

  input[type="radio"]:checked + label span {
    background:url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/210284/check_radio_sheet.png) -57px top no-repeat;
  }
    </style>
  </head>
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
      <h4>

        <?=$_SESSION['login_session']['teamName']; ?>(팀)에 속해 계시는 <?=$_SESSION['login_session']['name']; ?>님 반갑습니다.
        <?php if ($_SESSION['login_session']['director'] == "true") {print "직책 : 감독";} else {print "일반 사용자입니다";}?>
      </h4>
      </div>
</div>
    <div class="team-member">
      <h2> 내 팀 내에 있는 팀원 이름입니다. </h2>
      팀 이름 : <?=$_SESSION['login_session']['teamName']; ?>

    <?php
      while($row = mysqli_fetch_row($res_name)) {
        echo "<table>";
        echo "<tr>";
        echo "<th>이름: </th> <td> {$row[0]} </td>";
        echo "<th>이름구별용 번호 </th> <td> {$row[1]} </td>";
        echo "</tr>";
        echo "</table>";
      }
      ?>
    </div>

    <div class="unauth">
      <h4>승인되지 않은 회원입니다.</h4>
      <?php
      while($row = mysqli_fetch_row($res_unauth_name)) {
        echo "<table>";
        echo "<tr>";
        echo "<th>이름: </th> <td> {$row[0]} </td>";
        echo "<td> <a href ='changeAuth.php?id={$row[1]}'>가입 승인하기 </a> </td>";
        echo "</tr>";
        echo "</table>";
      }

      ?>
    </div>
      <div class="daily">


            <form name="inputGoal" method="post" action="inputGoal.php">
              <h3> <?=$time?> 날짜로 입력하신 내용이 기록됩니다. </h3>
              <h3> 목표치를 입력해주세요.</h3>
              <div class="card">
                <img src="walk.png" alt="walk" style="width:100%">
                <div class="container">
                <h4><b>정하고 싶은 목표치를 입력해주세요. 목표치를 기간내에 더 주면 더해집니다.</b></h4>
                <input type="text" name="daily" placeholder="목표량을 입력해주세요">
              </div>
              <div class="time-sel">
                <input type="radio" id="r1" name="time" checked="checked" value="true" />
                <label for="r1"><span></span>일간으로 목표를 줄래요.</label>
                <p>
                  <input type="radio" id="r2" name="time" value="false" />
                  <label for="r2"><span></span>한달 목표로 줄래요. </label>
              </div>
            </div>

            <div class="input_button">
              <input type="submit" name="Join-button">
              <input type="reset" name="reset-button">
            </div>
          </form>

    </div>
    <div class="goal">
      <h4>내가 준 일간 목표 : <?=$goal[0]?></h4>
      <h4>내가 준 월간 목표 :<?=$mon_goal[0]?> </h4>

    </div>

    <div class="list">
      <h3>운동을 수행한 사람들의 일간 달성률을 보여줍니다. 운동을 하지 않은사람은 아얘 제외됩니다!</h3>
      <?php
        while($row = mysqli_fetch_row($daily_goal)) {
          echo "<table>";
          echo "<tr>";
          echo "<th>이름 </th> <td> {$row[0]} </td>";
          echo "<th>달린 거리 </th> <td> {$row[1]} </td>";
          echo "<th>이름구별용 번호 </th> <td> {$row[2]} </td>";
          if($goal[0] == 0 ){echo "<th>달성률: </th> <td> ";echo "일간목표를 주지 않았습니다.</td>";}
          else{echo "<th>달성률: </th> <td> ";echo $row[1]/$goal[0]* 100; echo "% </td>";}

          echo "</tr>";
          echo "</table>";
        }
        ?>
</div>
        <div class="list">
          <h3>운동을 수행한 사람들의 월간 달성률을 보여줍니다. 운동을 하지 않은사람은 아얘 제외됩니다!</h3>
          <?php
            while($row = mysqli_fetch_row($monthly_goal)) {
              echo "<table>";
              echo "<tr>";
              echo "<th>이름 </th> <td> {$row[0]} </td>";
              echo "<th>달린거리 </th> <td> {$row[1]} </td>";
              echo "<th>이름구별용 번호 </th> <td> {$row[2]} </td>";
              if($mon_goal[0] == 0 ){echo "<th>달성률: </th> <td> ";echo "월간목표를 주지 않았습니다.</td>";}
              else{echo "<th>달성률: </th> <td> ";echo $row[1]/$mon_goal[0]* 100; echo "% </td>";}

              echo "</tr>";
              echo "</table>";
              $sql_date = "SELECT time FROM healthinfo WHERE time like '{$monthly}%' and memberId like '{$row[2]}' group by time";

              $res_date = $dbconnection->query($sql_date);
              echo "운동한 날짜 : ";
              while($row_date = mysqli_fetch_row($res_date)){
                echo $row_date[0];
                echo ",";
              }
            }
            ?>
    </div>
  </body>
</html>
