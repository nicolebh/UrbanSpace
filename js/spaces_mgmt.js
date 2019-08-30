//Add new space
if(document.querySelector('#addNewSpace-form')){
    const addspaceform = document.querySelector('#addNewSpace-form');
    addspaceform.addEventListener('submit', (e) => {
        e.preventDefault();
        // const name = addspaceform['space_name'].value;
        // const address = addspaceform['space_address'].value;
        // const city = addspaceform['space_city'].value;
        // const sport_type = addspaceform['space_sport_type'].value;
        // const num_of_players = addspaceform['space_num_players'].value;
        // const features = document.querySelector('#features_sum').innerHTML;
        // const space_image = $('#space_image').prop('files')[0];
        var fd = new FormData(document.querySelector('#addNewSpace-form'));
        // fd.append('space_image', space_image);
        // fd.append('name', name);
        // fd.append('address', address);
        // fd.append('city', city);
        // fd.append('sport_type', sport_type);
        // fd.append('num_of_players', num_of_players);
        // fd.append('features', features);

        console.log(fd);
        // $.ajax({
        //     type: "POST",
        //     url: "/urbanspace/php_classes/spaces_mgmt.php",	
        //     contentType: false,
        //     processData: false,	
        //     data: {
        //         action: "add_new_space",
        //         name: name,
        //         address: address,
        //         city: city,
        //         sport_type: sport_type,
        //         num_of_players: num_of_players,
        //         features: features,
        //         space_image: fd
        //     },
        //     success: function(data){
        //         if(data) {
        //             console.log(data); 
        //             alert(data);  
        //         }
        //     },
        //     error: function(XMLHttpRequest, textStatus, errorThrown) {
        //         console.log("error in ajax request");
        //         console.log(errorThrown);
        //     }
        // })    
    })
}

document.getElementById('space_features').onchange = function(e) {
    
    // get reference to display textarea
    var features_sum = document.getElementById('features_sum');
    features_sum.innerHTML = ''; // reset
    
    // callback fn handles selected options
    getSelectedOptions(this, callback);
    
    // remove ', ' at end of string
    var str = features_sum.innerHTML.slice(0, -2);
    features_sum.innerHTML = str;
};

function getSelectedOptions(sel, fn) {
    var opts = [], opt;
    
    // loop through options in select list
    for (var i=0, len=sel.options.length; i<len; i++) {
        opt = sel.options[i];
        
        // check if selected
        if ( opt.selected ) {
            // add to array of option elements to return from this function
            opts.push(opt);
            
            // invoke optional callback function if provided
            if (fn) {
                fn(opt);
            }
        }
    }
    
    // return array containing references to selected option elements
    return opts;
}
function callback(opt) {
    // display in textarea for this example
    var features_sum = document.getElementById('features_sum');
    features_sum.innerHTML += opt.value + ', ';

    // can access properties of opt, such as...
    //alert( opt.value )
    //alert( opt.text )
    //alert( opt.form )
}