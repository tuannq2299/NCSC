<?php session_start();?>

<div class="row justify-content-center">
    <div class="col-md-11 bg light mt-2 rounded pb3">
    <h2 style="color: #de2219; text-align: center">QUẢN LÝ SẢN PHẨM  </h2>
    <hr>
        <div class="form-inline">
                <label for="search" class="font-weight-bold lead text-dark">Nhập tên sản phẩm</label>&nbsp;&nbsp;&nbsp;&nbsp;   
                <input type="text" name="sp" id="search_textsp"
                    class="form-control form-control-lg rounded-0 border-primary" placeholder="Tìm kiếm...">&nbsp;&nbsp;&nbsp;&nbsp; 
                <button class="btn-success form-control form-control-lg " id="btnsearchSp" name="btnsearch">Search</button>
        </div>
        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".dialogEdit" style="display: none;">Large modal</button> -->

        <div class="modal fade dialogEdit" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-lg" role="document" style="max-width: 50%">
            <div class="modal-content" style="padding: 50px 0px 0px 50px">
                <div class="modal-header">
                    <h4 class="modal-title">EDIT</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    
                </div>
                <div class="modal-body">
                    <form id = "editsp">
                         <div class="form-group row">
                            <label class="col-sm-4 col-form-label" >ID</label>
                            <div class="col-sm-8">
                              <input type="text" readonly class="form-control" id = "editID" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" >Tên sản phẩm</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id = "editnameprd" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" >Tên nhóm sản phẩm</label>
                            <div class="col-sm-8">
                                  <input type="text" readonly class="form-control" id = "editnamegrprd" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" >RAM</label>
                            <div class="col-sm-8">
                                  <input type="text" class="form-control" id = "editram" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" >ROM</label>
                            <div class="col-sm-8">
                                  <input type="text" class="form-control" id = "editrom" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" >CPU</label>
                            <div class="col-sm-8">
                                  <input type="text" class="form-control" id = "editcpu" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" >Pin</label>
                            <div class="col-sm-8">
                                  <input type="text" class="form-control" id = "editbattery" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" >Camera</label>
                            <div class="col-sm-8">
                                  <input type="text" class="form-control" id = "editcamera" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" >Kích thước màn hình</label>
                            <div class="col-sm-8">
                                  <input type="text" class="form-control" id = "editsize" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" >OS</label>
                            <div class="col-sm-8">
                                  <input type="text" class="form-control" id = "editos" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" >Màn hình</label>
                            <div class="col-sm-8">
                                  <input type="text" class="form-control" id = "editscreen" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" >Chức năng phụ</label>
                            <div class="col-sm-8">
                                  <input type="text" class="form-control" id = "editbonusfunction" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" >Giá</label>
                            <div class="col-sm-8">
                                  <input type="text" class="form-control" id = "editprice" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" >Ảnh đại diện</label>
                            <div class="col-sm-8">
                                  <input type="text" class="form-control" id = "editpicture" value="">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="updatedtb()">Save changes</button>
                </div>
            </div>
          </div>
        </div>
        <hr>
        <?php
            $conn = new mysqli("localhost","tuannq","tuannq","qlshop");
            $sql = "SELECT product.IDproduct, product.nameprd, groupproduct.namegrprd, product.price, product.ram,product.rom,product.cpu,product.battery,product.camera,product.size,product.OS,product.screen,product.bonusfunction,product.picture FROM product,groupproduct WHERE product.IDgrproduct=groupproduct.IDgrproduct";
            $st = $conn->prepare($sql);
            $st->execute();
            $result = $st->get_result();
        ?>
        <table class="table table-hover table-light table-striped" id=table-datasp>
            <thead>
                <tr>
                    <th class="text-center" style="vertical-align: top;">ID</th>
                    <th class="text-center" style="vertical-align: top;">Tên sản phẩm</th>
                    <th class="text-center" style="vertical-align: top;">Tên nhóm sản phẩm</th>
                    <th class="text-center" style="vertical-align: top;">Đơn giá</th>
                    <th class="text-center" style="vertical-align: top; display: none;">RAM</th>
                    <th class="text-center" style="vertical-align: top;display: none;">ROM</th>
                    <th class="text-center" style="vertical-align: top;display: none;">CPU</th>
                    <th class="text-center" style="vertical-align: top;display: none;">Pin</th>
                    <th class="text-center" style="vertical-align: top;display: none;">Camera</th>
                    <th class="text-center" style="vertical-align: top;display: none;">Kích thước màn hình</th>
                    <th class="text-center" style="vertical-align: top;display: none;">OS</th>
                    <th class="text-center" style="vertical-align: top;display: none;">Màn hình</th>
                    <th class="text-center" style="vertical-align: top;display: none;">Chức năng phụ</th>
                    <th class="text-center" style="vertical-align: top;display: none;">Ảnh</th>
                    <th class="text-center" style="vertical-align: top;">Chức năng</th>

                </tr>
            </thead>
            <tbody>
                <?php 
                    $i=1;
                    while($row=$result->fetch_assoc()){ ?>
                <tr>
                    <td width="10%"><input type="text" class="form-control" id="idsp<?php echo $i?>"
                            value="<?php echo $row['IDproduct']?>" disabled></td>
                    <td><input type="text" class="form-control" id="tensp<?php echo $i?>"
                            value="<?php echo $row['nameprd']?>" disabled></td>
                    <td><input type="text" class="form-control" id="nhomsp<?php echo $i?>"
                            value="<?php echo $row['namegrprd']?>" disabled></td>
                    <td><input type="text" class="form-control" id="price<?php echo $i?>"
                            value="<?php echo $row['price']?>" disabled></td>
                    <td style="display: none;"><input type="text" class="form-control" id="ram<?php echo $i?>"
                            value="<?php echo $row['ram']?>" disabled></td>
                    <td style="display: none;"><input type="text" class="form-control" id="rom<?php echo $i?>"
                            value="<?php echo $row['rom']?>" disabled></td>
                    <td style="display: none;"><input type="text" class="form-control" id="cpu<?php echo $i?>"
                            value="<?php echo $row['cpu']?>" disabled></td>
                    <td style="display: none;"><input type="text" class="form-control" id="pin<?php echo $i?>"
                            value="<?php echo $row['battery']?>" disabled></td>    
                    <td style="display: none;"><input type="text" class="form-control" id="camera<?php echo $i?>"
                            value="<?php echo $row['camera']?>" disabled></td>      
                    <td style="display: none;"><input type="text" class="form-control" id="size<?php echo $i?>"
                            value="<?php echo $row['size']?>" disabled></td> 
                    <td style="display: none;"><input type="text" class="form-control" id="os<?php echo $i?>"
                            value="<?php echo $row['OS']?>" disabled></td>
                    <td style="display: none;"><input type="text" class="form-control" id="screen<?php echo $i?>"
                            value="<?php echo $row['screen']?>" disabled></td>
                    <td style="display: none;"><input type="text" class="form-control" id="bonusfunction<?php echo $i?>"
                            value="<?php echo $row['bonusfunction']?>" disabled></td>
                    <td style="display: none;"><input type="text" class="form-control" id="picture<?php echo $i?>"
                            value="<?php echo $row['picture']?>" disabled></td>
                    <td width="15%">
                        <button type="button" name="edit" class="btn btn-primary btn-xs edit"
                            id="editspbtn<?php echo $i ?>" onclick="editsp()" data-toggle="modal" data-target=".dialogEdit">Sửa</button>
                        <button type="button" name="delete" class="btn btn-danger btn-xs delete"
                            id="delspbtn<?php echo $i ?>" onclick="xoasp()">Xóa</button>
                    </td>
                </tr>
                <?php $i=$i+1;}?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
      $("#btnsearchSp").click(function(){
        var search = $("#search_textsp").val();
        console.log(search);
        $.ajax({
            url: 'actionQL.php',
            method: 'post',
            data: {
                query: search,
                sp: 1
            },
            success: function(response) {
                $("#table-datasp").html(response);
            }
        });
      });
    });
