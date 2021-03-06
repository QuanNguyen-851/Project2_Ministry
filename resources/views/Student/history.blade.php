<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
    <link rel="icon" type="image/png" href="{{ asset('assets') }}/img/logo1.gif">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>BKACAD</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" />

    <!--  Light Bootstrap Dashboard core CSS    -->
    <link href="../../assets/css/light-bootstrap-dashboard.css?v=1.4.1" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="../../assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="../../assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>
<body>


<div class="wrapper wrapper-full-page">
    <div class="full-page login-page" data-color="azure" data-image="../../assets/img/full-screen-image-1.jpg">

        <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
        <div class="content">
            <div class="container" style="margin-top: -70px;">
                <div class="row">
                    <div class="col-md-12 ">                                           
                        <!--   if you want to have the card without animation please remove the ".card-hidden" class   -->
                        
                                <div class="card card-hidden">
                                    <table border="0" class="table">
                                        <tr>
                                            <td rowspan="2">
                                                <h3>L???ch s??? ????ng h???c</h3>
                                                <label>Sinh vi??n: {{$student->name}}</label>
                                                <p>Ng??y sinh: {{date_format(date_create($student->dateBirth),"d/n/Y")}}</p>
                                                <p>?????a ch???: {{$student->address}}</p>
                                                <p>H???c ph?? m???i ?????t: {{number_format($student->fee)."VN??"}}</p>
                                                <p>M???c h???c b???ng: {{$student->scholarship}}</p>
                                            </td>
                                            <td>H???c ph??</td>
                                        <td>S??? ?????t ph???i ????ng: {{$student->countMustPay}}</td>
                                        <td>S??? ?????t ???? ????ng: {{$payed}}</td>
                                        <td>N??? h???c ph??:{{number_format($owe)."VN??"}}</td>
                                        
                                        </tr>
                                        <tr>
                                            <td>ph??? ph??</td>
                                        <td>S??? ?????t ph???i ????ng: {{$student->countSubFeeMustPay}}</td>
                                        <td>S??? ?????t ???? ????ng: {{$subfeepayed}} </td>
                                        <td>N???:{{number_format($owesub)."VN??"}}</td>
                                        
                                        </tr>
                                        <tr>
                                            <td colspan="4"></td>
                                        <td style="color:red">t???ng: {{ number_format($owe + $owesub)."VN??" }}</td>
                                        </tr>
                                
                                    </table>
                                
                                
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="card card-hidden">
                                
                                        <table id="bootstrap-table" class="table">
                                            <thead>
                                                <th class="id">M?? ????n</th>
                                                <th  class="text-center">Ng?????i n???p</th>
                                                <th  data-sortable="true">Ghi ch??</th>
                                                <th  data-sortable="true">Ng??y n???p</th>
                                                <th  data-sortable="true">S??? ti???n</th>
                                                <th  data-sortable="true">?????t</th>
                                                <th >H??nh th???c ????ng</th>
                                                <th >Actions</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($studentfee as $item)
                                                <tr>
                                                <td> {{"HP".$item->idfee}} </td>
                                                <td> {{$item->payer}} </td>
                                
                                                <td style="text-align: left;" ><textarea disabled style="width: 390px;height: 90px;border: none; max-width: 390px;min-height: 90px;">{{$item->note}}</textarea></td>
                                                <td style="text-align: left">
                                                {{date_format(date_create($item->date),"d/n/Y")}}
                                                </td>
                                                <td style="text-align: left" >
                                                    {{number_format($item->payfee)."VN??"}}
                                                    @if ($item->check != 1)
                                                    <a style="    color: #ffa50c;">(thi???u)</a>
                                                @endif
                                                </td>
                                                <td style="text-align: left">
                                                    {{$item->countPay}}
                                                </td>
                                                <td style="text-align: left" >
                                                    {{$item->payment}}
                                                </td>
                                                <td class="td-actions">
                                                  
                                
                                                    <a  href="{{ route('detaiFeeForstudent', $item->idFee) }}"  title="Xem chi ti???t" class="btn btn-primary">
                                                        Xem chi ti???t
                                                    </a>
                                                    
                                                </td>
                                            </tr>
                                            @endforeach
                                            @foreach ($studentsubfee as $item)
                                            <tr>
                                                <td>{{"PP".$item ->id}}</td>
                                            <td>
                                                <div>
                                                    {{$item->payer}}
                                                </div>
                                            </td>
                                
                                            <td style="text-align: left;" ><textarea disabled style="width: 390px;height: 90px;border: none; max-width: 390px;min-height: 90px;">{{$item->note}}</textarea></td>
                                            <td style="text-align: left">
                                            {{date_format(date_create($item->date),"d/n/Y")}}
                                            </td>
                                            <td style="text-align: left" >
                                                {{number_format($item->payfee)."VN??"}}
                                                @if ($item->check != 1)
                                                <a style="    color: #ffa50c;">(thi???u)</a>
                                            @endif
                                            </td>
                                            <td style="text-align: left" >
                                                {{$item->countPay}}
                                            </td>
                                            <td style="text-align: left" >
                                                {{$item->payment}}
                                            </td>
                                            <td class="td-actions">  
                                               
                                                <a href="{{ route('detailSubFeeForstudent', $item->idFee) }}"  title="Xem chi ti???t" class="btn btn-primary">
                                                    Xem chi ti???t
                                                </a>               
                                            </td>
                                        </tr>
                                        @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    </div>
                                </div>
                        </div>
                  
                </div>
            </div>
        </div>
    </div>

</div>


</body>

    <!--   Core JS Files  -->
    <script src="../../assets/js/jquery.min.js" type="text/javascript"></script>
	<script src="../../assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="../../assets/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>


	<!--  Forms Validations Plugin -->
	<script src="../../assets/js/jquery.validate.min.js"></script>

	<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
	<script src="../../assets/js/moment.min.js"></script>

    <!--  Date Time Picker Plugin is included in this js file -->
    <script src="../../assets/js/bootstrap-datetimepicker.min.js"></script>

    <!--  Select Picker Plugin -->
    <script src="../../assets/js/bootstrap-selectpicker.js"></script>

	<!--  Checkbox, Radio, Switch and Tags Input Plugins -->
		<script src="../../assets/js/bootstrap-switch-tags.min.js"></script>

	<!--  Charts Plugin -->
	<script src="../../assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="../../assets/js/bootstrap-notify.js"></script>

    <!-- Sweet Alert 2 plugin -->
	<script src="../../assets/js/sweetalert2.js"></script>

    <!-- Vector Map plugin -->
	<script src="../../assets/js/jquery-jvectormap.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

	<!-- Wizard Plugin    -->
    <script src="../../assets/js/jquery.bootstrap.wizard.min.js"></script>

    <!--  Datatable Plugin    -->
    <script src="../../assets/js/bootstrap-table.js"></script>

    <!--  Full Calendar Plugin    -->
    <script src="../../assets/js/fullcalendar.min.js"></script>

    <!-- Light Bootstrap Dashboard Core javascript and methods -->
	<script src="../../assets/js/light-bootstrap-dashboard.js?v=1.4.1"></script>

	<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
	<script src="../../assets/js/demo.js"></script>

    <script type="text/javascript">
        $().ready(function(){
            lbd.checkFullPageBackgroundImage();

            setTimeout(function(){
                // after 1000 ms we add the class animated to the login/register card
                $('.card').removeClass('card-hidden');
            }, 700)
        });
    </script>
        {{-- validate --}}
        <script type="text/javascript">
            $().ready(function(){
                $('#createvalidateform').validate();
                $('#updatevalidateform').validate();
               
            });
        </script>

</html>
