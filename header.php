<?php require_once __DIR__.'/include/load.php'; ?>
<!doctype html>
<html lang="fa" dir="rtl">
    <head>
        <meta charset="utf-8" />
        <title><?php echo $title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="assets/libs/tiny-slider/tiny-slider.css" rel="stylesheet">
        <link href="assets/css/bootstrap-rtl.min.css" id="bootstrap-style" class="theme-opt" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons-rtl.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/@iconscout/unicons/css/line.css" type="text/css" rel="stylesheet" />
        <link href="assets/css/style-rtl.min.css" id="color-opt" class="theme-opt" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <header id="topnav" class="defaultscroll sticky">
            <div class="container">
                <a class="logo" href="index.php">
                    <img src="assets/favicon.png" height="24" class="logo-light-mode">
                    <img src="assets/favicon.png" height="24" class="logo-dark-mode">
                </a>

                <div class="menu-extras">
                    <div class="menu-item">
                        <a class="navbar-toggle" id="isToggle" onclick="toggleMenu()">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                    </div>
                </div>

                <ul class="buy-button list-inline mb-0">
                    <li class="list-inline-item mb-0">
                        <div class="dropdown">
                            <a href="order.php" class="btn btn-icon btn-pills btn-primary dropdown-toggle"><i data-feather="shopping-cart" class="icons"></i></a>
                        </div>
                    </li>
                </ul>

                <div id="navigation">
                    <ul class="navigation-menu">
                        <li><a href="index.php" class="sub-menu-item">صفحه اصلی</a></li>
                    </ul>
                </div>
            </div>
        </header>

        <section class="bg-half-170 bg-light d-table w-100">
            <div class="container">
                <div class="row mt-5 justify-content-center">
                    <div class="col-lg-12 text-center">
                        <div class="pages-heading">
                            <h4 class="title mb-0"> <?php echo $title; ?> </h4>
                        </div>
                    </div>
                </div>
            </div> 
        </section>
        <div class="position-relative">
            <div class="shape overflow-hidden text-color-white">
                <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
                </svg>
            </div>
        </div>