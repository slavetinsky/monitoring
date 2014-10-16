/**
 * Bootstrapt file pro javascript
 * 
 **/

require.config({
    baseUrl: '/js',
    // Cesty
    paths: {
        jquery: 'jquery',
    },  
	// Závislosti
    shim: {
        'jquery.lightbox-0.5': ['jquery'],
        'neatshow.min': ['jquery'],
        'jquery.simplyCountable': ['jquery'],
        'tag-it.min': ['jquery'],
        'bootstrap.min': ['jquery']
    }
});

require(['jquery', 'bootstrap.min'], function($, bootstrap){

});
