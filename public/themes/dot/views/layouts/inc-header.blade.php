<meta name="keywords" content="" />
<meta name="description" content="" />
<meta name="robot" content="index, follow" />
<meta name="generator" content="Brackets">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="format-detection" content="telephone=no">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="google" content="notranslate">

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id={{ setting('site.google_analytics_tracking_id') }}"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '{{ setting("site.google_analytics_tracking_id") }}');
</script>


<!-- meta share facebook -->
<!-- $_SERVER['REQUEST_URI'] -->

@if( strstr($_SERVER['REQUEST_URI'],"/content-sharing/content-sharing-detail/") )
<meta property="og:url"           content="http://www.dot.go.th/content-sharing/content-sharing-detail/{{$dataContentById[0]['id']}}" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="{{$dataContentById[0]['title']}}" />
<meta property="og:description"   content="@if($dataContentById[0]['short_description']){!!strip_tags($dataContentById[0]['short_description'])!!}  @else $dataContentById[0]['title'] @endif" />
<meta property="og:image"         content="http://www.dot.go.th/storage/content-sharings/October2018/{{$dataContentById[0]['id']}}.jpg" />
<!-- end meta share facebook -->
@endif

<!-- meta share social library-detail page -->
@if( strstr($_SERVER['REQUEST_URI'],"/library/detail/") )
<meta property="og:url"           content="http://www.dot.go.th/library/detail/{{$detail['id']}}" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="{{$detail['title']}}" />
<meta property="og:description"   content="@if($detail['short_description']){!!strip_tags($detail['short_description'])!!}  @else $detail['title'] @endif" />
<meta property="og:image"         content="http://www.dot.go.th/storage/{{$detail['image']}}" />
@endif
<!-- end meta share library-detail page -->

<!-- meta share mission-statement -->
@if( strstr($_SERVER['REQUEST_URI'],"/mission-statement") )
@if(!empty($alldata))
<meta property="og:url"           content="http://www.dot.go.th/mission-statement" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="{{$alldata[0]['title']}}" />
<meta property="og:description"   content="@if($alldata[0]['short_description']){!!strip_tags($alldata[0]['short_description'])!!}  @else $alldata[0]['title'] @endif" />
<meta property="og:image"         content="http://www.dot.go.th/storage/{{$alldata[0]['image']}}" />
<!-- end meta share facebook -->
@endif
@endif

<!-- meta share mission-authority -->
@if( strstr($_SERVER['REQUEST_URI'],"/mission-and-authority") )
@if(!empty($alldata))
<meta property="og:url"           content="http://www.dot.go.th/mission-and-authority" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="{{$alldata[0]['title']}}" />
<meta property="og:description"   content="@if($alldata[0]['title']){!!strip_tags($alldata[0]['title'])!!}  @else $alldata[0]['title'] @endif" />
<meta property="og:image"         content="http://www.dot.go.th/storage/{{$alldata[0]['image']}}" />
<!-- end meta share facebook -->
@endif
@endif

<!-- meta share news-inform -->
@if( strstr($_SERVER['REQUEST_URI'],"/news/inform/detail") )
@if(!empty($alldata))
<meta property="og:url"           content="http://www.dot.go.th/news/inform/detail/{{$alldata['id']}}" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="{{$alldata['title']}}" />
<meta property="og:description"   content="@if($alldata['title']){!!strip_tags($alldata['title'])!!}  @else $alldata['title'] @endif" />
<meta property="og:image"         content="http://www.dot.go.th/storage/{{$alldata['image']}}" />
<!-- end meta share facebook -->
@endif
@endif

<!-- meta share news-manager -->
@if( strstr($_SERVER['REQUEST_URI'],"/news/manager/detail") )
@if(!empty($alldata))
<meta property="og:url"           content="http://www.dot.go.th/news/manager/detail/{{$alldata['id']}}" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="{{$alldata['title']}}" />
<meta property="og:description"   content="@if($alldata['title']){!!strip_tags($alldata['title'])!!}  @else $alldata['title'] @endif" />
<meta property="og:image"         content="http://www.dot.go.th/storage/{{$alldata['image']}}" />
<!-- end meta share facebook -->
@endif
@endif

<!-- meta share news-procurement -->
@if( strstr($_SERVER['REQUEST_URI'],"/news/procurement-detail") )
@if(!empty($alldata))
<meta property="og:url"           content="http://www.dot.go.th/news/procurement-detail/{{$alldata['id']}}" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="{{$alldata['title']}}" />
<meta property="og:description"   content="@if($alldata['title']){!!strip_tags($alldata['title'])!!}  @else $alldata['title'] @endif" />
<meta property="og:image"         content="http://www.dot.go.th/storage/{{$alldata['image']}}" />
<!-- end meta share facebook -->
@endif
@endif

