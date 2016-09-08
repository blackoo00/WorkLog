var React = require('react');
var LogList = require('./LogList');
require('velocity-animate');
require('velocity-animate/velocity.ui');
var ReactCSSTransitionGroup = require('react-addons-css-transition-group');

module.exports = React.createClass({
	render:function(){
		var logadd;
		if (this.props.loadAddLog) {
			var LogAdd = require('./LogAdd');
		  	logadd = <LogAdd onToggleForm={this.props.onToggleForm}/>;
		}else{
			logadd = '';
		}
		return(
			<main>
				<LogList source='/work_log/index.php?m=Home&c=WorkLog&a=getLogListByScroll'/>
				<ReactCSSTransitionGroup transitionName="example" transitionEnterTimeout={1000} transitionLeaveTimeout={1000}>
					{logadd}
				</ReactCSSTransitionGroup>
			</main>
		)
	}
})
