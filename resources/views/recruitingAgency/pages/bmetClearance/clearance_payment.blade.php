
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Probashi Payment</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <style>
        .payment_section {
            height: 105vh;
            display: flex;
            align-items: center;
            background: #f1f1f1;
        }
        .payment_content {
            padding: 30px 50px;
            background: #FFFFFF;
            box-shadow: 0 15px 20px rgba(160, 163, 189, 0.25);
            border-radius: 12px;
            position: relative;
        }
        .payment_content .fimg {
            height: 25px;
        }
        .payment_content .fmitem {
            font-size: 12px;
            margin: 0 10px;
            font-weight: 500;
            color: #171717;
        }
        .fmenu_section a:hover {
            text-decoration: none;
        }
        .payment_content .fmitem:hover {
            color: #009ef7;
        }
        .btnn_section a {
            display: inline-block;
            border: 1px solid #009ef7;
            border-radius: 10px;
            color: #ffffff;
            font-size: 18px;
            font-weight: 600;
            padding: 4px 0;
            margin-bottom: 35px;
            width: 100%;
            background: #009ef7;
        }
        .btnn_section img {
            height: 26px;
        }
        .btnn_section a:hover {
            text-decoration: none;
            background: transparent;
            color: #009ef7;
            border: 1px solid #009ef7;
        }
        .top_logo {
            width: 150px;
            height: 150px;
            position: absolute;
            top: -75px;
            box-shadow: 0px 3px 10px rgb(0 0 0 / 8%);
            left: 50%;
            border-radius: 50%;
            transform: translateX(-50%);
            background-color: #fff;
        }
        .top_logo img {
            width: 80%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .payimg_section {
            margin: 60px 0px 30px;
        }
        .cancelBtn {
            border: 1px solid #009ef7;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            color: #009ef7;
            padding: 8px 0;
            width: 100%;
            display: inline-block;
            text-align: center;
        }
        .cancelBtn:hover {
            background: #009ef7;
            color: #fff;
            border: 1px solid #009ef7;
        }
        .payimg_section ul {
            list-style: none;
            width: 100%;
            margin: 0;
            padding: 0;
        }
        .payimg_section ul li {
            width: 47%;
            float: left;
            margin: 5px;
        }
        .payimg_section ul li a {
            display: inline-block;
        }
        .payimg_ {
            width: 100%;
            filter: grayscale(100%);
            border: 3px solid transparent;
            box-shadow: 0px 15px 20px rgba(160, 163, 189, 0.25);
            border-radius: 10px;
        }
        .payimg_section ul li a:hover img {
            filter: grayscale(0%);
        }
        .payimg_section ul li a.active img {
            filter: grayscale(0%);
            border: 3px solid #009ef7;
            border-radius: 5px;
            box-shadow: 0 15px 20px rgba(160, 163, 189, 0.25);
        }
        @media(max-width: 991.99px) {
            .payimg_section ul li {
                width: 100%;
            }
        }
        @media(max-width: 768px) {
            .top_logo img {
                height: 80px;
                position: absolute;
                top: -39px;
                left: 50%;
                transform: translateX(-50%);
            }
        }
        @media(max-width: 575px) {
            .payimg_section ul li {
                width: 100%!important;
                text-align: center!important;
            }
            .check {
                margin-top: 25px;
            }
            .payment_section {
                height: auto;
                /* margin-top: 50px; */
                padding: 50px 0;
            }
        }
    </style>
</head>
<body>
<div class="payment_section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="payment_content">
                    <div class="top_logo">
                        <img src="{{asset('assets/media/logos/logo.png')}}" alt="Smart Probashi">
                    </div>
                    <div class="payimg_section">
                        <h6 class="text-center mb-3">Please select one</h6>
                        <ul class="payul">
                            <li>
                                <a class="channel-click" data-channel="bkash" href="#">
                                    <img class="payimg_" src="{{ asset('assets/media/payment/bkash.png') }}" alt="">
                                </a>
                            </li>
                            <li>
                                <a class="channel-click" data-channel="ssl" href="#">
                                    <img class="payimg_" src="{{ asset('assets/media/payment/ssl.png') }}" alt="">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                    <b>Advance tax : {{$advanceTax}}</b><br>
                    <b>Service charge : {{$serviceCharge}}</b><br>
                    <b>Welfare & Insurance fee : {{$welfare}}</b>
                    <div class="check">
                        <div class="form-check mt-3 mb-2">
                            <input type="checkbox" class="form-check-input" id="agree_term" value="1">

                            <label style="font-size: 10px;" class="form-check-label" for="agree_term">
                                I have read and agree to the <a target="_blank" href="#">Privacy Policy</a>.,
                                <a href="#">Refund and Return Policy</a>. &
                                <a href="#">Terms and Conditions</a>
                                <span class="text-danger">*</span>
                            </label>
                        </div>
                    </div>

                    @if($totalAmount > 0)
                    <div class="btnn_section text-center">
                        <a class="btn disabled" id="pay_btn" href="#">
                            <img src="{{ asset('assets/media/payment/dollar.png') }}" alt="">
                            PAY {{$totalAmount}}.00
                        </a>
                    </div>
                    @else
                    <div class="btnn_section text-center">
                        <a class="btn disabled" href="#">
                            <img src="{{ asset('assets/media/payment/dollar.png') }}" alt="">
                            PAY 0.00
                        </a>
                    </div>
                    @endif


                    <div class="fmenu_section">
                        <div class="row">
                            <div class="col-md-5">
                                <a href="#" class="cancelBtn">Cancel</a>
                            </div>
                            <div class="col-md-7">
                                <div class="d-flex text-center justify-content-end">
                                    <a href="#" target="_blank">
                                        <img class="fimg" src="{{ asset('assets/media/payment/support.png') }}" alt="Support">
                                        <p class="fmitem">Support</p>
                                    </a>
                                    <a href="#" target="_blank">
                                        <img class="fimg" src="{{ asset('assets/media/payment/faq.png') }}" alt="FAQ">
                                        <p class="fmitem">FAQ</p>
                                    </a>
                                </div>
                                <form id="payment-form" action="{{route('recruiting-agency.clearance.payment.store')}}" method="post" class="d-none">
                                    @csrf
                                    <input type="hidden" id="clearance_id" name="clearance_id" value="{{$id}}">
                                    <input type="hidden" name="advance_tax" value="{{$advanceTax}}">
                                    <input type="hidden" name="service_charge" value="{{$serviceCharge}}">
                                    <input type="hidden" name="insurance_fee" value="{{$welfare}}">
                                    <input type="hidden" name="payment_status" value="1">
                                    <input type="hidden" name="total_candidate_payment" value="{{$candidateClearancesCount}}">
                                    <input type="hidden" name="total_payment" value="{{$totalAmount}}">
                                    <input type="hidden" id="input_channel" name="payment_type" value="bkash">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    var gCh = null;
    var gAg = null;
    $(document).ready(function(){
        $(".payul li a").click(function(){
            $(".payul li a").removeClass("active");
        });
        $(".payul li a").click(function(){
            $(this).addClass("active");
        });

        var chEl = $('.channel-click');
        var agEl = $('#agree_term');
        var payEl = $('#pay_btn');

        var inAgEl = $('#input_agree');
        var inChEl = $('#input_channel');

        chEl.on('click', function (e) {
            e.preventDefault();
            gCh = $(this).data('channel');
            inChEl.val(gCh);
            if(gCh && gAg === 1) {
                payEl.removeClass('btn disabled');
            } else {
                payEl.addClass('btn disabled');
            }
        });

        agEl.on('click', function (e) {
            gAg = null;
            if(e.target.checked) { gAg = 1; }
            inAgEl.val(gAg);
            if(gCh && gAg === 1) {
                payEl.removeClass('btn disabled');
            } else {
                payEl.addClass('btn disabled');
            }
        });

        payEl.on('click', function (e) {
            e.preventDefault();
            document.getElementById('payment-form').submit();
        });
    });
</script>
</body>
</html>
