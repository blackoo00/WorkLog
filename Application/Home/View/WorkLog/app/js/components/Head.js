var React = require('react');
var HeadLeft = require('./HeadLeft');
var HeadRight = require('./HeadRight');
var Calendar = require('react-date-range/lib/Calendar');
var $ = require('jquery');
/*顶部*/
module.exports = React.createClass({
	getInitialState:function(){
		return {
			'calendarIsVisible':false,
			'calendarStartMove':false,
			'calendarEndMove':false,
		};
	},
	//显示日历
	handleCalendarStartMove:function(){
		$('#loading').show();
		this.setState({'calendarIsVisible':true,});
		setTimeout(function(){
			this.setState({'calendarStartMove':true,'calendarEndMove':false});
			$('#loading').hide();
		}.bind(this),500);
	},
	//关闭日历
	handleSelect:function(data){
		var timestamp = Date.parse(data._d)/1000;
		this.setState({'calendarEndMove':true,'calendarStartMove':false,});
		this.props.handleCalendarChooseLogs(timestamp);
	},
	render: function() {
		var calendar;
		if(this.state.calendarIsVisible){
			var calendarAnimationClass = 'calendar_wrap ';
			if(this.state.calendarStartMove){
				calendarAnimationClass += 'from-top-to-bottom';
			}
			if(this.state.calendarEndMove){
				calendarAnimationClass += 'from-bottom-to-top';
			}
			calendar =
			<div className={calendarAnimationClass}>
				<Calendar
	                linkedCalendars={ true } 
	                onChange={this.handleSelect} 
	                theme={{
		                Calendar : { width: 976},
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
			</div>;
		}
		return (<header id="header">
			{calendar}
		    <HeadLeft onToggleForm={this.props.onToggleForm} handleCalendarStartMove={this.handleCalendarStartMove}/>
		    <div id="title">Robin's JobLogs</div>
		    <HeadRight handleScreeningLog={this.props.handleScreeningLog}/>
	    </header>)
	}
});