<!DOCTYPE html>
<html lang="en">
<head>
    <title>Smart Probashi</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('assets/media/logos/favicon.ico') }}"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/animate/animate.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/select2/select2.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/main.css') }}">
    <!--===============================================================================================-->
</head>
<body>

<!--  -->
<div class="simpleslide100">
    <div class="simpleslide100-item bg-img1" style="background-image: url('frontend/images/bg01.jpg');"></div>
    <div class="simpleslide100-item bg-img1" style="background-image: url('frontend/images/bg02.jpg');"></div>
    <div class="simpleslide100-item bg-img1" style="background-image: url('frontend/images/bg03.jpg');"></div>
    <div class="simpleslide100-item bg-img1" style="background-image: url('frontend/images/bg04.jpg');"></div>
</div>

<div class="flex-col-c-sb size1 overlay1">
    <!--  -->
    <div class="w-full flex-w flex-sb-m p-l-80 p-r-80 p-t-22 p-lr-15-sm">
        <div class="wrappic1 m-r-30 m-t-10 m-b-10">
            <a href="#"><img src="{{ asset('frontend/images/icons/logo.png') }}" alt="LOGO"></a>
        </div>

        <div class="flex-w m-t-10 m-b-10">
            <a href="{{ route('login') }}" class="size2 m1-txt1 flex-c-m how-btn1 trans-04">
                Login
            </a>
        </div>
    </div>

    <!--  -->
    <div class="flex-col-c-m p-l-15 p-r-15 p-t-50 p-b-120">
        <h3 class="l1-txt1 txt-center p-b-35 respon1">
            Smart Probashi Website Coming Soon
        </h3>

        <div class="flex-w flex-c cd100 respon2">
            <div class="flex-col-c wsize1 m-b-30">
                <span class="l1-txt2 p-b-37 days">35</span>
                <span class="m1-txt2 p-r-20">Days</span>
            </div>

            <span class="l1-txt2 p-t-15 dis-none-sm">:</span>

            <div class="flex-col-c wsize1 m-b-30">
                <span class="l1-txt2 p-b-37 hours">17</span>
                <span class="m1-txt2 p-r-20">Hr</span>
            </div>

            <span class="l1-txt2 p-t-15 dis-none-lg">:</span>

            <div class="flex-col-c wsize1 m-b-30">
                <span class="l1-txt2 p-b-37 minutes">50</span>
                <span class="m1-txt2 p-r-20">Min</span>
            </div>

            <span class="l1-txt2 p-t-15 dis-none-sm">:</span>

            <div class="flex-col-c wsize1 m-b-30">
                <span class="l1-txt2 p-b-37 seconds">39</span>
                <span class="m1-txt2 p-r-20">Sec</span>
            </div>
        </div>
    </div>

    <!--  -->
    <div class="flex-w flex-c-m p-b-35">
        <a href="https://etl.com.bd/" target="_blank" style="color: whitesmoke; font-size: 22px" class="text-gray-800">{{ date('Y') }} &copy;  Ezze Technology Ltd.</a>
    </div>
</div>





<!--===============================================================================================-->
<script src="{{ asset('frontend/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('frontend/vendor/bootstrap/js/popper.js') }}"></script>
<script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('frontend/vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('frontend/vendor/countdowntime/moment.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/countdowntime/moment-timezone.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/countdowntime/moment-timezone-with-data.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/countdowntime/countdowntime.js') }}"></script>
<script>
    $('.cd100').countdown100({
        /*Set Endtime here*/
        /*Endtime must be > current time*/
        endtimeYear: 0,
        endtimeMonth: 0,
        endtimeDate: 35,
        endtimeHours: 19,
        endtimeMinutes: 0,
        endtimeSeconds: 0,
        timeZone: ""
        // ex:  timeZone: "America/New_York"
        //go to " http://momentjs.com/timezone/ " to get timezone
    });
</script>
<!--===============================================================================================-->
<script src="{{ asset('frontend/vendor/tilt/tilt.jquery.min.js') }}"></script>
<script >
    $('.js-tilt').tilt({
        scale: 1.1
    })
</script>
<!--===============================================================================================-->
<script src="{{ asset('frontend/js/main.js') }}"></script>

</body>
</html>
