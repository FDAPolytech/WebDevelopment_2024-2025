( function( api ) {

	// Extends our custom "fresh-bakers" section.
	api.sectionConstructor['fresh-bakers'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );