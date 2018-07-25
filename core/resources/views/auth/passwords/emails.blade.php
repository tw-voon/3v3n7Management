<!DOCTYPE html>
<html lang="en">

<head>
    <title>Mash Able Light</title>
    <!-- HTML5 Shim and Respond.js IE9 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Phoenixcoded">
    <meta name="keywords" content=", Flat ui, Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="Phoenixcoded">
    <!-- Favicon icon -->
    
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('icon/themify-icons/themify-icons.css') }}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{ asset('icon/icofont/css/icofont.css') }}">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">


</head>
{{Auth::guard('web')->check()}}
<body class="fix-menu">
    <section class="login p-fixed d-flex text-center bg-primary common-img-bg">
        <!-- Container-fluid starts -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    <div class="login-card card-block auth-body">
                        <form class="md-float-material" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="text-center">
                                <img src="{{ asset('images/logo_.png') }}" alt="logo.png">
                            </div>
                            <div class="auth-box">
                                <div class="row m-b-20">
                                    <div class="col-md-12 col-12">
                                        <h3 class="text-center txt-primary">Please enter your email</h3>
                                    </div>
                                </div>
                                <p class="text-inverse b-b-default text-left p-b-5">Please enter the email you use to create the account</p>
                                <div class="input-group">
                                    <input type="email" name="email" class="form-control" placeholder="Username" value="{{ old('email') }}" required autofocus>
                                     <span class="md-line"></span>
                                </div>
                                 @if (count($errors) > 0)
                                    <div class="alert alert-warning">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <small class="help-block" style="color:red;">
                                                    <li><strong>{{ $error }}</strong></li>
                                                </small>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Send Reset Password Email</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                        <!-- end of form -->
                    </div>
                    <!-- Authentication card end -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>

    <!-- Required Jquery -->
    <script type="text/javascript" src="{{ asset('plugins/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/tether/dist/js/tether.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="{{ asset('plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="{{ asset('plugins/modernizr/modernizr.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/modernizr/feature-detects/css-scrollbars.js') }}"></script>
    <!-- Custom js -->
    <script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
    <!-- color js -->
    <script type="text/javascript" src="{{ asset('js/common-pages.js') }}"></script>
</body>

</html>