<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="panel panel-default">
	<div class="panel-heading">
    	<h3 class="panel-title panel-title-geral">Change Image</h3>
  	</div>
	<div class="panel-body">
		<div class="btn-group btn-group-geral">
			<upload-button class="btn btn-default btn-upload" url="ValidImg" on-complete="showResponse(response)">Upload</upload-button>
		</div>
	</div>
</div>
<div ng-bind-html="errorMsg"></div>