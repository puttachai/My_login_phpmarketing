<?php
include 'condb.php'; 
session_start();

$username=$_POST['username'];
$password=$_POST['password'];

//ใช้เข้ารหัส password ด้วย sha512
$password=hash('sha512',$password);

$sql = "SELECT * FROM tb_employee WHERE username='$username' and password='$password'";
$result=mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);
$status=$row['status'];//เก็บค่า status เพื่อเอามา check ว่า 0 หรือ 1

if($row > 0){//ตรวจสอบตัวแปร $row ว่ามีข้อมูลมากว่า 0 หรือเปล่าถ้าจริงแสดงว่ามีข้อมูล user - pass ถูกต้อง
    //ต้นกำหนดของการสร้าง Session 
    $_SESSION["user"]=$row['username'];
    $_SESSION["pass"]=$row['password'];
    $_SESSION["userid"]=$row['id'];
    $_SESSION["fname"]=$row['name'];
    $_SESSION["lname"]=$row['lastname'];
    //ckeck status
    if ($status=='0') {
        $show=header("location:index.php");
    }elseif($status=='1'){
        $show=header("location:admin/report_order.php");
    }
    //$show=header("location:index.php");
}else{
   $_SESSION["Error"]="<p>Please enter your Username and Password</p>" ;
   $show=header("location:fr_login.php");
}
echo $show;
?>
