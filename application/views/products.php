<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
<button id='btn-delete' class="btn btn btn-default">Delete selected row</button>
<table id="products" class="display" cellspacing="0" width="100%" ng-init="iniDatatable()">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Pack</th>
            <th>Sold-By</th>
            <th>Sub-Category</th>
            <th>Category</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Pack</th>
            <th>Sold-By</th>
            <th>Sub-Category</th>
            <th>Category</th>
        </tr>
    </tfoot>
</table>