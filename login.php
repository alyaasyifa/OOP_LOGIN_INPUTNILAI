<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="stylelog.css">
    <title>Document</title>
</head>
<body>
<div class="container" id="container">
	<div class="form-container sign-in-container">
		<form action="" method="POST">
			<h1>Login</h1>
			<span>or use your account</span>
            <input type="username" placeholder="Username" name="username">
            <input type="password" placeholder="Password" name="pwd">
			<button name="login">Login</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-right">
				<h1>Hello!!</h1>
				<p>Selamat datang di web kami :p</p>
			</div>
		</div>
	</div>

    <?php
    include "koneksilog.php";
    session_start();

    if( isset($_SESSION["login"])){
        header("location: hitungnilai.php");
        exit;
    }

    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['pwd'];

        $qry = $conn->query("SELECT * FROM users WHERE username='$username' AND password='$password'");
        $result = mysqli_num_rows($qry);

        if($result == 1){
            $data = $qry->fetch_assoc();

            $_SESSION['login'] = $data;
            echo "<script>alert('Login Berhasil!');window.location = 'hitungnilai.php';</script>";
        }else{
            echo "<script>alert('Username atau password Anda salah. Silahkan coba lagi!');window.location = 'login.php';</script>";
        }
    }
    ?>

    
</body>
</html>