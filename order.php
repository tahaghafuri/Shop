<?php $title = "سفارش";
require_once __DIR__.'/header.php';
$array = [];
if(isset($_GET['id'])){
    if(empty($_COOKIE['orders'])){
        setcookie('orders',json_encode((array)$_GET['id']));
    }else{
        $decode = json_decode($_COOKIE['orders'],true);
        if(!in_array($_GET['id'],$decode)) setcookie('orders',json_encode(array_merge($decode,(array)$_GET['id'])));
    }
    echo '<script>window.location="order.php"</script>';
}elseif(isset($_GET['delete'])){
    $decode = json_decode($_COOKIE['orders'],true);
    if(in_array($_GET['delete'],$decode)) setcookie('orders',json_encode(array_diff($decode,(array)$_GET['delete'])));
    echo '<script>window.location="order.php"</script>';
} ?>
        <section class="section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive bg-white shadow rounded">
                            <table class="table mb-0 table-center">
                                <thead>
                                    <tr>
                                        <th class="border-bottom py-3" style="min-width:20px "></th>
                                        <th class="border-bottom text-start py-3" style="min-width: 300px;">محصول</th>
                                        <th class="border-bottom text-center py-3" style="min-width: 160px;">قیمت</th>
                                        <th class="border-bottom text-end py-3 pe-4" style="min-width: 160px;">تخفیف</th>
                                    </tr>
                                </thead>

                                <tbody id="list">
                                    <?php if(!empty($_COOKIE['orders'])){
                                    foreach(json_decode($_COOKIE['orders'],true) as $product){
                                    cache_create('info',qta("SELECT * FROM `products` WHERE `id`=$product;"));
                                    $info = cache_read('info');
                                    cache_create('off',0);
                                    if($info[4]==1){
                                        $price = $info[3];
                                    }else{
                                        cache_create('off',($info[3] / 100) * qta("SELECT `offer` FROM `config` WHERE `id`=1;")[0]);
                                        $price = cache_read('off');
                                    }
                                    array_push($array,$price);
                                    ?>
                                    <tr class="shop-list">
                                        <td class="h6 text-center"><a href="?delete=<?php echo $product; ?>" class="text-danger"><i class="uil uil-times"></i></a></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="img/<?php echo $info[2]; ?>" class="img-fluid avatar avatar-small rounded shadow" style="height:auto;">
                                                <h6 class="mb-0 ms-3"><?php echo $info[1]; ?></h6>
                                            </div>
                                        </td>
                                        <input name="order[]" type="hidden" value="<?php echo $product; ?>" />
                                        <td class="text-center"><?php echo $info[3]; ?> تومان</td>
                                        <td class="text-end fw-bold pe-4"><?php echo cache_read('off'); ?> تومان</td>
                                    </tr>
                                    <?php }} ?>
                                </tbody>
                            </table>
                        </div><br><br>
                    </div><!--end col-->
                </div><!--end row-->
                <div class="row">
                    <div class="col-lg-8 col-md-6 mt-4 pt-2">
                        <a href="index.php" class="btn btn-primary">ادامه خرید</a>
                    </div>
                    <div class="col-lg-4 col-md-6 ms-auto mt-4 pt-2">
                        <div class="table-responsive bg-white rounded shadow">
                            <table class="table table-center table-padding mb-0">
                                <tbody>
                                    <tr class="bg-light">
                                        <td class="h6 ps-4 py-3">مجموع</td>
                                        <?php cache_create('price',implode("+",$array));
                                        eval('cache_create("price",'.cache_read('price').');'); ?>
                                        <td class="text-end fw-bold pe-4"><?php echo cache_read('price'); ?> تومان</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4 pt-2 text-end">
                            <a href="checkout.php" class="btn btn-primary">ثبت سفارش</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="assets/js/Sortable.min.js"></script>
        <script>
            new Sortable(document.getElementById('list'), {
                group: 'shared',
                animation: 150
            });
        </script>
<?php require_once __DIR__.'/footer.php'; ?>