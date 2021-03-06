<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$logged = ($this->session->userdata('logged'))?true:false;
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Test - Virtual Tag</title>
		<!-- INCLUDE CSS -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('includes/bootstrap-3.3.4-dist/css/bootstrap.min.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('includes/jquery/datatables/jquery.dataTables.min.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('includes/css/geral.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('includes/css/dashboard.css'); ?>">

		<!-- INCLUDE JS -->
		<script type="text/javascript" src="<?php echo base_url('includes/jquery/jquery-3.2.1.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('includes/bootstrap-3.3.4-dist/js/bootstrap.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('includes/angularjs/angular.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('includes/angularjs/angular-route.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('includes/angularjs/angular-sanitize.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('includes/jquery/datatables/jquery.dataTables.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('includes/jquery/datatables/dataTables.cellEdit.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('includes/js/geral.js'); ?>"></script>

		<!-- APP -->
		<script type="text/javascript" src="<?php echo base_url('includes/app/routes.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('includes/app/packages/angularUpload/angular-upload.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('includes/app/controllers/controller.js'); ?>"></script>

	</head>
	<body ng-app="main-App">
		<nav class="navbar navbar-default">
		  <div class="container-fluid">
		    <div class="navbar-header" style="width:100%">
		      	<a class="navbar-brand" href="#">Teste-VirtualTag</a>
		      	<?php if($logged): ?>
					<div class="btn-toolbar" role="toolbar" style="float:right;margin-top:10px">
						<div class="btn-group">
							<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class='glyphicon glyphicon-home'></span>
							</button>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><img ng-src="{{imgSrc}}" ng-init="imgSrc='<?php 
													echo base_url('includes/imgs/'. 
														$this->session->userdata('login') . 
														'_' . 
														$this->session->userdata('user_id') . 
														'.jpg' 
													); 
												?>'"  class="img-rounded img-max-size" alt="User photo"></li>
								<li><a ng-href="#!ChangeImgView" target="_self">Change Profile Image</a></li>
								<li><a ng-href="#!ChangePassView" target="_self">Change Password</a></li>
								<li><a href="<?php echo base_url(); ?>Logout">Logout</a></li>
						</ul>
						</div> 
					</div>
	  				<div style="float:right;margin-top:15px;margin-right:10px"><?php echo $this->session->userdata('nome'); ?></div>
  				<?php endif ?>
		    </div>
		  </div>
		</nav>