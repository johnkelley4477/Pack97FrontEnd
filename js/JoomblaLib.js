/*
*	This library will add the functionality needed for the Joombla pages
*/

getData('test','#dynamicEventBanners','#dynamicEventBanners','/events/eventsBanners.php',"");

//Fix the styling on the resources page. ToDo: Remove this when we can really make the changes needed.
if($("img[src='/images/stories/']").length >  0){
	const UList = $('.componentheading').siblings()[1],
	innerTitleTag = '<img src="/images/stories/bearstck.jpg" alt="Web Links" align="" hspace="6"><p style="line-height: normal;">We are 	regularly out on the Web. <br>When we find a great site we list it.</p>';

	$('.contentdescription').html(innerTitleTag);
	$(UList).attr('class','weblink_list');
}