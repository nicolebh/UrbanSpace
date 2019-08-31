$( document ).ready(function() {
    //get a list of all the features available for the 'add space form'
    $.ajax({
        type: "POST",
        url: "/urbanspace/php_classes/spaces_mgmt.php",		
        data: {
            action: 'get_features',
        },
        success: function(data){
            document.getElementById('space_features_box').innerHTML = data;
            trigger_feature_summary();
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log("error in ajax request");
            console.log(errorThrown);
         }
    });

    //Get a list of spaces for 'shut/remove' menu
    $.ajax({
        type: "POST",
        url: "/urbanspace/php_classes/spaces_mgmt.php",		
        data: {
            action: 'get_spaces',
        },
        success: function(data){
            document.getElementById('space_list').innerHTML = data;
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log("error in ajax request");
            console.log(errorThrown);
         }
    });

    //Get a list of issues
    $.ajax({
        type: "POST",
        url: "/urbanspace/php_classes/spaces_mgmt.php",		
        data: {
            action: 'get_reports',
        },
        success: function(data){
            document.getElementById('issue_list').innerHTML = data;
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log("error in ajax request");
            console.log(errorThrown);
         }
    });
});
function trigger_feature_summary() {
document.getElementById('space_features').onchange = function(e) {
    // get reference to display textarea
    var features_sum = document.getElementById('features_sum');
    features_sum.value = ''; // reset
    
    // callback fn handles selected options
    getSelectedOptions(this, callback);
    
    // remove ', ' at end of string
    var str = features_sum.value.slice(0, -2);
    features_sum.value = str;
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
    features_sum.value += opt.value + ', ';

    // can access properties of opt, such as...
    //alert( opt.value )
    //alert( opt.text )
    //alert( opt.form )
}
}

function handle_remove_space_btn(spaceId){
    const remove_space_btn = document.querySelector('#remove_space_btn');
    $.ajax({
        type: "POST",
        url: "/urbanspace/php_classes/spaces_mgmt.php",		
        data: {
            action: 'remove_space',
            spaceId: spaceId
        },
        success: function(data){
            document.getElementById('spaceBox-'+spaceId).style.display="none";
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log("error in ajax request");
            console.log(errorThrown);
         }
    });
}
function handle_shut_space_btn(spaceId){
    $.ajax({
        type: "POST",
        url: "/urbanspace/php_classes/spaces_mgmt.php",		
        data: {
            action: 'shut_space',
            spaceId: spaceId
        },
        success: function(data){
            document.getElementsById('shut_space_btn').style.display="none";
            document.getElementsById('open_space_btn').style.display="inline";
            document.getElementsById('issue_status_lbl').innerHTML="Space Current Shut";
            document.getElementById('status_lbl').innerHTML=" Close";
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log("error in ajax request");
            console.log(errorThrown);
         }
    });
}
function handle_open_space_btn(spaceId){
    const open_space_btn = document.querySelector('#open_space_btn');
    $.ajax({
        type: "POST",
        url: "/urbanspace/php_classes/spaces_mgmt.php",		
        data: {
            action: 'open_space',
            spaceId: spaceId
        },
        success: function(data){
            console.log(data);
            document.getElementsById('shut_space_btn').style.display="inline";
            document.getElementsById('open_space_btn').style.display="none";
            document.getElementsById('issue_status_lbl').innerHTML="Space Current Open";
            document.getElementById('status_lbl').innerHTML=" Open";
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log("error in ajax request");
            console.log(errorThrown);
         }
    });
}

function handle_resolve_issue_btn(spaceId){
    console.log("test");
    const open_space_btn = document.querySelector('#open_space_btn');
    $.ajax({
        type: "POST",
        url: "/urbanspace/php_classes/spaces_mgmt.php",		
        data: {
            action: 'open_space',
            spaceId: spaceId
        },
        success: function(data){
            console.log(data);
            document.getElementById('shut_space_btn').style.display="inline";
            document.getElementById('open_space_btn').style.display="none";
            document.getElementById('status_lbl').innerHTML=" Open";
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log("error in ajax request");
            console.log(errorThrown);
         }
    });
}