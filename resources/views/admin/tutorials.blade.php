@extends('layouts.app')
@section('tutorial-active-class', 'active')
@section('content')

<header>
    <style>
        .stepper {
            .line {
                width: 2px;
                background-color: lightgrey !important;
            }

            .lead {
                font-size: 1.1rem;
            }
        }

        .flip-card {
            background-color: transparent;
            width: 300px;
            height: 200px;
            perspective: 1000px;
        }

        .flip-card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
            transition: transform 0.6s;
            transform-style: preserve-3d;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        }

        .flip-card:hover .flip-card-inner {
            transform: rotateY(180deg);
        }

        .flip-card-front,
        .flip-card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
        }

        .flip-card-front {
            background-color: #bbb;
            color: black;
        }

        .flip-card-back {
            background-color: #2980b9;
            color: white;
            transform: rotateY(180deg);
        }
        .thumb-lg {
height: 88px;
width: 88px;
}
.card {
border: none;
box-shadow: 1px 0px 20px rgba(0, 0, 0, 0.05);
}
.m-b-30 {
margin-bottom: 30px;
}
.social-links li a {
-webkit-border-radius: 50%;
background: #fcfdfd;
border-radius: 50%;
color: #9f9f9f;
display: inline-block;
height: 30px;
line-height: 30px;
text-align: center;
width: 30px;
}


.card1{
    height: 400px;
    overflow-y: auto;
}

.card1 button{
    position: absolute;
    bottom: 0;
}

.card-img-top{
    height: 140px;
}

.accordion-button{
    background-color: #a80000;
    color: white;
}

..nav-link.active {
    color: white !important;
    background-color: #a80000 !important;
}

.card-header{
    background-color: #a80000 !important;
    color: white !important;
}
.btn-link{
    color: white !important;
}

.nav-tabs li a{
    background-color: #a80000 !important;
    color: white !important;
    border: 1px solid #a80000 !important;
}

.nav-tabs li a:hover{
    background-color: white !important;
    color: #a80000 !important;
    border: 1px solid #a80000 !important;

}

    </style>
