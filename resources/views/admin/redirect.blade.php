<!DOCTYPE html>

<html>
    
  <head>
	 <meta charset="utf-8">
    <meta http-equiv="refresh" content="6;url={{ route('payout_history') }}">
    <title>Redirecting...</title>
</head>
<style>
    
    $color-primary1: #736efe;
$color-primary2: #5999ff;
$color-primary3: #44b9ff;
$color-primary4: #31d8ff;
$color-primary5: #18ffff;

*,
*::before,
*::after {
	margin: 0;
	padding: 0;
	box-sizing: inherit;
}

html {
	box-sizing: border-box;
}

body {
	background: #263238;
	font-family: "Nunito", sans-serif;
}

.container {
	margin: auto auto;
	height: 50vh;
	display: flex;
	flex-direction: column;
	justify-content: center;
	align-items: center;
}

.tittle,
.subtitle {
	margin-bottom: 20px;
	color: #44b9ff;
	letter-spacing: 4px;
	text-transform: uppercase;
}

.square-container {
	list-style-type: none;
	display: flex;
	position: relative;
}

.square {
	margin: 4px;
	width: 30px;
	height: 30px;
	border-radius: 7px;
	animation: rotating 2.5s ease infinite;
}

.square1 {
	background: #736efe;
	animation-delay: 0.2s;
}
.square2 {
	background: #5999ff;
	animation-delay: 0.4s;
}
.square3 {
	background: #44b9ff;
	animation-delay: 0.6s;
}
.square4 {
	background: #31d8ff;
	animation-delay: 0.8s;
}
.square5 {
	background: #18ffff;
	animation-delay: 1s;
}

@keyframes rotating {
	0% {
		transform: rotate(0) scale(1);
	}
	50% {
		transform: rotate(90deg) scale(0.6);
	}
	100% {
		transform: rotate(90deg) scale(1);
	}
}

footer {
	margin: auto auto;
	display: flex;
	flex-direction: column;
	justify-content: center;
	align-items: center;
	margin-bottom: 1px;
	color:#31d8ff;
}

footer a {
	color: #736efe;
}

    
</style>
<body>
	<section class="container">
		<div class="tittle">
			<h2>Redirecting...</h2>
		</div>
		<div class="subtitle">
		    
			<h3 style="text-align: center; color:red !important;"><b>Generating Payout.....</b></h3>
			<h4>Thanks to coming Mega World!!</h4>
		</div>
		<div class="square-container">
			<div class="square square1">&nbsp;</div>
			<div class="square square2">&nbsp;</div>
			<div class="square square3">&nbsp;</div>
			<div class="square square4">&nbsp;</div>
			<div class="square square5">&nbsp;</div>
		</div>
	</section>
	<footer>
		<h4>You should be redirected in the next 10 seconds.</h4>
	<p>If you are not redirected automatically, <a href="{{ route('payout_history') }}">click here</a>.</p>
	</footer>
</body>  
</html>
