<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="panel panel-default">
	<div class="panel-heading">
    	<h3 class="panel-title panel-title-geral">Change Password</h3>
  	</div>
	<div class="panel-body">
		<form id='form_login' action="#">
			<div class="form-group">
				<input type="password" ng-model='pass_old' class="form-control" placeholder="Pass Old">
			</div>
			<div class="form-group">
				<input type="password" ng-model='new_pass' class="form-control" placeholder="New Pass">
			</div>
			<div class="btn-group btn-group-geral">
				<div id='btn-entry' class="btn btn-default" ng-click="submitPass()">Change</div>
			</div>
		</form>
	</div>
</div>
<div ng-bind-html="errorMsg"></div>
