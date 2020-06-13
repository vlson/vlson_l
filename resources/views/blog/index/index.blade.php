<!DOCTYPE HTML>
<html>

@include('blog.index.header')

<body>
<div class="fh5co-loader"></div>

<div id="page">
    <div id="fh5co-aside" style="background-image: url(https://vlson.oss-cn-beijing.aliyuncs.com/vlson_l/2020-06-13/green-wheat-field-4507967.jpg)">
        <div class="overlay"></div>
        <nav role="navigation">
            <ul>
                <li><a href="index.html"><i class="icon-home"></i></a></li>
            </ul>
        </nav>
        <div class="featured">
            <span>VLSON</span>
            <h2>闲云潭影日悠悠，物换星移几度秋。</h2>
        </div>
    </div>
    <div id="fh5co-main-content">
        <div class="fh5co-post">

            @foreach($articleList as $article)
            <div class="fh5co-entry padding">
                <img src="{{$article->cover}}" alt="{{$article->title}}">
                <div>
                    <span class="fh5co-post-date">{{date('Y年m月d日 H点', strtotime($article->updated_at))}}</span>
                    <h2><a href="链接">{{$article->title}}</a></h2>
                    <p>{{$article->summary}}</p>
                </div>
            </div>
            @endforeach

                {{ $articleList->links() }}

            <footer>
                <div>
                    Copyright ©{{date("Y")}}~至今 微醺 <a href="{{config('app.url')}}"> {{config('app.url')}}</a>
                </div>
            </footer>
        </div>
    </div>
</div>

<div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
</div>

<!-- jQuery -->
<script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- jQuery Easing -->
<script src="https://cdn.bootcdn.net/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<!-- Bootstrap -->
<script src="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
<!-- Waypoints -->
<script src="https://cdn.bootcdn.net/ajax/libs/waypoints/4.0.1/jquery.waypoints.js"></script>
<!-- Stellar Parallax -->
<script src="https://cdn.bootcdn.net/ajax/libs/stellar.js/0.6.2/jquery.stellar.min.js"></script>
<!-- Main -->
<script src="https://vlson.oss-cn-beijing.aliyuncs.com/vlson_l/2020-06-10/blog.main.js"></script>

</body>
</html>

