/*
* @package			Joomla.site
* @subpackage		NG Todo
* @author			Kumar
* @copyright		Weblogicx India Private Limited. All rights reserved.
* @licence			GNU GPL V2 or later
*/

window.onload = function() {
	var $rootElement = angular.element(window.document);
	var modules = [ 'ng',
	                'ngCookies',
	                'NGTodo',
	                '$strap',
	                'angularjs-starter',
	               
	                function($provide) {
		$provide.value('$rootElement', $rootElement);
	} ];

	var $injector = angular.injector(modules);
	var $compile = $injector.get('$compile');
	var compositeLinkFn = $compile($rootElement);
	var $rootScope = $injector.get('$rootScope');
	compositeLinkFn($rootScope);
	$rootScope.$apply();
};
