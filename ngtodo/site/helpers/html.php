<?php 

/**
 * @package			Joomla.site
 * @subpackage		NG Todo
 * @author			Kumar
 * @copyright		Weblogicx India Private Limited. All rights reserved.
 * @licence			GNU GPL V2 or later
 */

/**
 * no direct access.
 */
defined( '_JEXEC' ) or die( 'Restricted access' );


class NGTodoHelpersHtml {

    /**
	 * Declare the js and css files.
	 */
	public static function loadStrapper() {
		
	}
    
    /**
	  * loadNGFiles($file) loads to display view - default layout.
	  */
	public static function loadNGFiles($file) {

		/**
         * Get the document.
         */
		$document = JFactory::getDocument();
		
		/**
		 * Get file type.
		 */
		$filename = $file.'.js';
		
		/**
		 * Returns the root URI for the request.
		 * 
		 * @param boolean $pathonly If false, prepend the scheme, host and port information. Default is false.
 
         * string $path The path.
         * 
         * @return string The root URI string.
		 */
		$url = JUri::root(true).'/media/ngtodo/js/';
		$path = JPATH_SITE.'/media/ngtodo/js/';
		
		/**
		 * check filename exits or not.
		 */
		if(JFile::exists($path.$filename)) {
			$document->addScript($url.$filename);
		}

	}
	
	
	

}
