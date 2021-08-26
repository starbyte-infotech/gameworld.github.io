<?php 
error_reporting(0);
session_start();
if(!isset($_SESSION['userlogin'])){
    header("location:login.php");
}
?>
<!--

=========================================================
* Now UI Dashboard - v1.5.0
=========================================================

* Product Page: https://www.creative-tim.com/product/now-ui-dashboard
* Copyright 2019 Creative Tim (http://www.creative-tim.com)

* Designed by www.invisionapp.com Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Now UI Dashboard by Creative Tim
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons  -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
  <link href="assets/css/custom_style.css" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
  <link rel="stylesheet" href="https://fengyuanchen.github.io/cropperjs/css/cropper.css" />
  <script src="https://fengyuanchen.github.io/cropperjs/js/cropper.js"></script> 
  <style type="text/css">
    .divActive a.active{
      background-color: #fff;   
      box-shadow: 0 1px 15px 1px rgb(39 39 39 / 10%);   
    }
    .divActive a.active p, .divActive a.active i{
      color: #F96332;
    }
    .divActive p:hover{
      color: #fff !important;
    }
  </style>
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="orange">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo" style="text-align: center;">
        <!-- <a href="http://www.creative-tim.com" class="simple-text logo-mini">
          <img src="assets/images/000.png">
        </a> -->
        <a href="index.php" class="simple-text logo-normal">
          <h3 style="margin: 10px !important;">WOOKOO</h3>
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
        
          <li class="divActive">
            <a href="index.php" class="active ">
              <i class="now-ui-icons design_app"></i>
              <p>Home</p>
            </a>
          </li>
          <li>
            <a href="add-new-game.php">
              <i class="now-ui-icons tech_controller-modern"></i>
              <p>Add New Game</p>
            </a>
          </li>
          <li>
            <a href="edit-details.php">
              <i class="now-ui-icons ui-1_settings-gear-63"></i>
              <p>Edit game details </p>
            </a>
          </li>
          <li>
            <a href="remove.php">
              <i class="now-ui-icons ui-1_simple-remove"></i>
              <p>Remove game </p>
            </a>
          </li> 
          <li>
            <a href="add-new-category.php">
              <i class="now-ui-icons design_bullet-list-67"></i>
              <p>Add New Category</p>
            </a>
          </li>
          <li>
            <a href="remove-category.php">
              <i class="now-ui-icons design_scissors "></i>
              <p>Remove Category </p>
            </a>
          </li>    
          <li>
            <a href="trending_games.php">
              <i class="now-ui-icons tech_controller-modern"></i>
              <p>Trending Games </p>
            </a>
          </li>                   
           <li class="">
            <a href="user.php">
              <i class="now-ui-icons users_single-02"></i>
              <p>User Profile</p>
            </a>
          </li>
          <li class="">
            <a href="change_password.php">
              <i class="now-ui-icons ui-1_settings-gear-63"></i>
              <p>Change Password</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">Dashboard</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
            aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form>
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="now-ui-icons ui-1_zoom-bold"></i>
                  </div>
                </div>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="#pablo">
                  <i class="now-ui-icons media-2_sound-wave"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Stats</span>
                  </p>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  <i class="now-ui-icons users_single-02"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="./logout.php">Log-out</a>
      
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="panel-header panel-header-sm">

      </div>