var React = require('react');
var LogList = require('./LogList');

module.exports = React.createClass({
	render:function(){
		var logadd;
		if (this.props.loadAddLog) {
			var LogAdd = require('./LogAdd');
		  	logadd = <LogAdd LogAddIsVisible={this.props.LogAddIsVisible} onToggleForm={this.props.onToggleForm}/>;
		} else {
		  	logadd = '';
		}
		return(
			<main><LogList source='/work_log/index.php?m=Home&c=WorkLog&a=getLogListByScroll'/>{logadd}</main>
		)
	}
})
