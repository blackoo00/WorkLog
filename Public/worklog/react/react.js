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
			<span key="header_right_1" className="nums-all nums">{this.state.all}</span>,
			<span key="header_right_2" className="nums-finished nums">{this.state.finished}</span>,
			<span key="header_right_3" className="nums-unfinished nums">{this.state.unfinished}</span>,
		]
		return <div>{arr}</div>;
	}
});
var Header = React.createClass({
	render: function() {
		var dir ='http://127.0.0.1/work_log/Public/worklog/images/';
	    var imgs_classname = ['calendar-icon', 'write-icon', 'search-icon','pick-icon'];
	    var imgs =[dir+'calendar_icon.png',dir+'write_icon.png',dir+'search_icon.png',dir+'pick_icon.png'];

		var nums = ['nums-all','nums-finished','nums-unfinished'];
		var nums_con = ['{work=$data.all}','{work=$data.finished}','{work=$data.unfinished}'];
		return <header id="header">
				    <div id="title">Robin's JobLogs</div>
				    {
				      imgs.map(function (img,index) {
				        	return <span key={'img_' + index} className={imgs_classname[index]}><img src={img}/></span>;
				      })
				    }
				    <HeaderRight/>
			    </header>;
	}
});
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
var Logs = React.createClass({
	handleSearchTextUpdate: function(searchText) {
	  this.state.searchText = searchText;
	  this.setState(this.state);
	},
	handleLogTextUpdate: function(event){
		var con = event.target.value;
		var id = event.target.getAttribute('data-id');
		$.ajax({
			url:'/work_log/index.php?m=Home&c=WorkLog&a=editlogs',
			data:{con:con,id:id},
			dataType:'json',
			success:function(data){
				console.log(data);
			}
		});
	},
	handleLogDelete:function(event){
		var id = event.target.getAttribute('data-id');
		var li = $(this).parents('li');
		li.hide();
		console.log(li);
		// $.ajax({
		// 	url:'/work_log/index.php?m=Home&c=WorkLog&a=deletelog',
		// 	data:{id:id},
		// 	success:function(data){
		// 		console.log(data);
		// 	}
		// });
	},
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
	render: function() {
		return <div><Search onSearchTextUpdate={this.handleSearchTextUpdate}/><div id="logs-list">	
			<ul id="logs">
				{
					this.state.loglist.filter(function(data) {
				      return data.content.toLowerCase().indexOf(this.state.searchText.toLowerCase()) > -1;
				    }.bind(this)).map(function (log,index){
						return <li key={'log_' + index} data-id={log.id} data-pid={log.pid} data-finish={log.finished}>
						<div className={(log.finished == 0?"unfinished":"finished") + " check-finished"} data-id={log.id}></div>
						<input type="text" className="edit-content" data-id={log.id} defaultValue={log.content} ref="input" onChange={this.handleLogTextUpdate}/>
						<div className={(log.finished == 0?"doen":"") + " add-time"}>
							{log.showtime}
						</div>
						<div className="operation">
							<span className="delete" data-id={log.id} onClick={this.handleLogDelete}>删除</span>
						</div>
						</li>;
					}.bind(this))
				}
			</ul>
			</div></div>;
	}
});

ReactDOM.render(
<div><Loading/><Header/><main><Logs source='/work_log/index.php?m=Home&c=WorkLog&a=getLogListByScroll'/></main></div>,
    document.getElementById('wrapper')
);
