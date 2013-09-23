/*
 * @package			Joomla.site
 * @subpackage		NG Todo
 * @author			Kumar
 * @copyright		Weblogicx India Private Limited. All rights reserved.
 * @licence			GNU GPL V2 or later
*/

//Todo Controller statements.
myapp.controller('TodoCtrl',function ($scope, $http, $cookieStore, $element , $templateCache, $anchorScroll, $location , $route, $rootScope) {
	
	 //get project_id.
	 var project_id = $cookieStore.get('project_id');
	 
	 $scope.task_project_id = project_id;
	
	 //broadcast data args
	 $scope.$on('handleBroadcast', function(event, args) {
		
		//Get todos array from args.
		$scope.todos= args.ptasks;
		
		//Get project id from args.
		project_id = args.project_id;		
		
		$scope.task_project_id = project_id;
		
		//Get task_id from args.
		task_id = args.task_id;
    
    });
	
	
//datepicker statement
$scope.datepicker={date: new Date()};
	
//Add todo task
$scope.addTodo = function() {
	
	     //if condition - todotext empty or not statments
		if(!$scope.todoText=="") {
		
		//get project id from cookiestore.
    	var project_id = $cookieStore.get('project_id');
							
	  	//initialize state.
		var state = 1;
					
		$http({
			
			//post request method.
			method : 'POST',
			url : 'index.php?option=com_ngtodo&controller=add&view=tasks',			
	        data:{task_name: $scope.todoText, state: state, due_date:$scope.datepicker.date, project_id:project_id},
						
			/*
	         * Content type json format.
	         * 
	         * JSON - Java Script Object Notation.
	         */
			headers: {'Content-Type': 'application/json'}
	        
		    }).success(function(data, status, headers, config) {	
			
			//console.log(data);
			
			//check data success.
			if(data.success)
			{
				if(data.msg) {
                    
                    //get message from array of data.					
					$scope.message = data.msg;
				}
				//display successfully task added message	
			    $scope.taskShow = true;
			    
			    //add class alert-success.
			    angular.element('.alert-msg').addClass('alert-success');
			    
			    //push task name and state and due date.	
			    $scope.todos.push({task_name:data.data.task_name, state:data.data.state, due_date:data.data.due_date});
		    }
									
		}).error(function(data, status, headers, config) {
			//called asynchronously if an error occurs
			//or server returns response with an error status.
		});
		
			//set timeout messages
            setTimeout(function () {
			
		    $scope.$apply(function () {
		    	
		    	//successfully project added message
				$scope.taskShow=false;
		    });
		    
		    }, 3000);
         
         //task textarea clear
         $scope.todoText='';
       }
   
		
		else {
			
			  //set timeout messages
	          setTimeout(function () {
				
			  $scope.$apply(function () {
			    	
			     //task textbox empty or not - info message hide
			     $scope.emptyTexts=false;
			    					
			    });
			    
			    }, 3000);
	           //task textbox empty or not - info message display
	    	  $scope.emptyTexts=true;
					 
	    	 }
	    	 
	    	  
};
    	 
	   
//addTask - click
$scope.addTask = function() {
	   
	   /*
	    * filter text and button and task textarea display.
	    */         
   	    $scope.hideElement=true;
   	    $scope.addtask=true;
};
	   
	    
//cancel task - click
$scope.cancelTask = function() {
	
	   /*
	    * load - filter text and button and task textarea hide.
	    */      	
   	    $scope.hideElement=false;
   	    $anchorScroll();
};
               
//set state - delete task name statement
$scope.setState_Delete=function(task_id,state,index) {
    	  
        //set task state 
        $scope.state =-1;
        
        if(confirm("Are you sure to Delete the Task?"))
        {
        $http({
       		
				//post request method  
				method:'POST',
				url : 'index.php?option=com_ngtodo&controller=add&view=tasks',		
				
				//task id and task state
				data:{task_id: task_id, state: $scope.state},
				/*
				 * Content type json format.
				 * 
				 * JSON - Java Script Object Notation.
				 */
				headers: {'Content-Type': 'application/json'}
   		
   		}).success(function(data, status, headers, config) {	
	         
	           console.log(data);
	         
	           //hide tasks   			
   			   $scope.todos.splice(index,1);
   		       
   			   //check data success or not
   			   if(data.success)
   				{
   				//display the delete success message
   				$scope.deleteSuccess=true;
   				  			   				
   				}
   			 
   		  }).error(function(data, status, headers, config) {
   			// called asynchronously if an error occurs
   			// or server returns response with an error status.
   		  });
   		 }
   		     	  
       	  //set timeout messages
          setTimeout(function () {
			
		    $scope.$apply(function () {
		    	
		    	//successfully project added message
		    	$scope.deleteSuccess=false;
		    });
		    }, 3000);
};
       
       
//delete and archive tasks - states statements
$scope.tempDelete_State=function(task_id,task_name,state) {
		
		  //initialize temporary variable t_state.			
		  var t_state=state;
		  
		  var project_id=0;
		  
		  switch(t_state){
		
		  //archive state.
		  case '-2':
		    
		           //task name list state.
		           $scope.task_show=function(state) {
			
			       //check taskname state.
			      if(t_state==state) {
				
				  //archive task name.
				  return true;
				
			      }
			 };
			break;
		
		//delete state.
		case '-1':
		
		        //task name list state.
			    $scope.task_show=function(state) {
			
			    //check taskname state.
				if(t_state==state) {
				
				//delete task name.	
				return true;
				}
			};
			break;
			
			
		default:
			break;
		}	
 return true;
};
		
		
//save task statements
$scope.saveTask_Name=function(task_id,task_name) {
        	
        	
        	//post request method
            $http({
    			method:'POST',
    			url : 'index.php?option=com_ngtodo&controller=add&view=tasks',		
    			data:{task_name:task_name,task_id:task_id},
    			/*
    	         * Content type json format.
    	         * 
    	         * JSON - Java Script Object Notation.
    	         */
    			headers: {'Content-Type': 'application/json'}
    		}).success(function(data, status, headers, config) {	
    			
    			   			
    			//check data success or not
    			if(data.success)
    			{   
					if(data.msg) {
					
					//get message from array of data.
					$scope.message = data.msg;
					
					
				    }
	                 //display the task update message.			    
  					 
			         $scope.updateShow = true;
			         //alert-success class add to alert-msg.
			         angular.element('.alert-msg').addClass('alert-success');
				}
    			
    			
			
	    	
    			}).error(function(data, status, headers, config) {
    		     // called asynchronously if an error occurs
    			// or server returns response with an error status.
    		});
            setTimeout(function () {
    			
    		    $scope.$apply(function () {
    		    	
    		     	//timeout the task update message.
    		    	$scope.updateShow=false;
    		    	 		    	    				
    		    });
    		    
    		    }, 3000);
        	
};
		

//remainging statements  
$scope.remaining = function(todos) {
		
		   //initialize count variable.
		   var count = 0;
		
		   //initialize newstate variable.
		   var newstate=1;
		
		   //get single item from array of todos.
		   angular.forEach($scope.todos, function(todo) {
			   
			   //check todo state.
			   if(newstate==todo.state) {
				 
				 //count increment - checkbox true or else.
				 count+=todo.done ? 0:1;
			   }
			});
			
			//return count values.
			return count;
};
	
	
//todos length statements
$scope.todoslength = function(todos) {
		
		  //initialize newstate variable
		  var newstate=1;
		
		  //initialize count variable
		  var count=0;
		
		  //forEach statment
		  angular.forEach($scope.todos, function(todo) {
			
			//check task state     
			if(newstate==todo.state) {
			    //increment count values.	   
				count++;
			    	 }
		});   
		
		//check count value. 
		if(count>0)
		   {
	    	
	    	//information about projects empty or not message hide
			$scope.taskList=false;
			$scope.hideElements=true;
			//return count values.
			return count;
		   }
		else
			{
			//information about projects empty or not message show
			$scope.taskList=true;
			$scope.hideElements=false;
			
			//archive message false.
			$scope.archiveSuccess=false;
			
			//delete message false.
			$scope.deleteSuccess=false;
			
			//return count values.
			return count;
			}
};
	

//show project title - task_name list side
$scope.projectTitle=function(projects){
   		
   		  //forEach statement
		  angular.forEach($scope.projects, function(project) {			
        
		     //check project id.	
   		     if(project.project_id==project_id) {
   			  //get project name.
   			  $scope.project_title=project.project_name;
   			  
   			  
   			}
   		 });
};
	
	
//archive statements
$scope.archive = function(task_id,state,index) {
		
	
	      //set task archive state	 
	      $scope.state =-2;
	
          //post request method
	      $http({
			method:'POST',
			url : 'index.php?option=com_ngtodo&controller=add&view=tasks',			
			data:{task_id: task_id, state: $scope.state},
			
			/*
	         * Content type json format.
	         * 
	         * JSON - Java Script Object Notation.
	         */
			headers: {'Content-Type': 'application/json'}
		  }).success(function(data, status, headers, config) {	
         	
			//hide task name based on index value.
			$scope.todos.splice(index,1);
			 
			//check data success or not
			 if(data.success)
				{
				$scope.archiveSuccess=true;
				//$scope.deleteSuccess=true;
				}
		  }).error(function(data, status, headers, config) {
			// called asynchronously if an error occurs
			// or server returns response with an error status.
		});
	  
	  //set timeout
	  setTimeout(function () {
			
		    $scope.$apply(function () {
		    	
		     	//update task success message show
		    	$scope.archiveSuccess=false;
		    			    	 		    	    				
		    });
		    
		    }, 3000);
};
	

//reordering task_name list use jquery
angular.element(function(){
		
 		  //id sortTask
 		  angular.element("#sortTask").sortable ({
 			
			opacity:.5,
			revert:true,
			handle:".icon-list",
			start:function(event,ui){
				var start_pos=ui.item.index();
				ui.item.data('start_pos',start_pos);
			},
			
			update:function(event,ui) {
				
				//get current task index value
				var index=ui.item.index();
							
				var end_pos = ui.item.index();
				
				var task_id=ui.item.attr("id");
				
			    //post request method
				$http({
	     			method:'POST',
	     			url : 'index.php?option=com_ngtodo&controller=add&view=tasks',		
	     			data: {ordering:end_pos,project_id:project_id,task_id:task_id},
	     			
	     			/*
	    	         * Content type json format.
	    	         * 
	    	         * JSON - Java Script Object Notation.
	    	         */
	     			headers: {'Content-Type': 'application/json'}
	     		    }).success(function(data, status, headers, config){						     			
	     		    
					}).error(function(data, status, headers, config) {
						// called asynchronously if an error occurs
						// or server returns response with an error status.
					});
			  }
		});
		
});


});//Todo Controller statement end.


