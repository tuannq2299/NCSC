<?php
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	$conn = new mysqli("localhost","tuannq","tuannq","qlshop");
	var_dump($_POST);
	$output='';
	if(isset($_POST['kh'])){
		if(isset($_POST['query'])){
			$search=$_POST['query'];
			$sql="SELECT customer.IDcustomer,customer.nameCustomer,customer.addr,customer.phone FROM customer
				WHERE customer.nameCustomer LIKE CONCAT('%',?,'%')";
			$st=$conn->prepare($sql);
			$st->bind_param("s",$search);
		}
		else{
			$st=$conn->prepare("SELECT customer.IDcustomer,customer.nameCustomer,customer.addr,customer.phone FROM customer");
		}
		$st->execute();
		$result=$st->get_result();

		if($result->num_rows>0){
			$output="<thead>
					<tr>
						<th class=\"text-center\" style=\"vertical-align: top;\">ID</th>
						<th class=\"text-center\" style=\"vertical-align: top;\">Họ tên</th>
						<th class=\"text-center\" style=\"vertical-align: top;\">Địa chỉ</th>
						<th class=\"text-center\" style=\"vertical-align: top;\">Số điện thoại</th>
						<th class=\"text-center\" style=\"vertical-align: top;\">Chức năng</th>
					</tr>
					</thead>
					<tbody>";
					$i=1;
					while($row=$result->fetch_assoc()){
					$output .="
						<tr>
							<td><input type=\"text\" class=\"form-control\" id=\"idkh".$i."\" value=\"".$row['IDcustomer']."\" disabled></td>
							<td><input type=\"text\" class=\"form-control\" id=\"tenkh".$i."\" value=\"".$row['nameCustomer']."\"></td>
							<td><input type=\"text\" class=\"form-control\" id=\"addr".$i."\" value=\"".$row['addr']."\"></td>
							<td><input type=\"text\" class=\"form-control\" id=\"phone".$i."\" value=\"".$row['phone']."\"></td>
							<td>
								<button type="."'button'"." name="."'edit'"." class="."'btn btn-primary btn-xs edit'"." id="."'editkhbtn".$i."' onclick=\"capnhatkh()\" >Sửa</button>
								<button type="."'button'"." name="."'delete'"." class="."'btn btn-danger btn-xs delete'"." id="."'delkhbtn".$i."' onclick=\"xoakh()\">Xóa</button>
							</td>

						</tr>
						
						";
					$i=$i+1;
					}
					$output .="</tbody>";
					echo $output."<script type=\"text/javascript\" src=\"myscript.js\"></script>\n";
		}
		else{
			echo "<h3> Không có kết quả tìm kiếm </h3>";
		}
	}
	if(isset($_POST['sp'])){
		if(isset($_POST['query'])){
			$search=$_POST['query'];
			$sql="SELECT product.IDproduct, product.nameprd, groupproduct.namegrprd, product.price, product.ram,product.rom,product.cpu,product.battery,product.camera,product.size,product.OS,product.screen,product.bonusfunction,product.picture FROM product,groupproduct WHERE product.IDgrproduct=groupproduct.IDgrproduct and product.nameprd LIKE CONCAT('%',?,'%')";
			$st=$conn->prepare($sql);
			$st->bind_param("s",$search);
		}
		else{
			$st=$conn->prepare("SELECT product.IDproduct, product.nameprd, groupproduct.namegrprd, product.price, product.ram,product.rom,product.cpu,product.battery,product.camera,product.size,product.OS,product.screen,product.bonusfunction,product.picture FROM product,groupproduct WHERE product.IDgrproduct=groupproduct.IDgrproduct ");
		}
		$st->execute();
		$result=$st->get_result();

		if($result->num_rows>0){
			$output="
					<thead>
		                <tr>
		                    <th class=\"text-center\" style=\"vertical-align: top;\">ID</th>
		                    <th class=\"text-center\" style=\"vertical-align: top;\">Tên sản phẩm</th>
		                    <th class=\"text-center\" style=\"vertical-align: top;\">Tên nhóm sản phẩm</th>
		                    <th class=\"text-center\" style=\"vertical-align: top;\">Đơn giá</th>
		                    <th class=\"text-center\" style=\"vertical-align: top; display: none;\">RAM</th>
		                    <th class=\"text-center\" style=\"vertical-align: top;display: none;\">ROM</th>
		                    <th class=\"text-center\" style=\"vertical-align: top;display: none;\">CPU</th>
		                    <th class=\"text-center\" style=\"vertical-align: top;display: none;\">Pin</th>
		                    <th class=\"text-center\" style=\"vertical-align: top;display: none;\">Camera</th>
		                    <th class=\"text-center\" style=\"vertical-align: top;display: none;\">Kích thước màn hình</th>
		                    <th class=\"text-center\" style=\"vertical-align: top;display: none;\">OS</th>
		                    <th class=\"text-center\" style=\"vertical-align: top;display: none;\">Màn hình</th>
		                    <th class=\"text-center\" style=\"vertical-align: top;display: none;\">Chức năng phụ</th>
		                    <th class=\"text-center\" style=\"vertical-align: top;display: none;\">Ảnh</th>
		                    <th class=\"text-center\" style=\"vertical-align: top;\">Chức năng</th>

		                </tr>
            		</thead>
		            <tbody>";
		                $i=1;
		                while($row=$result->fetch_assoc()){
		                $output.="
		                <tr>
		                    <td width=\"10%\"><input type=\"text\" class=\"form-control\" id=\"idsp".$i."\"
		                            value=\"".$row['IDproduct']."\" disabled></td>
		                    <td><input type=\"text\" class=\"form-control\" id=\"tensp".$i."\"
		                            value=\"".$row['nameprd']."\" disabled></td>
		                    <td><input type=\"text\" class=\"form-control\" id=\"nhomsp".$i."\"
		                            value=\"".$row['namegrprd']."\" disabled></td>
		                    <td><input type=\"text\" class=\"form-control\" id=\"price".$i."\"
		                            value=\"".$row['price']."\" disabled></td>
		                    <td style=\"display: none;\"><input type=\"text\" class=\"form-control\" id=\"ram".$i."\"
		                            value=\"".$row['ram']."\" disabled></td>
		                    <td style=\"display: none;\"><input type=\"text\" class=\"form-control\" id=\"rom".$i."\"
		                            value=\"".$row['rom']."\" disabled></td>
		                    <td style=\"display: none;\"><input type=\"text\" class=\"form-control\" id=\"cpu".$i."\"
		                            value=\"".$row['cpu']."\" disabled></td>
		                    <td style=\"display: none;\"><input type=\"text\" class=\"form-control\" id=\"pin".$i."\"
		                            value=\"".$row['battery']."\" disabled></td>    
		                    <td style=\"display: none;\"><input type=\"text\" class=\"form-control\" id=\"camera".$i."\"
		                            value=\"".$row['camera']."\" disabled></td>      
		                    <td style=\"display: none;\"><input type=\"text\" class=\"form-control\" id=\"size".$i."\"
		                            value=\"".$row['size']."\" disabled></td> 
		                    <td style=\"display: none;\"><input type=\"text\" class=\"form-control\" id=\"os".$i."\"
		                            value=\"".$row['OS']."\" disabled></td>
		                    <td style=\"display: none;\"><input type=\"text\" class=\"form-control\" id=\"screen".$i."\"
		                            value=\"".$row['screen']."\" disabled></td>
		                    <td style=\"display: none;\"><input type=\"text\" class=\"form-control\" id=\"bonusfunction".$i."\"
		                            value=\"".$row['bonusfunction']."\" disabled></td>
		                    <td style=\"display: none;\"><input type=\"text\" class=\"form-control\" id=\"picture".$i."\"
		                            value=\"".$row['picture']."\" disabled></td>
		                    <td width=\"15%\">
		                        <button type=\"button\" name=\"edit\" class=\"btn btn-primary btn-xs edit\"
		                            id=\"editspbtn<?php echo $i ?>\" onclick=\"editsp()\" data-toggle=\"modal\" data-target=\".dialogEdit\">Sửa</button>
		                        <button type=\"button\" name=\"delete\" class=\"btn btn-danger btn-xs delete\"
		                            id=\"delspbtn<?php echo $i ?>\" onclick=\"xoasp()\">Xóa</button>
		                    </td>
		                </tr>";
		                $i=$i+1;
		                }
		            $output.="</tbody>";
					echo $output."<script type=\"text/javascript\" src=\"myscript.js\"></script>\n";
		}
		else{
			echo "<h3> Không có kết quả tìm kiếm </h3>";
		}
	}
	if(isset($_POST['loadlist'])){
		if(!isset($_POST['type'])){
			$sql="SELECT product.IDproduct, product.nameprd, groupproduct.namegrprd, product.price, product.ram,product.rom,product.cpu,product.battery,product.camera,product.size,product.OS,product.screen,product.bonusfunction,product.picture FROM product,groupproduct WHERE product.IDgrproduct=groupproduct.IDgrproduct";
			$st=$conn->prepare($sql);
		}
		else
		{
			$sql="SELECT product.IDproduct, product.nameprd, groupproduct.namegrprd, product.price, product.ram,product.rom,product.cpu,product.battery,product.camera,product.size,product.OS,product.screen,product.bonusfunction,product.picture FROM product,groupproduct WHERE product.IDgrproduct=groupproduct.IDgrproduct and groupproduct.namegrprd='".$_POST['type']."'";
			$st=$conn->prepare($sql);
		}
		if(isset($_POST['name']))
		{
			$sql="SELECT product.IDproduct, product.nameprd, groupproduct.namegrprd, product.price, product.ram,product.rom,product.cpu,product.battery,product.camera,product.size,product.OS,product.screen,product.bonusfunction,product.picture FROM product,groupproduct WHERE product.IDgrproduct=groupproduct.IDgrproduct and product.nameprd LIKE CONCAT('%',?,'%')";
			$st=$conn->prepare($sql);
			$st->bind_param("s",$_POST['name']);
		}
		$st->execute();
		$result=$st->get_result();

		if($result->num_rows>0){
			$output="
			<ul>";
			$i=1;
			while($row=$result->fetch_assoc()){
				$output.="
				<li class=\"main-product no-margin";
				// if(i%4==0) $output.=" no-margin";
				$output.="\">
                    <div class=\"img-product\">
                        <img class=\"img-prd\" 
                            src=\"".$row['picture']."\"
                            alt=\"\" onclick=\"detailSP('".$i."')\" data-toggle=\"modal\" data-target=\".dialogDetail\" style=\"cursor: pointer;border:1px solid black;\">
                    </div>
                    <div class=\"content-product\">
                        <h3 class=\"content-product-h3\" id = \"".$i."\" onclick=\"detailSP('".$i."')\" data-toggle=\"modal\" data-target=\".dialogDetail\" style=\"cursor: pointer;\">".$row['nameprd']."</h3>
                        <h3 id=\"hiddendetailidsp".$i."\" style=\"display:none;\">".$row['IDproduct']."</h3>
                        <h3 id=\"hiddendetailtensp".$i."\" style=\"display:none;\">".$row['nameprd']."</h3>
                        <h3 id=\"hiddendetailnhomsp".$i."\" style=\"display:none;\">".$row['namegrprd']."</h3>
                        <h3 id=\"hiddendetailprice".$i."\" style=\"display:none;\">".$row['price']."</h3>
                        <h3 id=\"hiddendetailram".$i."\" style=\"display:none;\">".$row['ram']."</h3>
                        <h3 id=\"hiddendetailrom".$i."\" style=\"display:none;\">".$row['rom']."</h3>
                        <h3 id=\"hiddendetailcpu".$i."\" style=\"display:none;\">".$row['cpu']."</h3>
                        <h3 id=\"hiddendetailbattery".$i."\" style=\"display:none;\">".$row['battery']."</h3>
                        <h3 id=\"hiddendetailcamera".$i."\" style=\"display:none;\">".$row['camera']."</h3>
                        <h3 id=\"hiddendetailsize".$i."\" style=\"display:none;\">".$row['size']."</h3>
                        <h3 id=\"hiddendetailos".$i."\" style=\"display:none;\">".$row['OS']."</h3>
                        <h3 id=\"hiddendetailscreen".$i."\" style=\"display:none;\">".$row['screen']."</h3>
                        <h3 id=\"hiddendetailbonusfunction".$i."\" style=\"display:none;\">".$row['bonusfunction']."</h3>
                        <img id=\"hiddendetailpicture".$i."\" style=\"display:none;\" src=\"".$row['picture']."\" />

                        <div class=\"content-product-deltals\">
                            <div class=\"price\">
                                <span class=\"money\">".$row['price']."</span>
                            </div>
                            <button type=\"button\" class=\"btn btn-cart\">Thêm Vào Giỏ</button>
                        </div>
                    </div>
                </li>

            	";
            	$i=$i+1;
			}
			$output.="</ul>";
			echo $output."<script type=\"text/javascript\" src=\"cart.js\"></script>\n";
		}
	}
	if(isset($_POST['loadtable'])){

		$sql1="SELECT * FROM customer WHERE IDcustomer='".$_POST['id']."'";
		$st=$conn->prepare($sql1);
		$st->execute();
		$result=$st->get_result();
		if($result->num_rows>0){
			$output="<h2 class =\"justify-content-center\" style=\"margin-top:50px ;color: #de2219; text-align: center\">Thông tin cá nhân </h2>

			        ";
			$row=$result->fetch_assoc();
			$output.="<div>
					    <br />
					    <div class=\"row\">
					        <div class=\"col-md-2\">Họ và tên</div>
					        <div class=\"col-md-10\">
					            <input type=\"text\" id=\"ten\" class=\"form-control\" value=\"".$row['nameCustomer']."\">
					        </div>
					    </div>
					    <br />
					    <div class=\"row\">
					        <div class=\"col-md-2\">Địa chỉ</div>
					        <div class=\"col-md-10\">
					            <input type=\"text\" id=\"diachi\" class=\"form-control\" value=\"".$row['addr']."\">
					        </div>
					    </div>
					    <br />
					    <div class=\"row\">
					        <div class=\"col-md-2\">Số điện thoại</div>
					        <div class=\"col-md-10\">
					            <input type=\"text\" id=\"sdt\" class=\"form-control\" value=\"".$row['phone']."\">
					        </div>
					    </div>
					    <br />
					    <div class=\"row\">
					        <div class=\"col-md-2\">Username</div>
					        <div class=\"col-md-10\">
					            <input type=\"text\" id=\"username\" readonly class=\"form-control\" value=\"".$row['username']."\">
					        </div>
					    </div>
					    <br />
					    <div class=\"row\">
					        <div class=\"col-md-2\">Password</div>
					        <div class=\"col-md-10\">
					            <input type=\"text\" id=\"password\" class=\"form-control\" value=\"".$row['passwd']."\">
					        </div>
					    </div>
					    <br />
					    <div>
					        <button type=\"button\" class=\"btn btn-primary\" onclick=\"editinfo()\">Update</button>
					    </div>
					</div>";
				}
			$sql="SELECT billdetail.idbill,billdetail.IDproduct,billdetail.price,billdetail.amount,billdetail.totalPrice,product.nameprd,bill.dateEstablish FROM bill,billdetail,product
				WHERE bill.idbill=billdetail.idbill and billdetail.IDproduct=product.IDproduct and bill.idcustomer ='".$_POST['id']."'";
		$st=$conn->prepare($sql);
		$st->execute();
		$result=$st->get_result();
		if($result->num_rows>0){
			$output.="<h2 class =\"justify-content-center\" style=\"margin-top:50px ;color: #de2219; text-align: center\">Lịch sử mua hàng </h2>
			        <table class=\"table table-hover table-light table-striped\" id=\"tableHistory\" style=\"margin-top:50px;border: 2px solid black; \">
			        <thead>
					<tr>
						<th class=\"text-center\" style=\"vertical-align: top;\">Tên sản phẩm </th>
						<th class=\"text-center\" style=\"vertical-align: top;\">Đơn giá </th>
						<th class=\"text-center\" style=\"vertical-align: top;\">Số lượng </th>
						<th class=\"text-center\" style=\"vertical-align: top;\">Thành tiền </th>
						<th class=\"text-center\" style=\"vertical-align: top;\">Thời gian đặt </th>
					</tr>
					</thead>
					<tbody>";
					$i=1;
					while($row=$result->fetch_assoc()){
					$output .="
						<tr>
							<td><input type=\"text\" class=\"form-control\"  value=\"".$row['nameprd']."\" readonly></td>
							<td><input type=\"text\" class=\"form-control\"  value=\"".$row['price']."\" readonly></td>
							<td><input type=\"text\" class=\"form-control\"  value=\"".$row['amount']."\" readonly></td>
							<td><input type=\"text\" class=\"form-control\"  value=\"".$row['totalPrice']."\" readonly></td>
							<td><input type=\"text\" class=\"form-control\"  value=\"".$row['dateEstablish']."\" readonly></td>
						</tr>
						
						";
					$i=$i+1;
					}
					$output .="</tbody></table>";
					echo $output."<script type=\"text/javascript\" src=\"myscript.js\"></script>\n";
		}
		else{
			echo "<h3> Không có kết quả tìm kiếm </h3>";
		}
				// echo $output;
	}
