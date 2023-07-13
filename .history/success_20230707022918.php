<?php include 'inc/header.php'; ?>

<?php
if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
    $customer_id = Session::get('customer_id');
    $insertOrder = $ct->insertOrder($customer_id);
    $delCart = $ct->dell_data_cart();
    header('Location: success.php');
}
?>

<div class="container p-5">
    <div class="row justify-content-center d-flex" style="gap: .4">
        <div class="col-md-12">
            <div class="  text-center" role="alert">
                <?php
                $customer_id = Session::get('customer_id');
                $get_amount = $ct->getAmountPrice($customer_id);
                $amount = 0;
                if ($get_amount) {
                    foreach ($get_amount as $result) {
                        $price = $result['price'];
                        $amount += $price;
                    }
                }
                ?>
                <h1 class="alert-heading">Chúng Tôi Cảm Ơn Bạn Đã Mua Hàng!</h1>

                <p class="mb-0 info ">Đơn hàng của bạn đang được chuẩn bị, Tổng Giá Trị đơn hàng bạn đã
                    đặt:

                </p>
                <span class="curr-price">
                    <?php echo $fm->formatNumber($amount) ?>
                </span>
                <?php
                $expectedDeliveryDate = date('d/m/Y', strtotime('+' . mt_rand(1, 4) . ' days'));
                ?>
                <p class="text-secondary">Ngày giao hàng dự kiến:
                    <?php echo $expectedDeliveryDate; ?>
                </p>
                <a class="btn btn-flat mt-3" href="./order-detail.php">Xem ngay</a>
            </div>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>