<!-- meta share news-procurement -->
@if( strstr($_SERVER['REQUEST_URI'],"/news/internal-audit-plan/detail") )
@if(!empty($alldata))
<meta property="og:url"           content="http://www.dot.go.th/news/internal-audit-plan/detail/{{$alldata['id']}}/$category['id']" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="{{$alldata['title']}}" />
<meta property="og:description"   content="@if($alldata['title']){!!strip_tags($alldata['title'])!!}  @else $alldata['title'] @endif" />
<meta property="og:image"         content="http://www.dot.go.th/storage/{{$alldata['image']}}" />
<!-- end meta share facebook -->
@endif
@endif

<link type="image/ico" rel="shortcut icon" href="{{ ThemeService::path('assets/images/favicon.ico') }}">
<link href="{{ ThemeService::path('assets/css/bootstrap.min.css') }}"  rel="stylesheet">
<link href="{{ ThemeService::path('assets/css/bootstrap-theme.min.css') }}"  rel="stylesheet">
<link type="text/css" rel="stylesheet" href="{{ ThemeService::path('assets/css/layout.css') }}"/>
<link type="text/css" rel="stylesheet" href="{{ ThemeService::path('assets/css/responsive.css') }}"/>

<script src="{{ ThemeService::path('assets/js/jquery.min.js') }}"></script>
<script src="{{ ThemeService::path('assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ ThemeService::path('assets/js/bootstrap.min.js') }}"></script>

<!-- script app -->
<link rel="stylesheet" href="{{ ThemeService::path('assets/css/owlcarousel/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ ThemeService::path('assets/css/owlcarousel/owl.theme.default.min.css') }}">
<script src="{{ ThemeService::path('assets/js/owlcarousel/owl.carousel.min.js') }}"></script>
<link rel="stylesheet" href="{{ ThemeService::path('assets/css/flexslider/flexslider.css') }}" type="text/css" media="screen" />
<script defer src="{{ ThemeService::path('assets/js/flexslider/jquery.flexslider.js') }}"></script>
<script type="text/javascript" src="{{ ThemeService::path('assets/js/flexslider/shCore.js') }}"></script>
<script type="text/javascript" src="{{ ThemeService::path('assets/js/flexslider/shBrushJScript.js') }}"></script>
<!-- end script app -->
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <!-- Modernizr -->
    <script src="{{ ThemeService::path('assets/js/flexslider/modernizr.js') }}"></script>
    
    <script type="text/javascript" language="javascript" src="{{ ThemeService::path('assets/js/dotdotdot-master/jquery.dotdotdot.js') }}"></script>
		<script type="text/javascript" language="javascript">
			$(function() {
				$('.dotmaster').dotdotdot({
					watch: 'window'
				});
			});
		</script>
       
	<!-- Add mousewheel plugin (this is optional) -->
	<script type="text/javascript" src="{{ ThemeService::path('assets/js/fancybox/jquery.mousewheel-3.0.6.pack.js') }}"></script>

	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="{{ ThemeService::path('assets/js/fancybox/jquery.fancybox.js?v=2.1.5') }}"></script>
	<link rel="stylesheet" type="text/css" href="{{ ThemeService::path('assets/css/fancybox/jquery.fancybox.css?v=2.1.5') }}" media="screen" />

	<!-- Add Button helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="{{ ThemeService::path('assets/css/fancybox/jquery.fancybox-buttons.css?v=1.0.5') }}" />
	<script type="text/javascript" src="{{ ThemeService::path('assets/js/fancybox/jquery.fancybox-buttons.js?v=1.0.5') }}"></script>

	<!-- Add Thumbnail helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="{{ ThemeService::path('assets/css/fancybox/jquery.fancybox-thumbs.css?v=1.0.7') }}" />
	<script type="text/javascript" src="{{ ThemeService::path('assets/js/fancybox/jquery.fancybox-thumbs.js?v=1.0.7') }}"></script>

	<!-- Add Media helper (this is optional) -->
	<script type="text/javascript" src="{{ ThemeService::path('assets/js/fancybox/jquery.fancybox-media.js?v=1.0.6') }}"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			$(".fancybox-frame").fancybox({
				maxWidth: 900,
				width: '100%',
				height: '100%'
			});
			$('.fancybox').fancybox();
		});
	</script>

    <link rel="stylesheet" href="{{ ThemeService::path('assets/css/wow-master/animate.css') }}">
    <script src="{{ ThemeService::path('assets/js/wow-master/wow.js') }}"></script>
    
    <script>
		wow = new WOW(
		  {
			animateClass: 'animated',
			offset:       100
		  }
		);
		wow.init();
    </script>
    
<script src="{{ ThemeService::path('assets/js/jquery-placeholder/jquery.placeholder.js') }}"></script>
<script>
    // To test the @id toggling on password inputs in browsers that don’t support changing an input’s @type dynamically (e.g. Firefox 3.6 or IE), uncomment this:
    // $.fn.hide = function() { return this; }
    // Then uncomment the last rule in the <style> element (in the <head>).
    $(function() {
        // Invoke the plugin
        $('input, textarea').placeholder({customClass:'my-placeholder'});
        // That’s it, really.
    });
</script>
