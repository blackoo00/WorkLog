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
		}
		return(
			<main>
				<LogList 
				source='/work_log/index.php?m=Home&c=WorkLog&a=getLogListByScroll' 
				loglist={this.props.loglist} 
				handleLogDelete = {this.props.handleLogDelete} 
				handleLogTextUpdate = {this.props.handleLogTextUpdate} 
				handleLogFinish = {this.props.handleLogFinish} 
				showCondition = {this.props.showCondition} 
				/>
				<ReactCSSTransitionGroup transitionName="log_add_wrap" transitionEnterTimeout={1000} transitionLeaveTimeout={1000}>
					{logadd}
				</ReactCSSTransitionGroup>
			</main>
		)
	}
})
