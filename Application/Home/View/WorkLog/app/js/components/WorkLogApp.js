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
	/*筛选是否完成*/
	render:function(){
		return(
			<div>
				<Loading/>
				<Head 
					onToggleForm={this.onToggleForm} 
					handleScreeningLog={this.handleScreeningLog} 
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

var Calendar = require('react-date-range/lib/Calendar');

var MyComponent = React.createClass({
	handleSelect:function(date){
	    console.log(date); // Momentjs object
	},

	render:function(){
	    return (
	        <div>
	            <Calendar
	                linkedCalendars={ true } 
	                onChange={this.handleSelect} 
                    theme={{
                      Calendar : { width: 976 },
                      Day : { fontSize: 40 },
                      Weekday : { fontSize: 40 },
                      MonthAndYear : { fontSize: 40, height:50 },
                      MonthButton : { width: 40, height:40 },
                      MonthArrow : { border: '14px solid transparent',},
                      MonthArrowPrev : { borderRightWidth: 14,marginLeft: -4},
                      MonthArrowNext : { borderLeftWidth: 14,marginLeft: 16},
                      PredefinedRanges : { marginLeft: 10, marginTop: 10 }
                    }}
	            />
	        </div>
	    )
	}
})

module.exports = MyComponent;