?>
<script type="text/javascript">
	function detailSP(index){
		var a1 = "hiddendetailidsp" + index;
        var a2 = "hiddendetailtensp" + index;
        var a3 = "hiddendetailnhomsp" + index;
        var a4 = "hiddendetailprice" + index;
        var a5 = "hiddendetailram" + index;
        var a6 = "hiddendetailrom" + index;
        var a7 = "hiddendetailcpu" + index;
        var a8 = "hiddendetailbattery" + index;
        var a9 = "hiddendetailcamera" + index;
        var a10 = "hiddendetailsize" + index;
        var a11 = "hiddendetailos" + index;
        var a12 = "hiddendetailscreen" + index;
        var a13 = "hiddendetailbonusfunction" + index;
        var a14 = "hiddendetailpicture" + index;
        console.log(document.getElementById(a14).innerHTML);
        document.getElementById("detailnameprd").value = document.getElementById(a2).innerHTML;
        document.getElementById("detailnamegrprd").value = document.getElementById(a3).innerHTML;
        document.getElementById("detailprice").value = document.getElementById(a4).innerHTML;
        document.getElementById("detailram").value = document.getElementById(a5).innerHTML;
        document.getElementById("detailrom").value = document.getElementById(a6).innerHTML;
        document.getElementById("detailcpu").value = document.getElementById(a7).innerHTML;
        document.getElementById("detailbattery").value = document.getElementById(a8).innerHTML;
        document.getElementById("detailcamera").value = document.getElementById(a9).innerHTML;
        document.getElementById("detailsize").value = document.getElementById(a10).innerHTML;
        document.getElementById("detailos").value = document.getElementById(a11).innerHTML;
        document.getElementById("detailscreen").value = document.getElementById(a12).innerHTML;
        document.getElementById("detailbonusfunction").value = document.getElementById(a13).innerHTML;
        document.getElementById("detailpicture").src = document.getElementById(a14).src;
	}
	

</script>
 