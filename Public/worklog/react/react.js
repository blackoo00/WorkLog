/*日志总数 完成 未完成 筛选*/
var HeaderRight = React.createClass({
	getInitialState: function() {
	  return {
	    all: '0',
	    finished: '0',
	    unfinished: '0',
	  };
	},
	componentDidMount: function() {
	  $.get('/work_log/index.php?m=Home&c=WorkLog&a=getHeadrightData', function(result) {
	  	//判断组件是否渲染到了DOM中
	    if (this.isMounted()) {
	    	var result = eval("("+result+")");
		    this.setState({
              all: result.data.all,
    		  finished: result.data.finished,
    		  unfinished: result.data.unfinished,
            });
	    }
	  }.bind(this));
	},
	render:function(){
		var arr = [
			<span key="header_right_1" className="nums-all nums header_item">{this.state.all}</span>,
			<span key="header_right_2" className="nums-finished nums header_item">{this.state.finished}</span>,
			<span key="header_right_3" className="nums-unfinished nums header_item">{this.state.unfinished}</span>,
		]
		return <div>{arr}</div>;
	}
});
/*顶部左侧栏目筛选(日历，添加日志)*/
var HeaderLeft = React.createClass({
	getInitialState:function(){
		return{
			isVisible:false,
		}
	},
	handleAddLog:function(){
		this.setState({
			isVisible:true,
		})
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
			<LogAdd ref="logadd" isVisible={this.state.isVisible}/>
		</div>
	}
})
/*添加日志*/
var LogAdd = React.createClass({
	getInitialState:function(){
		return{
			isVisible:true,
		}
	},
	handleHide(){
		this.setState({
			isVisible:false,
		})
	},
	render:function(){
		var style={
			display: this.props.isVisible ? 'fixed' : 'none',
		}
		console.log(style);
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
/*顶部*/
var Header = React.createClass({
	render: function() {
		return <header id="header">
				    <HeaderLeft/>
				    <div id="title">Robin's JobLogs</div>
				    <HeaderRight/>
			    </header>;
	}
});
/*加载动画*/
var Loading = React.createClass({
	componentDidMount:function(){
		$.getScript('http://127.0.0.1/work_log/Public/worklog/react/loading.js');
		$.getScript('http://127.0.0.1/work_log/Public/worklog/loading/js/prefixfree.min.js');
		$("#loading").show();
	},
	render:function(){
		return <div id="loading">
			<canvas id="c"></canvas>
		</div>;	
	}
})
/*搜索功能*/
var Search = React.createClass({
	handKeyUp:function(){
		var key = this.refs.target.value;
		this.props.onSearchTextUpdate(key);
	},
	render: function(){
		return <div id="search">
				<form id="search-box" action="" method="post">
					<input type="text" id="search-con" placeholder="输入关键词..." ref="target" onKeyUp={this.handKeyUp}/>
					<i id="search-btn" class="icon-search"></i>
				</form>
			</div>;
	}
});
/*日志列表*/
var Logs = React.createClass({
	getInitialState:function(){
		return {
			loglist : [],
			searchText: '',
			deleteId : 0,
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
	    loglist.splice(index, 1);
	    this.setState({loglist: loglist});
		$.ajax({
			url:'/work_log/index.php?m=Home&c=WorkLog&a=deletelog',
			data:{id:id},
			success:function(data){
			    _self.setState({
			    	loglist:_self.state.loglist.filter(function(data) {
				      	return data.id != id;
				    })
			    });
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

ReactDOM.render(
	<div><Loading/><Header/><main><Logs source='/work_log/index.php?m=Home&c=WorkLog&a=getLogListByScroll'/></main></div>,
    document.getElementById('wrapper')
);
