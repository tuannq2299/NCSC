<?php
$server = "localhost";
$username = "tuannq" ;
$pwd = "tuannq";
$conn = new mysqli($server,$username,$pwd);
// Create database
$sql = "CREATE DATABASE qlshop";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . $conn->error;
}

// Create table
mysqli_select_db($conn,"qlshop" );
$sql1 = "CREATE TABLE customer(
		IDcustomer int primary key auto_increment,
		nameCustomer varchar(20) not null,
		addr varchar(50) not null,
		phone varchar(15) not null,
		username varchar(20) not null,
		passwd varchar(50) not null
)";
$sql2 = "CREATE TABLE bill(
		IDbill int primary key auto_increment,
		IDcustomer int not null,
		totalPrice int not null,
		dateEstablish varchar(20) not null,
		foreign key (IDcustomer) references customer(IDcustomer)
)";
$sql3 = "CREATE TABLE groupproduct(
		IDgrproduct int primary key auto_increment,
		namegrprd nvarchar(20) not null

)";
$sql4 = "CREATE TABLE product(
		IDproduct int primary key auto_increment,
		IDgrproduct int not null,
		nameprd varchar(30) not null,
		ram varchar(10) not null,
		rom varchar(10) not null,
		cpu varchar(20) not null,
		battery varchar(10) not null,
		camera varchar(20) not null,
		size varchar(10) not null,
		OS varchar(10) not null,
		screen varchar(20) not null,
		bonusfunction varchar(50),
		price int not null,
		picture varchar(100) not null,
		foreign key (IDgrproduct) references groupproduct(IDgrproduct)
)";
$sql5 = "CREATE TABLE billdetail(
		IDbill int not null,
		IDproduct int not null,
		primary key(IDbill,IDproduct),
		price int not null,
		amount int not null,
		totalPrice int not null,
		foreign key (IDbill) references bill(IDbill),
		foreign key (IDproduct) references product(IDproduct)

)";
$sql6 = "CREATE TABLE admin(
		IDadmin int primary key auto_increment,
		name varchar(20),
		username varchar(20),
		passwd varchar(20)
)";
if(mysqli_query($conn,$sql1))
	echo "ok";
else
	echo "fail ".mysqli_error($conn);
$conn->query($sql2);
$conn->query($sql3);
$conn->query($sql4);
$conn->query($sql5);
$conn->query($sql6);
?>
