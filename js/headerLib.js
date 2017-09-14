/*
*	This library will create the menu and header functionality 
*/


/* Show or Hide the menu. 
	The reason that we are moving the menu out of the visable are instead of hiding it is because of SEO.
	Web crawlers ignore hidden elements
*/ 
$(".item84").bind('click',() => {
	const mainMenu = $(".main_menu");
	if(mainMenu.css('left') === "-300px"){  
		mainMenu.css('left',"0px"); //Show the menu
	}else{
		mainMenu.css('left',"-300px"); //Hide the menu
	}
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
	