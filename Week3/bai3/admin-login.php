
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Quản lý mobilestore</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="./css/style.css">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script src="./myscript.js"></script>
  <style>
  	body{
	  background-image:url("background2.jpg");
	  background-size: cover;
	  background-position: initial;
	  background-repeat: no-repeat;
	}
	.container{
	  border: 1px solid #fff; 
	  padding: 50px 60px; 
	  margin-top: 20vh;
	  -webkit-box-shadow: -8px -1px 73px 1px rgba(0,0,0,0.75);
	  -moz-box-shadow: -8px -1px 73px 1px rgba(0,0,0,0.75);
	  box-shadow: -8px -1px 73px 1px rgba(0,0,0,0.75);
	}
	.form-control{
	  border: none;
	  background: transparent;
	  outline: none;
	  height: 40px;
	  color: #000;

	}
	.form-horizontal{
	  margin-left: 140px;
	}
  </style>
</head>
<body>
    <div class="container">
      
      <form class="form-horizontal" action="validate.php" method="POST">
        <h2>ĐĂNG NHẬP</h2>
        <div class="form-group">
          <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
          <label class="control-label col-sm-2" for="acc">Tài khoản:</label>
          <div class="col-sm-10">
              <input type="text" class="form-control" id="account" placeholder="Nhập tài khoản" name="user" value="<?php 
                if(isset($_SESSION["login"])){
                    echo $_SESSION["login"]["taikhoan"];
                }
              ?>">
          </div>
        </div>
        <div class="form-group">
          <span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
          <label class="control-label col-sm-2" for="pwd">Mật khẩu:</label>
          <div class="col-sm-10">          
            <input type="password" class="form-control" id="pwd" placeholder="Nhập mật khẩu" name="pwd" value="<?php 
                  if(isset($_SESSION["pwd"])){
                      echo $_SESSION["pwd"];
                  }
              ?>">
          </div>
        </div>
        <div class="form-group">        
          <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
              <label><input type="checkbox" name="remember" value="<?php 
                  if(isset($_SESSION["remember"])){
                      echo "checked";
                  }
              ?>"> Duy trì đăng nhập</label>
            </div>
          </div>
        </div>
        <div class="form-group">        
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-success btn-block" name="submit" value="Sent">Đăng nhập</button>
          </div>
        </div>
      </form>
    </div>       

</body>
</html>


