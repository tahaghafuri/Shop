<?php $title = "محصولات";
require_once __DIR__.'/header.php'; ?>
        <section class="section">
            <div class="container">
                <div class="row align-items-center">
                <?php cache_create('query', query("SELECT * FROM `products`"));
                foreach(all(cache_read('query')) as $product){ ?>
                    <div class="col-lg-6 mt-4 pt-2">
                        <div class="card shop-list border-0 shadow position-relative">
                            <ul class="label list-unstyled mb-0">
                                <?php if($product[4]==1){ ?>
                                <div class="badge badge-link rounded-pill bg-success">ویژه</div>
                                <?php } ?>
                                <?php if($product[5]==0){ ?>
                                <div class="badge badge-link rounded-pill bg-warning">ناموجود</div>
                                <?php } ?>
                            </ul>
                            <div class="row align-items-center g-0">
                                <div class="col-lg-4 col-md-6">
                                    <div class="shop-image position-relative overflow-hidden">
                                        <p><img src="img/<?php echo $product[2]; ?>" class="img-fluid"></p>
                                        <?php if($product[5]==0){ ?>
                                        <div class="overlay-work">
                                            <div class="py-2 bg-soft-dark rounded-bottom out-stock">
                                                <h6 class="mb-0 text-center">ناموجود</h6>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="col-lg-8 col-md-6" style="text-align:center;">
                                    <div class="card-body content p-4">
                                        <p class="text-dark product-name h6"><?php echo $product[1]; ?></p>
                                        <div class="d-lg-flex align-items-center mt-2 mb-3">
                                            
                                            <h6 class="text-muted small fst-italic mb-0 me-3"><?php echo $product[3]; ?> تومان <?php if($product[4]){ ?><span class="text-success ms-1"><?php echo qta("SELECT `offer` FROM `config` WHERE `id`=1;")[0];?>% تخفیف</span><?php } ?> </h6>
                                        </div>
                                    </div>
                                    <p>موجود در انبار:<?php echo $product[5]; ?></p>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mt-2 list-inline-item"><a href="<?php if($product[5]!=0){ ?>order.php?id=<?php echo $product[0]; }else{ echo "javascript:alert('محصول ناموجود است')"; } ?>" class="btn btn-icon btn-pills btn-soft-primary"><i data-feather="shopping-cart" class="icons"></i></a></li>
                                    </ul>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </section>
<?php require_once __DIR__.'/footer.php'; ?>