var React = require('react');
var ReactDOM = require('react-dom');
var WorkLogApp = require('./components/WorkLogApp.js');

var mainCom = ReactDOM.render(
	<WorkLogApp/>,
	document.getElementById('wrapper')
)