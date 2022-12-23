
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
 

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/components.css">
    <!-- END: Theme CSS-->

   

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    
    
    <!-- hapa -->
  
    
  

</head>
<!-- END: Head-->

<body class="vertical-layout vertical-menu 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu" data-col="2-columns">

    <!-- BEGIN: Header-->
    
    <input onclick="changes()" type="button" value="Open Curtain" id="myButton1"></input>
<script>
function change();
{
    document.getElementById("myButton1").value="Close Curtain";
}
</script>
<script>
function changes() // no ';' here
{
    var elem = document.getElementById("myButton1");
    if (elem.value=="Close Curtain") elem.value = "Open Curtain";
    else elem.value = "Close Curtain";
}
</script>