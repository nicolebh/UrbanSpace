$(document).ready(function(){
    $('#space-details').html(' \
        <div class="d-flex justify-content-center"> \
            <div class="spinner-border text-primary" role="status"> \
                <span class="sr-only">Loading...</span> \
            </div> \
        </div> \
        ');
    displayAllSpaces();
    // $('a').on('click', function(){
    //     alert('test');
    // })
});

function displayAllSpaces(){
    var action = 'fetch_data';
	var urlParams = new URLSearchParams(location.search);
    $.ajax({
        type: "POST",
        url: "php_classes/space_details.php",
		dataType: "json",		
		data: {
            action: action,/*, minPrice:	minPrice, maxPrice: maxPrice, brand:brand, ram:ram, storage:storage*/
			spaceId: urlParams.get('spaceID')
        },
		success: function(data){
            console.log(data.html[0]);
			$('#space-details').html(data.html);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert("errorrr");
		 }
	});
}
