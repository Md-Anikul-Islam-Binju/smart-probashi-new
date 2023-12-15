<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BMET Smart Card</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap');
        * {
            margin: 0;
            padding: 0;
        }
        .bmet_smart_card_wrapper {
            width: 300px;
            margin: 0 auto;
            box-shadow: 0px 10px 15px -3px rgba(0,0,0,0.1);
            border-radius: 18px;
            margin-top: 20px;
            margin-bottom: 20px;
            font-family: 'Roboto', sans-serif;
        }
        .bmet_smart_card_top {
            border: 1px solid #7584C2;
            border-radius: 18px;
        }
        .top_section {
            background: rgb(23,123,129);
            background: linear-gradient(168deg, rgba(23,123,129,1) 30%, rgba(137,98,220,1) 100%);
            color: #fff;
            padding: 20px;
            border-radius: 18px 18px 0px 0px;
        }
        .top_bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .top_bar h2 {
            font-size: 16px;
            font-weight: 400;
            margin-bottom: 10px;
        }
        .top_bar img {
            height: 30px;
        }
        .top_section p {
            font-weight: 300;
            font-size: 13px;
        }
        .user_information {
            padding: 20px;
        }
        .user_image_block {
            display: flex;
            gap: 30px;
            align-items: center;
        }
        .user_image_block img {
            width: 75px;
            height: 85px;
            border-radius: 6px;
            object-fit: fill;
            margin-left: 20px;
        }
        .user_info {
            margin-bottom: 3px;
            width: 105px;
        }
        .user_info span {
            font-size: 11px;
            color: #000000d1;
        }
        .user_info h4 {
            font-size: 13px;
            font-weight: 400;
            color: #000;
        }
        .user_more_info {
            margin-top: 25px;
        }
        .user_more_details {
            display: flex;
            align-items: center;
            gap: 17px;
            border-bottom: 1px solid #000;
        }
        .mb_user_more_details {
            margin-bottom: 10px;
        }
        .bmet_smart_card_bottom {
            padding: 20px;
            text-align: center;
        }
        .img_area img {
            width: 130px;
            height: 130px;
            border-radius: 8px;
            margin-bottom: 15px;
            box-shadow: 0px 10px 15px 0px rgb(0 0 0 / 11%);
        }
        .bmet_smart_card_bottom p {
            font-size: 12px;
            line-height: 18px;
        }
        .txt_transform {
            text-transform: uppercase;
        }
    </style>
</head>
<body>
<div class="bmet_smart_card_wrapper">
    <div class="bmet_smart_card_top">
        <div class="top_section">
            <div class="top_bar">
                <h2>BMET Smart Card</h2>
                <img src="https://d236ysur4cik0i.cloudfront.net/prod/public/assets/media/logos/govment-bmet-logo.png" alt="">
            </div>
            <p>Clearance ID: MY-{{$card->application_no}}</p>
        </div>
        <div class="user_information">
            <div class="user_image_block">
                <img src="{{asset('storage/'.$card->passportInfo->pdoInfo->photo)}}" alt="">
                <div class="user_short_info">
                    <div class="user_info">
                        <span>Name:</span>
                        <h4 class="txt_transform">{{$card->passportInfo->full_name}}</h4>
                    </div>
                    <div class="user_info">
                        <span>Passport Number:</span>
                        <h4>{{$card->passportInfo->passport_no}}</h4>
                    </div>
                    <div class="user_info">
                        <span>Clearance Date:</span>
                        <h4>{{ $card->created_at->format('d M Y') }}</h4>
                    </div>
                </div>
            </div>
            <div class="user_more_info">
                <div class="user_more_details mb_user_more_details">
                    <div class="user_info">
                        <span>Father:</span>
                        <h4 class="txt_transform">{{$card->passportInfo->personalInfo->fathers_name}}</h4>
                    </div>
                    <div class="user_info">
                        <span>Mother:</span>
                        <h4 class="txt_transform">{{$card->passportInfo->personalInfo->mothers_name}}</h4>
                    </div>
                </div>
                <div class="user_more_details">
                    <div class="user_info">
                        <span>BRA ID:</span>
                        <h4>{{$card->passportInfo->recruitingAgency->name}}</h4>
                    </div>
                    <div class="user_info">
                        <span>Passport Issue Date:</span>
                        <h4>{{ \Carbon\Carbon::parse($card->passportInfo->passport_issue_date)->format('d M Y') }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bmet_smart_card_bottom">
    {{--<p>Dynamic Link: <a href="{{ $dynamicLink }}">{{ $dynamicLink }}</a></p>--}}
        <!-- Display the QR code -->
        <img src="data:image/png;base64,{{ base64_encode($qrCode) }}" alt="QR Code">
    </div>
</div>
</body>
</html>
