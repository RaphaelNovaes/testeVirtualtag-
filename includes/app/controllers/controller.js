mainApp.controller('mainController', function($scope){
	$scope.showResponse = function(data){
		$scope.imgSrc = $scope.imgSrc;
		$scope.errorMsg = $.parseJSON(data).msg;
	}

	$scope.submitPass = function(){
		$.post('ChangePass', {pass_old: $scope.pass_old, new_pass: $scope.new_pass}, function(data) {
			$scope.errorMsg = $.parseJSON(data).msg;
		});
	}

	$scope.iniDatatable = function(){
		table = $('#products').DataTable({
        	"ajax": 'GetProducts'
    	})

    	table.MakeCellsEditable({
	        "onUpdate": myCallbackFunction,
	        "inputCss":'my-input-class',
	        "columns": [1,2,3,4,5],
	        "confirmationButton": { // could also be true
	            "confirmCss": 'my-confirm-class',
	            "cancelCss": 'my-cancel-class'
	        },
	        "inputTypes": [
	            {
	                "column": 0,
	                "type": "text",
	                "options": null
	            },
	            {
	                "column": 0,
	                "type": "text",
	                "options": null
	            },
	            {
	                "column": 0,
	                "type": "text",
	                "options": null
	            },
	            {
	                "column": 0,
	                "type": "text",
	                "options": null
	            },
	            {
	                "column": 0,
	                "type": "text",
	                "options": null
	            },
	        ]
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
	}

	function myCallbackFunction (updatedCell, updatedRow, oldValue) {
	    var obj = updatedRow.data().reduce(function(key, val) { key[val] = val; return key; }, {});
	    $.post('PutProduct', obj);
	}
});