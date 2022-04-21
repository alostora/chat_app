<!DOCTYPE html>
<html lang="ar">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{config('app.name')}}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{url('dashboard_admin_panel/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">

<!-- Select2 -->
  <link rel="stylesheet" href="{{url('dashboard_admin_panel/bower_components/select2/dist/css/select2.min.css')}}">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('dashboard_admin_panel/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{url('dashboard_admin_panel/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{url('dashboard_admin_panel/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('dashboard_admin_panel/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{url('dashboard_admin_panel/dist/css/skins/_all-skins.min.css')}}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{url('dashboard_admin_panel/bower_components/morris.js/morris.css')}}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{url('dashboard_admin_panel/bower_components/jvectormap/jquery-jvectormap.css')}}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{url('dashboard_admin_panel/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{url('dashboard_admin_panel/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{url('dashboard_admin_panel/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]-->
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <!--[endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">



  @if(App::getLocale() == "ar" || App::getLocale() == "")
    <link rel="stylesheet" href="{{url('dashboard_admin_panel/bootstrap/css/bootstrap-rtl.min.css')}}">
    <link rel="stylesheet" href="{{url('dashboard_admin_panel/dist/css1/AdminLTE-rtl.min.css')}}">
    <link rel="stylesheet" href="{{url('dashboard_admin_panel/dist/css1/skins/_all-skins-rtl.min.css')}}">
    <?php $dir = "rtl" ?>
  @elseif(App::getLocale() == "en")
    <?php $dir = "ltr" ?> 
  @else
    <?php $dir = "rtl" ?>  
  @endif

<link href='https://fonts.googleapis.com/css?family=Cairo' rel='stylesheet'>
    <link rel="stylesheet" href="{{url('dashboard_admin_panel/myStyle.css')}}">

<script src="{{url('dashboard_admin_panel/bower_components/ckeditor/ckeditor.js')}}"></script>
<script src="{{url('dashboard_admin_panel/bower_components/jquery/dist/jquery.min.js')}}"></script>


  <!-- <link rel="stylesheet" href="{{url('dashboard_admin_panel/bootstrap/css/bootstrap-rtl.min.css')}}">

  <link rel="stylesheet" href="{{url('dashboard_admin_panel/dist/css1/AdminLTE-rtl.min.css')}}">

  <link rel="stylesheet" href="{{url('dashboard_admin_panel/dist/css1/skins/_all-skins-rtl.min.css')}}"> -->




  <link rel="stylesheet" href="{{url('dashboard_admin_panel/plugins/iCheck/all.css')}}">


  <!-- file drop zone -->

  <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
  <!-- <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
  <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" /> -->

  <style type="text/css">
    .table-image{
      height: 50px;
      width: 50px;
      border-radius: 50%;
    }
    /*.skin-purple .main-header .navbar{
      background-color: #5cb85c;
    }

    .skin-purple .main-header .logo{
      background-color: #209a94d1;
    }
    .colorCode{
      height: 50px;
      width: 50px;
      border-radius: 50%;
    }*/
  </style>


  

</head>

<body class="skin-blue sidebar-mini wysihtml5-supported" dir={{$dir}} >
<div class="wrapper">