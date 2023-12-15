
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Immigration Tab View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://clearance.amiprobashi.com/css/tab-css/style.css">
    <style>
        .customIframe{
            min-height: 500px;
            width: 100%;
        }
        p.manual_clearance {
            background: #5764fe;
            color: #fff!important;
            display: inline-block;
            padding: 3px 5px;
            border-radius: 3px;
        }
        p.online_clearance{
            background: #407f7c;
            color: #fff!important;
            display: inline-block;
            padding: 3px 5px;
            border-radius: 3px;
        }
        @media(max-width: 576px){
            .imigration-item-common {
                width: 100%;
            }
            .imigration-item1 {
                display: block!important;
            }
            .imigration-item1 .imileft img {
                width: 100px;
                height: 100px;
                border-radius: 5px;
            }
            .imiright h2 {
                font-size: 20px!important;
                line-height: 30px;
                text-align: center;
            }
            .imigration-item1 .imileft {
                width: 100%;
                margin-bottom: 15px;
            }
            .imigration-item1 .imiright {
                width: 100%;
                margin-left: 0;
            }
            td span{
                word-break: break-all;
            }
            .imiright table td{
                font-size: 16px!important;
            }
            .bmet-smart-card .bsc-top h4, .pdo-certificate .bsc-top h4, .bmet-registration .bsc-top h4, .passport .bsc-top h4{
                font-size: 16px!important;
            }
            .bsc-middle td {
                font-size: 14px!important;
                padding: 5px 0;
            }

        }
    </style>
</head>
<body>
<div class="container-fluid">
    <!-- start candidate info -->
    <div class="imigration-item-common">
        <div class="imigration-item1">
            <div class="imileft">
                <div class="topimg">
                    <img src="{{asset('storage/'.$clearance->passportInfo->pdoInfo->photo)}}" alt="Image Missing">
                </div>
                <div class="bottom-content">
                </div>
            </div>
            <div class="imiright">
                <h2 style="word-break: break-all;">{{$clearance->passportInfo->full_name}}</h2>
                <table>
                    <tr>
                        <td>Passport No</td>
                        <td class="text-end"><span>{{$clearance->passportInfo->passport_no}}</span></td>
                    </tr>
                    <tr>
                        <td>P. Issue Date</td>
                        <td class="text-end"><span>{{$clearance->passportInfo->passport_issue_date}}</span></td>
                    </tr>
                    <tr>
                        <td>Date of Birth</td>
                        <td class="text-end"><span>{{$clearance->passportInfo->dob}}</span></td>
                    </tr>
                    <tr>
                        <td class="border-bottom-none">Visa No.</td>
                        <td class="text-end border-bottom-none"><span>{{$clearance->passportInfo->visaInfo->visa_no}}</span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- start bmet smart card  -->
    <div class="bmet-smart-card imigration-item-common">
        <div class="bsc-top">
            <table class="w-100">
                <tr>
                    <td><h4>BMET Smart Card</h4></td>
                    <td class="text-end"><img height="32px" src="/img/new-tab-image/govt.png" alt=""> <img class="ms-md-3" height="32px" src="/img/new-tab-image/bmet.png" alt=""></td>
                </tr>
            </table>
        </div>
        <div class="bsc-middle">
            <div class="p-2 p-md-4">
                <table class="w-100">
                    <tr class="sep-border-dark">
                        <td class="w-50">Name</td>
                        <td class="text-end w-50"><span>{{$clearance->passportInfo->full_name}}</span></td>
                    </tr>
                    <tr class="sep-border-dashed">
                        <td class="w-50">Clearance ID</td>
                        <td class="text-end w-50"><span>{{$clearance->application_no}}</span></td>
                    </tr>
                    <tr class="sep-border-dashed">
                        <td class="w-50">Visa No</td>
                        <td class="text-end w-50"><span>{{$clearance->passportInfo->visaInfo->visa_no}}</span></td>
                    </tr>
                    <tr class="sep-border-dark">
                        <td class="w-50">BRA ID</td>
                        <td class="text-end w-50"><span>{{$clearance->passportInfo->recruitingAgency->name}}</span></td>
                    </tr>
                    <tr class="sep-border-dark">
                        <td class="w-50">Employer</td>
                        <td class="text-end w-50"><span>{{$clearance->job->employee_name}}</span></td>
                    </tr>
                    <tr class="sep-border-dark">
                        <td class="w-50">Country</td>
                        <td class="text-end w-50"><span>{{$clearance->job->country->country_name}}</span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- start pdo certificate  -->
    <div class="pdo-certificate imigration-item-common">
        <div class="bsc-top">
            <table class="w-100">
                <tr>
                    <td><h4>PDO Certificate</h4></td>
                    <td class="text-end"><img height="32px" src="/img/new-tab-image/govt.png" alt=""> <img class="ms-md-3" height="32px" src="/img/new-tab-image/bmet.png" alt=""></td>
                </tr>
            </table>
        </div>
        <div class="bsc-middle">
            <div class="p-2 p-md-4">
                <table class="w-100">
                    <tr class="sep-border-dark">
                        <td class="w-50">Name</td>
                        <td class="text-end w-50"><span>{{$clearance->passportInfo->full_name}}</span></td>
                    </tr>
                    <tr class="sep-border-dark">
                        <td class="w-50">Country</td>
                        <td class="text-end w-50"><span>{{$clearance->job->country->country_name}}</span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- start BMET Registration  -->
    <div class="bmet-registration imigration-item-common">
        <div class="bsc-top">
            <table class="w-100">
                <tr>
                    <td><h4>BMET Registration</h4></td>
                    <td class="text-end"><img height="32px" src="/img/new-tab-image/govt.png" alt=""> <img class="ms-md-3" height="32px" src="/img/new-tab-image/bmet.png" alt=""></td>
                </tr>
            </table>
        </div>
        <div class="bsc-middle">
            <div class="p-2 p-md-4">
                <table class="w-100">
                    <tr class="sep-border-dark">
                        <td class="w-50">Name</td>
                        <td class="text-end w-50"><span>{{$clearance->passportInfo->full_name}}</span></td>
                    </tr>
                    <tr class="sep-border-dark">
                        <td class="w-50">BMET No</td>
                        <td class="text-end w-50"><span>{{$clearance->passportInfo->verificationInfo->bmet_verification_registration_no}}</span></td>
                    </tr>
                    <tr class="sep-border-dark">
                        <td class="w-50">Birth Date</td>
                        <td class="text-end w-50"><span>{{$clearance->passportInfo->dob}}</span></td>
                    </tr>
                    <tr class="sep-border-dark">
                        <td class="w-50">NID</td>
                        <td class="text-end w-50"><span>{{$clearance->passportInfo->nid_no}}</span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- start Passport  -->
    <div class="passport imigration-item-common">
        <div class="bsc-top">
            <table class="w-100">
                <tr>
                    <td><h4>Passport</h4></td>
                    <td class="text-end"><img height="32px" src="/img/new-tab-image/govt.png" alt=""> <img class="ms-md-3" height="32px" src="/img/new-tab-image/bmet.png" alt=""></td>
                </tr>
            </table>
        </div>
        <div class="bsc-middle">
            <div class="p-2 p-md-4">
                <table class="w-100">
                    <tr class="sep-border-dark">
                        <td class="w-50">Name</td>
                        <td class="text-end w-50"><span>{{$clearance->passportInfo->full_name}}</span></td>
                    </tr>
                    <tr class="sep-border-dark">
                        <td class="w-50">Passport No</td>
                        <td class="text-end w-50"><span>{{$clearance->passportInfo->passport_no}}</span></td>
                    </tr>
                    <tr class="sep-border-dark">
                        <td class="w-50">Passport Issue Date</td>
                        <td class="text-end w-50"><span>{{$clearance->passportInfo->passport_issue_date}}</span></td>
                    </tr>
                    <tr class="sep-border-dark">
                        <td class="w-50">Passport Expiry Date</td>
                        <td class="text-end w-50"><span>{{$clearance->passportInfo->passport_expiry_date}}</span></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="bsc-bottom text-center p-4">
        </div>
    </div>
    <!-- end Passport -->
