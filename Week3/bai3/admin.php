<?php session_start();
	if(!isset($_SESSION["login"]))
		header("location:admin-login.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Quản lý Shop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kanit&display=swap">

</head>

<body>
    <!-- Grey with black text -->
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="admin.php">
                    THÔNG TIN QUẢN LÝ 
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    QUẢN LÝ
                </a>
                <div class="dropdown-menu">
                    <div class="dropdown-item" onclick="qlkh()" style="cursor: pointer;">Quản lý khách hàng</div>
                    <div class="dropdown-item" onclick="qlsp()" style="cursor: pointer;">Quản lý sản phẩm </div>
<!--                     <div class="dropdown-item" onclick="qldonhang()" style="cursor: pointer;">Quản lý đơn hàng  </div> -->
                </div>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto mr-2">
            <li class="nav-item"><a class="nav-link" href="logout.php">ĐĂNG XUẤT</a></li>
        </ul>
    </nav>
    <div class="container mb-5" id="ttql">
        <div class="row justify-content-center">
        <div class="col-md-11 bg light mt-2 rounded pb3">
            <h1 style="color: #de2219; text-align: center">Thông tin quản lý </h1>
            <hr>
        </div>
        <div class="col-md-11 bg light mt-2 rounded pb3"><h3>
            <?php
                if(isset($_SESSION["login"])){
                        echo "ID: ".$_SESSION['login']['IDadmin']."<br><br>Name: ".$_SESSION['login']['name'];
                }
            ?>
                
        </h3></div>
    </div>
    </div>
</body>

<script type="text/javascript">
    function qlkh() {
        $.post("quanlykh.php", function(data) {
            $("#ttql").html(data);
        });
    }

    function qlsp() {
        $.post("quanlysp.php", function(data) {
            $("#ttql").html(data);
        });
    }

    // function qldonhang() {
    //     $.post("quanlydonhang.php", function(data) {
    //         $("#ttql").html(data);
    //     });
    // }
</script>

</html>