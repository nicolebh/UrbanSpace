$(document).ready(()=> {
    const loading_spin = document.getElementById('loading_spin');
    loading_spin.style.visibility = "hidden";
    const buttons_list = document.getElementById("hours_list").querySelectorAll(".btn");
    for(var i = 0; i < buttons_list.length; i++) {
        buttons_list[i].style.visibility = "hidden";
    }
    const duration = document.getElementById("duration");
    duration.disabled=true;
})

function getAvailableHours() {
    document.getElementById("duration").disabled=false;
    loading_spin.style.visibility = "visible";
    var url_string = document.URL;
    var url = new URL(url_string);
    
    var spaceID = url.searchParams.get("spaceID");
    var duration = document.getElementById("duration");
    
    $.ajax({
        type: "POST",
        url: "/urbanspace/php_classes/space_order.php",		
        data: {
            action: 'check_booked_dates',
            spaceID: spaceID,
            book_date: book_date.value,
            duration: duration.value
        },
        success: function(data){
            loading_spin.style.display = "none";
            document.getElementById('hours_btns').innerHTML = data;
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log("error in ajax request <js/space_order.js>");
            console.log(errorThrown);
         }
    });
}