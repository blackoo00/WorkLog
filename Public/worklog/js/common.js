define([],function(){
	function Common(){

	}
	Common.prototype.getaction = function(m,a){
		var reg1 = /(&m=[^ ]*&a)/g;
		var reg2 = /(&a=[^ ]*&)/g;
		var r=window.location.href;
		var action=r.replace(reg1,'&m='+m+'&a');
		var action2=action.replace(reg2,'&a='+a+'&');
		return action2;
	}
	return {
		Common: Common
	};
});