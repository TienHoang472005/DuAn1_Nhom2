<!DOCTYPE html>
<html xmlns="assets\Admin\images\logo_bestbalo.png" xml:lang="en-US" lang="en-US">
<head>
    
    <meta charset="utf-8">
    <title>BestBalo - Website bán balo hàng đầu VN</title>
    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="assets/Admin/css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="assets/Admin/css/animation.css">
    <link rel="stylesheet" type="text/css" href="assets/Admin/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/Admin/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="assets/Admin/css/styles.css">



    <!-- Font -->
    <link rel="stylesheet" href="assets/Admin/font/fonts.css">

    <!-- Icon -->
    <link rel="stylesheet" href="assets/Admin/icon/style.css">

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="assets\Admin\images\logo_bestbalo.png">
    <link rel="apple-touch-icon-precomposed" href="assets\Admin\images\logo_bestbalo.png">

</head>
<body>
    <div id="wrapper">
        <div id="page">
            <div class="layout-wrap">
                <?php include 'app/Views/Admin/layouts/sidebar.php'; ?>
                <div class="section-content-right">
                    <?php include 'app/Views/Admin/layouts/header.php'; ?>
                    <div class="main-content">
                        <div class="main-content-inner">
                            <div class="main-content-wrap">
                                <div class="wg-box">
                                    <div class="title-box">Danh sách đơn hàng</div>
                                    
                                    <div class="wg-table table-product-list">
                                        <ul class="table-title flex gap20 mb-14">
                                            <li>STT</li>
                                            <li>Tên khách hàng</li>
                                            <li>Điện thoại</li>
                                            <li>Địa chỉ</li>
                                            <li>Tổng tiền</li>
                                            <li>Trạng thái</li>
                                            <li>Thao tác</li>
                                        </ul>
                                        <ul class="flex flex-column">
                                            <?php foreach ($orders as $index => $order): ?>
                                                <li class="wg-product item-row">
                                                    <div class="body-text"><?= $index + 1 ?></div>
                                                    <div class="body-text"><?= $order->name ?></div>
                                                    <div class="body-text"><?= $order->phone ?></div>
                                                    <div class="body-text"><?= $order->address ?></div>
                                                    <div class="body-text"><?= number_format($order->total) ?> VND</div>
                                                    <div>
                                                        <form action="#" method="post">
                                                            <input type="hidden" name="order_id" value="<?= $order->id ?>">
                                                            <select name="status" class="status-select">
                                                                <option value="pending" <?= $order->status == "pending" ? "selected" : "" ?>>Chờ xử lý</option>
                                                                <option value="completed" <?= $order->status == "completed" ? "selected" : "" ?>>Đã hoàn thành</option>
                                                                <option value="canceled" <?= $order->status == "canceled" ? "selected" : "" ?>>Đã hủy</option>
                                                            </select>
                                                        </form>
                                                    </div>
                                                   <div class="list-icon-function">
                                                         <div class="item eye">
                                                        <a href="#"><i class="icon-eye"></i></a>
                                                    </div> 
                                                   </div>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                    <div class="divider"></div>
                                    <div class="flex items-center justify-between flex-wrap gap10">
                                        <ul class="wg-pagination">
                                            <li><a href="#"><i class="icon-chevron-left"></i></a></li>
                                            <li><a href="#">1</a></li>
                                            <li class="active"><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#"><i class="icon-chevron-right"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php include 'app/Views/Admin/layouts/footer.php'; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="assets/Admin/js/jquery.min.js"></script>
    <script src="assets/Admin/js/bootstrap.min.js"></script>
    <script src="assets/Admin/js/main.js"></script>
    <script>
        document.querySelectorAll(".status-select").forEach(select => {
            select.addEventListener("change", function() {
                this.form.submit();
            });
        });
    </script>
</body>
</html>
