/*
* @package			Joomla.site
* @subpackage		NG Todo
* @author			Kumar
* @copyright		Weblogicx India Private Limited. All rights reserved.
* @licence			GNU GPL V2 or later
*/

/*
 * Jquery - scroll bottom.
 */ 
jQuery(function()
{
	jQuery('.scrollbottom').click(function ()
			{
		jQuery('html, body').animate({scrollTop:jQuery(document).height()}, 'slow');
		return false;
});
});
