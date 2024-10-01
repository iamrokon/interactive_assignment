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

    <!-- Experience Start -->

    <div class="jumbotron text-center my_jumbotron">
    <h2>Experiences</h2>
    </div>

    @foreach ($experiences as $experience)
        @php
        if ($loop->index == 3) {
            break;
        }
        @endphp
    <div class="row take_middle">
        <div class="col-md-4  @php
            if($loop->index == 0){
                echo 'inner_left a';
            }elseif ($loop->index == 1) {
                echo 'inner_right b';
            }elseif ($loop->index == 2) {
                echo 'inner_left c';
            }elseif ($loop->index == 3) {
                echo 'inner_right d';
            }
            @endphp">
        <h3>{{ $experience['title'] }}</h3>
        <p>{{ $experience['area'] }}</p>
        <p>{{ $experience['year'] }}</p>
        <p>{{ $experience['technology'] }}</p>
        </div>
    </div>
    @endforeach

    <!-- Experience End -->


</div>

</body>
</html>
