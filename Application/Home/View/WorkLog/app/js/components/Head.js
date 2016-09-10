var React = require('react');
var HeadLeft = require('./HeadLeft');
var HeadRight = require('./HeadRight');
/*顶部*/
module.exports = React.createClass({
	render: function() {
		return <header id="header">
		    <HeadLeft onToggleForm={this.props.onToggleForm}/>
		    <div id="title">Robin's JobLogs</div>
		    <HeadRight handleScreeningLog={this.props.handleScreeningLog}/>
	    </header>;
	}
});