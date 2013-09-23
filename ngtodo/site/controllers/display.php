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
* Controller NGTodoControllersDisplay.
*
* Base controller JControllerBase.
*/
class NGTodoControllersDisplay extends JControllerBase {
    
    /**
	 * controller execute.
	 */
	function execute() {

		/**
		 * Get the application.
		 */
		$app = $this->getApplication();
		
		/**
		 * initialise the user object.
		 */ 
		$user = JFactory::getUser();
		
		/**
		 * check user id.
		 */ 
		if(!$user->id > 0 )
		{
			/**
			 * User login message.
			 */ 
			$msg = JText::_('COM_NGTODO_USER_LOGIN_MUST');
			
			/**
			 * login page link.
			 */ 
			$link = 'index.php?option=com_users&view=login';
			
			/**
			 * redirect the page.
			 */
			$app->redirect($link, $msg);
		}
		
		
		
		/**
		 * Get the document object.
		 */
		$document = JFactory::getDocument();
		
		/**
		 * Get view name display.
		 * 
		 * getWord() - returns string.
		 */
		$viewName = $app->input->getWord('view', 'display');
		$viewFormat = $document->getType();
		
		/**
		 * default layout.
		 * 
		 * getWord() - returns string.
		 */
		$layoutName = $app->input->getWord('layout', 'default');
        
        /**
		 * set viewname display.
		 */
		$app->input->set('view', $viewName);

		/**
		 * Register the layout paths for the view.
		 */ 
		$paths = new SplPriorityQueue;
		$paths->insert(JPATH_COMPONENT . '/views/' . $viewName . '/tmpl', 'normal');

        /**
		 * Get viewclass name.
		 */
		$viewClass = 'NGTodoViews' . ucfirst($viewName) . ucfirst($viewFormat);
		
		/**
		 * Get modelclass name.
		 */
		$modelClass = 'NGTodoModels' . ucfirst($viewName);

		/**
		 * Check modelclass name exists or not.
		 */
		if (false === class_exists($modelClass))
		{
			//set default modelclass name.
			$modelClass = 'NGTodoModelsDefault';
		}

		$view = new $viewClass(new $modelClass, $paths);

		$view->setLayout($layoutName);

		// Render our view.
		echo $view->render();

		return true;
	}
	
	


}

