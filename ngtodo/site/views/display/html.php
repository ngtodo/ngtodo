<?php 

/**
* @package			Joomla.site
* @subpackage		NG Todo
* @author			Kumar
* @copyright		Weblogicx India Private Limited. All rights reserved.
* @licence			GNU GPL V2 or later
*/


// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * Joomla Platform HTML View Class
 * 
 * Base class JViewHtml abstract class
*/
class NGTodoViewsDisplayHtml extends JViewHtml {

    /**
	 * render function execute
	 */
	function render() {
		
		//tables path.
		JTable::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR.'/tables');
		
		/**
		 * Include paths for searching for JTable classes.
		 * 
		 * Static method to get an instance of a JTable class if it can be found in
	     * the table include paths.  To add include paths for searching for JTable
	     * classes @see JTable::addIncludePath()
		 */ 
		$table = JTable::getInstance('tasks', 'Table');
		
		//reorder method call.
		$table->reorder();
		
		$this->addToolBar();
		/**
		 * partial html file load
		 */
		$this->_StartView = NGTodoHelpersView::load('display','_start','phtml');
		
		
		/**
		 * Method to render the view.
		 */
		return parent::render();
	}

	function addToolBar() {
	//	JToolbarHelper::title(JText::_('COM_NGTODO'));
	}

}
