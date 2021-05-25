<?php
    session_start();
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mobile Store</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/styleHomepage.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="reponsive.css" />
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</head>

<body style="background-image: url('background2.jpg');">
    <!-- header -->
    <header>
        <nav class="navbar navbar-light justify-content-between" style="background-color: #009999;">
            <a class="navbar-brand" href="./home.php">Mobile Store</a>
                <div>
                    <button class="navbar-toggler" id="cart">
                        <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                        Giỏ Hàng
                    </button>
                    <div id="myModal" class="modal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Giỏ hàng</h5>
                            <span class="close">&times;</span>
                        </div>
                        <div class="modal-body">
                            <div class="cart-row">
                                <span class="cart-id cart-header cart-column" style="display: none;">ID</span>
                                <span class="cart-item cart-header cart-column">Sản Phẩm</span>
                                <span class="cart-price cart-header cart-column">Giá</span>
                                <span class="cart-quantity cart-header cart-column">Số Lượng</span>
                            </div>
                            <div class="cart-items">

                                <div class="cart-total">
                                    <strong class="cart-total-title">Tổng Cộng:</strong>
                                    <span class="cart-total-price">0VNĐ</span>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary close-footer">Đóng</button>
                                <button type="button" class="btn btn-primary order">
                                Thanh Toán
                                </button>
                            </div>
                            </div>
                        </div>
                  
                    </div>
                    <div class = "navbar-toggler d-inline" style="margin-right: 10px; ">
                        <a id="namecustomer" href="login.php" style="color: white;">
                        <?php
                            if(isset($_SESSION['login'])){
                                echo $_SESSION['login']['nameCustomer'];
                            }
                            else{
                                echo "Login";
                            }
                        ?>
                       </a>
                       <p id="idcustomer" style="display: none;"><?php
                            if(isset($_SESSION['login'])){
                                echo $_SESSION['login']['IDcustomer'];
                            }
                            else{
                                echo "ID";
                            }
                            ?>
                        </p>
                    </div>
                    <div class = "navbar-toggler d-inline" style="margin-right: 10px; ">
                       <a href="logout.php" style="color: white;">
                        <?php
                            if(isset($_SESSION['login'])){
                                echo "Logout";
                            }
                            else{
                                echo "";
                            }
                        ?>
                       </a>
                       
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
              </div>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item active">
                    <a class="nav-link" href="./home.php">Trang chủ <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item dropdown" >
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Hãng điện thoại 
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a id="Iphone" class="dropdown-item" href="#" onclick="filter('Iphone')">Iphone</a>
                      <a id="Xiaomi" class="dropdown-item" href="#" onclick="filter('Xiaomi')">Xiaomi</a>
                      <a id="Samsung" class="dropdown-item" href="#" onclick="filter('Samsung')">Samsung</a>
                      
                    </div>
                    <!-- <p id="temp" style="display: none;"></div> -->
                  </li>
                  
                </ul>
                <!-- <form class="form-inline my-2 my-lg-0"> -->
                <div class="form-inline">
                  <input id="searchName" class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success my-2 my-sm-0" onclick="searchPhone()"><i class="fa fa-search" aria-hidden="true"></i></button>
                  </div>
                <!-- </form> -->
            </div>
        </nav>


    </header>
    <div class= "container" id="tabHistory">
        <h2 class ="justify-content-center" style="margin-top:50px ;color: #de2219; text-align: center">Thông tin cá nhân</h2>
        <table class="table table-hover table-light table-striped" id="tableInfo" style="margin-top:50px;border: 2px solid black; ">
        </table>
        <h2 class ="justify-content-center" style="margin-top:50px ;color: #de2219; text-align: center">Lịch sử mua hàng </h2>
        <table class="table table-hover table-light table-striped" id="tableHistory" style="margin-top:50px;border: 2px solid black; ">
        </table>
    </div>
</body>
<script type="text/javascript">
    $(document).ready(function() {
        var id=$("#idcustomer").text().trim();
        var name=$("#namecustomer").text().trim();
        console.log(id+" "+name);
        $.ajax({
            url: 'actionQL.php',
            method: 'post',
            data: {
                loadtable: 1,
                id:id
            },
            success: function(response) {
                $("#tabHistory").html(response);
            }
        });

    });
    function editinfo(){
        var id=$("#idcustomer").text().trim();
        var ten = document.getElementById("ten").value;
        var diachi = document.getElementById("diachi").value;
        var sdt = document.getElementById("sdt").value;
        var username = document.getElementById("username").value;
        var passwd = document.getElementById("password").value;
        $.ajax({
          url:"update.php",
          method:'post',
          data:{
            updateinfo:1,
            idcustomer:id,
            ten:ten,
            diachi:diachi,
            sdt:sdt,
            username:username,
            passwd:passwd
          },
          success:function(data){
            // $("#namecustomer").html(data);
            alert("Update thành công !");
        }});
    }
</script>