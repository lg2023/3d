<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>HomePage</title>
	<!-- 引入Bootstrap和jQuery库 -->
	<link rel="stylesheet" href="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
	<script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
	<!-- 引入x3dom.js库 -->
	<script src="https://www.x3dom.org/download/x3dom.js"></script>
	<link rel="stylesheet" href="https://www.x3dom.org/download/x3dom.css">
	<!-- 引入自定义css和js -->
	<link rel="stylesheet" href="http://localhost:2000/views/css/slider.css">
	<link rel="stylesheet" href="http://localhost:2000/views/css/header.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<script src="http://localhost:2000/views/js/slider.js"></script>
	<style>
		section::before {
			content: "";
			display: block;
			position: absolute;
			top: 0;
			left: 0;
			height: 100%;
			width: 100%;
			background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0.5));
			/* 创建透明度渐变背景图像 */
		}
	</style>
</head>

<body>
<?php
include 'views/components/Header.php'
?>
	<div id="wholepage">
		<section id="pageintro" style="background-image:url('http://localhost:2000/assets/bkg_homepage.jpg');background-size:cover;">
			<div class="page">
				<div class="px-4 py-5 my-5 text-center">
					<!-- <img class="d-block mx-auto mb-4"
						src="https://upload.wikimedia.org/wikipedia/commons/c/ce/Coca-Cola_logo.svg" alt="" width="288"
						height="228"> -->
					<h1 class="display-5 fw-bold text-body-emphasis" style="color:red"></h1>
					<div class="col-lg-6 mx-auto " style="color:blue">
						<p class="lead mb-4 fw-bold text-body-emphasis"></p>
					</div>
				</div>
			</div>
		</section>
		<!-- <section>
			<div class="page">
				<div class="card">
					<div class="card-header">
						Featured
					</div>
					<div class="card-body">
						<h5 class="card-title">Special title treatment</h5>
						<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
						<a href="#" class="btn btn-primary">Go somewhere</a>
					</div>
				</div>
		</section> -->
	</div>
	<!-- add a loop to show all brands -->

	</div>

	<script>
		// new WholePageSlider({
		//     colors: ['white','deepskyblue', 'orange',  'lightgrey']
		// })
		function addSectionTemplate(title, background, intro, modelID) {
			return "<section>\
				<div class=\"page\" style=\"background-image:url('http://localhost:2000/" + background + "');background-size:cover;\">\
					<div class=\"card position-relative\" style=\"width:50%\">\
					<div class=\"card-header\"><h1>" +
				title +
				"</h1></div>\
					<div class=\"card-body\">\
						<p class=\"card-text\">" + intro + "</p>\
						<a onclick=\"showModel(" + modelID + ")\" class=\"btn btn-primary position-relative bottom-0 start-50 translate-middle-x\">Show Model Right Now!</a>\
					</div>\
				</div>\
		</section>\
		"
		}

		function showModel(modelID) {
			console.log(modelID);
			// $.ajax({
			// 	url: 'http://localhost:3000/due4-30/index.php/showModel',
			// 	method: 'POST',
			// 	data:modelID,
			// 	success: function(response) {},
			// 	error: function(xhr, status, error) {
			// 		console.log(error);
			// 	}
			// })
			window.location.href ='http://localhost:2000/index.php/showModel?modelID='+String(modelID)
			console.log('clicked');
		}
		
		$(document).ready(function() {
			// console.log( "ready!" );
			$.ajax({
				url: 'http://localhost:2000/index.php/homePageJSONapi',
				method: 'GET',
				success: function(response) {
					console.log(response);
					var data = JSON.parse(response);
					pageIntro = data[0];
					$('#pageintro').eq(0).find('h1').text(pageIntro.name);
					$('#pageintro').eq(0).find('p').text(pageIntro.intro);
					var models = data[1];
					// walk through the models
					models.forEach(element => {
						var newElement = $(addSectionTemplate(element.Title, element.Background, element.Intro, element.ModelId));
						$('#pageintro').after(
							newElement
						)
					});
					new WholePageSlider({})
					console.log(models)
				},
				error: function(xhr, status, error) {
					console.log(error);
				}
			});
		});
		// backgrounds:[
		// 		'assets/bkg_homepage.jpg',
		// 		'assets/bkg1.jpg',
		// 		'assets/bkg2.jpg'
		// 	]
	</script>
</body>

</html>