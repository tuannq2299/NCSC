<?php
session_start();
$conn = new mysqli("localhost","tuannq","tuannq","qlshop");
if (isset($_POST["updatekh"])) {
	$sql = "UPDATE customer SET `nameCustomer`='".$_POST['tenkh']."',`addr`='".$_POST['addr']."',`phone`='".$_POST['phone']."' WHERE `IDcustomer`='".$_POST['idkh']."'";
	$conn->query($sql);
}
else if (isset($_POST["updatesp"])) {
	$sql = "UPDATE product SET `nameprd`='".$_POST['tensp']."',`price`='".$_POST['price']."',`ram`='".$_POST['ram']."',`rom`='".$_POST['rom']."',`cpu`='".$_POST['cpu']."',`battery`='".$_POST['battery']."',`camera`='".$_POST['camera']."',`size`='".$_POST['size']."',`os`='".$_POST['os']."',`screen`='".$_POST['screen']."',`bonusfunction`='".$_POST['bonusfunction']."',`picture`='".$_POST['picture']."' WHERE `IDproduct`='".$_POST['idsp']."'";
	$conn->query($sql);
}
else if (isset($_POST["delkh"])) {
	$sql = "DELETE FROM customer WHERE `IDcustomer`='".$_POST['idkh']."'";
	$conn->query($sql);
}
else if (isset($_POST["delsp"])) {
	$sql = "DELETE FROM product WHERE `IDproduct`='".$_POST['idsp']."'";
	$conn->query($sql);
}
else if(isset($_POST["dathang"])){
	$ctime = date('H:m:s d-m-Y');
	$sql = "INSERT into bill(`IDcustomer`,`totalPrice`,`dateEstablish`) VALUE('".$_POST['idcustomer']."','".$_POST['total']."','".$ctime."')";
	$conn->query($sql);
	$sql1 = "SELECT `IDbill` FROM `bill` WHERE `dateEstablish`='".$ctime."'";
    $result = $conn->query($sql1);
	$row = $result->fetch_assoc();
	$id=$row['IDbill'];
	$id_list_temp=$_POST['id'];
	$price_list_temp=$_POST['price'];
	$quantity_list_temp=$_POST['quantity'];
	$id_list=array();
	$j=0;
	for($i=0;$i<strlen($id_list_temp);$i++){
		if($id_list_temp[$i]=='"'){
			$temp="";
			$i++;
			while($id_list_temp[$i]!='"'){
				$temp.=$id_list_temp[$i];
				$i++;
				if($id_list_temp[$i]=='"'){
					$id_list[$j]=$temp;
					$j++;
				}
			}
		}
	}
	$price_list=array();
	$j=0;
	for($i=0;$i<strlen($price_list_temp);$i++){
		if($price_list_temp[$i]=='['||$price_list_temp[$i]==','){
			$temp="";
			$i++;
			while($price_list_temp[$i]!=','){
				$temp.=$price_list_temp[$i];
				$i++;
				if($price_list_temp[$i]==','||$price_list_temp[$i]==']'){
					$price_list[$j]=$temp;
					$j++;
					$i--;
					break;
				}
			}
		}
	}
	$quantity_list=array();
	$j=0;
	for($i=0;$i<strlen($quantity_list_temp);$i++){
		if($quantity_list_temp[$i]=='"'){
			$temp="";
			$i++;
			while($quantity_list_temp[$i]!='"'){
				$temp.=$quantity_list_temp[$i];
				$i++;
				if($quantity_list_temp[$i]=='"'){
					$quantity_list[$j]=$temp;
					$j++;
				}
			}
		}
	}
	$num=(int)$_POST['sl'];
	$sql2 = "INSERT into `billdetail`(`IDbill`,`IDproduct`,`price`,`amount`,`totalPrice`) VALUES";
	for($i=0;$i<$num;$i++){
		$totalPrice=(int)$price_list[$i]*(int)$quantity_list[$i];
		$sql2.= "('".$id."','".$id_list[$i]."','".$price_list[$i]."','".$quantity_list[$i]."','".$totalPrice."')";
		if($i<$num-1)$sql2.=",";
	}
	$conn->query($sql2);

}
else if($_POST['updateinfo'])
{
	$sql = "UPDATE customer SET `nameCustomer`='".$_POST['ten']."',`addr`='".$_POST['diachi']."',`phone`='".$_POST['sdt']."',`passwd`='".$_POST['passwd']."' WHERE `IDcustomer`='".$_POST['idcustomer']."'";
	$conn->query($sql);
}

?>