<!DOCTYPE html>
<html>
<head>
	<!-- UI from here: https://codepen.io/FlorinPop17/pen/dyPvNKK -->
	<title>Telegram Bot API Proxy</title>
	<style type="text/css">
		@import url('https://fonts.googleapis.com/css?family=Muli&display=swap');

		* {
			box-sizing: border-box;
		}

		body {
			background-image: linear-gradient(45deg, #7175da, #9790F2);
			font-family: 'Muli', sans-serif;
			display: flex;
			align-items: center;
			justify-content: center;
			flex-direction: column;
			min-height: 100vh;
			margin: 0;
		}

		.courses-container {
			
		}

		.course {
			background-color: #fff;
			border-radius: 10px;
			box-shadow: 0 10px 10px rgba(0, 0, 0, 0.2);
			display: flex;
			max-width: 100%;
			margin: 20px;
			overflow: hidden;
			width: 700px;
		}

		.course h6 {
			opacity: 0.6;
			margin: 0;
			letter-spacing: 1px;
			text-transform: uppercase;
		}

		.course h2 {
			letter-spacing: 1px;
			margin: 10px 0;
		}

		.course-preview {
			background-color: #2A265F;
			color: #fff;
			padding: 30px;
			max-width: 250px;
		}

		.course-preview a {
			color: #fff;
			display: inline-block;
			font-size: 12px;
			opacity: 0.6;
			margin-top: 30px;
			text-decoration: none;
		}

		.course-info {
			padding: 30px;
			position: relative;
			width: 100%;
		}

		.progress-container {
			position: absolute;
			top: 30px;
			right: 30px;
			text-align: right;
			width: 150px;
		}

		.progress {
			background-color: #ddd;
			border-radius: 3px;
			height: 5px;
			width: 100%;
		}

		.progress::after {
			border-radius: 3px;
			background-color: #2A265F;
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			height: 5px;
			width: 66%;
		}

		.progress-text {
			font-size: 10px;
			opacity: 0.6;
			letter-spacing: 1px;
		}

		.btn {
			background-color: #2A265F;
			border: 0;
			border-radius: 50px;
			box-shadow: 0 10px 10px rgba(0, 0, 0, 0.2);
			color: #fff;
			font-size: 16px;
			padding: 12px 25px;
			position: absolute;
			bottom: 15px;
			right: 15px;
			letter-spacing: 1px;
			text-decoration: none;
		}

		#domain {
			cursor: pointer;
		}
	</style>
</head>
<body>
	<div class="courses-container">
		<div class="course">
			<div class="course-preview">
				<h6>Used for</h6>
				<h2>TelegramRC Bot</h2>
				<a href="https://tssaltan.top/?p=1928&utm_source=proxy">About TelegramRC Bot</a>
			</div>
			<div class="course-info">
				<h6>What is it?</h6>
				<h2>Proxy for Telegram Bot API</h2>
				<p>URI for using this proxy: <b id="domain" onclick="selectText(this)">https://<?php echo $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?></b></p>
				<a class="btn" href="https://github.com/TsSaltan/Telegram-bot-api-php-proxy">View at GitHub</a>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		function selectText(node) {
		    if (document.body.createTextRange) {
		        const range = document.body.createTextRange();
		        range.moveToElementText(node);
		        range.select();
		    } else if (window.getSelection) {
		        const selection = window.getSelection();
		        const range = document.createRange();
		        range.selectNodeContents(node);
		        selection.removeAllRanges();
		        selection.addRange(range);
		    } else {
		        console.warn("Could not select text in node: Unsupported browser.");
		    }
		}
	</script>
</body>
</html>