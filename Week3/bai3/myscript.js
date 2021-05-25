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

                console.log(a1)
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


                // $.post("update.php", {
                //     updatekh: 1,
                //     idkh: idkh,
                //     tenkh: tenkh,
                //     addr: addr,
                //     phone: phone
                // }, function(data) {
                //     alert("Update thành công");
                // });
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