</header>
<div class="container-fluid">
    <div class="page-head">
        <h4 class="mt-2 mb-2">Tutorials</h4>
        @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
        @endif
        
    </div>

    <!--end row-->
    <div class="row d-flex">
        <div class="col-lg-12 col-sm-12">

            <div class="card m-b-30">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <h5 class="header-title pb-3"></h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row d-flex">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <div class=" row d-flex">

                                    <!-- FIRST CARD PTA START =============== -->
                                    <div class="card1 col-sm-3 col-12">
                                        <img class="card-img-top" src="https://zameenblog.s3.amazonaws.com/blog/wp-content/uploads/2020/06/cover-image-040620.jpg" alt="Card image cap">
                                        <div class="card-body">
                                            <h5 class="card-title">PTA Approval</h5>
                                            <p class="card-text">PTA provides tax exemptions to diplomats in Pakistan. Here is how can apply to avail this facility</p>
                                            <button type="button" class="btn btn-outline-danger w-75" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target=".bd-example-modal-lg">Proceed</button>
                                        </div>
                                    </div>
                                    <!-- FIRST CARD PTA ENDS =============== -->

                                    <!-- SECOND CARD AES START =============== -->
                                    <div class="card1 col-sm-3 col-12">
                                        <img class="card-img-top" src="https://images.moneycontrol.com/static-mcnews/2021/05/shutterstock_245322604.jpg" alt="Card image cap">
                                        <div class="card-body">
                                            <h5 class="card-title">Temporary Airport Entry Pass</h5>
                                            <p class="card-text">For airport entry pass, first inquire about procedures and requirements at the respective airport authority or relevant department.</p>
                                            <button type="button" class="btn btn-outline-danger w-75" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target=".bd-example-modal-md">Proceed</button>
                                        </div>
                                    </div>
                                    <!-- SECOND CARD AES END =========== -->

                                    <!-- ================AIRPORT ENTRY PASS WITH ONE YEAR  VALIDITY START=================== -->
                                    <div class="card1 col-sm-3 col-12">
                                        <img src="https://www.frebers.com/wp-content/uploads/wpdm-cache/AIrport_illustration-01-768x0.jpg" class="card-img-top" alt="..." width="100%">
                                        <div class="card-body">
                                            <h5 class="card-title">Airport Entry Pass (1 Year Validity)</h5>
                                            <p class="card-text">For airport entry pass, first inquire about procedures and requirements at the respective airport authority or relevant department.</p>
                                            <button type="button" class="btn btn-outline-danger w-75" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target=".bd-example-modal-aep">Proceed</button>
                                        </div>
                                    </div>
                                    <!-- ================AIRPORT ENTRY PASS WITH ONE YEAR  VALIDITY END=================== -->

                                    <!-- ================DIPLOMATIC CARGO START=================== -->
                                    <div class="card1 col-sm-3 col-12">
                                        <img src="https://cdn-dfhie.nitrocdn.com/oPsTPqRCPGgSMfLuFJisKjZurNcFHHYO/assets/images/optimized/rev-5f728a2/customscity.com/wp-content/uploads/2023/05/Streamlining-the-Customs-Clearance-Process-with-Automated-Software-Solutions_1.webp" class="card-img-top" alt="..." width="100%">
                                        <div class="card-body">
                                            <h5 class="card-title">Diplomatic Cargo Clearance</h5>
                                            <p class="card-text">Steps and Procedure for Diplomatic Cargo Clearance</p>
                                            <button type="button" class="btn btn-outline-danger w-75" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target=".bd-example-modal-cargo">Proceed</button>
                                        </div>
                                    </div>
                                    <!-- ================DIPLOMATIC CARGO END=================== -->

                                    <!-- ================OBTAIN ANY CERTIFICATE START=================== -->
                                    <div class="card1 col-sm-3 col-12 mt-4">
                                        <img src="https://lh6.googleusercontent.com/XItCpAahPFJ_Q69E62seQ_1OqMyPNDjpbpF1GnQ5M8_dcYfR1Cf6svN-98682VnmAdV3-SU4CR7oEV_CrJki3t444ImvEydSWIN2pNxFUSeOqOKpbu4gO-1SYCLZk0kZITmQ5SlbdQNKcaOu3X4vcvo" class="card-img-top" alt="..." width="100%">
                                        <div class="card-body">
                                            <h5 class="card-title">Obtaining Your Certificate</h5>
                                            <p class="card-text">Steps and Procedure for Obtaining Your Certificate</p>
                                            <button type="button" class="btn btn-outline-danger w-75" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target=".bd-example-modal-cert">Proceed</button>
                                        </div>
                                    </div>
                                    <!-- ================OBTAIN ANY CERTIFICATE END=================== -->

                                    <!-- ================PAK VISA START=================== -->
                                    <div class="card1 col-sm-3 col-12 mt-4">
                                        <img src="https://www.pakistanconsulatemanchester.org/wp-content/uploads/2020/12/e_visa_pakistan_online_banner.jpg" class="card-img-top" alt="..." width="100%">
                                        <div class="card-body">
                                            <h5 class="card-title">How to Get Pakistani Visa</h5>
                                            <p class="card-text">Guide to Obtaining Pakistani Visa: Requirements and Process Explained.</p>
                                            <button type="button" class="btn btn-outline-danger w-75" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target=".bd-example-modal-pv">Proceed</button>
                                        </div>
                                    </div>
                                    <!-- ================PAK VISA END=================== -->

                                    <!-- ================POLICE CASE START=================== -->
                                    <div class="card1 col-sm-3 col-12 mt-4">
                                        <img src="https://i.dawn.com/primary/2019/02/5c6116909710a.jpg" class="card-img-top" alt="..." width="100%">
                                        <div class="card-body">
                                            <h5 class="card-title">Legal Guide for Foreigners in Pakistan:</h5>
                                            <p class="card-text">Dealing with Police Cases and Procedures Explained.</p>
                                            <button type="button" class="btn btn-outline-danger w-75" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target=".bd-example-modal-pc">Proceed</button>
                                        </div>
                                    </div>
                                    <!-- ================POLICE CASE END=================== -->

                                </div>



                                <!-- Large modal PTA START-->
                                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div id="accordion">
                                                <div class="card">
                                                    <div class="modal-header bottom-border p-1 ">
                                                        <h3 class="modal-title modal-heading text-black" id="exampleModalLabel"><strong>Start</strong></h3>
                                                        <button type="button" class="close little-modalclose-btn p-1 px-2" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                        </button>
                                                        </div>

                                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <div class="row d-flex align-items-center">
                                                                <div class="col-6">
                                                                    <img src="https://img.freepik.com/premium-vector/successful-arabic-business-vector-illustration-people-office-professional-meeting-arab-team_109722-4028.jpg" alt="" width="100%">
                                                                </div>
                                                                <div class="col-6">
                                                                    <h3>Initiated by the Diplomat</h3>
                                                                    <p>The secretary will follow up the process for exemption certificate from PTA</p>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="headingTwo">
                                                        <h5 class="mb-0">
                                                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                                <h4>Writing a Letter</h4>
                                                            </button>
                                                        </h5>
                                                    </div>
                                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <div class="row d-flex align-items-center">
                                                                <div class="col-6">
                                                                    <p>Write a letter to Ambassador and mentioned the IMEI number(s)</p>
                                                                    <p>Take the pictures of mobile IMEI on the back of mobile or mobile box, and save in external USB devices</p>
                                                                </div>
                                                                <div class="col-6">
                                                                    <img src="https://sithcomputers.com/wp-content/uploads/2021/02/English-Typing.gif" alt="" width="100%">
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="headingThree">
                                                        <h5 class="mb-0">
                                                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                                <h4>Preparing the Case</h4>
                                                            </button>
                                                        </h5>
                                                    </div>
                                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <div class="row d-flex align-items-center">
                                                                <div class="col-6">
                                                                    <img src="https://next3-assets.s3.amazonaws.com/journeys/18/description_backgrounds-1423860386-writing_intro.gif" alt="" width="50%">
                                                                </div>
                                                                <div class="col-6">
                                                                    <h5>Signed the letter by diplomat</h5>
                                                                </div>
                                                            </div>
                                                            <div class="row d-flex align-items-center">
                                                                <div class="col-6">
                                                                    <img src="https://i.pinimg.com/originals/af/10/b0/af10b0661568f8aa2f98a43f7298224e.gif" alt="" width="50%">
                                                                </div>
                                                                <div class="col-6">
                                                                    <h5>Pack this letter with USB to send by mail to Embassy in Islamabad for further procedures.</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="card">
                                                    <div class="card-header" id="headingFour">
                                                        <h5 class="mb-0">
                                                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                                <h4>Sample Letter</h4>
                                                            </button>
                                                        </h5>
                                                    </div>
                                                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <p>Ref: 1/6/21-0111 <br>
                                                                Date: 02-05- 2023 <br>
                                                                <br>
                                                                The Ambassador <br>
                                                                Embassy of the United Arab Emirates <br>
                                                                Islamabad. <br>
                                                                <br>
                                                            <div class="font-weight-bold">Subject: Exemption Certificate For Iphone 14 Pro Max Diplomat Abdul Rehman</div>
                                                            <br>
                                                            <p>The Consulate General of U.A.E. in Karachi presents its compliments to the Embassy of the United Arab Emirates, Islamabad and has the honour to inform that following IPhone 14 Pro Max has been purchased by the Diplomat Mr. Abdur Rehman Rashed Saif Alshani Alghafeli.</p>
                                                            <table class="table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="col-1">#</th>
                                                                        <th class="col-2">Phone</th>
                                                                        <th class="col-3">Model</th>
                                                                        <th class="col-6">IMEI No</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <th scope="row">1</th>
                                                                        <td>Iphone</td>
                                                                        <td>14 Pro Max</td>
                                                                        <td>358165601952913- 358165601526030</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table> <br>
                                                            The Consulate General of U.A.E. in Karachi would appreciate it much if the exemption certificate of the abovementioned Iphone is arranged from the concerned departments of the Government of Pakistan.
                                                            <br>
                                                            The Consulate General of U.A.E. in Karachi avails itself of this opportunity to renew to the esteemed Embassy of the United Arab Emirates, Islamabad the assurances of its highest consideration.
                                                            <br><br><br><br>
                                                            <div class="font-weight-bold">Consulate General of UAE, Karachi.</div>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Large modal PTA  END-->

                                <!-- LIST AIRPORT ENTRY START============== -->
                                <div class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">


                                            <div class="container">
                                                <div class="modal-header bottom-border p-1 ">
                                                    <h3 class="modal-title modal-heading text-black" id="exampleModalLabel"><strong>Airport Entry Pass</strong></h3>
                                                    <button type="button" class="close little-modalclose-btn p-1 px-2" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                    </button>
                                                    </div>
                                                <img src="https://blog.asaptickets.com/wp-content/uploads/2016/06/how-does-tsa-precheck-work-asaptickets-4.jpg" alt="" width="100%">
                                                <div class="accordion" id="accordionExample">
                                                    <div class="accordion-item">
                                                        <h3 class="accordion-header" id="heading-1">
                                                            <hr>
                                                            <button class="accordion-button border-0 w-100" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
                                                                Collect Data of Delegation Members
                                                            </button>
                                                        </h3>
                                                        <div id="collapse-1" class="accordion-collapse collapse show" aria-labelledby="heading-1" data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">

                                                                <div class="container d-flex">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" id="customCheckBox1">
                                                                        <label class="custom-control-label" for="customCheckBox1">
                                                                            <h4>Collect Guests Details</h4>
                                                                        </label>
                                                                        <div class="d-flex">✅ &nbsp;&nbsp;<p> Visiting Location</p>
                                                                        </div>
                                                                        <div class="d-flex">✅ &nbsp;&nbsp;<p> Purpose of Visit</p>
                                                                        </div>
                                                                        <div class="d-flex">✅ &nbsp;&nbsp;<p> Complete Name of Guests</p>
                                                                        </div>
                                                                        <div class="d-flex">✅ &nbsp;&nbsp;<p> Designation of all Guests</p>
                                                                        </div>
                                                                        <div class="d-flex">✅ &nbsp;&nbsp;<p> Flight Details (Flight Numer, Airline, Flight date & time)</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" id="customCheckBox2">
                                                                        <label class="custom-control-label" for="customCheckBox2">
                                                                            <h4>Receiving Members</h4>
                                                                        </label>
                                                                        <div class="d-flex">✅ &nbsp;&nbsp;<p> Complete Names</p>
                                                                        </div>
                                                                        <div class="d-flex">✅ &nbsp;&nbsp;<p> Designation</p>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h3 class="accordion-header" id="heading-2">
                                                            <button class="accordion-button collapsed border-0 w-100" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-2" aria-expanded="false" aria-controls="collapse-2">
                                                                Sample Letter
                                                            </button>
                                                        </h3>
                                                        <div id="collapse-2" class="accordion-collapse collapse" aria-labelledby="heading-2" data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <strong>Ref : 1/6/21-262 </strong> <br>
                                                                <strong>Date: 27-10- 2022</strong> <br> <br>
                                                                <strong><u>Subject: UAE Delegation Arrival</u></strong> <br> <br>

                                                                <p>The Consulate General of the United Arab Emirates in Karachi presents its compliments to the Ministry of Foreign Affairs, Government of the Islamic Republic of Pakistan, and has the honour to inform that our senior delegation of UAE is visiting <strong>VISITING LOCATION</strong> for <strong>PURPOSE</strong>. <br>
                                                                    <br>
                                                                    We would like to request your esteemed ministry to kindly ask ASF to issue our Senior Consulate/Embassy staff single airport entry pass to receive them.
                                                                    <br> <br>
                                                                    The details of our receiving staff and delegation members are as under;
                                                                </p> <br>
                                                                <p>Delegation Members Arriving;</p>

                                                                <table class="table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="col-1">#</th>
                                                                            <th class="col-5">Dignitaries</th>
                                                                            <th class="col-3">Designation</th>
                                                                            <th class="col-3">Remarks</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <th scope="row">1</th>
                                                                            <td>Brig. Abdullah Sultan Hassan Sultan Alkhzaim</td>
                                                                            <td>Brig. UAE Navy</td>
                                                                            <td>Flight EK-606 (00:50)</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">2</th>
                                                                            <td>Col. Eisa Sulaiman Suwaid Saeed Alnuaimi</td>
                                                                            <td>Colonel</td>
                                                                            <td>Flight EK-606 (00:50)</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <br>
                                                                <p>Receiving Members;
                                                                </p>

                                                                <table class="table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="col-1">#</th>
                                                                            <th class="col-5">Dignitaries</th>
                                                                            <th class="col-3">Designation</th>
                                                                            <th class="col-3">Remarks</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <th scope="row">1</th>
                                                                            <td>Deputy Col. Staff Eng. (N) Mohammad Ali Saeed Al Naqbi</td>
                                                                            <td>UAE Military Attache</td>
                                                                            <td>Having airport entry pass for Islamabad airport</td>
                                                                        </tr>

                                                                    </tbody>
                                                                </table> <br>
                                                                <p>The Consulate General of UAE avails itself of this opportunity to renew to the esteemed Ministry of Foreign Affairs, Government of the Islamic Republic of Pakistan, Islamabad, and the assurances of its highest consideration.
                                                                </p>
                                                                <strong>
                                                                    Ministry of Foreign Affairs, <br>
                                                                    Government of the Islamic <br>
                                                                    Republic of Pakistan, <br>
                                                                    Karachi
                                                                </strong>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="accordion-item">
                                                        <h3 class="accordion-header" id="heading-3">
                                                            <button class="accordion-button collapsed border-0 w-100" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-3" aria-expanded="false" aria-controls="collapse-3">
                                                                Steps to Do
                                                            </button>
                                                        </h3>
                                                        <div id="collapse-3" class="accordion-collapse collapse" aria-labelledby="heading-3" data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <!-- =====================STEPPERS START==================== -->
                                                                <div class="stepper d-flex flex-column mt-5 ml-2">
                                                                    <div class="d-flex mb-1">
                                                                        <div class="d-flex flex-column pr-4 align-items-center">
                                                                            <div class="rounded-circle py-2 px-3 bg-primary text-white mb-1">1</div>
                                                                            <div class="line h-100"></div>
                                                                        </div>
                                                                        <div>
                                                                            <h5 class="text-dark">Step - 1</h5>
                                                                            <p class="lead text-muted pb-3">Choose your website name & create repository</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex mb-1">
                                                                        <div class="d-flex flex-column pr-4 align-items-center">
                                                                            <div class="rounded-circle py-2 px-3 bg-primary text-white mb-1">2</div>
                                                                            <div class="line h-100"></div>
                                                                        </div>
                                                                        <div>
                                                                            <h5 class="text-dark">Step - 2</h5>
                                                                            <p class="lead text-muted pb-3">Go to your dashboard and clone Git respository from the url in the dashboard of your application</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex mb-1">
                                                                        <div class="d-flex flex-column pr-4 align-items-center">
                                                                            <div class="rounded-circle py-2 px-3 bg-primary text-white mb-1">3</div>
                                                                            <div class="line h-100 d-none"></div>
                                                                        </div>
                                                                        <div>
                                                                            <h5 class="text-dark">Step - 3</h5>
                                                                            <p class="lead text-muted pb-3">Now make changes to your application source code, test it then commit &amp; push</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- =====================STEPPERS ENDS==================== -->

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

                                                <!-- LIST GROUP END ================   -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- LIST AIRPORT ENTRY END============== -->

                                <!-- ===================START AIRPORT ENTRY PASS 1 YEAR VALIDITY DIPLOMATS============== -->

                                <div class="modal fade bd-example-modal-aep" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <div class="modal-header bottom-border p-1 ">
                                                <h3 class="modal-title modal-heading text-black" id="exampleModalLabel"><strong>Airport Entry Pass (1 Year Validity)</strong></h3>
                                                <button type="button" class="close little-modalclose-btn p-1 px-2" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                                </button>
                                                </div>
                                            <div class="modal-body">
                                                <div class="container">
                                                    <a href="https://getbootstrap.com/docs/4.0/components/navs/#tabs" target="_blank">

                                                    </a>
                                                    <div>
                                                        <ul class="nav nav-tabs d-flex justify-content-around" role="tablist">
                                                            <li class="nav-item">
                                                                <a href="#diplomats" role="tab" data-toggle="tab" class="nav-link active">
                                                                    <h4>Diplomats</h4>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="#staff" role="tab" data-toggle="tab" class="nav-link">
                                                                    <h4>Staff</h4>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <div class="tab-content">

                                                        <div class="tab-pane active" role="tabpanel" id="diplomats">
                                                            <h3> For Diplomats </h3>
                                                            <p> The AEP (Airport Entry Passes) for diplomats are issued every year on the submission of following documents to Ministry of Foreign Affairs – Government of Pakistan, Camp Office – Karachi. </p>
                                                            <hr>

                                                            <div class="container">
                                                                <H4>Requirements</H4>
                                                                <div class="accordion" id="accordionExample2">
                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-01">
                                                                            <hr>
                                                                            <button class="accordion-button border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-01" aria-expanded="true" aria-controls="collapse-01">
                                                                                MOFA Form
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-01" class="accordion-collapse collapse show" aria-labelledby="heading-01" data-bs-parent="#accordionExample2">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col">
                                                                                        The prescribed standard form for AEP. <br>
                                                                                        (Available in MOFA Camp Office)
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <img src="https://cdn3.iconfinder.com/data/icons/basic-regular-2/64/85-1024.png" alt="" width="50%">
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-02">
                                                                            <button class="accordion-button collapsed border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-02" aria-expanded="false" aria-controls="collapse-02">
                                                                                Diplomatic ID Card
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-02" class="accordion-collapse collapse" aria-labelledby="heading-2" data-bs-parent="#accordionExample2">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col">
                                                                                        Photocopy of Diplomatic ID Card
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <div class="flip-card">
                                                                                            <div class="flip-card-inner">
                                                                                                <div class="flip-card-front">
                                                                                                    <img src="https://uploads-ssl.webflow.com/5fa957c69b35ede836972252/611d001d17143ca40a55ca11_VAT%20card%20design.png" alt="Avatar" style="width:300px;height:200px;">
                                                                                                </div>
                                                                                                <div class="flip-card-back">
                                                                                                    <img src="https://i.colnect.net/f/1261/793/Diplomat-Card.jpg" alt="" style="width:300px;height:200px;">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-03">
                                                                            <button class="accordion-button collapsed border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-03" aria-expanded="false" aria-controls="collapse-03">
                                                                                Photographs
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-03" class="accordion-collapse collapse" aria-labelledby="heading-3" data-bs-parent="#accordionExample2">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col">
                                                                                        <h5>Three recent photographs</h5>
                                                                                        <hr>
                                                                                        <ul>
                                                                                            <li>Color Photos</li>
                                                                                            <br>
                                                                                            <li>White Background</li> <br>
                                                                                            <li>Standard format: 35 mm x 45 mm (width x height).</li>
                                                                                        </ul>

                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <img src="https://www.netherlandsworldwide.nl/binaries/content/gallery/p1o/afbeeldingen/fotomatrix2020-positionering.png" alt="" width="100%">
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-04">
                                                                            <button class="accordion-button collapsed border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-04" aria-expanded="false" aria-controls="collapse-04">
                                                                                Request Letter
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-04" class="accordion-collapse collapse" aria-labelledby="heading-4" data-bs-parent="#accordionExample2">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col">
                                                                                        <p>Letter by Consul General</p>
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <img src="https://cdn3.iconfinder.com/data/icons/basic-regular-2/64/85-1024.png" alt="" width="50%">
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

                                                                <!-- LIST GROUP END ================   -->
                                                            </div>





                                                        </div>
                                                        <!-- AEP FOR STAFF START=================== -->
                                                        <div class="tab-pane" role="tabpanel" id="staff">
                                                            <h3> For Staff </h3>
                                                            <p> The AEP (Airport Entry Passes) for staff are issued every year on the submission of following documents to Ministry of Foreign Affairs – Government of Pakistan, Camp Office – Karachi. (05 sets of all below documents) </p>
                                                            <div class="container">
                                                                <H4>Requirements</H4>
                                                                <div class="accordion" id="accordionExample3">
                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-01">
                                                                            <hr>
                                                                            <button class="accordion-button border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-01" aria-expanded="true" aria-controls="collapse-01">
                                                                                MOFA Form
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-01" class="accordion-collapse collapse show" aria-labelledby="heading-01" data-bs-parent="#accordionExample3">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col">
                                                                                        The prescribed standard form for AEP. <br>
                                                                                        (Available in MOFA Camp Office)
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <img src="https://cdn3.iconfinder.com/data/icons/basic-regular-2/64/85-1024.png" alt="" width="50%">
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-02">
                                                                            <button class="accordion-button collapsed border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-02" aria-expanded="false" aria-controls="collapse-02">
                                                                                Aviation Division Form
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-02" class="accordion-collapse collapse" aria-labelledby="heading-2" data-bs-parent="#accordionExample3">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col">
                                                                                        The prescribed standard form of Aviation Division – Cabinet Division for AEP (Available in MOFA Camp Office)
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <img src="https://cdn3.iconfinder.com/data/icons/basic-regular-2/64/85-1024.png" alt="" width="50%">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-03">
                                                                            <button class="accordion-button collapsed border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-03" aria-expanded="false" aria-controls="collapse-03">
                                                                                Vetting Performa
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-03" class="accordion-collapse collapse" aria-labelledby="heading-3" data-bs-parent="#accordionExample3">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col">
                                                                                        <p>Three (03) sets of security vetting Performa for the security clearance by IB (Intelligence Bureau) of Pakistan. (Available in MOFA Camp Office)</p>

                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <img src="https://cdn3.iconfinder.com/data/icons/basic-regular-2/64/85-1024.png" alt="" width="50%">
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-04">
                                                                            <button class="accordion-button collapsed border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-04" aria-expanded="false" aria-controls="collapse-04">
                                                                                Service ID Card
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-04" class="accordion-collapse collapse" aria-labelledby="heading-4" data-bs-parent="#accordionExample3">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col">
                                                                                        <p>Photocopies of service Identity card issued by the Consulate General of UAE – Karachi</p>
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <div class="flip-card">
                                                                                            <div class="flip-card-inner">
                                                                                                <div class="flip-card-front">
                                                                                                    <img src="https://mswordidcards.com/wp-content/uploads/2017/10/Staff-ID-Card-7-CRC.jpg" alt="Avatar" style="width:300px;height:200px;">
                                                                                                </div>
                                                                                                <div class="flip-card-back">
                                                                                                    <img src="https://www.otago.ac.nz/cs/groups/public/@studentservices/documents/contributorimg/otago835862.jpg" alt="" style="width:300px;height:200px;">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-05">
                                                                            <button class="accordion-button collapsed border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-05" aria-expanded="false" aria-controls="collapse-05">
                                                                                Security Clearance
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-05" class="accordion-collapse collapse" aria-labelledby="heading-5" data-bs-parent="#accordionExample3">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col">
                                                                                        <p>Security Clearance by Special Branch – Sindh Police (Available from Special Branch – Sindh Police)</p>

                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <img src="https://cdn3.iconfinder.com/data/icons/basic-regular-2/64/85-1024.png" alt="" width="50%">
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-06">
                                                                            <button class="accordion-button collapsed border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-06" aria-expanded="false" aria-controls="collapse-06">
                                                                                CNIC & Passport Copy
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-06" class="accordion-collapse collapse" aria-labelledby="heading-6" data-bs-parent="#accordionExample3">
                                                                            <div class="accordion-body">
                                                                                <p>Photocopies of valid CNIC (Computerised National Identity Card) and Passport</p>
                                                                                <div class="row d-flex align-items-center">

                                                                                    <div class="col">
                                                                                        <img src="https://id.nadra.gov.pk/wp-content/uploads/2021/09/nicop_image-1.png" alt="" width="100%">
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/cf/Pakistan_Passport_Biodata_Page.jpg/380px-Pakistan_Passport_Biodata_Page.jpg" alt="" width="50%">
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-07">
                                                                            <button class="accordion-button collapsed border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-07" aria-expanded="false" aria-controls="collapse-07">
                                                                                Photographs
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-07" class="accordion-collapse collapse" aria-labelledby="heading-7" data-bs-parent="#accordionExample3">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col">
                                                                                        <h5>Ten (10) recent photographs</h5>
                                                                                        <hr>
                                                                                        <ul>
                                                                                            <li>Color Photos</li>
                                                                                            <br>
                                                                                            <li>White Background</li> <br>
                                                                                            <li>Standard format: 35 mm x 45 mm (width x height).</li>
                                                                                        </ul>

                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <img src="https://www.netherlandsworldwide.nl/binaries/content/gallery/p1o/afbeeldingen/fotomatrix2020-positionering.png" alt="" width="100%">
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-08">
                                                                            <button class="accordion-button collapsed border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-08" aria-expanded="false" aria-controls="collapse-08">
                                                                                Request Letter
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-08" class="accordion-collapse collapse" aria-labelledby="heading-8" data-bs-parent="#accordionExample3">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col">
                                                                                        <p>Letter by Consul General</p>
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <img src="https://cdn3.iconfinder.com/data/icons/basic-regular-2/64/85-1024.png" alt="" width="50%">
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>




                                                                </div>

                                                                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

                                                                <!-- LIST GROUP END ================   -->
                                                            </div>
                                                        </div>
                                                        <!-- AEP FOR STAFF END=================== -->

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ===================END AIRPORT ENTRY PASS 1 YEAR VALIDITY DIPLOMATS============== -->

                                <!-- ===================START AIRPORT ENTRY PASS 1 YEAR VALIDITY STAFF============== -->

                                <div class="modal fade bd-example-modal-aep" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <div class="card-header text-right" id="headingOne">
                                                <div class="modal-header d-flex justify-content-between">
                                                    <h3 class="modal-title" id="exampleModalLabel">Airport Entry Pass (1 Year Validity)</h3>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container">
                                                    <a href="https://getbootstrap.com/docs/4.0/components/navs/#tabs" target="_blank">

                                                    </a>
                                                    <div>
                                                        <ul class="nav nav-tabs d-flex justify-content-around" role="tablist">
                                                            <li class="nav-item">
                                                                <a href="#diplomats" role="tab" data-toggle="tab" class="nav-link active">
                                                                    <h4>Diplomats</h4>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="#staff" role="tab" data-toggle="tab" class="nav-link">
                                                                    <h4>Staff</h4>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <div class="tab-content">

                                                        <div class="tab-pane active" role="tabpanel" id="diplomats">
                                                            <h3> For Diplomats </h3>
                                                            <p> The AEP (Airport Entry Passes) for diplomats are issued every year on the submission of following documents to Ministry of Foreign Affairs – Government of Pakistan, Camp Office – Karachi. </p>
                                                            <hr>

                                                            <div class="container">
                                                                <H4>Requirements</H4>
                                                                <div class="accordion" id="accordionExample2">
                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-01">
                                                                            <hr>
                                                                            <button class="accordion-button border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-01" aria-expanded="true" aria-controls="collapse-01">
                                                                                MOFA Form
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-01" class="accordion-collapse collapse show" aria-labelledby="heading-01" data-bs-parent="#accordionExample2">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col">
                                                                                        The prescribed standard form for AEP. <br>
                                                                                        (Available in MOFA Camp Office)
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <img src="https://cdn3.iconfinder.com/data/icons/basic-regular-2/64/85-1024.png" alt="" width="50%">
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-02">
                                                                            <button class="accordion-button collapsed border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-02" aria-expanded="false" aria-controls="collapse-02">
                                                                                Diplomatic ID Card
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-02" class="accordion-collapse collapse" aria-labelledby="heading-2" data-bs-parent="#accordionExample2">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col">
                                                                                        Photocopy of Diplomatic ID Card
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <div class="flip-card">
                                                                                            <div class="flip-card-inner">
                                                                                                <div class="flip-card-front">
                                                                                                    <img src="https://uploads-ssl.webflow.com/5fa957c69b35ede836972252/611d001d17143ca40a55ca11_VAT%20card%20design.png" alt="Avatar" style="width:300px;height:200px;">
                                                                                                </div>
                                                                                                <div class="flip-card-back">
                                                                                                    <img src="https://i.colnect.net/f/1261/793/Diplomat-Card.jpg" alt="" style="width:300px;height:200px;">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-03">
                                                                            <button class="accordion-button collapsed border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-03" aria-expanded="false" aria-controls="collapse-03">
                                                                                Photographs
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-03" class="accordion-collapse collapse" aria-labelledby="heading-3" data-bs-parent="#accordionExample2">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col">
                                                                                        <h5>Three recent photographs</h5>
                                                                                        <hr>
                                                                                        <ul>
                                                                                            <li>Color Photos</li>
                                                                                            <br>
                                                                                            <li>White Background</li> <br>
                                                                                            <li>Standard format: 35 mm x 45 mm (width x height).</li>
                                                                                        </ul>

                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <img src="https://www.netherlandsworldwide.nl/binaries/content/gallery/p1o/afbeeldingen/fotomatrix2020-positionering.png" alt="" width="100%">
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-04">
                                                                            <button class="accordion-button collapsed border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-04" aria-expanded="false" aria-controls="collapse-04">
                                                                                Request Letter
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-04" class="accordion-collapse collapse" aria-labelledby="heading-4" data-bs-parent="#accordionExample2">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col">
                                                                                        <p>Letter by Consul General</p>
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <img src="https://cdn3.iconfinder.com/data/icons/basic-regular-2/64/85-1024.png" alt="" width="50%">
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

                                                                <!-- LIST GROUP END ================   -->
                                                            </div>





                                                        </div>
                                                        <!-- AEP FOR STAFF START=================== -->
                                                        <div class="tab-pane" role="tabpanel" id="staff">
                                                            <h3> For Staff </h3>
                                                            <p> The AEP (Airport Entry Passes) for staff are issued every year on the submission of following documents to Ministry of Foreign Affairs – Government of Pakistan, Camp Office – Karachi. (05 sets of all below documents) </p>
                                                            <div class="container">
                                                                <H4>Requirements</H4>
                                                                <div class="accordion" id="accordionExample3">
                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-01">
                                                                            <hr>
                                                                            <button class="accordion-button border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-01" aria-expanded="true" aria-controls="collapse-01">
                                                                                MOFA Form
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-01" class="accordion-collapse collapse show" aria-labelledby="heading-01" data-bs-parent="#accordionExample3">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col">
                                                                                        The prescribed standard form for AEP. <br>
                                                                                        (Available in MOFA Camp Office)
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <img src="https://cdn3.iconfinder.com/data/icons/basic-regular-2/64/85-1024.png" alt="" width="50%">
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-02">
                                                                            <button class="accordion-button collapsed border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-02" aria-expanded="false" aria-controls="collapse-02">
                                                                                Aviation Division Form
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-02" class="accordion-collapse collapse" aria-labelledby="heading-2" data-bs-parent="#accordionExample3">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col">
                                                                                        The prescribed standard form of Aviation Division – Cabinet Division for AEP (Available in MOFA Camp Office)
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <img src="https://cdn3.iconfinder.com/data/icons/basic-regular-2/64/85-1024.png" alt="" width="50%">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-03">
                                                                            <button class="accordion-button collapsed border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-03" aria-expanded="false" aria-controls="collapse-03">
                                                                                Vetting Performa
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-03" class="accordion-collapse collapse" aria-labelledby="heading-3" data-bs-parent="#accordionExample3">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col">
                                                                                        <p>Three (03) sets of security vetting Performa for the security clearance by IB (Intelligence Bureau) of Pakistan. (Available in MOFA Camp Office)</p>

                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <img src="https://cdn3.iconfinder.com/data/icons/basic-regular-2/64/85-1024.png" alt="" width="50%">
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-04">
                                                                            <button class="accordion-button collapsed border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-04" aria-expanded="false" aria-controls="collapse-04">
                                                                                Service ID Card
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-04" class="accordion-collapse collapse" aria-labelledby="heading-4" data-bs-parent="#accordionExample3">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col">
                                                                                        <p>Photocopies of service Identity card issued by the Consulate General of UAE – Karachi</p>
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <div class="flip-card">
                                                                                            <div class="flip-card-inner">
                                                                                                <div class="flip-card-front">
                                                                                                    <img src="https://mswordidcards.com/wp-content/uploads/2017/10/Staff-ID-Card-7-CRC.jpg" alt="Avatar" style="width:300px;height:200px;">
                                                                                                </div>
                                                                                                <div class="flip-card-back">
                                                                                                    <img src="https://www.otago.ac.nz/cs/groups/public/@studentservices/documents/contributorimg/otago835862.jpg" alt="" style="width:300px;height:200px;">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-05">
                                                                            <button class="accordion-button collapsed border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-05" aria-expanded="false" aria-controls="collapse-05">
                                                                                Security Clearance
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-05" class="accordion-collapse collapse" aria-labelledby="heading-5" data-bs-parent="#accordionExample3">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col">
                                                                                        <p>Security Clearance by Special Branch – Sindh Police (Available from Special Branch – Sindh Police)</p>

                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <img src="https://cdn3.iconfinder.com/data/icons/basic-regular-2/64/85-1024.png" alt="" width="50%">
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-06">
                                                                            <button class="accordion-button collapsed border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-06" aria-expanded="false" aria-controls="collapse-06">
                                                                                CNIC & Passport Copy
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-06" class="accordion-collapse collapse" aria-labelledby="heading-6" data-bs-parent="#accordionExample3">
                                                                            <div class="accordion-body">
                                                                                <p>Photocopies of valid CNIC (Computerised National Identity Card) and Passport</p>
                                                                                <div class="row d-flex align-items-center">

                                                                                    <div class="col">
                                                                                        <img src="https://id.nadra.gov.pk/wp-content/uploads/2021/09/nicop_image-1.png" alt="" width="100%">
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/cf/Pakistan_Passport_Biodata_Page.jpg/380px-Pakistan_Passport_Biodata_Page.jpg" alt="" width="50%">
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-07">
                                                                            <button class="accordion-button collapsed border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-07" aria-expanded="false" aria-controls="collapse-07">
                                                                                Photographs
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-07" class="accordion-collapse collapse" aria-labelledby="heading-7" data-bs-parent="#accordionExample3">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col">
                                                                                        <h5>Ten (10) recent photographs</h5>
                                                                                        <hr>
                                                                                        <ul>
                                                                                            <li>Color Photos</li>
                                                                                            <br>
                                                                                            <li>White Background</li> <br>
                                                                                            <li>Standard format: 35 mm x 45 mm (width x height).</li>
                                                                                        </ul>

                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <img src="https://www.netherlandsworldwide.nl/binaries/content/gallery/p1o/afbeeldingen/fotomatrix2020-positionering.png" alt="" width="100%">
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-08">
                                                                            <button class="accordion-button collapsed border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-08" aria-expanded="false" aria-controls="collapse-08">
                                                                                Request Letter
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-08" class="accordion-collapse collapse" aria-labelledby="heading-8" data-bs-parent="#accordionExample3">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col">
                                                                                        <p>Letter by Consul General</p>
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <img src="https://cdn3.iconfinder.com/data/icons/basic-regular-2/64/85-1024.png" alt="" width="50%">
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>




                                                                </div>

                                                                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

                                                                <!-- LIST GROUP END ================   -->
                                                            </div>
                                                        </div>
                                                        <!-- AEP FOR STAFF END=================== -->

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ===================END AIRPORT ENTRY PASS 1 YEAR VALIDITY STAFF============== -->

                                <!-- ===================DIPLOMATIC CARGO CLEARANCE START============== -->

                                <div class="modal fade bd-example-modal-cargo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bottom-border p-1 ">
                                                <h3 class="modal-title modal-heading text-black" id="exampleModalLabel"><strong>Diplomatic Cargo Clearance</strong></h3>
                                                <button type="button" class="close little-modalclose-btn p-1 px-2" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                                </button>
                                                </div>
                                            <div class="modal-body">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h3></h3>
