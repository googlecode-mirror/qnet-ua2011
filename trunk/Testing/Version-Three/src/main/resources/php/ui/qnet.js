var qlength = 0;
var filterslength = 0;

function addqbox() {
    var qbox = generateqbox(qlength++);
    document.getElementById('boxesTarget').appendChild(qbox);
    document.getElementById('qlength').setAttribute("value", qlength);
}
function addfilter() {
    var filter = generatefilter(filterslength++);
    document.getElementById('filtersTarget').appendChild(filter);
    document.getElementById('filterslength').setAttribute("value", filterslength);
}
function updatePopulationSelect(evt) {
    var select = evt.target;
    var population = select.parentNode.parentNode.getElementsByTagName('select')[1];
    $.ajax({url: "/Qnet/target/classes/php/qnet/ui/populations.php?category="+select.value, context: document.body, success: function(response){
        population.innerHTML = response;
    }});
}
function generateqbox(index) {
    var qbox = document.getElementById('qbox').cloneNode(true);
    qbox.style.display = 'block';
    qbox.removeAttribute('id');

    qbox.getElementsByTagName('label')[0].setAttribute("for", "questionname" + index);
    qbox.getElementsByTagName('input')[0].setAttribute("name", "questionname" + index);
    qbox.getElementsByTagName('input')[0].setAttribute("id", "questionname" + index);

    qbox.getElementsByTagName('label')[1].setAttribute("for", "answers" + index);
    qbox.getElementsByTagName('select')[0].setAttribute("name", "answers"+index);
    qbox.getElementsByTagName('select')[0].setAttribute("id", "answers"+index);

    return qbox;
}

function generatefilter(index) {
    var filter = document.getElementById('filter').cloneNode(true);
    filter.style.display = 'block';
    filter.removeAttribute('id');

    var select = filter.getElementsByTagName('select')[0];
    filter.getElementsByTagName('label')[0].setAttribute("for", "filtercat" + index);
    select.setAttribute("name", "filtercat" + index);
    select.setAttribute("id", "filtercat" + index);
    select.onchange = updatePopulationSelect;

    filter.getElementsByTagName('label')[1].setAttribute("for", "filterpop" + index);
    filter.getElementsByTagName('select')[1].setAttribute("name", "filterpop" + index);
    filter.getElementsByTagName('select')[1].setAttribute("id", "filterpop" + index);

    return filter;
}

function refreshFollowing() {
    $.ajax({url: "/Qnet/target/classes/php/qnet/ui/bridgeHeader.php?target=ing", context: document.body, success: function(response){
        $('#followingLI').replaceWith(response);
    }});
}
function refreshFollowers() {
    $.ajax({url: "/Qnet/target/classes/php/qnet/ui/bridgeHeader.php?target=ers", context: document.body, success: function(response){
        $('#followersLI').replaceWith(response);
    }});
}

function follow(id){
    $('#followBtt').fadeOut('fast');
    $.ajax({
        url: '../controller/newTrackingController.php',
        type: "GET",
        data: "uid="+id,
        success: function(data) {}
    });
}


function responseReq(notificationId, i, response){
    $('#Req'+i).empty();
    var message = "";
    switch(response) {
        case 0:
            message = "Request rejected.";
            break;
        case 1:
            message = "Request accepted!";
    }
	$.ajax({
  	url: '../controller/trackingsController.php',
	type: "GET",
	data: "notificationId="+notificationId+"&response="+response,
	  success: function(data) {
          if(response != 2) {
            $('#Req'+i).html('<p>'+message+'</p>');
            refreshFollowers();
          }
	  }
	});
}

function getUrlVars()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

function showError(){
         var hasError = getUrlVars()["error"];

    if((!hasError)&& hasError!=undefined){

    alert("You must use a jpg file");
    }


}