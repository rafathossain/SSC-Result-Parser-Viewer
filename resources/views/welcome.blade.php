<!--
=========================================================
* Argon Design System - v1.2.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-design-system
* Copyright 2020 Creative Tim (http://www.creative-tim.com)

Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <title>
        SSC Result Archive
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <link href="{{ asset('assets/css/font-awesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="{{ asset('assets/css/argon-design-system.css?v=1.2.0') }}" rel="stylesheet" />
</head>

<body class="login-page">
    <section class="section section-shaped section-lg">
        <div class="shape shape-style-1 bg-gradient-default">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="container pt-lg-2">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="card bg-secondary shadow border-0">
                        <div class="card-header bg-white pb-5">
                            <div class="text-muted text-center mb-3">
                                <h5><b>Result Archive</b></h5>
                                <small>Check your SSC 2020 by your Roll and Institute EIIN<br>If the institue is not found, then add your Institute EIIN to get the result</small>
                            </div>
                            <div class="btn-wrapper text-center">
                                <a href="https://eboardresults.com/app/stud/" target="_blank" class="btn btn-neutral btn-icon">
                                    <span class="btn-inner--icon"><img src="{{ asset('assets/img/result.png') }}"></span>
                                    <span class="btn-inner--text">Get Result Gradesheet</span>
                                </a>
                            </div>
                            <br>
                            <div class="btn-wrapper text-center">
                                <a href="{{ url('/add/eiin') }}" class="btn btn-neutral btn-icon">
                                    <span class="btn-inner--icon"><img src="{{ asset('assets/img/institute.png') }}"></span>
                                    <span class="btn-inner--text">Add Your Institution</span>
                                </a>
                            </div>
                            <br>
                            <div class="btn-wrapper text-center">
                                <a href="{{ url('/eiin/list') }}" class="btn btn-neutral btn-icon">
                                    <span class="btn-inner--icon"><img src="{{ asset('assets/img/list.png') }}"></span>
                                    <span class="btn-inner--text">Institution List</span>
                                </a>
                            </div>
                            @if(session()->has('error') && session()->get('error'))
                            <br>
                            <div align="center" class="alert alert-danger" role="alert">
                                {!! nl2br(session()->get('message')) !!}
                            </div>
                            @endif
                            @if(session()->has('error') && !session()->get('error'))
                            <br>
                            <div align="center" class="alert alert-success" role="alert">
                                {{ session()->get('message') }}
                            </div>
                            @endif
                        </div>
                        <div class="card-body px-lg-5 py-lg-5">
                            <form role="form" action="{{ url('/get_result') }}" method="post">
                                @csrf
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-paper-diploma"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="SSC Roll" name="roll" type="text" required>
                                    </div>
                                </div>
                                <div class="form-group focused">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Institute EIIN" name="eiin" type="text" required>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary my-4">Check Result</button>
                                </div>
                            </form>
                            <div align="center" class="mt-3">
                                <h6 class="text-primary font-weight-light mb-2">Developed By Md. Rafat Hossain</h6>
                                <small class="mb-0 font-weight-light">Let's get in touch on any of these platforms.</small>
                                <div class="col-lg-6 text-lg-center btn-wrapper mt-5 mb-3">
                                    <button target="_blank" href="https://twitter.com/rafathossian96" rel="nofollow" class="btn btn-icon-only btn-twitter rounded-circle" data-toggle="tooltip" data-original-title="Follow me">
                                        <span class="btn-inner--icon"><i class="fa fa-twitter"></i></span>
                                    </button>
                                    <button target="_blank" href="https://www.facebook.com/rafat.hossain.12/" rel="nofollow" class="btn-icon-only rounded-circle btn btn-facebook" data-toggle="tooltip" data-original-title="Follow me">
                                        <span class="btn-inner--icon"><i class="fab fa-facebook"></i></span>
                                    </button>
                                    <button target="_blank" href="https://github.com/rafathossain96" rel="nofollow" class="btn btn-icon-only btn-github rounded-circle" data-toggle="tooltip" data-original-title="Star on Github">
                                        <span class="btn-inner--icon"><i class="fa fa-github"></i></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
    <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
    <script src="{{ asset('assets/js/plugins/bootstrap-switch.js') }}"></script>
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="{{ asset('assets/js/plugins/nouislider.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/plugins/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datetimepicker.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-datepicker.min.js') }}"></script>
    <!-- Control Center for Argon UI Kit: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets/js/argon-design-system.min.js?v=1.2.0') }}" type="text/javascript"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-84246048-8"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-84246048-8');
    </script>

</body>

</html>