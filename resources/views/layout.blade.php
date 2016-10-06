<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>My Blog</title>

    <style type="text/css">
	
	body {  
		   text-align: center; 
	}  	
	
	div #wrapper {  
    	width: 800px;  
    	margin: 0 auto;  
    	text-align: left;  
    	border: 1px solid #FF0000;  
	}
	  
	</style>

</head>
<body>

	@section('sidebar')
            This is the master sidebar.
    <!-- @yield('contact') -->
    @showdy>

	<div style="align:center">
    	@yield('content')
 	</div>

</html>