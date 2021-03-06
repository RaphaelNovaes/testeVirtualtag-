<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="form-group">
	<input type="text" class="form-control" id="word" placeholder="Word">
</div>
<div class="form-group">
	<select class="form-control" id="def">
		<option value="">Everything</option>
		<option value="definitions">Definitions</option>
		<option value="synonyms">Synonyms</option>
		<option value="antonyms">Antonyms</option>
		<option value="examples">Examples</option>
		<option value="rhymes">Rhymes</option>
		<option value="frequency">Frequency</option>
		<option value="typeOf">Is A Type Of</option>
		<option value="hasTypes">Has Types</option>
		<option value="partOf">Part Of</option>
		<option value="hasParts">Has Parts</option>
		<option value="instanceOf">Is An Instance Of</option>
		<option value="hasInstances">Has Instances</option>
		<option value="inRegion">In Region</option>
		<option value="regionOf">Region Of</option>
		<option value="usageOf">Usage Of</option>
		<option value="hasUsages">Has Usages</option>
		<option value="memberOf">Is A Member Of</option>
		<option value="hasMembers">Has Members</option>
		<option value="substanceOf">Is A Substance Of</option>
		<option value="hasSubstances">Has Substances</option>
		<option value="hasAttribute">Has Attribute</option>
		<option value="inCategory">In Category</option>
		<option value="hasCategories">Has Categories</option>
		<option value="also">Also</option>
		<option value="pertainsTo">Pertains To</option>
		<option value="similarTo">Similar To</option>
		<option value="entails">Entails</option>
	</select>
</div>
<button class="btn btn-info" ng-click="sendDef()">Find</button>
<div class='def-msg' ng-bind-html="defWord"></div>