<!-- All Pakistan -->
<div class="row">
    <div class="col-3" id="listing">
        <!-- All Pakistan -->
        <div class="card card-custom active">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="region-name">Pakistan</span>
                    <br>
                    <br>
                    <!-- Male and Female icons with counts -->
                    <div class="d-flex">
                        <!-- Male icon and count -->
                        <div class="text-center">
                            <img width="32" height="32" src="{{ asset('icons/male.png') }}" alt="Male" />
                            <span id="allMale">{{ $Male ?? 0 }}</span>
                        </div>
                        <!-- Spacer -->
                        <div style="width: 20px;"></div>
                        <!-- Female icon and count -->
                        <div class="text-center">
                            <img width="32" height="32" src="{{ asset('icons/female.png') }}" alt="Female" />
                            <span id="allFemale">{{ $Female ?? 0 }}</span>
                        </div>
                    </div>
                </div>
                <div class="text-end">
                    <span class="guest-label">Total Guests</span>
                    <br>
                    <br>
                    <div class="total-guests text-right" id="allstate">{{ $allstate }}</div>
                </div>
            </div>
        </div>


        <!-- Baluchistan (Highlighted) -->
        <div class="card card-custom">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="region-name">Baluchistan</span>
                    <br>
                    <br>
                    <!-- Male and Female icons with counts -->
                    <div class="d-flex">
                        <!-- Male icon and count -->
                        <div class="text-center">
                            <img width="32" height="32" src="{{ asset('icons/male.png') }}" alt="Male" />
                            <span id="baluchistanMale">{{ $baluchistanMale ?? 0 }}</span>
                        </div>
                        <!-- Spacer -->
                        <div style="width: 20px;"></div>
                        <!-- Female icon and count -->
                        <div class="text-center">
                            <img width="32" height="32" src="{{ asset('icons/female.png') }}" alt="Female" />
                            <span id="baluchistanFemale">{{ $baluchistanFemale ?? 0 }}</span>
                        </div>
                    </div>
                </div>
                <div class="text-end">
                    <span class="guest-label">Total Guests</span>
                    <br>
                    <br>
                    <div class="total-guests text-right" id="baluchistan">{{ $baluchistanVisitor }}</div>
                </div>
            </div>
        </div>

        <!-- Khyber PK -->
        <div class="card card-custom">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="region-name">Khyber PK</span>
                    <br>
                    <br>
                    <!-- Male and Female icons with counts -->
                    <div class="d-flex">
                        <!-- Male icon and count -->
                        <div class="text-center">
                            <img width="32" height="32" src="{{ asset('icons/male.png') }}" alt="Male" />
                            <span id="khyberMale">{{ $khyberMale ?? 0 }}</span>
                        </div>
                        <!-- Spacer -->
                        <div style="width: 20px;"></div>
                        <!-- Female icon and count -->
                        <div class="text-center">
                            <img width="32" height="32" src="{{ asset('icons/female.png') }}" alt="Female" />
                            <span id="khyberFemale">{{ $khyberFemale ?? 0 }}</span>
                        </div>
                    </div>
                </div>
                <div class="text-end">
                    <span class="guest-label">Total Guests</span>
                    <br>
                    <br>
                    <div class="total-guests text-right" id="kpk">{{ $khyberVisitor }}</div>
                </div>
            </div>
        </div>

        <!-- Punjab -->
        <div class="card card-custom">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="region-name">Punjab</span>
                    <br>
                    <br>
                       <!-- Male and Female icons with counts -->
                       <div class="d-flex">
                        <!-- Male icon and count -->
                        <div class="text-center">
                            <img width="32" height="32" src="{{ asset('icons/male.png') }}" alt="Male" />
                            <span id="punjabMale">{{ $punjabMale ?? 0 }}</span>
                        </div>
                        <!-- Spacer -->
                        <div style="width: 20px;"></div>
                        <!-- Female icon and count -->
                        <div class="text-center">
                            <img width="32" height="32" src="{{ asset('icons/female.png') }}" alt="Female" />
                            <span id="punjabFemale">{{ $punjabFemale ?? 0 }}</span>
                        </div>
                    </div>
                </div>
                <div class="text-end">
                    <span class="guest-label">Total Guests</span>
                    <br>
                    <br>
                    <div class="total-guests text-right" id="punjab">{{ $punjabVisitor }}</div>
                </div>
            </div>
        </div>

        <!-- Sindh -->
        <div class="card card-custom">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="region-name">Sindh</span>
                    <br>
                    <br>
                     <!-- Male and Female icons with counts -->
                     <div class="d-flex">
                        <!-- Male icon and count -->
                        <div class="text-center">
                            <img width="32" height="32" src="{{ asset('icons/male.png') }}" alt="Male" />
                            <span id="sindhMale">{{ $sindhMale ?? 0 }}</span>
                        </div>
                        <!-- Spacer -->
                        <div style="width: 20px;"></div>
                        <!-- Female icon and count -->
                        <div class="text-center">
                            <img width="32" height="32" src="{{ asset('icons/female.png') }}" alt="Female" />
                            <span id="sindhFemale">{{ $sindhFemale ?? 0 }}</span>
                        </div>
                    </div>
                </div>
                <div class="text-end">
                    <span class="guest-label">Total Guests</span>
                    <br>
                    <br>
                    <div class="total-guests text-right" id="sindh">{{ $sindhVisitor }}</div>
                </div>
            </div>
        </div>
    </div>

    <ul class="nav nav-pills mb-3 float-end" id="listing-pills-tab" role="tablist">
        <li class="nav-item mb-2" role="presentation">
            <button class="nav-link active btn btn-outline-danger mr-2" id="pills-home-tab" data-bs-toggle="pill"
                data-bs-target="#pills-home" data-name="Pakistan" type="button" role="tab"
                aria-controls="pills-home" aria-selected="true">Pakistan</button>
        </li>
        <li class="nav-item mb-2" role="presentation">
            <button class="nav-link btn btn-outline-danger mr-2" id="pills-profile-tab" data-bs-toggle="pill"
                data-bs-target="#pills-profile" data-name="baluchistan" type="button" role="tab"
                aria-controls="pills-profile" aria-selected="false">Baluchistan</button>
        </li>
        <li class="nav-item mb-2" role="presentation">
            <button class="nav-link btn btn-outline-danger mr-2" id="pills-contact-tab" data-bs-toggle="pill"
                data-bs-target="#pills-contact" data-name="sindh" type="button" role="tab"
                aria-controls="pills-contact" aria-selected="false">Sindh</button>
        </li>
        <li class="nav-item mb-2" role="presentation">
            <button class="nav-link btn btn-outline-danger mr-2" id="pills-contacts-tab" data-bs-toggle="pill"
                data-bs-target="#pills-contacts" data-name="punjab" type="button" role="tab"
                aria-controls="pills-contacts" aria-selected="false">Punjab</button>
        </li>
        <li class="nav-item mb-2" role="presentation">
            <button class="nav-link btn btn-outline-danger mr-2" id="pills-contacta-tab" data-bs-toggle="pill"
                data-bs-target="#pills-contacta" data-name="khyber pk" type="button" role="tab"
                aria-controls="pills-contacta" aria-selected="false">Khyber</button>
        </li>
    </ul>
    <div class="col-9">
        <div class="tab-content" id="pills-tabContent">
            <!-- =========Pakistan======== -->
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="row">
                    <div class="col-9">
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-12">
                                <svg id="listing_map" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1628 1544"
                                    style="display: inline;min-height:700px">

                                    <g class="model-green">
                                        <a id="state_Islamabad" class="state" xlink:href="">
                                            <path id="Islamabad" class="shape"
                                                d="m 1246.3,392.4 -3.2,-4.2 -2.8,0.2 -10.6,-7.8 -25.6,9.2 -11.8,3.6 6.4,13.8 18,-8.8 6.8,10.2 -3.8,3 6,4.8 11.2,-7.2 1.6,-9 z" />
                                        </a>
                                    </g>

                                    <g class="model-green" id="Balochistan" fill="#ffffd0" stroke="#d0c0a0"
                                        transform="translate(-27.1,-28.1)">
                                        <a id="state_Ziarat" class="state" xlink:href="">
                                            <path id="Ziarat" class="shape"
                                                d="m 711.2,780.9 -9.4,-2.6 -6.6,8 -5,0 -2.4,-6.2 -6.2,-1.8 -14.4,11.4 -7.2,9.8 4.4,9 5.4,2.8 1,-4.2 29,10.2 18.6,-11.2 -4,-5.6 7,-7.8 0,-6.2 -8.2,0 z" />
                                        </a>

                                        <a id="state_Zhob" class="state" xlink:href="">
                                            <path id="Zhob" class="shape"
                                                d="m 729.2,682.9 6.2,24 16.6,5 47.2,-19 12,4.4 1.8,26.6 38.8,-2.6 16.2,12.2 11.6,-2.4 -10.8,23.2 -22.2,10 8.4,9.6 42.4,22.8 -9,-13.2 7.6,-20.6 18.8,-26.4 0.4,-36.6 21,5.6 5,-12.2 -34,-20.2 -21.4,-27.8 -26.2,-12.4 -7.8,16.8 -10,8.8 -7.2,-2.2 -5.2,5 -9.2,-1 -8.8,-9.8 -1.4,-8.6 -6.2,-0.6 -7,-6 -13.8,7.4 -14.6,0.8 -11.8,-9 -10.4,15.6 -20,12 12.2,11.8 z" />
                                        </a>

                                        <a id="state_Washuk" class="state" xlink:href="">
                                            <path id="Washuk" class="shape"
                                                d="m 407.8,1088.5 14.2,25.8 -7.8,14 26.4,41 -30.2,16.2 -26.8,-33.8 -31.4,35.4 -28.2,-32.2 -65.8,8 -24,5.6 -16,-4.8 6.8,-36.2 -8,-53.8 54,-32.4 59.2,-6.4 88.6,-40.2 -6.2,45.8 4.2,26.2 z" />
                                        </a>

                                        <a id="state_Sibi" class="state" xlink:href="">
                                            <path id="Sibi" class="shape"
                                                d="m 692.6,883.9 24,11 13.8,29.4 27.4,-3.8 -5.8,-7 11.4,-16.8 -26.8,-12 10.6,-23.2 37.8,-12.8 -33,-27.6 -73,33.2 7.8,3 z" />
                                        </a>

                                        <a id="state_Sheerani" class="state" xlink:href="">
                                            <path id="Sheerani" class="shape"
                                                d="m 925.6,621.3 -7.2,-4.6 3,-9.6 -16.8,4.6 -10.6,11.6 -21.8,-1 -12.6,10.6 26.2,12.4 21.4,27.8 34,20.2 -2.6,-16.8 -8.6,-5.2 2.4,-43.8 -7.6,5.2 -3,-3.2 z" />
                                        </a>

                                        <a id="state_Quetta" class="state" xlink:href="">
                                            <path id="Quetta" class="shape"
                                                d="m 664.4,808.5 -4.4,-9 -7.8,1.4 -5.4,6.8 -12,-16.6 -7,0.4 -14.2,33.8 -19.8,-2 -6.6,7 -8.8,-3.4 -14.4,12.4 11.8,9.6 -10.6,13.2 29.4,6.4 20,-36.2 12,13.2 19.8,-5.8 1.2,-13.2 19.6,-6.4 2.6,-8.8 z" />
                                        </a>

                                        <a id="state_Pishin" class="state" xlink:href="">
                                            <path id="Pishin" class="shape"
                                                d="m 667.2,789.7 -7.2,9.8 -7.8,1.4 -5.4,6.8 -12,-16.6 -12.4,-21.2 -8.8,-4 14.8,-25.6 27.4,-1.2 14,-18.6 -0.2,-14.2 6.8,0.6 49.2,10.6 -1.4,8 -35.8,21.8 -4,5.2 8.8,5.6 -9.2,7.6 25.8,2.4 1.4,12.8 -9.4,-2.6 -6.6,8 -5,0 -2.4,-6.2 -6.2,-1.8 z" />
                                        </a>

                                        <a id="state_Panjgur" class="state" xlink:href="">
                                            <path id="Panjgur" class="shape"
                                                d="m 440.6,1169.3 34.8,32.7 -41.8,59.8 -48,-2 -0.6,12.8 -31,12.4 -30.6,-18.8 -25.2,0.4 0,-14.8 -40.6,-0.4 -0.8,-20.2 2.2,-22.6 9,-3.6 -2.6,-23.9 6.2,-6.4 -13.4,-11.8 65.8,-8 28.2,32.2 31.4,-35.4 26.8,33.8 z" />
                                        </a>

                                        <a id="state_Nushki" class="state" xlink:href="">
                                            <path id="Nushki" class="shape"
                                                d="m 531.8,944.9 16.4,-22.4 12.6,-1.4 13.8,-33 -9.4,-26 -118.8,36.8 -2.6,58.8 -25,37 44,-13.6 25,-25.6 32.6,-14 z" />
                                        </a>

                                        <a id="state_Naseerabad" class="state" xlink:href="">
                                            <path id="Naseerabad" class="shape"
                                                d="m 748,990.7 -14.8,-0.6 4.8,14.8 -17.4,1.6 -0.8,46.4 19.8,-5.6 16.4,-21 23.4,-3 0,-19.4 7.6,-3.2 -1.8,-35 -4.2,-4 -19,6.8 6.2,12 z" />
                                        </a>

                                        <a id="state_Musakhel" class="state" xlink:href="">
                                            <path id="Musakhel" class="shape"
                                                d="m 946.8,683.5 -5.6,9.8 -5,12.2 -21,-5.6 -0.4,36.6 -18.8,26.4 -7.6,20.6 9,13.2 20,16.4 14.8,0.2 4.2,-17.4 10.6,-20.8 -1,-9.2 12,-13.2 6.2,-0.8 -2.2,-6.2 1.2,-23.4 -2.4,-5 4,-24.8 -1.4,-17 z" />
                                        </a>

                                        <a id="state_Mastung" class="state" xlink:href="">
                                            <path id="Mastung" class="shape"
                                                d="m 679,854.3 -2.2,-6.6 9,-6 -3.6,-15.4 -12.8,1.6 -2.2,-7.8 -19.6,6.4 -1.2,13.2 -19.8,5.8 -12,-13.2 -20,36.2 -29.4,-6.4 9.4,26 -13.8,33 16.4,1.4 25.6,-31.4 5.4,20.4 19.2,-12.4 -1.4,13.4 26.8,2 4.4,-10.6 10,-20.2 -8.8,-9.4 -4,-15.2 9.4,-9.4 z" />
                                        </a>

                                        <a id="state_Loralai" class="state" xlink:href="">
                                            <path id="Loralai" class="shape"
                                                d="m 768.8,787.1 41,-2.6 14.6,8.4 30.6,-19 42.4,22.8 20,16.4 -13,20 -7.4,-2.2 1.6,-7.8 -18.8,22.8 -34.6,7.8 -12.4,-6.4 -28,14.2 -19.8,-12.8 -33,-27.6 -33.6,-15 -4,-5.6 7,-7.8 0,-6.2 -8.2,0 -2,-5.6 26,-10.4 1.2,10.4 20,-3 z" />
                                        </a>

                                        <a id="state_Lasbela" class="state" xlink:href="">
                                            <path id="Lasbela" class="shape"
                                                d="m 598.4,1376.6 -3.4,0.4 2.4,5.4 15.6,15.6 -5,34.4 2.4,0.8 17,-14.6 6.8,-0.6 8,-9.4 0.4,-7.2 10.6,-10.8 3.4,-18.2 20.8,-27.2 7.2,-21.8 0.6,-29.6 -22.8,-39.8 -8,-26.8 -17.8,15.2 20.2,34.8 -5.4,55 -12.2,3.4 -22,-85.8 -24.8,4.4 -27.6,-5.6 -5,16.8 9.4,52.8 -13.2,31.2 -23.6,8 -38,-1.4 -1.2,-15.2 -31.4,11.6 1.8,25.4 5.8,1 5.2,-3 4,3.2 6.8,-2.2 21.2,4.4 19,-8.6 44.4,-5.8 19,8 1.8,-0.8 -4.8,-6 2.8,-2.6 -4.2,-1.4 -2.4,1.4 -8.4,-8.2 -7.6,1 -5,6.2 -7.8,-2 2.4,-6.4 11.2,-5.2 4.4,1.4 6.2,-3 13.6,13.2 1.6,-1.6 z" />
                                        </a>

                                        <a id="state_Kohlu" class="state" xlink:href="">
                                            <path id="Kohlu" class="shape"
                                                d="m 845.2,880.3 37,-19.6 8,-16.4 -10.4,1.6 -34.6,7.8 -12.4,-6.4 -28,14.2 -19.8,-12.8 -37.8,12.8 -10.6,23.2 26.8,12 -11.4,16.8 5.8,7 29.6,19.8 22.6,-7.4 28.6,6.6 3.6,-5 20.4,2.8 7.2,-14.4 21.2,-10.4 -7.8,-7.4 6.2,-19.4 -24.6,9.2 z" />
                                        </a>

                                        <a id="state_Killa_Saifullah" class="state" xlink:href="">
                                            <path id="Killa_Saifullah" class="shape"
                                                d="m 711.2,671.3 15,-9.2 12.2,11.8 -9.2,9 6.2,24 16.6,5 47.2,-19 12,4.4 1.8,26.6 38.8,-2.6 16.2,12.2 11.6,-2.4 -10.8,23.2 -22.2,10 8.4,9.6 -30.6,19 -14.6,-8.4 -41,2.6 -10.4,-9.2 -20,3 -1.2,-10.4 -26,10.4 -1.4,-12.8 -25.8,-2.4 9.2,-7.6 -8.8,-5.6 4,-5.2 35.8,-21.8 1.4,-8 -49.2,-10.6 42,-16 -1.8,-8 -15.4,1.6 -6,-14.8 z" />
                                        </a>

                                        <a id="state_Killa_Abdullah" class="state" xlink:href="">
                                            <path id="Killa_Abdullah" class="shape"
                                                d="m 628.4,740.3 27.4,-1.2 14,-18.6 -0.2,-14.2 -24.2,-2.2 -4,-10.8 -28.6,12.8 -4.8,15.8 -12,11.2 -17.2,4.2 -11,42.8 7.4,17 -11.2,42.2 14.4,-12.4 8.8,3.4 6.6,-7 19.8,2 14.2,-33.8 7,-0.4 -12.4,-21.2 -8.8,-4 z" />
                                        </a>

                                        <a id="state_Khuzdar" class="state" xlink:href="">
                                            <path id="Khuzdar" class="shape"
                                                d="m 651.4,1332.2 -12.2,3.4 -22,-85.8 -24.8,4.4 -27.6,-5.6 -3.6,-10 -13.8,21 -12.8,-25 15.8,-69.7 -16.8,7.4 -7.8,-20.6 -23.2,-9 13.2,-36.4 24.6,-24.8 15,0.2 34.4,-23.8 9,-15 -15,-13.6 11,-19.2 8.8,1.6 19,-30.6 42.8,0.6 2.4,14 -8.4,20.4 1.8,18.2 17.8,0 4,13.8 -4.6,43 -15.8,33.6 -9.6,29.2 1.4,73.3 -17.8,15.2 20.2,34.8 z" />
                                        </a>

                                        <a id="state_Kharan" class="state" xlink:href="">
                                            <path id="Kharan" class="shape"
                                                d="m 548.2,922.5 -16.4,22.4 -11.4,-3.4 -32.6,14 -25,25.6 -44,13.6 -6.2,45.8 4.2,26.2 -9,21.8 14.2,25.8 -7.8,14 26.4,41 34.8,32.7 27.2,-59.3 13.2,-36.4 24.6,-24.8 -13.8,-37.2 24.4,-37.8 -8.2,-17 19.2,-27.8 -7.8,-18.8 6.6,-21.8 z" />
                                        </a>

                                        <a id="state_Kech" class="state" xlink:href="">
                                            <path id="Kech" class="shape"
                                                d="m 160,1359 22,-9.4 54.4,-3 42.4,12.4 7.8,14.6 57.2,-27.6 14.8,5.4 19.2,-7 -7.8,-10.2 10.4,-34.4 13,-4.2 -8.4,-23 -31,12.4 -30.6,-18.8 -25.2,0.4 0,-14.8 -40.6,-0.4 -0.8,-20.2 -36.6,-0.6 -53,15 2,19.8 -14.2,-4.2 -2.8,7.6 -28.2,10.4 -7.2,49.2 22.2,12 6.8,-15.6 1.2,27.6 z" />
                                        </a>

                                        <a id="state_Kalat" class="state" xlink:href="">
                                            <path id="Kalat" class="shape"
                                                d="m 603.6,1011.7 19,-30.6 42.8,0.6 22.2,-32.6 0,-26.6 -11.6,-10.2 -0.6,-10.8 -14.6,6.2 -3.6,-3.8 -4.4,10.6 -26.8,-2 1.4,-13.4 -19.2,12.4 -5.4,-20.4 -25.6,31.4 -16.4,-1.4 -6.6,21.8 7.8,18.8 -19.2,27.8 8.2,17 -24.4,37.8 13.8,37.2 15,0.2 34.4,-23.8 9,-15 -15,-13.6 11,-19.2 z" />
                                        </a>

                                        <a id="state_Jhal_Magsi" class="state" xlink:href="">
                                            <path id="Jhal_Magsi" class="shape"
                                                d="m 678.4,993.9 -10.6,1.8 -8.4,20.4 1.8,18.2 17.8,0 4,13.8 -4.6,43 27.6,-6 -1.4,-29.2 15.2,-3 0.8,-46.4 -9.2,-15.8 1.4,-11.2 -13.6,0 -6.4,15 -8.2,-5 z" />
                                        </a>

                                        <a id="state_Jafarabad" class="state" xlink:href="">
                                            <path id="Jafarabad" class="shape"
                                                d="m 704.6,1055.9 1.4,29.2 26,-11.4 10.6,-15.2 32.6,-21.4 11.8,-14.2 66.4,-2.4 -10,-7 -29.2,2.6 -27.2,-15.4 -7.6,3.2 0,19.4 -23.4,3 -16.4,21 -19.8,5.6 z" />
                                        </a>

                                        <a id="state_Haranai" class="state" xlink:href="">
                                            <path id="Haranai" class="shape"
                                                d="m 670.8,807.1 -3.6,13 2.2,7.8 12.8,-1.6 3.6,15.4 -9,6 2.2,6.6 73,-33.2 -33.6,-15 -18.6,11.2 z" />
                                        </a>

                                        <a id="state_Gwadar" class="state" xlink:href="">
                                            <path id="Gwadar" class="shape"
                                                d="m 150.4,1397.2 -3.6,6 3.8,5.4 -24.8,2 -1.6,6.2 -10.8,-1 4.6,-17 -16.6,-1.4 10.2,-54 -2.8,-14.6 8,-0.4 22.2,12 6.8,-15.6 1.2,27.6 13,6.6 22,-9.4 54.4,-3 42.4,12.4 7.8,14.6 57.2,-27.6 14.8,5.4 -4.6,10.8 25.8,3.6 34,-11.6 48,-1.8 1.8,25.4 -7,9.2 -8.6,-1.8 -29.4,-1.6 -10.4,4.6 -2.4,7.4 4.6,4.6 -6,1.8 -4.4,-1.2 3,-4 -9,-7.2 -10.8,4.6 -17.8,-9.6 -13.4,-1.4 -4,-8.6 5.4,-2.4 1.8,-3 -11.4,-0.4 -6.2,4 3.2,3.2 2.6,-3 3.6,8.4 -14.2,0.8 -18.2,-5.8 -17.6,2.8 -10,8.8 5.2,8.2 -1.4,2.4 -40.2,-7 -10,4.4 -27,-5.2 -27,2.4 1.8,3 -14.6,7.2 5.2,5.6 -10.6,0 2.4,-9.6 -8.6,-4.2 z" />
                                        </a>

                                        <a id="state_Dera_Bugti" class="state" xlink:href="">
                                            <path id="Dera_Bugti" class="shape"
                                                d="m 787.8,944.5 -15.4,-6.4 -3.2,5.6 11.8,18 4.2,4 1.8,35 27.2,15.4 29.2,-2.6 10,7 25,-0.8 -5,-12 11.2,-6.4 8.6,-20.2 -3.8,-10.8 21,-21.8 4.6,-24 -5.4,3 -4.8,-6.6 2.2,-7 -10.6,-3.4 4.2,-26.8 -11.2,2 -6.2,19.4 7.8,7.4 -21.2,10.4 -7.2,14.4 -20.4,-2.8 -3.6,5 -28.6,-6.6 -22.6,7.4 z" />
                                        </a>

                                        <a id="state_Chaghai" class="state" xlink:href="">
                                            <path id="Chaghai" class="shape"
                                                d="m 330.2,1034.9 -59.2,6.4 -54,32.4 2,-29.8 -20,2.4 -21.2,-20.6 -26.4,-5.8 -31.2,-17.8 -31.6,-42.2 -12.8,-37.8 -48.2,-60.6 157.8,54.4 113.4,-11.6 51.4,13 16.2,-17 36.6,-6.6 43.4,5.2 -2.6,58.8 -25,37 z" />
                                        </a>

                                        <a id="state_Bolan" class="state" xlink:href="">
                                            <path id="Bolan" class="shape"
                                                d="m 692.6,883.9 -5.8,-26.6 -7.8,-3 -15.2,-4.6 -9.4,9.4 4,15.2 8.8,9.4 -10,20.2 3.6,3.8 14.6,-6.2 0.6,10.8 11.6,10.2 0,26.6 -22.2,32.6 2.4,14 10.6,-1.8 6.2,-4.4 8.2,5 6.4,-15 13.6,0 -1.4,11.2 9.2,15.8 17.4,-1.6 -4.8,-14.8 14.8,0.6 20.2,-10.2 -6.2,-12 19,-6.8 -11.8,-18 3.2,-5.6 15.4,6.4 -0.4,-4.2 -29.6,-19.8 -27.4,3.8 -13.8,-29.4 z" />
                                        </a>

                                        <a id="state_Barkhan" class="state" xlink:href="">
                                            <path id="Barkhan" class="shape"
                                                d="m 890.2,844.3 -8,16.4 -37,19.6 19.6,14.6 24.6,-9.2 11.2,-2 13.4,-5.4 15.6,-22.8 8.2,-23.8 7.6,-15.2 -9.6,3.8 -3.6,-7 -14.8,-0.2 -13,20 -7.4,-2.2 1.6,-7.8 -18.8,22.8 z" />
                                        </a>

                                        <a id="state_Awaran" class="state" xlink:href="">
                                            <path id="Awaran" class="shape"
                                                d="m 561.2,1238.6 -13.8,21 -12.8,-25 15.8,-69.7 -16.8,7.4 -7.8,-20.6 -23.2,-9 -27.2,59.3 -41.8,59.8 -48,-2 -0.6,12.8 8.4,23 -13,4.2 -10.4,34.4 7.8,10.2 -19.2,7 -4.6,10.8 25.8,3.6 34,-11.6 48,-1.8 31.4,-11.6 1.2,15.2 38,1.4 23.6,-8 13.2,-31.2 -9.4,-52.8 5,-16.8 z" />
                                        </a>

                                        <path id="Balochistan_Border" fill="none" stroke="#a08070"
                                            d="m 796.8,635.3 -13.8,7.4 -14.6,0.8 -11.8,-9 -10.4,15.6 -20,12 -15,9.2 -16,-1.6 6,14.8 15.4,-1.6 1.8,8 -42,16 -6.8,-0.6 -24.2,-2.2 -4,-10.8 -28.6,12.8 -4.8,15.8 -12,11.2 -17.2,4.2 -11,42.8 7.4,17 -11.2,42.2 11.8,9.6 -10.6,13.2 -118.8,36.8 -43.4,-5.2 -36.6,6.6 -16.2,17 -51.4,-13 -113.4,11.6 -157.8,-54.4 48.2,60.6 12.8,37.8 31.6,42.2 31.2,17.8 26.4,5.8 21.2,20.6 20,-2.4 -2,29.8 8,53.8 -6.8,36.2 16,4.8 24,-5.6 13.4,11.8 -6.2,6.4 2.6,23.9 -9,3.6 -2.2,22.6 -36.6,-0.6 -53,15 2,19.8 -14.2,-4.2 -2.8,7.6 -28.2,10.4 -7.2,49.2 -8,0.4 2.8,14.6 -10.2,54 16.6,1.4 -4.6,17 10.8,1 1.6,-6.2 24.8,-2 -3.8,-5.4 3.6,-6 11.8,-2 8.6,4.2 -2.4,9.6 10.6,0 -5.2,-5.6 14.6,-7.2 -1.8,-3 27,-2.4 27,5.2 10,-4.4 40.2,7 1.4,-2.4 -5.2,-8.2 10,-8.8 17.6,-2.8 18.2,5.8 14.2,-0.8 -3.6,-8.4 -2.6,3 -3.2,-3.2 6.2,-4 11.4,0.4 -1.8,3 -5.4,2.4 4,8.6 13.4,1.4 17.8,9.6 10.8,-4.6 9,7.2 -3,4 4.4,1.2 6,-1.8 -4.6,-4.6 2.4,-7.4 10.4,-4.6 29.4,1.6 8.6,1.8 7,-9.2 5.8,1 5.2,-3 4,3.2 6.8,-2.2 21.2,4.4 19,-8.6 44.4,-5.8 19,8 1.8,-0.8 -4.8,-6 2.8,-2.6 -4.2,-1.4 -2.4,1.4 -8.4,-8.2 -7.6,1 -5,6.2 -7.8,-2 2.4,-6.4 11.2,-5.2 4.4,1.4 6.2,-3 13.6,13.2 1.6,-1.6 5.6,15.8 -3.4,0.4 2.4,5.4 15.6,15.6 -5,34.4 2.4,0.8 17,-14.6 6.8,-0.6 8,-9.4 0.4,-7.2 10.6,-10.8 3.4,-18.2 20.8,-27.2 7.2,-21.8 0.6,-29.6 -22.8,-39.8 -8,-26.8 -1.4,-73.3 9.6,-29.2 15.8,-33.6 27.6,-6 26,-11.4 10.6,-15.2 32.6,-21.4 11.8,-14.2 66.4,-2.4 25,-0.8 -5,-12 11.2,-6.4 8.6,-20.2 -3.8,-10.8 21,-21.8 4.6,-24 -5.4,3 -4.8,-6.6 2.2,-7 -10.6,-3.4 4.2,-26.8 13.4,-5.4 15.6,-22.8 8.2,-23.8 7.6,-15.2 -9.6,3.8 -3.6,-7 4.2,-17.4 10.6,-20.8 -1,-9.2 12,-13.2 6.2,-0.8 -2.2,-6.2 1.2,-23.4 -2.4,-5 4,-24.8 -1.4,-17 -16.6,8 -5.6,9.8 -2.6,-16.8 -8.6,-5.2 2.4,-43.8 -7.6,5.2 -3,-3.2 3.8,-8.2 -7.2,-4.6 3,-9.6 -16.8,4.6 -10.6,11.6 -21.8,-1 -12.6,10.6 -7.8,16.8 -10,8.8 -7.2,-2.2 -5.2,5 -9.2,-1 -8.8,-9.8 -1.4,-8.6 -6.2,-0.6 z" />
                                    </g>

                                    <g class="model-green" id="Sindh" fill="#ffffd0" stroke="#d0c0a0"
                                        transform="translate(-27.1,-28.1)">

                                        <a id="state_Umerkot" class="state" xlink:href="">
                                            <path id="Umerkot" class="shape"
                                                d="m 911.4,1402.6 20.6,-11.8 38.8,-1 -5.6,-22.4 5.4,-12 -14,-6 10.8,-10.6 -6.6,-9.6 -15.4,5.4 -9.2,-1.8 -21.8,25.8 -16.2,3.8 1.4,-7.6 -39.4,-1.4 1.4,16.4 21.6,18.4 -2,18.2 8.2,28.4 14,-20 11.8,4.6 z" />
                                        </a>

                                        <a id="state_Tharparkar" class="state" xlink:href="">
                                            <path id="Tharparkar" class="shape"
                                                d="m 1001,1338.2 -20.2,4.2 -13.4,-3.6 -10.8,10.6 14,6 -5.4,12 5.6,22.4 -38.8,1 -20.6,11.8 3.8,16.8 -11.8,-4.6 -14,20 -14.6,8.8 -9,14.2 -1.6,17.8 -16.4,10.8 1.2,18.4 10.8,3.8 11,-4.8 13.2,0.8 14.8,-1.8 13.4,12.8 30,0.6 8.6,-13.2 26,-8 20.4,-7.6 2,3.4 -3.2,3.8 1.2,12 10,3.4 13.2,0.2 9.8,-5 -3.8,-3.8 11.4,-7.4 3.4,1.2 11,-6.6 -10.4,-2.8 -3,-19.4 9.6,-10.4 -14,-26.4 -7,-26.4 -21,-28 0.6,-31.6 z" />
                                        </a>

                                        <a id="state_Thatta" class="state" xlink:href="">
                                            <path id="Thatta" class="shape"
                                                d="m 689.8,1550.2 11.4,3.2 3.2,-9.4 3,15.6 6.6,-0.4 -2.2,-5.2 11.8,3.6 2,-11.6 16.6,16.6 -1.4,-19.6 5.6,2.4 3.4,12.6 -5,9.6 4.6,2.8 1,-3.8 4.4,5 0.8,-24.2 3.8,14.4 4.6,-14.4 12.8,-9.6 38,2.2 1.4,-36.4 -2,-10.2 -30,-4.6 -3.4,-38.8 -9.4,-11 2.6,-9 -4.2,-12.2 2.4,-9.6 -2.4,-19.2 -7.4,-0.4 -14.6,-16.8 -10.8,10.4 0.2,7.4 -8.8,6 0,15.6 -9.8,10.6 -24.8,5.4 3.2,23.4 -13,-7.6 -18.6,7.8 -6,3 -5,8 1,4 5.6,-0.4 4,3.2 -6,3.2 3.8,3.8 2.8,12.6 2.8,-2.6 -0.8,9 8.2,1.8 -7.2,3.4 5,25.6 19.8,4 0.2,13.4 z" />
                                        </a>

                                        <a id="state_Tando_Muhammad_Khan" class="state" xlink:href="">
                                            <path id="Tando_Muhammad_Khan" class="shape"
                                                d="m 771.4,1439 9.4,11 14.4,-13.8 6.4,2.4 8,-5.8 7.2,0.6 1,-7.2 -15.4,-13.8 -2.2,-4.2 -28,0 -2.4,9.6 4.2,12.2 z" />
                                        </a>

                                        <a id="state_Tando_Allah_Yar" class="state" xlink:href="">
                                            <path id="Tando_Allah_Yar" class="shape"
                                                d="m 821.2,1336 -10,9 0.6,10 -6.4,9.8 3.2,13.6 -4.4,5.8 3.8,5.8 5.4,-0.2 0.8,5.8 18.8,0 6.2,-9.4 0.6,-13 -6.8,-13.6 0.6,-18.4 z" />
                                        </a>

                                        <a id="state_Sukkur" class="state" xlink:href="">
                                            <path id="Sukkur" class="shape"
                                                d="m 830.2,1154.7 17.6,14.4 43.2,20 7.4,-18.8 23.8,-24.6 -20.6,-8 0.2,-7.6 -20.6,-1.6 -17.8,-22.2 10,-1 -9.2,-29 -10.6,-3 -23.8,24.4 -12.4,2.6 -5.6,6.4 8.8,6.2 12,0 -6.2,19.4 9.2,6.8 z" />
                                        </a>

                                        <a id="state_Shikarpur" class="state" xlink:href="">
                                            <path id="Shikarpur" class="shape"
                                                d="m 817.4,1100.3 12.4,-2.6 23.8,-24.4 -4.2,-5.8 -11,-1.2 -24.8,-8.2 -22.4,7 -10.4,-2.6 -0.4,21.6 -6.4,2.2 19,26.2 18.8,-5.8 z" />
                                        </a>

                                        <a id="state_Sanghar" class="state" xlink:href="">
                                            <path id="Sanghar" class="shape"
                                                d="m 811.2,1345 10,-9 12.4,5.2 10,-4.8 13.6,6 3,11 39.4,1.4 -1.4,7.6 16.2,-3.8 21.8,-25.8 9.2,1.8 15.4,-5.4 -10.8,-15.8 -2.2,-14.4 -90.4,-17.8 -23.6,-26.4 -24,20 4.4,8.8 -8.8,3 -10.2,-8 -9.4,6.8 11.4,16 -4.2,13.6 3.2,11.2 z" />
                                        </a>

                                        <a id="state_Qambar_Shahdatkot" class="state" xlink:href="">
                                            <path id="Qambar_Shahdatkot" class="shape"
                                                d="m 662.6,1124.7 -9.6,29.2 94.8,7.2 7.2,-9 -1,-12.4 8.4,-22.6 8.6,-19 -5.6,-3.4 -3,-10.8 -8.8,-5.2 -12.2,0 -9.4,-5 -26,11.4 -27.6,6 z" />
                                        </a>

                                        <a id="state_Nawabshah" class="state" xlink:href="">
                                            <path id="Nawabshah" class="shape"
                                                d="m 818,1237.6 -40.2,-2.6 -27.8,5.2 -10.6,7 -4,23.6 28.6,37.8 9,-0.2 10.6,-11.4 13.6,4.4 -11.4,-16 9.4,-6.8 10.2,8 8.8,-3 -4.4,-8.8 24,-20 z" />
                                        </a>

                                        <a id="state_Naushahro_Firoze" class="state" xlink:href="">
                                            <path id="Naushahro_Firoze" class="shape"
                                                d="m 729.8,1210.8 5.6,22.2 -6,6.6 10,7.6 10.6,-7 27.8,-5.2 2,-29.6 9.8,-27.1 -24.2,-12.8 -12.8,13.8 -10.2,6.6 3.4,10 z" />
                                        </a>

                                        <a id="state_Mirpur_Khas" class="state" xlink:href="">
                                            <path id="Mirpur_Khas" class="shape"
                                                d="m 860.2,1353.4 -3,-11 -13.6,-6 -10,4.8 -0.6,18.4 6.8,13.6 -0.6,13 4,22 18.6,17.6 10.2,3.4 2.8,14.4 14.6,-8.8 -8.2,-28.4 2,-18.2 -21.6,-18.4 z" />
                                        </a>

                                        <a id="state_Matiari" class="state" xlink:href="">
                                            <path id="Matiari" class="shape"
                                                d="m 793,1315 4.2,-13.6 -13.6,-4.4 -10.6,11.4 -3.2,8.6 9.6,9 -2.2,9.4 15,9.4 -3.6,-13.2 7.6,-5.4 z" />
                                        </a>

                                        <a id="state_Larkana" class="state" xlink:href="">
                                            <path id="Larkana" class="shape"
                                                d="m 773,1152.1 9.2,-1.8 -8.2,-14.8 8.2,-12.8 16.2,-3.6 -5.4,-6.6 -19,-26.2 -11.6,-2.4 3,10.8 5.6,3.4 -8.6,19 -8.4,22.6 1,12.4 -7.2,9 -4.4,8.6 9.2,9.6 12.8,-13.8 z" />
                                        </a>

                                        <a id="state_Khairpur_Mir's" class="state" xlink:href="">
                                            <path id="Khairpur" class="shape"
                                                d="m 765.4,1165.5 24.2,12.8 -9.8,27.1 -2,29.6 40.2,2.6 15.8,17.2 23.6,26.4 90.4,17.8 9.2,-21.6 -0.4,-35 -10.2,-5.6 -18.6,2 -39,-21 2.2,-28.7 -43.2,-20 -17.6,-14.4 5.4,-15.6 -9.2,-6.8 6.2,-19.4 -12,0 -8.8,-6.2 -18.8,5.8 5.4,6.6 -16.2,3.6 -8.2,12.8 8.2,14.8 -9.2,1.8 z" />
                                        </a>

                                        <a id="state_Kashmore" class="state" xlink:href="">
                                            <path id="Kashmore" class="shape"
                                                d="m 878.4,1019.7 -25,0.8 -15,45.8 11,1.2 4.2,5.8 10.6,3 6.4,-11 24.6,-13 7,8 21,-22 -11.6,-16.8 -23.6,-6.2 z" />
                                        </a>

                                        <a id="state_Karachi" class="state" xlink:href="">
                                            <path id="Karachi" class="shape"
                                                d="m 671.6,1403.2 19,13.4 3.2,10.6 3.2,23.4 -13,-7.6 -18.6,7.8 -2.2,-4.2 -5,2.4 -10.6,-5 -0.2,3.6 -12,-8.6 0.2,4.2 -9.8,-5.8 -20.4,3.4 5,-7.6 17,-14.6 6.8,-0.6 8,-9.4 0.4,-7.2 10.6,-10.8 3.4,-18.2 20.8,-27.2 9.2,11.4 -2.2,17.8 z" />
                                        </a>

                                        <a id="state_Jamshoro" class="state" xlink:href="">
                                            <path id="Jamshoro" class="shape"
                                                d="m 739.4,1247.2 -10,-7.6 -14.6,-5 -7.4,37.2 -9.4,-0.2 -12.8,22.2 -0.6,29.6 -7.2,21.8 9.2,11.4 -2.2,17.8 -12.8,28.8 19,13.4 3.2,10.6 24.8,-5.4 9.8,-10.6 0,-15.6 8.8,-6 -0.2,-7.4 10.8,-10.4 14.6,16.8 7.4,0.4 11.4,1.6 -6.6,-21.4 10.2,-7.8 -3.4,-9 10.8,-7.6 -15,-9.4 2.2,-9.4 -9.6,-9 3.2,-8.6 -9,0.2 -28.6,-37.8 z" />
                                        </a>

                                        <a id="state_Jacobabad" class="state" xlink:href="">
                                            <path id="Jacobabad" class="shape"
                                                d="m 853.4,1020.5 -15,45.8 -24.8,-8.2 -22.4,7 -10.4,-2.6 -0.4,21.6 -6.4,2.2 -11.6,-2.4 -8.8,-5.2 -12.2,0 -9.4,-5 10.6,-15.2 32.6,-21.4 11.8,-14.2 z" />
                                        </a>

                                        <a id="state_Hyderabad" class="state" xlink:href="">
                                            <path id="Hyderabad" class="shape"
                                                d="m 800.2,1408.2 2.2,4.2 11.4,-5.6 0.4,-11.2 -0.8,-5.8 -5.4,0.2 -3.8,-5.8 4.4,-5.8 -3.2,-13.6 6.4,-9.8 -0.6,-10 -15,-18.8 -7.6,5.4 3.6,13.2 -10.8,7.6 3.4,9 -10.2,7.8 6.6,21.4 -11.4,-1.6 2.4,19.2 z" />
                                        </a>

                                        <a id="state_Ghotki" class="state" xlink:href="">
                                            <path id="Ghotki" class="shape"
                                                d="m 901.8,1130.1 -0.2,7.6 20.6,8 20,-20.6 8.4,-22.6 9.8,-13.4 -18,-8.4 -13,-17.8 -6.2,-24.6 -21,22 -7,-8 -24.6,13 -6.4,11 9.2,29 -10,1 17.8,22.2 z" />
                                        </a>

                                        <a id="state_Dadu" class="state" xlink:href="">
                                            <path id="Dadu" class="shape"
                                                d="m 752.6,1179.3 -9.2,-9.6 4.4,-8.6 -94.8,-7.2 1.4,73.3 8,26.8 22.8,39.8 12.8,-22.2 9.4,0.2 7.4,-37.2 14.6,5 6,-6.6 -5.6,-22.2 16,-14.9 -3.4,-10 z" />
                                        </a>

                                        <a id="state_Badin" class="state" xlink:href="">
                                            <path id="Badin" class="shape"
                                                d="m 784.2,1488.8 30,4.6 2,10.2 6.2,-3.4 3,12.2 6.8,-10.8 7,8.2 9.8,-5 -1.2,-18.4 16.4,-10.8 1.6,-17.8 9,-14.2 -2.8,-14.4 -10.2,-3.4 -18.6,-17.6 -4,-22 -6.2,9.4 -18.8,0 -0.4,11.2 -11.4,5.6 15.4,13.8 -1,7.2 -7.2,-0.6 -8,5.8 -6.4,-2.4 -14.4,13.8 z" />
                                        </a>

                                        <path id="Sindh_Border" fill="none" stroke="#a08070"
                                            d="m 911.6,1021.5 -23.6,-6.2 -9.6,4.4 -35,1.2 -56.4,2 -11.8,14.2 -32.6,21.4 -10.6,15.2 -26,11.4 -27.6,6 -15.8,33.6 -9.6,29.2 1.4,73.3 8,26.8 22.8,39.8 -0.6,29.6 -7.2,21.8 -20.8,27.2 -3.4,18.2 -10.6,10.8 -0.4,7.2 -8,9.4 -6.8,0.6 -17,14.6 -5,7.6 20.4,-3.4 9.8,5.8 -0.2,-4.2 12,8.6 0.2,-3.6 10.6,5 5,-2.4 2.2,4.2 -6,3 -5,8 1,4 5.6,-0.4 4,3.2 -6,3.2 3.8,3.8 2.8,12.6 2.8,-2.6 -0.8,9 8.2,1.8 -7.2,3.4 5,25.6 19.8,4 0.2,13.4 -3.8,7.4 11.4,3.2 3.2,-9.4 3,15.6 6.6,-0.4 -2.2,-5.2 11.8,3.6 2,-11.6 16.6,16.6 -1.4,-19.6 5.6,2.4 3.4,12.6 -5,9.6 4.6,2.8 1,-3.8 4.4,5 0.8,-24.2 3.8,14.4 4.6,-14.4 12.8,-9.6 38,2.2 1.4,-36.4 6.2,-3.4 3,12.2 6.8,-10.8 7,8.2 9.8,-5 10.8,3.8 11,-4.8 13.2,0.8 14.8,-1.8 13.4,12.8 30,0.6 8.6,-13.2 26,-8 20.4,-7.6 2,3.4 -3.2,3.8 1.2,12 10,3.4 13.2,0.2 9.8,-5 -3.8,-3.8 11.4,-7.4 3.4,1.2 11,-6.6 -10.4,-2.8 -3,-19.4 9.6,-10.4 -14,-26.4 -7,-26.4 -21,-28 0.6,-31.6 -6,-5.4 -20.2,4.2 -13.4,-3.6 -6.6,-9.6 -10.8,-15.8 -2.2,-14.4 9.2,-21.6 -0.4,-35 -10.2,-5.6 -18.6,2 -39,-21 2.2,-28.7 7.4,-18.8 23.8,-24.6 20,-20.6 8.4,-22.6 9.8,-13.4 -18,-8.4 -13,-17.8 -6.2,-24.6 z" />
                                    </g>

                                    <g class="model-green" id="Punjab" fill="#ffffd0" stroke="#d0c0a0"
                                        transform="translate(-27.1,-28.1)">

                                        <a id="state_Vehari" class="state" xlink:href="">
                                            <path id="Vehari" class="shape"
                                                d="m 1123.8,847.1 3.6,2.6 7.6,-1.2 27.6,33 6,-0.4 8,-25.2 17.2,-5.6 12.6,3.8 15.4,-13.8 12.6,-0.8 3,-28 -8.6,-12.4 -35.6,22.8 -6.8,-6.4 -18.2,7.2 -6.6,11.2 -13.2,-5.4 -9.8,11.8 -11.4,1 z" />
                                        </a>

                                        <a id="state_Toba_Tek_Singh" class="state" xlink:href="">
                                            <path id="Toba_Tek_Singh" class="shape"
                                                d="m 1219.8,762.3 -7.2,-3.4 2,-9.4 -5,-7.6 10,-12.8 -3.4,-8.4 9.4,-19.8 -4.8,-6.2 -16.2,10.8 -18.2,2.4 -23.2,36.8 8.4,12.8 -12.2,4.8 -5.2,13.8 40.8,-2 19.6,0.4 z" />
                                        </a>

                                        <a id="state_Sialkot" class="state" xlink:href="">
                                            <path id="Sialkot" class="shape"
                                                d="m 1381.6,541.9 3,-20.8 8.4,9.2 16.6,-11.4 -4.8,14 -1.6,14.4 6.4,12.4 12,-1.2 8,2.8 -6.8,9.2 -4,9.2 -8.6,8.4 1.4,8.4 -8.4,3 -3.4,8.2 -5.8,0.4 -6.8,-8.8 -9,-2.2 -11.6,-9.6 -3.8,-13.8 -3.8,-6.4 0,-11.4 13.2,-2.8 z" />
                                        </a>

                                        <a id="state_Shaikhupura" class="state" xlink:href="">
                                            <path id="Shaikhupura" class="shape"
                                                d="m 1368,660.3 -7.4,19.4 -9.8,10.6 -4.4,0.6 -1,-8.2 -6.6,-0.2 -0.8,-7 -22.6,-9.8 -2.8,-31.4 9.8,-10.2 8.2,-1 -2.4,11.2 25,-1.8 3.4,5.2 4.2,-6.6 18,-2.6 16,-15 -0.8,-5.4 5.8,-0.4 3.4,8 7.6,4.6 -19.4,22.8 -5.2,14.6 z" />
                                        </a>

                                        <a id="state_Sargodha" class="state" xlink:href="">
                                            <path id="Sargodha" class="shape"
                                                d="m 1221.4,636.9 11.4,-14.8 23.2,9.2 12.2,-22.2 -5.2,-14.2 -8.4,-1.4 -8.4,-10.2 3.4,-6.4 -6.2,-4.8 17.2,-9.6 0,-7.6 -60.6,15 -27.8,23 -11.6,53 13.4,4.4 -12.4,15.8 21.2,-10.6 10.8,-10.8 z" />
                                        </a>

                                        <a id="state_Sahiwal" class="state" xlink:href="">
                                            <path id="Sahiwal" class="shape"
                                                d="m 1266.6,781.3 9.8,3.8 -0.8,-16.6 2.6,-8.6 -7,-5.4 -4.8,-12.6 -38.6,22.8 -8,-2.4 -5.2,12.2 -19.6,-0.4 -6.8,21.4 -1.8,20 6.8,6.4 35.6,-22.8 19.4,-2 z" />
                                        </a>

                                        <a id="state_Rawalpindi" class="state" xlink:href="">
                                            <path id="Rawalpindi" class="shape"
                                                d="m 1278,390.2 13.2,-6 8.6,35.9 -3,8.6 6.2,11.2 -6.2,17.8 6.6,17.8 -17.6,8.4 -9.8,-2.2 -3.2,11 -18.2,3.8 -11.8,3.2 -13.8,-11.2 -30,-7.6 8.8,-18.2 17.6,-11.6 -7.8,-18.2 -9,-2.8 3.6,-6.6 -8.2,-9.6 5.8,-5.2 3.8,3.2 12,-3 -5.2,4.8 10.8,4.2 -11.8,3.6 6.4,13.8 18,-8.8 6.8,10.2 -3.8,3 6,4.8 11.2,-7.2 1.6,-9 7.8,-7.8 -3.2,-4.2 -2.8,0.2 -10.6,-7.8 16.6,-9.2 z" />
                                        </a>

                                        <a id="state_Rajanpur" class="state" xlink:href="">
                                            <path id="Rajanpur" class="shape"
                                                d="m 972.2,870.9 -17.8,-3.2 -10.4,21 3.4,27.4 -13,26.6 -9.2,10.8 1.6,20.4 -14.4,23.2 -6.6,1 5.8,23.4 36.8,-15.2 0,-19.6 14.4,2.8 17.4,-10.2 -4.4,-12.2 15.8,-2.8 7.4,-23.8 -5,-6.8 15,-30.8 1.6,-23.4 -11.6,-8.6 -14.6,18.2 z" />
                                        </a>

                                        <a id="state_Rahim_Yar_Khan" class="state" xlink:href="">
                                            <path id="Rahim_Yar_Khan" class="shape"
                                                d="m 1020.4,944.3 -3,11.8 -25.8,8.2 -15.8,2.8 4.4,12.2 -17.4,10.2 -14.4,-2.8 0,19.6 -36.8,15.2 11.6,16.8 6.2,24.6 13,17.8 18,8.4 16,-14.4 19.6,-1.2 11,12 3.2,13.2 5.4,9.6 12.8,1.2 35.8,-16.4 -27.2,-89.8 11,-53.8 -8.4,4 -5.4,-18.6 z" />
                                        </a>

                                        <a id="state_Pakpattan" class="state" xlink:href="">
                                            <path id="Pakpattan" class="shape"
                                                d="m 1266.6,781.3 -18.4,15.8 -19.4,2 8.6,12.4 -3,28 10.8,4.4 4.6,-8 30.2,-10 26.2,-18.4 -1,-20.6 -18.2,-11.8 -10.6,10 z" />
                                        </a>

                                        <a id="state_Okara" class="state" xlink:href="">
                                            <path id="Okara" class="shape"
                                                d="m 1278.2,759.9 -2.6,8.6 0.8,16.6 10.6,-10 18.2,11.8 1,20.6 21.2,-3.4 5.6,-11.2 10.8,-8.8 3.8,1.6 2.2,-10 13.2,-12.8 -14,-3.8 -10.8,-9.6 -12.6,-1.8 -17.8,-21.2 0,-10.8 -16.8,6 -12.4,11.8 -4.4,-0.4 -7.8,8.8 4.8,12.6 z" />
                                        </a>

                                        <a id="state_Narowal" class="state" xlink:href="">
                                            <path id="Narowal" class="shape"
                                                d="m 1422.8,570.5 6.8,-9.2 7.4,2.8 7.8,-5.2 7.8,8.2 6,-0.4 12.4,9.2 7,9.6 -14.8,20.4 -2.2,-4 -21.4,10.4 -6.6,-3.6 -13,13 -9.2,-1.4 -7.6,-4.6 -3.4,-8 3.4,-8.2 8.4,-3 -1.4,-8.4 8.6,-8.4 z" />
                                        </a>

                                        <a id="state_Nankana_Sahab" class="state" xlink:href="">
                                            <path id="Nankana_Sahab" class="shape"
                                                d="m 1285,665.1 8,20.8 8.6,-3.8 8.6,8.8 -4,10.2 -20.8,13.8 -10,9.6 -1.2,8.6 4.4,0.4 12.4,-11.8 16.8,-6 9.2,-5.4 12,-3 5.4,-5.6 9.6,-2.4 2.4,-8.4 -1,-8.2 -6.6,-0.2 -0.8,-7 -22.6,-9.8 -2.8,-31.4 -13.2,1.8 -8.6,6.2 -22.4,7.8 z" />
                                        </a>

                                        <a id="state_Muzaffargarh" class="state" xlink:href="">
                                            <path id="Muzaffargarh" class="shape"
                                                d="m 1010.6,879.5 -1.6,23.4 -15,30.8 5,6.8 -7.4,23.8 25.8,-8.2 3,-11.8 13.8,-9.4 13.8,-25 0.8,-24.8 13.4,-6.6 -1.6,-27 30,-54 -6.4,-2 8.6,-17.4 -33.4,-21 -7,12.8 -32.6,1.6 3.8,25 -4,24.4 6.4,33 z" />
                                        </a>

                                        <a id="state_Multan" class="state" xlink:href="">
                                            <path id="Multan" class="shape"
                                                d="m 1067.6,904.3 12.8,6.4 5.4,-41.2 21.8,-25.6 16.6,-27.6 -33.6,-18.8 -30,54 1.6,27 -13.4,6.6 -0.8,24.8 z" />
                                        </a>

                                        <a id="state_Mianwali" class="state" xlink:href="">
                                            <path id="Mianwali" class="shape"
                                                d="m 1127,556.1 -11.6,10.4 4,7.6 -9.2,12.8 1,10.8 -58.8,1 11,-21.8 10,-3.8 0.6,-18.8 -9.6,3.6 0.2,-10.6 -7.6,0 -6.4,-19 3.6,-19.6 12.8,-8 15.2,-1.6 2.2,-7.4 -6.2,-18.4 18.4,2.2 4.8,12.6 10.8,4.6 -3.6,12.8 10.8,-2.2 12,19.8 -6.8,9.8 z" />
                                        </a>

                                        <a id="state_Mandi_Bahauddin" class="state" xlink:href="">
                                            <path id="Mandi_Bahauddin" class="shape"
                                                d="m 1293.2,588.5 -9.6,13.2 -15.4,7.4 -5.2,-14.2 -8.4,-1.4 -8.4,-10.2 3.4,-6.4 -6.2,-4.8 17.2,-9.6 0,-7.6 9.2,-4.2 5.4,3 20,-12.8 3.4,-5.8 29.2,36 -17.6,9.6 z" />
                                        </a>

                                        <a id="state_Lodhran" class="state" xlink:href="">
                                            <path id="Lodhran" class="shape"
                                                d="m 1094.4,913.5 68.2,-32 -27.6,-33 -7.6,1.2 -3.6,-2.6 -16.2,-3.2 -21.8,25.6 -5.4,41.2 z" />
                                        </a>

                                        <a id="state_Layyah" class="state" xlink:href="">
                                            <path id="Layyah" class="shape"
                                                d="m 1120.6,739.5 -4.6,-28.6 -19.2,-8.2 -10.2,10.4 -14,1 -13.4,-21.6 -35.2,-7.6 -7.6,14.4 2.4,46.8 -4.2,9.2 5.2,16.2 32.6,-1.6 7,-12.8 33.4,21 3.6,6 6,-14 z" />
                                        </a>

                                        <a id="state_Lahore" class="state" xlink:href="">
                                            <path id="Lahore" class="shape"
                                                d="m 1346.4,690.9 4.4,-0.6 9.8,-10.6 7.4,-19.4 18.2,-2.6 5.2,-14.6 12.4,34 -9,19.6 -8.2,-2 -2.6,4.6 -18.2,6 -21.8,-6 z" />
                                        </a>

                                        <a id="state_Khushab" class="state" xlink:href="">
                                            <path id="Khushab" class="shape"
                                                d="m 1172.2,592.9 27.8,-23 -2,-15 -11.2,-13.2 -11.2,6.6 -24.6,-11.6 -4,8.4 -20,11 -11.6,10.4 4,7.6 -9.2,12.8 1,10.8 1.6,16 -14.6,19.8 13.2,21.2 24.6,18 16.8,-22.6 7.8,-4.2 z" />
                                        </a>

                                        <a id="state_Khanewal" class="state" xlink:href="">
                                            <path id="Khanewal" class="shape"
                                                d="m 1107.6,843.9 16.2,3.2 3.4,-5.8 11.4,-1 9.8,-11.8 13.2,5.4 6.6,-11.2 18.2,-7.2 1.8,-20 6.8,-21.4 -40.8,2 5.2,-13.8 -43.6,13.8 -13.4,-6 -6,14 -3.6,-6 -8.6,17.4 6.4,2 33.6,18.8 z" />
                                        </a>

                                        <a id="state_Kasur" class="state" xlink:href="">
                                            <path id="Kasur" class="shape"
                                                d="m 1344,699.3 21.8,6 18.2,-6 2.6,-4.6 8.2,2 -0.4,18.6 11.8,3 2.4,4.8 -4.8,5 -8.6,-4.8 -0.6,8.2 -18.2,12.2 -13.4,19.2 -14,-3.8 -10.8,-9.6 -12.6,-1.8 -17.8,-21.2 0,-10.8 9.2,-5.4 12,-3 5.4,-5.6 z" />
                                        </a>

                                        <a id="state_Jhelum" class="state" xlink:href="">
                                            <path id="Jhelum" class="shape"
                                                d="m 1252.8,539.3 10.2,-0.4 -4,-7.6 -10.2,-1.4 -1.2,-7 8.4,-10 -1.4,-16.4 18.2,-3.8 3.2,-11 9.8,2.2 17.6,-8.4 2.6,7 -3.2,7.2 17.6,9.8 -1,6.4 -19.2,20.8 -1.6,8.4 -3.4,5.8 -20,12.8 -5.4,-3 -9.2,4.2 -60.6,15 -2,-15 7,-4.2 3,5 5.8,-8 25,-4.8 5.4,1.4 z" />
                                        </a>

                                        <a id="state_Jhang" class="state" xlink:href="">
                                            <path id="Jhang" class="shape"
                                                d="m 1159.4,762.3 12.2,-4.8 -8.4,-12.8 23.2,-36.8 18.2,-2.4 16.2,-10.8 -1.2,-5.8 -8.8,4 -22.4,-14.8 -5.6,-22.6 -21.2,10.6 12.4,-15.8 -13.4,-4.4 -7.8,4.2 -16.8,22.6 -0.4,30 -10.6,-1.8 -9,10 4.6,28.6 -18.2,30.6 13.4,6 z" />
                                        </a>

                                        <a id="state_Hafizabad" class="state" xlink:href="">
                                            <path id="Hafizabad" class="shape"
                                                d="m 1290.8,642.3 -22.4,7.8 -8,-6.6 -4.4,-12.2 12.2,-22.2 15.4,-7.4 9.6,-13.2 17,-7.8 4.2,13.2 7.8,9.4 3.6,12 -3.4,8.8 -9.8,10.2 -13.2,1.8 z" />
                                        </a>

                                        <a id="state_Gujranwala" class="state" xlink:href="">
                                            <path id="Gujranwala" class="shape"
                                                d="m 1359,567.3 3.8,6.4 3.8,13.8 11.6,9.6 9,2.2 6.8,8.8 0.8,5.4 -16,15 -18,2.6 -4.2,6.6 -3.4,-5.2 -25,1.8 2.4,-11.2 -8.2,1 3.4,-8.8 -3.6,-12 -7.8,-9.4 -4.2,-13.2 17.6,-9.6 11,0.6 20.2,-15.8 z" />
                                        </a>

                                        <a id="state_Gujrat" class="state" xlink:href="">
                                            <path id="Gujrat" class="shape"
                                                d="m 1327.8,571.1 -29.2,-36 1.6,-8.4 19.2,-20.8 1,-6.4 11.6,-3 9,10 30.8,15 12.8,-0.4 -3,20.8 -9.4,11.2 -13.2,2.8 -20.2,15.8 z" />
                                        </a>

                                        <a id="state_Faisalabad" class="state" xlink:href="">
                                            <path id="Faisalabad" class="shape"
                                                d="m 1216.2,720.7 3.4,8.4 -10,12.8 5,7.6 -2,9.4 7.2,3.4 8,2.4 38.6,-22.8 7.8,-8.8 1.2,-8.6 10,-9.6 20.8,-13.8 4,-10.2 -8.6,-8.8 -8.6,3.8 -8,-20.8 -16.6,-15 -8,-6.6 -40.8,45.4 1.2,5.8 4.8,6.2 z" />
                                        </a>

                                        <a id="state_Dera_Ghazi_Khan" class="state" xlink:href="">
                                            <path id="Dera_Ghazi_Khan" class="shape"
                                                d="m 979,705.5 -13.4,6.4 0.6,10 -3,0.4 -1.2,23.4 2.2,6.2 -6.2,0.8 -12,13.2 1,9.2 -10.6,20.8 -4.2,17.4 3.6,7 9.6,-3.8 -7.6,15.2 -8.2,23.8 -15.6,22.8 -13.4,5.4 -4.2,26.8 10.6,3.4 -2.2,7 4.8,6.6 5.4,-3 -4.6,24 -21,21.8 3.8,10.8 -8.6,20.2 -11.2,6.4 5,12 9.6,-4.4 23.6,6.2 -5.8,-23.4 6.6,-1 14.4,-23.2 -1.6,-20.4 9.2,-10.8 13,-26.6 -3.4,-27.4 10.4,-21 17.8,3.2 12.2,18.2 14.6,-18.2 11.6,8.6 15.4,-25.6 -6.4,-33 4,-24.4 -3.8,-25 -5.2,-16.2 4.2,-9.2 -2.4,-46.8 -7.2,-6 -13.6,-1.6 z" />
                                        </a>

                                        <a id="state_Chiniot" class="state" xlink:href="">
                                            <path id="Chiniot" class="shape"
                                                d="m 1221.4,636.9 -27.8,7.8 -10.8,10.8 5.6,22.6 22.4,14.8 8.8,-4 40.8,-45.4 -4.4,-12.2 -23.2,-9.2 z" />
                                        </a>

                                        <a id="state_Chakwal" class="state" xlink:href="">
                                            <path id="Chakwal" class="shape"
                                                d="m 1184.2,490.5 -23.2,2 -5.2,-4 -6.4,5.6 -7.2,-2.6 -22.8,11.8 12,19.8 -6.8,9.8 2.4,23.2 20,-11 4,-8.4 24.6,11.6 11.2,-6.6 11.2,13.2 7,-4.2 3,5 5.8,-8 25,-4.8 5.4,1.4 8.6,-5 10.2,-0.4 -4,-7.6 -10.2,-1.4 -1.2,-7 8.4,-10 -1.4,-16.4 -11.8,3.2 -13.8,-11.2 -30,-7.6 -6.6,-1.6 z" />
                                        </a>

                                        <a id="state_Bhakkar" class="state" xlink:href="">
                                            <path id="Bhakkar" class="shape"
                                                d="m 1135.6,702.7 0.4,-30 -24.6,-18 -13.2,-21.2 14.6,-19.8 -1.6,-16 -58.8,1 -9.8,30.6 -15.8,23.2 -4.4,16.6 6,1 -4.4,14.8 35.2,7.6 13.4,21.6 14,-1 10.2,-10.4 19.2,8.2 9,-10 z" />
                                        </a>

                                        <a id="state_Bahawalpur" class="state" xlink:href="">
                                            <path id="Bahawalpur" class="shape"
                                                d="m 1168.6,881.1 -6,0.4 -68.2,32 -14,-2.8 -12.8,-6.4 -19.6,5.6 -13.8,25 5.4,18.6 8.4,-4 -11,53.8 27.2,89.8 50.2,-7 15.4,-6.2 2.2,-17.4 26.2,-28 11.8,-35.2 9.4,-12.8 20.8,-11.6 -8,-25.8 -12.6,0 -3.6,-12.6 6,-5.8 39.8,0 4.2,-13.8 -12,-7 8.4,-27.2 -15.8,-17 -0.2,-11.6 -12.6,-3.8 -17.2,5.6 z" />
                                        </a>

                                        <a id="state_Bahawalnagar" class="state" xlink:href="">
                                            <path id="Bahawalnagar" class="shape"
                                                d="m 1280,825.9 -30.2,10 -4.6,8 -10.8,-4.4 -12.6,0.8 -15.4,13.8 0.2,11.6 15.8,17 -8.4,27.2 12,7 -4.2,13.8 -39.8,0 -6,5.8 3.6,12.6 12.6,0 8,25.8 34.6,-19.6 30.8,-55.2 13.8,-47.4 40.8,-15.2 16.2,-13.8 -2.2,-13.2 -6.8,-6.4 -21.2,3.4 z" />
                                        </a>

                                        <a id="state_Attock" class="state" xlink:href="">
                                            <path id="Attock" class="shape"
                                                d="m 1207.8,462.7 -8.8,18.2 -6.6,-1.6 -8.2,11.2 -23.2,2 -5.2,-4 -6.4,5.6 -7.2,-2.6 -22.8,11.8 -10.8,2.2 3.6,-12.8 4.2,-12.8 -5.6,-10.4 2.4,-9.4 14,-6.4 9.2,-14 7.8,-25.2 21,-2.2 0,-18.7 20.4,-9.4 17.2,9.4 -2.6,5.4 7.2,2.5 7,-7.3 8.6,5.8 2.6,8.9 -12,3 -3.8,-3.2 -5.8,5.2 8.2,9.6 -3.6,6.6 9,2.8 7.8,18.2 z" />
                                        </a>

                                        <path id="Punjab_Border" fill="none" stroke="#a08070"
                                            d="m 1303,439.9 -6.2,-11.2 3,-8.6 -8.6,-35.9 -13.2,6 -4.6,9.3 -16.6,9.2 10.6,7.8 2.8,-0.2 3.2,4.2 -7.8,7.8 -1.6,9 -11.2,7.2 -6,-4.8 3.8,-3 -6.8,-10.2 -18,8.8 -6.4,-13.8 11.8,-3.6 -10.8,-4.2 5.2,-4.8 -2.6,-8.9 -8.6,-5.8 -7,7.3 -7.2,-2.5 2.6,-5.4 -17.2,-9.4 -20.4,9.4 0,18.7 -21,2.2 -7.8,25.2 -9.2,14 -14,6.4 -2.4,9.4 5.6,10.4 -4.2,12.8 -10.8,-4.6 -4.8,-12.6 -18.4,-2.2 6.2,18.4 -2.2,7.4 -15.2,1.6 -12.8,8 -3.6,19.6 6.4,19 7.6,0 -0.2,10.6 9.6,-3.6 -0.6,18.8 -10,3.8 -11,21.8 -9.8,30.6 -15.8,23.2 -4.4,16.6 6,1 -4.4,14.8 -7.6,14.4 -7.2,-6 -13.6,-1.6 -16.6,13.8 -13.4,6.4 0.6,10 -3,0.4 -1.2,23.4 2.2,6.2 -6.2,0.8 -12,13.2 1,9.2 -10.6,20.8 -4.2,17.4 3.6,7 9.6,-3.8 -7.6,15.2 -8.2,23.8 -15.6,22.8 -13.4,5.4 -4.2,26.8 10.6,3.4 -2.2,7 4.8,6.6 5.4,-3 -4.6,24 -21,21.8 3.8,10.8 -8.6,20.2 -11.2,6.4 5,12 9.6,-4.4 23.6,6.2 11.6,16.8 6.2,24.6 13,17.8 18,8.4 16,-14.4 19.6,-1.2 11,12 3.2,13.2 5.4,9.6 12.8,1.2 35.8,-16.4 50.2,-7 15.4,-6.2 2.2,-17.4 26.2,-28 11.8,-35.2 9.4,-12.8 20.8,-11.6 34.6,-19.6 30.8,-55.2 13.8,-47.4 40.8,-15.2 16.2,-13.8 -2.2,-13.2 -6.8,-6.4 5.6,-11.2 10.8,-8.8 3.8,1.6 2.2,-10 13.2,-12.8 13.4,-19.2 18.2,-12.2 0.6,-8.2 8.6,4.8 4.8,-5 -2.4,-4.8 -11.8,-3 0.4,-18.6 9,-19.6 -12.4,-34 19.4,-22.8 9.2,1.4 13,-13 6.6,3.6 21.4,-10.4 2.2,4 14.8,-20.4 -7,-9.6 -12.4,-9.2 -6,0.4 -7.8,-8.2 -7.8,5.2 -7.4,-2.8 -8,-2.8 -12,1.2 -6.4,-12.4 1.6,-14.4 4.8,-14 -16.6,11.4 -8.4,-9.2 -12.8,0.4 -30.8,-15 -9,-10 -11.6,3 -17.6,-9.8 3.2,-7.2 -2.6,-7 -6.6,-17.8 z" />
                                    </g>


                                    <g class="model-green" id="Khyber Pakhtunkhwa" fill="#ffffd0" stroke="#d0c0a0"
                                        transform="translate(-27.1,-28.1)">

                                        <a id="state_Upper_Dir" class="state" xlink:href="">
                                            <path id="Upper_Dir" class="shape"
                                                d="m 1093.4,260.2 1.8,8 31.2,-3.6 12.4,19.6 12.6,0.2 17.6,-40 6.2,-29 -14.6,-24 1,-4.2 -8,-2.8 -46.4,63.6 z" />
                                        </a>

                                        <a id="state_Tank" class="state" xlink:href="">
                                            <path id="Tank" class="shape"
                                                d="m 951.2,614.5 -5,-21.4 30.2,-21 9.4,-14.4 10,6 2.6,-6.2 13,11.4 -3.8,17.2 -13.6,18.8 -36,13 z" />
                                        </a>

                                        <a id="state_Swat" class="state" xlink:href="">
                                            <path id="Swat" class="shape"
                                                d="m 1169,244.4 -17.6,40 7.8,13 -7.4,9.6 2.6,10.2 7,0 27.8,-15.4 6.6,-33.4 12.8,-19.4 7,-19.8 -4.6,-6.4 11.4,-50.8 -15.4,4.4 -15.8,-9.4 -13.2,19.2 -16.4,1 -1,4.2 14.6,24 z" />
                                        </a>

                                        <a id="state_Swabi" class="state" xlink:href="">
                                            <path id="Swabi" class="shape"
                                                d="m 1165.2,393.6 20.4,-9.4 32.4,-24.2 -7.8,-18 -17,17.6 -12,-3.6 8,-16.2 -7,-2.2 -10.2,14.6 -9.8,2.6 -1.8,16.8 z" />
                                        </a>

                                        <a id="state_Shangla" class="state" xlink:href="">
                                            <path id="Shangla" class="shape"
                                                d="m 1217.8,269.4 -9.2,-20.4 -12.8,19.4 -6.6,33.4 7.6,7.2 11,-5.8 3.2,16.2 8,-6 -2.2,-9 3.6,-14.2 5.2,3.2 4.6,-15.6 -3.6,-9.4 z" />
                                        </a>

                                        <a id="state_Peshawar" class="state" xlink:href="">
                                            <path id="Peshawar" class="shape"
                                                d="m 1089,406.1 0.2,9 9.4,3 10.6,-3.8 4.2,-7.2 3.4,-14.9 -5.4,-17.2 -25.6,-12.4 -9.8,13 5,25.9 z" />
                                        </a>

                                        <a id="state_Nowshera" class="state" xlink:href="">
                                            <path id="Nowshera" class="shape"
                                                d="m 1165.2,393.6 -4.8,-22 -7.2,2.8 -20.8,-5.6 -6.4,12.8 -14.6,-6.6 5.4,17.2 -3.4,14.9 10.2,6.8 1.4,4.2 19.2,-3.6 21,-2.2 z" />
                                        </a>

                                        <a id="state_Mardan" class="state" xlink:href="">
                                            <path id="Mardan" class="shape"
                                                d="m 1121.8,350.4 10.6,18.4 20.8,5.6 7.2,-2.8 1.8,-16.8 9.8,-2.6 10.2,-14.6 -18.8,-6 -2.4,-7.2 -21.2,1.8 -15.6,15.8 z" />
                                        </a>

                                        <a id="state_Mansehra" class="state" xlink:href="">
                                            <path id="Mansehra" class="shape"
                                                d="m 1225.6,293.4 -5.2,-3.2 -3.6,14.2 2.2,9 -8,6 -3,7 5,9.2 12.4,4.6 11,10 20.2,-3.4 15.8,-16 11,-2 3,-9 16.6,1 9,-23.4 25.4,-11 11.4,-18.6 -2.8,-4.2 6.6,-7.4 -21.2,-9.4 -16,14.2 -20.4,2.8 -10.2,11.6 -12,22.8 -14.2,-6 -12,18.4 -17.2,0.4 z" />
                                        </a>

                                        <a id="state_Malakand" class="state" xlink:href="">
                                            <path id="Malakand" class="shape"
                                                d="m 1107.6,333.2 -5,-8.8 3.8,-10 8.6,-5 36.8,-2.4 2.6,10.2 7,0 -0.4,7.2 -21.2,1.8 -15.6,15.8 z" />
                                        </a>

                                        <a id="state_Lower_Dir" class="state" xlink:href="">
                                            <path id="Lower_Dir" class="shape"
                                                d="m 1151.4,284.4 -12.6,-0.2 -12.4,-19.6 -31.2,3.6 -5.4,6.4 10,17 15.6,4.2 -0.4,13.6 36.8,-2.4 7.4,-9.6 z" />
                                        </a>

                                        <a id="state_Lakki_Marwat" class="state" xlink:href="">
                                            <path id="Lakki_Marwat" class="shape"
                                                d="m 986.4,544.3 12,13.2 13,11.4 -3.8,17.2 56.8,-28.2 0.2,-10.6 -7.6,0 -6.4,-19 -15.8,-10.8 -18.4,10.8 -17.8,-5.2 -19.6,13.2 z" />
                                        </a>

                                        <a id="state_Kohistan" class="state" xlink:href="">
                                            <path id="Kohistan" class="shape"
                                                d="m 1215.6,229.2 -7,19.8 9.2,20.4 8.8,-1 3.6,9.4 12,-7 42.6,4.6 10.2,-11.6 20.4,-2.8 16,-14.2 -18.6,-1.6 -3,-11.2 1.4,-11.4 9.4,-10 -53,-13 -16,-14 0.6,-11.6 -4.8,-3 -9.8,3.6 -15.2,-2.6 -11.4,50.8 z" />
                                        </a>

                                        <a id="state_Kohat" class="state" xlink:href="">
                                            <path id="Kohat" class="shape"
                                                d="m 1050.2,418.1 -2.4,15.8 16.6,2.6 -14,23.4 27.8,13.4 18.4,2.2 4.8,12.6 10.8,4.6 4.2,-12.8 -5.6,-10.4 2.4,-9.4 14,-6.4 9.2,-14 7.8,-25.2 -19.2,3.6 -5,5 2,6 -13.8,11.2 -8,0.8 -3,-5.4 4.2,-4.8 -18.4,-3.6 -10.2,1.8 -16.6,-11.6 z" />
                                        </a>

                                        <a id="state_Karak" class="state" xlink:href="">
                                            <path id="Karak" class="shape"
                                                d="m 1029,464.1 -16.6,9.4 13.2,5.2 -15.8,16.4 20.6,5.8 4.4,16.6 15.8,10.8 3.6,-19.6 12.8,-8 15.2,-1.6 2.2,-7.4 -6.2,-18.4 -27.8,-13.4 z" />
                                        </a>

                                        <a id="state_Haripur" class="state" xlink:href="">
                                            <path id="Haripur" class="shape"
                                                d="m 1185.6,384.2 17.2,9.4 -2.6,5.4 7.2,2.5 7,-7.3 8.6,5.8 2.6,8.9 -5.2,4.8 10.8,4.2 25.6,-9.2 3,-19.5 -8.8,-3.8 4.6,-14.4 -9.4,0 1,-6.6 -10.8,-14.2 -11,-10 -12.4,-4.6 -2.8,6.4 7.8,18 z" />
                                        </a>

                                        <a id="state_Hangu" class="state" xlink:href="">
                                            <path id="Hangu" class="shape"
                                                d="m 1029,464.1 -16.6,9.4 -10.8,-4.2 -4.8,-5.8 -9.2,-11.2 23.4,-8.2 3.2,-10 17,2.8 16.6,-3 16.6,2.6 -14,23.4 z" />
                                        </a>

                                        <a id="state_Dera_Ismail_Khan" class="state" xlink:href="">
                                            <path id="Dera_Ismail_Khan" class="shape"
                                                d="m 1016.4,699.3 7.6,-14.4 4.4,-14.8 -6,-1 4.4,-16.6 15.8,-23.2 9.8,-30.6 11,-21.8 10,-3.8 0.6,-18.8 -9.6,3.6 -56.8,28.2 -13.6,18.8 -36,13 2.6,27.2 18.4,60.4 16.6,-13.8 13.6,1.6 z" />
                                        </a>

                                        <a id="state_Chitral" class="state" xlink:href="">
                                            <path id="Chitral" class="shape"
                                                d="m 1130.6,97.4 2.8,-6.4 16,-4.2 0.6,-5.8 11.2,-2 -1.8,-3.2 4.6,-7 25.4,-2.8 14.2,-8.2 28.6,0.4 4.4,-3.2 5.8,1.6 11.8,-4 21.2,1.6 28.6,-2.6 8.4,8.2 12.8,5.4 -0.6,9 -26.2,0 -21.4,-4.8 -32.4,8.6 2.6,7.8 -11.6,15.6 -7.4,1.4 -2.8,8.6 -30.8,18.4 -2.6,17.4 4.4,7.4 -5.2,12.4 -13.2,19.2 -16.4,1 -8,-2.8 -46.4,63.6 -12,-11.6 9.4,-18 -5.4,-5.2 1.8,-8.6 -11.2,-6.2 4.6,-10.8 -6.6,-4.8 -1.2,-8.4 -9.2,-13.6 -17.4,-9.4 4.4,-10 31.4,-23.4 0.2,-5.8 8.6,-12.2 19.6,11.4 1.8,-5.2 -4.4,-1.6 1.4,-7.2 z" />
                                        </a>

                                        <a id="state_Charsadda" class="state" xlink:href="">
                                            <path id="Charsadda" class="shape"
                                                d="m 1107.6,333.2 16.6,8.8 -2.4,8.4 10.6,18.4 -6.4,12.8 -14.6,-6.6 -25.6,-12.4 z" />
                                        </a>

                                        <a id="state_Buner" class="state" xlink:href="">
                                            <path id="Buner" class="shape"
                                                d="m 1196.8,309 11,-5.8 3.2,16.2 -3,7 5,9.2 -2.8,6.4 -17,17.6 -12,-3.6 8,-16.2 -7,-2.2 -18.8,-6 -2.4,-7.2 0.4,-7.2 27.8,-15.4 z" />
                                        </a>

                                        <a id="state_Battagram" class="state" xlink:href="">
                                            <path id="Battagram" class="shape"
                                                d="m 1242.2,270.8 42.6,4.6 -12,22.8 -14.2,-6 -12,18.4 -17.2,0.4 -3.8,-17.6 4.6,-15.6 z" />
                                        </a>

                                        <a id="state_Bannu" class="state" xlink:href="">
                                            <path id="Bannu" class="shape"
                                                d="m 976.4,521.3 2.6,15 19.6,-13.2 17.8,5.2 18.4,-10.8 -4.4,-16.6 -20.6,-5.8 -17.2,-0.8 z" />
                                        </a>

                                        <a id="state_Abbotabad" class="state" xlink:href="">
                                            <path id="Abbotabad" class="shape"
                                                d="m 1291.2,384.2 -11.4,-44.6 3.6,-10.8 -11,2 -15.8,16 -20.2,3.4 10.8,14.2 -1,6.6 9.4,0 -4.6,14.4 8.8,3.8 -3,19.5 16.6,-9.2 4.6,-9.3 z" />
                                        </a>

                                        <path id="Khyber_Pakhtunkhwah_Border" fill="none" stroke="#a08070"
                                            d="m 1244.6,78 32.4,-8.6 21.4,4.8 26.2,0 0.6,-9 -12.8,-5.4 -8.4,-8.2 -28.6,2.6 -21.2,-1.6 -11.8,4 -5.8,-1.6 -4.4,3.2 -28.6,-0.4 -14.2,8.2 -25.4,2.8 -4.6,7 1.8,3.2 -11.2,2 -0.6,5.8 -16,4.2 -2.8,6.4 -7.6,0 -1.4,7.2 4.4,1.6 -1.8,5.2 -19.6,-11.4 -8.6,12.2 -0.2,5.8 -31.4,23.4 -4.4,10 17.4,9.4 9.2,13.6 1.2,8.4 6.6,4.8 -4.6,10.8 11.2,6.2 -1.8,8.6 5.4,5.2 -9.4,18 12,11.6 -13.8,12.2 1.8,8 -5.4,6.4 10,17 15.6,4.2 -0.4,13.6 -8.6,5 -3.8,10 5,8.8 -21.8,29.4 -9.8,13 5,25.9 8,4.6 0.2,9 9.4,3 10.6,-3.8 4.2,-7.2 10.2,6.8 1.4,4.2 -5,5 2,6 -13.8,11.2 -8,0.8 -3,-5.4 4.2,-4.8 -18.4,-3.6 -10.2,1.8 -16.6,-11.6 -6,0.6 -2.4,15.8 -16.6,3 -17,-2.8 -3.2,10 -23.4,8.2 14,17 10.8,4.2 13.2,5.2 -15.8,16.4 -17.2,-0.8 -16.2,27 2.6,15 7.4,8 12,13.2 -2.6,6.2 -10,-6 -9.4,14.4 -30.2,21 5,21.4 6.8,3.4 2.6,27.2 18.4,60.4 16.6,-13.8 13.6,1.6 7.2,6 7.6,-14.4 4.4,-14.8 -6,-1 4.4,-16.6 15.8,-23.2 9.8,-30.6 11,-21.8 10,-3.8 0.6,-18.8 -9.6,3.6 0.2,-10.6 -7.6,0 -6.4,-19 3.6,-19.6 12.8,-8 15.2,-1.6 2.2,-7.4 -6.2,-18.4 18.4,2.2 4.8,12.6 10.8,4.6 4.2,-12.8 -5.6,-10.4 2.4,-9.4 14,-6.4 9.2,-14 7.8,-25.2 21,-2.2 0,-18.7 20.4,-9.4 17.2,9.4 -2.6,5.4 7.2,2.5 7,-7.3 8.6,5.8 2.6,8.9 -5.2,4.8 10.8,4.2 25.6,-9.2 16.6,-9.2 4.6,-9.3 13.2,-6 -11.4,-44.6 3.6,-10.8 3,-9 16.6,1 9,-23.4 25.4,-11 11.4,-18.6 -2.8,-4.2 6.6,-7.4 -21.2,-9.4 -18.6,-1.6 -3,-11.2 1.4,-11.4 9.4,-10 -53,-13 -16,-14 0.6,-11.6 -4.8,-3 -9.8,3.6 -15.2,-2.6 -15.4,4.4 -15.8,-9.4 5.2,-12.4 -4.4,-7.4 2.6,-17.4 30.8,-18.4 2.8,-8.6 7.4,-1.4 11.6,-15.6 z" />
                                    </g>

                                    <g class="model-green" id="FATA" fill="#ffffd0" stroke="#d0c0a0"
                                        transform="translate(-27.1,-28.1)">

                                        <a id="state_FR_Tank" class="state" xlink:href="">
                                            <path id="FR_Tank" class="shape"
                                                d="m 946.2,593.1 -2,-34.2 24.8,-8.8 17.4,-5.8 12,13.2 -2.6,6.2 -10,-6 -9.4,14.4 z" />
                                        </a>

                                        <a id="state_FR_Peshawar" class="state" xlink:href="">
                                            <path id="FR_Peshawar" class="shape"
                                                d="m 1120,423.1 5,-5 -1.4,-4.2 -10.2,-6.8 -4.2,7.2 -10.6,3.8 23.4,11 z" />
                                        </a>

                                        <a id="state_FR_Lakki" class="state" xlink:href="">
                                            <path id="FR_Lakki" class="shape"
                                                d="m 986.4,544.3 -7.4,-8 -2.6,-15 -13.6,16.2 6.2,12.6 z" />
                                        </a>

                                        <a id="state_FR_Kohat" class="state" xlink:href="">
                                            <path id="FR_Kohat" class="shape"
                                                d="m 1098.6,418.1 23.4,11 -13.8,11.2 -8,0.8 -3,-5.4 4.2,-4.8 -18.4,-3.6 6.2,-12.2 z" />
                                        </a>

                                        <a id="state_FR_D_I_Khan" class="state" xlink:href="">
                                            <path id="FR_D_I_Khan" class="shape"
                                                d="m 951.2,614.5 6.8,3.4 2.6,27.2 18.4,60.4 -13.4,6.4 0.6,10 -3,0.4 -2.4,-5 4,-24.8 -1.4,-17 -16.6,8 -5.6,9.8 -2.6,-16.8 -8.6,-5.2 2.4,-43.8 -7.6,5.2 -3,-3.2 3.8,-8.2 7.6,-3.4 9.8,5 z" />
                                        </a>

                                        <a id="state_FR_Bannu" class="state" xlink:href="">
                                            <path id="FR_Bannu" class="shape"
                                                d="m 992.6,494.3 17.2,0.8 15.8,-16.4 -13.2,-5.2 -10.8,-4.2 -22.8,21.4 -18.6,27.2 2.6,19.6 13.6,-16.2 z" />
                                        </a>

                                        <a id="state_South_Waziristan" class="state" xlink:href="">
                                            <path id="South_Waziristan" class="shape"
                                                d="m 890.4,557.3 13.4,-3.4 1.6,-9.6 22.4,0 35,-6.8 6.2,12.6 -24.8,8.8 2,34.2 5,21.4 -8.2,8.4 -9.8,-5 -7.6,3.4 -7.2,-4.6 3,-9.6 -16.8,4.6 -10.6,11.6 -21.8,-1 -4.6,-19.2 0.8,-27.6 -4.8,-11 4.8,-10.2 10,-4 z" />
                                        </a>

                                        <a id="state_Orakzai" class="state" xlink:href="">
                                            <path id="Orakzai" class="shape"
                                                d="m 1089.2,415.1 -6.2,12.2 -10.2,1.8 -16.6,-11.6 -6,0.6 -2.4,15.8 -16.6,3 -17,-2.8 -17,-18.2 13.2,4.4 36.6,-19.3 23.2,14.1 z" />
                                        </a>

                                        <a id="state_North_Waziristan" class="state" xlink:href="">
                                            <path id="North_Waziristan" class="shape"
                                                d="m 972.4,461.3 24.4,2.2 4.8,5.8 -22.8,21.4 -18.6,27.2 2.6,19.6 -35,6.8 -22.4,0 -1.6,9.6 -13.4,3.4 -12,-7 6.4,-11 -5.8,-11.4 7.2,-9.8 7,-2.4 -4.2,-8.6 1.6,-10 7.2,-7.8 14.2,0.4 6.4,-3.8 9,3.6 14.6,-5.4 4.6,-8.2 8.8,-0.8 z" />
                                        </a>

                                        <a id="state_Mohmand" class="state" xlink:href="">
                                            <path id="Mohmand" class="shape"
                                                d="m 1048.4,317.6 2.8,-13.8 12.6,11 18.4,-5.4 7,18.4 13.4,-3.4 5,8.8 -21.8,29.4 -9.8,13 -24,-19.4 4.8,-12.4 -9.2,-3.8 -7.2,-7.4 -0.2,-12.2 z" />
                                        </a>

                                        <a id="state_Kurram" class="state" xlink:href="">
                                            <path id="Kurram" class="shape"
                                                d="m 940.4,416.1 -14.6,-23.8 3.8,-9.9 11.4,-2.4 22.6,8.6 15.4,2.4 18.2,24.9 17,18.2 -3.2,10 -23.4,8.2 9.2,11.2 -24.4,-2.2 -3.8,-10.4 -11.4,-10.8 1.6,-13.2 -6.6,-9.4 z" />
                                        </a>

                                        <a id="state_Khyber" class="state" xlink:href="">
                                            <path id="Khyber" class="shape"
                                                d="m 1076,375.6 5,25.9 8,4.6 0.2,9 -19,0 -23.2,-14.1 -36.6,19.3 -13.2,-4.4 -18.2,-24.9 37.6,-0.2 29.8,-11.2 6,-12.8 -0.4,-10.6 z" />
                                        </a>

                                        <a id="state_Bajur" class="state" xlink:href="">
                                            <path id="Bajur" class="shape"
                                                d="m 1061.6,299.6 -10.4,4.2 12.6,11 18.4,-5.4 7,18.4 13.4,-3.4 3.8,-10 8.6,-5 0.4,-13.6 -15.6,-4.2 -10,-17 -18.8,10.2 z" />
                                        </a>

                                        <path id="FATA_Border" fill="none" stroke="#a08070"
                                            d="m 1040.2,320.4 0.2,12.2 7.2,7.4 9.2,3.8 -4.8,12.4 0.4,10.6 -6,12.8 -29.8,11.2 -37.6,0.2 -15.4,-2.4 -22.6,-8.6 -11.4,2.4 -3.8,9.9 14.6,23.8 11.8,1.4 6.6,9.4 -1.6,13.2 11.4,10.8 3.8,10.4 -17,13.8 -8.8,0.8 -4.6,8.2 -14.6,5.4 -9,-3.6 -6.4,3.8 -14.2,-0.4 -7.2,7.8 -1.6,10 4.2,8.6 -7,2.4 -7.2,9.8 5.8,11.4 -6.4,11 -10,4 -4.8,10.2 4.8,11 -0.8,27.6 4.6,19.2 21.8,1 10.6,-11.6 16.8,-4.6 -3,9.6 7.2,4.6 -3.8,8.2 3,3.2 7.6,-5.2 -2.4,43.8 8.6,5.2 2.6,16.8 5.6,-9.8 16.6,-8 1.4,17 -4,24.8 2.4,5 3,-0.4 -0.6,-10 13.4,-6.4 -18.4,-60.4 -2.6,-27.2 -6.8,-3.4 -5,-21.4 30.2,-21 9.4,-14.4 10,6 2.6,-6.2 -12,-13.2 -7.4,-8 -2.6,-15 16.2,-27 17.2,0.8 15.8,-16.4 -13.2,-5.2 -10.8,-4.2 -4.8,-5.8 -9.2,-11.2 23.4,-8.2 3.2,-10 17,2.8 16.6,-3 2.4,-15.8 6,-0.6 16.6,11.6 10.2,-1.8 18.4,3.6 -4.2,4.8 3,5.4 8,-0.8 13.8,-11.2 -2,-6 5,-5 -1.4,-4.2 -10.2,-6.8 -4.2,7.2 -10.6,3.8 -9.4,-3 -0.2,-9 -8,-4.6 -5,-25.9 9.8,-13 21.8,-29.4 -5,-8.8 3.8,-10 8.6,-5 0.4,-13.6 -15.6,-4.2 -10,-17 -18.8,10.2 -9.4,14.8 -10.4,4.2 -2.8,13.8 z" />
                                    </g>

                                    <g class="model-green" id="AJK" fill="#ffffd0" stroke="#d0c0a0"
                                        transform="translate(-27.1,-28.1)">

                                        <a id="state_Muzaffarabad" class="state" xlink:href="">
                                            <path id="Muzaffarabad" class="shape"
                                                d="m 1286.4,319.8 -6.6,19.8 8.1358,31.8294 21.1872,5.4008 -7.8683,-19.2999 10.0832,2.6783 4.8684,-15.9273 0.3937,-7.4813 0.1419,-14.4456 L 1303,320.8 z" />
                                        </a>

                                        <a id="state_Hattian" class="state" xlink:href="">
                                            <path id="Hattian" class="shape"
                                                d="m 1309.123,376.8302 18.077,1.9698 9.8,-21.2 -8.2,-14.4 -5.8,2.4 -6.7937,-1.3187 -4.8684,15.9273 -10.0832,-2.6783 z" />
                                        </a>

                                        <a id="state_Poonch" class="state" xlink:href="">
                                            <path id="Poonch" class="shape"
                                                d="m 1294.4634,397.8229 2.0898,8.7238 10.0396,-4.0808 27.8072,14.2341 11.2,-11.6 -9.0542,-12.7521 -9.1935,0.5952 -10.6763,5.6541 -13.126,-12.6107 z" />
                                        </a>

                                        <a id="state_Sudhnati" class="state" xlink:href="">
                                            <path id="Sudhnati" class="shape"
                                                d="m 1296.5532,406.5467 3.2468,13.5533 13.9104,12.7197 27.8896,0.6803 -7.2,-16.8 -27.8072,-14.2341 z" />
                                        </a>

                                        <a id="state_Kotli" class="state" xlink:href="">
                                            <path id="Kotli" class="shape"
                                                d="m 1299.8,420.1 -3,8.6 6.2,11.2 -2.4779,7.114 10.8158,-1.3981 17.2007,27.3779 L 1340,472.1 l 15.8,-12.4 1.6,-14 -9.8,-12.2 -6,0 -27.8896,-0.6803 z" />
                                        </a>

                                        <a id="state_Mirpur" class="state" xlink:href="">
                                            <path id="Mirpur" class="shape"
                                                d="m 1300.5221,447.014 -3.7221,10.686 9.2,24.8 -3.2,7.2 17.6,9.8 8.1386,-26.5062 -16.9042,-27.6755 z" />
                                        </a>

                                        <a id="state_Bhimber" class="state" xlink:href="">
                                            <path id="Bhimber" class="shape"
                                                d="M 1328.5386,472.9938 1320.4,499.5 l 11.6,-3 9,10 30.8,15 12.8,-0.4 -3.8,-10 -10.2,-2.4 2.8,-11.4 -14,-2.8 -19.4,-22.4 z" />
                                        </a>

                                        <a id="state_Neelum" class="state" xlink:href="">
                                            <path id="Neelum" class="shape"
                                                d="m 1303,320.8 13.7419,1.5544 -0.1419,14.4456 12,-9.2 -0.2,-5.8 5.2,-3.2 1.2,-14 19,0 15.8,-12 27.2,3.4 9.2,8 23.2,2 11.6,4.8 20.6,-0.8 4.4,-6.8 -2.6,-11.4 -10.2,-9.8 -5.6,8.6 -5.6,-2.6 -7,6.4 -33.8,-15.2 -4,-16 -9.2,-9.8 -24.6,8.4 -10.6,-5.6 -6.6,7.4 2.8,4.2 -11.4,18.6 -25.4,11 z" />
                                        </a>

                                        <a id="state_Haveli" class="state" xlink:href="">
                                            <path id="Haveli" class="shape"
                                                d="m 1327.2,378.8 33.2,1.4 4.6,13 -9.2,9.8 -10.2,2.1 -9.0542,-12.7521 z" />
                                        </a>

                                        <a id="state_Bagh" class="state" xlink:href="">
                                            <path id="Bagh" class="shape"
                                                d="m 1327.2,378.8 -18.077,-1.9698 -21.1872,-5.4008 6.5276,26.3935 9.0866,-11.8364 13.126,12.6107 10.6763,-5.6541 9.1935,-0.5952 z" />
                                        </a>

                                        <path id="AJK_Border" fill="none" stroke="#a08070"
                                            d="m 1296.8,457.7 6.6,17.8 2.6,7 -3.2,7.2 17.6,9.8 11.6,-3 9,10 30.8,15 12.8,-0.4 -3.8,-10 -10.2,-2.4 2.8,-11.4 -14,-2.8 -19.4,-22.4 15.8,-12.4 1.6,-14 -9.8,-12.2 -6,0 -7.2,-16.8 11.2,-11.6 10.2,-2.1 9.2,-9.8 -4.6,-13 -33.2,-1.4 9.8,-21.2 -8.2,-14.4 -5.8,2.4 -6.8,-1.2 0.4,-7.6 12,-9.2 -0.2,-5.8 5.2,-3.2 1.2,-14 19,0 15.8,-12 27.2,3.4 9.2,8 23.2,2 11.6,4.8 20.6,-0.8 4.4,-6.8 -2.6,-11.4 -10.2,-9.8 -5.6,8.6 -5.6,-2.6 -7,6.4 -33.8,-15.2 -4,-16 -9.2,-9.8 -24.6,8.4 -10.6,-5.6 -6.6,7.4 2.8,4.2 -11.4,18.6 -25.4,11 -9,23.4 -16.6,-1 -3,9 -3.6,10.8 11.4,44.6 8.6,35.9 -3,8.6 6.2,11.2 z" />
                                    </g>

                                    <g class="model-green" id="Gilgit-Baltistan" fill="#ffffd0" stroke="#d0c0a0"
                                        transform="translate(-27.1,-28.1)">

                                        <a id="state_Ghizer" class="state" xlink:href="">
                                            <path id="Ghizer" class="shape"
                                                d="m 1349.3534,106.34004 -4.7964,20.57918 8.5935,11.78808 -3.5973,20.37939 -14.389,14.18565 -45.3655,-2.59737 -19.8674,-6.52955 L 1252.2,174 l -4.8,-2.8 -9.8,3.4 -15.2,-2.6 -15.4,4.4 -15.8,-9.4 5.2,-12.4 -4.4,-7.4 2.6,-17.4 30.8,-18.4 2.8,-8.6 7.4,-1.4 11.5594,-15.72187 L 1244.6,78 l 32.4,-8.6 21.4,4.8 26.2,0 0.6,-9 -12.8,-5.4 -8.4,-8.2 19.2,-0.4 12,7 9,1 29.9346,25.56186 z" />
                                        </a>

                                        <a id="state_Diamer" class="state" xlink:href="">
                                            <path id="Diamer" class="shape"
                                                d="m 1415.5031,228.2168 -11.9909,-30.7689 -14.7887,7.5923 -23.5821,-8.7911 -29.9772,-22.97676 -45.3655,-2.59737 -19.785,-8.39151 L 1252.2,174 l -0.5723,11.6598 15.9878,13.9859 52.9598,12.9868 -9.3929,9.9899 -1.3989,11.3885 2.9977,11.1887 18.5859,1.5984 21.1839,9.3905 10.5919,5.5943 24.5813,-8.3915 7.994,-10.7891 z" />
                                        </a>

                                        <a id="state_Astore" class="state" xlink:href="">
                                            <path id="Astore" class="shape"
                                                d="m 1463.8663,256.5881 5.7956,-6.7932 -8.5934,-10.5892 -8.3936,-15.1847 -25.9803,-22.1776 3.3974,-10.5892 -13.9893,-4.7952 -1.399,-13.58626 -8.9931,1.99798 -2.1984,22.57718 11.9909,30.7689 -19.7849,14.3854 -7.994,10.7891 9.193,9.7901 3.997,15.9838 33.7743,15.1847 6.9947,-6.3936 5.5958,2.5974 5.5957,-8.5913 10.9916,-8.5913 z" />
                                        </a>

                                        <a id="state_Hunza-Nagar" class="state" xlink:href="">
                                            <path id="Hunza-Nagar" class="shape"
                                                d="M 1523.4211,154.09174 1533.4,146.6 l -0.8,-7.6 8.2,-3.6 -1.8,-5.8 5.2,-0.6 -7,-13.4 2.6,-12 -8,-13.4 -1.2,-7 -18.8,-14.6 -18.4,-2.2 -1.4,5 -7.8,0.2 -6.4,-21.8 1.4,-3.6 -23.8,-5.4 -1.8,-3.6 -11.8,0.8 -10.8,9 -7.2,-6.4 -2.2,-8.4 -7.8,4.8 -6.6,-8.4 -7.2,1.4 -4,5.6 -0.8,8 -4.6,-4 -9.8,0.4 -16.6,10.8 -10.2,-1 -2.4,7.2 -7.4,2.2 29.9346,25.56186 -24.7812,21.57818 8.4091,21.85994 16.0573,14.78579 21.6242,-4.65702 14.8694,8.77567 18.9792,4.19015 12.1908,-6.39353 5.5957,7.59232 16.7872,-19.5802 14.3891,-4.19576 18.1862,12.38748 17.5866,1.99797 z" />
                                        </a>

                                        <a id="state_Gilgit" class="state" xlink:href="">
                                            <path id="Gilgit" class="shape"
                                                d="m 1410.3134,147.10442 18.9792,4.19015 8.9932,20.77898 -22.1831,14.38545 -1.399,-13.58626 -8.9931,1.99798 -2.1984,22.57718 -14.7887,7.5923 -23.5821,-8.7911 -29.9772,-22.97676 14.389,-14.18565 3.5973,-20.37939 -8.5935,-11.78808 4.7964,-20.57918 8.4091,21.85994 16.0573,14.78579 21.6242,-4.65702 z" />
                                        </a>

                                        <a id="state_Ghanhce" class="state" xlink:href="">
                                            <path id="Ghanhce" class="shape"
                                                d="m 1581.1772,193.6517 -33.5745,20.3794 -13.3898,28.1715 31.576,17.9818 21.1839,6.1938 -0.7728,26.8218 8.8,4.2 12.6,-0.6 6.8,-19.2 24.225,-1.1719 1.575,-10.8281 14.4,-2.4 -17.2,-31.8 -22,-25.6 -11.8398,12.6267 z" />
                                        </a>

                                        <a id="state_Skardu" class="state" xlink:href="">
                                            <path id="Skardu" class="shape"
                                                d="m 1463.8663,273.3711 -10.9916,8.5913 10.3253,9.8376 2.6,11.4 -4.4,6.8 17,11.4 35.4,3.8 30,-18.2 9,3.6 33.4,-17.4 0.7728,-26.8218 -21.1839,-6.1938 -31.576,-17.9818 13.3898,-28.1715 33.5745,-20.3794 22.383,24.775 11.8398,-12.6267 -0.2,-13.4 -8.8,-9.2 -8,-4 -0.8,-13.8 -3.2,-1.4 -17,5.8 -4.8,3.8 -16.2,0 -1.6,-11.2 -6.8,-9.6 -9.0875,-0.49062 -5.5125,-5.70938 -9.9789,7.49174 -9.3929,-10.98889 -17.5866,-1.99797 -18.1862,-12.38748 -14.3891,4.19576 -16.7872,19.5802 -5.5957,-7.59232 -12.1908,6.39353 8.9932,20.77898 -22.1831,14.38545 13.9893,4.7952 -3.3974,10.5892 25.9803,22.1776 8.3936,15.1847 8.5934,10.5892 -5.7956,6.7932 z" />
                                        </a>

                                        <path id="Gilgit_Baltistan_Border" fill="none" stroke="#a08070"
                                            d="m 1530.6,83.2 -18.8,-14.6 -18.4,-2.2 -1.4,5 -7.8,0.2 -6.4,-21.8 1.4,-3.6 -23.8,-5.4 -1.8,-3.6 -11.8,0.8 -10.8,9 -7.2,-6.4 -2.2,-8.4 -7.8,4.8 -6.6,-8.4 -7.2,1.4 -4,5.6 -0.8,8 -4.6,-4 -9.8,0.4 -16.6,10.8 -10.2,-1 -2.4,7.2 -7.4,2.2 -9,-1 -12,-7 -19.2,0.4 8.4,8.2 12.8,5.4 -0.6,9 -26.2,0 -21.4,-4.8 -32.4,8.6 2.6,7.8 -11.6,15.6 -7.4,1.4 -2.8,8.6 -30.8,18.4 -2.6,17.4 4.4,7.4 -5.2,12.4 15.8,9.4 15.4,-4.4 15.2,2.6 9.8,-3.4 4.8,2.8 -0.6,11.6 16,14 53,13 -9.4,10 -1.4,11.4 3,11.2 18.6,1.6 21.2,9.4 10.6,5.6 24.6,-8.4 9.2,9.8 4,16 33.8,15.2 7,-6.4 5.6,2.6 5.6,-8.6 10.2,9.8 2.6,11.4 -4.4,6.8 17,11.4 35.4,3.8 30,-18.2 9,3.6 33.4,-17.4 8.8,4.2 12.6,-0.6 6.8,-19.2 24.2,-1 1.6,-11 14.4,-2.4 -17.2,-31.8 -22,-25.6 -0.2,-13.4 -8.8,-9.2 -8,-4 -0.8,-13.8 -3.2,-1.4 -17,5.8 -4.8,3.8 -16.2,0 -1.6,-11.2 -6.8,-9.6 -9,-0.4 -5.6,-5.8 -0.8,-7.6 8.2,-3.6 -1.8,-5.8 5.2,-0.6 -7,-13.4 2.6,-12 -8,-13.4 z" />
                                    </g>

                                    <g id="Labels" font-size="10" font-family="DejaVu Sans"
                                        transform="translate(-27.1,-28.1)">
                                        <text y="1491.9277" x="717.02856">THATTA</text>
                                        <text y="1431.666" x="640.90259">KARACHI</text>
                                        <text y="1460.0664" x="928.1272">THARPARKAR</text>
                                        <text y="1465.2412" x="813.07843">BADIN</text>
                                        <text y="1428.7881" x="788.802">• TANDO MOHAMMAD KHAN</text>
                                        <text y="1345.9844" x="706.37518">JAMSHORO</text>
                                        <text y="1371.9961" x="725.42206">HYDERABAD •</text>
                                        <text y="1319.6025" x="739.41626">MATIARI •</text>
                                        <text y="1262.9736" x="748.87329">NAWABSHAH</text>
                                        <text y="1316.2168" x="843.80005">SANGHAR</text>
                                        <text y="1381.916" x="897.29321">UMERKOT</text>
                                        <text y="1397.0664" x="787.1936">MIRPUR KHAS •</text>
                                        <text y="1208.4813" x="681.63312">DADU</text>
                                        <text y="1252.9824" x="856.86255">KHAIRPUR</text>
                                        <text y="1207.1826" x="758.35571">• NAUSHAHRO FIROZE</text>
                                        <text y="1120.0273" x="600.29907">QAMBAR SHAHDATKOT •</text>
                                        <text y="1145.9004" x="763.85571">• LARKANA</text>
                                        <text y="1049.502" x="775.41431">JACOBABAD</text>
                                        <text y="1146.6504" x="847.04028">SUKKUR</text>
                                        <text y="1098.3662" x="893.1604">GHOTKI</text>
                                        <text y="1081.3975" x="783.6272">SHIKARPUR</text>
                                        <text y="1042.9023" x="854.18286">KASHMORE</text>
                                        <text y="1034.8398" x="944.83813">RAHIM YAR KHAN</text>
                                        <text y="1360.4961" x="818.46613">• TANDO ALLAH YAR</text>
                                        <text y="1374.8291" x="190.00018">GWADAR</text>
                                        <text y="1307.8037" x="242.70779">KECH</text>
                                        <text y="1222.5145" x="342.20917">PANJGUR</text>
                                        <text y="1287.5771" x="460.99438">AWARAN</text>
                                        <text y="1327.3359" x="579.09991">LASBELA</text>
                                        <text y="1180.0039" x="580.50421">KHUZDAR</text>
                                        <text y="1064.2344" x="454.06268">KHARAN</text>
                                        <text y="1099.0322" x="307.35379">WASHUK</text>
                                        <text y="970.24512" x="234.21948">CHAGHAI</text>
                                        <text y="921.0498" x="477.80792">NUSHKI</text>
                                        <text y="952.04297" x="606.25995">KALAT</text>
                                        <text y="954.67578" x="711.05298">BOLAN</text>
                                        <text y="1021.6045" x="630.79706">JHAL MAGSI •</text>
                                        <text y="1068.8379" x="658.24542">JAFARABAD •</text>
                                        <text y="978.00293" x="811.54132">DERA BUGTI</text>
                                        <text y="894.9541" x="796.57349">KOHLU</text>
                                        <text y="869.33789" x="707.88696">SIBI</text>
                                        <text y="881.33789" x="598.33514">MASTUNG</text>
                                        <text y="818.7959" x="622.00317">QUETTA</text>
                                        <text y="801.7959" x="672.83618">ZIARAT</text>
                                        <text y="783.35364" x="508.43231">KILLA ABDULLAH •</text>
                                        <text y="764.33789" x="638.92987">PISHIN</text>
                                        <text y="749.96973" x="741.99237">KILLA SAIFULLAH</text>
                                        <text y="693.30273" x="845.67798">ZHOB</text>
                                        <text y="646.24902" x="850.26782">SHEERANI •</text>
                                        <text y="747.07324" x="876.2522">MUSAKHEL •</text>
                                        <text y="820.63672" x="796.44556">LORALAI</text>
                                        <text y="859.13672" x="854.58813">BARKHAN •</text>
                                        <text y="827.88281" x="687.01978">HARANAI</text>
                                        <text y="1011.2754" x="755.41431">• NASEERABAD</text>
                                        <text y="974.3457" x="1085.092">BAHAWALPUR</text>
                                        <text y="904.82227" x="1151.7288">BAHAWALNAGAR •</text>
                                        <text y="955.50684" x="937.28442">RAJANPUR</text>
                                        <text y="792.50684" x="977.92017">• DERA GHAZI KHAN</text>
                                        <text y="633.58789" x="992.13708">• DERA ISMAIL KHAN</text>
                                        <text y="659.93848" x="945.03345">• FR DI KHAN</text>
                                        <text y="583.09375" x="808.01593">SOUTH WAZIRISTAN •</text>
                                        <text y="512.00195" x="829.57446">NORTH WAZIRISTAN •</text>
                                        <text y="592.84082" x="967.23169">TANK</text>
                                        <text y="567.53027" x="917.47095">FR TANK •</text>
                                        <text y="487.63562" x="948.60474">FR BANNU •</text>
                                        <text y="543.5" x="877.34497">FR LAKKI MARWAT •</text>
                                        <text y="515.84082" x="990.0647">BANNU</text>
                                        <text y="491.84082" x="1034.6155">KARAK</text>
                                        <text y="455.84082" x="1009.51">HANGU</text>
                                        <text y="398.41504" x="895.38696">KURRAM •</text>
                                        <text y="407.52051" x="966.45337">KHYBER •</text>
                                        <text y="342.32422" x="1016.6467">MOHMAND •</text>
                                        <text y="303.76074" x="1069.717">BAJUR</text>
                                        <text y="430.32068" x="970.4812">ORAKZAI •</text>
                                        <text y="420.81445" x="1041.8549">FR PESHWAR •</text>
                                        <text y="434.81348" x="1107.3168">• FR KOHAT</text>
                                        <text y="457.84082" x="1071.342">KOHAT</text>
                                        <text y="403.0376" x="1130.675">• NOWSHERA</text>
                                        <text y="372.11816" x="1164.9006">SWABI</text>
                                        <text y="349.61816" x="1130.3323">MARDAN</text>
                                        <text y="327.46094" x="1065.0198">MALAKAND •</text>
                                        <text y="298.37646" x="1131.0653">• LOWER DIR</text>
                                        <text y="237.03711" x="1087.3147">UPPER DIR •</text>
                                        <text y="148.11816" x="1120.1223">CHITRAL</text>
                                        <text y="328.45117" x="1168.678">BUNER</text>
                                        <text y="275.50208" x="1152.8286">SHANGLA •</text>
                                        <text y="241.61816" x="1177.0706">SWAT</text>
                                        <text y="385.11816" x="1200.0121">HARIPUR</text>
                                        <text y="325.11816" x="1220.676">MANSEHRA</text>
                                        <text y="297.61816" x="1239.261">• BATTAGRAM</text>
                                        <text y="237.61816" x="1238.9553">KOHISTAN</text>
                                        <text y="393.01855" x="1036.6448">PESHAWAR •</text>
                                        <text y="360.02246" x="1042.9407">CHARSADDA •</text>
                                        <text y="549.83105" x="1022.3108">• LAKKI MARWAT</text>
                                        <text y="852.76074" x="1079.0706">• MULTAN</text>
                                        <text y="788.75977" x="1204.928">SAHIWAL</text>
                                        <text y="800.25977" x="1117.8713">KHANEWAL</text>
                                        <text y="766.84277" x="1294.844">OKARA</text>
                                        <text y="706.75879" x="1230.5881">FAISALABAD</text>
                                        <text y="679.79395" x="1231.2582">NAKANA SAHAB •</text>
                                        <text y="654.79297" x="1343.3733">• SHAIKHUPURA</text>
                                        <text y="599.49219" x="1275.1819">GUJRANWALA •</text>
                                        <text y="538.46094" x="1322.6311">GUJRAT</text>
                                        <text y="575.12598" x="1370.1799">SIALKOT</text>
                                        <text y="592.45996" x="1417.3508">NAROWAL</text>
                                        <text y="623.12598" x="1265.9055">HAFIZABAD</text>
                                        <text y="573.46289" x="1190.178">MANDI BAHAUDDIN •</text>
                                        <text y="680.88281" x="1377.5959">• LAHORE</text>
                                        <text y="730.09277" x="1337.5393">KASUR</text>
                                        <text y="699.42773" x="1149.1526">JHANG</text>
                                        <text y="658.76172" x="1200.8772">CHINIOT</text>
                                        <text y="610.76172" x="1186.8147">SARGODHA</text>
                                        <text y="751.4082" x="1106.1428">TOBA TEK SINGH •</text>
                                        <text y="882.09375" x="1092.3186">LODHRAN</text>
                                        <text y="844.75977" x="1166.1506">VEHARI</text>
                                        <text y="810.75977" x="1239.0375">PAKPATTAN</text>
                                        <text y="842.42773" x="959.29517">MUZAFFARGARH •</text>
                                        <text y="739.42773" x="1047.0354">LAYYAH</text>
                                        <text y="666.09375" x="1050.2034">BHAKKAR</text>
                                        <text y="603.42676" x="1116.595">KHUSHAB</text>
                                        <text y="526.76062" x="1064.0432">MIANWALI</text>
                                        <text y="520.09375" x="1166.0393">CHAKWAL</text>
                                        <text y="463.59277" x="1145.1545">ATTOCK</text>
                                        <text y="470.09277" x="1224.9846">RAWALPINDI</text>
                                        <text y="512.76172" x="1264.0969">JHELUM</text>
                                        <text y="355.22083" x="1192.7996">ABBOTTABAD •</text>
                                        <text y="425.81348" x="1189.3832">ISLAMABAD •</text>
                                        <text x="1348.5569" y="285.3479">NEELUM</text>
                                        <text x="1294.0618" y="340.92847">• MUZAFFARABAD</text>
                                        <text y="364.79333" x="1319.6943">• HATTIAN</text>
                                        <text x="1282.9557" y="389.69226">BAGH •</text>
                                        <text x="1344.4431" y="393.07764">• HAVELI</text>
                                        <text y="408.98755" x="1329.4171">• POONCH</text>
                                        <text x="1315.275" y="424.89746">• SUDHNATI</text>
                                        <text y="452.29785" x="1329.4171">• KOTLI</text>
                                        <text x="1311.7395" y="475.27893">• MIRPUR</text>
                                        <text y="497.37598" x="1342.6754">• BHIMBER</text>
                                        <text y="246.45703" x="1566.8761">GHANCHE</text>
                                        <text x="1480.2555" y="201.37903">SKARDU</text>
                                        <text y="258.83142" x="1408.6609">ASTORE</text>
                                        <text x="1340.6018" y="227.89551">DIAMER</text>
                                        <text x="1265.4718" y="128.90051">GHIZER</text>
                                        <text y="166.02362" x="1366.2345">GILGIT</text>
                                        <text y="100.61621" x="1407.777">HUNZA-NAGAR</text>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- =========Baluchistan======== -->
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                    aria-labelledby="pills-home-tab">
                    <div class="row">
                        <div class="col-9">
                            <div class="row justify-content-center">
                                <div class="col-12 col-md-12">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                        aria-labelledby="pills-home-tab">

                                        <svg id="listing_map" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 500 1028 944"
                                            style="display: inline;min-height:700px">


                                            <g class="model-green" id="Balochistan" fill="#ffffd0" stroke="#d0c0a0"
                                                transform="translate(-27.1,-28.1)">
                                                <a id="state_Ziarat" class="state" xlink:href="">
                                                    <path id="Ziarat" class="shape"
                                                        d="m 711.2,780.9 -9.4,-2.6 -6.6,8 -5,0 -2.4,-6.2 -6.2,-1.8 -14.4,11.4 -7.2,9.8 4.4,9 5.4,2.8 1,-4.2 29,10.2 18.6,-11.2 -4,-5.6 7,-7.8 0,-6.2 -8.2,0 z" />
                                                </a>

                                                <a id="state_Zhob" class="state" xlink:href="">
                                                    <path id="Zhob" class="shape"
                                                        d="m 729.2,682.9 6.2,24 16.6,5 47.2,-19 12,4.4 1.8,26.6 38.8,-2.6 16.2,12.2 11.6,-2.4 -10.8,23.2 -22.2,10 8.4,9.6 42.4,22.8 -9,-13.2 7.6,-20.6 18.8,-26.4 0.4,-36.6 21,5.6 5,-12.2 -34,-20.2 -21.4,-27.8 -26.2,-12.4 -7.8,16.8 -10,8.8 -7.2,-2.2 -5.2,5 -9.2,-1 -8.8,-9.8 -1.4,-8.6 -6.2,-0.6 -7,-6 -13.8,7.4 -14.6,0.8 -11.8,-9 -10.4,15.6 -20,12 12.2,11.8 z" />
                                                </a>

                                                <a id="state_Washuk" class="state" xlink:href="">
                                                    <path id="Washuk" class="shape"
                                                        d="m 407.8,1088.5 14.2,25.8 -7.8,14 26.4,41 -30.2,16.2 -26.8,-33.8 -31.4,35.4 -28.2,-32.2 -65.8,8 -24,5.6 -16,-4.8 6.8,-36.2 -8,-53.8 54,-32.4 59.2,-6.4 88.6,-40.2 -6.2,45.8 4.2,26.2 z" />
                                                </a>

                                                <a id="state_Sibi" class="state" xlink:href="">
                                                    <path id="Sibi" class="shape"
                                                        d="m 692.6,883.9 24,11 13.8,29.4 27.4,-3.8 -5.8,-7 11.4,-16.8 -26.8,-12 10.6,-23.2 37.8,-12.8 -33,-27.6 -73,33.2 7.8,3 z" />
                                                </a>

                                                <a id="state_Sheerani" class="state" xlink:href="">
                                                    <path id="Sheerani" class="shape"
                                                        d="m 925.6,621.3 -7.2,-4.6 3,-9.6 -16.8,4.6 -10.6,11.6 -21.8,-1 -12.6,10.6 26.2,12.4 21.4,27.8 34,20.2 -2.6,-16.8 -8.6,-5.2 2.4,-43.8 -7.6,5.2 -3,-3.2 z" />
                                                </a>

                                                <a id="state_Quetta" class="state" xlink:href="">
                                                    <path id="Quetta" class="shape"
                                                        d="m 664.4,808.5 -4.4,-9 -7.8,1.4 -5.4,6.8 -12,-16.6 -7,0.4 -14.2,33.8 -19.8,-2 -6.6,7 -8.8,-3.4 -14.4,12.4 11.8,9.6 -10.6,13.2 29.4,6.4 20,-36.2 12,13.2 19.8,-5.8 1.2,-13.2 19.6,-6.4 2.6,-8.8 z" />
                                                </a>

                                                <a id="state_Pishin" class="state" xlink:href="">
                                                    <path id="Pishin" class="shape"
                                                        d="m 667.2,789.7 -7.2,9.8 -7.8,1.4 -5.4,6.8 -12,-16.6 -12.4,-21.2 -8.8,-4 14.8,-25.6 27.4,-1.2 14,-18.6 -0.2,-14.2 6.8,0.6 49.2,10.6 -1.4,8 -35.8,21.8 -4,5.2 8.8,5.6 -9.2,7.6 25.8,2.4 1.4,12.8 -9.4,-2.6 -6.6,8 -5,0 -2.4,-6.2 -6.2,-1.8 z" />
                                                </a>

                                                <a id="state_Panjgur" class="state" xlink:href="">
                                                    <path id="Panjgur" class="shape"
                                                        d="m 440.6,1169.3 34.8,32.7 -41.8,59.8 -48,-2 -0.6,12.8 -31,12.4 -30.6,-18.8 -25.2,0.4 0,-14.8 -40.6,-0.4 -0.8,-20.2 2.2,-22.6 9,-3.6 -2.6,-23.9 6.2,-6.4 -13.4,-11.8 65.8,-8 28.2,32.2 31.4,-35.4 26.8,33.8 z" />
                                                </a>

                                                <a id="state_Nushki" class="state" xlink:href="">
                                                    <path id="Nushki" class="shape"
                                                        d="m 531.8,944.9 16.4,-22.4 12.6,-1.4 13.8,-33 -9.4,-26 -118.8,36.8 -2.6,58.8 -25,37 44,-13.6 25,-25.6 32.6,-14 z" />
                                                </a>

                                                <a id="state_Naseerabad" class="state" xlink:href="">
                                                    <path id="Naseerabad" class="shape"
                                                        d="m 748,990.7 -14.8,-0.6 4.8,14.8 -17.4,1.6 -0.8,46.4 19.8,-5.6 16.4,-21 23.4,-3 0,-19.4 7.6,-3.2 -1.8,-35 -4.2,-4 -19,6.8 6.2,12 z" />
                                                </a>

                                                <a id="state_Musakhel" class="state" xlink:href="">
                                                    <path id="Musakhel" class="shape"
                                                        d="m 946.8,683.5 -5.6,9.8 -5,12.2 -21,-5.6 -0.4,36.6 -18.8,26.4 -7.6,20.6 9,13.2 20,16.4 14.8,0.2 4.2,-17.4 10.6,-20.8 -1,-9.2 12,-13.2 6.2,-0.8 -2.2,-6.2 1.2,-23.4 -2.4,-5 4,-24.8 -1.4,-17 z" />
                                                </a>

                                                <a id="state_Mastung" class="state" xlink:href="">
                                                    <path id="Mastung" class="shape"
                                                        d="m 679,854.3 -2.2,-6.6 9,-6 -3.6,-15.4 -12.8,1.6 -2.2,-7.8 -19.6,6.4 -1.2,13.2 -19.8,5.8 -12,-13.2 -20,36.2 -29.4,-6.4 9.4,26 -13.8,33 16.4,1.4 25.6,-31.4 5.4,20.4 19.2,-12.4 -1.4,13.4 26.8,2 4.4,-10.6 10,-20.2 -8.8,-9.4 -4,-15.2 9.4,-9.4 z" />
                                                </a>

                                                <a id="state_Loralai" class="state" xlink:href="">
                                                    <path id="Loralai" class="shape"
                                                        d="m 768.8,787.1 41,-2.6 14.6,8.4 30.6,-19 42.4,22.8 20,16.4 -13,20 -7.4,-2.2 1.6,-7.8 -18.8,22.8 -34.6,7.8 -12.4,-6.4 -28,14.2 -19.8,-12.8 -33,-27.6 -33.6,-15 -4,-5.6 7,-7.8 0,-6.2 -8.2,0 -2,-5.6 26,-10.4 1.2,10.4 20,-3 z" />
                                                </a>

                                                <a id="state_Lasbela" class="state" xlink:href="">
                                                    <path id="Lasbela" class="shape"
                                                        d="m 598.4,1376.6 -3.4,0.4 2.4,5.4 15.6,15.6 -5,34.4 2.4,0.8 17,-14.6 6.8,-0.6 8,-9.4 0.4,-7.2 10.6,-10.8 3.4,-18.2 20.8,-27.2 7.2,-21.8 0.6,-29.6 -22.8,-39.8 -8,-26.8 -17.8,15.2 20.2,34.8 -5.4,55 -12.2,3.4 -22,-85.8 -24.8,4.4 -27.6,-5.6 -5,16.8 9.4,52.8 -13.2,31.2 -23.6,8 -38,-1.4 -1.2,-15.2 -31.4,11.6 1.8,25.4 5.8,1 5.2,-3 4,3.2 6.8,-2.2 21.2,4.4 19,-8.6 44.4,-5.8 19,8 1.8,-0.8 -4.8,-6 2.8,-2.6 -4.2,-1.4 -2.4,1.4 -8.4,-8.2 -7.6,1 -5,6.2 -7.8,-2 2.4,-6.4 11.2,-5.2 4.4,1.4 6.2,-3 13.6,13.2 1.6,-1.6 z" />
                                                </a>

                                                <a id="state_Kohlu" class="state" xlink:href="">
                                                    <path id="Kohlu" class="shape"
                                                        d="m 845.2,880.3 37,-19.6 8,-16.4 -10.4,1.6 -34.6,7.8 -12.4,-6.4 -28,14.2 -19.8,-12.8 -37.8,12.8 -10.6,23.2 26.8,12 -11.4,16.8 5.8,7 29.6,19.8 22.6,-7.4 28.6,6.6 3.6,-5 20.4,2.8 7.2,-14.4 21.2,-10.4 -7.8,-7.4 6.2,-19.4 -24.6,9.2 z" />
                                                </a>

                                                <a id="state_Killa_Saifullah" class="state" xlink:href="">
                                                    <path id="Killa_Saifullah" class="shape"
                                                        d="m 711.2,671.3 15,-9.2 12.2,11.8 -9.2,9 6.2,24 16.6,5 47.2,-19 12,4.4 1.8,26.6 38.8,-2.6 16.2,12.2 11.6,-2.4 -10.8,23.2 -22.2,10 8.4,9.6 -30.6,19 -14.6,-8.4 -41,2.6 -10.4,-9.2 -20,3 -1.2,-10.4 -26,10.4 -1.4,-12.8 -25.8,-2.4 9.2,-7.6 -8.8,-5.6 4,-5.2 35.8,-21.8 1.4,-8 -49.2,-10.6 42,-16 -1.8,-8 -15.4,1.6 -6,-14.8 z" />
                                                </a>

                                                <a id="state_Killa_Abdullah" class="state" xlink:href="">
                                                    <path id="Killa_Abdullah" class="shape"
                                                        d="m 628.4,740.3 27.4,-1.2 14,-18.6 -0.2,-14.2 -24.2,-2.2 -4,-10.8 -28.6,12.8 -4.8,15.8 -12,11.2 -17.2,4.2 -11,42.8 7.4,17 -11.2,42.2 14.4,-12.4 8.8,3.4 6.6,-7 19.8,2 14.2,-33.8 7,-0.4 -12.4,-21.2 -8.8,-4 z" />
                                                </a>

                                                <a id="state_Khuzdar" class="state" xlink:href="">
                                                    <path id="Khuzdar" class="shape"
                                                        d="m 651.4,1332.2 -12.2,3.4 -22,-85.8 -24.8,4.4 -27.6,-5.6 -3.6,-10 -13.8,21 -12.8,-25 15.8,-69.7 -16.8,7.4 -7.8,-20.6 -23.2,-9 13.2,-36.4 24.6,-24.8 15,0.2 34.4,-23.8 9,-15 -15,-13.6 11,-19.2 8.8,1.6 19,-30.6 42.8,0.6 2.4,14 -8.4,20.4 1.8,18.2 17.8,0 4,13.8 -4.6,43 -15.8,33.6 -9.6,29.2 1.4,73.3 -17.8,15.2 20.2,34.8 z" />
                                                </a>

                                                <a id="state_Kharan" class="state" xlink:href="">
                                                    <path id="Kharan" class="shape"
                                                        d="m 548.2,922.5 -16.4,22.4 -11.4,-3.4 -32.6,14 -25,25.6 -44,13.6 -6.2,45.8 4.2,26.2 -9,21.8 14.2,25.8 -7.8,14 26.4,41 34.8,32.7 27.2,-59.3 13.2,-36.4 24.6,-24.8 -13.8,-37.2 24.4,-37.8 -8.2,-17 19.2,-27.8 -7.8,-18.8 6.6,-21.8 z" />
                                                </a>

                                                <a id="state_Kech" class="state" xlink:href="">
                                                    <path id="Kech" class="shape"
                                                        d="m 160,1359 22,-9.4 54.4,-3 42.4,12.4 7.8,14.6 57.2,-27.6 14.8,5.4 19.2,-7 -7.8,-10.2 10.4,-34.4 13,-4.2 -8.4,-23 -31,12.4 -30.6,-18.8 -25.2,0.4 0,-14.8 -40.6,-0.4 -0.8,-20.2 -36.6,-0.6 -53,15 2,19.8 -14.2,-4.2 -2.8,7.6 -28.2,10.4 -7.2,49.2 22.2,12 6.8,-15.6 1.2,27.6 z" />
                                                </a>

                                                <a id="state_Kalat" class="state" xlink:href="">
                                                    <path id="Kalat" class="shape"
                                                        d="m 603.6,1011.7 19,-30.6 42.8,0.6 22.2,-32.6 0,-26.6 -11.6,-10.2 -0.6,-10.8 -14.6,6.2 -3.6,-3.8 -4.4,10.6 -26.8,-2 1.4,-13.4 -19.2,12.4 -5.4,-20.4 -25.6,31.4 -16.4,-1.4 -6.6,21.8 7.8,18.8 -19.2,27.8 8.2,17 -24.4,37.8 13.8,37.2 15,0.2 34.4,-23.8 9,-15 -15,-13.6 11,-19.2 z" />
                                                </a>

                                                <a id="state_Jhal_Magsi" class="state" xlink:href="">
                                                    <path id="Jhal_Magsi" class="shape"
                                                        d="m 678.4,993.9 -10.6,1.8 -8.4,20.4 1.8,18.2 17.8,0 4,13.8 -4.6,43 27.6,-6 -1.4,-29.2 15.2,-3 0.8,-46.4 -9.2,-15.8 1.4,-11.2 -13.6,0 -6.4,15 -8.2,-5 z" />
                                                </a>

                                                <a id="state_Jafarabad" class="state" xlink:href="">
                                                    <path id="Jafarabad" class="shape"
                                                        d="m 704.6,1055.9 1.4,29.2 26,-11.4 10.6,-15.2 32.6,-21.4 11.8,-14.2 66.4,-2.4 -10,-7 -29.2,2.6 -27.2,-15.4 -7.6,3.2 0,19.4 -23.4,3 -16.4,21 -19.8,5.6 z" />
                                                </a>

                                                <a id="state_Haranai" class="state" xlink:href="">
                                                    <path id="Haranai" class="shape"
                                                        d="m 670.8,807.1 -3.6,13 2.2,7.8 12.8,-1.6 3.6,15.4 -9,6 2.2,6.6 73,-33.2 -33.6,-15 -18.6,11.2 z" />
                                                </a>

                                                <a id="state_Gwadar" class="state" xlink:href="">
                                                    <path id="Gwadar" class="shape"
                                                        d="m 150.4,1397.2 -3.6,6 3.8,5.4 -24.8,2 -1.6,6.2 -10.8,-1 4.6,-17 -16.6,-1.4 10.2,-54 -2.8,-14.6 8,-0.4 22.2,12 6.8,-15.6 1.2,27.6 13,6.6 22,-9.4 54.4,-3 42.4,12.4 7.8,14.6 57.2,-27.6 14.8,5.4 -4.6,10.8 25.8,3.6 34,-11.6 48,-1.8 1.8,25.4 -7,9.2 -8.6,-1.8 -29.4,-1.6 -10.4,4.6 -2.4,7.4 4.6,4.6 -6,1.8 -4.4,-1.2 3,-4 -9,-7.2 -10.8,4.6 -17.8,-9.6 -13.4,-1.4 -4,-8.6 5.4,-2.4 1.8,-3 -11.4,-0.4 -6.2,4 3.2,3.2 2.6,-3 3.6,8.4 -14.2,0.8 -18.2,-5.8 -17.6,2.8 -10,8.8 5.2,8.2 -1.4,2.4 -40.2,-7 -10,4.4 -27,-5.2 -27,2.4 1.8,3 -14.6,7.2 5.2,5.6 -10.6,0 2.4,-9.6 -8.6,-4.2 z" />
                                                </a>

                                                <a id="state_Dera_Bugti" class="state" xlink:href="">
                                                    <path id="Dera_Bugti" class="shape"
                                                        d="m 787.8,944.5 -15.4,-6.4 -3.2,5.6 11.8,18 4.2,4 1.8,35 27.2,15.4 29.2,-2.6 10,7 25,-0.8 -5,-12 11.2,-6.4 8.6,-20.2 -3.8,-10.8 21,-21.8 4.6,-24 -5.4,3 -4.8,-6.6 2.2,-7 -10.6,-3.4 4.2,-26.8 -11.2,2 -6.2,19.4 7.8,7.4 -21.2,10.4 -7.2,14.4 -20.4,-2.8 -3.6,5 -28.6,-6.6 -22.6,7.4 z" />
                                                </a>

                                                <a id="state_Chaghai" class="state" xlink:href="">
                                                    <path id="Chaghai" class="shape"
                                                        d="m 330.2,1034.9 -59.2,6.4 -54,32.4 2,-29.8 -20,2.4 -21.2,-20.6 -26.4,-5.8 -31.2,-17.8 -31.6,-42.2 -12.8,-37.8 -48.2,-60.6 157.8,54.4 113.4,-11.6 51.4,13 16.2,-17 36.6,-6.6 43.4,5.2 -2.6,58.8 -25,37 z" />
                                                </a>

                                                <a id="state_Bolan" class="state" xlink:href="">
                                                    <path id="Bolan" class="shape"
                                                        d="m 692.6,883.9 -5.8,-26.6 -7.8,-3 -15.2,-4.6 -9.4,9.4 4,15.2 8.8,9.4 -10,20.2 3.6,3.8 14.6,-6.2 0.6,10.8 11.6,10.2 0,26.6 -22.2,32.6 2.4,14 10.6,-1.8 6.2,-4.4 8.2,5 6.4,-15 13.6,0 -1.4,11.2 9.2,15.8 17.4,-1.6 -4.8,-14.8 14.8,0.6 20.2,-10.2 -6.2,-12 19,-6.8 -11.8,-18 3.2,-5.6 15.4,6.4 -0.4,-4.2 -29.6,-19.8 -27.4,3.8 -13.8,-29.4 z" />
                                                </a>

                                                <a id="state_Barkhan" class="state" xlink:href="">
                                                    <path id="Barkhan" class="shape"
                                                        d="m 890.2,844.3 -8,16.4 -37,19.6 19.6,14.6 24.6,-9.2 11.2,-2 13.4,-5.4 15.6,-22.8 8.2,-23.8 7.6,-15.2 -9.6,3.8 -3.6,-7 -14.8,-0.2 -13,20 -7.4,-2.2 1.6,-7.8 -18.8,22.8 z" />
                                                </a>

                                                <a id="state_Awaran" class="state" xlink:href="">
                                                    <path id="Awaran" class="shape"
                                                        d="m 561.2,1238.6 -13.8,21 -12.8,-25 15.8,-69.7 -16.8,7.4 -7.8,-20.6 -23.2,-9 -27.2,59.3 -41.8,59.8 -48,-2 -0.6,12.8 8.4,23 -13,4.2 -10.4,34.4 7.8,10.2 -19.2,7 -4.6,10.8 25.8,3.6 34,-11.6 48,-1.8 31.4,-11.6 1.2,15.2 38,1.4 23.6,-8 13.2,-31.2 -9.4,-52.8 5,-16.8 z" />
                                                </a>

                                                <path id="Balochistan_Border" fill="none" stroke="#a08070"
                                                    d="m 796.8,635.3 -13.8,7.4 -14.6,0.8 -11.8,-9 -10.4,15.6 -20,12 -15,9.2 -16,-1.6 6,14.8 15.4,-1.6 1.8,8 -42,16 -6.8,-0.6 -24.2,-2.2 -4,-10.8 -28.6,12.8 -4.8,15.8 -12,11.2 -17.2,4.2 -11,42.8 7.4,17 -11.2,42.2 11.8,9.6 -10.6,13.2 -118.8,36.8 -43.4,-5.2 -36.6,6.6 -16.2,17 -51.4,-13 -113.4,11.6 -157.8,-54.4 48.2,60.6 12.8,37.8 31.6,42.2 31.2,17.8 26.4,5.8 21.2,20.6 20,-2.4 -2,29.8 8,53.8 -6.8,36.2 16,4.8 24,-5.6 13.4,11.8 -6.2,6.4 2.6,23.9 -9,3.6 -2.2,22.6 -36.6,-0.6 -53,15 2,19.8 -14.2,-4.2 -2.8,7.6 -28.2,10.4 -7.2,49.2 -8,0.4 2.8,14.6 -10.2,54 16.6,1.4 -4.6,17 10.8,1 1.6,-6.2 24.8,-2 -3.8,-5.4 3.6,-6 11.8,-2 8.6,4.2 -2.4,9.6 10.6,0 -5.2,-5.6 14.6,-7.2 -1.8,-3 27,-2.4 27,5.2 10,-4.4 40.2,7 1.4,-2.4 -5.2,-8.2 10,-8.8 17.6,-2.8 18.2,5.8 14.2,-0.8 -3.6,-8.4 -2.6,3 -3.2,-3.2 6.2,-4 11.4,0.4 -1.8,3 -5.4,2.4 4,8.6 13.4,1.4 17.8,9.6 10.8,-4.6 9,7.2 -3,4 4.4,1.2 6,-1.8 -4.6,-4.6 2.4,-7.4 10.4,-4.6 29.4,1.6 8.6,1.8 7,-9.2 5.8,1 5.2,-3 4,3.2 6.8,-2.2 21.2,4.4 19,-8.6 44.4,-5.8 19,8 1.8,-0.8 -4.8,-6 2.8,-2.6 -4.2,-1.4 -2.4,1.4 -8.4,-8.2 -7.6,1 -5,6.2 -7.8,-2 2.4,-6.4 11.2,-5.2 4.4,1.4 6.2,-3 13.6,13.2 1.6,-1.6 5.6,15.8 -3.4,0.4 2.4,5.4 15.6,15.6 -5,34.4 2.4,0.8 17,-14.6 6.8,-0.6 8,-9.4 0.4,-7.2 10.6,-10.8 3.4,-18.2 20.8,-27.2 7.2,-21.8 0.6,-29.6 -22.8,-39.8 -8,-26.8 -1.4,-73.3 9.6,-29.2 15.8,-33.6 27.6,-6 26,-11.4 10.6,-15.2 32.6,-21.4 11.8,-14.2 66.4,-2.4 25,-0.8 -5,-12 11.2,-6.4 8.6,-20.2 -3.8,-10.8 21,-21.8 4.6,-24 -5.4,3 -4.8,-6.6 2.2,-7 -10.6,-3.4 4.2,-26.8 13.4,-5.4 15.6,-22.8 8.2,-23.8 7.6,-15.2 -9.6,3.8 -3.6,-7 4.2,-17.4 10.6,-20.8 -1,-9.2 12,-13.2 6.2,-0.8 -2.2,-6.2 1.2,-23.4 -2.4,-5 4,-24.8 -1.4,-17 -16.6,8 -5.6,9.8 -2.6,-16.8 -8.6,-5.2 2.4,-43.8 -7.6,5.2 -3,-3.2 3.8,-8.2 -7.2,-4.6 3,-9.6 -16.8,4.6 -10.6,11.6 -21.8,-1 -12.6,10.6 -7.8,16.8 -10,8.8 -7.2,-2.2 -5.2,5 -9.2,-1 -8.8,-9.8 -1.4,-8.6 -6.2,-0.6 z" />
                                            </g>

                                            <g id="Labels" font-size="10" font-family="DejaVu Sans"
                                                transform="translate(-27.1,-28.1)">

                                                <text y="1374.8291" x="190.00018">GWADAR</text>
                                                <text y="1307.8037" x="242.70779">KECH</text>
                                                <text y="1222.5145" x="342.20917">PANJGUR</text>
                                                <text y="1287.5771" x="460.99438">AWARAN</text>
                                                <text y="1327.3359" x="579.09991">LASBELA</text>
                                                <text y="1180.0039" x="580.50421">KHUZDAR</text>
                                                <text y="1064.2344" x="454.06268">KHARAN</text>
                                                <text y="1099.0322" x="307.35379">WASHUK</text>
                                                <text y="970.24512" x="234.21948">CHAGHAI</text>
                                                <text y="921.0498" x="477.80792">NUSHKI</text>
                                                <text y="952.04297" x="606.25995">KALAT</text>
                                                <text y="954.67578" x="711.05298">BOLAN</text>
                                                <text y="1021.6045" x="630.79706">JHAL MAGSI
                                                    •</text>
                                                <text y="1068.8379" x="658.24542">JAFARABAD •</text>
                                                <text y="978.00293" x="811.54132">DERA BUGTI</text>
                                                <text y="894.9541" x="796.57349">KOHLU</text>
                                                <text y="869.33789" x="707.88696">SIBI</text>
                                                <text y="881.33789" x="598.33514">MASTUNG</text>
                                                <text y="818.7959" x="622.00317">QUETTA</text>
                                                <text y="801.7959" x="672.83618">ZIARAT</text>
                                                <text y="783.35364" x="508.43231">KILLA ABDULLAH
                                                    •</text>
                                                <text y="764.33789" x="638.92987">PISHIN</text>
                                                <text y="749.96973" x="741.99237">KILLA
                                                    SAIFULLAH</text>
                                                <text y="693.30273" x="845.67798">ZHOB</text>
                                                <text y="646.24902" x="850.26782">SHEERANI •</text>
                                                <text y="747.07324" x="876.2522">MUSAKHEL •</text>
                                                <text y="820.63672" x="796.44556">LORALAI</text>
                                                <text y="859.13672" x="854.58813">BARKHAN •</text>
                                                <text y="827.88281" x="687.01978">HARANAI</text>
                                                <text y="1011.2754" x="755.41431">•
                                                    NASEERABAD</text>
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <img width="64" height="64"
                                src="https://img.icons8.com/nolan/64/user-male--v1.png" alt="user-male--v1" />
                            {{ $baluchistanMale ?? 0 }} <br>
                            <img width="64" height="64"
                                src="https://img.icons8.com/nolan/64/1A6DFF/C822FF/standing-woman--v2.png"
                                alt="standing-woman--v2" /> {{ $baluchistanFemale ?? 0 }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- =========Sindh======== -->
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">

                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                    aria-labelledby="pills-home-tab">
                    <div class="row">
                        <div class="col-9">
                            <div class="row">
                                <div class="col-9">
                                    <div class="row justify-content-center">
                                        <div class="col-12 col-md-12">
                                            <svg id="listing_map" xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="500 950 828 644"
                                                style="display: inline;min-height:700px">



                                                <g class="model-green" id="Sindh" fill="#ffffd0"
                                                    stroke="#d0c0a0" transform="translate(-27.1,-28.1)">

                                                    <a id="state_Umerkot" class="state" xlink:href="">
                                                        <path id="Umerkot" class="shape"
                                                            d="m 911.4,1402.6 20.6,-11.8 38.8,-1 -5.6,-22.4 5.4,-12 -14,-6 10.8,-10.6 -6.6,-9.6 -15.4,5.4 -9.2,-1.8 -21.8,25.8 -16.2,3.8 1.4,-7.6 -39.4,-1.4 1.4,16.4 21.6,18.4 -2,18.2 8.2,28.4 14,-20 11.8,4.6 z" />
                                                    </a>

                                                    <a id="state_Tharparkar" class="state" xlink:href="">
                                                        <path id="Tharparkar" class="shape"
                                                            d="m 1001,1338.2 -20.2,4.2 -13.4,-3.6 -10.8,10.6 14,6 -5.4,12 5.6,22.4 -38.8,1 -20.6,11.8 3.8,16.8 -11.8,-4.6 -14,20 -14.6,8.8 -9,14.2 -1.6,17.8 -16.4,10.8 1.2,18.4 10.8,3.8 11,-4.8 13.2,0.8 14.8,-1.8 13.4,12.8 30,0.6 8.6,-13.2 26,-8 20.4,-7.6 2,3.4 -3.2,3.8 1.2,12 10,3.4 13.2,0.2 9.8,-5 -3.8,-3.8 11.4,-7.4 3.4,1.2 11,-6.6 -10.4,-2.8 -3,-19.4 9.6,-10.4 -14,-26.4 -7,-26.4 -21,-28 0.6,-31.6 z" />
                                                    </a>

                                                    <a id="state_Thatta" class="state" xlink:href="">
                                                        <path id="Thatta" class="shape"
                                                            d="m 689.8,1550.2 11.4,3.2 3.2,-9.4 3,15.6 6.6,-0.4 -2.2,-5.2 11.8,3.6 2,-11.6 16.6,16.6 -1.4,-19.6 5.6,2.4 3.4,12.6 -5,9.6 4.6,2.8 1,-3.8 4.4,5 0.8,-24.2 3.8,14.4 4.6,-14.4 12.8,-9.6 38,2.2 1.4,-36.4 -2,-10.2 -30,-4.6 -3.4,-38.8 -9.4,-11 2.6,-9 -4.2,-12.2 2.4,-9.6 -2.4,-19.2 -7.4,-0.4 -14.6,-16.8 -10.8,10.4 0.2,7.4 -8.8,6 0,15.6 -9.8,10.6 -24.8,5.4 3.2,23.4 -13,-7.6 -18.6,7.8 -6,3 -5,8 1,4 5.6,-0.4 4,3.2 -6,3.2 3.8,3.8 2.8,12.6 2.8,-2.6 -0.8,9 8.2,1.8 -7.2,3.4 5,25.6 19.8,4 0.2,13.4 z" />
                                                    </a>

                                                    <a id="state_Tando_Muhammad_Khan" class="state"
                                                        xlink:href="">
                                                        <path id="Tando_Muhammad_Khan" class="shape"
                                                            d="m 771.4,1439 9.4,11 14.4,-13.8 6.4,2.4 8,-5.8 7.2,0.6 1,-7.2 -15.4,-13.8 -2.2,-4.2 -28,0 -2.4,9.6 4.2,12.2 z" />
                                                    </a>

                                                    <a id="state_Tando_Allah_Yar" class="state" xlink:href="">
                                                        <path id="Tando_Allah_Yar" class="shape"
                                                            d="m 821.2,1336 -10,9 0.6,10 -6.4,9.8 3.2,13.6 -4.4,5.8 3.8,5.8 5.4,-0.2 0.8,5.8 18.8,0 6.2,-9.4 0.6,-13 -6.8,-13.6 0.6,-18.4 z" />
                                                    </a>

                                                    <a id="state_Sukkur" class="state" xlink:href="">
                                                        <path id="Sukkur" class="shape"
                                                            d="m 830.2,1154.7 17.6,14.4 43.2,20 7.4,-18.8 23.8,-24.6 -20.6,-8 0.2,-7.6 -20.6,-1.6 -17.8,-22.2 10,-1 -9.2,-29 -10.6,-3 -23.8,24.4 -12.4,2.6 -5.6,6.4 8.8,6.2 12,0 -6.2,19.4 9.2,6.8 z" />
                                                    </a>

                                                    <a id="state_Shikarpur" class="state" xlink:href="">
                                                        <path id="Shikarpur" class="shape"
                                                            d="m 817.4,1100.3 12.4,-2.6 23.8,-24.4 -4.2,-5.8 -11,-1.2 -24.8,-8.2 -22.4,7 -10.4,-2.6 -0.4,21.6 -6.4,2.2 19,26.2 18.8,-5.8 z" />
                                                    </a>

                                                    <a id="state_Sanghar" class="state" xlink:href="">
                                                        <path id="Sanghar" class="shape"
                                                            d="m 811.2,1345 10,-9 12.4,5.2 10,-4.8 13.6,6 3,11 39.4,1.4 -1.4,7.6 16.2,-3.8 21.8,-25.8 9.2,1.8 15.4,-5.4 -10.8,-15.8 -2.2,-14.4 -90.4,-17.8 -23.6,-26.4 -24,20 4.4,8.8 -8.8,3 -10.2,-8 -9.4,6.8 11.4,16 -4.2,13.6 3.2,11.2 z" />
                                                    </a>

                                                    <a id="state_Qambar_Shahdatkot" class="state" xlink:href="">
                                                        <path id="Qambar_Shahdatkot" class="shape"
                                                            d="m 662.6,1124.7 -9.6,29.2 94.8,7.2 7.2,-9 -1,-12.4 8.4,-22.6 8.6,-19 -5.6,-3.4 -3,-10.8 -8.8,-5.2 -12.2,0 -9.4,-5 -26,11.4 -27.6,6 z" />
                                                    </a>

                                                    <a id="state_Nawabshah" class="state" xlink:href="">
                                                        <path id="Nawabshah" class="shape"
                                                            d="m 818,1237.6 -40.2,-2.6 -27.8,5.2 -10.6,7 -4,23.6 28.6,37.8 9,-0.2 10.6,-11.4 13.6,4.4 -11.4,-16 9.4,-6.8 10.2,8 8.8,-3 -4.4,-8.8 24,-20 z" />
                                                    </a>

                                                    <a id="state_Naushahro_Firoze" class="state" xlink:href="">
                                                        <path id="Naushahro_Firoze" class="shape"
                                                            d="m 729.8,1210.8 5.6,22.2 -6,6.6 10,7.6 10.6,-7 27.8,-5.2 2,-29.6 9.8,-27.1 -24.2,-12.8 -12.8,13.8 -10.2,6.6 3.4,10 z" />
                                                    </a>

                                                    <a id="state_Mirpur_Khas" class="state" xlink:href="">
                                                        <path id="Mirpur_Khas" class="shape"
                                                            d="m 860.2,1353.4 -3,-11 -13.6,-6 -10,4.8 -0.6,18.4 6.8,13.6 -0.6,13 4,22 18.6,17.6 10.2,3.4 2.8,14.4 14.6,-8.8 -8.2,-28.4 2,-18.2 -21.6,-18.4 z" />
                                                    </a>

                                                    <a id="state_Matiari" class="state" xlink:href="">
                                                        <path id="Matiari" class="shape"
                                                            d="m 793,1315 4.2,-13.6 -13.6,-4.4 -10.6,11.4 -3.2,8.6 9.6,9 -2.2,9.4 15,9.4 -3.6,-13.2 7.6,-5.4 z" />
                                                    </a>

                                                    <a id="state_Larkana" class="state" xlink:href="">
                                                        <path id="Larkana" class="shape"
                                                            d="m 773,1152.1 9.2,-1.8 -8.2,-14.8 8.2,-12.8 16.2,-3.6 -5.4,-6.6 -19,-26.2 -11.6,-2.4 3,10.8 5.6,3.4 -8.6,19 -8.4,22.6 1,12.4 -7.2,9 -4.4,8.6 9.2,9.6 12.8,-13.8 z" />
                                                    </a>

                                                    <a id="state_Khairpur_Mir's" class="state" xlink:href="">
                                                        <path id="Khairpur" class="shape"
                                                            d="m 765.4,1165.5 24.2,12.8 -9.8,27.1 -2,29.6 40.2,2.6 15.8,17.2 23.6,26.4 90.4,17.8 9.2,-21.6 -0.4,-35 -10.2,-5.6 -18.6,2 -39,-21 2.2,-28.7 -43.2,-20 -17.6,-14.4 5.4,-15.6 -9.2,-6.8 6.2,-19.4 -12,0 -8.8,-6.2 -18.8,5.8 5.4,6.6 -16.2,3.6 -8.2,12.8 8.2,14.8 -9.2,1.8 z" />
                                                    </a>

                                                    <a id="state_Kashmore" class="state" xlink:href="">
                                                        <path id="Kashmore" class="shape"
                                                            d="m 878.4,1019.7 -25,0.8 -15,45.8 11,1.2 4.2,5.8 10.6,3 6.4,-11 24.6,-13 7,8 21,-22 -11.6,-16.8 -23.6,-6.2 z" />
                                                    </a>

                                                    <a id="state_Karachi" class="state" xlink:href="">
                                                        <path id="Karachi" class="shape"
                                                            d="m 671.6,1403.2 19,13.4 3.2,10.6 3.2,23.4 -13,-7.6 -18.6,7.8 -2.2,-4.2 -5,2.4 -10.6,-5 -0.2,3.6 -12,-8.6 0.2,4.2 -9.8,-5.8 -20.4,3.4 5,-7.6 17,-14.6 6.8,-0.6 8,-9.4 0.4,-7.2 10.6,-10.8 3.4,-18.2 20.8,-27.2 9.2,11.4 -2.2,17.8 z" />
                                                    </a>

                                                    <a id="state_Jamshoro" class="state" xlink:href="">
                                                        <path id="Jamshoro" class="shape"
                                                            d="m 739.4,1247.2 -10,-7.6 -14.6,-5 -7.4,37.2 -9.4,-0.2 -12.8,22.2 -0.6,29.6 -7.2,21.8 9.2,11.4 -2.2,17.8 -12.8,28.8 19,13.4 3.2,10.6 24.8,-5.4 9.8,-10.6 0,-15.6 8.8,-6 -0.2,-7.4 10.8,-10.4 14.6,16.8 7.4,0.4 11.4,1.6 -6.6,-21.4 10.2,-7.8 -3.4,-9 10.8,-7.6 -15,-9.4 2.2,-9.4 -9.6,-9 3.2,-8.6 -9,0.2 -28.6,-37.8 z" />
                                                    </a>

                                                    <a id="state_Jacobabad" class="state" xlink:href="">
                                                        <path id="Jacobabad" class="shape"
                                                            d="m 853.4,1020.5 -15,45.8 -24.8,-8.2 -22.4,7 -10.4,-2.6 -0.4,21.6 -6.4,2.2 -11.6,-2.4 -8.8,-5.2 -12.2,0 -9.4,-5 10.6,-15.2 32.6,-21.4 11.8,-14.2 z" />
                                                    </a>

                                                    <a id="state_Hyderabad" class="state" xlink:href="">
                                                        <path id="Hyderabad" class="shape"
                                                            d="m 800.2,1408.2 2.2,4.2 11.4,-5.6 0.4,-11.2 -0.8,-5.8 -5.4,0.2 -3.8,-5.8 4.4,-5.8 -3.2,-13.6 6.4,-9.8 -0.6,-10 -15,-18.8 -7.6,5.4 3.6,13.2 -10.8,7.6 3.4,9 -10.2,7.8 6.6,21.4 -11.4,-1.6 2.4,19.2 z" />
                                                    </a>

                                                    <a id="state_Ghotki" class="state" xlink:href="">
                                                        <path id="Ghotki" class="shape"
                                                            d="m 901.8,1130.1 -0.2,7.6 20.6,8 20,-20.6 8.4,-22.6 9.8,-13.4 -18,-8.4 -13,-17.8 -6.2,-24.6 -21,22 -7,-8 -24.6,13 -6.4,11 9.2,29 -10,1 17.8,22.2 z" />
                                                    </a>

                                                    <a id="state_Dadu" class="state" xlink:href="">
                                                        <path id="Dadu" class="shape"
                                                            d="m 752.6,1179.3 -9.2,-9.6 4.4,-8.6 -94.8,-7.2 1.4,73.3 8,26.8 22.8,39.8 12.8,-22.2 9.4,0.2 7.4,-37.2 14.6,5 6,-6.6 -5.6,-22.2 16,-14.9 -3.4,-10 z" />
                                                    </a>

                                                    <a id="state_Badin" class="state" xlink:href="">
                                                        <path id="Badin" class="shape"
                                                            d="m 784.2,1488.8 30,4.6 2,10.2 6.2,-3.4 3,12.2 6.8,-10.8 7,8.2 9.8,-5 -1.2,-18.4 16.4,-10.8 1.6,-17.8 9,-14.2 -2.8,-14.4 -10.2,-3.4 -18.6,-17.6 -4,-22 -6.2,9.4 -18.8,0 -0.4,11.2 -11.4,5.6 15.4,13.8 -1,7.2 -7.2,-0.6 -8,5.8 -6.4,-2.4 -14.4,13.8 z" />
                                                    </a>

                                                    <path id="Sindh_Border" fill="none" stroke="#a08070"
                                                        d="m 911.6,1021.5 -23.6,-6.2 -9.6,4.4 -35,1.2 -56.4,2 -11.8,14.2 -32.6,21.4 -10.6,15.2 -26,11.4 -27.6,6 -15.8,33.6 -9.6,29.2 1.4,73.3 8,26.8 22.8,39.8 -0.6,29.6 -7.2,21.8 -20.8,27.2 -3.4,18.2 -10.6,10.8 -0.4,7.2 -8,9.4 -6.8,0.6 -17,14.6 -5,7.6 20.4,-3.4 9.8,5.8 -0.2,-4.2 12,8.6 0.2,-3.6 10.6,5 5,-2.4 2.2,4.2 -6,3 -5,8 1,4 5.6,-0.4 4,3.2 -6,3.2 3.8,3.8 2.8,12.6 2.8,-2.6 -0.8,9 8.2,1.8 -7.2,3.4 5,25.6 19.8,4 0.2,13.4 -3.8,7.4 11.4,3.2 3.2,-9.4 3,15.6 6.6,-0.4 -2.2,-5.2 11.8,3.6 2,-11.6 16.6,16.6 -1.4,-19.6 5.6,2.4 3.4,12.6 -5,9.6 4.6,2.8 1,-3.8 4.4,5 0.8,-24.2 3.8,14.4 4.6,-14.4 12.8,-9.6 38,2.2 1.4,-36.4 6.2,-3.4 3,12.2 6.8,-10.8 7,8.2 9.8,-5 10.8,3.8 11,-4.8 13.2,0.8 14.8,-1.8 13.4,12.8 30,0.6 8.6,-13.2 26,-8 20.4,-7.6 2,3.4 -3.2,3.8 1.2,12 10,3.4 13.2,0.2 9.8,-5 -3.8,-3.8 11.4,-7.4 3.4,1.2 11,-6.6 -10.4,-2.8 -3,-19.4 9.6,-10.4 -14,-26.4 -7,-26.4 -21,-28 0.6,-31.6 -6,-5.4 -20.2,4.2 -13.4,-3.6 -6.6,-9.6 -10.8,-15.8 -2.2,-14.4 9.2,-21.6 -0.4,-35 -10.2,-5.6 -18.6,2 -39,-21 2.2,-28.7 7.4,-18.8 23.8,-24.6 20,-20.6 8.4,-22.6 9.8,-13.4 -18,-8.4 -13,-17.8 -6.2,-24.6 z" />
                                                </g>

                                                <g id="Labels" font-size="10" font-family="DejaVu Sans"
                                                    transform="translate(-27.1,-28.1)">
                                                    <text y="1491.9277" x="717.02856">THATTA</text>
                                                    <text y="1431.666" x="640.90259">KARACHI</text>
                                                    <text y="1460.0664" x="928.1272">THARPARKAR</text>
                                                    <text y="1465.2412" x="813.07843">BADIN</text>
                                                    <text y="1428.7881" x="788.802">• TANDO MOHAMMAD
                                                        KHAN</text>
                                                    <text y="1345.9844" x="706.37518">JAMSHORO</text>
                                                    <text y="1371.9961" x="725.42206">HYDERABAD •</text>
                                                    <text y="1319.6025" x="739.41626">MATIARI •</text>
                                                    <text y="1262.9736" x="748.87329">NAWABSHAH</text>
                                                    <text y="1316.2168" x="843.80005">SANGHAR</text>
                                                    <text y="1381.916" x="897.29321">UMERKOT</text>
                                                    <text y="1397.0664" x="787.1936">MIRPUR KHAS •</text>
                                                    <text y="1208.4813" x="681.63312">DADU</text>
                                                    <text y="1252.9824" x="856.86255">KHAIRPUR</text>
                                                    <text y="1207.1826" x="758.35571">• NAUSHAHRO
                                                        FIROZE</text>
                                                    <text y="1120.0273" x="600.29907">QAMBAR SHAHDATKOT
                                                        •</text>
                                                    <text y="1145.9004" x="763.85571">• LARKANA</text>
                                                    <text y="1049.502" x="775.41431">JACOBABAD</text>
                                                    <text y="1146.6504" x="847.04028">SUKKUR</text>
                                                    <text y="1098.3662" x="893.1604">GHOTKI</text>
                                                    <text y="1081.3975" x="783.6272">SHIKARPUR</text>
                                                    <text y="1042.9023" x="854.18286">KASHMORE</text>
                                                    <text y="1360.4961" x="818.46613">• TANDO ALLAH
                                                        YAR</text>
                                                </g>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <img width="64" height="64"
                                        src="https://img.icons8.com/nolan/64/user-male--v1.png"
                                        alt="user-male--v1" />
                                    {{ $sindhMale ?? 0 }} <br>
                                    <img width="64" height="64"
                                        src="https://img.icons8.com/nolan/64/1A6DFF/C822FF/standing-woman--v2.png"
                                        alt="standing-woman--v2" /> {{ $sindhFemale ?? 0 }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- =========Punjab======== -->
            <div class="tab-pane fade" id="pills-contacts" role="tabpanel" aria-labelledby="pills-contacts-tab">
                <div class="row" style="height:30vh">
                    <div class="col-9">
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-12">
                                <svg id="listing_map" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="800 300 1028 1244"
                                    style="display: inline;min-height:700px">


                                    <g class="model-green" id="Punjab" fill="#ffffd0" stroke="#d0c0a0"
                                        transform="translate(-27.1,-28.1)">

                                        <a id="state_Vehari" class="state" xlink:href="">
                                            <path id="Vehari" class="shape"
                                                d="m 1123.8,847.1 3.6,2.6 7.6,-1.2 27.6,33 6,-0.4 8,-25.2 17.2,-5.6 12.6,3.8 15.4,-13.8 12.6,-0.8 3,-28 -8.6,-12.4 -35.6,22.8 -6.8,-6.4 -18.2,7.2 -6.6,11.2 -13.2,-5.4 -9.8,11.8 -11.4,1 z" />
                                        </a>

                                        <a id="state_Toba_Tek_Singh" class="state" xlink:href="">
                                            <path id="Toba_Tek_Singh" class="shape"
                                                d="m 1219.8,762.3 -7.2,-3.4 2,-9.4 -5,-7.6 10,-12.8 -3.4,-8.4 9.4,-19.8 -4.8,-6.2 -16.2,10.8 -18.2,2.4 -23.2,36.8 8.4,12.8 -12.2,4.8 -5.2,13.8 40.8,-2 19.6,0.4 z" />
                                        </a>

                                        <a id="state_Sialkot" class="state" xlink:href="">
                                            <path id="Sialkot" class="shape"
                                                d="m 1381.6,541.9 3,-20.8 8.4,9.2 16.6,-11.4 -4.8,14 -1.6,14.4 6.4,12.4 12,-1.2 8,2.8 -6.8,9.2 -4,9.2 -8.6,8.4 1.4,8.4 -8.4,3 -3.4,8.2 -5.8,0.4 -6.8,-8.8 -9,-2.2 -11.6,-9.6 -3.8,-13.8 -3.8,-6.4 0,-11.4 13.2,-2.8 z" />
                                        </a>

                                        <a id="state_Shaikhupura" class="state" xlink:href="">
                                            <path id="Shaikhupura" class="shape"
                                                d="m 1368,660.3 -7.4,19.4 -9.8,10.6 -4.4,0.6 -1,-8.2 -6.6,-0.2 -0.8,-7 -22.6,-9.8 -2.8,-31.4 9.8,-10.2 8.2,-1 -2.4,11.2 25,-1.8 3.4,5.2 4.2,-6.6 18,-2.6 16,-15 -0.8,-5.4 5.8,-0.4 3.4,8 7.6,4.6 -19.4,22.8 -5.2,14.6 z" />
                                        </a>

                                        <a id="state_Sargodha" class="state" xlink:href="">
                                            <path id="Sargodha" class="shape"
                                                d="m 1221.4,636.9 11.4,-14.8 23.2,9.2 12.2,-22.2 -5.2,-14.2 -8.4,-1.4 -8.4,-10.2 3.4,-6.4 -6.2,-4.8 17.2,-9.6 0,-7.6 -60.6,15 -27.8,23 -11.6,53 13.4,4.4 -12.4,15.8 21.2,-10.6 10.8,-10.8 z" />
                                        </a>

                                        <a id="state_Sahiwal" class="state" xlink:href="">
                                            <path id="Sahiwal" class="shape"
                                                d="m 1266.6,781.3 9.8,3.8 -0.8,-16.6 2.6,-8.6 -7,-5.4 -4.8,-12.6 -38.6,22.8 -8,-2.4 -5.2,12.2 -19.6,-0.4 -6.8,21.4 -1.8,20 6.8,6.4 35.6,-22.8 19.4,-2 z" />
                                        </a>

                                        <a id="state_Rawalpindi" class="state" xlink:href="">
                                            <path id="Rawalpindi" class="shape"
                                                d="m 1278,390.2 13.2,-6 8.6,35.9 -3,8.6 6.2,11.2 -6.2,17.8 6.6,17.8 -17.6,8.4 -9.8,-2.2 -3.2,11 -18.2,3.8 -11.8,3.2 -13.8,-11.2 -30,-7.6 8.8,-18.2 17.6,-11.6 -7.8,-18.2 -9,-2.8 3.6,-6.6 -8.2,-9.6 5.8,-5.2 3.8,3.2 12,-3 -5.2,4.8 10.8,4.2 -11.8,3.6 6.4,13.8 18,-8.8 6.8,10.2 -3.8,3 6,4.8 11.2,-7.2 1.6,-9 7.8,-7.8 -3.2,-4.2 -2.8,0.2 -10.6,-7.8 16.6,-9.2 z" />
                                        </a>

                                        <a id="state_Rajanpur" class="state" xlink:href="">
                                            <path id="Rajanpur" class="shape"
                                                d="m 972.2,870.9 -17.8,-3.2 -10.4,21 3.4,27.4 -13,26.6 -9.2,10.8 1.6,20.4 -14.4,23.2 -6.6,1 5.8,23.4 36.8,-15.2 0,-19.6 14.4,2.8 17.4,-10.2 -4.4,-12.2 15.8,-2.8 7.4,-23.8 -5,-6.8 15,-30.8 1.6,-23.4 -11.6,-8.6 -14.6,18.2 z" />
                                        </a>

                                        <a id="state_Rahim_Yar_Khan" class="state" xlink:href="">
                                            <path id="Rahim_Yar_Khan" class="shape"
                                                d="m 1020.4,944.3 -3,11.8 -25.8,8.2 -15.8,2.8 4.4,12.2 -17.4,10.2 -14.4,-2.8 0,19.6 -36.8,15.2 11.6,16.8 6.2,24.6 13,17.8 18,8.4 16,-14.4 19.6,-1.2 11,12 3.2,13.2 5.4,9.6 12.8,1.2 35.8,-16.4 -27.2,-89.8 11,-53.8 -8.4,4 -5.4,-18.6 z" />
                                        </a>

                                        <a id="state_Pakpattan" class="state" xlink:href="">
                                            <path id="Pakpattan" class="shape"
                                                d="m 1266.6,781.3 -18.4,15.8 -19.4,2 8.6,12.4 -3,28 10.8,4.4 4.6,-8 30.2,-10 26.2,-18.4 -1,-20.6 -18.2,-11.8 -10.6,10 z" />
                                        </a>

                                        <a id="state_Okara" class="state" xlink:href="">
                                            <path id="Okara" class="shape"
                                                d="m 1278.2,759.9 -2.6,8.6 0.8,16.6 10.6,-10 18.2,11.8 1,20.6 21.2,-3.4 5.6,-11.2 10.8,-8.8 3.8,1.6 2.2,-10 13.2,-12.8 -14,-3.8 -10.8,-9.6 -12.6,-1.8 -17.8,-21.2 0,-10.8 -16.8,6 -12.4,11.8 -4.4,-0.4 -7.8,8.8 4.8,12.6 z" />
                                        </a>

                                        <a id="state_Narowal" class="state" xlink:href="">
                                            <path id="Narowal" class="shape"
                                                d="m 1422.8,570.5 6.8,-9.2 7.4,2.8 7.8,-5.2 7.8,8.2 6,-0.4 12.4,9.2 7,9.6 -14.8,20.4 -2.2,-4 -21.4,10.4 -6.6,-3.6 -13,13 -9.2,-1.4 -7.6,-4.6 -3.4,-8 3.4,-8.2 8.4,-3 -1.4,-8.4 8.6,-8.4 z" />
                                        </a>

                                        <a id="state_Nankana_Sahab" class="state" xlink:href="">
                                            <path id="Nankana_Sahab" class="shape"
                                                d="m 1285,665.1 8,20.8 8.6,-3.8 8.6,8.8 -4,10.2 -20.8,13.8 -10,9.6 -1.2,8.6 4.4,0.4 12.4,-11.8 16.8,-6 9.2,-5.4 12,-3 5.4,-5.6 9.6,-2.4 2.4,-8.4 -1,-8.2 -6.6,-0.2 -0.8,-7 -22.6,-9.8 -2.8,-31.4 -13.2,1.8 -8.6,6.2 -22.4,7.8 z" />
                                        </a>

                                        <a id="state_Muzaffargarh" class="state" xlink:href="">
                                            <path id="Muzaffargarh" class="shape"
                                                d="m 1010.6,879.5 -1.6,23.4 -15,30.8 5,6.8 -7.4,23.8 25.8,-8.2 3,-11.8 13.8,-9.4 13.8,-25 0.8,-24.8 13.4,-6.6 -1.6,-27 30,-54 -6.4,-2 8.6,-17.4 -33.4,-21 -7,12.8 -32.6,1.6 3.8,25 -4,24.4 6.4,33 z" />
                                        </a>

                                        <a id="state_Multan" class="state" xlink:href="">
                                            <path id="Multan" class="shape"
                                                d="m 1067.6,904.3 12.8,6.4 5.4,-41.2 21.8,-25.6 16.6,-27.6 -33.6,-18.8 -30,54 1.6,27 -13.4,6.6 -0.8,24.8 z" />
                                        </a>

                                        <a id="state_Mianwali" class="state" xlink:href="">
                                            <path id="Mianwali" class="shape"
                                                d="m 1127,556.1 -11.6,10.4 4,7.6 -9.2,12.8 1,10.8 -58.8,1 11,-21.8 10,-3.8 0.6,-18.8 -9.6,3.6 0.2,-10.6 -7.6,0 -6.4,-19 3.6,-19.6 12.8,-8 15.2,-1.6 2.2,-7.4 -6.2,-18.4 18.4,2.2 4.8,12.6 10.8,4.6 -3.6,12.8 10.8,-2.2 12,19.8 -6.8,9.8 z" />
                                        </a>

                                        <a id="state_Mandi_Bahauddin" class="state" xlink:href="">
                                            <path id="Mandi_Bahauddin" class="shape"
                                                d="m 1293.2,588.5 -9.6,13.2 -15.4,7.4 -5.2,-14.2 -8.4,-1.4 -8.4,-10.2 3.4,-6.4 -6.2,-4.8 17.2,-9.6 0,-7.6 9.2,-4.2 5.4,3 20,-12.8 3.4,-5.8 29.2,36 -17.6,9.6 z" />
                                        </a>

                                        <a id="state_Lodhran" class="state" xlink:href="">
                                            <path id="Lodhran" class="shape"
                                                d="m 1094.4,913.5 68.2,-32 -27.6,-33 -7.6,1.2 -3.6,-2.6 -16.2,-3.2 -21.8,25.6 -5.4,41.2 z" />
                                        </a>

                                        <a id="state_Layyah" class="state" xlink:href="">
                                            <path id="Layyah" class="shape"
                                                d="m 1120.6,739.5 -4.6,-28.6 -19.2,-8.2 -10.2,10.4 -14,1 -13.4,-21.6 -35.2,-7.6 -7.6,14.4 2.4,46.8 -4.2,9.2 5.2,16.2 32.6,-1.6 7,-12.8 33.4,21 3.6,6 6,-14 z" />
                                        </a>

                                        <a id="state_Lahore" class="state" xlink:href="">
                                            <path id="Lahore" class="shape"
                                                d="m 1346.4,690.9 4.4,-0.6 9.8,-10.6 7.4,-19.4 18.2,-2.6 5.2,-14.6 12.4,34 -9,19.6 -8.2,-2 -2.6,4.6 -18.2,6 -21.8,-6 z" />
                                        </a>

                                        <a id="state_Khushab" class="state" xlink:href="">
                                            <path id="Khushab" class="shape"
                                                d="m 1172.2,592.9 27.8,-23 -2,-15 -11.2,-13.2 -11.2,6.6 -24.6,-11.6 -4,8.4 -20,11 -11.6,10.4 4,7.6 -9.2,12.8 1,10.8 1.6,16 -14.6,19.8 13.2,21.2 24.6,18 16.8,-22.6 7.8,-4.2 z" />
                                        </a>

                                        <a id="state_Khanewal" class="state" xlink:href="">
                                            <path id="Khanewal" class="shape"
                                                d="m 1107.6,843.9 16.2,3.2 3.4,-5.8 11.4,-1 9.8,-11.8 13.2,5.4 6.6,-11.2 18.2,-7.2 1.8,-20 6.8,-21.4 -40.8,2 5.2,-13.8 -43.6,13.8 -13.4,-6 -6,14 -3.6,-6 -8.6,17.4 6.4,2 33.6,18.8 z" />
                                        </a>

                                        <a id="state_Kasur" class="state" xlink:href="">
                                            <path id="Kasur" class="shape"
                                                d="m 1344,699.3 21.8,6 18.2,-6 2.6,-4.6 8.2,2 -0.4,18.6 11.8,3 2.4,4.8 -4.8,5 -8.6,-4.8 -0.6,8.2 -18.2,12.2 -13.4,19.2 -14,-3.8 -10.8,-9.6 -12.6,-1.8 -17.8,-21.2 0,-10.8 9.2,-5.4 12,-3 5.4,-5.6 z" />
                                        </a>

                                        <a id="state_Jhelum" class="state" xlink:href="">
                                            <path id="Jhelum" class="shape"
                                                d="m 1252.8,539.3 10.2,-0.4 -4,-7.6 -10.2,-1.4 -1.2,-7 8.4,-10 -1.4,-16.4 18.2,-3.8 3.2,-11 9.8,2.2 17.6,-8.4 2.6,7 -3.2,7.2 17.6,9.8 -1,6.4 -19.2,20.8 -1.6,8.4 -3.4,5.8 -20,12.8 -5.4,-3 -9.2,4.2 -60.6,15 -2,-15 7,-4.2 3,5 5.8,-8 25,-4.8 5.4,1.4 z" />
                                        </a>

                                        <a id="state_Jhang" class="state" xlink:href="">
                                            <path id="Jhang" class="shape"
                                                d="m 1159.4,762.3 12.2,-4.8 -8.4,-12.8 23.2,-36.8 18.2,-2.4 16.2,-10.8 -1.2,-5.8 -8.8,4 -22.4,-14.8 -5.6,-22.6 -21.2,10.6 12.4,-15.8 -13.4,-4.4 -7.8,4.2 -16.8,22.6 -0.4,30 -10.6,-1.8 -9,10 4.6,28.6 -18.2,30.6 13.4,6 z" />
                                        </a>

                                        <a id="state_Hafizabad" class="state" xlink:href="">
                                            <path id="Hafizabad" class="shape"
                                                d="m 1290.8,642.3 -22.4,7.8 -8,-6.6 -4.4,-12.2 12.2,-22.2 15.4,-7.4 9.6,-13.2 17,-7.8 4.2,13.2 7.8,9.4 3.6,12 -3.4,8.8 -9.8,10.2 -13.2,1.8 z" />
                                        </a>

                                        <a id="state_Gujranwala" class="state" xlink:href="">
                                            <path id="Gujranwala" class="shape"
                                                d="m 1359,567.3 3.8,6.4 3.8,13.8 11.6,9.6 9,2.2 6.8,8.8 0.8,5.4 -16,15 -18,2.6 -4.2,6.6 -3.4,-5.2 -25,1.8 2.4,-11.2 -8.2,1 3.4,-8.8 -3.6,-12 -7.8,-9.4 -4.2,-13.2 17.6,-9.6 11,0.6 20.2,-15.8 z" />
                                        </a>

                                        <a id="state_Gujrat" class="state" xlink:href="">
                                            <path id="Gujrat" class="shape"
                                                d="m 1327.8,571.1 -29.2,-36 1.6,-8.4 19.2,-20.8 1,-6.4 11.6,-3 9,10 30.8,15 12.8,-0.4 -3,20.8 -9.4,11.2 -13.2,2.8 -20.2,15.8 z" />
                                        </a>

                                        <a id="state_Faisalabad" class="state" xlink:href="">
                                            <path id="Faisalabad" class="shape"
                                                d="m 1216.2,720.7 3.4,8.4 -10,12.8 5,7.6 -2,9.4 7.2,3.4 8,2.4 38.6,-22.8 7.8,-8.8 1.2,-8.6 10,-9.6 20.8,-13.8 4,-10.2 -8.6,-8.8 -8.6,3.8 -8,-20.8 -16.6,-15 -8,-6.6 -40.8,45.4 1.2,5.8 4.8,6.2 z" />
                                        </a>

                                        <a id="state_Dera_Ghazi_Khan" class="state" xlink:href="">
                                            <path id="Dera_Ghazi_Khan" class="shape"
                                                d="m 979,705.5 -13.4,6.4 0.6,10 -3,0.4 -1.2,23.4 2.2,6.2 -6.2,0.8 -12,13.2 1,9.2 -10.6,20.8 -4.2,17.4 3.6,7 9.6,-3.8 -7.6,15.2 -8.2,23.8 -15.6,22.8 -13.4,5.4 -4.2,26.8 10.6,3.4 -2.2,7 4.8,6.6 5.4,-3 -4.6,24 -21,21.8 3.8,10.8 -8.6,20.2 -11.2,6.4 5,12 9.6,-4.4 23.6,6.2 -5.8,-23.4 6.6,-1 14.4,-23.2 -1.6,-20.4 9.2,-10.8 13,-26.6 -3.4,-27.4 10.4,-21 17.8,3.2 12.2,18.2 14.6,-18.2 11.6,8.6 15.4,-25.6 -6.4,-33 4,-24.4 -3.8,-25 -5.2,-16.2 4.2,-9.2 -2.4,-46.8 -7.2,-6 -13.6,-1.6 z" />
                                        </a>

                                        <a id="state_Chiniot" class="state" xlink:href="">
                                            <path id="Chiniot" class="shape"
                                                d="m 1221.4,636.9 -27.8,7.8 -10.8,10.8 5.6,22.6 22.4,14.8 8.8,-4 40.8,-45.4 -4.4,-12.2 -23.2,-9.2 z" />
                                        </a>

                                        <a id="state_Chakwal" class="state" xlink:href="">
                                            <path id="Chakwal" class="shape"
                                                d="m 1184.2,490.5 -23.2,2 -5.2,-4 -6.4,5.6 -7.2,-2.6 -22.8,11.8 12,19.8 -6.8,9.8 2.4,23.2 20,-11 4,-8.4 24.6,11.6 11.2,-6.6 11.2,13.2 7,-4.2 3,5 5.8,-8 25,-4.8 5.4,1.4 8.6,-5 10.2,-0.4 -4,-7.6 -10.2,-1.4 -1.2,-7 8.4,-10 -1.4,-16.4 -11.8,3.2 -13.8,-11.2 -30,-7.6 -6.6,-1.6 z" />
                                        </a>

                                        <a id="state_Bhakkar" class="state" xlink:href="">
                                            <path id="Bhakkar" class="shape"
                                                d="m 1135.6,702.7 0.4,-30 -24.6,-18 -13.2,-21.2 14.6,-19.8 -1.6,-16 -58.8,1 -9.8,30.6 -15.8,23.2 -4.4,16.6 6,1 -4.4,14.8 35.2,7.6 13.4,21.6 14,-1 10.2,-10.4 19.2,8.2 9,-10 z" />
                                        </a>

                                        <a id="state_Bahawalpur" class="state" xlink:href="">
                                            <path id="Bahawalpur" class="shape"
                                                d="m 1168.6,881.1 -6,0.4 -68.2,32 -14,-2.8 -12.8,-6.4 -19.6,5.6 -13.8,25 5.4,18.6 8.4,-4 -11,53.8 27.2,89.8 50.2,-7 15.4,-6.2 2.2,-17.4 26.2,-28 11.8,-35.2 9.4,-12.8 20.8,-11.6 -8,-25.8 -12.6,0 -3.6,-12.6 6,-5.8 39.8,0 4.2,-13.8 -12,-7 8.4,-27.2 -15.8,-17 -0.2,-11.6 -12.6,-3.8 -17.2,5.6 z" />
                                        </a>

                                        <a id="state_Bahawalnagar" class="state" xlink:href="">
                                            <path id="Bahawalnagar" class="shape"
                                                d="m 1280,825.9 -30.2,10 -4.6,8 -10.8,-4.4 -12.6,0.8 -15.4,13.8 0.2,11.6 15.8,17 -8.4,27.2 12,7 -4.2,13.8 -39.8,0 -6,5.8 3.6,12.6 12.6,0 8,25.8 34.6,-19.6 30.8,-55.2 13.8,-47.4 40.8,-15.2 16.2,-13.8 -2.2,-13.2 -6.8,-6.4 -21.2,3.4 z" />
                                        </a>

                                        <a id="state_Attock" class="state" xlink:href="">
                                            <path id="Attock" class="shape"
                                                d="m 1207.8,462.7 -8.8,18.2 -6.6,-1.6 -8.2,11.2 -23.2,2 -5.2,-4 -6.4,5.6 -7.2,-2.6 -22.8,11.8 -10.8,2.2 3.6,-12.8 4.2,-12.8 -5.6,-10.4 2.4,-9.4 14,-6.4 9.2,-14 7.8,-25.2 21,-2.2 0,-18.7 20.4,-9.4 17.2,9.4 -2.6,5.4 7.2,2.5 7,-7.3 8.6,5.8 2.6,8.9 -12,3 -3.8,-3.2 -5.8,5.2 8.2,9.6 -3.6,6.6 9,2.8 7.8,18.2 z" />
                                        </a>

                                        <path id="Punjab_Border" fill="none" stroke="#a08070"
                                            d="m 1303,439.9 -6.2,-11.2 3,-8.6 -8.6,-35.9 -13.2,6 -4.6,9.3 -16.6,9.2 10.6,7.8 2.8,-0.2 3.2,4.2 -7.8,7.8 -1.6,9 -11.2,7.2 -6,-4.8 3.8,-3 -6.8,-10.2 -18,8.8 -6.4,-13.8 11.8,-3.6 -10.8,-4.2 5.2,-4.8 -2.6,-8.9 -8.6,-5.8 -7,7.3 -7.2,-2.5 2.6,-5.4 -17.2,-9.4 -20.4,9.4 0,18.7 -21,2.2 -7.8,25.2 -9.2,14 -14,6.4 -2.4,9.4 5.6,10.4 -4.2,12.8 -10.8,-4.6 -4.8,-12.6 -18.4,-2.2 6.2,18.4 -2.2,7.4 -15.2,1.6 -12.8,8 -3.6,19.6 6.4,19 7.6,0 -0.2,10.6 9.6,-3.6 -0.6,18.8 -10,3.8 -11,21.8 -9.8,30.6 -15.8,23.2 -4.4,16.6 6,1 -4.4,14.8 -7.6,14.4 -7.2,-6 -13.6,-1.6 -16.6,13.8 -13.4,6.4 0.6,10 -3,0.4 -1.2,23.4 2.2,6.2 -6.2,0.8 -12,13.2 1,9.2 -10.6,20.8 -4.2,17.4 3.6,7 9.6,-3.8 -7.6,15.2 -8.2,23.8 -15.6,22.8 -13.4,5.4 -4.2,26.8 10.6,3.4 -2.2,7 4.8,6.6 5.4,-3 -4.6,24 -21,21.8 3.8,10.8 -8.6,20.2 -11.2,6.4 5,12 9.6,-4.4 23.6,6.2 11.6,16.8 6.2,24.6 13,17.8 18,8.4 16,-14.4 19.6,-1.2 11,12 3.2,13.2 5.4,9.6 12.8,1.2 35.8,-16.4 50.2,-7 15.4,-6.2 2.2,-17.4 26.2,-28 11.8,-35.2 9.4,-12.8 20.8,-11.6 34.6,-19.6 30.8,-55.2 13.8,-47.4 40.8,-15.2 16.2,-13.8 -2.2,-13.2 -6.8,-6.4 5.6,-11.2 10.8,-8.8 3.8,1.6 2.2,-10 13.2,-12.8 13.4,-19.2 18.2,-12.2 0.6,-8.2 8.6,4.8 4.8,-5 -2.4,-4.8 -11.8,-3 0.4,-18.6 9,-19.6 -12.4,-34 19.4,-22.8 9.2,1.4 13,-13 6.6,3.6 21.4,-10.4 2.2,4 14.8,-20.4 -7,-9.6 -12.4,-9.2 -6,0.4 -7.8,-8.2 -7.8,5.2 -7.4,-2.8 -8,-2.8 -12,1.2 -6.4,-12.4 1.6,-14.4 4.8,-14 -16.6,11.4 -8.4,-9.2 -12.8,0.4 -30.8,-15 -9,-10 -11.6,3 -17.6,-9.8 3.2,-7.2 -2.6,-7 -6.6,-17.8 z" />
                                    </g>

                                    <g id="Labels" font-size="10" font-family="DejaVu Sans"
                                        transform="translate(-27.1,-28.1)">

                                        <text y="1034.8398" x="944.83813">RAHIM YAR KHAN</text>
                                        <text y="974.3457" x="1085.092">BAHAWALPUR</text>
                                        <text y="904.82227" x="1151.7288">BAHAWALNAGAR •</text>
                                        <text y="955.50684" x="937.28442">RAJANPUR</text>
                                        <text y="792.50684" x="977.92017">• DERA GHAZI KHAN</text>
                                        <text y="852.76074" x="1079.0706">• MULTAN</text>
                                        <text y="788.75977" x="1204.928">SAHIWAL</text>
                                        <text y="800.25977" x="1117.8713">KHANEWAL</text>
                                        <text y="766.84277" x="1294.844">OKARA</text>
                                        <text y="706.75879" x="1230.5881">FAISALABAD</text>
                                        <text y="679.79395" x="1231.2582">NAKANA SAHAB •</text>
                                        <text y="654.79297" x="1343.3733">• SHAIKHUPURA</text>
                                        <text y="599.49219" x="1275.1819">GUJRANWALA •</text>
                                        <text y="538.46094" x="1322.6311">GUJRAT</text>
                                        <text y="575.12598" x="1370.1799">SIALKOT</text>
                                        <text y="592.45996" x="1417.3508">NAROWAL</text>
                                        <text y="623.12598" x="1265.9055">HAFIZABAD</text>
                                        <text y="573.46289" x="1190.178">MANDI BAHAUDDIN •</text>
                                        <text y="680.88281" x="1377.5959">• LAHORE</text>
                                        <text y="730.09277" x="1337.5393">KASUR</text>
                                        <text y="699.42773" x="1149.1526">JHANG</text>
                                        <text y="658.76172" x="1200.8772">CHINIOT</text>
                                        <text y="610.76172" x="1186.8147">SARGODHA</text>
                                        <text y="751.4082" x="1106.1428">TOBA TEK SINGH •</text>
                                        <text y="882.09375" x="1092.3186">LODHRAN</text>
                                        <text y="844.75977" x="1166.1506">VEHARI</text>
                                        <text y="810.75977" x="1239.0375">PAKPATTAN</text>
                                        <text y="842.42773" x="959.29517">MUZAFFARGARH •</text>
                                        <text y="739.42773" x="1047.0354">LAYYAH</text>
                                        <text y="666.09375" x="1050.2034">BHAKKAR</text>
                                        <text y="603.42676" x="1116.595">KHUSHAB</text>
                                        <text y="526.76062" x="1064.0432">MIANWALI</text>
                                        <text y="520.09375" x="1166.0393">CHAKWAL</text>
                                        <text y="463.59277" x="1145.1545">ATTOCK</text>
                                        <text y="470.09277" x="1224.9846">RAWALPINDI</text>
                                        <text y="512.76172" x="1264.0969">JHELUM</text>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <img width="64" height="64" src="https://img.icons8.com/nolan/64/user-male--v1.png"
                            alt="user-male--v1" />
                        {{ $punjabMale ?? 0 }} <br>
                        <img width="64" height="64"
                            src="https://img.icons8.com/nolan/64/1A6DFF/C822FF/standing-woman--v2.png"
                            alt="standing-woman--v2" /> {{ $punjabFemale ?? 0 }}
                    </div>
                </div>
            </div>
            <!-- =========KPK======== -->
            <div class="tab-pane fade" id="pills-contacta" role="tabpanel" aria-labelledby="pills-contacta-tab">
                <div class="row">
                    <div class="col-9">
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-12">
                                <svg id="listing_map" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="600 0 828 744"
                                    style="display: inline;min-height:700px">


                                    <g class="model-green" id="Khyber Pakhtunkhwa" fill="#ffffd0"
                                        stroke="#d0c0a0" transform="translate(-27.1,-28.1)">

                                        <a id="state_Upper_Dir" class="state" xlink:href="">
                                            <path id="Upper_Dir" class="shape"
                                                d="m 1093.4,260.2 1.8,8 31.2,-3.6 12.4,19.6 12.6,0.2 17.6,-40 6.2,-29 -14.6,-24 1,-4.2 -8,-2.8 -46.4,63.6 z" />
                                        </a>

                                        <a id="state_Tank" class="state" xlink:href="">
                                            <path id="Tank" class="shape"
                                                d="m 951.2,614.5 -5,-21.4 30.2,-21 9.4,-14.4 10,6 2.6,-6.2 13,11.4 -3.8,17.2 -13.6,18.8 -36,13 z" />
                                        </a>

                                        <a id="state_Swat" class="state" xlink:href="">
                                            <path id="Swat" class="shape"
                                                d="m 1169,244.4 -17.6,40 7.8,13 -7.4,9.6 2.6,10.2 7,0 27.8,-15.4 6.6,-33.4 12.8,-19.4 7,-19.8 -4.6,-6.4 11.4,-50.8 -15.4,4.4 -15.8,-9.4 -13.2,19.2 -16.4,1 -1,4.2 14.6,24 z" />
                                        </a>

                                        <a id="state_Swabi" class="state" xlink:href="">
                                            <path id="Swabi" class="shape"
                                                d="m 1165.2,393.6 20.4,-9.4 32.4,-24.2 -7.8,-18 -17,17.6 -12,-3.6 8,-16.2 -7,-2.2 -10.2,14.6 -9.8,2.6 -1.8,16.8 z" />
                                        </a>

                                        <a id="state_Shangla" class="state" xlink:href="">
                                            <path id="Shangla" class="shape"
                                                d="m 1217.8,269.4 -9.2,-20.4 -12.8,19.4 -6.6,33.4 7.6,7.2 11,-5.8 3.2,16.2 8,-6 -2.2,-9 3.6,-14.2 5.2,3.2 4.6,-15.6 -3.6,-9.4 z" />
                                        </a>

                                        <a id="state_Peshawar" class="state" xlink:href="">
                                            <path id="Peshawar" class="shape"
                                                d="m 1089,406.1 0.2,9 9.4,3 10.6,-3.8 4.2,-7.2 3.4,-14.9 -5.4,-17.2 -25.6,-12.4 -9.8,13 5,25.9 z" />
                                        </a>

                                        <a id="state_Nowshera" class="state" xlink:href="">
                                            <path id="Nowshera" class="shape"
                                                d="m 1165.2,393.6 -4.8,-22 -7.2,2.8 -20.8,-5.6 -6.4,12.8 -14.6,-6.6 5.4,17.2 -3.4,14.9 10.2,6.8 1.4,4.2 19.2,-3.6 21,-2.2 z" />
                                        </a>

                                        <a id="state_Mardan" class="state" xlink:href="">
                                            <path id="Mardan" class="shape"
                                                d="m 1121.8,350.4 10.6,18.4 20.8,5.6 7.2,-2.8 1.8,-16.8 9.8,-2.6 10.2,-14.6 -18.8,-6 -2.4,-7.2 -21.2,1.8 -15.6,15.8 z" />
                                        </a>

                                        <a id="state_Mansehra" class="state" xlink:href="">
                                            <path id="Mansehra" class="shape"
                                                d="m 1225.6,293.4 -5.2,-3.2 -3.6,14.2 2.2,9 -8,6 -3,7 5,9.2 12.4,4.6 11,10 20.2,-3.4 15.8,-16 11,-2 3,-9 16.6,1 9,-23.4 25.4,-11 11.4,-18.6 -2.8,-4.2 6.6,-7.4 -21.2,-9.4 -16,14.2 -20.4,2.8 -10.2,11.6 -12,22.8 -14.2,-6 -12,18.4 -17.2,0.4 z" />
                                        </a>

                                        <a id="state_Malakand" class="state" xlink:href="">
                                            <path id="Malakand" class="shape"
                                                d="m 1107.6,333.2 -5,-8.8 3.8,-10 8.6,-5 36.8,-2.4 2.6,10.2 7,0 -0.4,7.2 -21.2,1.8 -15.6,15.8 z" />
                                        </a>

                                        <a id="state_Lower_Dir" class="state" xlink:href="">
                                            <path id="Lower_Dir" class="shape"
                                                d="m 1151.4,284.4 -12.6,-0.2 -12.4,-19.6 -31.2,3.6 -5.4,6.4 10,17 15.6,4.2 -0.4,13.6 36.8,-2.4 7.4,-9.6 z" />
                                        </a>

                                        <a id="state_Lakki_Marwat" class="state" xlink:href="">
                                            <path id="Lakki_Marwat" class="shape"
                                                d="m 986.4,544.3 12,13.2 13,11.4 -3.8,17.2 56.8,-28.2 0.2,-10.6 -7.6,0 -6.4,-19 -15.8,-10.8 -18.4,10.8 -17.8,-5.2 -19.6,13.2 z" />
                                        </a>

                                        <a id="state_Kohistan" class="state" xlink:href="">
                                            <path id="Kohistan" class="shape"
                                                d="m 1215.6,229.2 -7,19.8 9.2,20.4 8.8,-1 3.6,9.4 12,-7 42.6,4.6 10.2,-11.6 20.4,-2.8 16,-14.2 -18.6,-1.6 -3,-11.2 1.4,-11.4 9.4,-10 -53,-13 -16,-14 0.6,-11.6 -4.8,-3 -9.8,3.6 -15.2,-2.6 -11.4,50.8 z" />
                                        </a>

                                        <a id="state_Kohat" class="state" xlink:href="">
                                            <path id="Kohat" class="shape"
                                                d="m 1050.2,418.1 -2.4,15.8 16.6,2.6 -14,23.4 27.8,13.4 18.4,2.2 4.8,12.6 10.8,4.6 4.2,-12.8 -5.6,-10.4 2.4,-9.4 14,-6.4 9.2,-14 7.8,-25.2 -19.2,3.6 -5,5 2,6 -13.8,11.2 -8,0.8 -3,-5.4 4.2,-4.8 -18.4,-3.6 -10.2,1.8 -16.6,-11.6 z" />
                                        </a>

                                        <a id="state_Karak" class="state" xlink:href="">
                                            <path id="Karak" class="shape"
                                                d="m 1029,464.1 -16.6,9.4 13.2,5.2 -15.8,16.4 20.6,5.8 4.4,16.6 15.8,10.8 3.6,-19.6 12.8,-8 15.2,-1.6 2.2,-7.4 -6.2,-18.4 -27.8,-13.4 z" />
                                        </a>

                                        <a id="state_Haripur" class="state" xlink:href="">
                                            <path id="Haripur" class="shape"
                                                d="m 1185.6,384.2 17.2,9.4 -2.6,5.4 7.2,2.5 7,-7.3 8.6,5.8 2.6,8.9 -5.2,4.8 10.8,4.2 25.6,-9.2 3,-19.5 -8.8,-3.8 4.6,-14.4 -9.4,0 1,-6.6 -10.8,-14.2 -11,-10 -12.4,-4.6 -2.8,6.4 7.8,18 z" />
                                        </a>

                                        <a id="state_Hangu" class="state" xlink:href="">
                                            <path id="Hangu" class="shape"
                                                d="m 1029,464.1 -16.6,9.4 -10.8,-4.2 -4.8,-5.8 -9.2,-11.2 23.4,-8.2 3.2,-10 17,2.8 16.6,-3 16.6,2.6 -14,23.4 z" />
                                        </a>

                                        <a id="state_Dera_Ismail_Khan" class="state" xlink:href="">
                                            <path id="Dera_Ismail_Khan" class="shape"
                                                d="m 1016.4,699.3 7.6,-14.4 4.4,-14.8 -6,-1 4.4,-16.6 15.8,-23.2 9.8,-30.6 11,-21.8 10,-3.8 0.6,-18.8 -9.6,3.6 -56.8,28.2 -13.6,18.8 -36,13 2.6,27.2 18.4,60.4 16.6,-13.8 13.6,1.6 z" />
                                        </a>

                                        <a id="state_Chitral" class="state" xlink:href="">
                                            <path id="Chitral" class="shape"
                                                d="m 1130.6,97.4 2.8,-6.4 16,-4.2 0.6,-5.8 11.2,-2 -1.8,-3.2 4.6,-7 25.4,-2.8 14.2,-8.2 28.6,0.4 4.4,-3.2 5.8,1.6 11.8,-4 21.2,1.6 28.6,-2.6 8.4,8.2 12.8,5.4 -0.6,9 -26.2,0 -21.4,-4.8 -32.4,8.6 2.6,7.8 -11.6,15.6 -7.4,1.4 -2.8,8.6 -30.8,18.4 -2.6,17.4 4.4,7.4 -5.2,12.4 -13.2,19.2 -16.4,1 -8,-2.8 -46.4,63.6 -12,-11.6 9.4,-18 -5.4,-5.2 1.8,-8.6 -11.2,-6.2 4.6,-10.8 -6.6,-4.8 -1.2,-8.4 -9.2,-13.6 -17.4,-9.4 4.4,-10 31.4,-23.4 0.2,-5.8 8.6,-12.2 19.6,11.4 1.8,-5.2 -4.4,-1.6 1.4,-7.2 z" />
                                        </a>

                                        <a id="state_Charsadda" class="state" xlink:href="">
                                            <path id="Charsadda" class="shape"
                                                d="m 1107.6,333.2 16.6,8.8 -2.4,8.4 10.6,18.4 -6.4,12.8 -14.6,-6.6 -25.6,-12.4 z" />
                                        </a>

                                        <a id="state_Buner" class="state" xlink:href="">
                                            <path id="Buner" class="shape"
                                                d="m 1196.8,309 11,-5.8 3.2,16.2 -3,7 5,9.2 -2.8,6.4 -17,17.6 -12,-3.6 8,-16.2 -7,-2.2 -18.8,-6 -2.4,-7.2 0.4,-7.2 27.8,-15.4 z" />
                                        </a>

                                        <a id="state_Battagram" class="state" xlink:href="">
                                            <path id="Battagram" class="shape"
                                                d="m 1242.2,270.8 42.6,4.6 -12,22.8 -14.2,-6 -12,18.4 -17.2,0.4 -3.8,-17.6 4.6,-15.6 z" />
                                        </a>

                                        <a id="state_Bannu" class="state" xlink:href="">
                                            <path id="Bannu" class="shape"
                                                d="m 976.4,521.3 2.6,15 19.6,-13.2 17.8,5.2 18.4,-10.8 -4.4,-16.6 -20.6,-5.8 -17.2,-0.8 z" />
                                        </a>

                                        <a id="state_Abbotabad" class="state" xlink:href="">
                                            <path id="Abbotabad" class="shape"
                                                d="m 1291.2,384.2 -11.4,-44.6 3.6,-10.8 -11,2 -15.8,16 -20.2,3.4 10.8,14.2 -1,6.6 9.4,0 -4.6,14.4 8.8,3.8 -3,19.5 16.6,-9.2 4.6,-9.3 z" />
                                        </a>

                                        <path id="Khyber_Pakhtunkhwah_Border" fill="none" stroke="#a08070"
                                            d="m 1244.6,78 32.4,-8.6 21.4,4.8 26.2,0 0.6,-9 -12.8,-5.4 -8.4,-8.2 -28.6,2.6 -21.2,-1.6 -11.8,4 -5.8,-1.6 -4.4,3.2 -28.6,-0.4 -14.2,8.2 -25.4,2.8 -4.6,7 1.8,3.2 -11.2,2 -0.6,5.8 -16,4.2 -2.8,6.4 -7.6,0 -1.4,7.2 4.4,1.6 -1.8,5.2 -19.6,-11.4 -8.6,12.2 -0.2,5.8 -31.4,23.4 -4.4,10 17.4,9.4 9.2,13.6 1.2,8.4 6.6,4.8 -4.6,10.8 11.2,6.2 -1.8,8.6 5.4,5.2 -9.4,18 12,11.6 -13.8,12.2 1.8,8 -5.4,6.4 10,17 15.6,4.2 -0.4,13.6 -8.6,5 -3.8,10 5,8.8 -21.8,29.4 -9.8,13 5,25.9 8,4.6 0.2,9 9.4,3 10.6,-3.8 4.2,-7.2 10.2,6.8 1.4,4.2 -5,5 2,6 -13.8,11.2 -8,0.8 -3,-5.4 4.2,-4.8 -18.4,-3.6 -10.2,1.8 -16.6,-11.6 -6,0.6 -2.4,15.8 -16.6,3 -17,-2.8 -3.2,10 -23.4,8.2 14,17 10.8,4.2 13.2,5.2 -15.8,16.4 -17.2,-0.8 -16.2,27 2.6,15 7.4,8 12,13.2 -2.6,6.2 -10,-6 -9.4,14.4 -30.2,21 5,21.4 6.8,3.4 2.6,27.2 18.4,60.4 16.6,-13.8 13.6,1.6 7.2,6 7.6,-14.4 4.4,-14.8 -6,-1 4.4,-16.6 15.8,-23.2 9.8,-30.6 11,-21.8 10,-3.8 0.6,-18.8 -9.6,3.6 0.2,-10.6 -7.6,0 -6.4,-19 3.6,-19.6 12.8,-8 15.2,-1.6 2.2,-7.4 -6.2,-18.4 18.4,2.2 4.8,12.6 10.8,4.6 4.2,-12.8 -5.6,-10.4 2.4,-9.4 14,-6.4 9.2,-14 7.8,-25.2 21,-2.2 0,-18.7 20.4,-9.4 17.2,9.4 -2.6,5.4 7.2,2.5 7,-7.3 8.6,5.8 2.6,8.9 -5.2,4.8 10.8,4.2 25.6,-9.2 16.6,-9.2 4.6,-9.3 13.2,-6 -11.4,-44.6 3.6,-10.8 3,-9 16.6,1 9,-23.4 25.4,-11 11.4,-18.6 -2.8,-4.2 6.6,-7.4 -21.2,-9.4 -18.6,-1.6 -3,-11.2 1.4,-11.4 9.4,-10 -53,-13 -16,-14 0.6,-11.6 -4.8,-3 -9.8,3.6 -15.2,-2.6 -15.4,4.4 -15.8,-9.4 5.2,-12.4 -4.4,-7.4 2.6,-17.4 30.8,-18.4 2.8,-8.6 7.4,-1.4 11.6,-15.6 z" />
                                    </g>

                                    <g class="model-green" id="FATA" fill="#ffffd0" stroke="#d0c0a0"
                                        transform="translate(-27.1,-28.1)">

                                        <a id="state_FR_Tank" class="state" xlink:href="">
                                            <path id="FR_Tank" class="shape"
                                                d="m 946.2,593.1 -2,-34.2 24.8,-8.8 17.4,-5.8 12,13.2 -2.6,6.2 -10,-6 -9.4,14.4 z" />
                                        </a>

                                        <a id="state_FR_Peshawar" class="state" xlink:href="">
                                            <path id="FR_Peshawar" class="shape"
                                                d="m 1120,423.1 5,-5 -1.4,-4.2 -10.2,-6.8 -4.2,7.2 -10.6,3.8 23.4,11 z" />
                                        </a>

                                        <a id="state_FR_Lakki" class="state" xlink:href="">
                                            <path id="FR_Lakki" class="shape"
                                                d="m 986.4,544.3 -7.4,-8 -2.6,-15 -13.6,16.2 6.2,12.6 z" />
                                        </a>

                                        <a id="state_FR_Kohat" class="state" xlink:href="">
                                            <path id="FR_Kohat" class="shape"
                                                d="m 1098.6,418.1 23.4,11 -13.8,11.2 -8,0.8 -3,-5.4 4.2,-4.8 -18.4,-3.6 6.2,-12.2 z" />
                                        </a>

                                        <a id="state_FR_D_I_Khan" class="state" xlink:href="">
                                            <path id="FR_D_I_Khan" class="shape"
                                                d="m 951.2,614.5 6.8,3.4 2.6,27.2 18.4,60.4 -13.4,6.4 0.6,10 -3,0.4 -2.4,-5 4,-24.8 -1.4,-17 -16.6,8 -5.6,9.8 -2.6,-16.8 -8.6,-5.2 2.4,-43.8 -7.6,5.2 -3,-3.2 3.8,-8.2 7.6,-3.4 9.8,5 z" />
                                        </a>

                                        <a id="state_FR_Bannu" class="state" xlink:href="">
                                            <path id="FR_Bannu" class="shape"
                                                d="m 992.6,494.3 17.2,0.8 15.8,-16.4 -13.2,-5.2 -10.8,-4.2 -22.8,21.4 -18.6,27.2 2.6,19.6 13.6,-16.2 z" />
                                        </a>

                                        <a id="state_South_Waziristan" class="state" xlink:href="">
                                            <path id="South_Waziristan" class="shape"
                                                d="m 890.4,557.3 13.4,-3.4 1.6,-9.6 22.4,0 35,-6.8 6.2,12.6 -24.8,8.8 2,34.2 5,21.4 -8.2,8.4 -9.8,-5 -7.6,3.4 -7.2,-4.6 3,-9.6 -16.8,4.6 -10.6,11.6 -21.8,-1 -4.6,-19.2 0.8,-27.6 -4.8,-11 4.8,-10.2 10,-4 z" />
                                        </a>

                                        <a id="state_Orakzai" class="state" xlink:href="">
                                            <path id="Orakzai" class="shape"
                                                d="m 1089.2,415.1 -6.2,12.2 -10.2,1.8 -16.6,-11.6 -6,0.6 -2.4,15.8 -16.6,3 -17,-2.8 -17,-18.2 13.2,4.4 36.6,-19.3 23.2,14.1 z" />
                                        </a>

                                        <a id="state_North_Waziristan" class="state" xlink:href="">
                                            <path id="North_Waziristan" class="shape"
                                                d="m 972.4,461.3 24.4,2.2 4.8,5.8 -22.8,21.4 -18.6,27.2 2.6,19.6 -35,6.8 -22.4,0 -1.6,9.6 -13.4,3.4 -12,-7 6.4,-11 -5.8,-11.4 7.2,-9.8 7,-2.4 -4.2,-8.6 1.6,-10 7.2,-7.8 14.2,0.4 6.4,-3.8 9,3.6 14.6,-5.4 4.6,-8.2 8.8,-0.8 z" />
                                        </a>

                                        <a id="state_Mohmand" class="state" xlink:href="">
                                            <path id="Mohmand" class="shape"
                                                d="m 1048.4,317.6 2.8,-13.8 12.6,11 18.4,-5.4 7,18.4 13.4,-3.4 5,8.8 -21.8,29.4 -9.8,13 -24,-19.4 4.8,-12.4 -9.2,-3.8 -7.2,-7.4 -0.2,-12.2 z" />
                                        </a>

                                        <a id="state_Kurram" class="state" xlink:href="">
                                            <path id="Kurram" class="shape"
                                                d="m 940.4,416.1 -14.6,-23.8 3.8,-9.9 11.4,-2.4 22.6,8.6 15.4,2.4 18.2,24.9 17,18.2 -3.2,10 -23.4,8.2 9.2,11.2 -24.4,-2.2 -3.8,-10.4 -11.4,-10.8 1.6,-13.2 -6.6,-9.4 z" />
                                        </a>

                                        <a id="state_Khyber" class="state" xlink:href="">
                                            <path id="Khyber" class="shape"
                                                d="m 1076,375.6 5,25.9 8,4.6 0.2,9 -19,0 -23.2,-14.1 -36.6,19.3 -13.2,-4.4 -18.2,-24.9 37.6,-0.2 29.8,-11.2 6,-12.8 -0.4,-10.6 z" />
                                        </a>

                                        <a id="state_Bajur" class="state" xlink:href="">
                                            <path id="Bajur" class="shape"
                                                d="m 1061.6,299.6 -10.4,4.2 12.6,11 18.4,-5.4 7,18.4 13.4,-3.4 3.8,-10 8.6,-5 0.4,-13.6 -15.6,-4.2 -10,-17 -18.8,10.2 z" />
                                        </a>

                                        <path id="FATA_Border" fill="none" stroke="#a08070"
                                            d="m 1040.2,320.4 0.2,12.2 7.2,7.4 9.2,3.8 -4.8,12.4 0.4,10.6 -6,12.8 -29.8,11.2 -37.6,0.2 -15.4,-2.4 -22.6,-8.6 -11.4,2.4 -3.8,9.9 14.6,23.8 11.8,1.4 6.6,9.4 -1.6,13.2 11.4,10.8 3.8,10.4 -17,13.8 -8.8,0.8 -4.6,8.2 -14.6,5.4 -9,-3.6 -6.4,3.8 -14.2,-0.4 -7.2,7.8 -1.6,10 4.2,8.6 -7,2.4 -7.2,9.8 5.8,11.4 -6.4,11 -10,4 -4.8,10.2 4.8,11 -0.8,27.6 4.6,19.2 21.8,1 10.6,-11.6 16.8,-4.6 -3,9.6 7.2,4.6 -3.8,8.2 3,3.2 7.6,-5.2 -2.4,43.8 8.6,5.2 2.6,16.8 5.6,-9.8 16.6,-8 1.4,17 -4,24.8 2.4,5 3,-0.4 -0.6,-10 13.4,-6.4 -18.4,-60.4 -2.6,-27.2 -6.8,-3.4 -5,-21.4 30.2,-21 9.4,-14.4 10,6 2.6,-6.2 -12,-13.2 -7.4,-8 -2.6,-15 16.2,-27 17.2,0.8 15.8,-16.4 -13.2,-5.2 -10.8,-4.2 -4.8,-5.8 -9.2,-11.2 23.4,-8.2 3.2,-10 17,2.8 16.6,-3 2.4,-15.8 6,-0.6 16.6,11.6 10.2,-1.8 18.4,3.6 -4.2,4.8 3,5.4 8,-0.8 13.8,-11.2 -2,-6 5,-5 -1.4,-4.2 -10.2,-6.8 -4.2,7.2 -10.6,3.8 -9.4,-3 -0.2,-9 -8,-4.6 -5,-25.9 9.8,-13 21.8,-29.4 -5,-8.8 3.8,-10 8.6,-5 0.4,-13.6 -15.6,-4.2 -10,-17 -18.8,10.2 -9.4,14.8 -10.4,4.2 -2.8,13.8 z" />
                                    </g>

                                    <g id="Labels" font-size="10" font-family="DejaVu Sans"
                                        transform="translate(-27.1,-28.1)">

                                        <text y="633.58789" x="992.13708">• DERA ISMAIL KHAN</text>
                                        <text y="659.93848" x="945.03345">• FR DI KHAN</text>
                                        <text y="583.09375" x="808.01593">SOUTH WAZIRISTAN •</text>
                                        <text y="512.00195" x="829.57446">NORTH WAZIRISTAN •</text>
                                        <text y="592.84082" x="967.23169">TANK</text>
                                        <text y="567.53027" x="917.47095">FR TANK •</text>
                                        <text y="487.63562" x="948.60474">FR BANNU •</text>
                                        <text y="543.5" x="877.34497">FR LAKKI MARWAT •</text>
                                        <text y="515.84082" x="990.0647">BANNU</text>
                                        <text y="491.84082" x="1034.6155">KARAK</text>
                                        <text y="455.84082" x="1009.51">HANGU</text>
                                        <text y="398.41504" x="895.38696">KURRAM •</text>
                                        <text y="407.52051" x="966.45337">KHYBER •</text>
                                        <text y="342.32422" x="1016.6467">MOHMAND •</text>
                                        <text y="303.76074" x="1069.717">BAJUR</text>
                                        <text y="430.32068" x="970.4812">ORAKZAI •</text>
                                        <text y="420.81445" x="1041.8549">FR PESHWAR •</text>
                                        <text y="434.81348" x="1107.3168">• FR KOHAT</text>
                                        <text y="457.84082" x="1071.342">KOHAT</text>
                                        <text y="403.0376" x="1130.675">• NOWSHERA</text>
                                        <text y="372.11816" x="1164.9006">SWABI</text>
                                        <text y="349.61816" x="1130.3323">MARDAN</text>
                                        <text y="327.46094" x="1065.0198">MALAKAND •</text>
                                        <text y="298.37646" x="1131.0653">• LOWER DIR</text>
                                        <text y="237.03711" x="1087.3147">UPPER DIR •</text>
                                        <text y="148.11816" x="1120.1223">CHITRAL</text>
                                        <text y="328.45117" x="1168.678">BUNER</text>
                                        <text y="275.50208" x="1152.8286">SHANGLA •</text>
                                        <text y="241.61816" x="1177.0706">SWAT</text>
                                        <text y="385.11816" x="1200.0121">HARIPUR</text>
                                        <text y="325.11816" x="1220.676">MANSEHRA</text>
                                        <text y="297.61816" x="1239.261">• BATTAGRAM</text>
                                        <text y="237.61816" x="1238.9553">KOHISTAN</text>
                                        <text y="393.01855" x="1036.6448">PESHAWAR •</text>
                                        <text y="360.02246" x="1042.9407">CHARSADDA •</text>
                                        <text y="549.83105" x="1022.3108">• LAKKI MARWAT</text>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <img width="64" height="64" src="https://img.icons8.com/nolan/64/user-male--v1.png"
                            alt="user-male--v1" />
                        {{ $khyberMale ?? 0 }} <br>
                        <img width="64" height="64"
                            src="https://img.icons8.com/nolan/64/1A6DFF/C822FF/standing-woman--v2.png"
                            alt="standing-woman--v2" /> {{ $khyberFemale ?? 0 }}
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
