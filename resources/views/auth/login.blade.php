<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login | Offin Security</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="csrf_token() }}">
	<link rel="stylesheet" href="css/vendor/bootstrap.min.css" />
	<link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="css/util.css" />
	<link rel="stylesheet" href="css/main.css" />
</head>
<body>
	
	<div class="main-container">
		<div class="container-login">
			<div class="wrap-login p-b-160 p-t-50">
				<form class="login-form validate-form" method="POST" action="{{ route('login') }}">
                    @csrf
					<span class="login-form-title p-b-30">
						Login
					</span>
					<p class="text-white mb-5">
						Enter your username and password to login <br>
						If you have forgotten any of these contact your administrator.
					</p>
					
					<div class="wrap-input rs1 validate-input" data-validate = "Please enter username" data-id="something">
						<input class="input{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" >
                        <span class="label-input">Username</span>
					</div>
					
					
					<div class="wrap-input rs2 validate-input" data-validate="Please enter password">
						<input class="input{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password">
                        <span class="label-input">Password</span>
					</div>

					<div class="container-login-form-btn">
						<button type="submit" class="login-form-btn">Login</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<script src="js/vendor/jquery-3.2.1.min.js"></script>
	<script src="js/vendor/popper.js"></script>
	<script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        $(document).ready(function(){
            $('.input').each(function(){
                if($(this).val().trim() != "") {
                    $(this).addClass('has-val');
                } 
			});
			
			
			@if ($errors->has('username'))
				el = $('[name="username"]');
				el.parent().attr('data-validate', "{{ $errors->first('username') }}" );
				showValidate(el);
			@endif

			@if ($errors->has('password'))
				el = $('[name="password"]');
				el.parent().attr('data-validate', "{{ $errors->first('password') }}" );
				showValidate(el);
			@endif
		})
		
		function showValidate(input) {
			var thisAlert = $(input).parent();

			$(thisAlert).addClass('alert-validate');
    	}
    </script>

</body>
</html>