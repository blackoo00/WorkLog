	requirejs.config({
		paths:{
			"jquery":'jquery-1.11.1.min',
			"velocity": "velocity.min",
	        "velocity-ui": "velocity.ui.min",
		},
		shim:{
			"velocity": {
			    deps: [ "jquery" ]
			},
			"velocity-ui": {
			    deps: [ "velocity" ]
			}
		},
		urlArgs:"bust=" + (new Date()).getTime(),
	});
	requirejs(['jquery'],function($){
			
	})