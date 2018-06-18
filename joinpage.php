<!DOCTYPE html>
<?php

  session_start();
  $host = 'localhost';
  $user = 'root';
  $pw = 'chanki';
  $dbname = 'healthcare';
  $dbconnection = new mysqli($host, $user, $pw, $dbname);
  $dbconnection->set_charset("utf8");

 //password 받아온 값을 md5 해쉬화 해서 db랑 비교.

  $sql = "select teamname from userinfo where teamname is not null group by teamname ";

  $res = $dbconnection ->query($sql);

  ?>




<head>
    <meta charset="utf-8">
    <title>회원가입을 환영합니다</title>
  <style>
    .join-form{
      padding : 20px;
      background-color: white;
      float: left;
      width : 33%;
      z-index : 1;
      border-radius: .4rem;
      margin : 15% 33% 0 33%;


    }
    .join-form input{
        width: 99%;
        margin: 10px 0px;
        border-style: none;
        border-bottom : 3px dotted #282C34;
        padding: .5rem 0rem .5rem 0rem;
        padding-left: 5px;
        font-size : 1rem;
        outline: none;
    }
    body{
    background-color:  #282C34;
    }
    label{
      display: block;
    }
    .top h2{
      background-color: #E0E2E3;
      padding: 15px 10px;
      border-radius: .4rem;
      text-align : center;
    }

    .join_button input{
        background-color: #282C34;
        padding: 15px;
        border-radius : .4rem;
        font-size : 1rem;
        color : white;
        width :100%;

    }
    .select-team{
      font-style: italic;
      border-style: dotted;
      border-width: 4px;
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
  .director{
  margin-top: 10px;
}

  </style>

</head>
  <body>
    <div>
      <div class="join-form">
        <div class="top">
          <h2>HealthCare에 가입하기</h2>
        </div>
      <form name="login" method="post" action="join.php">
        <div class="join-email">
          <label for="email"><b>Email</b></label>
          <input type="email" name ="email" placeholder="아이디로 쓸 이메일">
        </div>
        <div class="join-password">
          <label for="password"><b>Password</b></label>
          <input type="password" name="password"  placeholder="비밀번호를 입력해주세요">
        </div>
        <div class="join-name">
          <label for="userName"><b>이름</b></label>
          <input type="text" name="userName"  placeholder="본인의 이름을 입력하세요.">
        <div class="joinTeamName">
            <label for="userName"><b>팀 이름</b></label>
            <input type="text" name="teamName"  placeholder="본인이 속한 팀의 이름을 입력하세요.">
        <div class="select-team">
            <b>존재하는 팀 목록입니다.</b> <br>
            <?php
              while ($row = mysqli_fetch_row($res)) {
               echo " "; echo $row[0]; echo ",";
               }
               ?>
        </div>
        <div class="director">
          <input type="radio" id="r1" name="director" value="true" />
          <label for="r1"><span></span>감독입니다.</label>
          <p>
            <input type="radio" id="r2" name="director" checked="checked" value="false" />
            <label for="r2"><span></span>일반 사용자입니다. </label>
        </div>
        <div class="join_button">
          <input type="submit" name="Join-button">
          <input type="reset" name="reset-button">
        </div>
      </form>

        </div>
      </div>
    </div>
  </body>
</html>
