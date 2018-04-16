<?php
session_start();



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
    font-size: 1.5rem;
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
    font-size: 1.5rem;
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
  form{
    background-color: ivory;
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
        <?=$_SESSION['login_session']['teamName']; ?>(팀)에 속해 계시는 <?=$_SESSION['login_session']['name']; ?>님 반갑습니다.
      </div>

      <form name="inputHealth" method="post" action="healthcare_Input.php">

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


      <div class="rank">

      </div>

      <div class="talks">

      </div>

    </div>



  </body>
</html>
