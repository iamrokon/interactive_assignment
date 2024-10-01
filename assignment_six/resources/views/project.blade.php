<!DOCTYPE html>
<html lang="en">
<head>
  <title>I am Rokon</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
	<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>

	<script src="{{ asset('js/popper.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" >
</head>
<body>


<div>
	<nav id="back" class="navbar navbar-inverse">
	  <div class="container-fluid">
		<div class="navbar-header">
		  <a class="navbar-brand" href="#">iamrokon</a>
		</div>
		<ul class="nav navbar-nav">
		  <li class="active"><a href="{{ route('home') }}">Home</a></li>
		  <li><a id="rok" href="{{ route('experiences') }}">Work experiences</a></li>
		  <li><a id="rok" href="{{ route('projects') }}">Projects</a></li>
		</ul>
	  </div>
	</nav>
</div>



<div class="container">
    <!-- Portfolio Start -->

    <div class="jumbotron text-center my_jumbotron">
    <h2>PORTFOLIO</h2>
    <p>My Latest Works:</p>
    </div>

    <div class = "row">
        @foreach ($works as $work)

    <a href="{{ url('project-detail/'.$work['id']) }}">
        <div class = "col-sm-6 col-md-4">
            <div class = "thumbnail">
                <img src = "{{ asset('images/'.$work['img']) }}" alt = "Generic placeholder thumbnail">
            </div>

            <div class = "caption">
                <h3>{{ $work['title'] }}</h3>
                <p>{{ Str::limit($work['description'], 100, "...") }}</p>
            </div>
        </div>
    </a>
    @endforeach

    </div>

    <!-- Portfolio End -->
</div>

</body>
</html>
