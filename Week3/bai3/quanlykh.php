<?php session_start();?>

<div class="row justify-content-center">
    <div class="col-md-11 bg light mt-2 rounded pb3">
    <h2 style="color: #de2219; text-align: center">QUẢN LÝ KHÁCH HÀNG  </h2>
    <hr>
        <div class="form-inline">
            <label for="search" class="font-weight-bold lead text-dark">Nhập tên khách hàng</label>&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="text" name="search" id="search_textkh"
                class="form-control form-control-lg rounded-0 border-primary" placeholder="Tìm kiếm...">
        </div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg" style="display: none;">Large modal</button>

        <hr>
        <?php
            $conn = new mysqli("localhost","tuannq","tuannq","qlshop");
            $sql = "SELECT customer.IDcustomer,customer.nameCustomer,customer.addr,customer.phone FROM customer";
            $st = $conn->prepare($sql);
            $st->execute();
            $result = $st->get_result();
        ?>
        <table class="table table-hover table-light table-striped" id=table-datakh>
            <thead>
                <tr>
                    <th class="text-center" style="vertical-align: top;">ID</th>
                    <th class="text-center" style="vertical-align: top;">Họ tên</th>
                    <th class="text-center" style="vertical-align: top;">Địa chỉ</th>
                    <th class="text-center" style="vertical-align: top;">Số điện thoại</th>
                    <th class="text-center" style="vertical-align: top;">Chức năng</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $i=1;
                    while($row=$result->fetch_assoc()){ ?>
                <tr>
                    <td width="10%"><input type="text" class="form-control" id="idkh<?php echo $i?>"
                            value="<?php echo $row['IDcustomer']?>" disabled></td>
                    <td><input type="text" class="form-control" id="tenkh<?php echo $i?>"
                            value="<?php echo $row['nameCustomer']?>"></td>
                    <td width="140px"><input type="text" class="form-control" id="addr<?php echo $i?>"
                            value="<?php echo $row['addr']?>"></td>
                    <td><input type="text" class="form-control" id="phone<?php echo $i?>"
                            value="<?php echo $row['phone']?>"></td>
                    <td width="15%">
                        <button type="button" name="edit" class="btn btn-primary btn-xs edit"
                            id="editkhbtn<?php echo $i ?>" onclick="capnhatkh()">Sửa</button>
                        <button type="button" name="delete" class="btn btn-danger btn-xs delete"
                            id="delkhbtn<?php echo $i ?>" onclick="xoakh()">Xóa</button>
                    </td>
                </tr>
                <?php $i=$i+1;}?>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
    $("#search_textkh").keyup(function() {
        var search = $(this).val();
        $.ajax({
            url: 'actionQL.php',
            method: 'post',
            data: {
                query: search,
                kh: 1
            },
            success: function(response) {
                $("#table-datakh").html(response);
            }
        });

    });
});

function capnhatkh() {
    var table = document.getElementById("table-datakh");
    var rows = table.getElementsByTagName("tr");
    for (i = 1; i <= rows.length; i++) {
        var currentRow = table.rows[i - 1];
        var createClickHandler = function(row, index) {
            return function() {
                var a1 = "idkh" + index;
                var a2 = "tenkh" + index;
                var a3 = "addr" + index;
                var a4 = "phone" + index;

                var idkh = document.getElementById(a1).value;
                var tenkh = document.getElementById(a2).value;
                var addr = document.getElementById(a3).value;
                var phone = document.getElementById(a4).value;
                $.post("update.php", {
                    updatekh: 1,
                    idkh: idkh,
                    tenkh: tenkh,
                    addr: addr,
                    phone: phone
                }, function(data) {
                    alert("Update thành công");
                });
            };
        };
        currentRow.onclick = createClickHandler(currentRow, i - 1);
    }
}

function xoakh() {
    if(confirm("Xóa khách hàng ?")){
        var table = document.getElementById("table-datakh");
        var rows = table.getElementsByTagName("tr");
        for (i = 1; i <= rows.length; i++) {
            var currentRow = table.rows[i - 1];
            var createClickHandler = function(row, index) {
                return function() {
                    var a1 = "idkh" + index;
                    var idkh = document.getElementById(a1).value;

                    $.post("update.php", {
                        delkh: 1,
                        idkh: idkh
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
