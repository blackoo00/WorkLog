var React = require('react');

/*搜索功能*/
module.exports = React.createClass({
	handKeyUp:function(){
		var key = this.refs.target.value;
		this.props.onSearchTextUpdate(key);
	},
	render: function(){
		return <div id="search">
				<form id="search-box" action="" method="post">
					<input type="text" id="search-con" placeholder="输入关键词..." ref="target" onKeyUp={this.handKeyUp}/>
					<i id="search-btn" className="icon-search"></i>
				</form>
			</div>;
	}
});