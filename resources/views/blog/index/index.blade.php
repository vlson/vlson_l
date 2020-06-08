<!DOCTYPE html>
<html lang="en">

@includeIf('blog.index.header')

<body>

<!-- mian-content -->
<div class="main-banner" id="home">

    <!--/banner-->
    <div class="banner-info">
        <div class="w3pvt-logo text-center">
            <h1> <a href="index.html">Unrivaled</a></h1>
        </div>
        <div class="middile-inner-con">
            <div class="tab-main mx-auto">

                <input id="tab1" type="radio" name="tabs" class="w3layouts-sm" checked>
                <label for="tab1"><span class="fa fa-home" aria-hidden="true"></span>Home</label>

                <input id="tab2" type="radio" class="w3layouts-sm" name="tabs">
                <label for="tab2"><span class="fa fa-users" aria-hidden="true"></span> About</label>

                <input id="tab3" type="radio" class="w3layouts-sm" name="tabs">
                <label for="tab3"><span class="fa fa-files-o" aria-hidden="true"></span>Projects</label>
                <input id="tab4" type="radio" class="w3layouts-sm" name="tabs">
                <label for="tab4"><span class="fa fa-envelope" aria-hidden="true"></span> Contact</label>
                <section id="content1" class="inner-w3layouts-wrap">
                    <img src="http://www.vlson.com/images/admin.jpg" class="admin img-fluid" alt="mobile-image">
                    <h4>Hi I'm Lee Rayhan</h4>
                    <h2>My Introduction</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras lobortis mollis arcu, vel vulputate justo consectetur quis. Donec quis fringilla arcu lorem ipsum dolor sit amet nullam. Consequat adipiscing phasellus.</p>

                </section>
                <section id="content2" class="inner-w3layouts-wrap">
                    <h3 class="head-w3ls">What I do</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras lobortis mollis arcu, vel vulputate justo consectetur quis. Donec quis fringilla arcu lorem ipsum dolor sit amet nullam. Consequat adipiscing phasellus.
                        Donec cursus nunc ut rhoncus volutpat. Suspendisse dictum volutpat orci sit amet consequat. Duis fermentum urna et ligula lacinia faucibus efficitur non sapien. Nulla cursus arcu sapien. Nulla luctus tellus dapibus erat tincidunt feugiat. Suspendisse potenti lorem ipsum dolor. Magna sed risus bibendum, ullamcorper risus eget, accumsan odio. Ut ornare mi aliquet, ultrices velit vitae tempor augue </p>
                </section>
                <section id="content3" class="inner-w3layouts-wrap">
                    <h3 class="head-w3ls">See My Latest Works.</h3>
                    <div class="row news-grids text-center">
                        <div class="col-4 gal-img">
                            <a href="#gal1"><img src="http://www.vlson.com/images/g1.jpg" alt="news image" class="img-fluid"></a>
                            <a href="#gal2"><img src="http://www.vlson.com/images/g3.jpg" alt="news image" class="img-fluid"></a>


                        </div>
                        <div class="col-4 gal-img">
                            <a href="#gal3"><img src="http://www.vlson.com/images/g2.jpg" alt="news image" class="img-fluid"></a>
                            <a href="#gal4"><img src="http://www.vlson.com/images/g4.jpg" alt="news image" class="img-fluid"></a>
                        </div>
                        <div class="col-4 gal-img">


                            <a href="#gal5"><img src="http://www.vlson.com/images/g5.jpg" alt="news image" class="img-fluid"></a>
                            <a href="#gal6"><img src="http://www.vlson.com/images/g6.jpg" alt="news image" class="img-fluid"></a>
                        </div>
                        <!-- popup-->

                    </div>
                </section>
                <section id="content4" class="inner-w3layouts-wrap">
                    <h3 class="head-w3ls"> Get In Touch</h3>
                    <form name="contact-form" class="contact-form" method="post" action="#">
                        <div class="row">
                            <div class="col-6 con-gd">
                                <div class="form-group">
                                    <p>Name *</p>
                                    <input type="text" class="form-control" id="name" placeholder="" name="name" required="">
                                </div>
                                <div class="form-group">
                                    <p>Email *</p>
                                    <input type="email" class="form-control" id="email" placeholder="" name="email" required="">
                                </div>

                            </div>
                            <div class="col-6 con-gd">
                                <div class="form-group">
                                    <p>Send a Message *</p>
                                    <textarea name="Message" placeholder="" required=""></textarea>
                                </div>

                            </div>

                        </div>
                        <div class="form-group">

                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>

                    </form>
                    <ul class="w3pvt_social_list list-unstyled mt-4">
                        <li>
                            <a href="#" class="w3layouts-icon">
                                <span class="fa fa-facebook-f"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="w3layouts-icon">
                                <span class="fa fa-twitter"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="w3layouts-icon">
                                <span class="fa fa-dribbble"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="w3layouts-icon">
                                <span class="fa fa-google-plus"></span>
                            </a>
                        </li>
                    </ul>
                </section>

            </div>
            <!--// banner-inner -->
        </div>
    </div>
    {{--<div class="copy-w3layouts-right text-center pb-3">
        <p>© 2019 Unrivaled. All rights reserved | Design by
            <a href="http://w3layouts.com"> W3layouts.</a>
        </p>

    </div>--}}

    @include('blog.index.footer')
</div>
<!--//main-content-->


</body>

</html>
