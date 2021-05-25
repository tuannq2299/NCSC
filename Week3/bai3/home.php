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
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" >
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
                <div class="form-inline" >
                  <input id="searchName" class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success my-2 my-sm-0" onclick="searchPhone()" style="background-color: white   ;"><i class="fa fa-search" aria-hidden="true" ></i></button>
                  </div>
                <!-- </form> -->
            </div>
        </nav>


    </header>
    <!-- content -->

    <div class="container" >
        <div class="modal fade dialogDetail" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-lg" role="document" style="max-width: 50%">
            <div class="modal-content" style="padding: 50px 0px 0px 50px">
                <div class="modal-header">
                    <h4 class="modal-title">Detail</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    
                </div>
                <div class="modal-body">
                    <form id = "detailsp">
                         <div class="form-group row">
                            <img id ="detailpicture" src="" style="width: 120px;height: 150px" />
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" >Tên sản phẩm</label>
                            <div class="col-sm-8">
                              <input type="text" readonly class="form-control" id = "detailnameprd" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" >Tên nhóm sản phẩm</label>
                            <div class="col-sm-8">
                                  <input type="text" readonly class="form-control" id = "detailnamegrprd" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" >RAM</label>
                            <div class="col-sm-8">
                                  <input type="text" readonly class="form-control" id = "detailram" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" >ROM</label>
                            <div class="col-sm-8">
                                  <input type="text" readonly class="form-control" id = "detailrom" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" >CPU</label>
                            <div class="col-sm-8">
                                  <input type="text" readonly class="form-control" id = "detailcpu" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" >Pin</label>
                            <div class="col-sm-8">
                                  <input type="text" readonly class="form-control" id = "detailbattery" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" >Camera</label>
                            <div class="col-sm-8">
                                  <input type="text" readonly class="form-control" id = "detailcamera" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" >Kích thước màn hình</label>
                            <div class="col-sm-8">
                                  <input type="text" readonly class="form-control" id = "detailsize" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" >OS</label>
                            <div class="col-sm-8">
                                  <input type="text" readonly class="form-control" id = "detailos" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" >Màn hình</label>
                            <div class="col-sm-8">
                                  <input type="text" readonly class="form-control" id = "detailscreen" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" >Chức năng phụ</label>
                            <div class="col-sm-8">
                                  <input type="text" readonly class="form-control" id = "detailbonusfunction" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" >Giá</label>
                            <div class="col-sm-8">
                                  <input type="text" readonly class="form-control" id = "detailprice" value="">
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
          </div>
        </div>
        <div class="products" id="listProducts">
            <ul>
                <li class="main-product">
                    <!-- <div class="img-product">
                        <img class="img-prd"
                            src="1.jpeg"
                            alt="">
                    </div>
                    <div class="content-product">
                        <h3 class="content-product-h3">Áo khoác nam</h3>
                        <div class="content-product-deltals">
                            <div class="price">
                                <span class="money">300000đ</span>
                            </div>
                            <button type="button" class="btn btn-cart">Thêm Vào Giỏ</button>
                        </div>
                    </div> -->
                </li>

            </ul>
        </div>
    </div>
     <!-- footer -->
    <footer>
        <div class="footer-item">
            <!-- <div class="img-footer">
                <img src="img/logo.png" alt="" />
            </div> -->
            <div class="social-footer">
                <li><a target="_blank" href="https://www.facebook.com/tuannq.2299">
                        <i class="fa fa-facebook-square" aria-hidden="true"></i>
                    </a></li>
                <li><a target="_blank" href="https://github.com/tuannq2299">
                        <i class="fa fa-github-square" aria-hidden="true"></i>
                    </a></li>

            </div>
        </div>
    </footer>
</body>
<script type="text/javascript" src="cart.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $.ajax({
            url: 'actionQL.php',
            method: 'post',
            data: {
                loadlist: 1,
            },
            success: function(response) {
                $("#listProducts").html(response);
            }
        });

    });
    function filter(id){
        console.log(id);
        $.ajax({
            url: 'actionQL.php',
            method: 'post',
            data: {
                loadlist: 1,
                type:id
            },
            success: function(response) {
                $("#listProducts").html(response);
            }
        });
    }
    function searchPhone(){
        var name=$("#searchName").val()
        console.log(name);
        $.ajax({
            url: 'actionQL.php',
            method: 'post',
            data: {
                loadlist: 1,
                name:name
            },
            success: function(response) {
                $("#listProducts").html(response);
            }
        });
    }
</script>
