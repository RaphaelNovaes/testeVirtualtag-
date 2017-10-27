<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	include_once APPPATH.'views/header.php';
?>
<div class="panel panel-default panel-login-geral">
  <div class="panel-heading">
    <h3 class="panel-title panel-title-geral">Login</h3>
  </div>
  <div class="panel-body" >
  		<form id='form_login' action="#">
	  		<div class="form-group">
		    	<input type="text" name='login' class="form-control" placeholder="Login">
		   	</div>
		   	<div class="form-group">
		    	<input type="password" name='senha' class="form-control" placeholder="Pass">
		   	</div>

		   	<div class="btn-group btn-group-geral">
		    	<div id='btn-entry' class="btn btn-default">Go</div>
		   	</div>
		   	<div class="btn-group btn-group-geral-right">
		    	<a href="NewUserView"><span class='glyphicon glyphicon-plus'></span>New User</a>
		    </div>
	   	</form>
  </div>
</div>
<div class="pn-error panel-login-geral"></div>