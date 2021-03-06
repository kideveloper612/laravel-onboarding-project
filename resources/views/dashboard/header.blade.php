<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Dashboard</title>
    <!-- Favicon-->
    <link rel="icon" href="./images/login.png" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="./plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="./plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="./plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="../../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Morris Chart Css-->
    <link href="./plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="./plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link href="./plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="./plugin/css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./css/layoutApp.css">

    <!-- AdminBSB Themes -->
    <link href="./plugin/css/themes/all-themes.css" rel="stylesheet" />

    <!-- Form Build -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.4.0/styles/default.min.css">
    
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
  
    <!-- Sidebar toggle button -->
    <a href="javascript:void(0);" class="bars"></a>
    <!-- #END -->                

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
                        <a href=" {{route('home')}} ">
                            <i class="material-icons">home</i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <!-- <li>
                        <a href=" {{route('usersort')}} ">
                            <i class="material-icons">sort</i>
                            <span>User Sortting</span>
                        </a>
                    </li> -->
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
                        <a href="{{ route('formBuild') }}">
                            <i class="material-icons">build</i>
                            <span>Form Build</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('usermanagement') }}">
                            <i class="material-icons">group</i>
                            <span>User Management</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ '/phones' }}">
                            <i class="material-icons">phone</i>
                            <span>Phone</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">link</i>
                            <span>Link Manager</span>
                        </a>
                        <ul class="ml-menu">                            
                            <li>
                                <a onclick="onFileUpload()"><i class="material-icons linkSettingIcon">add_circle</i><span class="linkSetting">File Upload</span></a>
                            </li>                            
                            <li>
                                <a onclick="onAddLink()"><i class="material-icons linkSettingIcon">add_circle</i><span class="linkSetting">Link Add</span></a>
                            </li> 
                            <li>
                                <a onclick="onLinkRemove()"><i class="material-icons linkSettingIcon">remove_circle</i><span class="linkSetting">Link Remove</span></a>
                            </li>                      
                        </ul>
                    </li>
                    <div class="text-center">
                        <button type="button" class="btn btn-success waves-effect" onclick="onExcel()">Export to Excel</button>
                    </div>
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

<!-- File Upload Modal -->
<div class="modal fade" id="newFileUpload" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title text-center" id="Label">Please Insert a New File</h2>
            </div>
            <form id="form_validation" method="post" action="/linksave" enctype='multipart/form-data'>
                {{ csrf_field() }}
                <div class="modal-body">
                    <label for="editName">Link Name:</label>
                    <div class="form-group eidtInput">
                        <div class="form-line">
                            <input type="text" id="newLinkName" class="form-control" name="newLinkName" required>
                        </div>
                    </div>
                    <label for="editEmail">Upload File:</label>
                    <div class="form-group eidtInput">
                        <div class="form-line">
                            <input type="file" id="uploadFile" class="form-control" name="uploadFile" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn bg-blue waves-effect">Upload</button>
                    <button class="btn waves-effect" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Link Modal -->
<div class="modal fade" id="newAddLink" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title text-center" id="Label">Please Insert a New File</h2>
            </div>
            <form id="form_validation" method="post" action="/addlinksave">
                {{ csrf_field() }}
                <div class="modal-body">
                    <label for="editName">Link Name:</label>
                    <div class="form-group eidtInput">
                        <div class="form-line">
                            <input type="text" id="newAddLinkName" class="form-control" name="newAddLinkName" required>
                        </div>
                    </div>
                    <label for="editName">Link Url:</label>
                    <div class="form-group eidtInput">
                        <div class="form-line">
                            <input type="text" id="newAddLinkUrl" class="form-control" name="newAddLinkUrl" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn bg-blue waves-effect">Add Link</button>
                    <button class="btn waves-effect" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Link Remove Modal -->
<div class="modal fade" id="linkRemove" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title text-center" id="Label">Please Select a Link For Deleting</h2>
            </div>
            <form id="form_validation" method="post" action="{{route('linkremove')}}">
                {{ csrf_field() }}
                <div class="modal-body">
                    <label for="editName">Link Name:</label>
                    <div class="form-group eidtInput">
                        <div class="form-line">
                            <select id="linkList" class="form-control" name="linkList" required></select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn bg-blue waves-effect">Delete</button>
                    <button class="btn waves-effect" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>