<img src="https://cdn-dfhie.nitrocdn.com/oPsTPqRCPGgSMfLuFJisKjZurNcFHHYO/assets/images/optimized/rev-5f728a2/customscity.com/wp-content/uploads/2023/05/Streamlining-the-Customs-Clearance-Process-with-Automated-Software-Solutions_1.webp" alt="" width="100%">
                                                            <div class="tabbable-panel">
                                                                <div class="tabbable-line">
                                                                    <ul class="nav nav-tabs d-flex justify-content-between">
                                                                        <li class="active">
                                                                            <a href="#tab_default_1" data-toggle="tab" class="px-4 py-2 bg-light border border-primary font-weight-bold">
                                                                                Letter 1 </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="#tab_default_2" data-toggle="tab" class="px-4 py-2 bg-light border border-primary font-weight-bold">
                                                                                Letter 2 </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="#tab_default_3" data-toggle="tab" class="px-4 py-2 bg-light border border-primary font-weight-bold">
                                                                                Letter 3 </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="#tab_default_4" data-toggle="tab" class="px-4 py-2 bg-light border border-primary font-weight-bold">
                                                                                Letter 4 </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="#tab_default_5" data-toggle="tab" class="px-4 py-2 bg-light border border-primary font-weight-bold">
                                                                                Letter 5 </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="#tab_default_6" data-toggle="tab" class="px-4 py-2 bg-light border border-primary font-weight-bold">
                                                                                Letter 6 </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="#tab_default_7" data-toggle="tab" class="px-4 py-2 bg-light border border-primary font-weight-bold">
                                                                                Letter 7 </a>
                                                                        </li>
                                                                    </ul>
                                                                    <hr>
                                                                    <div class="tab-content">
                                                                        <div class="tab-pane active" id="tab_default_1">
                                                                            <h5 class="font-weight-bold">
                                                                                Letter of Request to Embassy
                                                                            </h5>
                                                                            <p>
                                                                                For issuance of Exemption Letter to waive all kinds of customs duties and tariffs on diplomatic cargo / shipment.
                                                                            </p>
                                                                            <div>

                                                                                <textarea name="" id="textarea" cols="95" rows="25">
