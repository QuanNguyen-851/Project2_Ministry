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
            <div class="container"style="margin-top: -70px;">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">                                           
                        <!--   if you want to have the card without animation please remove the ".card-hidden" class   -->
                            <div class="card card-hidden">
                                <h2 style="text-align: center;padding: 10px; font-family: ui-monospace">PHIẾU THU</h2>
                                <h3 style="text-align: center;font-family: -webkit-body;">Ngày: {{ date_format(date_create($detail->date)," d/m/Y") }}</h3>
                                <div style="padding: 35px">
                                <p>Mã đơn: {{"HP".$detail->id}}</p>
                                    <P>Họ tên người nộp tiền: {{ $detail->payer}}</P>
                                    <p>Sinh viên: {{ $detail->name."(".date_format(date_create($detail->dateBirth),"d/m/Y").")"."_".$detail->address."_".$detail->class_bk}}</p>
                        
                                    <p>Hình thức đóng: {{ $detail->payment." (". number_format($fee)."/".$detail->payment.")"}}</p>
                                <p>Đợt: {{$detail->countPay}} {{
                                $detail->countPer!=1? " (". $detail->payment ." " . $detail->countPay/ $detail->countPer .")"
                                :""
                                }}</p>
                                    <p>Ghi chú: {{ $detail->note}}</p>
                                    <P style="color:red">Số tiền: {{number_format($detail->fee)."VNĐ"}}</P>
                                    <p>Người lập phiếu : {{$detail->accountant}}</p>
                                    <a class="btn btn-primary" href="{{ route('student', $detail->studentid) }}"><i class="pe-7s-back" ></i> trở về</a>
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
