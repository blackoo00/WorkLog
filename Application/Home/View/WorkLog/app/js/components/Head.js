var React = require('react');
var HeadLeft = require('./HeadLeft');
var HeadRight = require('./HeadRight');
/*顶部*/
module.exports = React.createClass({
	render: function() {
		return <header id="header">
		    <HeadLeft/>
		    <div id="title">Robin's JobLogs</div>
		    <HeadRight/>
	    </header>;
	}
});