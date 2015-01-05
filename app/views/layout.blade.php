<html>
  <head>
  	<meta charset="utf-8" />
  	<link type="text/css" rel="stylesheet" href="{{ asset("css/bootstrap.min.css") }}"/>
  	<link type="text/css" rel="stylesheet" href="{{ asset("css/bootstrap-theme.min.css") }}"/>
  	<script src="{{ asset("js/bootstrap.min.js") }}"/></script>
    <title>@yield('title')</title>
  </head>
  <body>
  	<div class="container">
    	@yield('content')
    </div>
    <br/>
    <footer class="footer">
    	<div class="container">
    		<p class="text-muted text-center">&copy; 2015 onpopri.com</p>
    	</div>
    </footer>
  </body>
</html>