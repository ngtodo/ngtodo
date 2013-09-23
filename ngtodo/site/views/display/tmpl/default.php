<!-- 
 * @package			Joomla.admin
 * @subpackage		NG Todo
 * @author			Kumar
 * @copyright		Weblogicx India Private Limited. All rights reserved.
 * @licence			GNU GPL V2 or later
-->

<?php
NGTodoHelpersHtml::loadNGFiles ( 'ngproject' );
NGTodoHelpersHtml::loadNGFiles ( 'ngtodo' );
NGTodoHelpersHtml::loadNGFiles ( 'scroll' );
?>

<!-- ngtodo div starts -->
<div class="ngtodo">

<!-- row-fluid div starts -->
<div class="row-fluid">

	   <!-- Project Controller div starts-->
		<div ng-controller="ProjectCtrl">
		
		 <!-- span4 div starts -->
		 <div class="span4">
		
		        <!-- success - task added message -->
				<div class="alert alert-msg" ng-show="msgShow">
					<h4 ng-model="message">{{message}}</h4>
				</div>
				
				<!--success - task update message -->
				<div class="alert alert-msg" ng-show="updateShows">
				     <h4 ng-model="message">{{message}}</h4>
				</div>
				
				<!--project text box empty message-->
				<div class="alert alert-block" ng-show="emptyText">
			   		<h4><?php echo JText::_('COM_NGTODO_ADD_PROJECT_INFO')?></h4>
   				</div>
		   
		        <!--project list empty means display info message  -->
		       <div class="alert alert-info" ng-show="infoProjects">
					<h4><?php echo JText::_('COM_NGTODO_INFO_FIRST_PROJECT_ADD')?></h4>
	    		</div>
		   		
		   		<!-- success - task deleted message -->
				<div class="alert alert-success" ng-show="deleteSuccess">
					 <h4><?php echo JText::_('COM_NGTODO_DELETE_PROJECT_SUCCESS')?></h4>
				</div>
		   		
		   		<!-- project name list - filter textbox -->
	      		<br><input type="text" name="input" ng-model="inputtext" placeholder="<?php echo JText::_('COM_NGTODO_FILTER_PROJECT_PLACEHOLDER')?>"><br>
	         
                <!--select options starts-->
	       		<?php  echo JText::_('COM_NGTODO_ORDERBY')?><br>
				<select ng-model="order">
					
					<!--Alphabetical order-->
					<option value="project_name"><?php echo JText::_('COM_NGTODO_ALPHABETICAL_ORDER')?></option>
					
					<!--Project name order-->
					<option value="project_id"><?php echo JText::_('COM_NGTODO_PROJECT_NAME_ORDER')?></option>
				
				</select><br><!--select options ends-->
				
				<!--project heading-->
		   		<h3><?php echo JText::_('COM_NGTODO_PROJECTS')?></h3>
				
				
		
		   		<!--list projects starts -->
		   		<ul class="unstyled">
					
		   			<li id="{{project.project_id}}" class="btn-group" ng-hide="project_show(project.state)" ng-repeat="project in projects | filter:inputtext | orderBy:order" ng-mouseover = "showDropdown = true" ng-mouseenter = "showDropdown = true" ng-mouseleave="showDropdown=false">
												
						<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
							
							<!-- edit task item -->			    	   	
							<li><a href="#" ng-click="editorenabled=!editorenabled"><?php echo JText::_('COM_NGTODO_DROPDOWN_EDIT_TASK')?></a></li>
							
							<!-- set state to delete task items -->
							<li><a href="#" ng-click="project_setState(project.project_id,project.state,$index)"><?php echo JText::_('COM_NGTODO_DROPDOWN_DELETE_TASK')?></a></li>
						
						</ul>
						
						
						 <!--dropdown span starts-->
					  <span class="dropdown-toggle" data-toggle="dropdown">
							
						<!-- dropdown icon -->
						<i ng-show="showDropdown" class="icon-chevron-down"></i>
						  
					</span><!--dropdown span ends-->
						
						
					<!-- save task statement starts - editorenabled-->
					<span ng-show="editorenabled">
					
						<!-- edit task textarea -->		        
						<textarea ng-model="project.project_name" class="text_areaProject"></textarea>
						
						<a href="" ng-click="editorenabled=!editorenabled"></a><br>
						
						<!-- save task button -->
						<input class="input_text btn btn-primary" type="submit" ng-click="saveProject_Name(project.project_id,project.project_name,editorenabled=!editorenabled)" value="Save">
				        			        
					</span><!-- save task statement ends -->	
						
						
					<!-- editorenabled div starts -->
					<div ng-hide="editorenabled">
					    
				      <span class="projectTitle project-title-{{project.project_id}}"  ng-click="fetch(project.project_id)">{{project.project_name}} 
					</span></a>
												
				    </div> <!-- editorenabled div ends -->
						
					    <!-- delete task name - state--> 
					    <a href="#" ng-show="projectDelete_State(project.project_id,project.project_name,project.state)"></a>	
					    
					 			    	
				</li>
         	</ul><!-- list projects ends -->	
         	
         	
         							
			    	
		   		<!-- add projects - form starts-->       
		   		<form ng-submit="addProject()">
			    	<input type="project_name" ng-model="projectText" size="30" placeholder="<?php echo JText::_('COM_NGTODO_ADD_PROJECT_PLACEHOLDER')?>">
			    	<br><br>
					<input class="btn btn-primary" type="submit" value="<?php echo JText::_('COM_NGTODO_ADD')?>"><br><br>
																	
		   		</form><!-- add projects - form ends--> 
		   		   		
	     </div><!-- span4 div ends -->
	        
	   
