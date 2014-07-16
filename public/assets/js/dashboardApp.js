var dashboardApp = angular.module('dashboardApp', [], function($interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
	});


function AccuracyController() {
		this.Subjects = Subject;
		this.AccuracyStats = accuracystats;
}

function SubjectButtonController(){
		this.selection = 0;

		this.isSelected = function(checkSelection){
			return this.selection === checkSelection;
		};

		this.setSelection = function(activeSelection, shortSubjectName){
			this.selection = activeSelection;
			data = accuracystats[shortSubjectName];
			$plotdonut(data,shortSubjectName);
		};
}