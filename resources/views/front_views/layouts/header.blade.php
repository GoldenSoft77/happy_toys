<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>متجر هابي توي</title>

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ asset('assets/images/icon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200&display=swap" rel="stylesheet">

    <!-- Vendor CSS (Icon Font) -->

    <link rel="stylesheet" href="{{ asset('assets/css/vendor/vendor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/fontawesome.min.css') }}">
    <!-- Main Style CSS -->

    <link rel="stylesheet" href="{{ asset('assets/css/plugins/plugins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />


</head>

<body>

    <!-- Header Section Start -->
    <div class="header section">
        <!-- PRELOADER -->
        <div id="preloader">
            <div class='baby'>
                <div class='head'>
                    <div class='eye'></div>
                    <div class='cheek'></div>
                    <div class='horn'></div>
                </div>
                <div class='back'>
                    <div class='tail'></div>
                    <div class='hand'></div>
                    <div class='feet'></div>
                    <div class='ass'></div>
                </div>
            </div>
        </div>
        <!-- /PRELOADER -->


        <!-- Header Bottom Start -->
        <div class="header-bottom">
            <div class="header-sticky">
                <div class="container">
                    <div class="row align-items-center position-relative">

                        <!-- Header Logo Start -->
                        <div class="col-md-6 col-lg-3 col-xl-2 col-6">
                            <div class="header-logo">
                                <a href="{{ url('/') }}"><img src="{{ asset('assets/images/logo.png') }}" alt="هابي توي"></a>
                            </div>
                        </div>
                        <!-- Header Logo End -->

                        <!-- Header Menu Start -->
                        <div class="col-lg-6 d-none d-lg-block">
                            <div class="main-menu">
                                <ul>
                                    <li class="has-children">
                                        <a href="{{ url('/') }}">الرئيسية </a>
                                    </li>
                                    <li><a href="{{ url('/about') }}">من نحن </a></li>
                                    <li><a href="{{ url('/products') }}">منتجاتنا </a></li>
                                    <li class="has-children">
                                        <a href="#">التصنيفات <i class="fa fa-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            @foreach ($categories as $category)
                                            @if ($category->id != 4)
                                            <li><a href="{{ url('/category/'.$category->id) }}"> {{ $category->translate('ar')->name }} </a></li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Header Menu End -->

                        <!-- Header Action Start -->
                        <div class="col-md-6 col-lg-3 col-xl-4 col-6 justify-content-end">
                            <div class="header-actions">
                                <!--  <a href="javascript:void(0)"
                                    class="header-action-btn header-action-btn-search d-none d-lg-block"><i
                                        class="pe-7s-search"></i></a> 
                                <div class="dropdown-user d-none d-lg-block">
                                    <a href="javascript:void(0)" class="header-action-btn"><i
                                            class="pe-7s-user"></i></a>
                                    <ul class="dropdown-menu-user">
                                        <li><a class="dropdown-item" href="#">Usd</a></li>
                                        <li><a class="dropdown-item" href="#">Pound</a></li>
                                        <li><a class="dropdown-item" href="#">Taka</a></li>
                                    </ul>
                                </div>
                                <a href="wishlist.html" class="header-action-btn header-action-btn-wishlist">
                                    <i class="pe-7s-like"></i>
                                </a>-->
                                <!-- <a href="javascript:void(0)" class="header-action-btn header-action-btn-cart">
                                    <i class="pe-7s-cart"></i>
                                    <span class="header-action-num">3</span>
                                </a> -->
                                <!-- Mobile Menu Hambarger Action Button Start -->
                                <a href="javascript:void(0)"
                                    class="header-action-btn header-action-btn-menu d-lg-none d-md-block">
                                    <i class="fa fa-bars"></i>
                                </a>
                                <!-- Mobile Menu Hambarger Action Button End -->

                            </div>
                        </div>
                        <!-- Header Action End -->

                    </div>
                </div>
            </div>
        </div>
        <!-- Header Bottom End -->

    </div>
    <!-- Header Section End -->

    <!-- Mobile Menu Start -->
    <div class="mobile-menu-wrapper">
        <div class="offcanvas-overlay"></div>

        <!-- Mobile Menu Inner Start -->
        <div class="mobile-menu-inner">

            <!-- Button Close Start -->
            <div class="offcanvas-btn-close">
                <i class="pe-7s-close"></i>
            </div>
            <!-- Button Close End -->

            <!-- Mobile Menu Inner Wrapper Start -->
            <div class="mobile-menu-inner-wrapper">
                <!-- Mobile Menu Search Box Start --
                <div class="search-box-offcanvas">
                    <form>
                        <input class="search-input-offcanvas" type="text" placeholder="ابحث...">
                        <button class="search-btn"><i class="pe-7s-search"></i></button>
                    </form>
                </div>
                <!-- Mobile Menu Search Box End -->

                <!-- Mobile Menu Start -->
                <div class="mobile-navigation">
                    <nav>
                        <ul class="mobile-menu">
                            <li>
                                <a href="{{ url('/') }}">الرئيسية</a>
                            </li>
                            <li><a href="{{ url('/about') }}">من نحن </a></li>
                            <li><a href="{{ url('/products') }}">منتجاتنا </a></li>
                            <li class="has-children">
                                <a href="#">التصنيفات <i class="fa fa-angle-down"></i></a>
                                <ul class="sub-menu">
                                    @foreach ($categories as $category)
                                        @if ($category->id != 4)
                                        <li><a href="{{ url('/category/'.$category->id) }}"> {{ $category->translate('ar')->name }} </a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!-- Mobile Menu End -->

                <!-- Contact Links/Social Links Start -->
                <div class="mt-2 bottom-0">

                    <!-- Contact Links Start -->
                    <ul class="contact-links">
                        <li><i class="fa fa-phone"></i><a href="tel:002001019715872"> +020 0101 971 5872</a></li>
                        <li><i class="fa fa-envelope-o"></i><a href="mailto:info@happytoyeg.com"> info@happytoyeg.com</a></li>
                    </ul>
                    <!-- Contact Links End -->

                    <!-- Social Widget Start -->
                    <div class="widget-social">
                        <a title="Facebook" href="https://www.facebook.com/happytoyeg" target="_blank"><i class="fa fa-facebook-f"></i></a>
                        <a title="Youtube" href="https://www.youtube.com/channel/UCbk0P83qtgyxGHqfIPelN0Q" target="_blank"><i class="fa fa-youtube"></i></a>
                        <a title="Vimeo" href="https://www.instagram.com/happytoyeg/" target="_blank"><i class="fa fa-instagram"></i></a>
                    </div>
                    <!-- Social Widget Ende -->
                </div>
                <!-- Contact Links/Social Links End -->
            </div>
            <!-- Mobile Menu Inner Wrapper End -->

        </div>
        <!-- Mobile Menu Inner End -->
    </div>
    <!-- Mobile Menu End -->

   