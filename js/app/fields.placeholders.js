(function($) {
	// swap out the subject field with different possible topics
	var availableTopics = ["Cardiff", "History of the hamburger", "Finder (software)", "Verity Lambert", "1975 Australian constitutional crisis", "Waterloo, Ontario", "Green Line (MBTA)"];
	$("#topic").attr("placeholder",availableTopics[Math.floor(Math.random() * availableTopics.length)]);
})(jQuery);