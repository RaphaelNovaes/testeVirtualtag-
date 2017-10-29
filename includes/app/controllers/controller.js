mainApp.controller('mainController', function($scope){
	$scope.showResponse = function(data){
		$scope.imgSrc = $scope.imgSrc;
		$scope.errorMsg = data.data.data;
	}

	$scope.submitPass = function(){
		$.post('ChangePass', {pass_old: $scope.pass_old, new_pass: $scope.new_pass}, function(data) {
			$scope.$apply(function() {
				$scope.errorMsg = $.parseJSON(data).msg;
			});
		});
	}

	$scope.iniDatatable = function(){
		table = $('#products').DataTable({
        	"ajax": 'GetProducts',
        	"columns": [
		        { data: "id_product" },
		        { data: "name","defaultContent": "default" },
		        { data: "pack","defaultContent": "default" },
		        { data: "soldby","defaultContent": "default" },
		        { data: "subcategory","defaultContent": "default" },
		        { data: "category","defaultContent": "default" }
		    ]
    	})

    	table.MakeCellsEditable({
	        "onUpdate": myCallbackFunction,
	        "inputCss":'my-input-class',
	        "columns": [1,2,3,4,5],
	        "allowNulls":{},
	        "confirmationButton": {
	            "confirmCss": 'my-confirm-class',
	            "cancelCss": 'my-cancel-class'
	        }
	    });

	    $('#products tbody').on( 'click', 'tr', function () {
	        if ( $(this).hasClass('selected') ) {
	            $(this).removeClass('selected');
	        }
	        else {
	            table.$('tr.selected').removeClass('selected');
	            $(this).addClass('selected');
	        }
	    } );
	 
	    $('#btn-delete').click( function () {
	    	conf = confirm('Delete row ?');
	    	if(conf == true){
	    		id = $('.selected').children(0).get(0).innerHTML;
	    		$.post('DelProduct', {'id':id});
	        	table.row('.selected').remove().draw( false );
	        }

	    } );

	    $('#btn-add').click( function () {
	    	$.post('GetLastProduct', {}, function(data){ 

	    		rowNode = table.row.add( {
		    		"id_product": (parseInt(data.last_id) + 1),
			        "name":"Default",
			        "pack":"Default",
			        "soldby":"Default",
			        "subcategory":"Default",
			        "category":"Default"
			    } ).draw().node();

			    $( rowNode ).css( 'color', 'red' ).animate( { color: 'black' } );
			    table.page('last').draw('page');
			    $.post('PostProduct', table.row($(rowNode)).data());

	    	},'json');
	    } );
	}

	function myCallbackFunction (updatedCell, updatedRow, oldValue) {
		var num = 1;
	    $.post('PutProduct', updatedRow.data());
	}

	$scope.sendDef = function(){
		word = $('#word').val();
		def = $('#def').val();

		if(def == 'everything')
			def = '';
		else
			def = '/'+def;

		$.post(
			'https://wordsapiv1.p.mashape.com/words/'+word+def, 
			{'X-Mashape-Key':'Your Key', 'Accept': 'application/json'}, 
			function(data){
				$scope.$apply(function() {
					$scope.defWord = '';
				});
			},
			'json'
		).fail(function(data) {
	    	$scope.$apply(function() {
				$scope.defWord = '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + $.parseJSON(data.responseText).message + '</div>';
			});
		})
		;
	}
});