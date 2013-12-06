<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" >

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Real Talk</title>

  <!-- If you are using CSS version, only link these 2 files, you may add app.css to use for your overrides if you like. -->
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/foundation.css">
  <link rel="stylesheet" href="css/app.css">

  <script src="js/vendor/custom.modernizr.js"></script>

</head>
<body>

  <!-- body content here -->

  <nav class="top-bar" data-topbar>
    <ul class="title-area">
      <!-- Title Area -->
      <li class="name">
        <h1>
          <a href="#">
            Real Talk
          </a>
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
				  	<form>
				  		<div class="row collapse">
				  			<div class="large-4 columns">
				      			<label class="inline" for="#topic">Topic</label>
				    		</div>
			    			<div class="large-8 columns">
				      			<input type="text" id="topic" placeholder="Cardiff">
				    		</div>
			  			</div>
				  		<div class="row collapse">
					    	<div class="large-4 columns">
					      		<label class="inline" for="paragraphs">Paragraphs</label>
				    		</div>
				    		<div class="large-8 columns">
					      		<select id="paragraphs">
					      			<option value="1">1</option>
					      			<option value="2">2</option>
					      			<option value="3" selected>3</option>
					      			<option value="4">4</option>
					      			<option value="5">5</option>
					      			<option value="6">6</option>
					      		</select>
					    	</div>
					  	</div>
				  	<button type="submit" class="radius button">Generate</button>
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
		<p class="copyright">&copy; 2013 Kevin Li.</p>
    </div>
  </footer>
 
  <!-- End Footer -->

  <script src="js/vendor/jquery.js"></script>
  <script src="js/foundation.min.js"></script>
  <script src="js/app/fields.placeholders.js"></script>
  <script>
    $(document).foundation();
  </script>
</body>
</html>