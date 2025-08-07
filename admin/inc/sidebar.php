<style>
        .sidebar {
            width: 250px;
            background-color: #f8f9fa;
            padding: 10px;
            border: 1px solid #ddd; 
            border-radius: 5px; 
            font-family: Arial, sans-serif;
        }

        .menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .menuitem {
            display: block;
            font-size: 16px;
            font-weight: bold;
            padding: 10px;
            text-decoration: none;
            color: #333;
            border-bottom: 1px solid #ddd;
        }

        .menuitem:hover {
            background-color: #007bff;
            color: #fff;
        }

        .submenu {
            list-style: none;
            padding-left: 15px;
            margin: 5px 0;
        }

        .submenu li a {
            display: block;
            font-size: 14px;
            padding: 5px;
            text-decoration: none;
            color: #555;
        }

        .submenu li a:hover {
            color: #;
        }
    </style>
<div class="grid_2">
    <div class="">
        <div class="block" id="section-menu">
            <ul class="section menu">
                <li>
                    <a class="">Thương hiệu</a>
                    <ul class="submenu">
                        <li><a href="brandadd.php">Thêm thương hiệu</a></li>
                        <li><a href="brandlist.php">Danh sách thương hiệu</a></li>
                    </ul>
                </li>
                <li>
                    <a class="">Loại sản phẩm</a>
                    <ul class="submenu">
                        <li><a href="catadd.php">Thêm loại sản phẩm</a></li>
                        <li><a href="catlist.php">Danh sách loại sản phẩm</a></li>
                    </ul>
                </li>
                <li>
                    <a class="">Sản phẩm</a>
                    <ul class="submenu">
                        <li><a href="productadd.php">Thêm sản phẩm</a></li>
                        <li><a href="productlist.php">Danh sách sản phẩm</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>