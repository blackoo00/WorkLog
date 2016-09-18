var React = require('react');
var Loading = require('./Loading');
var Head = require('./Head');
var Main = require('./Main');
var $ = require('jquery');
var WorkLog = React.createClass({
	getInitialState:function(){
		return{
			loadAddLog:false,
			loglist:[],
			showcondition:'',
		}
	},
	/*日志列表*/
	componentDidMount:function(){
		var loglist_source = '/work_log/index.php?m=Home&c=WorkLog&a=getLogListByScroll';
		$.get(loglist_source,function(data){
			if(this.isMounted){
				this.setState({
					loglist:eval("("+data+")").data,
				});
			}
		}.bind(this))
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
			    loglist.splice(index, 1);
			    _self.setState({loglist: loglist});
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
	/*显示隐藏添加日志页面*/
	handleScreeningLog:function(data = ''){
		this.setState({
			showcondition:data,
		});
	},
	//点击显示添加日志页面
	onToggleForm:function(){
		if(this.state.loadAddLog){
			if($('.log_add_wrap').is(':visible')){
				$('.log_add_wrap').animate({
					top: '-100%',},
					300, function() {
					$('.log_add_wrap').hide();
				});
			}else{
				$('.log_add_wrap').show().animate({
					top: '0',},
					300, function() {
				});
			}
		}else{
			this.setState({
				loadAddLog:true,
			});
		}
	},
	//通过日历筛选日志
	handleCalendarChooseLogs:function(time){
		var loglist_source = '/work_log/index.php?m=Home&c=WorkLog&a=handleCalendarChooseLogs';
		var _self = this;
		$.ajax({
			url:loglist_source,
			data:{time:time},
			success:function(data){
			    if(_self.isMounted){
    				_self.setState({
    					loglist:eval("("+data+")").data,
    				});
    			}
			}
		});
	},
	/*筛选是否完成*/
	handleChooseLogsType:function(type){
		
	},
	render:function(){
		return(
			<div>
				<Loading/>
				<Head 
					onToggleForm={this.onToggleForm} 
					handleScreeningLog={this.handleScreeningLog} 
					handleCalendarChooseLogs={this.handleCalendarChooseLogs}  
				/>
				<Main 
					loadAddLog={this.state.loadAddLog} 
					onToggleForm={this.onToggleForm} 
					loglist = {this.state.loglist} 
					handleLogDelete = {this.handleLogDelete} 
					handleLogTextUpdate = {this.handleLogTextUpdate} 
					handleLogFinish = {this.handleLogFinish} 
					showCondition = {this.state.showcondition} 
				/>
			</div>
		)
	}
})

module.exports = WorkLog;