<html>

<head>
	
	<style>
		html,
		body {
		  height: 100%;
		  width: 100%;
		  margin: 0;
		  padding: 0;
		  overflow: hidden;
		}

		#particles-js {
		  width: 100%;
		  height: 100%;
		}
	</style>

</head>

<body>
  	<div id="particles-js"></div>
	
	{{ Html::script('js/particle-network.min.js') }} 
	{{ Html::script('js/particles.js') }} 
</body>

</html>