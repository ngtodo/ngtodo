<?php 

/**
 * @package			Joomla.site
 * @subpackage		NG Todo
 * @author			Kumar
 * @copyright		Weblogicx India Private Limited. All rights reserved.
 * @licence			GNU GPL V2 or later
*/


// No direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * 
 * Base class JTable
 * 
 * Abstract Table class
 *
 * Parent class to all tables.
 * 
 */
class TableProjects extends JTable {

	function __construct (&$db) {

        /**
		 * Table name - Projects
		 * 
		 * Column name - project_id
		 */ 
		parent::__construct('#__ngtodo_projects', 'project_id', $db);
	}

}
