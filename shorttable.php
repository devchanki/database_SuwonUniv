<?php
session_start();
$host = 'localhost';
$user = 'root';
$pw = 'chanki';
$dbname = 'healthcare';
$dbconnection = new mysqli($host, $user, $pw, $dbname);
$dbconnection->set_charset("utf8");

$team_table_query = "SELECT name ,letter, time from shorttable where teamname like '{$_SESSION['login_session']['teamName']}' and open like 'false'";
$all_table_query = "SELECT name ,letter, time FROM shorttable where open like 'true' ";

$res_team_query = $dbconnection ->query($team_table_query);
$res_all_query = $dbconnection ->query($all_table_query);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>한줄게시판</title>
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
  .status_bar{
    text-align: center;
    background-color: #E0E2E3;
    padding: 5px 10px;
    border-radius: .4rem;
    display: block;
  }
  .message-input , .team-table,.all-table{
    text-align: center;
    width: 100%;
    display: inline-block;
    border-radius: .4rem;
    background-color: #E0E2E3;
    margin-top: 40px;
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
      /* width: 100px; */
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
      /* width: 150px; */
      padding: 10px;
      text-align: center;
      vertical-align: top;
      border-right: 1px solid #ccc;
      border-bottom: 1px solid #ccc;
      color: white;
      background-color: #454545;
      display: inline-flex;
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
    <div class="message-input">
      <form class="input" action="tableInput.php" method="post">
        <h4>한줄게시판 입니다.</h4>
          <input type="radio" id="r1" name="open" value="true" />
          <label for="r1"><span></span>전체한테 글을 날립니다.</label>
          <input type="radio" id="r2" name="open" value="false" />
          <label for="r2"><span></span>팀원한테만 글을 보여줍니다. </label>
        <input style="display: block; width: 100%; height: 50px;"type="text" name="table" placeholder="자신의 생각을 공유해보세요">

        <div class="input_button">
          <input type="submit" name="Join-button">
          <input type="reset" name="reset-button">
        </div>
      </div>
      <div class="team-table">
        <h4>팀원끼리의 방명록입니다.</h4>
        <?php
        if($res_all_query){
        while($row1 = mysqli_fetch_row($res_team_query)) {
          echo "<table>";
          echo "<tr>";
          echo "<th>이름 </th> <td> {$row1[0]} </td>";
          echo "<th>내용 </th> <td> {$row1[1]} </td>";
          echo "<th>시간</th> <td> {$row1[2]} </td>";
          echo "</tr>";
          echo "</table>";
        }
      }?>
      </div>

      <div class="all-table">
        <h4>모두의 방명록입니다.</h4>
        <?php
        if($res_team_query){
        while($row2 = mysqli_fetch_row($res_all_query)) {
          echo "<table>";
          echo "<tr>";
          echo "<th>이름: </th> <td> {$row2[0]} </td>";
          echo "<th>내용: </th> <td> {$row2[1]} </td>";
          echo "<th>시간: </th> <td> {$row2[2]} </td>";
          echo "</tr>";
          echo "</table>";
        }
      }?>
      </div>
    </form>
  </body>
</html>
