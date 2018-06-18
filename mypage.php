<?php
session_start();
if(!isset($_SESSION['login_session'])){
  header("Location:./index.html");
}

if(!isset($_SESSION['login_session'])){
  header("Location:./index.html");
}
header("Content-Type:text/html;charset=utf-8");

 $host = '127.0.0.1';
 $user = 'root';
 $pw = 'chanki';
 $dbName = 'healthcare';
 $port = 3306;
 $mysqli = new mysqli($host, $user, $pw, $dbName,$port);
 if($mysqli == false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$time=date("Y-m-d");
$tommorrow =date("Ymd", strtotime("+1 day"));
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

    .left_menu a {
    padding: 10px 8px 15px 16px;
    text-decoration: none;
    font-size: 1.2rem;
    color: white;
    display: inline-block;
    }
    /* body{
      background-color: #454545;
    } */
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

  .status_bar{
    text-align: center;
    background-color: #E0E2E3;
    padding: 5px 10px;
    border-radius: .4rem;
    width: 100%;
    display: block;
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
  .inputHealth, .sikdan, .weight{
    text-align: center;
    width: 100%;
    display: inline-block;
    border-radius: .4rem;
    background-color: #E0E2E3;
    margin-top: 40px;
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
<div class="inputHealth">


      <form name="inputHealth" method="post" action="healthcare_Input.php">
        <h3> <?=$time?> 날짜로 입력하신 내용이 기록됩니다. </h3>
        <h3>빈칸없이 제출해 주세요. 없으실 경우는 0을 입력하세요.</h3>
        <div class="card">
          <img src="walk.png" alt="walk" style="width:100%">
          <div class="container">
          <h4><b>걸은 양을 입력하세요</b></h4>
          <input type="text" name="walk" placeholder="걸은 양을 입력하세요">
        </div>
      </div>

      <div class="card">
        <img src="water.png" alt="Water" style="width:100%">
          <div class="container">
          <h4><b>물의 양을 입력하세요</b></h4>
          <input type="text" name="water" placeholder="물의 양을 입력하세요">
        </div>
      </div>

      <div class="card">
        <img src="sleep.jpg" alt="sleep" style="width:100%">
        <div class="container">
          <h4><b>수면 양을 입력하세요</b></h4>
          <input type="text" name="sleep" placeholder="몇시간 주무셨습니까?">
        </div>
      </div>


      <div class="input_button">
        <input type="submit" name="Join-button">
        <input type="reset" name="reset-button">
      </div>
    </form>

  </div>

  <div class="sikdan">
    <form name="inputsikdan" method="post" action="healthcare_sikdan.php">
      <h3>식단 checklist 입니다.</h3>
      <div class="director">
        <input type="radio" id="r1" name="date" checked="checked" value="<?=$time?>" />
        <label for="r1"><span></span>오늘날짜로 기록할래요.</label>
        <p>
          <input type="radio" id="r2" name="date" value="<?=$tommorrow?>" />
          <label for="r2"><span></span>내일 날짜로 기록할게요. </label>
      </div>
    <input type="text" name="sikdan" placeholder="음식 이름">
    <input type="text" name="calorie" placeholder="칼로리">
      <div class="input_button">
        <input type="submit" name="Join-button">
        <input type="reset" name="reset-button">
      </div>
    </form>
  </div>

  <div class="weight">
    <form name="inputweight" method="post" action="healthcare_weight.php">
      <h3>웨이트 트레이닝 checklisk 입니다.</h3>
      <div class="director">
        <input type="radio" id="w1" name="date1" checked="checked" value="<?=$time?>" />
        <label for="w1"><span></span>오늘날짜로 기록할래요.</label>
        <p>
          <input type="radio" id="w2" name="date1" value="<?=$tommorrow?>" />
          <label for="w2"><span></span>내일 날짜로 기록할게요. </label>
      </div>
    <input type="text" name="part" placeholder="운동부위">
    <input type="text" name="name" placeholder="운동이름">
    <input type="text" name="time" placeholder="횟수">
      <div class="input_button">
        <input type="submit" name="Join-button">
        <input type="reset" name="reset-button">
      </div>
    </form>
  </div>

    </div>



  </body>
</html>
