<?php
$conn=new mysqli("localhost", "tuannq", "tuannq");
mysqli_select_db($conn, "qlshop");
var_dump($_POST);
if(isset($_POST["submit"])){
    $user=$_POST["user"];
    $pwd1=$_POST["pwd"];
    $result1=mysqli_query($conn, "SELECT * FROM admin where username='$user' AND passwd='$pwd1'");
    $rowcount1= mysqli_num_rows($result1);
    if($rowcount1==true){
//        echo "ĐĂNG NHẬP THÀNH CÔNG<br>";
        session_start();
        $_SESSION['login']=mysqli_fetch_assoc($result1);
        //var_dump($_SESSION['login']);
        header("location:admin.php");
        // echo "ok";
    }
    
    else{
        echo "TAI KHOAN HOAC MAT KHAU SAI <br>".$pwd."<br>".$_POST['pwd'];
    }

}
else if(isset($_POST["submitlogin"]))
{
    $user=$_POST["user"];
    $pwd1=$_POST["pwd"];
    echo $user;
    $result1=mysqli_query($conn, "SELECT * FROM customer where username='$user' AND passwd='$pwd1'");
    $rowcount1= mysqli_num_rows($result1);
    if($rowcount1==true){
//        echo "ĐĂNG NHẬP THÀNH CÔNG<br>";
        session_start();
        $_SESSION['login']=mysqli_fetch_assoc($result1);
        //var_dump($_SESSION['login']);
        header("location:home.php");

        // echo "ok";
    }
    
    else{
        echo "TAI KHOAN HOAC MAT KHAU SAI <br>".$pwd."<br>".$_POST['pwd'];
    }
}
else if(isset($_POST["submitsignup"]))
{
    $user=$_POST["user"];
    $sql="SELECT * FROM `customer` where `username`='".$user."'";
    $result1=mysqli_query($conn, $sql);
    $rowcount1= mysqli_num_rows($result1);
    if($rowcount1==true){
//        echo "ĐĂNG NHẬP THÀNH CÔNG<br>";
        // session_start();
        // $_SESSION['login']=mysqli_fetch_assoc($result1);
        //var_dump($_SESSION['login']);
        echo "Tai khoan da ton tai";
    }
    
    else{
        $sql = "INSERT into `customer`(`nameCustomer`,`addr`,`phone`,`username`,`passwd`) VALUES(?,?,?,?,?)";
        $st=$conn->prepare($sql);
        $st->bind_param("sssss",$_POST['name'],$_POST['address'],$_POST['phone'],$_POST['user'],$_POST['pwd']);
        $st->execute();
        header("location:login.php");
    }
}

?>