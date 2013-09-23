<?php

/**
 * @package			Joomla.site
 * @subpackage		NG Todo
 * @author			Kumar
 * @copyright		Weblogicx India Private Limited. All rights reserved.
 * @licence			GNU GPL V2 or later
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

   /**
   * Controller NGTodoControllersAjax.
   *
   * Base controller NGTodoControllerDisplay.
   */

class NGTodoControllersAjax extends NGTodoControllersDisplay {

    /**
	 * controller execute.
	 */
	function execute() {
		
		/**
		 * Get the application.
		 */
		$app = $this->getApplication();
		
		/**
		 * get user object.
		 */ 
		$user = JFactory::getUser();
		
		/**
		 * array of data.
		 */ 
		$data = array();		
		
		if($user->id) {
                
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
		     */
			$layoutName = $app->input->getWord('layout', 'default');
			/**
		     * set view name display.
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
		     * Get view modelclass name.
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

            /**
		     * initialize modelclass.
		     */
			$model = new $modelClass();

			try {
				
				$data = $model->listItems();
			    
			    }catch (Exception $error) { 
				
				$data['msg'] = $error->getMessage();
			}
			
		    } else {
			
			/**
			 * redirect login page.
			 */
			$data['redirect'] = JRoute::_('index.php?option=com_users&view=login');
		
		    }	
		
		  /**
		   * for better security, add a prefix before echoing.
		   */
		   $prefix =")]}',\n";
		  
		  /**
		   * Decodes a JSON string.
		   * @link http://www.php.net/manual/en/function.json-decode.php
		   * The json string being decoded.
		   */
		   $json = json_encode($data);
		   
		   /**
		    * prefix concatenation with json data
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
