<?php
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>정보 변경</title>
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
  .inputHealth, .sikdan{
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
  .change-team , .delete-info{
    text-align: center;
    width: 100%;
    display: inline-block;
    border-radius: .4rem;
    background-color: #E0E2E3;
    margin-top: 40px;
    padding-bottom: 10px;
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

  <form action="changeteam.php" method="post">
    <div class="change-team">
      <input type="text" name="team" placeholder="바꾸고 싶은 팀 이름을 입력하세요">

        <div class="change_button">
          <input type="submit" name="Change-button">
          <input type="reset" name="reset-button">
        </div>
    </div>
  </form>

  <div class="delete-info">
    <h4>경고. 나의 헬스정보에 경쟁정보, 게시판 글 등 모든 내용이 지워집니다.
      확인 없이 누르면 바로 삭제됩니다. 위 작업은 되돌릴 수 없습니다.
    </h4>
    <a href="./delete.php">회원탈퇴하기 </a>
  </div>
