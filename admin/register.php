<?php
include_once("../classes/adminlogin.php");

$class = new adminlogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$adminName = $_POST['adminName'];
	$adminEmail = $_POST['adminEmail'];
	$adminUser = $_POST['adminUser'];
	$adminPass = $_POST['adminPass'];

	$register_check = $class->register_admin($adminName, $adminEmail, $adminUser, $adminPass);
}
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Đăng ký</title>
<link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
	<div class="container">
		<section id="content">
			<form action="register.php" method="post">
				<h1>Đăng Ký</h1>
				<span>
					<?php
					if (isset($register_check)) {
						echo $register_check;
					}
					?>
				</span>
				<div>
					<input type="text" placeholder="Họ và tên" required="" name="adminName" />
				</div>
				<div>
					<input type="text" placeholder="Email" required="" name="adminEmail" />
				</div>
				<div>
					<input type="text" placeholder="Tên đăng nhập" required="" name="adminUser" />
				</div>
				<div>
					<input type="password" placeholder="Mật khẩu" required="" name="adminPass" />
				</div>
				<div>
                    <h2><a href="login.php" type="submit">Đăng nhập</a></h2>
					<input type="submit" value="Đăng ký" />
				</div>
			</form>
		</section>
	</div>
</body>
</html>
