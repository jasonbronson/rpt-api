@include('header')

<!-- Start Main-Wrapper -->
<div id="main-wrapper">
    <!-- End Header-Toggle -->

    <!-- Start Header-Section -->
    <section class="header-section room" style="background:url('/img/bella-sirena-resort.png') no-repeat center;">
        <div id="gradient"></div>
        <!--div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="title-section pull-left">

                    </h3>
                    <ul class="breadcrumbs custom-list list-inline pull-right">
                        <li><a href="#">Resorts</a></li>
                        <li><a href="#">{{ $resortname }}</a></li>
                    </ul>
                </div>
            </div>
        </div-->
    </section>
    <!-- End Header-Section -->

    <!-- Start Room -->
    <section id="room">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="room-wrapper negative-margin">
                        <div class="sidebar col-md-3">
                            <div class="sidebar-widget reservation">
                                <h5 class="widget-title">Book a reservation today</h5>
                                <aside class="widget-content">
                                    <form action="/" class="default-form">
                                        <button class="btn btn-transparent-gray">Make reservation</button>
                                    </form>
                                </aside>
                            </div>
                            <div class="sidebar-widget offers">
                                @include('resort.sidebaroffers')
                            </div>
                        </div>
                        <div class="room-content col-md-9">
                            <div class="room-general">
                                <img src="" alt="" class="img-responsive">
                                <header>
                                    <div class="pull-left">
                                        <h4 class="title-section">@include("resort.$resortname-title")</h4>
                                    </div>
                                    <div class="pull-right">
                                        <span class="price">
                                          from ${{$resortprice}}/night
                                        </span>
                                    </div>
                                </header>
                            </div>

                            <div class="room-tabs">
                                <ul class="nav nav-tabs">
                                    <li><a data-toggle="tab" href="#about">About</a></li>
                                    <li><a data-toggle="tab" href="#amenities">Amenities</a></li>
                                    <li class="active"><a data-toggle="tab" href="#images">Images</a></li>
                                    <li><a data-toggle="tab" href="#reviews">Reviews</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div id="about" class="tab-pane fade">
                                        <div class="listing-facitilities">
                                            <div class="row">
                                                @include("resort.$resortname-info")
                                            </div>
                                        </div>
                                    </div>
                                    <div id="amenities" class="tab-pane fade">
                                        <div class="listing-facitilities">
                                            <div class="row">
                                                @include("resort.$resortname-amenities")
                                            </div>
                                        </div>
                                    </div>
                                    <div id="images" class="tab-pane fade in active">
                                        <script>
                                            $(document).ready(function(){
                                                $("#lightSlider").lightSlider({
                                                    gallery:true,
                                                    item:1,
                                                    loop:true,
                                                    thumbItem:9,
                                                    slideMargin:0,
                                                    enableDrag: false,
                                                    auto: true,
                                                    currentPagerPosition:'left',
                                                    onSliderLoad: function(el) {
                                                        el.lightGallery({
                                                            selector: '#imageGallery .lslide'
                                                        });
                                                    }
                                                });
                                            });
                                            </script>
                                        <div class="images-gallery">
                                            <ul id="lightSlider">
                                                <?php foreach ( $pictures as $index => $folder ): ?>
                                                    <li data-thumb="<?php echo $folder['relativepath']; ?>/<?php echo $folder['filename']; ?>" data-src="<?php echo $folder['relativepath']; ?>/<?php echo $folder['filename']; ?>">
                                                        <img src="<?php echo $folder['relativepath']; ?>/<?php echo $folder['filename']; ?>" class="img-responsive" />
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div id="reviews" class="tab-pane fade">
                                        <ul class="reviews-list custom-list">
                                            <li>
                                                @include("resort/$resortname-review")
                                            </li>
                                            <li>
                                                <hr>
                                                <form action="#" class="default-form">
                                                    <p>Write a review </p>
                                                    Name: <input type="text" name="name">
                                                    Review: <textarea cols="30" rows="4"></textarea>
                                                    <button class="btn btn-transparent-gray">Send</button>
                                                </form>

                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Room -->


</div>
<!-- End Main-Wrapper -->

<script src="/js/lightslider.js"></script>
<link href="/css/lightslider.css" rel="stylesheet" />

<script src="/js/lightgallery.js"></script>
<link href="/css/lightgallery.css" rel="stylesheet" />

@include('footer')