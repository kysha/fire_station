<!DOCTYPE html>
<html>
  <head>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400;300' rel='stylesheet' type='text/css'/>
    <link href="<?php echo base_url()?>assets/bootstrap/css/style.css" rel="stylesheet"/>    
    <link href="<?php echo base_url()?>assets/bootstrap/css/paging.css" rel="stylesheet"/>
    <link href="<?php echo base_url()?>assets/bootstrap/css/datepicker.css" rel="stylesheet"/>
    <link href="<?php echo base_url()?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url()?>assets/bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet"/>

    <link href="<?php echo base_url()?>assets/bootstrap/css/bootstrap-timepicker.css" rel="stylesheet"/>
    <link href="<?php echo base_url()?>assets/bootstrap/css/bootstrap-timepicker.min.css" rel="stylesheet"/>

    <script src="<?php echo base_url()?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/moment.js"></script>
    <script src="<?php echo base_url()?>assets/js/moment-duration-format.js"></script>
    <script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap.min.js"></script>
    <link href="<?php echo base_url();?>assets/bootstrap/css/modal.css" rel="stylesheet"/>
    <script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap-datetimepicker.js"></script>
    <script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap-timepicker.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/geoxml3.js"></script>    
    <script src="http://maps.googleapis.com/maps/api/js"></script>

  </head>
  <body>

    <!--Top Navigation -->      
    <nav class="navbar navbar-inverse" role="navigation" style="margin:0px;">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span> 
          </button>
          <a class="navbar-brand dropdown-toggle" data-toggle="dropdown" href="<?= base_url('')?>"><i class="fa fa-fire"></i> Fire Station <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="<?= base_url('settings')?>"><i class="fa fa-fw fa-gear"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="<?= base_url('login/logout')?>"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul> 
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li class="<?=($activeHeaders == 'Home') ? 'active' : ''?>"><a href="<?= base_url('home')?>">Home</a>
            </li>
            <li class="<?=($activeHeaders == 'About') ? 'active' : ''?>"><a href="<?= base_url('about')?>">About</a></li>
            <li class="<?=($activeHeaders == 'Logs') ? 'active' : ''?>"><a href="<?= base_url('logs')?>">Logs</a></li> 
           <li class="<?=($activeHeaders == 'Contacts') ? 'active' : ''?>">
              <a class="dropdown-toggle" data-toggle="dropdown" href="<?= base_url('')?>"> Contacts <b class="caret"></b></a>
              <ul class="dropdown-menu">
                  <li><a href="<?= base_url('contacts')?>">Barangay</a></li> 
                  <li class="divider"></li>
                  <li><a href="<?= base_url('substation')?>">Substation</a></li>
              </ul> 
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right" style="visibility: <?=($activeHeaders == 'Home') ? 'visible' : 'hidden'?>">
            <li><button type="button" class="btn btn-sm btn-danger icon-menu" style="margin:10px;"><i class="fa fa-exclamation-triangle" ></i> FIRE ALERT</button></li>
          </ul>
        </div>
      </div>
    </nav>
    <!--Top Navigation End-->
<?php
if($this->session->userdata['log_stat']['is_loggedin']==false 
|| empty($this->session->userdata['log_stat']['is_loggedin'])){
    redirect(base_url('login'));
}
?>
