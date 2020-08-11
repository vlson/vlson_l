<!DOCTYPE HTML>
<html>

@include('blog.index.header')

<body>
<div class="fh5co-loader"></div>

<div id="page">
    <div id="fh5co-aside" style="background-image: url(	https://vlson.oss-cn-beijing.aliyuncs.com/vlson_l/2020-06-23/woman-wearing-white-mesh-top-2982149.jpg)">
        <div class="overlay"></div>
        <nav role="navigation">
            <ul>
                <li><a href="{{config('app.url')}}"><i class="icon-home"></i></a></li>
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
                <img src="{{imageDomainStitching($article->cover)}}" alt="{{$article->title}}">
                <div>
                    <span class="fh5co-post-date">{{date('Y-m-d H:m', strtotime($article->updated_at))}}</span>
                    <h2><a href="{{config('app.blog_url').'/article/'.$article->id}}">{{$article->title}}</a></h2>
                    <p>{{$article->summary}}</p>
                </div>
            </div>
            @endforeach

            {{ $articleList->links() }}

            <footer>
                @include('footer')
            </footer>
        </div>
    </div>
</div>

<div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
</div>

</body>
</html>

