<!doctype html>
<html>
	<meta charset="utf-8">
	<title>Praxis - Administration login</title>
	<style>
		html,body{
			height: 100%;
			width: 100%;
			font-family: verdana, sans-serif;
		}
		body{
			color: #444;
			padding: 0;
			margin: 0;

			background: #1e5799; /* Old browsers */
			background: -moz-linear-gradient(top, #1e5799 0%, #7db9e8 100%); /* FF3.6-15 */
			background: -webkit-linear-gradient(top, #1e5799 0%,#7db9e8 100%); /* Chrome10-25,Safari5.1-6 */
			background: linear-gradient(to bottom, #1e5799 0%,#7db9e8 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1e5799', endColorstr='#7db9e8',GradientType=0 ); /* IE6-9 */
		}
		.clearfix:before,
		.clearfix:after{
		  display: table;
		  content: " ";
		}
		.clearfix:after{
		  clear: both;
		}
		.Container{
			height: 100%;
			display: flex;
			align-items: center;
			justify-content: center;
		}
		.Container-title{
			align-self: flex-start;
			font-size: 2em;
			color: white;
			padding: 1em;
		}
		.Container-inner{
			flex: 1;
			max-width: 40%;
			border: .2em #fff solid;
			border-radius: 1em;
			margin-top: -12em;
			background-clip: padding-box;

			background: #f4a930; /* Old browsers */
			/*background: -moz-linear-gradient(top, #f4a930 0%, #f7de60 100%); /* FF3.6-15 */
			/*background: -webkit-linear-gradient(top, #f4a930 0%,#f7de60 100%); /* Chrome10-25,Safari5.1-6 */
			/*background: linear-gradient(to bottom, #f4a930 0%,#f7de60 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
			/*filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f4a930', endColorstr='#f7de60',GradientType=0 ); /* IE6-9 */
		}
		.Container-inner--form{
			margin: 2em;
			display: block;
		}
		.Container-form--label{
			display: block;
			font-size: 1em;
			text-transform: uppercase;
			font-weight: bold;
			margin-bottom: .7em;
		}
		.Container-input--container{
			padding: .4em .8em .4em .6em;
			border-radius: .4em;
			border: .09em #fff solid;
			background-color: #fff;
			margin-bottom: 1em;
		}
		.Container-form--input{
			margin: 0;
			padding: 0;
			width: 100%;
			font-size: 1.4em;
			border-width: 0;
			background-color: transparent;
		}
		.Container-form--input:focus{
			outline: 0;
		}
		.Container-form--submit{
			font-size: 1.1em;
			background-color: #f4a930;
			float: right;
			cursor: pointer;
			background-color: #fff;
			border-radius: .4em;
			border: .1em #fff solid;
			padding: .4em .8em;
			text-transform: uppercase;
		}
		.Container-form--submit:focus{
			outline: 0;
		}
	</style>
<head>

	<div class="Container-title">
		Praxis Administration Login
	</div>
	<div class="Container">
		<div class="Container-inner">
			<form action="/login/index.php" method="post" class="Container-inner--form">
                <input type="hidden" name="alternatelogin" value="yes" />
				<div>
					<label class="Container-form--label">Brugernavn</label>
					<div class="Container-input--container">
						<input class="Container-form--input" name="username" value="" autofocus>
					</div>
				</div>
				<div>
					<label class="Container-form--label">Kodeord</label>
					<div class="Container-input--container">
						<input class="Container-form--input" type="password" name="password" value="">
					</div>
				</div>
				<div class="clearfix">
					<input class="Container-form--submit" type="submit" value="Login">
				</div>
			</form>
		</div>
	</div>

</head>
</html>