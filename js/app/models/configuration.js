var app = app || {};

(function($) {
	app.Configuration = Backbone.Model.extend({
		defaults: {
			topic: '',
			paragraphs: 3,
		},
		urlRoot: '/app/search.php'
	});

})(jQuery);