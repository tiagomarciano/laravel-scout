<!DOCTYPE html>
<html>
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
    <div class="container">
        <h1>Courses</h1>

        <form action="/" method="get">
            Search: <input type="text" name="str" value="{{$str}}" id="search-input">
            {{--<input type="submit" class="btn btn-primary" value="Ok">--}}
        </form>

        @foreach($courses as $course)
            <div class="col-md-3" style="border:1px solid #ccc; margin: 10px; min-height: 275px;">
                <h3>{{$course->name}}</h3>
                <p>{{$course->description}}<br><br> By {{$course->author}}</p>
            </div>
        @endforeach
    </div>

    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script>
        var client = algoliasearch("CLNIHPCXAM", "9b3ee790a467cfa272c256ce3686341c")
        var index = client.initIndex('courses');
        autocomplete('#search-input', {hint: false}, [
            {
                source: autocomplete.sources.hits(index, {hitsPerPage: 5}),
                displayKey: 'name',
                templates: {
                    suggestion: function(suggestion) {
                        return suggestion._highlightResult.name.value;
                    }
                }
            }
        ]).on('autocomplete:selected', function(event, suggestion, dataset) {
            console.log(suggestion, dataset);
        });
    </script>
</body>
</html>