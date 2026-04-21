<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V1</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="{{asset('login-form/Login_v1/vendor/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('login-form/Login_v1/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('login-form/Login_v1/vendor/animate/animate.css')}}">	
	<link rel="stylesheet" type="text/css" href="{{asset('login-form/Login_v1/vendor/css-hamburgers/hamburgers.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('login-form/Login_v1/vendor/select2/select2.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('login-form/Login_v1/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('login-form/Login_v1/css/main.css')}}">
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="{{asset('login-form/Login_v1/images/img-01.png')}}" alt="IMG">
				</div>

				<form action="{{route('auth-login-proccess')}}" method="POST" class="login100-form validate-form" autocomplete="off">
                    @csrf
					<span class="login100-form-title">
						Member Login
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100 @error('email') is-invalid @enderror" type="text" name="email" placeholder="Email" value="{{old('email')}}" autocomplete="off">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
                        @error('email')
                            <small class="text-danger font-weight-bold">
                                {{ $message }}
                            </small>
                        @enderror
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100 @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password" autocomplete="off">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
						@error('email')
                            <small class="text-danger font-weight-bold">
                                {{ $message }}
                            </small>
                        @enderror
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="#">
							Username / Password?
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="#">
							{{-- Create your Account --}}
							{{-- <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i> --}}
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

		
	<script src="{{asset('login-form/Login_v1/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
	<script src="{{asset('login-form/Login_v1/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('login-form/Login_v1/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('login-form/Login_v1/vendor/select2/select2.min.js')}}"></script>
	<script src="{{asset('login-form/Login_v1/vendor/tilt/tilt.jquery.min.js')}}"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<script src="{{asset('login-form/Login_v1/js/main.js')}}"></script>

    @if(session('success'))
        <script>
            Swal.fire({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                icon: "success",
                title: "{{ session('success') }}"
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                icon: "error",
                title: "{{ session('error') }}"
            });
        </script>
    @endif

</body>
</html>