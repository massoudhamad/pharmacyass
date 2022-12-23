<?php
//session_start();
require_once('session.php');
require_once('DB.php');
$auth_user = new DBHelper();
$userID = $_SESSION['user_session'];
$fname = $_SESSION['firstname'];
$lname = $_SESSION['middlename'];
$roleCode = $_SESSION['role'];

$name = $fname." ".$lname;

if ($userID == ' ') {
    //echo $user_privilege;
    header('Location:logout.php?logout=true');
    exit();
}



?>

<!DOCTYPE html>
<html class='loading' lang='en' data-textdirection='ltr'>
<!-- BEGIN: Head-->

<head>
    <title>Aspire E Pharmacy</title>
    <link rel='apple-touc h-icon' href='app-assets/images/ico/apple-icon-120.png'>
    <link rel='shortcut i con' type='image/x-icon' href='app-assets/images/ico/favicon.ico'>

    <!-- BEGIN: Vendor CSS-->
    <link rel='stylesheet' type='text/css' href='app-assets/vendors/css/vendors.min.css'>
    <link rel='stylesheet' type='text/css' href='app-assets/vendors/css/forms/icheck/icheck.css'>
    <link rel='stylesheet' type='text/css' href='app-assets/vendors/css/forms/icheck/custom.css'>
    <!-- END: Vendor CSS-->
    <!-- BEGIN: Page CSS-->
    <link rel='stylesheet' type='text/css' href='app-assets/css/core/menu/menu-types/vertical-menu.css'>
    <link rel='stylesheet' type='text/css' href='app-assets/css/core/colors/palette-gradient.css'>
    <link rel='stylesheet' type='text/css' href='app-assets/css/core/colors/palette-callout.css'>
    <!-- END: Page CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel='stylesheet' type='text/css' href='app-assets/css/bootstrap.css'>
    <link rel='stylesheet' type='text/css' href='app-assets/css/bootstrap-extended.css'>
    <link rel='stylesheet' type='text/css' href='app-assets/css/colors.css'>
    <link rel='stylesheet' type='text/css' href='app-assets/css/components.css'>
    <link rel="stylesheet" href="alertifyjs/css/alertify.min.css">

    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link href='dist/css/component-chosen.css' rel='stylesheet'>
    <link rel='stylesheet' type='text/css' href='app-assets/css/core/menu/menu-types/vertical-menu.css'>
    <link rel='stylesheet' type='text/css' href='app-assets/css/core/colors/palette-gradient.css'>
    <link rel='stylesheet' type='text/css' href='app-assets/css/plugins/forms/wizard.css'>
    <link rel='stylesheet' type='text/css' href='app-assets/css/pages/hospital-add-patient.css'>
    <link rel='stylesheet' href='sweet/dist/sweetalert.css'>
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->

    <link rel='stylesheet' href='https://unpkg.com/multiple-select@1.3.1/dist/multiple-select.min.css'>

    <!-- hapa -->

    <script src='scripts/jquery-1.10.2.min.js' type='text/javascript'></script>
    <script type='text/javascript' src='typeahead.js'></script>
    <script src='js/bootstrap.min.js' type='text/javascript'></script>
    <link rel='stylesheet' href='bootstrap/css/bootstrap.min.css'>

    <!-- end -->

    <!-- Comments-->

    <!-- Chosen -->
    <link href='dist/css/component-chosen.css' rel='stylesheet'>
    <link href='chosen/chosen.min.css' rel='stylesheet' type='text/css'>

    <link rel='stylesheet' type='text/css' href='app-assets/vendors/css/vendors.min.css'>
    <link rel='stylesheet' type='text/css' href='app-assets/vendors/css/tables/datatable/datatables.min.css'>
    <link rel='stylesheet' type='text/css' href='app-assets/vendors/css/tables/datatable/jquery.dataTables.min.css'>
    <link rel='stylesheet' type='text/css' href='app-assets/vendors/css/tables/datatable/select.dataTables.min.min.css'>
    <link rel='stylesheet' type='text/css' href='app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css'>
    <link rel='stylesheet' type='text/css' href='app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css'>
    <!-- Mine-->

    <link href='datatables/buttons.dataTables.min.css' rel='stylesheet' />
    <link href='datatables/fixedColumns.dataTables.min.css' rel='stylesheet' />

    <!-- multiple select -->
    <link href='assets/select2/cs/select2.min.css' rel='stylesheet' type='text/css' />
    <!-- end -->

