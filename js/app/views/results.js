var app = app || {};

(function($) {
	// hook into the existing rendered form
	app.ResultsView = Backbone.View.extend({
		el: "#searchResultsView",
		events: {
			'click a.resultsLink': 'parseArticle'
		},
		initialize: function() {
			var self = this;
			this._childViews = [];

			this.collection.each(function(resultItem) {
				// loop through each collection item and create the child view

				self._childViews.push(new app.ResultItemView({
					model: resultItem
				}));
			});

			this.render();
		},
		render: function() {
			// clear any old results
			this.$el.html("");
			var self = this;

			// create the child views for each collection item
			for (var i = 0; i < this._childViews.length; i++) {
				var childView = self._childViews[i];
				this.$el.append(childView.render());
			}

			// reset the correct hidden divs
			$("#searchResultsModal .visibleResults").removeClass("hide");
			$("#searchResultsModal .loadingPage").addClass("hide");

			$("#searchResultsModal").foundation('reveal','open');	
		},
		reset: function() {
			// we're removing the view object from memory
			// so unbind all events
			this.undelegateEvents();
			this.stopListening();
		},
		parseArticle: function(targetLink) {
			var self = this;
			// determine which link was clicked
			var pageTitle = $(targetLink.currentTarget).attr("data-wiki-title");

			
			// begin searching
			$("#searchResultsModal .visibleResults").addClass("hide");
			$("#searchResultsModal .loadingPage").removeClass("hide");

			// start spinner
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
			  zIndex: 1000,
			  top: 'auto',
			  left: '0'
			};
			var spinner = new Spinner(opts).spin($(".wiki-spinner")[0]);

			// create a new model based on the title
			var pageModel = new app.WikiPage();
			pageModel.save({title: pageTitle},{
				success: function(model, response) {
					self.validateWiki(model.get('contents'), model);
				},
				error: function(model, response) {
					// clear spinner
					$(".wiki-spinner").html("");
					// show error message
					$("#genericErrorModal").foundation('reveal','open');
				}
			});

			return false;
		},

		validateWiki: function(pageText, pageModel) {
			// put the HTML into the DOM so we can run jQuery on it
			$("#scratchArea").html(pageText);

			// check if the entry is a stub
			if ($("#scratchArea .stub").length > 0) {
				// a stub! show error
				pageModel.set('pageType',"stub");
				$("#stubModal").foundation('reveal','open');
				return false;
			}
			else if ($("#scratchArea #disambigbox").length > 0) {
				// disambiguation page
				pageModel.set('pageType',"dismabiguation");
				$("#disambigModal").foundation('reveal','open');

				// pull the suggestions out and put it into the list
				// but only the first 15 for sanity's sake

				var suggestedLinks = $("#scratchArea a[href*='/wiki/']");
				var loopMax = 15;
				if (suggestedLinks.length < 15) {
					loopMax = suggestedLinks.length;
				}

				$("#disambigModal ul").html("");

				// at this point we're going to recreate this view in the context of a disambiguation message
				var rawTemplate = $("#resultItemTemplate").html();
				var resultCollection = new app.ResultCollection();

				for (var i = 0; i < loopMax; i++) {
					var currentLink = $(suggestedLinks[i]).attr("title");
					var newLink = new app.ResultItem({title: currentLink});
					// add it to the collection
					resultCollection.add(newLink);
				}

				// delete the current view
				this.reset();

				// create the view again, but set it to the new modal
				app.resultsModalView = new app.ResultsView({collection: resultCollection, el: "#disambigList"});

				return false;
			}
			else if ($("#scratchArea p").length < 20) {
				// we require a minimum a of 20 paragraphs, otherwise we will reject it for being too short
				pageModel.set('pageType',"stub");
				$("#tooShortModal").foundation('reveal','open');
				return false;
			}

			// okay, if we made it to this point, we'll assume a usable article
			this.generateLorem(pageModel);

		},

		generateLorem: function(pageModel) {
			// clean up the HTML
			// strip any citations, footnotes, and references
			$("#scratchArea sup").remove();

			// get the number of paragraphs we need
			var paragraphs = app.masterConfiguration.model.get('paragraphs');

			// get the total number of paragraphs available
			var totalParagraphs = $("#scratchArea p").length;

			// determine the max and min starting paragraphs
			// we never want the first or last 5 paragraphs
			var min = 5;
			var max = totalParagraphs - paragraphs - 6;

			// randomly select the first paragraph
			var startIndex = Math.floor(Math.random() * (max - min + 1)) + min;

			// return the data
			// clear any old data
			$("#fillerOutput").html("");

			for (var i = 0; i < paragraphs; i++) {
				var currentIndex = startIndex + i;
				var currentParagraph = $("#scratchArea p").eq(currentIndex).text();
				$("#fillerOutput").append("<p>" + currentParagraph + "</p>");
			}

			// dismiss the current modal
			$(".reveal-modal").foundation('reveal','close');
		}

	});

	app.ResultItemView = Backbone.View.extend({
		model: app.resultItem,
		tagName: 'li',
		render: function() {
			var template = $("#resultItemTemplate").html();
			return _.template(template,this.model.attributes);
		}
	});
})(jQuery);