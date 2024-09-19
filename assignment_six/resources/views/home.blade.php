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
		  <li class="active"><a href="#">Home</a></li>
		  <li><a id="rok" href="#">Professional</a></li>
		  <li><a id="rok" href="#">Experience</a></li>
		  <li><a id="rok" href="#">Contact</a></li>
		</ul>
	  </div>
	</nav>
</div>

<!--Slider-->



<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    @foreach ($sliders as $slider)
    <div class="item @php if($loop->index == 0){ echo 'active'; } @endphp">
      <img src="{{ asset('images/'.$slider['img']) }}" alt="Chania" width="100%" height="100%">
      <div class="carousel-caption">
        <h3></h3>
        <p></p>
      </div>
    </div>
    @endforeach

  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>



<!--Slider End-->



<div class="container">

<!-- Portfolio Start -->

<div class="jumbotron text-center my_jumbotron">
  <h2>PORTFOLIO</h2>
  <p>My Latest Works:</p>
</div>

<div class = "row">
    @foreach ($works as $work)
   <div class = "col-sm-6 col-md-4">
      <div class = "thumbnail">
         <img src = "{{ asset('images/'.$work['img']) }}" alt = "Generic placeholder thumbnail">
      </div>

      <div class = "caption">
         <h3>{{ $work['title'] }}</h3>
         <p>{{ $work['description'] }}</p>
      </div>
   </div>
   @endforeach

</div>

<!-- Portfolio End -->


<!-- Experience & Education Start -->

 <div class="jumbotron text-center my_jumbotron">
  <h2>Experience & Education</h2>
</div>

@foreach ($experiences as $experience)

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

<!-- Experience & Education End -->

<!-- Professional Part Start -->

<div class="jumbotron text-center my_jumbotron">
  <h2>Professional</h2>
  <p>My Knowledge Level in Programming & Web:</p>
</div>

@foreach ($expertises as $expertise)
  <div class="row take_middle2">
    <div class="col-md-2">
      <h5>{{ $expertise['name'] }}</h5>
    </div>
   <div class="progress col-md-6 full_width">
	  <div class="progress-bar a progress-bar-striped active" role="progressbar"
	  aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:{{ $expertise['value'] }}">
      {{ $expertise['value'] }}
	  </div>
	</div>
  </div>
  @endforeach

<!-- Professional Part End -->

<!-- Contact Part Start -->

  <div class="row container">
    <div class="col-md-6">
       <h3>My Contact Info</h3>
      <p><b>Phone</b> : 01751473993</p>
      <p><b>Email</b> : rokonuzzamancse@gmail.com</p>
      <p><b>Address</b> : Zilla -> Rajshahi   &   Country -> Bangladesh</p>
    </div>

    <div class="col-md-6">
       <h3>Contact With Me</h3>
        <form class="form-horizontal" action="/action_page.php">
		  <div class="form-group">
			<label class="control-label col-sm-2" for="usr">Name:</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" id="usr" placeholder="Enter email">
			</div>
		  </div>
		  <div class="form-group">
			<label class="control-label col-sm-2" for="email">Email:</label>
			<div class="col-sm-10">
			  <input type="email" class="form-control" id="email" placeholder="Enter email">
			</div>
		  </div>
		  <div class="form-group">
			<label class="control-label col-sm-2" for="usr">Subject:</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" id="usr" placeholder="Enter email">
			</div>
		  </div>
		  <div class="form-group">
			<label class="control-label col-sm-2" for="comment">Message:</label>
			<div class="col-sm-10">
			  <textarea class="form-control" rows="5" id="comment"></textarea>
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
			  <button type="submit" class="btn btn-default">Submit</button>
			</div>
		  </div>
		</form>
    </div>
  </div>


<!-- Contact Part End -->
</div>

</body>
</html>
