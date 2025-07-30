@extends('site.layouts.app')
@section('site.title')
    @lang('site.home')
@endsection
@section('site.css')
@endsection
@section('site.content')
    <div id="wrapper">
        <!-- content-->
        <div class="content">
            <section class="gray-bg no-top-padding-sec" id="sec1">
                <div class="container">
                    <div class="breadcrumbs inline-breadcrumbs fl-wrap block-breadcrumbs">
                        <a href="#">Home</a><a href="#">Blog</a> <span>Blog Single</span>
                        <div  class="showshare brd-show-share color2-bg"> <i class="fas fa-share"></i> Share </div>
                    </div>
                    <div class="share-holder hid-share sing-page-share top_sing-page-share">
                        <div class="share-container  isShare"></div>
                    </div>
                    <div class="post-container fl-wrap">
                        <div class="row">
                            <!-- blog content-->
                            <div class="col-md-8">
                                <!-- article> -->
                                <article class="post-article single-post-article">
                                    <div class="list-single-main-media fl-wrap">
                                        <div class="single-slider-wrap">
                                            <div class="single-slider fl-wrap">
                                                <div class="swiper-container">
                                                    <div class="swiper-wrapper lightgallery">
                                                        <div class="swiper-slide hov_zoom"><img src="{{ asset('site/images/all/7.jpg') }}" alt="">
                                                            <a href="{{ asset('site/images/all/7.jpg') }}" class="box-media-zoom   popup-image"><i class="fal fa-search"></i></a>
                                                        </div>
                                                        <div class="swiper-slide hov_zoom"><img src="{{ asset('site/images/all/7.jpg') }}" alt="">
                                                            <a href="{{ asset('site/images/all/7.jpg') }}" class="box-media-zoom   popup-image"><i class="fal fa-search"></i></a>
                                                        </div>
                                                        <div class="swiper-slide hov_zoom"><img src="{{ asset('site/images/all/7.jpg') }}" alt="">
                                                            <a href="{{ asset('site/images/all/7.jpg') }}" class="box-media-zoom   popup-image"><i class="fal fa-search"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="listing-carousel_pagination">
                                                <div class="listing-carousel_pagination-wrap">
                                                    <div class="ss-slider-pagination"></div>
                                                </div>
                                            </div>
                                            <div class="ss-slider-cont ss-slider-cont-prev color2-bg"><i class="fal fa-long-arrow-left"></i></div>
                                            <div class="ss-slider-cont ss-slider-cont-next color2-bg"><i class="fal fa-long-arrow-right"></i></div>
                                        </div>
                                    </div>
                                    <div class="list-single-main-item fl-wrap block_box">
                                        <h2 class="post-opt-title"><a href="blog-single.html">Here’s What People Are Saying About Us.</a></h2>
                                        <div class="post-opt">
                                            <ul class="no-list-style">
                                                <li><i class="fal fa-calendar"></i> <span>25 April 2018</span></li>
                                                <li><i class="fal fa-eye"></i> <span>264</span></li>
                                                <li><i class="fal fa-tags"></i> <a href="#">Photography</a> , <a href="#">Design</a> </li>
                                            </ul>
                                        </div>
                                        <span class="fw-separator"></span>
                                        <div class="clearfix"></div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis et sem sed sollicitudin. Donec non odio neque. Aliquam hendrerit sollicitudin purus, quis rutrum mi accumsan nec. Quisque bibendum orci ac nibh facilisis, at malesuada orci congue. Nullam tempus sollicitudin cursus. Ut et adipiscing erat. Curabitur this is a text link libero tempus congue.</p>
                                        <p>Duis mattis laoreet neque, et ornare neque sollicitudin at. Proin sagittis dolor sed mi elementum pretium. Donec et justo ante. Vivamus egestas sodales est, eu rhoncus urna semper eu. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Integer tristique elit lobortis purus bibendum, quis dictum metus mattis. Phasellus posuere felis sed eros porttitor mattis. Curabitur massa magna, tempor in blandit id, porta in ligula. Aliquam laoreet nisl massa, at interdum mauris sollicitudin et</p>
                                        <blockquote>
                                            <p>Vestibulum id ligula porta felis euismod semper. Sed posuere consectetur est at lobortis. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper.</p>
                                        </blockquote>
                                        <p>Ut nec hinc dolor possim. An eros argumentum vel, elit diceret duo eu, quo et aliquid ornatus delicatissimi. Cu nam tale ferri utroque, eu habemus albucius mel, cu vidit possit ornatus eum. Eu ius postulant salutatus definitionem, an e trud erroribus explicari. Graeci viderer qui ut, at habeo facer solet usu. Pri choro pertinax indoctum ne, ad partiendo persecuti forensibus est.</p>
                                        <span class="fw-separator"></span>
                                       {{-- <div class="list-single-tags tags-stylwrap">
                                            <span class="tags-title"><i class="fas fa-tag"></i> Tags : </span>
                                            <a href="#">Hotel</a>
                                            <a href="#">Hostel</a>
                                            <a href="#">Room</a>
                                            <a href="#">Spa</a>
                                            <a href="#">Restourant</a>
                                            <a href="#">Parking</a>
                                        </div>--}}
                                    </div>
                                </article>
                                <!-- article end -->
                            </div>
                            <!-- blog conten end-->
                            <!-- blog sidebar -->
                            <div class="col-md-4">
                                <div class="box-widget-wrap fl-wrap fixed-bar">
                                    <!--box-widget-item -->
                                    <div class="box-widget-item fl-wrap block_box">
                                        <div class="box-widget-item-header">
                                            <h3>Popular Posts</h3>
                                        </div>
                                        <div class="box-widget  fl-wrap">
                                            <div class="box-widget-content">
                                                <!--widget-posts-->
                                                <div class="widget-posts  fl-wrap">
                                                    <ul class="no-list-style">
                                                        <li>
                                                            <div class="widget-posts-img"><a href="blog-single.html"><img src="images/gallery/thumbnail/1.png" alt=""></a></div>
                                                            <div class="widget-posts-descr">
                                                                <h4><a href="listing-single.html">Nullam dictum felis</a></h4>
                                                                <div class="geodir-category-location fl-wrap"><a href="#"><i class="fal fa-calendar"></i> 27 Mar 2019</a></div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="widget-posts-img"><a href="blog-single.html"><img src="images/gallery/thumbnail/2.png" alt=""></a></div>
                                                            <div class="widget-posts-descr">
                                                                <h4><a href="listing-single.html">Scrambled it to mak</a></h4>
                                                                <div class="geodir-category-location fl-wrap"><a href="#"><i class="fal fa-calendar"></i> 12 May 2018</a></div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="widget-posts-img"><a href="blog-single.html"><img src="images/gallery/thumbnail/3.png" alt=""></a> </div>
                                                            <div class="widget-posts-descr">
                                                                <h4><a href="listing-single.html">Fermentum nis type</a></h4>
                                                                <div class="geodir-category-location fl-wrap"><a href="#"><i class="fal fa-calendar"></i>22 Feb  2018</a></div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="widget-posts-img"><a href="blog-single.html"><img src="images/gallery/thumbnail/4.png" alt=""></a> </div>
                                                            <div class="widget-posts-descr">
                                                                <h4><a href="listing-single.html">Rutrum elementum</a></h4>
                                                                <div class="geodir-category-location fl-wrap"><a href="#"><i class="fal fa-calendar"></i> 7 Mar 2017</a></div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- widget-posts end-->
                                            </div>
                                        </div>
                                    </div>
                                    <!--box-widget-item end -->
                                    <!--box-widget-item -->
                                    <div class="box-widget-item fl-wrap block_box">
                                        <div class="box-widget-item-header">
                                            <h3>Popular Categories</h3>
                                        </div>
                                        <div class="box-widget fl-wrap">
                                            <div class="box-widget-content">
                                                <ul class="cat-item no-list-style">
                                                    <li><a href="#">Standard</a> <span>3</span></li>
                                                    <li><a href="#">Video</a> <span>6 </span></li>
                                                    <li><a href="#">Gallery</a> <span>12 </span></li>
                                                    <li><a href="#">Quotes</a> <span>4</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!--box-widget-item end -->
                                </div>
                            </div>
                            <!-- blog sidebar end -->
                        </div>
                    </div>
                </div>
            </section>
            <div class="limit-box fl-wrap"></div>
        </div>
        <!--content end-->
    </div>
@endsection
@section('site.js')
@endsection
