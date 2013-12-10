var app = app || {};

(function($) {
	app.WikiPage = Backbone.Model.extend({
		defaults: {
			title: '',
			pageType: 'unprocessed',
			contents: ''
		},
		urlRoot: '/app/parse.php'
	});
})(jQuery);