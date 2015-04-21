<html ng-app="Tasker">
	<head>
		<%HTML::script("js/angular.js");%>
		<%HTML::style("css/bootstrap.css");%>
	</head>
	<body>
		<div id="tasks" class="container" ng-controller="TaskerController">
			<h3 class="page-header">
				Tasker - App (L4.2+AngularJs)
				<small ng-if="remaining()"> {{remaining()}} task/s are remaning!</small>
			</h3>
			Search :<input type="text" ng-model="searchText">
			Demn:<input type="checkbox" ng-model="query" ng-true-value="'demn'" ng-false-value="">
			<ul class="unstyled">
				 <li ng-repeat="task in tasks | filter:searchText | filter:query">
				 	 <input type="checkbox" ng-model="task.task_status">
				 	 {{task.task_name}} - {{task.created_at | date:'yyyy-MM-dd HH:mm:ss'}}
				 </li>
			</ul>

			<h3 class="page-header">Add task</h3>
			<form ng-submit="addNew()">
				<input type="text" name="task_name" ng-model="task_name">
				<input type="hidden" name="task_status" value="false" ng-model="task_status">
				<button type="submit" class="btn btn-primary"> Add new</button>
			</form>
		</div>
	</body>
	<script>
	var app = angular.module('Tasker', []);
	
	app.controller('TaskerController', function($scope, $http) {
    	$http.get("getTasks").success(function(tasks){
			$scope.tasks = tasks;
		});

		$scope.remaining = function(){
			var count = 0;
			angular.forEach($scope.tasks, function(task){
				count += task.task_status ? 0 : 1;
				//console.log(task.task_status);
				//console.log(count);
			});
			return count;
		}
		$scope.addNew = function(){
			$scope.formData = {
				task_name : $scope.task_name,
				task_status : false,
				created_at : new Date()
			}
			$scope.tasks.push($scope.formData);
			$scope.task_name = "";
			$http.post('tasks', $scope.formData);
		}
	});


	/*TaskerController($scope, $http){
		$http.get("getTasks").success(function(tasks){
			$scope.tasks = tasks;
		});

		$scope.remaining = function(){
			var count = 0;
			angular.forEach($scope.tasks, function(task){
				count += task.task_status ? 0 : 1;
			});
		}
	}*/
	</script>
</html>