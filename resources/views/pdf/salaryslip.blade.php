<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Salary Slip</title>

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
            .bordered tr td, .bordered tr th {
                border: 1px solid #c4c2c2;
            }
            tr.borderless td{
                border: 0px;
                padding: 10px 0px;
            }
        
        </style>
    </head>
    <body>
        @php
        $da_basic_prcnt = ($request->da*$request->basic)/100;
        $hra_basic_prcnt = ($request->hra*$request->basic)/100;
        @endphp
        <header class="clear">
            <img src="{{asset('public/assets/img/Logo.png')}}" width="150" alt="Logo"/>
            <p class="slogan">Think Differently We Will Make The Difference</p>
            <p class="cinno">CIN No. U72300UR2009PTC032777</p>
        </header>
        <div class="container clear">
            <table width="100%" class="bordered" cellpadding="0">
                <tr>
                    <td valign="top">
                        <table width="100%" class="bordered" cellpadding="0">
                            <tr>
                                <td>Employee Name</td>
                                <td>{{$request->employee->name}}</td>
                            </tr>
                            <tr>
                                <td>Department</td>
                                <td>{{$request->department}}</td>
                            </tr>
                            <tr>
                                <td>Month & Year</td>
                                <td>{{ \Carbon\Carbon::parse($request->month_year)->format('m/y') }}</td>
                            </tr>
                        </table>
                    </td>
                    <td valign="top">
                        <table width="100%" class="bordered" cellpadding="0">
                            <tr>
                                <td>PAN</td>
                                <td>{{$request->pan}}</td>
                            </tr>
                            <tr>
                                <td>Designation</td>
                                <td>{{$designation->name}}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="borderless" colspan="2"><td></td></tr>
                <tr>
                    <td valign="top">
                        <table width="100%" class="bordered" cellpadding="0">
                            <tr>
                                <th colspan="2">Earnings</th>
                            </tr>
                            <tr>
                                <td>Basic</td>
                                <td>{{$request->basic}}</td>
                            </tr>
                            <tr>
                                <td>DA</td>
                                <td>{{$da_basic_prcnt}}</td>
                            </tr>
                            <tr>
                                <td>HRA</td>
                                <td>{{$hra_basic_prcnt}}</td>
                            </tr>
                            <tr>
                                <td>Conveyance Allowance</td>
                                <td>{{$request->conveyance_allow}}</td>
                            </tr>
                            <tr>
                                <td>Education Allowance</td>
                                <td>{{$request->education_allow}}</td>
                            </tr>
                            <tr>
                                <td>Medical Allowance</td>
                                <td>{{$request->medical_allow}}</td>
                            </tr>
                            <tr>
                                <td>Internet Allowance</td>
                                <td>{{$request->internet_allow}}</td>
                            </tr>
                            <tr>
                                <td>Special Allowance</td>
                                <td>{{$request->special_allow}}</td>
                            </tr>
                        </table>
                    </td>
                    <td valign="top">
                        <table width="100%" class="bordered" cellpadding="0">
                            <tr>
                                <th colspan="2">Deductions</th>
                            </tr>
                            <tr>
                                <td>P.Fund</td>
                                <td>{{$request->p_fund}}</td>
                            </tr>
                            <tr>
                                <td>Taxes</td>
                                <td>{{$request->taxes}}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="borderless" colspan="2"><td></td></tr>
                <tr>
                    <td valign="top">
                        <table width="100%" class="bordered" cellpadding="0">
                            <tr>
                                <th>Gross Earnings</th>
                                <td>
                                @php
                                $gross_earnings = $request->basic + $da_basic_prcnt + $hra_basic_prcnt + $request->conveyance_allow + $request->education_allow + $request->medical_allow + $request->internet_allow + $request->special_allow;
                                @endphp
                                {{$gross_earnings}}
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td valign="top">
                        <table width="100%" class="bordered" cellpadding="0">
                            <tr>
                                <th>Total Deduction</th>
                                <td>
                                @php
                                $total_deductions = $request->p_fund + $request->taxes;
                                @endphp
                                {{$total_deductions}}
                                </td>
                            </tr>
                            <tr>
                                <th>Net Salary</th>
                                <td>
                                @php
                                $net_salary = $gross_earnings - $total_deductions;
                                @endphp
                                {{$net_salary}}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table> 
        </div>
        <footer class="clear">
            <h2>Soarlogic Information Technologies Pvt. Ltd.</h2>
            <p>Corporate Office: Hall No. 7, 1st Floor, STPI, IT-01, IT Park, Sahastradhara Road, Dehradun - 248013, Uttarakhand, India. Tel: 0135-2607929</p>
            <p>Regd. Office: G-87, Nehru Colony, Dehradun - 248001, Uttarakhand, India | Web: www.soarlogic.com, E-Mail: info@soarlogic.com</p>
        </footer>
    </body>
</html>