function editsp() {
    var table = document.getElementById("table-datasp");
    var rows = table.getElementsByTagName("tr");
    for (i = 1; i <= rows.length; i++) {
        var currentRow = table.rows[i - 1];
        var createClickHandler = function(row, index) {
            return function() {
                var a1 = "idsp" + index;
                var a2 = "tensp" + index;
                var a3 = "nhomsp" + index;
                var a4 = "price" + index;
                var a5 = "ram" + index;
                var a6 = "rom" + index;
                var a7 = "cpu" + index;
                var a8 = "pin" + index;
                var a9 = "camera" + index;
                var a10 = "size" + index;
                var a11 = "os" + index;
                var a12 = "screen" + index;
                var a13 = "bonusfunction" + index;
                var a14 = "picture" + index;

                console.log(document.getElementById("editID").value);
                document.getElementById("editID").value = document.getElementById(a1).value;
                document.getElementById("editnameprd").value = document.getElementById(a2).value;
                document.getElementById("editnamegrprd").value = document.getElementById(a3).value;
                document.getElementById("editprice").value = document.getElementById(a4).value;
                document.getElementById("editram").value = document.getElementById(a5).value;
                document.getElementById("editrom").value = document.getElementById(a6).value;
                document.getElementById("editcpu").value = document.getElementById(a7).value;
                document.getElementById("editbattery").value = document.getElementById(a8).value;
                document.getElementById("editcamera").value = document.getElementById(a9).value;
                document.getElementById("editsize").value = document.getElementById(a10).value;
                document.getElementById("editos").value = document.getElementById(a11).value;
                document.getElementById("editscreen").value = document.getElementById(a12).value;
                document.getElementById("editbonusfunction").value = document.getElementById(a13).value;
                document.getElementById("editpicture").value = document.getElementById(a14).value;

            };
        };
        currentRow.onclick = createClickHandler(currentRow, i - 1);
    }
}


