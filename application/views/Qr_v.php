<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>QR generator</title>

	<link rel="stylesheet" href="webassets/css/bootstrap.min.css">
	<style>
		h4{
			text-align: center;
			margin-top: 50px;
			margin-bottom: 40px;
		}
		.generate-section{
			text-align: center;
			padding-top: 50px;
			min-height: 469px;
			position: relative;
		}
		#qr-generate{
			position: absolute;
			bottom: 21px;
		}
		.qr-container{
			background: #b6cfff;
			text-align: center;
			padding: 100px 10px 20px 10px;
		}
		#qr{
			margin: 0 auto 100px auto;
			width: 200px;
			height: 200px;
			background: rgba(210,204,255,0.94);
		}
		#qr img, canvas{
			width: 100%;
		}
		.hidden{
			visibility: hidden;
		}
		#print, #download{
			margin: 0 auto;
		}

		@media print {
			*{
				visibility: hidden;
			}
			#qr img{
				visibility: visible;
			}
		}
	</style>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h4>QR 코드 생성기</h4>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="generate-section">
				<textarea id="qr-text"  placeholder="QR생성할" class="form-control" ></textarea>
				<button id="qr-generate" class="btn btn-primary btn-lg">QR코드 생성</button>
			</div>
		</div>
		<div class="col-md-6">
			<div class="qr-container">
				<div id="qr">

				</div>
				<div class="row">
					<div class="col-md-6">
						<button id="download" class="btn btn-primary btn-lg hidden">QR코드 저장</button>
					</div>
					<div class="col-md-6">
						<button id="print" class="btn btn-primary btn-lg hidden">QR코드 인쇄</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="webassets/js/jquery-2.2.3.min.js" ></script>
<script src="webassets/js/bootstrap.min.js" ></script>
<script src="webassets/qrcode/qrcode.min.js" ></script>
<script>
	$( document ).ready(function() {

		/*
		* Generate QR code
		* */
		$("#qr-generate").click(function(){
			var qrText = $("#qr-text").val();
			if(qrText != "" && qrText !== null){

				$("#qr").empty();

				var qrcode= new QRCode("qr", {
					width: 400,
					height: 400
				});
				qrcode.makeCode(qrText);


				$("#qr-text").val("")

				$("#generated").addClass("generated");
				$("#print").removeClass("hidden");
				$("#download").removeClass("hidden");

			} else {
				alert("qr 텍스트를 삽입하십시오 !!!");
				$("#generated").removeClass("generated");
			}
		});

		/*
		* Download QR code
		* */
		$("#download").click(function(){
			var base64 = $("#qr > img").attr('src');
			var a = document.createElement("a");
			a.href = base64;
			a.download = "qr.jpg"; //File name Here
			a.click();
		});

		/*
		* Print QR code
		* */
		$("#print").click(function(){
			print();
		});


	});
</script>
</body>
</html>
