<?php

return [
	'url' => 'https://api.mapbox.com',

	'access_token' => 'pk.eyJ1IjoiaGVpbmh0ZXRhdW5nLWl0bGlmZSIsImEiOiJjanFvM2poNWMwYnNyNDNtczM1NW95Z3k0In0.xbm5WarpoGRXPR30_3poNQ',

	'version' => [
		'1' => 'v1',
		'2' => 'v2',
		'3' => 'v3',
		'4' => 'v4',
		'5' => 'v5',
		// ...
	],

	'scope' => [
		'mapbox' => 'mapbox',
		'places' => 'mapbox.places',
		'dark' => 'mapbox.dark',
		// ...
	],

    'endPoint' => [
    	'matrix' => 'directions-matrix',
    	'optimize' => 'optimized-trips',
    	'direction' => 'directions',
    	// ..
    ]
];