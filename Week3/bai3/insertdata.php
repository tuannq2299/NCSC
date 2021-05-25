<?php
$server = "localhost";
$username = "tuannq";
$passwd = "tuannq";
$conn = new mysqli($server,$username,$passwd);
mysqli_select_db($conn, "qlshop");
$sql1="INSERT INTO `customer`(`nameCustomer`, `addr`, `phone`, `username`, `passwd`) 
VALUES ('tuan','hanoi','0123456789','tuannq','tuannq'),
('hlinh','hanoi','0123456777','hlinh','hlinh')";
$sql2="INSERT INTO `groupproduct` (`namegrprd`) VALUES ('iphone'),('Xiaomi'),('Samsung')";
$sql3="INSERT INTO `product`(`IDgrproduct`, `nameprd`, `ram`, `rom`, `cpu`, `battery`, `camera`, `size`,  `OS`,`screen`,`price`, `picture`)VALUES
	('1','iPhone 12 Pro','6GB','128GB','Apple A14 Bionic (5 nm)','2815mAh','12MP','6,1','IOS','Full HD','30000000','https://drive.google.com/file/d/1gy-0vjAFlfYxKZ-jZhegMxya1cSJ4RFN/view?usp=sharing'),
	('1','iPhone 11 Pro','4GB','64GB','Apple A13 Bionic 6 nhân','3046 mAh','12MP','5,8','IOS','Full HD','20000000','hhttps://drive.google.com/file/d/1mK5jdPAhJAC7oddy79vOazoNt74A1u_i/view?usp=sharing'),
	('1','iPhone XS Max','4GB','64GB','Apple A12 Bionic 6 nhân','3174 mAh','12MP','6,5','IOS','Full HD','14000000','https://drive.google.com/file/d/1T1N_ksnrVjCd8uSIvZokvX2DQ2YXdtpB/view?usp=sharing'),
	('2','Xiaomi Mi10 Pro','8GB','256GB','Snapdragon 865 8 nhân','4500 mAh','64MP','6,67','Android 10','Full HD','15000000','https://drive.google.com/file/d/1MsN2Th366KKKcPFrnt9vR3rHh90uFCET/view?usp=sharing'),
	('2','Xiaomi Redmi K30 5G','6GB','64GB','Snapdragon 765G','4500mAh','64MP','6,67','Android 10 MIUI 11','Full HD','5000000','https://drive.google.com/file/d/1SUTuuseSox7ecyRvS05DiEBSx9gXV8j-/view?usp=sharing'),
	('2','Xiaomi Redmi K30 Ultra','6GB','128GB','Mediatek Dimensity 1000+','4500mAh','64MP','6,67','Android 10 MIUI 12','Full HD','7000000','https://drive.google.com/file/d/1tL9y3EFp_FkJCc-DZfxBR0M7o0t1Jaij/view?usp=sharing'),
	('3','Samsung Galaxy Note 10+','12GB','256GB','Exynos 9825','4300mAh','16MP','6,8','Android 9','2K','17000000','https://drive.google.com/file/d/1TPDCjaGeBd2EZEMYC3tXRTTkcId8O3-1/view?usp=sharing'),
	('3','Samsung Galaxy Ultra S21','12GB','256GB','Exynos 2100','5000mAh','108MP','6,8','Android 11','2K+','31000000','https://drive.google.com/file/d/1OvSeMaq4BfFvaqfcNhCXTL2mnlWg7sm_/view?usp=sharing'),
	('3','Samsung Galaxy Z Fold2 5G','12GB','256GB','Snapdragon 865+','4500mAh','12MP','6,23','Android 10','Full HD+','50000000','https://drive.google.com/file/d/1JdNzsnKSWpCU0aqeJmg2dTx3O3Zourex/view?usp=sharing')";
$conn->query($sql1);
$conn->query($sql2);
$conn->query($sql3);
?>