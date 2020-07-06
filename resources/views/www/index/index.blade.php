<!DOCTYPE html>
<html lang="en">

@includeIf('www.index.header')

<body>

<!-- mian-content -->
<div class="main-banner" id="home">

    <!--/banner-->
    <div class="banner-info">
        <div class="w3pvt-logo text-center">
            <h1> <a href="index.html">微醺 | VLSON</a></h1>
        </div>
        <div class="middile-inner-con">
            <div class="tab-main mx-auto">

                <input id="tab1" type="radio" name="tabs" class="w3layouts-sm" checked>
                <label for="tab1"><span class="fa fa-home" aria-hidden="true"></span>首页</label>

                <input id="tab2" type="radio" class="w3layouts-sm" name="tabs">
                <label for="tab2"><span class="fa fa-users" aria-hidden="true"></span> 关于</label>

                <input id="tab3" type="radio" class="w3layouts-sm" name="tabs">
                <label for="tab3"><span class="fa fa-files-o" aria-hidden="true"></span>项目</label>
                <input id="tab4" type="radio" class="w3layouts-sm" name="tabs">
                <label for="tab4"><span class="fa fa-envelope" aria-hidden="true"></span> Call Me</label>
                <section id="content1" class="inner-w3layouts-wrap">
                    <img src="	https://vlson.oss-cn-beijing.aliyuncs.com/vlson_l/2020-06-09/favicon.png" class="admin img-fluid" alt="">
                    <h4>Hi I'm Vlson</h4>
                    <h2>放小自己，放大格局</h2>
                    <p>我们曾如此渴望命运的波澜，到最后才发现，人生最曼妙的风景，竟是内心的淡定与从容，我们曾如此渴望期盼外界的认可，到最后才发现世界是自己的，与他人毫无关系。</p>

                </section>
                <section id="content2" class="inner-w3layouts-wrap">
                    <h3 class="head-w3ls">What I Say</h3>
                    <p> 所有屁话都是真理！</p>
                </section>
                <section id="content3" class="inner-w3layouts-wrap">
                    <h3 class="head-w3ls">What I Do</h3>
                    <div class="row news-grids text-center">
                        <div class="col-6 gal-img">
                            <a href="{{config('app.blog_url')}}"><img src="	https://vlson.oss-cn-beijing.aliyuncs.com/vlson_l/2020-06-09/project1.png" alt="" class="img-fluid"></a>
                            <a href="{{config('app.matrix_url')}}"><img src="	https://vlson.oss-cn-beijing.aliyuncs.com/vlson_l/2020-06-09/project2.png" alt="" class="img-fluid"></a>
                        </div>

                        <div class="col-6 gal-img">
                            <a href="{{config('app.tools_url')}}"><img src="	https://vlson.oss-cn-beijing.aliyuncs.com/vlson_l/2020-06-09/project3.png" alt="" class="img-fluid"></a>
                            <a href="{{config('app.shop_url')}}"><img src="	https://vlson.oss-cn-beijing.aliyuncs.com/vlson_l/2020-06-09/project4.png" alt="" class="img-fluid"></a>
                        </div>
                        <!-- popup-->

                    </div>
                </section>
                <section id="content4" class="inner-w3layouts-wrap">
                    <h3 class="head-w3ls"> Hello World!</h3>
                    <form name="contact-form" class="contact-form">
                        <div class="row">
                            <div class="col-6 con-gd">
                                <div class="form-group">
                                    <p>昵称 *</p>
                                    <input type="text" class="form-control" id="name" placeholder="" name="name" required="">
                                </div>
                                <div class="form-group">
                                    <p>Email *</p>
                                    <input type="email" class="form-control" id="email" placeholder="" name="email" required="">
                                </div>

                            </div>
                            <div class="col-6 con-gd">
                                <div class="form-group">
                                    <p>留言 *</p>
                                    <textarea name="Message" placeholder="" required=""></textarea>
                                </div>

                            </div>

                        </div>
                        <div class="form-group">

                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>

                    </form>
                </section>

            </div>
            <!--// banner-inner -->
        </div>
    </div>

    @include('footer')
</div>
<!--//main-content-->


</body>

</html>
