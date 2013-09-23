<?php

/**
* @package			Joomla.site
* @subpackage		NG Todo
* @author			Kumar
* @copyright		Weblogicx India Private Limited. All rights reserved.
* @licence			GNU GPL V2 or later
*/

//no direct access.
defined ('_JEXEC')or die('Restrict access');

class NGTodoHelpersView
{
	public static function load($viewName,$layoutName='default',$viewFormat='html',$vars=null)
	{

		    /**
		     * Get the application.
		     */
			$app=JFactory::getApplication();
			
			/**
			 * Set viewname.
			 */
			$app->input->set('view',$viewName);

	 	    /**
	 	     * Register the layout apths for the view.
	 	     */
	 		$paths=new SplPriorityQueue();
	 		
	 		/**
	 		 * views path.
	 		 * 
	 		 * strtolower() - make a string lowercase.
	 		 */
	 		$paths->insert(JPATH_COMPONENT.'/views/'.strtolower($viewName).'/tmpl','normal');

	 		/**
	 		 * Get viewclass name.
	 		 * 
	 		 * Make a string's first character uppercase.
	 		 */
	 		$viewClass='NGTodoViews'.ucfirst($viewName).ucfirst($viewFormat);
	 		
	 		/**
	 		 * Get modelclass name.
	 		 * 
	 		 * Make a string's first character uppercase.
	 		 */
	 		$modelClass='NGTodoModels'.ucfirst($viewName);

	 		/**
	 		 * Check model class name exists or not.
	 		 */
	 		if(class_exists($modelClass)===false){
	 			
	 			//set modelclass name default
				$modelClass='NGTodoModelsDefault';
	 		}

			/**
			 * initialize viewclass and modelclass.
			 */
	 		$view=new $viewClass(new $modelClass,$paths);
	 		
	 		/**
	 		 * view layoutname.
	 		 */
			$view->setLayout($layoutName);
				
				/**
				 * if variable is set or is not null.
				 */
				if(isset($vars))
				{
					foreach($vars as $varName=>$var)
					{
						$view->$varName=$var;
					}
				}

			return $view;
		}

			/**
			 * definitation getHtml() function
			 */
			function getHtml($view,$layout,$item,$data)
			{
				/**
				 * load main function
				 * 
				 * public static function load($viewName,$layoutName='default',$viewFormat='html',$vars=null)
				 *
				 */
				$objectView=NgtodoHelpersView::load($view,$layout,'phtml');
				$objectView->$item=$data;
				ob_start();
				echo $objectView->render();
				$html=ob_get_contents();
				ob_clean();
				return $html;
			}


}
