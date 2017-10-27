<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	include_once APPPATH.'views/header.php';
?>
<div class="container">
	<div class="row">
        <div class="col-md-3">
            <div class="sidebar-nav-fixed affix">
                <div class="well">
                    <ul class="nav ">
                        <li class="nav-header">Sidebar</li>
                        <li class="active"><a href="#!ProductsView">Products</a>
                        </li>
                        <li><a href="#!DefinitionsView">Definitions</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <ng-view></ng-view>
        </div>
    </div>
</div>