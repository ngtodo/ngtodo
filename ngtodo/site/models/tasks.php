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
 * Define NGTodoModelsTasks class.
 * 
 * Base class -  NGTodoModelsDefault.
 */
class NGTodoModelsTasks extends NGTodoModelsDefault {

	/**
	 * @var task_id initialize.
	 */
	protected $_task_id = null;
	
	/**
	 * @var project_id initialize.
	 */ 
	protected $_project_id = null;
	
	/**
	 * Method to store a row in the database from the JTable instance properties.
	 *
	 * @param $data.
	 *
	 * @return $result_task.
	 * 
	 * @link  http://docs.joomla.org/JTable/store
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
		$result_task = array();
	
		try {
	
			$row = parent::store($data);
			
			//convert to array
			$result_task['data'] = JArrayHelper::fromObject($row);
			
			if(isset($data->task_id) && isset($data->user_id))
			{
				$result_task['success'] = 1;
					
				//task update message.
				$result_task['msg'] = JText::_('COM_NGTODO_UPDATED_TASK_SUCCESS');
			}
			
			/**
			 * check array of data user id and user id.
			 * 
			 * True : add task success message.
			 */ 
			elseif($data->user_id==$user->id)
			{
			
			$result_task['success'] = 1;
	
			//success message
			$result_task['msg'] = JText::_('COM_NGTODO_ADD_TASK_SUCCESS');
		    	    		    
		    }
	   }
        
        //else catch exception - add task.	
		catch(Exception $error) {
			$result_task['success'] = 0;
	
			//error message
			$result_task['msg'] = JText::_('COM_NGTODO_ADD_TASK_FAILED');
		}
			
		//return array of $result_task.	
		return $result_task;
		
	}
	
	/**
	 * __construct() refer the JModelBase class
	 *
	 * public function __construct(JRegistry $state = null)
	 *
	 */
    function __construct()
	{
		/**
         * Get the application.
         */
		$app = JFactory::getApplication();
		
		/**
		 * Get task_id.
		 */
		$this->_task_id = $app->input->get('id', null);

        /**
		 * Joomla! Input JSON Class.
		 *
		 * This class decodes a JSON string from the raw request data and makes it available via
		 * the standard JInput interface.
		 */
        $input = new JInputJSON();
        
        /**
		 * Gets the raw JSON string from the request.
		 *
		 * @return  string  The raw JSON string from the request.
		 *
		 */
		$json = json_decode($input->getRaw());
		
		/**
		 * check project_id found in json or not
		 */ 
		if(isset($json->project_id)) {
			$this->_project_id = $json->project_id;
		}
        parent::__construct();
	}

	/**
	 * Method for building query object.
	 * 
	 * @return query object joomla default query object.
	 */
	protected function _buildQuery()
	{
		/**
		 * Get a database object.
	     *
	     * abstract class JFactory.
	     * 
	     * Returns the global JDatabaseDriver object, 
	     * 
	     * only creating it if it doesn't already exist.
		 */
		$db = JFactory::getDBO();
		$query = $db->getQuery(TRUE);

		$query->select('t.*');
		$query->from('#__ngtodo_tasks as t');
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
		
		/**
		 * check _task_id numeric or not.
		 */
        if(is_numeric($this->_task_id))
		{
			$query->where('t.task_id = ' . (int) $this->_task_id);
		}
		
		if($user->id)
		{
			//check tasks table user_id.
			$query->where('t.user_id='.$user->id);
		}

		$query->where('t.project_id = ' . (int) $this->_project_id);
		//$query->where('t.user_id ='.$user_id);
		
		/**
		 * return query object.
		 */ 
		return $query;
	}
	
	/**
	 * Ascending order ordering column.
	 * 
	 * @see NGTodoModelsDefault::_buildOrder().
	 *
	 * @param object query object.
	 * 
	 * @return object query object.
	 */
	protected function _buildOrder($query)
	{
		$query->order('t.ordering ASC');
        return $query;
	}
		
}
