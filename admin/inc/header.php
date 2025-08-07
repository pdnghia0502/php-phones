<?php
include_once ("../lib/session.php");
Session::checkSession();
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
    <link href="css/table/demo_page.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery-3.6.4.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.sortable.min.js" type="text/javascript"></script>
    <script src="js/table/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="js/table/table.js" type="text/javascript"></script>
    <script src="js/setup.js" type="text/javascript"></script>
	 <script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
		    setSidebarHeight();
        });
    </script>

</head>
<body>
    <div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft logo">
                    <img src="img/ly-do-moi-san-pham-apple-lam-ra-deu-chay-hang.png" alt="Logo" />
				</div>
				<div class="floatleft middle">
					<h1>Admin Phone Store</h1>
					<p>applephone.com.vn</p>
				</div>
                <div class="floatright">
                    <div class="floatleft">
                        <img src="img/img-profile.jpg" alt="Profile Pic" /></div>
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <li> Xin chào <?php echo Session::get('adminName') ?></li>
                            <?php
                             if (isset($_GET['action']) && $_GET['action']=='logout'){
                                Session::destroy();
                             }
                            ?>
                            <li><a href="?action=logout">Đăng xuất</a></li>
                        </ul>
                    </div>
                </div>
                <div class="clear">
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
        <div class="grid_12">
            <ul class="nav main">
                <li class=""><a href="index.php">Trang chủ</a> </li>
				<li class=""><a href="changepassword.php">Đổi mật khẩu</a></li>
				<li class=""><a href="inbox.php">Đơn hàng</a></li>
                <li class=""><a href="report.php">Thống kê</a></li>
                <li class=""><a href="contact.php">Hỗ trợ</a></li>
            </ul>
        </div>
        <div class="clear">
        </div>
    