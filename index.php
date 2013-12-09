<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" >

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Real Talk</title>

	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/foundation.css">
	<link rel="stylesheet" href="css/app.css">

	<script src="js/vendor/custom.modernizr.js"></script>
	<script src="js/vendor/spin.min.js"></script>
</head>
<body>

<!-- body content here -->

<nav class="top-bar" data-topbar>
	<ul class="title-area">
		<!-- Title Area -->
		<li class="name">
			<h1>
				<a href="#">Real Talk</a>
			</h1>
		</li>
	</ul>
</nav>
 
  	<!-- End Top Bar -->
 
 
  	<!-- Main Page Content and Sidebar -->
 
	<div class="row">
		<div class="large-12 columns">

			<h1>Real Talk</h1>
			<p class="subheader">Generate filler text based on a topic instead of using generic lorem ipsum.</p>

			<div class="row">
		  		<div class="large-7 columns">
			   		<h3 class="title">Filler Text</h3>
			   		<p>No content yet.</p>
			    </div>
			    <!-- sidebar -->
			    <div class="large-5 columns">
			    	<div class="panel radius">
					 	<h3>Configuration</h3>
					  	<p class="subheader">Enter a topic and select how many paragraphs of filler text you would like.</p>
					  	<form id="configuration" data-abide>
					  		<div class="row">
					  			<div class="large-4 columns">
					      			<label class="inline" for="topic">Topic</label>
					    		</div>
				    			<div class="large-8 columns">
					      			<input type="text" id="topic" placeholder="Cardiff" required pattern="alpha_numeric">
					      			<small class="error">A topic is required.</small>
					    		</div>
				  			</div>
					  		<div class="row">
						    	<div class="large-4 columns">
						      		<label class="inline" for="paragraphs">Paragraphs</label>
					    		</div>
					    		<div class="large-8 columns">
						      		<select id="paragraphs" required pattern="number">
						      			<option value="1">1</option>
						      			<option value="2">2</option>
						      			<option value="3" selected>3</option>
						      			<option value="4">4</option>
						      			<option value="5">5</option>
						      			<option value="6">6</option>
						      		</select>
						      		<small class="error">You must select how many paragraphs you would like to generate.</small>
						    	</div>
						  	</div>
						<div class="row">
							<div class="large-4 columns">
					  			<button type="submit" class="radius button">Generate</button>
					  		</div>
					  		<div class="large-8 columns">
					  			<div class="loading-spinner"></div>
					  		</div>
						</form>
					</div>
		    	</div>
		    	<!-- end sidebar -->
		    </div>
		</div>
	</div>

	<!-- End Main Content and Sidebar -->


	<!-- Footer -->

	<footer class="row">
	<div class="large-12 columns">
		<hr />
		<p class="copyright">Created by Kevin Li.</p>
	</div>
	</footer>

	<!-- End Footer -->


  	<!-- modals -->
  	<div id="noSearchResultsModal" class="reveal-modal small" data-reveal>
		<h3>No Results Found</h3>
		<p class="lead">Real Talk could not find any Wikipedia articles related to that topic.</p>
		<p>Try a different search term.</p>
		<a class="close-reveal-modal">&#215;</a>
		<a href="#" onclick="$('#noSearchResultsModal').foundation('reveal','close'); return false;" class="button radius">Close</a>
	</div>

	<div id="genericErrorModal" class="reveal-modal small" data-reveal>
		<h3>Something Went Wrong</h3>
		<p class="lead">Your request could not be completed. Try refreshing the page and trying again.</p>
		<a class="close-reveal-modal">&#215;</a>
		<a href="#" onclick="$('#genericErrorModal').foundation('reveal','close'); return false;" class="button radius">Close</a>
	</div>

	<div id="searchResultsModal" class="reveal-modal large" data-reveal>
		<h3>Search Results</h3>
		<p class="lead">Which topic are you looking for?</p>
		<ul id="searchResultsView">

		</ul>
		<a class="close-reveal-modal">&#215;</a>
	</div>


	<!-- templates -->
	<script type="text/template" id="resultItemTemplate">
		<li><%= title %></li>
	</script>

	<script src="js/vendor/jquery.js"></script>
  	<script src="js/foundation.min.js"></script>
  	<script src="js/app/fields.placeholders.js"></script>
  	<script src="js/vendor/underscore-min.js"></script>
  	<script src="js/vendor/backbone-min.js"></script>

	<script>
		$(document).foundation();
	</script>

	<script src="js/app/models/results.js"></script>
  	<script src="js/app/models/configuration.js"></script>
  	<script src="js/app/collections/results.js"></script>
  	<script src="js/app/views/results.js"></script>
  	<script src="js/app/views/configuration.js"></script>
  	<script src="js/app/app.js"></script>
</body>
</html>