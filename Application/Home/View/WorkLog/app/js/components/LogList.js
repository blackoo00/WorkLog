var React = require('react');
var Search = require('./Search');
var $ = require('jquery');
var signals= require('signals');

/*日志列表*/
module.exports = React.createClass({
	getInitialState:function(){
		return {
			searchText: '',
		};
	},
	componentDidMount:function(){
		//滑动
		var startX;
		var startY;
		$(document).on("touchstart","#logs li", function(e) {
		    startX = e.originalEvent.changedTouches[0].pageX,
		    startY = e.originalEvent.changedTouches[0].pageY;
		});
		$(document).on("touchmove","#logs li", function(e) {
		    var moveEndX = e.originalEvent.changedTouches[0].pageX,
		    moveEndY = e.originalEvent.changedTouches[0].pageY,
		    X = moveEndX - startX,
		    Y = moveEndY - startY;
		    //往右滑
		    if ( Math.abs(X) > Math.abs(Y) && X > 0 ) {
		        $(this).stop(true).animate({"margin-left":"0"},200);
		    }
		    //往左滑
		    else if ( Math.abs(X) > Math.abs(Y) && X < 0 ) {
		    	$(this).stop(true).siblings().animate({"margin-left":"0"},200).end().animate({"margin-left":"-9%"},200);
		    }
		});
	},
	/*搜索*/
	handleSearchTextUpdate: function(searchText) {
	  this.state.searchText = searchText;
	  this.setState(this.state);
	},
	/*点击完成日志*/
	handleLogFinish:function(index){
		this.props.handleLogFinish(index)
	},
	/*列表中直接更新内容*/
	handleLogTextUpdate: function(index,event){
		this.props.handleLogTextUpdate(index,event);
	},
	/*删除日志*/
	handleLogDelete:function(index){
		this.props.handleLogDelete(index);
	},
	render: function() {
		/*日志列表*/
		var loglist = [];
		this.props.loglist.filter(function(data) {
			if(this.props.showCondition != ''){
	      		return (data.content.toLowerCase().indexOf(this.state.searchText.toLowerCase()) > -1 && data.delete == 0 && data.finished == this.props.showCondition);
			}else{
	      		return (data.content.toLowerCase().indexOf(this.state.searchText.toLowerCase()) > -1 && data.delete == 0);
			}
	    }.bind(this)).map(function (log,index){
	    	loglist.push(
	    		<li key={'log_' + index}>
	    			{/*勾勾*/}
					<div className={(log.finished == 0?"unfinished":"finished") + " check-finished"} onClick={this.handleLogFinish.bind(this,index)}></div>
					{/*日志内容*/}
					<input type="text" className="edit-content" value={log.content} onChange={this.handleLogTextUpdate.bind(this, index)}/>
					{/*完成时间*/}
					<div className={(log.finished == 0?"doen":"") + " add-time"}>
						{log.showtime}
					</div>
					{/*操作*/}
					<div className="operation">
						<span className="delete" onClick={this.handleLogDelete.bind(this,index)}>删除</span>
					</div>
				</li>
	    	)
		}.bind(this))
		return <div><Search onSearchTextUpdate={this.handleSearchTextUpdate}/><div id="logs-list">	
			<ul id="logs">
				{loglist}
			</ul>
			</div></div>;
	}
});