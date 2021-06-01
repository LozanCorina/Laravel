<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<head>
<!-- Bootstrap4 files-->
<script src="{{ asset('front_assets/js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>
<link href="{{asset('front_assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<!-- custom style -->
<link href="{{asset('front_assets./css/ui.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('front_assets/css/responsive.css')}}" rel="stylesheet" media="only screen and (max-width: 1200px)" />

<!-- custom javascript -->
<script src="{{asset('front_assets/js/script.js')}}" type="text/javascript"></script>

<!-- our styles -->
<link href="{{asset('front_assets/css/styles.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('front_assets/css/checkout.css')}}" rel="stylesheet" type="text/css" />
</head>
<body>
    <section class="section-request bg padding-y-sm">
        <div class="container d-flex justify-content-center">
            <div class="box">
                <dl>
                    <dt>Subiect: </dt>
                    <dd> {{$data['subject']}}</dd>
                </dl>
                <dl>
                    <dt>Nume Prenume: </dt>
                    <dd>{{$data['name']}}</dd>
                </dl>
                <dl>
                    <dt>Nr. contact:</dt>
                    <dd>{{$data['phone']}}</dd>
                </dl>
                <dl>
                    <dt>Contestație:</dt>
                    <dd>{{$data['message']}}</dd>
                </dl>
            </div> <!-- box.// -->
        </div><!-- container // -->
    </section>
</body>
</html>
