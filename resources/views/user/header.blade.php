<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Section</title>
    <!-- Favicon-->
    <link rel="icon" href="./favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="./plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="./plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="./plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Sweet Alert Css -->
    <link href="./plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- Wait Me Css -->
    <link href="./plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="./plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="./plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link href="./plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="./plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="./plugin/css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./css/layoutApp.css">
    
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="./plugin/css/themes/all-themes.css" rel="stylesheet" />

    <!-- Form Build -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.4.0/styles/default.min.css">

    <!-- JQuery DataTable Css -->
    <link href="../../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

</head>

<body class="theme-blue">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    
    <!-- Sidebar toggle -->
    <a href="javascript:void(0);" class="bars"></a>
                
    <!--Side Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <img class="dashImg" src="./images/logo.png" alt="User" />
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header" style="height: 35px;">MAIN NAVIGATION</li>
                    <li class="active">
                        <a href="dashboard">
                            <i class="material-icons">home</i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('formselect') }}">
                            <i class="material-icons">question_answer</i>
                            <span>Access Form</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">link</i>
                            <span>Links</span>
                        </a>                       
                        <ul class="ml-menu">
                            <?php if(isset($data['url']))
                            foreach (json_decode($data['url']) as $key => $value) {
                            ?>
                            <li>
                                <a href="<?php echo $value->link; ?>" target="_blank"><?php echo($value->linkName); ?></a>
                            </li>
                            <?php } ?>
                            <li>
                                <a href="https://dispatch.evertransit.com" target="_blank">Ever Transit</a>
                            </li>
                            <li>
                                <a href="https://drive.google.com/drive/my-drive" target="_blank">Google Drive</a>
                            </li>
                            <li>
                                <a href="https://my131.geotab.com/venturaems/#map,liveVehicleIds:!(b14,b2,bA,bF)" target="_blank">GPS Mapping</a>
                            </li>
                            <li>
                                <a href="https://www.nj.gov/911/home/highlights/EMD%20Guidecards%202017%20elec%20proj%20V4%20.pdf" target="_blank">EMD Guide Cards</a>
                            </li>
                            <li>
                                <a href="https://drive.google.com/file/d/1HGZJOO4RPadaov4Uhhm8-8Itmxpv_Srq/view?usp=sharing" target="_blank">Source log Count Sheet</a>
                            </li>
                            <li>
                                <a href="https://drive.google.com/open?id=1Ir27e8zSU9D1kWQ4ksvlZJvnNFZq9gjF" target="_blank">Medical Abbreviations</a>
                            </li>
                            <li>
                                <a href="https://drive.google.com/open?id=1RQPF7UuCGyBh9oO8Ks1BTTrX75ogT3h7" target="_blank">Examples of Transport Types</a>
                            </li>
                            <li>
                                <a href="https://drive.google.com/open?id=13j528SBNXTCQdGp9iimuXDLvjxQW-mdo" target="_blank">PHI Narative</a>
                            </li>
                            <li>
                                <a href="https://drive.google.com/open?id=1g3HFOzn7aAE-UVb-m5HXmWB7DMjh2YDB" target="_blank">Call Taking Forms</a>
                            </li>
                            <li>
                                <a href="https://drive.google.com/open?id=0B5pXzTLykRzpVHp4NXZQUERnOHBvcTdUbEczMkxtbFRWeExj" target="_blank">PCS Form</a>
                            </li>
                            <li>
                                <a href="https://drive.google.com/open?id=0B5pXzTLykRzpM0xZOFZNVDFVdncxZGw5UExHNU80ei1uVmMw" target="_blank">Patient Care Report</a>
                            </li>
                            <li>
                                <a href="https://drive.google.com/open?id=1BTOnWBzP1tF3gnRGDbDuHOnLy_2vX5SN" target="_blank">Approved Dispatch Complaints for Radio</a>
                            </li>
                            <li>
                                <a href="https://drive.google.com/open?id=1nzYvZE3hwt839q5MlpNZls0OVb0P9Z4m" target="_blank">PHI Individual Station Numbers</a>
                            </li>
                            <li>
                                <a href="https://drive.google.com/open?id=1qqkijAbzt3W9EUH8eKxCL2_oAdxti6Il" target="_blank">911 Desk Sheet</a>
                            </li>   
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="material-icons">settings</i>
                            <span>User Setting</span>
                        </a>
                    </li>
                </ul>
                <div id="logout">
                    <a class="logout" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
            <!-- #Menu -->
            
        </aside>
        <!-- #END# Left Sidebar -->       
    </section>
    <!-- #Side Bar -->