</head>
<style>
    .chosen-select {
        width: 100%;
    }

    .chosen-select-deselect {
        width: 100%;
    }

    .chosen-container {
        display: inline-block;
        font-size: 14px;
        position: relative;
        vertical-align: middle;
    }

    .chosen-container .chosen-drop {
        background: #ffffff;
        border: 1px solid #cccccc;
        border-bottom-right-radius: 4px;
        border-bottom-left-radius: 4px;
        -webkit-box-shadow: 0 8px 8px rgba(0, 0, 0, .25);
        box-shadow: 0 8px 8px rgba(0, 0, 0, .25);
        margin-top: -1px;
        position: absolute;
        top: 100%;
        left: -9000px;
        z-index: 1060;
    }

    .chosen-container.chosen-with-drop .chosen-drop {
        left: 0;
        right: 0;
    }

    .chosen-container .chosen-results {
        color: #555555;
        margin: 0 4px 4px 0;
        max-height: 240px;
        padding: 0 0 0 4px;
        position: relative;
        overflow-x: hidden;
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
    }

    .chosen-container .chosen-results li {
        display: none;
        line-height: 1.42857143;
        list-style: none;
        margin: 0;
        padding: 5px 6px;
    }

    .chosen-container .chosen-results li em {
        background: #feffde;
        font-style: normal;
    }

    .chosen-container .chosen-results li.group-result {
        display: list-item;
        cursor: default;
        color: #999;
        font-weight: bold;
    }

    .chosen-container .chosen-results li.group-option {
        padding-left: 15px;
    }

    .chosen-container .chosen-results li.active-result {
        cursor: pointer;
        display: list-item;
    }

    .chosen-container .chosen-results li.highlighted {
        background-color: #428bca;
        background-image: none;
        color: white;
    }

    .chosen-container .chosen-results li.highlighted em {
        background: transparent;
    }

    .chosen-container .chosen-results li.disabled-result {
        display: list-item;
        color: #777777;
    }

    .chosen-container .chosen-results .no-results {
        background: #eeeeee;
        display: list-item;
    }

    .chosen-container .chosen-results-scroll {
        background: white;
        margin: 0 4px;
        position: absolute;
        text-align: center;
        width: 321px;
        z-index: 1;
    }

    .chosen-container .chosen-results-scroll span {
        display: inline-block;
        height: 1.42857143;
        text-indent: -5000px;
        width: 9px;
    }

    .chosen-container .chosen-results-scroll-down {
        bottom: 0;
    }

    .chosen-container .chosen-results-scroll-down span {
        background: url('chosen-sprite.png') no-repeat -4px -3px;
    }

    .chosen-container .chosen-results-scroll-up span {
        background: url('chosen-sprite.png') no-repeat -22px -3px;
    }

    .chosen-container-single .chosen-single {
        background-color: #ffffff;
        -webkit-background-clip: padding-box;
        -moz-background-clip: padding;
        background-clip: padding-box;
        border: 1px solid #cccccc;
        border-top-right-radius: 4px;
        border-top-left-radius: 4px;
        border-bottom-right-radius: 4px;
        border-bottom-left-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        color: #555555;
        display: block;
        height: 34px;
        overflow: hidden;
        line-height: 34px;
        padding: 0 0 0 8px;
        position: relative;
        text-decoration: none;
        white-space: nowrap;
    }

    .chosen-container-single .chosen-single span {
        display: block;
        margin-right: 26px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .chosen-container-single .chosen-single abbr {
        background: url('chosen-sprite.png') right top no-repeat;
        display: block;
        font-size: 1px;
        height: 10px;
        position: absolute;
        right: 26px;
        top: 12px;
        width: 12px;
    }

    .chosen-container-single .chosen-single abbr:hover {
        background-position: right -11px;
    }

    .chosen-container-single .chosen-single.chosen-disabled .chosen-single abbr:hover {
        background-position: right 2px;
    }

    .chosen-container-single .chosen-single div {
        display: block;
        height: 100%;
        position: absolute;
        top: 0;
        right: 0;
        width: 18px;
    }

    .chosen-container-single .chosen-single div b {
        background: url('chosen-sprite.png') no-repeat 0 7px;
        display: block;
        height: 100%;
        width: 100%;
    }

    .chosen-container-single .chosen-default {
        color: #777777;
    }

    .chosen-container-single .chosen-search {
        margin: 0;
        padding: 3px 4px;
        position: relative;
        white-space: nowrap;
        z-index: 1000;
    }

    .chosen-container-single .chosen-search input[type='text'] {
        background: url('chosen-sprite.png') no-repeat 100% -20px, #ffffff;
        border: 1px solid #cccccc;
        border-top-right-radius: 4px;
        border-top-left-radius: 4px;
        border-bottom-right-radius: 4px;
        border-bottom-left-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        margin: 1px 0;
        padding: 4px 20px 4px 4px;
        width: 100%;
    }

    .chosen-container-single .chosen-drop {
        margin-top: -1px;
        border-bottom-right-radius: 4px;
        border-bottom-left-radius: 4px;
        -webkit-background-clip: padding-box;
        -moz-background-clip: padding;
        background-clip: padding-box;
    }

    .chosen-container-single-nosearch .chosen-search input {
        position: absolute;
        left: -9000px;
    }

    .chosen-container-multi .chosen-choices {
        background-color: #ffffff;
        border: 1px solid #cccccc;
        border-top-right-radius: 4px;
        border-top-left-radius: 4px;
        border-bottom-right-radius: 4px;
        border-bottom-left-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        cursor: text;
        height: auto !important;
        height: 1%;
        margin: 0;
        overflow: hidden;
        padding: 0;
        position: relative;
    }

    .chosen-container-multi .chosen-choices li {
        float: left;
        list-style: none;
    }

    .chosen-container-multi .chosen-choices .search-field {
        margin: 0;
        padding: 0;
        white-space: nowrap;
    }

    .chosen-container-multi .chosen-choices .search-field input[type='text'] {
        background: transparent !important;
        border: 0 !important;
        -webkit-box-shadow: none;
        box-shadow: none;
        color: #555555;
        height: 32px;
        margin: 0;
        padding: 4px;
        outline: 0;
    }

    .chosen-container-multi .chosen-choices .search-field .default {
        color: #999;
    }

    .chosen-container-multi .chosen-choices .search-choice {
        -webkit-background-clip: padding-box;
        -moz-background-clip: padding;
        background-clip: padding-box;
        background-color: #eeeeee;
        border: 1px solid #cccccc;
        border-top-right-radius: 4px;
        border-top-left-radius: 4px;
        border-bottom-right-radius: 4px;
        border-bottom-left-radius: 4px;
        background-image: -webkit-linear-gradient(top, #ffffff 0%, #eeeeee 100%);
        background-image: -o-linear-gradient(top, #ffffff 0%, #eeeeee 100%);
        background-image: linear-gradient(to bottom, #ffffff 0%, #eeeeee 100%);
        background-repeat: repeat-x;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffffff', endColorstr='#ffeeeeee', GradientType=0);
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        color: #333333;
        cursor: default;
        line-height: 13px;
        margin: 6px 0 3px 5px;
        padding: 3px 20px 3px 5px;
        position: relative;
    }

    .chosen-container-multi .chosen-choices .search-choice .search-choice-close {
        background: url('chosen-sprite.png') right top no-repeat;
        display: block;
        font-size: 1px;
        height: 10px;
        position: absolute;
        right: 4px;
        top: 5px;
        width: 12px;
        cursor: pointer;
    }

    .chosen-container-multi .chosen-choices .search-choice .search-choice-close:hover {
        background-position: right -11px;
    }

    .chosen-container-multi .chosen-choices .search-choice-focus {
        background: #d4d4d4;
    }

    .chosen-container-multi .chosen-choices .search-choice-focus .search-choice-close {
        background-position: right -11px;
    }

    .chosen-container-multi .chosen-results {
        margin: 0 0 0 0;
        padding: 0;
    }

    .chosen-container-multi .chosen-drop .result-selected {
        display: none;
    }

    .chosen-container-active .chosen-single {
        border: 1px solid #66afe9;
        -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .075) inset, 0 0 8px rgba(82, 168, 236, .6);
        box-shadow: 0 1px 1px rgba(0, 0, 0, .075) inset, 0 0 8px rgba(82, 168, 236, .6);
        -webkit-transition: border linear .2s, box-shadow linear .2s;
        -o-transition: border linear .2s, box-shadow linear .2s;
        transition: border linear .2s, box-shadow linear .2s;
    }

    .chosen-container-active.chosen-with-drop .chosen-single {
        background-color: #ffffff;
        border: 1px solid #66afe9;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
        -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .075) inset, 0 0 8px rgba(82, 168, 236, .6);
        box-shadow: 0 1px 1px rgba(0, 0, 0, .075) inset, 0 0 8px rgba(82, 168, 236, .6);
        -webkit-transition: border linear .2s, box-shadow linear .2s;
        -o-transition: border linear .2s, box-shadow linear .2s;
        transition: border linear .2s, box-shadow linear .2s;
    }

    .chosen-container-active.chosen-with-drop .chosen-single div {
        background: transparent;
        border-left: none;
    }

    .chosen-container-active.chosen-with-drop .chosen-single div b {
        background-position: -18px 7px;
    }

    .chosen-container-active .chosen-choices {
        border: 1px solid #66afe9;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
        -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .075) inset, 0 0 8px rgba(82, 168, 236, .6);
        box-shadow: 0 1px 1px rgba(0, 0, 0, .075) inset, 0 0 8px rgba(82, 168, 236, .6);
        -webkit-transition: border linear .2s, box-shadow linear .2s;
        -o-transition: border linear .2s, box-shadow linear .2s;
        transition: border linear .2s, box-shadow linear .2s;
    }

    .chosen-container-active .chosen-choices .search-field input[type='text'] {
        color: #111 !important;
    }

    .chosen-container-active.chosen-with-drop .chosen-choices {
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .chosen-disabled {
        cursor: default;
        opacity: 0.5 !important;
    }

    .chosen-disabled .chosen-single {
        cursor: default;
    }

    .chosen-disabled .chosen-choices .search-choice .search-choice-close {
        cursor: default;
    }

    .chosen-rtl {
        text-align: right;
    }

    .chosen-rtl .chosen-single {
        padding: 0 8px 0 0;
        overflow: visible;
    }

    .chosen-rtl .chosen-single span {
        margin-left: 26px;
        margin-right: 0;
        direction: rtl;
    }

    .chosen-rtl .chosen-single div {
        left: 7px;
        right: auto;
    }

    .chosen-rtl .chosen-single abbr {
        left: 26px;
        right: auto;
    }

    .chosen-rtl .chosen-choices .search-field input[type='text'] {
        direction: rtl;
    }

    .chosen-rtl .chosen-choices li {
        float: right;
    }

    .chosen-rtl .chosen-choices .search-choice {
        margin: 6px 5px 3px 0;
        padding: 3px 5px 3px 19px;
    }

    .chosen-rtl .chosen-choices .search-choice .search-choice-close {
        background-position: right top;
        left: 4px;
        right: auto;
    }

    .chosen-rtl.chosen-container-single .chosen-results {
        margin: 0 0 4px 4px;
        padding: 0 4px 0 0;
    }

    .chosen-rtl .chosen-results .group-option {
        padding-left: 0;
        padding-right: 15px;
    }

    .chosen-rtl.chosen-container-active.chosen-with-drop .chosen-single div {
        border-right: none;
    }

    .chosen-rtl .chosen-search input[type='text'] {
        background: url('chosen-sprite.png') no-repeat -28px -20px, #ffffff;
        direction: rtl;
        padding: 4px 5px 4px 20px;
    }

    @media only screen and (-webkit-min-device-pixel-ratio: 2),
    only screen and (min-resolution: 144dpi) {

        .chosen-rtl .chosen-search input[type='text'],
        .chosen-container-single .chosen-single abbr,
        .chosen-container-single .chosen-single div b,
        .chosen-container-single .chosen-search input[type='text'],
        .chosen-container-multi .chosen-choices .search-choice .search-choice-close,
        .chosen-container .chosen-results-scroll-down span,
        .chosen-container .chosen-results-scroll-up span {
            background-image: url('chosen-sprite@2x.png') !important;
            background-size: 52px 37px !important;
            background-repeat: no-repeat !important;
        }
    }
</style>
<!-- END: Head-->
<script src='app-assets/jQuery/jQuery-2.1.4.min.js'></script>

<body class='vertical-layout vertical-menu 2-columns   fixed-navbar' data-open='click' data-menu='vertical-menu' data-col='2-columns'>
    <!-- BEGIN: Header-->
    <nav class='header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light bg-info navbar-shadow'>
        <div class='navbar-wrapper'>
            <div class='navbar-header'>
                <ul class='nav navbar-nav flex-row'>
                    <li class='nav-item mobile-menu d-md-none mr-auto'><a class='nav-link nav-menu-main menu-toggle hidden-xs' href='#'><i class='ft-menu font-large-1'></i></a></li>
                    <li class='nav-item'><a class='navbar-brand' href=''>
                            <h3 class='brand-text'>E-Pharmacy</h3>
                        </a></li>
                    <li class='nav-item d-md-none'><a class='nav-link open-navbar-container' data-toggle='collapse' data-target='#navbar-mobile'><i class='la la-ellipsis-v'></i></a></li>
                </ul>
            </div>
            <div class='navbar-container content'>
                <div class='collapse navbar-collapse' id='navbar-mobile'>
                    <ul class='nav navbar-nav mr-auto float-left'>
                        <li class='nav-item d-none d-md-block'><a class='nav-link nav-menu-main menu-toggle hidden-xs' href='#'><i class='ft-menu'></i></a></li>

                        <div class='' style='color:white;margin-top:25px;'>
                            <a class='dropdown' style='color:white;' href=''><?php echo "Tupendane Pharmacy" ?></a>
                        </div>
                        </li>
                    </ul>
                    <ul class='nav navbar-nav float-right'>
                        
                        <li class='dropdown dropdown-user nav-item'>
                            <a class='dropdown-toggle nav-link dropdown-user-link' href='#' data-toggle='dropdown'>
                                
                                <span><?php echo $name ?></span></i></span>
                                <!-- <span><?php echo $_SESSION['role'] ?></span></i></span> -->
                            </a>
                            <div class='dropdown-menu dropdown-menu-right'>
                                <!-- <a class = 'dropdown-item' href = '#'><i class = 'ft-user'></i><?php echo $name; ?></a> -->
                                <a class='dropdown-item' href='#'><i class='ft-mail'>
                                        <span><?php echo $_SESSION['role'] ?></span>
                                    </i></span></i></a>
                                <a class='dropdown-item' href='index3.php?sp=change_password'><i class='ft-mail'></i>Change Password</a>
                                <a class='dropdown-item' href='index3.php?sp=change_password'><i class='ft-user'></i>Profile Information</a>
                                <!-- <a class = 'dropdown-item' href = '#'><i class = 'ft-check-square'></i> Task</a><a class = 'dropdown-item' href = '#'><i class = 'ft-message-square'></i> Chats</a> -->
                                <div class='dropdown-divider'></div><a class='dropdown-item' href='logout.php?logout=true'><i class='ft-power'></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->

    <div class='main-menu menu-fixed menu-light menu-accordion    menu-shadow ' data-scroll-to-active='true'>
        <?php include 'menu.php';
        ?>

    </div>

    <!-- END: Main Menu-->
    <!-- BEGIN: Content-->
    <div class='app-content content'>

        <?php include 'mainindex.php';
        ?>

    </div>
    <!-- END: Content-->



    <div class='sidenav-overlay'></div>
    <div class='drag-target'></div>



    <!-- BEGIN: Vendor JS-->
    <script src='app-assets/vendors/js/vendors.min.js'></script>

    <!-- BEGIN Vendor JS-->
    <script src='sweet/dist/sweetalert.min.js'></script>
    <script src='app-assets/jQuery/jQuery-2.1.4.min.js'></script>
    <script src='app-assets/js/jquery-1.12.4.js'></script>
    <!-- Download the latest jquery.validate minfied version -->
    <script src='https://code.jquery.com/jquery-2.1.4.min.js'></script>
    <!-- Download the latest jquery.validate minfied version -->
    <script src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js'></script>

    <!-- BEGIN: Page Vendor JS-->

    <!-- <script src = 'datatables/jquery.dataTables.min.js'></script>
    <script src = 'app-assets/vendors/js/datatables/dataTables.min.js'></script>
    <script src = 'plugins/datatables/dataTables.bootstrap4.min.js'></script>-->

    <script src="alertifyjs/alertify.js"></script>
    <script src="alertifyjs/alertify.min.js"></script>

    <script src='app-assets/vendors/js/tables/datatable/datatables.min.js'></script>
    <script src='app-assets/vendors/js/extensions/jquery.steps.min.js'></script>
    <script src='app-assets/vendors/js/forms/validation/jquery.validate.min.js'></script>
    <script src='app-assets/vendors/js/forms/icheck/icheck.min.js'></script>
    <script type='text/javascript' src='typeahead.js'></script>

    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->

    <script src='app-assets/js/core/app-menu.js'></script>
    <script src='app-assets/js/core/app.js'></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->

    <script src='app-assets/js/scripts/pages/hospital-add-patient.js'></script>
    <script src='js/chosen.jquery.min.js' type='text/javascript'></script>
    <!-- END: Page JS-->
    <script src='js/chosen.jquery.js'></script>

    <script>
        $(function() {
            $('.chosen-select').chosen();
            $('#new').chosen();
            $('.chosen-select').chosen();
        });
    </script>

    <!-- export buttons -->;

    <!-- <script src = 'datatables/buttons.html5.min.js' type = 'text/javascript'></script>
<script src = 'datatables/buttons.print.min.js' type = 'text/javascript'></script>
<script src = 'datatables/dataTables.buttons.min.js' type = 'text/javascript'></script>
<script src = 'datatables/jszip.min.js' type = 'text/javascript'></script>
<script src = 'datatables/pdfmake.min.js' type = 'text/javascript'></script>
<script src = 'datatables/vfs_fonts.js' type = 'text/javascript'></script>
<script src = 'datatables/buttons.colVis.min.js' type = 'text/javascript'></script>

<script src = 'datatables/dataTables.fixedColumns.min.js' type = 'text/javascript'></script>
-->


</body>

</html>