function updatedtb(){
    var a1=document.getElementById("editID").value;
    var a2=document.getElementById("editnameprd").value;
    var a3=document.getElementById("editnamegrprd").value;
    var a4=document.getElementById("editprice").value;
    var a5=document.getElementById("editram").value;
    var a6=document.getElementById("editrom").value;
    var a7=document.getElementById("editcpu").value;
    var a8=document.getElementById("editbattery").value;
    var a9=document.getElementById("editcamera").value;
    var a10=document.getElementById("editsize").value;
    var a11=document.getElementById("editos").value;
    var a12=document.getElementById("editscreen").value;
    var a13=document.getElementById("editbonusfunction").value;
    var a14=document.getElementById("editpicture").value;
    $.post("update.php", {
        updatesp: 1,
        idsp: a1,
        tensp: a2,
        nhomsp:a3,
        price:a4,
        ram:a5,
        rom:a6,
        cpu:a7,
        battery:a8,
        camera:a9,
        size:a10,
        os:a11,
        screen:a12,
        bonusfunction:a13,
        picture:a14
    }, function(data) {
        alert("Update thành công");
    });
}
function xoasp() {
    if(confirm("Xóa sản phẩm ?")){
        var table = document.getElementById("table-datasp");
        var rows = table.getElementsByTagName("tr");
        for (i = 1; i <= rows.length; i++) {
            var currentRow = table.rows[i - 1];
            var createClickHandler = function(row, index) {
                return function() {
                    var a1 = "idsp" + index;
                    var idsp = document.getElementById(a1).value;
                    console.log(idsp);
                    $.post("update.php", {
                        delsp: 1,
                        idsp: idsp
                    }, function(data) {
                        alert("Xóa thành công");
                    });
                    
                };
            };
            currentRow.onclick = createClickHandler(currentRow, i - 1);
        }
    }
    
}
</script>