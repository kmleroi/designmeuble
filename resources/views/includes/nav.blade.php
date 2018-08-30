<?php $rubrics = \App\Models\Rubric::with('categories','subCategories')->get()?>
<!-- HEADER -->

<!-- Header Four Area Start -->
<header class="header-four-area">
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <span class="welcome-text">Bienvenue chez Design Meuble !</span>
                </div>
                <div class="col-md-8">
                    <div class="header-top-links">
                        <div class="account-wishlist">
                            <a href="account.html">Mon Compte</a>
                            <a href="wishlist.html">My Wish List</a>
                            <a href="account.html">Connexion</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-middle-area bg-ash">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="logo">
                        <a href="index.html"><img src="img/logo/logo.png" alt="Artfurniture"></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">

                </div>
                <div class="col-lg-6 col-md-12">
                    <form action="#" method="post" class="header-search">
                        <input type="text" placeholder="Rechercher un produit ...">
                        <button><i class="icon icon-Search"></i></button>
                    </form>
                    <div class="cart-box-wrapper">
                        <a class="cart-info" href="cart.html">
                                    <span>
                                        <img src="img/icon/cart.png" alt="">
                                        <span>2</span>
                                    </span>
                            <span>My Cart</span>
                        </a>
                        <div class="cart-dropdown">
                            <button class="close"><i class="fa fa-close"></i></button>
                            <div class="cart-item-a-wrapper">
                                <div class="cart-item-amount">
                                    <span class="cart-number"><span>2</span> items</span>
                                    <div class="cart-amount">
                                        <h5>Cart Subtotal :</h5>
                                        <h4>$70.00</h4>
                                    </div>
                                </div>
                                <a href="checkout.html" class="grey-button">Go to Checkout</a>
                            </div>
                            <div class="cart-dropdown-item">
                                <div class="cart-p-image">
                                    <a href="cart.html"><img src="img/cart/s-1.jpg" alt=""></a>
                                </div>
                                <div class="cart-p-text">
                                    <a href="cart.html" class="cart-p-name">Crown Summit Backpack</a>
                                    <span>$38.00</span>
                                    <div class="cart-p-qty">
                                        <label>Qty</label>
                                        <input type="text" placeholder="1">
                                        <button><i class="icon icon-Delete"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="cart-dropdown-item">
                                <div class="cart-p-image">
                                    <a href="cart.html"><img src="img/cart/s-2.jpg" alt=""></a>
                                </div>
                                <div class="cart-p-text">
                                    <a href="cart.html" class="cart-p-name">Strive Shoulder Pack</a>
                                    <span>$32.00</span>
                                    <div class="cart-p-qty">
                                        <label>Qty</label>
                                        <input type="text" placeholder="1">
                                        <button><i class="icon icon-Delete"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="cart-btn-wrapper">
                                <a href="cart.html" class="grey-button">View and edit cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-sticky">
        <div class="menu-wrapper">
            <div class="container">
                <div class="main-menu display-none">
                    <nav>
                        <ul>
                            <li class="active"><a href="index.html">Home</a></li>
                            @if(count($rubrics))
                                @foreach($rubrics as $rub)
                                    <li class="megamenu"><a href="#">{{$rub->name}}</a>
                                        @if(count($rub->categories))
                                            <ul>
                                                @foreach($rub->categories as $cat)
                                                    <li>
                                                        <ul>
                                                            <li>{{$cat->name}}</li>
                                                            @if(count($rub->subCategories))
                                                                @foreach($rub->subCategories as $sub)
                                                                    @if($sub->category_id == $cat->id)
                                                                        <li><a href="#">{{$sub->name}}</a></li>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </ul>
                                                    </li>
                                                @endforeach
                                            </ul>

                                        @endif

                                    </li>
                                @endforeach
                            @endif


                        </ul>
                    </nav>
                </div>
                <!-- Mobile Menu Area Start -->
                <div class="mobile-menu-area">
                    <div class="mobile-menu">
                        <nav id="mobile-menu-active">
                            <ul class="menu-overflow">
                                <li><a href="index.html">HOME</a>
                                    <ul>
                                        <li><a href="index.html">Homepage One</a></li>
                                        <li><a href="index-2.html">Homepage Two</a></li>
                                        <li><a href="index-3.html">Homepage Three</a></li>
                                        <li><a href="index-4.html">Homepage Four</a></li>
                                    </ul>
                                </li>
                                <li><a href="about.html">About Us</a></li>
                                <li><a href="shop.html">Shop</a>
                                    <ul>
                                        <li><a href="product-details.html">Product Details Page</a></li>
                                        <li><a href="cart.html">Cart Page</a></li>
                                        <li><a href="checkout.html">Checkout Page</a></li>
                                        <li><a href="wishlist.html">Wishlist Page</a></li>
                                    </ul>
                                </li>
                                <li><a href="blog.html">Blog</a>
                                    <ul>
                                        <li><a href="blog-details.html">Blog Details</a></li>
                                    </ul>
                                </li>
                                <li><a href="account.html">Account</a></li>
                                <li><a href="contact.html">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Mobile Menu Area End -->
            </div>
        </div>
    </div>
</header>