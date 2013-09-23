<?php

/**
 * @package			Joomla.site
 * @subpackage		NG Todo
 * @author			Kumar
 * @copyright		Weblogicx India Private Limited. All rights reserved.
 * @licence			GNU GPL V2 or later
 */

/**
 * Checks whether a given named constant exists.
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * Define NGTodoModelsProjects class.
 * 
 * Base class -  NGTodoModelsDefault.
 */
class NGTodoModelsProjects extends NGTodoModelsDefault {

    /**
	 * @var project_id initialize.
	 */
    protected $_project_id = null;

    /**
	 * __construct() function definitation.
	 * 
	 * get the application.
	 * 
	 * get() method refers JInput class.
	 * 
	 * __construct() refers NGTodoModelsDefault class.
	 */ 
	function __construct()
	{
		$app = JFactory::getApplication();
		$this->_project_id = $app->input->get('id', null);
        parent::__construct();
	}
	
	/**
	 * Get a database object.
	 * 
	 * abstract class JFactory.
	 * 
	 * @return query.
	 */
	protected function _buildQuery()
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(TRUE);
        
        /**
		 * select all fields from projects table.
		 * 
		 * alias name p.
		 * 
		 * @return query object.
		 */
		$query->select('p.*');
		$query->from('#__ngtodo_projects as p');
		return $query;
	}

	/**
	 * Builds the filter for the query
	 * 
	 * @param object Query object
	 * 
	 * @return object Query object
	 *
	 */
	protected function _buildWhere($query)
	{
		/**
		 * Joomla Platform Factory class.
		 * 
		 * Get an user object.
	     *
	     * Returns the global {@link JUser} object, only creating it if it doesn't already exist.  
		 */ 	
		$user = JFactory::getUser();

		if(is_numeric($this->_project_id))
		{
			$query->where('p.project_id = ' . (int) $this->_project_id);
		}
		if($user->id) {
			$query->where('p.user_id='.$user->id);
		}

		return $query;
	}
	
	/**
	 * @param object query object.
	 * 
	 * @return object query object.
	 */ 
	 protected function _buildOrder($query)
	{
		return $query;
	} 
	
	/**
	 * store data values.
	 * 
	 * @param $data array of data.
	 * 
	 */
	function store($data) {
		
		/**
		 * Joomla Platform Factory class.
		 * 
		 * Get an user object.
	     *
	     * Returns the global {@link JUser} object, only creating it if it doesn't already exist.  
		 */ 	
		$user = JFactory::getUser();
		
		/**
		 * Get the application.
		 */ 
		$app =JFactory::getApplication();
		
		//get id from $user.
		if($user->id) {
			$data->user_id = $user->id;
		}
			
		/**
		 * create result_task array.
		 * Get array of data.
		 */		
		$result = array();
	    
		try {
	
			$row = parent::store($data);
			
			//convert to array
			$result['data'] = JArrayHelper::fromObject($row);
			
			//check project id and user id found or not
			if(isset($data->project_id) && isset($data->user_id))
			{
				$result['success'] = 1;
					
				//task update message.
				$result['msg'] = JText::_('COM_NGTODO_UPDATED_PROJECT_SUCCESS');
			}
			
			/**
			 * check array of data user id and user id.
			 * 
			 * True : add task success message.
			 */ 
			elseif($data->user_id==$user->id)
			{
			
			$result['success'] = 1;
	
			//success message
			$result['msg'] = JText::_('COM_NGTODO_ADD_PROJECT_SUCCESS');
		    	    		    
		    }
		    
	   }
        
        //else catch exception - add task.	
		catch(Exception $error) {
			$result['success'] = 0;
	
			//error message
			$result['msg'] = JText::_('COM_NGTODO_ADD_PROJECT_FAILED');
		}
			
		//return array of $result_task.	
		return $result;
		
	}
	
	
	
	
	
	
	
}
