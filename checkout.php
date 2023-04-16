<?php $title = "تسویه حساب";

require_once __DIR__.'/header.php'; 

$phone = '';

if(isset($_COOKIE['phone'])) $phone = $_COOKIE['phone'];

if(isset($_POST['submit']) || isset($_GET['submit'])){
    if(!empty($_COOKIE['phone'])){
        if(empty($_COOKIE['orders'])) die("<script>alert('سید خریدتان خالیست!');</script>");
        cache_create('user',qta("SELECT `id`,`buyed_offer_product` FROM `users` WHERE `phone`=".$_COOKIE['phone'].";"));
        $user = cache_read('user');
        $id = $user[0];
        cache_create('decode',json_decode($_COOKIE['orders'],true));
        foreach(cache_read('decode') as $order){
            cache_create('fetch',qta("SELECT `name`,`offer`,`amount` FROM `products` WHERE `id`=$order"));
            $fetch = cache_read('fetch');
            if($fetch[1]==1){
                if($user[1]==1) die("<script>alert('شما نمیتوانید محصول تخفیف دار دیگری بخرید،قبلا یک محصول تخفیف دار خریداری کرده اید!');</script>");
                query("UPDATE `users` SET `buyed_offer_product` = '1' WHERE `users`.`id` = $id; ");
            }
            query("UPDATE `products` SET `amount` = '".--$fetch[2]."' WHERE `products`.`id` = $order;");
            query("INSERT INTO `orders` (`user_id`, `product_id`) VALUES ('$id', '$order');");
            setcookie("orders",'');
            die('<script>window.location="thank.php"</script>');
        }
    }else{
        setcookie("phone",$_POST['phone']);
        if(empty(qta("SELECT `id` FROM `users` WHERE `phone`=".$_POST['phone'].";")[0])) query("INSERT INTO `users` (`phone`, `buyed_offer_product`) VALUES ('".$_POST['phone']."', '0');");
        echo '<script>window.location="checkout.php?submit=true"</script>';
    }
}

?>
        <section class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-lg-8">
                        <div class="card rounded shadow p-4 border-0">
                            <h4 class="mb-3">جزئیات</h4>
                            <form class="needs-validation" method="post">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="phone" class="form-label">شماره تلفن</label>
                                        <div class="input-group has-validation">
                                            <input type="text" name="phone" class="form-control" id="phone" value="<?php echo $phone; ?>" placeholder="09123456789" required>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <button class="w-100 btn btn-primary" name="submit" type="submit">پرداخت</button>
                            </form>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end container-->
        </section><!--end section-->
<?php require_once __DIR__.'/footer.php'; ?>