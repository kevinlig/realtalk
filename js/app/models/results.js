var app = app || {};

(function($) {
	app.ResultItem = Backbone.Model.extend({
		defaults: {
			ns: '',
			title: ''
		}
	});
	
})(jQuery);