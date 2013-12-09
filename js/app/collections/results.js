var app = app || {};

(function($) {
	app.ResultCollection = Backbone.Collection.extend({
		model: app.ResultItem
	});
	
})(jQuery);