<!-- partial page div starts-->
<div class="span8" ng-hide="project">
    <?php echo $this->_StartView; ?>
</div> <!-- partial page div ends-->
  
  
<!-- span6 div starts - Todos controller -->
<div class="span5" ng-show="project">

        <!--ng-controller - TodoCtrl div starts  -->
		<div ng-controller="TodoCtrl">
	
				<!-- success - task added message -->
				<div class="alert alert-msg" ng-show="taskShow">
				     <h4 ng-model="message">{{message}}</h4>
				</div>
				
				<!--success - task update message -->
				<div class="alert alert-msg" ng-show="updateShow">
				     <h4 ng-model="message">{{message}}</h4>
				</div>
				
				<!--task textarea empty message-->
				<div class="alert alert-block" ng-show="emptyTexts">
			   	     <h4><?php echo JText::_('COM_NGTODO_ADD_TASK_INFO')?></h4>
   				</div>
				
				<!-- success - task deleted message -->
				<div class="alert alert-success" ng-show="deleteSuccess">
					 <h4><?php echo JText::_('COM_NGTODO_DELETED_TASK_SUCCESS')?></h4>
				</div>
		
		        <!-- success - task archive message -->
				<div class="alert alert-success" ng-show="archiveSuccess">
					 <h4><?php echo JText::_('COM_NGTODO_ARCHIVE_TASK_SUCCESS')?></h4>
				</div>
		
		        <!--task list empty means display info message  -->
		        <div class="alert alert-info" ng-show="taskList">
	    		     <h4><?php echo JText::_('COM_NGTODO_INFO_TASK_EMPTY')?></h4>
	    		</div>
	
	    		<!-- Task filter - text box -->
				<br><input type="text" name="input" ng-show="hideElements" ng-model="tasksearch" placeholder="<?php echo JText::_('COM_NGTODO_FILTER_TASK_PLACEHOLDER')?>"><br>
		
				<!-- tasks div starts-->
				<div ng-model="task_project_id" class="task_project_{{task_project_id}}">
		
				<!-- show project title -->
				<span class="lead , showprojectName" ng-hide="show_projectName=projectTitle(projects)" ng-bind="project_title"></span>
		
				<h3><?php echo JText::_('COM_NGTODO_TASKS');?></h3>
		
       	 		<span>{{recount=remaining(todos)}} of {{count=todoslength(todos)}} <?php echo JText::_('COM_NGTODO_TASK_REMAINING')?></span>
        
        		<!-- show task - addTask() method -->
				<a href="" id="submit" class="scrollbottom" ng-click="addTask()"><?php echo JText::_('COM_NGTODO_ADD_TASK')?></a> <br><br>
				
				
     			<!-- task list starts & dropdown & drag-drop statement-->		
				<ul class="ui-sortable , unstyled" id="sortTask" >
		            
		          <!--Task name list starts-->
		          <li id="{{todo.task_id}}" class="btn-group , ui-state-default" ng-hide="task_show(todo.state)" ng-repeat="todo in todos | filter:tasksearch" ng-mouseover = "showDropdown = true" ng-mouseenter = "showDropdown = true" ng-mouseleave="showDropdown=false">
		             
						  <ul id="taskDropdown" class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
							
							<!-- addTask method -->
							<li><a href="#" ng-click="addTask()"><?php echo JText::_('COM_NGTODO_DROPDOWN_ADD_TASK')?></a></li>
							
							<!-- archive method -->
							<li><a href="#" ng-click="archive(todo.task_id,todo.state,$index)"><?php echo JText::_('COM_NGTODO_DROPDOWN_ARCHIVE')?></a></li>
							
							<!-- edit task item -->			    	   	
							<li><a href="#" ng-click="editorenabled=!editorenabled"><?php echo JText::_('COM_NGTODO_DROPDOWN_EDIT_TASK')?></a></li>
							
							<!-- set state to delete task items -->
							<li><a href="#" ng-click="setState_Delete(todo.task_id,todo.state,$index)"><?php echo JText::_('COM_NGTODO_DROPDOWN_DELETE_TASK')?></a></li>
						
						  </ul>
			        
					<!--dropdown span starts-->
					<span class="dropdown-toggle" data-toggle="dropdown">
							
						<!-- dropdown icon -->
						<i ng-show="showDropdown" class="icon-chevron-down"></i>
						  
					</span><!--dropdown span ends-->
			 	 
			 	   	<!-- save task statement starts - editorenabled-->
					<span ng-show="editorenabled">
					
						<!-- edit task textarea -->		        
						<textarea ng-model="todo.task_name" class="text_area"></textarea>
						
						<a href="" ng-click="editorenabled=!editorenabled"></a><br>
						
						<!-- save task button -->
						<input class="input_text btn btn-primary" type="submit" ng-click="saveTask_Name(todo.task_id,todo.task_name,editorenabled=!editorenabled) " value="Save">
				   
					</span><!-- save task statement ends -->
			    
					<!-- editorenabled div starts -->
					<div ng-hide="editorenabled">
					
						<!--dropdown icon-->
						<i class="icon-list" ng-show="showDropdown"></i>
						
						<!-- checkbox statement -->
						<input type="checkbox" ng-model="todo.done">
						
						<!-- display task name span starts-->
						<span class="tasknameStyle done-{{todo.done}}" >
							{{todo.task_name}}
						</span><!--display task name span ends-->
						
						<!-- display due date span starts-->
						<span class="dateStyle">
						{{todo.due_date | date : 'MMM d, y'}} 
						</span><!--display due date span ends-->
						
					</div> <!-- editorenabled div ends -->
			   
					<!-- delete task name - state--> 
					<a href="#" ng-show="tempDelete_State(todo.task_id,todo.task_name,todo.state)"></a>
			  
			  </li><!--Task name list ends-->
			  
		    </ul><!-- unorder list ends -->
				
			    
		<!-- add todos form starts-->
		<form ng-submit="addTodo()"><br><br>
		
				<!-- Text area -->
				<textarea id="text_areabox" type="task_name" ng-model="todoText" class="text_box" 
				  name="task" placeholder="<?php echo JText::_('COM_NGTODO_ADD_TASK_PLACEHOLDER')?>" 
				  tabindex="1" autocomplete="off" ng-show="hideElement" >
				</textarea><br>
				
				<!-- add task - submit button -->
				<input class="input_text btn btn-primary" type="submit" value="<?php echo JText::_('COM_NGTODO_ADD'); ?>" ng-show="hideElement">
					
				<!-- cancel task -->
				<a  class="cancel" href="" ng-click="cancelTask()" ng-show="hideElement"><?php echo JText::_('COM_NGTODO_CANCEL_TASK')?></a>
			    
				<!--Calender div starts-->		
				<div class="control-group input-append">
			    
			    	<!-- datepicker statements -->
					<input id="inputDatepicker" class="input-small" type="text_date" bs-datepicker="" data-date-format="dd/mm/yyyy" ng-model="datepicker.date" ng-show="hideElement">
		
					<!--button - datepicker-->
					<button class="btn" data-toggle="datepicker" type="button" ng-show="hideElement"><i class="icon-calendar"></i></button>
	    		
	    		</div><!-- calender div ends -->
	   
	    </form><!-- add todos form ends-->
		
	     <!-- error container -->
	     <div class="error" ng-model="errorContainer">{{errorTask}}</div>
	    
	    </div><!-- tasks div ends-->
     
      </div><!-- ng-controllers - TodoCtrl div ends -->
	 
	 </div><!-- span6 div ends - todos controllers -->
	
	</div><!-- Project Controller div ends-->
   
   </div><!-- row fluid div ends -->
   
</div><!-- ngtodo div ends -->
