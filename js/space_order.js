$(document).ready(()=> {
    const loading_spin = document.getElementById('loading_spin');
    loading_spin.style.visibility = "hidden";
    const buttons_list = document.getElementById("hours_list").querySelectorAll(".btn");
    for(var i = 0; i < buttons_list.length; i++) {
        buttons_list[i].style.visibility = "hidden";
    }

    if(document.querySelector('#book_date')){
        const book_date = document.querySelector('#book_date');
        book_date.onchange = function() {
            loading_spin.style.visibility = "visible";
            var url_string = document.URL;
            var url = new URL(url_string);
            
            var spaceID = url.searchParams.get("spaceID");
            
            $.ajax({
                type: "POST",
                url: "/urbanspace/php_classes/space_order.php",		
                data: {
                    action: 'check_booked_dates',
                    spaceID: spaceID,
                    book_date: book_date.value
                },
                success: function(data){
                    console.log(data);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log("error in ajax request <js/space_order.js>");
                    console.log(errorThrown);
                 }
            });
        }
    }
})