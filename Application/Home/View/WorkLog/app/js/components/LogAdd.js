var React = require('react');

/*添加日志*/
module.exports = React.createClass({
	getInitialState:function(){
		return{
			isVisible:this.props.isVisible,
		}
	},
	handleShowHide(){
		this.setState({
			isVisible:!this.state.isVisible,
		})
	},
	shouldComponentUpdate:function(){
		console.log('aa');
	},
	render:function(){
		var style={
			display: this.state.isVisible ? 'fixed' : 'none',
		};
		// console.log(style);
		// console.log(this.props.isVisible);
		return (<div><div id="calendar-mask" style={style}></div>
			<div id="add-log" style={style}>
			<div className="add-log-box">
				<p className="difficulty-nums">
					<span data-nums="1" className="on">狼</span>
					<span data-nums="2">虎</span>
					<span data-nums="3">鬼</span>
					<span data-nums="4">龙</span>
					<span  data-nums="5">神</span>
				</p>
				<p className="add-log-type">
					<span className="on" data-nums="1">功能</span>
					<span data-nums="2">BUG</span>
				</p>
				<p className="add-log-content">
					<textarea></textarea>
				</p>
				<p className="add-log-button">
					<button>确认</button>
					<button>取消</button>
				</p>
			</div>
			</div></div>);
	}
})