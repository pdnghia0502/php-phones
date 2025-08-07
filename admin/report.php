<?php
include_once 'inc/header.php';
include_once 'inc/sidebar.php';
include_once("../classes/report.php");

$report = new Report();
$data = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['filter'])) {
    $year = $_POST['year'];
    $month = $_POST['month'];
    $category = $_POST['category'];
    $data = $report->getSalesReport($year, $month, $category);
}
?>
<style>
    table.data {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 16px;
        text-align: left;
    }
    table.data thead tr {
        background-color: #009879;
        color: #ffffff;
        text-align: left;
        font-weight: bold;
    }
    table.data th, table.data td {
        border: 1px solid #dddddd;
        padding: 12px 15px;
    }
    table.data tbody tr {
        border-bottom: 1px solid #dddddd;
    }
    table.data tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }
    table.data tbody tr:last-of-type {
        border-bottom: 2px solid #009879;
    }
    table.data tbody tr:hover {
        background-color: #f1f1f1;
        cursor: pointer;
    }
    .btn-primary {
        background-color: #009879;
        color: #fff;
        border: none;
        padding: 5px 20px;
        border-radius: 5px;
        cursor: pointer;
    }
    .btn-primary:hover {
        background-color: #007960;
    }
    .form {
        margin-bottom: 20px;
    }
    .form label {
        font-weight: bold;
        margin-bottom: 5px;
        display: block;
    }
</style>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Thống kê sản phẩm bán được</h2>
        <div class="block">
            <form action="report.php" method="post">
                <table class="form">
                    <tr>
                        <td><label>Năm</label></td>
                        <td><input type="number" name="year" placeholder="Nhập năm..." class="medium" required /></td>
                    </tr>
                    <tr>
                        <td><label>Tháng</label></td>
                        <td>
                            <select name="month">
                                <option value="">Tất cả</option>
                                <?php for ($i = 1; $i <= 12; $i++): ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Loại sản phẩm</label></td>
                        <td>
                            <select name="category">
                                <option value="">Tất cả</option>
                                <?php
                                include_once("../classes/category.php");
                                $cat = new category();
                                $catlist = $cat->show_category();
                                if ($catlist) {
                                    while ($result = $catlist->fetch_assoc()) {
                                        echo "<option value='{$result['catId']}'>{$result['catName']}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button type="submit" name="filter" class="btn btn-primary">Thống kê</button></td>
                    </tr>
                </table>
            </form>

            <table class="data display">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Loại</th>
                        <th>Số lượng bán</th>
                        <th>Tổng tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data)): ?>
                        <?php foreach ($data as $row): ?>
                            <tr>
                                <td><?= $row['productName'] ?></td>
                                <td><?= $row['category'] ?></td>
                                <td><?= $row['quantity'] ?></td>
                                <td><?= number_format($row['price'], 0, ',', '.') ?> đ</td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">Không có dữ liệu</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>

<?php include_once 'inc/footer.php'; ?>
