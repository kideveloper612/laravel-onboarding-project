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
            <div class="user-info text-center">
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
                            <span>Form Selection</span>
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
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">settings</i>
                            <span>User Setting</span>
                        </a>                       
                        <ul class="ml-menu">                            
                            <li>
                                <a onclick="onEdit(<?php echo auth()->user()->id; ?>)"><i class="material-icons userSettingIcon">person_outline</i><span class="userSetting">My Information Reset</span></a>
                            </li>
                            <li>
                                <a onclick="onPassword(<?php echo auth()->user()->id;?>)"><i class="material-icons userSettingIcon">lock_outline</i><span class="userSetting">My Password Reset</span></a>
                            </li>   
                        </ul>
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

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title text-center" id="Label">User Information Reset</h2>
                </div>
                <form method="post" id="formEditModal" action="">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="modal-body">
                            <label for="editName">Name:</label>
                            <div class="form-group eidtInput">
                                <div class="form-line">
                                    <input type="text" id="editName" class="form-control" name="editName" required>
                                </div>
                            </div>
                            <label for="editEmail">Email Address:</label>
                            <div class="form-group eidtInput">
                                <div class="form-line">
                                    <input type="text" id="editEmail" class="form-control" name="editEmail" required>
                                </div>
                            </div>
                            <label for="editPhone">Phone Number:</label>
                            <div class="form-group eidtInput">
                                <div class="form-line">
                                    <input type="text" id="editPhone" class="form-control" name="editPhone" required>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-blue waves-effect">Save</button>
                        <button class="btn waves-effect" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Password Reset Modal -->
    <div class="modal fade" id="passwordReset" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title text-center" id="Label">Password Reset</h2>
                </div>
                <form method="post" id="passwordSet" action="">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="modal-body">
                            <label for="editName">New Password:</label>
                            <div class="form-group eidtInput">
                                <div class="form-line">
                                    <input type="password" id="newPassword" class="form-control" name="newPassword" required>
                                </div>
                            </div>
                            <label for="editEmail">Confirm Password:</label>
                            <div class="form-group eidtInput">
                                <div class="form-line">
                                    <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-blue waves-effect">Save</button>
                        <button class="btn waves-effect" data-dismiss="modal">Cancel</button>
                    </div>
                </form>            
            </div>
        </div>
    </div>