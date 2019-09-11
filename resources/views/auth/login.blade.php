<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Log In</title>
    <!-- Favicon-->
    <link rel="icon" href="./favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="./plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="./plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="./plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="./plugin/css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./css/layoutApp.css">
</head>

<body class="login-page">
    <div class="login-box">

        <!-- Logo picture log in page -->
        <div class="logo">
            <a href="javascript:void(0);"><b>VENTURA</b></a>
        </div>
        <!-- #End -->

        <!-- Log in card -->
        <div class="card">
            <div class="body">
                <form id="sign_in" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="row text-center m-b-10">
                        <img class="image" src="./images/login.png">
                    </div>
                    <div class="msg">Welcome back</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="email" class="form-control" name="email" placeholder="Email" required autofocus>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert" style="color: red;">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert" style="color: red;">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="row text-center">
                        <div class="col-xs-6 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-blue">
                            <label for="rememberme">Remember Me</label>
                        </div>
                        <div class="col-xs-6 align-right m-t-5">
                            <!-- <a href="{{ route('password.request') }}">Forgot Password?</a> -->
                            <a href="#">Forgot Password?</a>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20"> 
                        <div class="col-xs-12 text-center">
                            <button class="btn btn-block bg-blue waves-effect" type="submit">LOG IN</button>
                        </div>
                    </div>
                    <div class="row">                       
                        <div class="form-line text-center">
                            <label>Don't you have an account?<a href="{{ route('register') }}">&nbsp;Register</a></label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- #End -->
    </div>

   <!-- Jquery Core Js -->
    <script src="./plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="./plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="./plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="./plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="./plugin/js/admin.js"></script>
    <script src="./plugin/js/pages/examples/sign-in.js"></script>
</body>

</html>