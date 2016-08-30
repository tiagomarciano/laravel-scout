<!DOCTYPE html>
<html ng-app="AlgoliaApp">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Courses</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <style>
        .algolia-autocomplete {
            width: 100%;
        }
        .algolia-autocomplete .aa-input, .algolia-autocomplete .aa-hint {
            width: 100%;
            min-height: 30px;
            text-indent: 10px;
        }
        .algolia-autocomplete .aa-hint {
            color: #999;
        }
        .algolia-autocomplete .aa-dropdown-menu {
            width: 100%;
            background-color: #fff;
            border: 1px solid #999;
            border-top: none;
        }
        .algolia-autocomplete .aa-dropdown-menu .aa-suggestion {
            cursor: pointer;
            padding: 5px 4px;
        }
        .algolia-autocomplete .aa-dropdown-menu .aa-suggestion.aa-cursor {
            background-color: #B2D7FF;
        }
        .algolia-autocomplete .aa-dropdown-menu .aa-suggestion em {
            font-weight: bold;
            font-style: normal;
        }
    </style>
</head>
<body>
    <div class="container" ng-controller="CourseCtrl">
        <h1>Courses</h1>

        <form action="/" method="get">
            Search:<br><input autocomplete="off" type="text" class="form-control" spellcheck="false" ng-keyup="search()" ng-model="query">
        </form>

        <div class="hit" ng-repeat="hit in hits">
            <div class="col-md-3" style="border:1px solid #ccc; margin: 10px; min-height: 275px;">
                <h3 ng-bind-html="hit._highlightResult.name.value"></h3>
                <p ng-bind-html="hit._highlightResult.description.value"></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-sanitize/1.5.8/angular-sanitize.min.js"></script>
    <script>
        angular.module('AlgoliaApp', ['ngSanitize'])
            .factory('Courses', function(){
                var client = algoliasearch("CLNIHPCXAM", "9b3ee790a467cfa272c256ce3686341c")
                var index = client.initIndex('courses');
                return index;
            })
            .controller('CourseCtrl', function($scope, Courses){
                $scope.hits = [];
                $scope.query = '';
                $scope.initRun = true;
                $scope.search = function(){
                    Courses.search($scope.query, function(success, content){
                        $scope.hits = content.hits;
                    });
                };
                $scope.search()
            });

    </script>
</body>
</html>