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
* Controller NGTodoControllersDefault.
*
* Base controller JControllerBase abstract class.
*/

class NGTodoControllersDefault extends JControllerBase {
	
	/**
     * controller execute.
	 */
	function execute() {
		
		/**
		 * Get the application.
		 */ 
		$app = $this->getApplication();

		/**
		 * Get the document object.
		 */
		$document = JFactory::getDocument();

		/**
		 * Get view name display.
		 * getWord() - returns string.
		 */
		$viewName = $app->input->getWord('view', 'default');
		$viewFormat = $document->getType();
		
		/**
		 * default layout.
		 * getword() - returns string.
		 */
		$layoutName = $app->input->getWord('layout', 'default');

		/**
		 * set view name.
		 */
		$app->input->set('view', $viewName);

		/**
		 * Register the layout paths for the view.
		 */
		$paths = new SplPriorityQueue;
		$paths->insert(JPATH_COMPONENT_ADMINISTRATOR . '/views/' . $viewName . '/tmpl', 'normal');
		
		/**
		 * get viewclass name.
		 * 
		 * ucfirst() - first character of str capitalized.
		 */
		$viewClass = 'NGTodoViews' . ucfirst($viewName) . ucfirst($viewFormat);
		
		/**
		 * get modelclass name.
		 */
		$modelClass = 'NGTodoModels' . ucfirst($viewName);
	
		/**
		 * check modelclass name exists or not.
		 */
		if (false === class_exists($modelClass))
		{
			//set default modelclass name
			$modelClass = 'NGTodoModelsDefault';
		}
		
		$view = new $viewClass(new $modelClass, $paths);
		
		$view->setLayout($layoutName);
		
		// Render our view.
		echo $view->render();
		
		return true;
		
	}

}
