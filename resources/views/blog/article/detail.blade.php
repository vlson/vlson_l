<!DOCTYPE HTML>
<html>
@include('blog.article.header')

<body class="single">

	<div class="fh5co-loader"></div>

	<div id="page">
		<div id="fh5co-aside" style="background-image: url({{ imageDomainStitching($article['cover']) }})" data-stellar-background-ratio="0.5">
			<div class="overlay"></div>
			<nav role="navigation">
				<ul>
					<li><a href="index.html"><i class="icon-home"></i></a></li>
				</ul>
			</nav>
			<div class="page-title">
				<img src="https://vlson.oss-cn-beijing.aliyuncs.com/vlson_l/common/blog-icons.png" alt="{{ $article['writer']['name'] }}">
				<span>{{ $article['updated_at'] }}</span>
				<h2>{{ $article['title'] }}</h2>
			</div>
		</div>
		<div id="fh5co-main-content">
			<div class="fh5co-post">
				<div class="fh5co-entry padding">
					<div class="post">
                        <h4 class="postTitle">
                            &nbsp;&nbsp;&nbsp;&nbsp;{{ $article['summary'] }}
                        </h4>
                        <div class="clear"></div>
                        <div class="postBody"> {!! $article['content'] !!}</div>

					    <div class="clear"></div>
                        <div id="blog_post_info_block">
                            <div id="BlogPostCategory">
                                分类:
                                @foreach($article['categories'] as $category)
                                    <a class="category">{{ $category['cat_name'] }}</a>
                                @endforeach
                            </div>
                            <div id="EntryTag">
                                标签:
                                @foreach($article['labels'] as $label)
                                    <a class="label">{{ $label['label_name'] }}</a>
                                @endforeach
                            </div>

                        </div>
					</div>
                </div>
            </div>



        </div>
    </div>

	<div class="fh5co-navigation">
		<div class="fh5co-cover prev fh5co-cover-sm" style="background-image: url(images/project-4.jpg)">
			<div class="overlay"></div>

			<a class="copy" href="#">
				<div class="display-t">
					<div class="display-tc">
						<div>
							<span>Previous Post</span>
							<h2>How to be an affective web developer</h2>
						</div>
					</div>
				</div>
			</a>

		</div>
		<div class="fh5co-cover next fh5co-cover-sm" style="background-image: url(images/project-5.jpg)">
			<div class="overlay"></div>
			<a class="copy" href="#">
				<div class="display-t">
					<div class="display-tc">
						<div>
							<span>Next Post</span>
							<h2>How to be an affective web developer</h2>
						</div>
					</div>
				</div>
			</a>

		</div>
	</div>

	<footer>
        @include('footer')
	</footer>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>

	</body>
</html>

