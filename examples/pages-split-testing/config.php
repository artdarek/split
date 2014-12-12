<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Keep randomized value
	|--------------------------------------------------------------------------
	| 
	| Tell library if it should keep state of randomization
	| If set to true value will be randomized only once when user enters 
	| page for a first time and kept for next visits. If set to false
	| value will be randomized on each visit.
	|
	*/
	'keep' => true,

	/*
	|--------------------------------------------------------------------------
	| Data to split test
	|--------------------------------------------------------------------------
	|
	| Data that you want split test
	| pattern: ['some id', 'value to test', 'weight'],
	|
	*/
    'data' => array(
    	[ 'page1','http://facebook.com/', 25 ],
    	[ 'page2','http://github.com/', 25 ],
    	[ 'page3','http://google.com/', 25 ],
    	[ 'page4','http://twitter.com/', 25 ],
    ),

);