Ref: 1/6/21-104 
Date: April 29th, 2023

The Ambassador,
Embassy of the United Arab Emirates, 
Islamabad.


Subject: Exemption Certificate of Diplomatic Cargo AWB # 607-26214425-.

The Consulate General of U.A.E in Karachi presents its compliments to the Embassy of the United Arab Emirates, Islamabad and has the honour to inform that a diplomatic shipment containing diplomatic cargo having AWB # 607-26214425 belonging to the Consulate General of U.A. E in Karachi.
The Consulate General of U.A.E ni Karachi would appreciate it much if the esteemed Embassy may get the requisite Exemption Certificate of the above mentioned diplomatic mail from the concerned authorities of Government of Pakistan

The Consulate General of U.A.E in Karachi avails itself of this opportunity to renew to the esteemed Embassy of the United Arab Emirates, Islamabad the assurances of its highest Consideration. 



Consulate General of UAE Karachi
                                                                                </textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="tab-pane" id="tab_default_2" class="px-2 py-2 bg-light">
                                                                            <h5 class="font-weight-bold">
                                                                                Hiring Custom Clearing Agent
                                                                            </h5>
                                                                            <p>
                                                                                Hiring Customs Clearing Agent duly licensed and issued Chalan no number by Pakistan Customs, to file electronic GD (Goods Declaration) on WEBOC (Web Based One Customs) and other relevant formalities in order to release cargo / shipment.
                                                                            </p>
                                                                            <div>

                                                                                <textarea name="" id="textarea" cols="95" rows="25">
