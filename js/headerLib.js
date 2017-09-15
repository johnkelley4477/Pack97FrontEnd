/*
*	This library will create the menu and header functionality 
*/


/* Show or Hide the menu. 
	The reason that we are moving the menu out of the visable are instead of hiding it is because of SEO.
	Web crawlers ignore hidden elements
*/ 
const mainMenu = $(".main_menu");
$(".item84").bind('click',() => {
	if(mainMenu.css('left') === "-300px"){  
		mainMenu.css('left',"0px"); //Show the menu
	}else{
		mainMenu.css('left',"-300px"); //Hide the menu
	}
});
$(".item84").bind('mouseenter',() => {
	mainMenu.css('left',"0px"); //Show the menu
});
//Bind menu items
//bind home menu buttons
$("#mm .item1").bind('touchstart click',() => {window.location = 'http://www.cubscoutpack97.org/'});
//bind Program Overview menu buttons
$("#mm .item27").bind('touchstart click',() => {window.location = 'http://www.cubscoutpack97.org/index.php?option=com_content&amp;view=article&amp;id=19&amp;Itemid=27'});
//bind Pack menu nCommittee buttons
$("#mm .item58").bind('touchstart click',() => {window.location = 'http://www.cubscoutpack97.org/index.php?option=com_contact&amp;view=category&amp;catid=12&amp;Itemid=58'});
//bind Leaders menu buttons
$("#mm .item59").bind('touchstart click',() => {window.location = 'http://www.cubscoutpack97.org/index.php?option=com_contact&amp;view=category&amp;catid=37&amp;Itemid=59'});
//bind Resources menu buttons
$("#mm .item66").bind('touchstart click',() => {window.location = 'http://www.cubscoutpack97.org/events/events_home.php'});
//bind Calendar menu buttons
$("#mm .item69").bind('touchstart click',() => {window.location = 'http://www.cubscoutpack97.org/index.php?option=com_content&amp;view=category&amp;id=41&amp;Itemid=69'});
//bind Scout Camps menu buttons
$("#mm .item81").bind('touchstart click',() => {window.location = 'http://www.cubscoutpack97.org/PDF/2017_2018_Den_Room_Assignments.pdf'});
//bind Resources menu buttons
$("#mm .item48").bind('touchstart click',() => {window.location = 'http://www.cubscoutpack97.org/index.php?option=com_weblinks&amp;view=categories&amp;Itemid=48'});
//bind Den Meeting Times menu buttons
$("#mm .item82").bind('touchstart click',() => {window.location = 'https://www.scouttrack.com/ScoutTrack'});
//bind Scout Hike Totals menu buttons
$("#mm .item83").bind('touchstart click',() => {window.location = 'http://www.cubscoutpack97.org/hike/hike_home.php'});
//bind Multimedia Gallery menu buttons
$("#mm .item86").bind('touchstart click',() => {window.location = 'http://www.cubscoutpack97.org/index.php?option=com_content&amp;view=article&amp;id=140&amp;Itemid=86'});
	
//Add headers where needed

//Leaders page
if (window.location.search.search('Itemid=59') > 0){
	$('#whitebox').html('<div class="contentdescription"><p style="text-align:center;">Cub Scout Pack 97 Leaders</p>	</div>');
}
//Campsites Page
if (window.location.search.search('Itemid=69') > 0){
	const formfilterfields = $("td[colspan='5']")[0];
	$(formfilterfields).hide();
	$('#whitebox').html('<div class="contentdescription"><p style="text-align:center;">Cub Scout Pack 97 Campsites</p>	</div>');
}
//Contact Pages
if (window.location.search.search('com_contact&view=contact') > 0){
	const mainTableArray = $('#component-contact table tbody tr'),
			mainTableTD = $('#component-contact table tbody tr:first-child td');
	mainTableTD.css({'font-size':'30px','padding':'10px','text-align':'center'});
	$(mainTableArray[1]).css({'font-size':'20px','padding':'10px','text-align':'center'});
	$(mainTableArray[2]).hide();
	$(mainTableArray[3]).hide();
}




