/*
 * @package			Joomla.site
 * @subpackage		NG Todo
 * @author			Kumar
 * @copyright		Weblogicx India Private Limited. All rights reserved.
 * @licence			GNU GPL V2 or later
*/

//namespace NGTodo.
var myapp = angular.module('NGTodo',[],function($locationProvider)
{
	 /*
	  * Use the $locationProvider to configure how the application deep linking paths are stored.
	  * 
	  * html5Mode(mode): {boolean}
	  * 
      * true - see HTML5 mode
      * 
      * false - see Hashbang mode
      * 
      * default: false
      * 
	  */ 
	 $locationProvider.html5Mode(true);
});

//run rootscope.
myapp.run(function($rootScope) {
    
    /*
        Receive emitted message and broadcast it.
        Event names must be distinct or browser will blow up!
    */
    $rootScope.$on('handleEmit', function(event, args) {
        $rootScope.$broadcast('handleBroadcast', args);
    });
        
});

//project controller.
myapp.controller('ProjectCtrl',function($scope, $http, $cookieStore, $templateCache, $location) {
	
	//initialize message.
	$scope.message = '';
	
	//initialize array of projects.
	$scope.projects = [];
	
	// do an ajax request to load the todo list
	$http({
		method : 'GET',
		url : 'index.php?option=com_ngtodo&controller=ajax&view=projects'
	}).success(function(data, status, headers, config) {	
			
			if(data.redirect) {
				/*
				 * The window.location object can be used to get the current page address (URL) and to redirect the browser to a new page.
				 */ 
				window.location = data.redirect;
			}
			else if(data.msg) {
				
				//get message from array of data.
				$scope.message = data.msg;
				
			} else  {
				
				//get projects from array of data.
				$scope.projects = data;
			}
			
			//array of data length.		
			if(data.length==0 )
			{
				//display infoprojects message.
				$scope.infoProjects=true;
			}
														 
		 // this callback will be called asynchronously
		// when the response is available
	}).error(function(data, status, headers, config) {
	     // called asynchronously if an error occurs
		// or server returns response with an error status.
	});
	
	
//add projects statements
$scope.addProject = function() {
		
		//project textbox empty or not.
		if(!$scope.projectText=="")
		{
		
		//post method request.		    
	    $http({
			method : 'POST',
			url : 'index.php?option=com_ngtodo&controller=add&view=projects',			
			data: {project_name: $scope.projectText},				
		 	/*
	         * Content type json format.
	         * 
	         * JSON - Java Script Object Notation.
	         */
		 	headers: {'Content-Type': 'application/json'}
		}).success(function(data, status, headers, config) {		
			
			//get message from array of data.
			$scope.message = data.msg;
			
			//console.log(data);
			
			//data success.
			if(data.success)
			{
				//push project name from array of data.
				$scope.projects.push({project_id: data.data.project_id, project_name: data.data.project_name, state:data.data.state});
				
				//message display
				$scope.msgShow = true;
				
				//project list empty or not message
				$scope.infoProjects=false;
				
				//successfully project add message
				angular.element('.alert-msg').addClass('alert-success');
				
				//project textbox clear.
				$scope.projectText = '';
		    } 
		    else
		    {   //else error message.
				angular.element('.alert-msg').addClass('alert-error');
			}
			
				//set timeout
				setTimeout(function () {
				
				$scope.$apply(function () {
					
					//successfully project add message hide.
					$scope.msgShow = false;
														
				});
				
				}, 4000);
			
			 // this callback will be called asynchronously
			// when the response is available
		    }).error(function(data, status, headers, config) {
			
			//get message from array of data.
			$scope.message = data.msg;
			
			//error message.
			angular.element('.alert-msg').addClass('alert-error');
			
			// called asynchronously if an error occurs
			// or server returns response with an error status.
		});
		}
		else
		{   //project textbox empty means - message display.
			 //set timeout messages
	            setTimeout(function () {
				
			    $scope.$apply(function () {
			    	
			    	 //task textbox empty or not - info message hide
			    	 $scope.emptyText=false;
			    	
					
			    });
			    
			    }, 3000);
	         //task textbox empty or not - info message display
	    	 $scope.emptyText=true;
			//$scope.emptyText=true;
		}
	
};


//save projects statements
$scope.saveProject_Name = function(project_id,project_name) {
     
          	  
        	
        	//post request method
            $http({
    			method:'POST',
    			url : 'index.php?option=com_ngtodo&controller=add&view=projects',		
    			data:{project_name:project_name,project_id:project_id},
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
	                 //display the project update message.			    
  					 $scope.updateShows = true;
			    
			         //alert-success class add to alert-msg.
			         angular.element('.alert-msg').addClass('alert-success');
					
    				 //display the task update message.
    				//$scope.updateSuccess=true;
    			}
	    	
    			}).error(function(data, status, headers, config) {
    		     // called asynchronously if an error occurs
    			// or server returns response with an error status.
    		});
            setTimeout(function () {
    			
    		    $scope.$apply(function () {
    		    	
    		     	//timeout the project update message.
    		    	$scope.updateShows=false;
    		    	 		    	    				
    		    });
    		    
    		    }, 4000);
};


//set state - delete project name statement
$scope.project_setState=function(project_id,state,index) {
    	  
        //set project state 
        $scope.state =-1;
       
       if(confirm("Are you sure to Delete the project?"))
       {
        $http({
       		
				//post request method 
				method:'POST',
				url : 'index.php?option=com_ngtodo&controller=add&view=projects',		
				
				//task id and task state
				data:{project_id: project_id, state: $scope.state},
				/*
				 * Content type json format.
				 * 
				 * JSON - Java Script Object Notation.
				 */
				headers: {'Content-Type': 'application/json'}
   		
   		}).success(function(data, status, headers, config) {	
	         
	                   
	           //hide projects   			
   			   $scope.projects.splice(index,1);
   		       
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
		    }, 4000);
};


//delete and archive tasks - states statements
$scope.projectDelete_State=function(project_id,project_name,state) {
		
		  //initialize temporary variable t_state.			
		  var t_state=state;
		  
		  var project_id=0;
		  
		  switch(t_state){
		
		//delete state.
		case '-1':
		
		        //task name list state.
			    $scope.project_show=function(state) {
			
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



//fetch statements
$scope.fetch = function(project_id) {
		
		//post request method.
		$http({
			method : 'POST',
			url : 'index.php?option=com_ngtodo&controller=ajax&view=tasks',		
			data: {project_id: project_id},		
		 	/*
	         * Content type json format.
	         * 
	         * JSON - Java Script Object Notation.
	         */
		 	headers: {'Content-Type': 'application/json'}
		}).success(function(data, status, headers, config) {
			
			$scope.$emit('handleEmit', {project_id: project_id, ptasks:data});
			
			$cookieStore.put('project_id', project_id , 'true');
										
		}).error(function(data, status, headers, config) {
		     // called asynchronously if an error occurs
			// or server returns response with an error status.
		});
		
		//display the partial page.
	  $scope.project=true;
	};
	
	//orderBy alphabetical or project name order statement
	$scope.order='project_id';
	
});
