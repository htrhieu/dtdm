<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $phone = mysqli_real_escape_string($conn, $_POST['phone']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('truy vấn thất bại');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'người dùng đã tồn tại!';
   }else{
      mysqli_query($conn, "INSERT INTO `user_form`(name, phone, email, password) VALUES('$name','$phone', '$email', '$pass')") or die('truy vấn thành công');
      $message[] = 'đã đăng ký thành công!';
      header('location:login.php');
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>
   
<div class="form-container">

   <form action="" method="post">
      <h3>đăng ký ngay bây giờ</h3>
      <input type="text" name="name" required placeholder="enter username" class="box">
      <input type="email" name="email" required placeholder="enter email" class="box">
      <input type="number" name="phone" required placeholder="enter phone" class="box">
      <input type="password" name="password" required placeholder="enter password" class="box">
      <input type="password" name="cpassword" required placeholder="confirm password" class="box">
      <input type="submit" name="submit" class="btn" value="register now">
      <p>Bạn đã có tài khoản ? <a href="login.php">Đăng nhập ngay</a></p>
   </form>

</div>

</body>
</html>