var app = app || {};

(function($) {
	// hook into the existing rendered form
	app.ResultsView = Backbone.View.extend({
		el: "#searchResultsView",
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

			$("#searchResultsModal").foundation('reveal','open');	
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