<?php

/**
 * @package			Joomla.site
 * @subpackage		NG Todo
 * @author			Kumar
 * @copyright		Weblogicx India Private Limited. All rights reserved.
 * @licence			GNU GPL V2 or later
*/

//no direct access.
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * Controller NGTodoControllersAdd.
 * 
 * Base controller - NGTodoControllerDisplay.
 */
class NGTodoControllersAdd extends NGTodoControllersDisplay {

   /**
	 * Execute the controller.
	 */
	function execute() {

		/**
		 *  Get the application.
		 */
		 $app = $this->getApplication();

		/**
		 *  Get the document object.
		 */
		$document = JFactory::getDocument();
        
        /**
		 * Get viewname - display.
		 * getWord() - returns string.
		 */
		$viewName = $app->input->getWord('view', 'display');
		$viewFormat = $document->getType();
		
		/**
		 * default layout.
		 */
		$layoutName = $app->input->getWord('layout', 'default');
        
        /**
		 * set viewname.
		 */
		$app->input->set('view', $viewName);
		$app->input->set('table', $viewName);
        
		// Register the layout paths for the view
		$paths = new SplPriorityQueue;
		$paths->insert(JPATH_COMPONENT . '/views/' . $viewName . '/tmpl', 'normal');

        /**
		 * get viewclass name.
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

		//initialise model
		$model = new $modelClass();
        
        //declare $data array
		$data = array();

		/**
		 * get the JSON data sent by angular js controllers. You cannot use the regular input getting methods
		 * because they do not support getting the JSON output.
		 */ 
		$input = new JInputJSON();
		
		$json = $input->getRaw();
		
		$post = json_decode($json);
                
		/**
		 *Store data use $post request.
		 *
		 *Data nothing - display error message.
		 */
		if(!$data = $model->store($post))
		{
			$data['success'] = 0;
			//error message
			$data['msg'] = JText::_('COM_NGTODO_PROJECT_ADD_FAILED');
		}
		
		/**
		 * for better security, add a prefix before echoing
		 */
		$prefix =")]}',\n";
		
		/**
		 * Decodes a JSON string
		 * @link http://www.php.net/manual/en/function.json-decode.php
		 * The json string being decoded.
		 */
		$json = json_encode($data);
		
		/**
		 * prefix character concatenation with json data.
		 */
		echo $prefix.$json;
		
		/**
		* finally call close method
		*
		* Method to close the application
		*
		* close() method call from JApplicationBase abstract class
		*/
		$app->close();
				
	}
	
	
}	
