<?php require_once('header.php'); ?>

         <!-- Start Bottom Header -->
        <div class="page-area">
            <div class="breadcumb-overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="breadcrumb text-center">
                            <div class="section-headline">
                                <h2>Reviews</h2>
                            </div>
                            <ul>
                                <li class="home-bread">Home</li>
                                <li>Reviews</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Header -->
        <!-- Start testimonials Area -->
        <div class="review-page-area bg-color area-padding-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="section-headline text-center">
                            <h3><?php echo $review->title; ?></h3>
                            <p><?php echo $review->description; ?></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="reviews-content ">
                        <?php foreach ($review->reviews_arr as $reviewItem) { ?>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="single-testi">
                                    <div class="testi-text">
                                        <div class="clients-text">
                                            <div class="client-rating">
                                                <?php for($cnt=0; $cnt<$reviewItem->stars; $cnt++){ ?>
                                                    <a href="#"><i class="ti-star"></i></a>
                                                <?php } ?>
                                            </div>
                                            <p><?php echo $reviewItem->description; ?></p>
                                            <div class="testi-img ">
                                                <div class="guest-details">
                                                    <h4><?php echo $reviewItem->reviewer; ?></h4>
                                                    <span class="guest-rev"><?php echo $reviewItem->occupation; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <!-- End single item -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End testimonials end -->
<?php require_once('footer.php'); ?>