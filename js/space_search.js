$(document).ready(function(){
    $('#search-results').html(' \
        <div class="d-flex justify-content-center"> \
            <div class="spinner-border text-primary" role="status"> \
                <span class="sr-only">Loading...</span> \
            </div> \
        </div> \
        ');
    displayAllSpaces();
    fillFilterOptions();
    // $('a').on('click', function(){
    //     alert('test');
    // })
});

function fillFilterOptions(){
    var action = 'fetch_data';
    var filter = 'city';
    $.ajax({
        type: "POST",
        url: "php_classes/space.php",
		dataType: "json",		
		data: {
            action: action,
            filter: filter
        },
		success: function(data){
			$('#cityDropdown').html(data.html);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert("errorrr1");
		 }
    });
    
    filter = 'sport_type';
    $.ajax({
        type: "POST",
        url: "php_classes/space.php",
		dataType: "json",		
		data: {
            action: action,
            filter: filter
        },
		success: function(data){
			$('#sportTypeDropDown').html(data.html);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert("errorrr1");
		 }
    });
    
    filter = 'num_of_players';
    $.ajax({
        type: "POST",
        url: "php_classes/space.php",
		dataType: "json",		
		data: {
            action: action,
            filter: filter
        },
		success: function(data){
			$('#participantsDropDown').html(data.html);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert("errorrr1");
		 }
	});
}

function displayAllSpaces(){
    var action = 'fetch_data';
    $.ajax({
        type: "POST",
        url: "php_classes/space.php",
		dataType: "json",		
		data: {
            action: action/*, minPrice:	minPrice, maxPrice: maxPrice, brand:brand, ram:ram, storage:storage*/
        },
		success: function(data){
            console.log(data.html[0]);
			$('#search-results').html(data.html);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert("errorrr");
		 }
	});
}

function displayNewSpaces(){
    var action = 'fetch_data';
    $.ajax({
        type: "POST",
        url: "php_classes/space.php",
		dataType: "json",		
		data: {
            action: action,
            newInDB: 'true'
        },
        success: function(data) {
            $('#search-results').html(data.html);
		},
        error: function(XMLHttpRequest, textStatus, errorThrown) {
             alert("errorrr");
        }
    });
}

function filterResults(type, value){
    $('#search-results').html(' \
        <div class="d-flex justify-content-center"> \
            <div class="spinner-border text-primary" role="status"> \
                <span class="sr-only">Loading...</span> \
            </div> \
        </div> \
        ');
        var action = 'fetch_data';
        var sql_condition = type + '="' + value + '"';
        $.ajax({
            type: "POST",
            url: "php_classes/space.php",
            dataType: "json",		
            data: {
                action: action,
                condition: sql_condition
            },
            success: function(data){
                $('#search-results').html(data.html);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("errorrr");
             }
        });
}