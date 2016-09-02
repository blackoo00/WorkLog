var React = require('react');
var Loading = require('./Loading');
var Head = require('./Head');
var Main = require('./Main');
var WorkLog = React.createClass({
	render:function(){
		return(
			<div><Loading/><Head/><Main/></div>
		)
	}
})

module.exports = WorkLog;