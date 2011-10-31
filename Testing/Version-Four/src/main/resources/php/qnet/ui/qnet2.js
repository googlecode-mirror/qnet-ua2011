var qlength = 0;
function addqbox() {
    var qbox = generateqbox(qlength++);
    document.getElementById('boxesTarget').appendChild(qbox);
    document.getElementById('qlength').setAttribute("value", qlength);
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