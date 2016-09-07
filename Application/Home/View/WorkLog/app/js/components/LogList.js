var React = require('react');
var Search = require('./Search');
var $ = require('jquery');
var signals= require('signals');

/*日志列表*/
module.exports = React.createClass({
	getInitialState:function(){
		return {
			loglist : [],
			searchText: '',
		};
	},
	componentDidMount:function(){
		$.get(this.props.source,function(data){
			if(this.isMounted){
				this.setState({
					loglist:eval("("+data+")").data,
				});
			}
		}.bind(this));
		$("#loading").hide();
		//滑动删除
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
	handleSearchTextUpdate: function(searchText) {
	  this.state.searchText = searchText;
	  this.setState(this.state);
	},
	/*点击完成日志*/
	handleLogFinish:function(index){
		var loglist = this.state.loglist;
		var log = loglist[index];
		var id = log.id;
		loglist[index].finished = 1;
		this.setState({
			loglist : loglist,
		})
		$.ajax({
			url:'/work_log/index.php?m=Home&c=WorkLog&a=finishLog',
			data:{id:id},
			dataType:'json',
			success:function(data){
				console.log(data);
			}
		});
	},
	/*列表中直接更新内容*/
	handleLogTextUpdate: function(index,event){
		var con = event.target.value;
		var loglist = this.state.loglist.slice();
		var id = loglist[index].id;
		loglist[index].content = con;
		this.setState({loglist: loglist});
		$.ajax({
			url:'/work_log/index.php?m=Home&c=WorkLog&a=editlogs',
			data:{con:con,id:id},
			dataType:'json',
			success:function(data){
				console.log(data);
			}
		});
	},
	/*删除日志*/
	handleLogDelete:function(index){
		var loglist = this.state.loglist.slice();
		var id = loglist[index].id;
		var _self = this;
		$.ajax({
			url:'/work_log/index.php?m=Home&c=WorkLog&a=deletelog',
			data:{id:id},
			async:false,
			success:function(data){
			    // _self.setState({
			    // 	loglist:_self.state.loglist.filter(function(data) {
				   //    	return data.id != id;
				   //  })
			    // });
			    loglist.splice(index, 1);
			    _self.setState({loglist: loglist});
			}
		});
	},
	render: function() {
		/*日志列表*/
		var loglist = [];
		this.state.loglist.filter(function(data) {
	      return (data.content.toLowerCase().indexOf(this.state.searchText.toLowerCase()) > -1 && data.delete == 0);
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
						<span className="delete" onClick={this.handleLogDelete.bind(this, index)}>删除</span>
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