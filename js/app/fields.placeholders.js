(function($) {
	// swap out the subject field with different possible topics
	var availableTopics = ["Cardiff", "History of the hamburger", "Smalltalk", "Verity Lambert", "1975 Australian constitutional crisis", "Waterloo, Ontario", "Green Line (MBTA)"];
	$("#topic").attr("placeholder",availableTopics[Math.floor(Math.random() * availableTopics.length)]);
})(jQuery);