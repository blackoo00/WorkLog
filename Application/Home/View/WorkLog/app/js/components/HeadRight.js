var React = require('react');
var $ = require('jquery');
/*日志总数 完成 未完成 筛选*/
module.exports = React.createClass({
	getInitialState: function() {
	  return {
	    all: '0',
	    finished: '0',
	    unfinished: '0',
	  };
	},
	componentDidMount: function() {
	  $.get('/work_log/index.php?m=Home&c=WorkLog&a=getHeadrightData', function(result) {
	  	//判断组件是否渲染到了DOM中
	    if (this.isMounted()) {
	    	var result = eval("("+result+")");
		    this.setState({
              all: result.data.all,
    		  finished: result.data.finished,
    		  unfinished: result.data.unfinished,
            });
	    }
	  }.bind(this));
	},
	render:function(){
		var arr = [
			<span key="header_right_1" className="nums-all nums header_item">{this.state.all}</span>,
			<span key="header_right_2" className="nums-finished nums header_item">{this.state.finished}</span>,
			<span key="header_right_3" className="nums-unfinished nums header_item">{this.state.unfinished}</span>,
		]
		return <div>{arr}</div>;
	}
});