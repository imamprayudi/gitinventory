<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="./logins/fontgoogleapis.css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./logins/fonts/icomoon/style.css">
    <link rel="stylesheet" href="./logins/css/owl.carousel.min.css">
    <link rel="shortcut icon" href="./images/icon_gitinventory.ico">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./logins/css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="./logins/css/style.css">

    <title>Login - GIT Custom Inventory</title>
</head>

<body>
    <div class="half">
        {{-- <div class="bg order-1 order-md-2" style="background-image: url('./logins/images/header_login_gitinventory.png');"></div> --}}
        <div class="contents order-2 order-md-1">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-6">
                        <div class="form-block">
                            <div class="text-center mb-5">
                                <h3>Login to <strong>GIT Custom Inventory</strong></h3>
                                @if (session('status'))
                                    <div class="alert alert-danger">
                                        <strong>Failure!</strong><br>{{ session('status') }}
                                    </div>
                                @endif
                            </div>
                            <form action="{{ url('/login/postlogin') }}" method="post" autocomplete="off" >
                                @csrf
                                <div class="form-group first">
                                    <label for="userid">Userid</label>
                                    <input type="text" id="userid" name="userid" class="form-control" placeholder="Your Userid" required autofocus>
                                </div>
                                <label for="password">Password</label>
                                <div class="input-group last mb-3">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Your Password" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <input type="checkbox" onclick="showPass()">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-sm-flex mb-5 align-items-center">
                                    <span class="ml-auto"><a href="./" class="forgot-pass">Dashboard</a></span> 
                                </div>
                                <input type="submit" value="Log In" class="btn btn-block btn-info">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="./logins/js/jquery-3.3.1.min.js"></script>
    <script src="./logins/js/popper.min.js"></script>
    <script src="./logins/js/bootstrap.min.js"></script>
    <script src="./logins/js/main.js"></script>
    <script>
        function showPass() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>
</html>