Ref: 1/6/21-109
Date: April 29th, 2023

The Manager Cargo 
Etihad Airways,
AFU - Air Cargo Complex 
Karachi.

Subject: Release of Diplomatic Cargo

The Consulate General of UAE- Karachi presents its compliments to Manager Etihad Airways, Karachi and has the honor to inform that a consignment of diplomatic cargo having Airway Bil No: 607-26214425 containing diplomatic cargo belonging to The Consulate General of UAE in Karachi has arrived through Etihad Airways EY221.

We hereby authorize M/S Fair Trade International, clearing and forwarding Agent having Challan Number -2064, to collect the Delivery Order &other documents, complete al the customs and other formalities on our behalf for the consignment of diplomatic cargo having Airway Bil No: 607-26214425, containing computers and its accessories for the official usage of The Consulate General of UAE ni Karachi arrived by Etihad Airline Flight No: EY21 on 29th April 2023.

The Consulate General of UAE - Karachi avails itself of this opportunity to renew to the esteemed Manager Cargo Etihad Airways assurances of its highest considerations.



Consulate General of UAE - Karachi
    </textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="tab-pane" id="tab_default_3">
                                                                            <h5 class="font-weight-bold">
                                                                                Authorization Letter
                                                                            </h5>
                                                                            <p>
                                                                                Authorisation Letter (To Whom It May Concern) for hired Customs Clearing Agent issued by the Consulate General of UAE – Karachi to deal authentically and effectively for the smooth release of cargo.
                                                                            </p>
                                                                            <div>

                                                                                <textarea name="" id="" cols="95" rows="25">
Ref: 1/6/21- 107 
Date: 29th April, 2023


                                              TO WHOM IT MAY CONCERN


We hereby authorize M/S Fair Trade International, clearing and forwarding Agent having Challan Number - 2064, to collect the Delivery Order & other documents, complete al the customs and other formalities on our behalf for the consignment of Diplomatic Cargo having Airway Bil No: 607-26214425, containing computers and accessories for the official usage of

The Consulate General of UAE ni Karachi arrived by Etihad Airline Flight No, EY21 on 29th April 2023.

Thanking you.


Consulate General of UÁE - Karachi
    </textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="tab-pane" id="tab_default_4">
                                                                            <h5 class="font-weight-bold">
                                                                                Letter to DC Customs
                                                                            </h5>
                                                                            <p>
                                                                                Letter to D.C (Deputy Collector) Pakistan Customs (Import) for the release of Diplomatic Consignment along-with AWB (Airway Bill) issued by concerned Airline or BL (Bill of Lading) by concerned Shipping Line.
                                                                            </p>
                                                                            <div>

                                                                                <textarea name="" id="" cols="95" rows="25">
Ref: 1/6/21-103 
Date: April 29th, 2023

Deputy / Assistant Collector 
AFU/ICG, Customs,
J.I.A.P., Karachi.

Dear Sir,

It is certified that the goods where of given hereunder are the bonafide property of the Consulate General of UAE in Karachi and are not for sale.

DESCRIPTION OF GOODS 

Number of pieces and weight         :           Two (02) piece of chargeable weight 142.00Kgs
Description of Goods                       :            Diplomatic Cargo
Airway Bil No                                    :            607-26214425
Arrived Through                                :           By Air Etihad EY-221
Exemption Certificate/ Chapter     :           ---------------
 
Necessary facilitation may please be accorded to them.



Consulate General of UAE - Karachi
    </textarea>
                                                                            </div>
                                                                            <div>

                                                                                <textarea name="" id="" cols="95" rows="25">
Ref:1/6/21-102
Date: April 29th, 2023

Deputy / Assistant Collector 
AFU/ICG, Customs,
JI.A.P., Karachi.

Subject: Prior Release of Diplomatic Cargo under airway bill No: 607-26214425

The Consulate General of UAE - Karachi presents its compliments to Pakistan Customs, JAP, Karachi and has the honor to inform that a diplomatic Cargo having A.W.B No: 607-26214425, belonging to the Consulate General of UAE in Karachi has arrived through Etihad Airline flight No, EY221.

We hereby undertake to assure that this diplomatic consignment does not contain any kind of narcotics, explosives, ammunition or contraband item or any literature against Pakistan.

Since ti is for our official use, therefore it is requested to kindly allow the release of above mentioned on urgent basis. The exemption certificate issued by Ministry of Foreign Affairs, Pakistan will be provided within a week.

We hereby authorize M/S Fair Trade International, clearing and forwarding Agent having Challan Number -2064, to collect the Detention Receipt (D.R.) complete al the customs and other formalities on our behalf.

The Consulate General of UAE - Karachi avails itself of this opportunity to renew to the esteemed Pakistan Customs, JAP, Karachi the assurances of its highest considerations.


Consulate General of UAE - Karachi
    </textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="tab-pane" id="tab_default_5">
                                                                            <h5 class="font-weight-bold">
                                                                                Letter to Cargo Manager / Airline
                                                                            </h5>
                                                                            <p>
                                                                                Letter to the Manager (Cargo) of concerned Airline / Shipping Line to issue D.O (Delivery Order) to hired Customs Clearing Agent.
                                                                            </p>
                                                                            <div>

                                                                                <textarea name="" id="" cols="95" rows="25">
Ref: 1/6/21-108
Date: April 29th, 2023

The Manager Cargo 
Etihad Airways,
AFU - Air Cargo Complex 
Karachi.

Subject: Release of Diplomatic Cargo

The Consulate General of UAE - Karachi presents its compliments to Manager Etihad Airways, Karachi and has the honor to inform that a consignment of diplomatic cargo having Airway Bil No: 607-26214425 containing diplomatic cargo belonging to The Consulate General of UAE in Karachi has arrived through Etihad Airways EY221.

We hereby authorize M/S Fair Trade International, clearing and forwarding Agent having Challan Number -2064, to collect the Delivery Order & other documents, complete al the customs and other formalities on our behalf for the consignment of diplomatic cargo having Airway Bil No: 607-26214425, containing computers and its accessories for the official usage of The Consulate General of UAE ni Karachi arrived by Etihad Airline Flight No: EY221 on 29th April 2023.

The Consulate General of UAE - Karachi avails itself of this opportunity to renew to the esteemed Manager Cargo Etihad Airways assurances of its highest considerations.


Consulate General of UAE Karachi
    </textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="tab-pane" id="tab_default_6">
                                                                            <p>
                                                                                Letter to ETO (Excise & Taxation Officer)
                                                                            </p>
                                                                            <p>
                                                                                Letter to ETO (Excise & Taxation Officer) from Department of Sindh Excise & Taxation – Government of Sindh deployed at concerned airport / seaport for the waiver of provincial excise duties.
                                                                            </p>
                                                                            <div>

                                                                                <textarea name="" id="" cols="95" rows="25">
Ref: 1/6/21-106 
Date: April 29th, 2023

Excise & Taxation Officer 
Excise &Taxation Department,
Government of Sindh, JIAP, 
Karachi

Dear Sir,

It is certified that the goods where of given hereunder are the bonafide property of the Consulate General of UAE in Karachi and are not for sale.

DESCRIPTION OF GOODS 

Number of pieces and weight         :           Two (02) piece of chargeable weight 142.00Kgs
Description of Goods                       :            Diplomatic Cargo
Airway Bil No                                    :            607-26214425
Arrived Through                                :           By Air Etihad EY-221
Exemption Certificate/ Chapter     :           ---------------
 
Necessary facilitation may please be accorded to them.



Consulate General of UAE - Karachi
    </textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="tab-pane" id="tab_default_7">
                                                                            <p>
                                                                                Letter to Cargo Manager (Import / CAA)
                                                                            </p>
                                                                            <p>
                                                                                Letter to Cargo Manager (Import) from CAA (Civil Aviation Authority) of concerned airport or T.M (Terminal Manager) of concerned seaport authority like KPT (Karachi Port Authority) or PQA (Port Qasim Authority) in Karachi.
                                                                            </p>
                                                                            <div>

                                                                                <textarea name="" id="textarea" cols="95" rows="25">
Ref: 1/6/21-105 
Date: April 29th, 2023

Incharge
Civil Aviation Authority of Pakistan 
AFU/ICG
Air Cargo Complex 
JIAP - Karachi

Dear Sir,

It is certified that the goods where of given hereunder are the bonafide property of the Consulate General of UAE in Karachi and are not for sale.

DESCRIPTION OF GOODS 

Number of pieces and weight         :           Two (02) piece of chargeable weight 142.00Kgs
Description of Goods                       :            Diplomatic Cargo
Airway Bil No                                    :            607-26214425
Arrived Through                                :           By Air Etihad EY-221
Exemption Certificate/ Chapter     :           ---------------
 
Necessary facilitation may please be accorded to them.