</div>



<!-- Modal -->
<div class="modal fade" id="rejectReason" tabindex="-1" aria-labelledby="rejectReasonLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="rejectReasonLabel">Reject Reason</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <textarea aria-label="" class="form-control" id="remark" rows="4" placeholder="Type here reason"></textarea>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                <button id="reject-btn" type="button" class="btn btn-primary">
                    Submit
                    <span class="spinner-border d-none" id="reject-spin" style="width: 1rem; height: 1rem"></span>
                </button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

<!-- Passport Modal Start -->

<div class="modal fade" id="passportModal" tabindex="-1" aria-labelledby="pdoCertificate" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="rejectReasonLabel">Passport Modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="https://amiprobashis3.s3.ap-southeast-1.amazonaws.com/images/document_wallet/passport/bb3874fd247da4a5b1406519876efda5.jpg?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&amp;X-Amz-Algorithm=AWS4-HMAC-SHA256&amp;X-Amz-Credential=AKIARRB2LOLRBWLVRTMS%2F20231205%2Fap-southeast-1%2Fs3%2Faws4_request&amp;X-Amz-Date=20231205T115503Z&amp;X-Amz-SignedHeaders=host&amp;X-Amz-Expires=1200&amp;X-Amz-Signature=29add0e42f1cb827ddd2f9c449af73780d204712c2e7a48623705fafb59ce508" />
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
            </div>
        </div>
    </div>
</div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://clearance.amiprobashi.com/js/jquery-3.6.1.min.js"></script>
<script src="https://clearance.amiprobashi.com/js/bootstrap.min.js"></script>
</body>
</html>
