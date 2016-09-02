var React = require('react');
var $ = require('jquery');

/*加载动画*/
module.exports = React.createClass({
	componentDidMount:function(){
		$.getScript('http://127.0.0.1/work_log/Public/worklog/react/loading.js');
		$.getScript('http://127.0.0.1/work_log/Public/worklog/loading/js/prefixfree.min.js');
		$("#loading").show();
	},
	render:function(){
		return <div id="loading">
			<canvas id="c"></canvas>
		</div>;	
	}
})