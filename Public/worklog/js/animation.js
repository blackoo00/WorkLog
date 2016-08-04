define(['jquery','velocity','velocity-ui'],function($,Velocity){
	var addbox=$("#add-log");
	function Animation(){

	};
	$.Velocity.RegisterEffect('robin.small_to_gig',{
		defaultDuration:500,
		calls:[
			[{scale:[1,0]},1, { easing: "spring" }],
		]
	});
	$.Velocity.RegisterEffect('robin.big_to_small',{
		defaultDuration:300,
		calls:[
			[{scale:[0,1]},1, { easing: "easeInSine" }],
		]
	});
	Animation.prototype.from_small_to_big=function(obj){
		// var seqInit=[
		// 	{
		// 		e:obj,
		// 		p:'robin.small_to_gig',
		// 		o:{duration:800}
		// 	},
		// ];
		// console.log(seqInit);
		// Velocity.RunSequence(seqInit);
		obj.velocity("stop").velocity("robin.small_to_gig");
	}
	Animation.prototype.from_big_to_small=function(obj){
		// var seqInit="";
		// seqInit=[
		// 	{
		// 		e:obj,
		// 		p:'robin.big_to_small',
		// 		o:{duration:300},
		// 	},
		// ];
		obj.velocity("stop").velocity("robin.big_to_small");
		// console.log(seqInit);
		// Velocity.RunSequence(seqInit);
	}

	return{
		Animation:Animation
	}
})