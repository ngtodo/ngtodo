/*
* @package			Joomla.site
* @subpackage		NG Todo
* @author			Kumar
* @copyright		Weblogicx India Private Limited. All rights reserved.
* @licence			GNU GPL V2 or later
*/

var app = angular.module('angularjs-starter', ['$strap.directives']);

app.controller('MainCtrl', function($scope, $window, $location) {
	$scope.singleselect=[
	                     {values:'1', name:'<i class="icon-star"></i>Edit'},
	                     {values:'2', name:'<i class="icon-heart"></i>Delete'}
	                     ];
	      });
