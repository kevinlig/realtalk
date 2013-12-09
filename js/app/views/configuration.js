var app = app || {};

(function($) {
	// hook into the existing rendered form
	app.ConfigurationView = Backbone.View.extend({
		el: "#configuration",
		events: {
			'submit': 'submit'
		},
		initialize: function() {
			// initialize the model
			this.model = new app.Configuration();
			this.model.set('topic',$("#topic").val());
			this.model.set('paragraphs',$("#paragraphs").val());
		},
		submit: function() {
			// catch the form submission and process it here instead
			var topic = $("#topic").val();
			var paragraphs = parseInt($("#paragraphs").val());
			// perform some validation
			if (topic == "" || paragraphs == "NaN" || paragraphs < 1 || paragraphs > 6) {
				// error! but we'll let foundation's error handling deal with it
				return false;
			}

			// start the spinner
			var opts = {
			  lines: 13,
			  length: 5,
			  width: 2,
			  radius: 5,
			  corners: 1,
			  rotate: 0,
			  direction: 1,
			  color: '#000',
			  speed: 1,
			  trail: 60,
			  shadow: false,
			  hwaccel: false,
			  className: 'spinner',
			  zIndex: 1,
			  top: 'auto',
			  left: '30'
			};
			var spinner = new Spinner(opts).spin($(".loading-spinner")[0]);

			// okay now let's update the model
			this.model.set('topic',topic);
			this.model.set('paragraphs',paragraphs);

			// now we can do something with the model, namely send a server request
			var self = this;
			this.model.save({},{
				success: function(model, response) {
					// clear spinner
					$(".loading-spinner").html("");

					// check search results
					if (model.get("results").length == 0) {
						// no results
						$("#noSearchResultsModal").foundation('reveal','open');
						return false;
					}

					// okay we actually got something back, let's display the results
					self.displaySearchResults(model.get("results"));

				},
				error: function(model, response) {
					// clear spinner
					$(".loading-spinner").html("");

					// show error message
					$("#genericErrorModal").foundation('reveal','open');
				}
			});

			// don't let the page reload
			return false;
		},
		displaySearchResults: function(results) {
			var resultCollection = new app.ResultCollection();
			for (var i = 0; i < results.length; i++) {
				var thisResult = results[i];
				var newResult = new app.ResultItem({title: thisResult['title'], ns: thisResult['ns']});

				// add it to the collection
				resultCollection.add(newResult);
			}

			// okay display the view
			var resultsView = new app.ResultsView({collection: resultCollection});

			// cool we don't need the search results any more in this model
			this.model.unset('results');
		}
	});
})(jQuery);