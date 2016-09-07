var React = require('react');
var HeadLeftButton = require('./HeadLeftButton');

/*顶部左侧栏目筛选(日历，添加日志)*/
module.exports = React.createClass({
	render: function(){
		return <div>
			<HeadLeftButton onToggleForm={this.props.onToggleForm}/>
		</div>
	}
})