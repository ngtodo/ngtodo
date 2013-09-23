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

//import date utilities
Jimport('joomla.utilities.date');

//Get the document.
$document = JFactory::getDocument();

/**
  * order to load jquery.
  * 
  * jQuery version 1.8.1 library in no conflict mode.
  * 
  * order to load jquery.ui
  * 
  * order to load bootstrap.framework
  */
JHtml::_('jquery.framework');
JHtml::_('jquery.ui', array('core', 'sortable'));
JHtml::_('bootstrap.framework');


 /**
  * 
  * Returns the root URI for the request.
  *
  * @Param  boolean $pathonly If false, prepend the scheme, host and port information. Default is false.
  *               
  */
				
//stylesheet file
$document->addStyleSheet(JUri::root(true).'/media/ngtodo/css/ngtodo.css');
		
//js files

//angularjs file.
$document->addScript(JUri::root(true).'/media/ngtodo/js/angular.js');

//angularjs.cookies file
$document->addScript(JUri::root(true).'/media/ngtodo/js/angularjs.cookies.js');

//ngboot file.
$document->addScript(JUri::root(true).'/media/ngtodo/js/ngboot.js');

//angular-strap file.
$document->addScript(Juri::root(true).'/media/ngtodo/js/angular-strap.js');

//bootstrap-datepicker file.
$document->addScript(Juri::root(true).'/media/ngtodo/js/bootstrap-datepicker.js');

//custom calender file.
$document->addScript(Juri::root(true).'/media/ngtodo/js/calender.js');

//load classes
JLoader::registerPrefix('NGTodo', JPATH_COMPONENT);


//load tables
JTable::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR.'/tables');

//Load plugins
JPluginHelper::importPlugin('ngtodo');

//application
$app = JFactory::getApplication();

// Require specific controller if requested
$controller = $app->input->get('controller','display');

// Create the controller
$classname = 'NGTodoControllers'.ucwords($controller);
$controller = new $classname();

// Perform the Request task.
$controller->execute();
