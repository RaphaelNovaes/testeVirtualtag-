<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="panel panel-default">
	<div class="panel-heading">
    	<h3 class="panel-title panel-title-geral">Change Image</h3>
  	</div>
	<div class="panel-body">
		<div class="btn-group btn-group-geral">
			<div class="btn btn-default btn-upload"  upload-button url="ValidImg" on-success="showResponse(response)">Upload</div>
		</div>
	</div>
</div>
<div ng-bind-html="errorMsg"></div>