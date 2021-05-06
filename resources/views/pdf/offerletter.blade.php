<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Offerletter</title>

        <!-- -------------- Favicon -------------- -->
        <link rel="shortcut icon" href="{{ asset('/public/assets/img/favicon.png') }}">

        <style>
            /** Define the margins of your page **/
            header, footer {
                margin: 70px 0px;
            }
            header {
                position: fixed;
                top: -80px;
                left: 0px;
                right: 0px;
                height: 70px;

                /** Extra personal styles **/
                /* background-color: #03a9f4; */
                line-height: 5px;
                border-bottom: 2px solid #c4c2c2;
                padding-bottom: 5px;
            }
            .slogan{
                font-size: 12px;
                color: #D80022;
                font-weight: 700;
            }
            .cinno{
                font-size: 12px;
                font-weight: 700;
            }

            footer {
                position: fixed; 
                bottom: -90px; 
                left: 0px; 
                right: 0px;
                height: 100px; 

                /** Extra personal styles **/
                /*background-color: #03a9f4;*/
                color: #7f828f;
                text-align: center;
                line-height: 5px;
            }

            footer p {
                font-size: 10px;
            }
            footer h2 {
                padding: 5px 0px;
                border-bottom: 2px solid #c4c2c2;
                color: #4A9CF1;
                text-transform: uppercase;
                font-size: 14px;
            }
            .container{
                position: absolute;
                top: 100px;
                padding: 0px 50px;
            }
            .clear{
                clear: both;
            }
        
        </style>
    </head>
    <body>
        <header class="clear">
            <img src="{{asset('public/assets/img/Logo.png')}}" width="150" alt="Logo"/>
            <p class="slogan">Think Differently We Will Make The Difference</p>
            <p class="cinno">CIN No. U72300UR2009PTC032777</p>
        </header>
        <div class="container clear">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Dear {{ $data['candidate_name'] }}</div>

                        <div class="panel-body">
                            {!! nl2br($data['offer_letter']) !!}
                            <div style="width: 48%;">
                                <p><img src="{{ asset('storage/app/stamps/'.$data['stamp_info']->picture) }}" class="img-thumbnail" width="100" /></p>
                                <p><img src="{{ asset('storage/app/signature/'.$data['sig_info']->signature) }}" class="img-thumbnail" width="100" /></p>
                                <p>Manager (HRM)</p>
                            </div>
                            <div style="width: 48%;">
                            @if( isset($data['emp_sig_name']) )
                                <p>
                                    <span>Employee sig:</span>
                                    <img src="{{ asset('storage/app/offerletter/sig/emp/'.$data['emp_sig_name']) }}" class="img-thumbnail" width="100" />
                                </p>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <b>Soarlogic Information Technologies Pvt. Ltd.</b>
                </div>
            </div>
        </div>
        <footer class="clear">
            <h2>Soarlogic Information Technologies Pvt. Ltd.</h2>
            <p>Corporate Office: Hall No. 7, 1st Floor, STPI, IT-01, IT Park, Sahastradhara Road, Dehradun - 248013, Uttarakhand, India. Tel: 0135-2607929</p>
            <p>Regd. Office: G-87, Nehru Colony, Dehradun - 248001, Uttarakhand, India | Web: www.soarlogic.com, E-Mail: info@soarlogic.com</p>
        </footer>
    </body>
</html>