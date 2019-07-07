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



<link type="image/ico" rel="shortcut icon" href="{{ ThemeService::path('assets/images/favicon.ico') }}">
<link href="{{ ThemeService::path('assets/css/bootstrap.min.css') }}"  rel="stylesheet">
<link href="{{ ThemeService::path('assets/css/bootstrap-theme.min.css') }}"  rel="stylesheet">

<link type="text/css" rel="stylesheet" href="{{ ThemeService::path('assets/css/internal-department/layout.css') }}"/>
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