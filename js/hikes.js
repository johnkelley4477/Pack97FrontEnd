/*
* The following bind actions to items specific to this page.
*/


// When the user clicks on <span> (x), close the modal
$(".close").bind('click',() => {
    $('#hikeModal').hide();
});

//When the user clicks on the 'less...' span the copy will be truncated
$('.jsCopyHide').bind('click',() => {
	$('.jsCopy').hide()
	$('.jsCopyHide').hide();
	$('.jsCopyShow').show();
});

//When the user clicks on the 'more...' span the copy will be displayed
$('.jsCopyShow').bind('click',() => {
	$('.jsCopy').show()
	$('.jsCopyHide').show();
	$('.jsCopyShow').hide();
});


/* When the user clicks on the scout's name in the modal. The modal will be closed
*  and the page will jump to the scout's name.
*/
function closeModal(){
	$('#hikeModal').hide();
};


/*
* The getData function will call a defined page and inject that page in the 
* targetd localtion
*
* Params
* @dataId (number) This is the key field for the SQL call
* @hideTarget (string) This is the element to show or hide when this is called
* @dataTarget (string) This is the element that will display the template page.
* @page (string) The template page
* @param (string) the name of the param to be used.
*
*/

function closeHikersDetail(){
	$('.hikers_details').fadeOut(200);
}

function getData(dataId,showHideTarget,dataTarget,page,param) {

    if (dataId == "") {
        $(showHideTarget).hide();
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                $(dataTarget).fadeIn(200).html(this.responseText);
            }
        };
        let p = "";
        if(param.length > 0){
        	p = "?" + param + "=" + dataId;
        }
        xmlhttp.open("GET",page + p,true);
        xmlhttp.send();
        $(showHideTarget).show();
    }
}
function jumpToScout(){
	var scoutId = $('#scout_search').val();
	console.log(scoutId);
	$(document).scrollTop( $('#' + scoutId).offset().top - 20 );
	$('#' + scoutId).fadeIn(200).fadeOut(200).fadeIn(200).fadeOut(200).fadeIn(200).fadeOut(200).fadeIn(200);
}