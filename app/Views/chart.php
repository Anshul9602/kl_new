
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>khatri 567</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="image/icon.png" rel="icon">
    <link href="image/icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/aos/aos.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/glightbox/css/glightbox.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/swiper/swiper-bundle.min.css'); ?>" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?php echo base_url('assets/css/main.css'); ?>" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/debug.addIndicators.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/animation.gsap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.8/ScrollMagic.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.8/plugins/debug.addIndicators.min.js"></script>
    <!-- =======================================================
  * Template Name: Impact - v1.2.0
  * Template URL: https://bootstrapmade.com/impact-bootstrap-business-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <link href="<?php echo base_url('assets/css/mainpage.css'); ?>" rel="stylesheet">

<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

<body>

    <!-- ======= Header ======= -->
    <!-- End Top Bar -->

    <header id="header" class="header d-flex align-items-center addclass nav-down">

        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
            <a href="/" class="logo d-flex align-items-center">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <img src="<?php echo base_url('image/logo1.png'); ?>" style="max-width:250px;" alt="">
                <!-- <h1>ChargeSol<span>.</span></h1>  -->
            </a>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="#">Home</a></li>

                    <li><a href="#how">How to Play</a></li>
                    <li><a href="#rate">Rate Chart</a></li>
                </ul>
            </nav><!-- .navbar -->

            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

        </div>
    </header><!-- End Header -->
    <!-- End Header -->


    <style>
        .pannelchart_heading {
            display: flex;
        }

        .th-color_diff {
            flex: 0 0 12.4%;
            max-width: 12.4%;
            text-align: center;
            color: #fff;
            font-size: 16px;
            padding: 4px 0px;
        }

        .th-color_diff {
            background-color: #090c53;
        }

        .pannelchart_heading .day-h {
            border: 1px solid #000 !important;
        }

        .pannelchart_heading .day-h {
            flex: 0 0 12.4%;
            max-width: 12.4%;
            background: #c01d2e;
            border: solid 1px #fff;
            color: #fff;
            font-weight: 400;
            font-size: 16px;
            padding: 4px 0px;
            flex-wrap: wrap;
            text-align: center;
        }

        .pannel-details-contnet {
            display: flex;
        }

        .thdate {
            border: 1px solid #000 !important;
        }

        .pannel-details-contnet .date-con {
            border: 1px solid #000 !important;
        }

        .pannel-details-contnet .date-con {
            padding: 10px 4px;
            background: #f6f6f6;
            color: #164863;
            font-size: 14px;
            border: solid 1px #fff;
            flex: 0 0 12.4%;
            max-width: 12.4%;
            text-align: center;
        }

        .thdate {
            padding: 10px 4px;
            background: #f6f6f6;
            color: #164863;
            font-size: 14px;
            border: solid 1px #fff;
            flex: 0 0 12.4%;
            max-width: 12.4%;
            text-align: center;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <div class="kalyan_chart" style="min-height:100vh;">
        <div class="center-table">
            <div class="title-onilne text-center pb-3">
                <h4 class="title-black mt-5 pb-3">
                    <?php echo isset($tt) ? htmlspecialchars($tt) : 'Chart'; ?><?php echo isset($tth) ? ' (' . htmlspecialchars($tth) . ')' : ''; ?>
                </h4>
            </div>
            <div class="center-table pb-4">
                   <section class="my-table align-self-center row" style="    padding: 0 35px;">
      
        <?php   
        if (!empty($post)) {
            foreach ($post as $game){   
        ?>
        <div class="col-md-2 col-4 text-center row" style="display:flex;    border: 1px solid #000;    padding: 10px;    color: #000;">
            <h6 class="col-md-12">Date: <?php echo isset($game['result_date']) ? htmlspecialchars($game['result_date']) : ''; ?><hr></h6>
            <h5 class="bold col-md-4 mt-3" style="transform: rotate(90deg);"><?php echo isset($game['open_num']) ? htmlspecialchars($game['open_num']) : '***'; ?></h5>
            <p class="bold col-md-4 mt-3"><?php echo isset($game['start']) ? htmlspecialchars($game['start']) : '*'; ?><?php echo isset($game['end']) ? htmlspecialchars($game['end']) : '*'; ?></p>
            <h5 class="bold col-md-4 mt-3" style="transform: rotate(90deg);"><?php echo isset($game['close_num']) ? htmlspecialchars($game['close_num']) : '***'; ?></h5>
        </div>
        <?php 
            }
        } else {
            echo '<div class="col-12 text-center"><p>No results found for this game.</p></div>';
        }
        ?>
       </div>
       
    </section>
            </div>

        </div>
    </div>
    <style>
        @media (max-width: 767px) {
            .mt-2 {
                text-align: center;
            }

            .tc {
                text-align: center;
            }
        }

        .social_icon {
            font-size: 25px;
            color: #f26522 !important;
            display: none;
        }

        hr {
            border-top: 2px solid;
            opacity: 1;
        }

        .formPopup {
            background: rgba(0, 0, 0, 0.7);

            width: 100%;
            height: 100vh;
            display: none;
            position: fixed;
            left: 50%;
            top: 0%;
            transform: translate(-50%, 5%);
            border: 3px solid #999999;
            z-index: 4;

        }

        .formContainer {
            max-width: 700px;
            padding: 20px;
            background-color: #f26522;
        }



        .formContainer input[type=text]:focus,
        .formContainer input[type=password]:focus {
            background-color: #ddd;
            outline: none;
        }

        .formContainer .btn {
            padding: 12px 20px;
            border: none;

            color: #fff;
            cursor: pointer;
            width: 100%;
            margin-bottom: 15px;
            opacity: 0.8;
        }

        .formContainer .cancel {

            width: 50px;
        }

        .formContainer .btn:hover,
        .openButton:hover {
            opacity: 1;
        }
    </style>


    <footer class="main_footer" style="background: url('<?php echo base_url('assets/images/ruppesbg.png'); ?>') no-repeat top center; background-size: 100% 100%;">
        <button id="fcmbtnsubmit" onclick="startFCM()" class="btn btn-danger btn-flat d-none">Allow notification
        </button>
        <div class="container">
            <div class="row">
                <div class="logo_footer text-center pt-4 pb-2">

                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <div class="footer_links">

                            <ul class="d-flex justify-content-between">
                                <li><a href="#">Home</a></li>
                                <li><a href="">Post Guessing</a></li>


                                <li><a href="">Blog</a></li>
                                <li><a href="">Disclaimer</a></li>
                            </ul>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <hr>
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="footer-copy text-center">
                        <p class="py-3"><a href="">@2025 khatri 567</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

 

    <!-- Vendor JS Files -->
    <script>
        $(window).scroll(function() {
            var scroll = $(window).scrollTop();
            if (scroll <= 500) {
                $(".addclass").removeClass("addclass").addClass("stick");
            }
        })
    </script>

    <script>
        function openForm() {
            document.getElementById("popupForm").style.display = "block";
        }

        function closeForm() {
            document.getElementById("popupForm").style.display = "none";
        }

        function openForm1() {
            document.getElementById("popupForm1").style.display = "block";
        }

        function closeForm1() {
            document.getElementById("popupForm1").style.display = "none";
        }
    </script>

    <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/aos/aos.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/glightbox/js/glightbox.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/purecounter/purecounter_vanilla.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/swiper/swiper-bundle.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/isotope-layout/isotope.pkgd.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/php-email-form/validate.js'); ?>"></script>

    <!-- Template Main JS File -->
    <script src="<?php echo base_url('assets/js/main.js'); ?>"></script>

</body>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init({
            offset: 120, // offset (in px) from the original trigger point

            duration: 10000,
        }

    );



    var controller = new ScrollMagic.Controller();


    new ScrollMagic.Scene({
            triggerElement: '.first1',
            duration: 250,
            triggerHook: .4

        })
        .setClassToggle('.first1', 'show1')

        //.addIndicators() // add indicators (requires plugin)
        .addTo(controller);
    new ScrollMagic.Scene({
            triggerElement: '.first2',
            duration: 250,
            triggerHook: .4

        })
        .setClassToggle('.first2', 'show2')

        //.addIndicators() // add indicators (requires plugin)
        .addTo(controller);
    new ScrollMagic.Scene({
            triggerElement: '.first3',
            duration: 250,
            triggerHook: .4

        })
        .setClassToggle('.first3', 'show3')

        //.addIndicators() // add indicators (requires plugin)
        .addTo(controller);


    new ScrollMagic.Scene({
            triggerElement: '.first4',
            duration: 250,
            triggerHook: .4

        })
        .setClassToggle('.first4', 'show4')

        //.addIndicators() // add indicators (requires plugin)
        .addTo(controller);
</script>

</html>