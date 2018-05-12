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

  $sql_name = "SELECT name FROM userinfo WHERE teamname like '{$_SESSION['login_session']['teamName']}' ";
  $res_name = $dbconnection ->query($sql_name);


?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>감독 페이지</title>
    <style>
    .team-member , .daily{
      text-align: center;
      width: 100%;
      display: inline-block;
      border-radius: .4rem;
      background-color: #E0E2E3;
      margin-top: 40px;
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
    </style>
  </head>
  <body>
    <div class="left_menu">
      <a href="./mypage_dashboard.php">Dashboard</a>
      <a href="./mypage.php">건강정보 입력</a>
      <a href="./mypageRank.php">팀 내의 경쟁순위</a>
      <a href="#게시판">게시판</a>


      <a href="./logout.php" style="float : right">logout</a>
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
        echo "</tr>";
        echo "</table>";
      }
      ?>



      </div>
      <div class="daily">


            <form name="inputHealth" method="post" action="healthcare_Input.php">
              <h3> <?=$time?> 날짜로 입력하신 내용이 기록됩니다. </h3>
              <h3> 목표치를 입력해주세요.</h3>
              <div class="card">
                <img src="walk.png" alt="walk" style="width:100%">
                <div class="container">
                <h4><b>걸은 양을 입력하세요</b></h4>
                <input type="text" name="name" placeholder="팀원 이름">
                <input type="text" name="walk" placeholder="걸은 양을 입력하세요">
              </div>
            </div>

            <div class="input_button">
              <input type="submit" name="Join-button">
              <input type="reset" name="reset-button">
            </div>
          </form>

    </div>
  </body>
</html>
