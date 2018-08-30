<!DOCTYPE html>
<html lang="fr">
<head>

    <!-- SITE TITTLE -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DESIGN Meuble - <?php echo $__env->yieldContent('title'); ?></title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- CUSTOM CSS -->
    <link href="css/all.css" rel="stylesheet">
     <!-- Icons -->
    <link rel="shortcut icon" href="img/favicon.png">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!--<script src="js/modernizr-3.5.0.min.js"></script>-->
    <!-- production version, optimized for size and speed -->
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
</head>

<body class="body-wrapper version1">
<!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
<![endif]-->


<?php echo $__env->make('includes.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->yieldContent('content'); ?>
<!-- Footer Four Area Start -->
<footer class="footer-four-area">
    <div class="footer-top pt-80 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="single-footer-widget">
                        <div class="footer-logo">
                            <a href="index.html"><img src="img/logo/logo-2.png" alt=""></a>
                        </div>
                        <div class="single-footer-text">
                            <span>Addresss: No 123 - Furtinure Street, USA.</span>
                            <span>Phone 01: +(800) 123 456 78</span>
                            <span>Phone 02: +(100) 123 456 789</span>
                            <span>Fax : (800) 123 456 789</span>
                            <span>Email:Contact@hastech.com</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3">
                    <div class="single-footer-widget">
                        <h4>ABOUT US</h4>
                        <ul class="footer-widget-list">
                            <li><a href="#">Site Map</a></li>
                            <li><a href="#">Specials</a></li>
                            <li><a href="#">Delivery Information</a></li>
                            <li><a href="#">Order History</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <div class="single-footer-widget">
                        <h4>INFORMATION</h4>
                        <ul class="footer-widget-list">
                            <li><a href="account.html">My Account</a></li>
                            <li><a href="#">Gift Cards</a></li>
                            <li><a href="#">Return Policy</a></li>
                            <li><a href="#">Your Orders</a></li>
                            <li><a href="#">Subway</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3">
                    <div class="single-footer-widget">
                        <h4>my account</h4>
                        <ul class="footer-widget-list">
                            <li><a href="account.html">My Account</a></li>
                            <li><a href="checkout.html">Checkout</a></li>
                            <li><a href="account.html">Login</a></li>
                            <li><a href="#">Order status</a></li>
                            <li><a href="#">Site Map</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single-footer-widget">
                        <h4>sign up newsletter</h4>
                        <p>Be the first to hear about new trending and offers and see how youve helped</p>
                        <div class="newsletter-form mc_embed_signup">
                            <form action="http://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                                <div id="mc_embed_signup_scroll" class="mc-form">
                                    <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Enter your email address" required>
                                    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                    <div class="mc-news" aria-hidden="true"><input type="text" name="b_6bbb9b6f5827bd842d9640c82_05d85f18ef" tabindex="-1" value=""></div>
                                    <button id="mc-embedded-subscribe" type="submit" name="subscribe">Subscribe</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <span>Copyright &copy; 2018 <a href="https://hastech.company/">HasTech</a>. All rights reserved.</span>
                </div>
                <div class="col-lg-4 col-md-2">
                    <div class="social-link">
                        <a href="https://twitter.com/devitemsllc"><i class="fab fa-twitter"></i></a>
                        <a href="https://plus.google.com/117030536115448126648"><i class="fab fa-google-plus"></i></a>
                        <a href="https://www.facebook.com/devitems/"><i class="fab fa-facebook"></i></a>
                        <a href="https://www.youtube.com/channel/UC_AH6tcQrJa8txh_rNbL-AQ"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="payment-image">
                        <img src="img/payment.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Four Area End -->
<!--Start of Newsletter Form-->
<div class="modal fade" id="newslettermodal" tabindex="-1" role="dialog">
    <div class="modal-dialog text-center" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">close</span></button>
            <div class="newsletter-popup">
                <form class="newsletter-content" method="post" action="#">
                    <h2>NEWSLETTER</h2>
                    <p>Subscribe to the Artfurniture mailing list to receive updates on new arrivals, special offers and other discount information.</p>
                    <input type="text" placeholder="Enter your email address">
                    <button type="button">subscribe</button>
                    <div class="checkbox_newsletter">
                        <input type="checkbox" id="checkbox">
                        <label for="checkbox"> Don't show this popup again</label>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End of Newsletter Form-->

<script src="js/all.js"></script>
<script src="js/front.js"></script>
<script>

</script>
</body>
</html>