Consulate General of UAE - Karachi
    </textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ===================DIPLOMATIC CARGO CLEARANCE END============== -->

                                <!-- ===================CERTIFICATES START============== -->

                                <div class="modal fade bd-example-modal-cert" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            {{-- <div class="card-header text-right" id="headingOne">
                                                <div class="modal-header d-flex justify-content-between">
                                                    <h3 class="modal-title" id="exampleModalLabel">Otaining Your Certificate</h3>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div> --}}
                                            <div class="modal-header bottom-border p-1 ">
                                                <h3 class="modal-title modal-heading text-black" id="exampleModalLabel"><strong>Otaining Your Certificate</strong></h3>
                                                <button type="button" class="close little-modalclose-btn p-1 px-2" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                                </button>
                                                </div>
                                            <div class="modal-body">
                                                <div class="container">
                                                    <a href="https://getbootstrap.com/docs/4.0/components/navs/#tabs" target="_blank">

                                                    </a>
                                                    <div>
                                                        <p>Steps and Procedure for Obtaining Your Certificate</p>
                                                    </div>
                                                    <div>
                                                        <ul class="nav nav-tabs d-flex justify-content-around" role="tablist">
                                                            <li class="nav-item">
                                                                <a href="#birth" role="tab" data-toggle="tab" class="nav-link active">
                                                                    <h6>Birth Certificate</h6>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="#death" role="tab" data-toggle="tab" class="nav-link">
                                                                    <h6>Death Certificate</h6>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="#others" role="tab" data-toggle="tab" class="nav-link">
                                                                    <h6>Other Certificate</h6>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <div class="tab-content">

                                                        <div class="tab-pane active" role="tabpanel" id="birth">
                                                            <h3> For Birth Certificate </h3>
                                                            <p> Specific procedures and requirements may vary depending on the Embassy or Consulate of the UAE in Pakistan. Therefore, it's essential to contact the nearest UAE embassy or consulate in Pakistan for the most up-to-date information. Here are the general steps to obtain a birth certificate: </p>
                                                            <hr>

                                                            <div class="container">
                                                                <H4>Requirements</H4>
                                                                <div class="accordion" id="accordionbirth">
                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-01">
                                                                            <hr>
                                                                            <button class="accordion-button border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-01" aria-expanded="true" aria-controls="collapse-01">
                                                                                Contact the UAE Embassy or Consulate in Pakistan
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-01" class="accordion-collapse collapse" aria-labelledby="heading-01" data-bs-parent="#accordionbirth">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div>
                                                                                        <p>Start by contacting the nearest UAE diplomatic mission in Pakistan. They will provide you with the necessary information and guidance on the required documents and procedures.</p>
                                                                                    </div>
                                                                                    <div>
                                                                                        <iframe src="https://www.google.com/maps/d/u/3/embed?mid=1W5KA2WIVRI0k0Wpd4MedVU_TuQ6u6q8&ehbc" width="700" height="400"></iframe>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-02">
                                                                            <button class="accordion-button collapsed border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-02" aria-expanded="false" aria-controls="collapse-02">
                                                                                Proof of Citizenship
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-02" class="accordion-collapse collapse" aria-labelledby="heading-2" data-bs-parent="#accordionbirth">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col">
                                                                                        You will need to provide proof of UAE citizenship, which could be the UAE passport of the individual or the parents' passports if the child was born to UAE citizen parents.
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <div class="flip-card">
                                                                                            <div class="flip-card-inner">
                                                                                                <div class="flip-card-front">
                                                                                                    <img src="https://blog.skyloov.com/wp-content/uploads/2022/01/eida-1.png" alt="Avatar" style="width:300px;height:200px;">
                                                                                                </div>
                                                                                                <div class="flip-card-back">
                                                                                                    <img src="https://imgcdn.pakistanpoint.com/media/2018/12/_3/730x425/pic_1543838075.jpg" alt="" style="width:300px;height:200px;">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-03">
                                                                            <button class="accordion-button collapsed border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-03" aria-expanded="false" aria-controls="collapse-03">
                                                                                Birth Registration Application
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-03" class="accordion-collapse collapse" aria-labelledby="heading-3" data-bs-parent="#accordionbirth">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col">
                                                                                        <h5>Obtain the birth registration application form from the UAE embassy or consulate in Pakistan. Fill out the form with accurate information.</h5>

                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <img src="https://i.pinimg.com/originals/7b/0c/5c/7b0c5c3fc0baf9c22ff065d1865f3117.gif" alt="" width="100%">
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-04">
                                                                            <button class="accordion-button collapsed border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-04" aria-expanded="false" aria-controls="collapse-04">
                                                                                Documentation
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-04" class="accordion-collapse collapse" aria-labelledby="heading-4" data-bs-parent="#accordionbirth">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col">
                                                                                        <p>Gather all the required documents, which may include:
                                                                                        <ul>
                                                                                            <li>Original and copies of the child's birth certificate issued by the Pakistani authorities.</li>
                                                                                            <li>The parents' passports.</li>
                                                                                            <li>UAE national ID cards of the parents.</li>
                                                                                            <li>Marriage certificate of the parents (if applicable).</li>
                                                                                            <li>Other relevant documents as requested by the embassy/consulate.</li>
                                                                                        </ul>

                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <img src="https://cdn3.iconfinder.com/data/icons/basic-regular-2/64/85-1024.png" alt="" width="50%">
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-05">
                                                                            <button class="accordion-button collapsed border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-05" aria-expanded="false" aria-controls="collapse-05">
                                                                                Translations and Attestations
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-05" class="accordion-collapse collapse" aria-labelledby="heading-3" data-bs-parent="#accordionbirth">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div>
                                                                                        <h5>If any of the documents are in a language other than Arabic or English, they may need to be translated and authenticated.</h5>

                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <img src="https://24x7offshoring.com/wp-content/uploads/2022/10/translation-24x7offshoring.gif" alt="" width="100%">
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <img src="https://fiverr-res.cloudinary.com/images/q_auto,f_auto/gigs/97955178/original/07163e8bdbd78d0d7d50a95d8d849f7faa662cc4/translate-english-or-spanish-to-arabic.jpg" alt="" width="50%">
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-06">
                                                                            <button class="accordion-button border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-06" aria-expanded="true" aria-controls="collapse-06">
                                                                                Submission of Documents
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-06" class="accordion-collapse collapse" aria-labelledby="heading-06" data-bs-parent="#accordionbirth">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col-6">
                                                                                        <p>Submit the completed application form and all supporting documents to the UAE embassy or consulate in Pakistan. The staff will review your application, and if everything is in order, they will process the birth certificate.</p>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <img src="https://i.pinimg.com/originals/0c/c6/b8/0cc6b8b086ba0f9b40759f955ca532a5.gif" alt="" width="100%">
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-07">
                                                                            <button class="accordion-button border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-07" aria-expanded="true" aria-controls="collapse-07">
                                                                                Fees
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-07" class="accordion-collapse collapse" aria-labelledby="heading-07" data-bs-parent="#accordionbirth">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col-6">
                                                                                        <p>There may be fees associated with obtaining the birth certificate. Inquire about the applicable fees during the application process.</p>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <table>
                                                                                            <thead class="thead-light border bg-light">
                                                                                                <th class="col-1 border">#</th>
                                                                                                <th class="col-6 border">Mission</th>
                                                                                                <th class="col-5 border">Fee</th>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <th class="border" scope="row">1</th>
                                                                                                    <td class="border">Islamabad Embassy</td>
                                                                                                    <td class="border">Call for info</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th class="border bg-light" scope="row">2</th>
                                                                                                    <td class="border bg-light">Karachi Consulate</td>
                                                                                                    <td class="border bg-light">Call for info</td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-08">
                                                                            <button class="accordion-button border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-08" aria-expanded="true" aria-controls="collapse-08">
                                                                                Processing Time
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-08" class="accordion-collapse collapse" aria-labelledby="heading-08" data-bs-parent="#accordionbirth">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col-6">
                                                                                        <p>The processing time for obtaining the birth certificate may vary, so it's best to ask the embassy or consulate about the expected timeline.</p>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <img src="https://community.adobe.com/legacyfs/online/1653051_clock%20-%20.01.gif" alt="" width="100%">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-09">
                                                                            <button class="accordion-button border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-09" aria-expanded="true" aria-controls="collapse-09">
                                                                                Collecting the Birth Certificate
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-09" class="accordion-collapse collapse" aria-labelledby="heading-09" data-bs-parent="#accordionbirth">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col-6">
                                                                                        <p>Once the birth certificate is ready, you will be notified to collect it from the UAE embassy or consulate in Pakistan. Make sure to bring any receipt or acknowledgment provided during the application submission.</p>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <img src="https://i.gifer.com/VfUI.webp" alt="" width="100%">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
                                                            </div>
                                                        </div>
                                                        <!-- AEP FOR STAFF START=================== -->
                                                        <div class="tab-pane" role="tabpanel" id="death">
                                                            <h3> For Death Certificate </h3>
                                                            <p> To obtain the death certificate of a UAE national who passed away in Pakistan, you may typically follow these steps: </p>
                                                            <div class="container">
                                                                <H4>Steps to Follow;</H4>
                                                                <div>
                                                                    <ul>
                                                                        <li> <strong>Inform the local authorities:</strong> Report the death to the nearest police station or relevant authorities in Pakistan.</li>
                                                                        <li> <strong>Obtain the medical certificate:</strong> Request a death certificate from the hospital or doctor where the death occurred. This certificate should state the cause of death.</li>
                                                                        <li><strong>Register the death:</strong> Register the death at the relevant Registrar of Deaths office in Pakistan. This is usually located at the city or district level.</li>
                                                                        <li><strong>Provide necessary documents:</strong> You may need to submit documents such as the deceased person's passport, Emirates ID (if available), and other identification documents.</li>
                                                                        <li><strong>Embassy/Consulate involvement:</strong> Contact the UAE Embassy or Consulate in Pakistan to inform them about the death and seek their assistance in the process.</li>
                                                                        <li><strong>Translation and authentication:</strong> If required, get the death certificate translated into Arabic and authenticated by the UAE Embassy or Consulate.</li>
                                                                    </ul>
                                                                </div>
                                                                <div class="accordion" id="accordiondeath">
                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-01">
                                                                            <hr>
                                                                            <button class="accordion-button border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-01" aria-expanded="true" aria-controls="collapse-01">
                                                                                Nearest Police Station
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-01" class="accordion-collapse collapse show" aria-labelledby="heading-01" data-bs-parent="#accordiondeath">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col">
                                                                                        Find the Nearest Police Station
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d142249.7839401174!2d67.04671320948779!3d24.895866991640506!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1691317066013!5m2!1sen!2s" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-02">
                                                                            <button class="accordion-button collapsed border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-02" aria-expanded="false" aria-controls="collapse-02">
                                                                                Obtain the medical certificate
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-02" class="accordion-collapse collapse" aria-labelledby="heading-2" data-bs-parent="#accordiondeath">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col">
                                                                                        <h6>List of Hospitals</h6>
                                                                                        <li><a href="https://hospitals.aku.edu/">Agha Khan Hospital</a></li>
                                                                                        <li><a href="http://www.jpmc.edu.pk/">Jinnah Postgraduate Medical Center (JPMC)</a></li>
                                                                                        <li><a href="https://chk.gov.pk/">Civil Hospital Karachi</a></li>
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d142249.7839401174!2d67.04671320948779!3d24.895866991640506!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1691317066013!5m2!1sen!2s" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-03">
                                                                            <button class="accordion-button collapsed border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-03" aria-expanded="false" aria-controls="collapse-03">
                                                                                Register the death:
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-03" class="accordion-collapse collapse" aria-labelledby="heading-3" data-bs-parent="#accordiondeath">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col">
                                                                                        <p>Register the death at the relevant Registrar of Deaths office in Pakistan. This is usually located at the city or district level.</p>

                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <h4>Report the Nearest Police Station</h4>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-04">
                                                                            <button class="accordion-button collapsed border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-04" aria-expanded="false" aria-controls="collapse-04">
                                                                                Provide necessary documents:
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-04" class="accordion-collapse collapse" aria-labelledby="heading-4" data-bs-parent="#accordiondeath">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col">
                                                                                        <p>You may need to submit documents such as the deceased person's passport, Emirates ID (if available), and other identification documents.</p>
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <div class="flip-card">
                                                                                            <div class="flip-card-inner">
                                                                                                <div class="flip-card-front">
                                                                                                    <img src="https://blog.skyloov.com/wp-content/uploads/2022/01/eida-1.png" alt="Avatar" style="width:300px;height:200px;">
                                                                                                </div>
                                                                                                <div class="flip-card-back">
                                                                                                    <img src="https://imgcdn.pakistanpoint.com/media/2018/12/_3/730x425/pic_1543838075.jpg" alt="" style="width:300px;height:200px;">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-05">
                                                                            <button class="accordion-button collapsed border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-05" aria-expanded="false" aria-controls="collapse-05">
                                                                                Embassy/Consulate involvement:
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-05" class="accordion-collapse collapse" aria-labelledby="heading-5" data-bs-parent="#accordiondeath">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div>
                                                                                        <p>Contact the UAE Embassy or Consulate in Pakistan to inform them about the death and seek their assistance in the process.</p>

                                                                                    </div>
                                                                                    <div>
                                                                                        <iframe src="https://www.google.com/maps/d/u/3/embed?mid=1W5KA2WIVRI0k0Wpd4MedVU_TuQ6u6q8&ehbc" width="700" height="400"></iframe>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-06">
                                                                            <button class="accordion-button collapsed border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-06" aria-expanded="false" aria-controls="collapse-06">
                                                                                Translation and authentication:
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-06" class="accordion-collapse collapse" aria-labelledby="heading-6" data-bs-parent="#accordiondeath">
                                                                            <div class="accordion-body">
                                                                                <p>If required, get the death certificate translated into Arabic and authenticated by the UAE Embassy or Consulate.</p>
                                                                                <div class="row d-flex align-items-center">

                                                                                    <div class="col">
                                                                                        <img src="https://24x7offshoring.com/wp-content/uploads/2022/10/translation-24x7offshoring.gif" alt="" width="100%">
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <img src="https://fiverr-res.cloudinary.com/images/q_auto,f_auto/gigs/97955178/original/07163e8bdbd78d0d7d50a95d8d849f7faa662cc4/translate-english-or-spanish-to-arabic.jpg" alt="" width="50%">
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-07">
                                                                            <button class="accordion-button collapsed border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-07" aria-expanded="false" aria-controls="collapse-07">
                                                                                Photographs
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-07" class="accordion-collapse collapse" aria-labelledby="heading-7" data-bs-parent="#accordiondeath">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col">
                                                                                        <h5>Ten (10) recent photographs</h5>
                                                                                        <hr>
                                                                                        <ul>
                                                                                            <li>Color Photos</li>
                                                                                            <br>
                                                                                            <li>White Background</li> <br>
                                                                                            <li>Standard format: 35 mm x 45 mm (width x height).</li>
                                                                                        </ul>

                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <img src="https://www.netherlandsworldwide.nl/binaries/content/gallery/p1o/afbeeldingen/fotomatrix2020-positionering.png" alt="" width="100%">
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-08">
                                                                            <button class="accordion-button collapsed border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-08" aria-expanded="false" aria-controls="collapse-08">
                                                                                Request Letter
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-08" class="accordion-collapse collapse" aria-labelledby="heading-8" data-bs-parent="#accordiondeath">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col">
                                                                                        <p>Letter by Consul General</p>
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <img src="https://cdn3.iconfinder.com/data/icons/basic-regular-2/64/85-1024.png" alt="" width="50%">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
                                                            </div>
                                                        </div>
                                                        <!-- AEP FOR STAFF END=================== -->

                                                        <!-- AEP FOR OTHERS START=================== -->
                                                        <div class="tab-pane" role="tabpanel" id="others">
                                                            <h3> Any Other Document </h3>
                                                            <p> For obtaining any other documents, procedure and reqiremnts will soon published </p>
                                                            <hr>
                                                            <div class="container">
                                                                <H4>Coming soon...</H4>
                                                                <div class="accordion" id="accordionothers">
                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-01">
                                                                            <hr>
                                                                            <button class="accordion-button border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-01" aria-expanded="true" aria-controls="collapse-01">
                                                                                UAE Embassy or Consulate in Pakistan
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-01" class="accordion-collapse collapse" aria-labelledby="heading-01" data-bs-parent="#accordionothers">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div>
                                                                                        <p></p>
                                                                                    </div>
                                                                                    <div>
                                                                                        <iframe src="https://www.google.com/maps/d/u/3/embed?mid=1W5KA2WIVRI0k0Wpd4MedVU_TuQ6u6q8&ehbc" width="700" height="400"></iframe>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ===================CERTIFICATES END============== -->

                                <!-- ===================PAK VISA START============== -->
                                <div class="modal fade bd-example-modal-pv" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <div class="modal-header bottom-border p-1 ">
                                                <h3 class="modal-title modal-heading text-black" id="exampleModalLabel"><strong>Pakistan Visa</strong></h3>
                                                <button type="button" class="close little-modalclose-btn p-1 px-2" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                                </button>
                                                </div>
                                            <div class="modal-body">
                                                <div class="container">
                                                    <a href="https://getbootstrap.com/docs/4.0/components/navs/#tabs" target="_blank">

                                                    </a>
                                                    <div>
                                                        <p>Steps and Procedure for Obtaining Pakistani eVisa</p>
                                                    </div>
                                                    <div>
                                                        <ul class="nav nav-tabs d-flex justify-content-around" role="tablist">
                                                            <li class="nav-item">
                                                                <a href="#uae" role="tab" data-toggle="tab" class="nav-link active">
                                                                    <h6>UAE Nationals</h6>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="#o-national" role="tab" data-toggle="tab" class="nav-link">
                                                                    <h6>Other Nationals</h6>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <div class="tab-content">

                                                        <div class="tab-pane active" role="tabpanel" id="uae">
                                                            <h3> Applying for UAE Nationals </h3>
                                                            <p> The procedure for obtaining a Pakistani visa for UAE nationals and other foreign nationals can vary based on the type of visa and the nationality of the applicant. </p>
                                                            <hr>

                                                            <div class="container">
                                                                <H4>Requirements</H4>
                                                                <div class="accordion" id="accordionuae">
                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-01">
                                                                            <hr>
                                                                            <button class="accordion-button border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-01" aria-expanded="true" aria-controls="collapse-01">
                                                                                Getting Ready for Application
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-01" class="accordion-collapse collapse" aria-labelledby="heading-01" data-bs-parent="#accordionuae">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col-6">
                                                                                        <p>Before proceeding the application online, make sure the following docments are with you.</p>

                                                                                        <div class="d-flex align-items-center">
                                                                                            <input type="checkbox" aria-label="Checkbox for following text input">&nbsp;&nbsp;&nbsp;&nbsp;Copy of passport (expiry atleast 6 months)
                                                                                        </div>
                                                                                        <div class="d-flex align-items-center">
                                                                                            <input type="checkbox" aria-label="Checkbox for following text input">&nbsp;&nbsp;&nbsp;&nbsp;Copy of Other ID Document
                                                                                        </div>
                                                                                        <div class="d-flex align-items-center">
                                                                                            <input type="checkbox" aria-label="Checkbox for following text input">&nbsp;&nbsp;&nbsp;&nbsp;Passport size photograph
                                                                                        </div>
                                                                                        <div class="d-flex align-items-center">
                                                                                            <input type="checkbox" aria-label="Checkbox for following text input">&nbsp;&nbsp;&nbsp;&nbsp;Sponser's Letter
                                                                                        </div>
                                                                                        <div class="d-flex align-items-center">
                                                                                            <input type="checkbox" aria-label="Checkbox for following text input">&nbsp;&nbsp;&nbsp;&nbsp;Edcational Certificates
                                                                                        </div>
                                                                                        <div class="d-flex align-items-center">
                                                                                            <input type="checkbox" aria-label="Checkbox for following text input">&nbsp;&nbsp;&nbsp;&nbsp;Other Documents
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <p>Other Information Required</p>
                                                                                        <div class="d-flex align-items-center">
                                                                                            <input type="checkbox" aria-label="Checkbox for following text input">&nbsp;&nbsp;&nbsp;&nbsp;Mother's Name
                                                                                        </div>
                                                                                        <div class="d-flex align-items-center">
                                                                                            <input type="checkbox" aria-label="Checkbox for following text input">&nbsp;&nbsp;&nbsp;&nbsp;Spouse Name
                                                                                        </div>
                                                                                        <div class="d-flex align-items-center">
                                                                                            <input type="checkbox" aria-label="Checkbox for following text input">&nbsp;&nbsp;&nbsp;&nbsp;Address in Country of Residence
                                                                                        </div>
                                                                                        <div class="d-flex align-items-center">
                                                                                            <input type="checkbox" aria-label="Checkbox for following text input">&nbsp;&nbsp;&nbsp;&nbsp;Address in Pakistan, where will stay
                                                                                        </div>

                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-03">
                                                                            <button class="accordion-button collapsed border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-03" aria-expanded="false" aria-controls="collapse-03">
                                                                                <strong> Step - 1</strong> Preliminary Assessment
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-03" class="accordion-collapse collapse" aria-labelledby="heading-3" data-bs-parent="#accordionuae">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col-4">
                                                                                        <h6>Choose your visa below and understand the eligibility and document requirements before you apply:</h6>

                                                                                    </div>
                                                                                    <div class="col-8">
                                                                                        <table class="w-100">
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <th class="col-6 border"><a href="https://visa.nadra.gov.pk/tourist-visa/">Tourist Visa</a></th>
                                                                                                    <th class="col-6 border"><a href="https://visa.nadra.gov.pk/visa-on-arrival-tourist/">Tourist Visa in Your Inbox</a></th>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th class="col-6 border"><a href="https://visa.nadra.gov.pk/family-visit-visa/">Family Visit Visa</a></th>
                                                                                                    <th class="col-6 border"><a href="https://visa.nadra.gov.pk/business-visa/">Business Visa</a></th>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th class="col-6 border"><a href="https://visa.nadra.gov.pk/visa-on-arrival-business/">Business Visa in Your Inbox</a></th>
                                                                                                    <th class="col-6 border"><a href="https://visa.nadra.gov.pk/student-visa/">Student Visa</a></th>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th class="col-6 border"><a href="https://visa.nadra.gov.pk/work-visa/">Work Visa</a></th>
                                                                                                    <th class="col-6 border"><a href="https://visa.nadra.gov.pk/domestic-aide/">Domestic Aide Visa</a></th>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th class="col-6 border"><a href="https://visa.nadra.gov.pk/official-visa/">Official Visa</a></th>
                                                                                                    <th class="col-6 border"><a href="https://visa.nadra.gov.pk/diplomatic-visa/">Diplomatic Visa</a></th>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th class="col-6 border"><a href="https://visa.nadra.gov.pk/tabligh-visa/">Tabligh Visa</a></th>
                                                                                                    <th class="col-6 border"><a href="https://visa.nadra.gov.pk/missionary-work-visa/">Missionary Visa</a></th>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th class="col-6 border"><a href="https://visa.nadra.gov.pk/visa-to-ngo-personnel/">NGO / INGO Visa</a></th>
                                                                                                    <th class="col-6 border"><a href="https://visa.nadra.gov.pk/journalist-visa/">Journalist Visa</a></th>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th class="col-6 border"><a href="https://visa.nadra.gov.pk/other-visa/">Other Visa</a></th>
                                                                                                    <th class="col-6 border"><a href=""></a></th>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-04">
                                                                            <button class="accordion-button collapsed border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-04" aria-expanded="false" aria-controls="collapse-04">
                                                                           <strong>Step 2:</strong>  Preparation
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-04" class="accordion-collapse collapse" aria-labelledby="heading-4" data-bs-parent="#accordionuae">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col">
                                                                                        <p>Please ensure that you are applying for the right visa as each visa has its own set of required documents. You must have the following on-hand before you begin your application:</p>
                                                                                        <p>Before proceeding the application online, make sure the following docments are with you.</p>

                                                                                        <div class="d-flex align-items-center">
                                                                                            <input type="checkbox" aria-label="Checkbox for following text input">&nbsp;&nbsp;&nbsp;&nbsp;Copy of passport (expiry atleast 6 months)
                                                                                        </div>
                                                                                        <div class="d-flex align-items-center">
                                                                                            <input type="checkbox" aria-label="Checkbox for following text input">&nbsp;&nbsp;&nbsp;&nbsp;Copy of Other ID Document
                                                                                        </div>
                                                                                        <div class="d-flex align-items-center">
                                                                                            <input type="checkbox" aria-label="Checkbox for following text input">&nbsp;&nbsp;&nbsp;&nbsp;Passport size photograph
                                                                                        </div>
                                                                                        <div class="d-flex align-items-center">
                                                                                            <input type="checkbox" aria-label="Checkbox for following text input">&nbsp;&nbsp;&nbsp;&nbsp;Sponser's Letter
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-02">
                                                                            <button class="accordion-button collapsed border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-02" aria-expanded="false" aria-controls="collapse-02">
                                                                              <strong>Step-3:</strong>  Apply Visa Online
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-02" class="accordion-collapse collapse" aria-labelledby="heading-2" data-bs-parent="#accordionuae">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="py-3 text-center">
                                                                                        <h4>Login account required to apply visa online</h4>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="d-block text-center">
                                                                                            <div class="mb-4">
                                                                                                <img src="https://visa.nadra.gov.pk/e-visa/images/top-logo.png" alt="" width="50%">
                                                                                            </div>
                                                                                            <div>
                                                                                                <h4> <a href="https://visa.nadra.gov.pk/e-visa/" class="px-3 py-2 bg-info text-white">Apply Here</a></h4>
                                                                                            </div>

                                                                                            <div>
                                                                                                <img src="https://cdn.dribbble.com/users/1582430/screenshots/5496966/media/f0593ce1654f08375a28787287e128ec.gif" alt="" width="100%">
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div>
                                                                                            <img src="https://www.mastercard.com/news/media/enonsbij/00-debit-page-hero-illo.gif" alt="" width="100%">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
                                                            </div>
                                                        </div>
                                                        <!-- AEP FOR STAFF START=================== -->
                                                        <div class="tab-pane" role="tabpanel" id="o-national">
                                                        <h3> Applying For Other Nationals</h3>
                                                            <p> The procedure for obtaining a Pakistani visa for other nationals and other foreign nationals can vary based on the type of visa and the nationality of the applicant. </p>
                                                            <hr>

                                                            <div class="container">
                                                                <H4>Requirements</H4>
                                                                <div class="accordion" id="accordion-on">
                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-01">
                                                                            <hr>
                                                                            <button class="accordion-button border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-01" aria-expanded="true" aria-controls="collapse-01">
                                                                                Getting Ready for Application
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-01" class="accordion-collapse collapse" aria-labelledby="heading-01" data-bs-parent="#accordion-on">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col-6">
                                                                                        <p>Before proceeding the application online, make sure the following docments are with you.</p>

                                                                                        <div class="d-flex align-items-center">
                                                                                            <input type="checkbox" aria-label="Checkbox for following text input">&nbsp;&nbsp;&nbsp;&nbsp;Copy of passport (expiry atleast 6 months)
                                                                                        </div>
                                                                                        <div class="d-flex align-items-center">
                                                                                            <input type="checkbox" aria-label="Checkbox for following text input">&nbsp;&nbsp;&nbsp;&nbsp;Copy of Other ID Document
                                                                                        </div>
                                                                                        <div class="d-flex align-items-center">
                                                                                            <input type="checkbox" aria-label="Checkbox for following text input">&nbsp;&nbsp;&nbsp;&nbsp;Passport size photograph
                                                                                        </div>
                                                                                        <div class="d-flex align-items-center">
                                                                                            <input type="checkbox" aria-label="Checkbox for following text input">&nbsp;&nbsp;&nbsp;&nbsp;Sponser's Letter
                                                                                        </div>
                                                                                        <div class="d-flex align-items-center">
                                                                                            <input type="checkbox" aria-label="Checkbox for following text input">&nbsp;&nbsp;&nbsp;&nbsp;Edcational Certificates
                                                                                        </div>
                                                                                        <div class="d-flex align-items-center">
                                                                                            <input type="checkbox" aria-label="Checkbox for following text input">&nbsp;&nbsp;&nbsp;&nbsp;Other Documents
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <p>Other Information Required</p>
                                                                                        <div class="d-flex align-items-center">
                                                                                            <input type="checkbox" aria-label="Checkbox for following text input">&nbsp;&nbsp;&nbsp;&nbsp;Mother's Name
                                                                                        </div>
                                                                                        <div class="d-flex align-items-center">
                                                                                            <input type="checkbox" aria-label="Checkbox for following text input">&nbsp;&nbsp;&nbsp;&nbsp;Spouse Name
                                                                                        </div>
                                                                                        <div class="d-flex align-items-center">
                                                                                            <input type="checkbox" aria-label="Checkbox for following text input">&nbsp;&nbsp;&nbsp;&nbsp;Address in Country of Residence
                                                                                        </div>
                                                                                        <div class="d-flex align-items-center">
                                                                                            <input type="checkbox" aria-label="Checkbox for following text input">&nbsp;&nbsp;&nbsp;&nbsp;Address in Pakistan, where will stay
                                                                                        </div>

                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-02">
                                                                            <button class="accordion-button collapsed border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-02" aria-expanded="false" aria-controls="collapse-02">
                                                                                <strong> Step - 1</strong> Preliminary Assessment
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-02" class="accordion-collapse collapse" aria-labelledby="heading-2" data-bs-parent="#accordion-on">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col-4">
                                                                                        <h6>Choose your visa below and understand the eligibility and document requirements before you apply:</h6>

                                                                                    </div>
                                                                                    <div class="col-8">
                                                                                        <table class="w-100">
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <th class="col-6 border"><a href="https://visa.nadra.gov.pk/tourist-visa/">Tourist Visa</a></th>
                                                                                                    <th class="col-6 border"><a href="https://visa.nadra.gov.pk/visa-on-arrival-tourist/">Tourist Visa in Your Inbox</a></th>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th class="col-6 border"><a href="https://visa.nadra.gov.pk/family-visit-visa/">Family Visit Visa</a></th>
                                                                                                    <th class="col-6 border"><a href="https://visa.nadra.gov.pk/business-visa/">Business Visa</a></th>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th class="col-6 border"><a href="https://visa.nadra.gov.pk/visa-on-arrival-business/">Business Visa in Your Inbox</a></th>
                                                                                                    <th class="col-6 border"><a href="https://visa.nadra.gov.pk/student-visa/">Student Visa</a></th>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th class="col-6 border"><a href="https://visa.nadra.gov.pk/work-visa/">Work Visa</a></th>
                                                                                                    <th class="col-6 border"><a href="https://visa.nadra.gov.pk/domestic-aide/">Domestic Aide Visa</a></th>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th class="col-6 border"><a href="https://visa.nadra.gov.pk/official-visa/">Official Visa</a></th>
                                                                                                    <th class="col-6 border"><a href="https://visa.nadra.gov.pk/diplomatic-visa/">Diplomatic Visa</a></th>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th class="col-6 border"><a href="https://visa.nadra.gov.pk/tabligh-visa/">Tabligh Visa</a></th>
                                                                                                    <th class="col-6 border"><a href="https://visa.nadra.gov.pk/missionary-work-visa/">Missionary Visa</a></th>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th class="col-6 border"><a href="https://visa.nadra.gov.pk/visa-to-ngo-personnel/">NGO / INGO Visa</a></th>
                                                                                                    <th class="col-6 border"><a href="https://visa.nadra.gov.pk/journalist-visa/">Journalist Visa</a></th>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th class="col-6 border"><a href="https://visa.nadra.gov.pk/other-visa/">Other Visa</a></th>
                                                                                                    <th class="col-6 border"><a href=""></a></th>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-03">
                                                                            <button class="accordion-button collapsed border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-03" aria-expanded="false" aria-controls="collapse-03">
                                                                           <strong>Step 2:</strong>  Preparation
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-03" class="accordion-collapse collapse" aria-labelledby="heading-3" data-bs-parent="#accordion-on">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="col">
                                                                                        <p>Please ensure that you are applying for the right visa as each visa has its own set of required documents. You must have the following on-hand before you begin your application:</p>
                                                                                        <p>Before proceeding the application online, make sure the following docments are with you.</p>

                                                                                        <div class="d-flex align-items-center">
                                                                                            <input type="checkbox" aria-label="Checkbox for following text input">&nbsp;&nbsp;&nbsp;&nbsp;Copy of passport (expiry atleast 6 months)
                                                                                        </div>
                                                                                        <div class="d-flex align-items-center">
                                                                                            <input type="checkbox" aria-label="Checkbox for following text input">&nbsp;&nbsp;&nbsp;&nbsp;Copy of Other ID Document
                                                                                        </div>
                                                                                        <div class="d-flex align-items-center">
                                                                                            <input type="checkbox" aria-label="Checkbox for following text input">&nbsp;&nbsp;&nbsp;&nbsp;Passport size photograph
                                                                                        </div>
                                                                                        <div class="d-flex align-items-center">
                                                                                            <input type="checkbox" aria-label="Checkbox for following text input">&nbsp;&nbsp;&nbsp;&nbsp;Sponser's Letter
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="accordion-item">
                                                                        <h5 class="accordion-header" id="heading-04">
                                                                            <button class="accordion-button collapsed border-0 w-100 pt-3 pb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-04" aria-expanded="false" aria-controls="collapse-04">
                                                                              <strong>Step-3:</strong>  Apply Visa Online
                                                                            </button>
                                                                        </h5>
                                                                        <div id="collapse-04" class="accordion-collapse collapse" aria-labelledby="heading-4" data-bs-parent="#accordion-on">
                                                                            <div class="accordion-body">
                                                                                <div class="row d-flex align-items-center">
                                                                                    <div class="py-3 text-center">
                                                                                        <h4>Login account required to apply visa online</h4>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="d-block text-center">
                                                                                            <div class="mb-4">
                                                                                                <img src="https://visa.nadra.gov.pk/e-visa/images/top-logo.png" alt="" width="50%">
                                                                                            </div>
                                                                                            <div>
                                                                                                <h4> <a href="https://visa.nadra.gov.pk/e-visa/" class="px-3 py-2 bg-info text-white">Apply Here</a></h4>
                                                                                            </div>

                                                                                            <div>
                                                                                                <img src="https://cdn.dribbble.com/users/1582430/screenshots/5496966/media/f0593ce1654f08375a28787287e128ec.gif" alt="" width="100%">
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div>
                                                                                            <img src="https://www.mastercard.com/news/media/enonsbij/00-debit-page-hero-illo.gif" alt="" width="100%">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
                                                            </div>
                                                        </div>  
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ===================PAK VISA END============== -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copy() {
            let textarea = document.getElementById("textarea");
            textarea.select();
            document.execCommand("copy");
        }
    </script>


    @endsection