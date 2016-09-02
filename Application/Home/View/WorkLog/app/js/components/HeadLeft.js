var React = require('react');
var LogAdd = require('./LogAdd');

/*顶部左侧栏目筛选(日历，添加日志)*/
module.exports = React.createClass({
	getInitialState:function(){
		return{
			isVisible:false,
		}
	},
	handleAddLog:function(){
		this.refs.logadd.handleShowHide();
	},
	render: function(){
		var dir ='http://127.0.0.1/work_log/Public/worklog/images/';
	    var imgs_classname = ['calendar-icon', 'write-icon', 'search-icon','pick-icon'];
	    var imgs =[dir+'calendar_icon.png',dir+'write_icon.png',dir+'search_icon.png',dir+'pick_icon.png'];
		return <div>
			<span key='img_1' className="calendar-icon header_item"><img src={imgs[0]}/></span>
			<span key='img_2' className="write-icon header_item" onClick={this.handleAddLog}><img src={imgs[1]}/></span>
			<span key='img_3' className="search-icon header_item"><img src={imgs[2]}/></span>
			<span key='img_4' className="pick-icon header_item"><img src={imgs[3]}/></span>
			<LogAdd ref="logadd" ref="logadd" isVisible={this.state.isVisible}/>
		</div>
	}
})