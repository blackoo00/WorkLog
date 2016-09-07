var React = require('react');
var Loading = require('./Loading');
var Head = require('./Head');
var Main = require('./Main');
var $ = require('jquery');
var WorkLog = React.createClass({
	getInitialState:function(){
		return{
			LogAddIsVisible:false,
			loadAddLog:false,
		}
	},
	onToggleForm:function(){
		this.setState({
			LogAddIsVisible:!this.state.LogAddIsVisible,
			loadAddLog:true,
		});
	},
	render:function(){
		return(
			<div>
				<Loading/>
				<Head onToggleForm={this.onToggleForm}/>
				<Main LogAddIsVisible={this.state.LogAddIsVisible} loadAddLog={this.state.loadAddLog} onToggleForm={this.onToggleForm}/>
			</div>
		)
	}
})

module.exports = WorkLog;