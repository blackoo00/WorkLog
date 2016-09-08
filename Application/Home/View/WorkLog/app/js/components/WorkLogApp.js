var React = require('react');
var Loading = require('./Loading');
var Head = require('./Head');
var Main = require('./Main');
var $ = require('jquery');
var WorkLog = React.createClass({
	/*添加日志页面*/
	getInitialState:function(){
		return{
			loadAddLog:false,
		}
	},
	onToggleForm:function(){
		this.setState({
			loadAddLog:!this.state.loadAddLog,
		});
	},
	render:function(){
		return(
			<div>
				<Loading/>
				<Head onToggleForm={this.onToggleForm}/>
				<Main loadAddLog={this.state.loadAddLog} onToggleForm={this.onToggleForm}/>
			</div>
		)
	}
})

var ReactCSSTransitionGroup = require('react-addons-css-transition-group');
 var Students = React.createClass({
   getInitialState: function() {
     return {
       students: ['amy', 'bob', 'tom', 'lucy']
     };
   },
   componentDidMount: function() {
     var self = this;
     var update = function() {
       self.setState({
         students: self.state.students.concat(["unamed-"+parseInt(Math.random()*10000000)])
       });
     }
     setInterval(update, 1000);
   },
   handleRemove: function(e) {
     var name = $(e.target).data("name");
     var index = 0;
     var students = this.state.students;
     for(var i=0;i<students.length;i++) {
       if(students[i] == name) index = i;
     }
     var state = this.state.students.splice(index, 1);
     this.setState({
       state: state
     });
   },
   render: function() {
     var s = this.state.students;
     var self = this;
     return (
       <div>
       <ReactCSSTransitionGroup transitionName="student" transitionEnterTimeout={10000} transitionLeaveTimeout={10000}>
       {
         s.map(function(d, i) {
           return <div className='student' key={d}>{d} <a onClick={self.handleRemove} data-name={d}>删除</a></div>
         })
       }
       </ReactCSSTransitionGroup>
       </div>
       );
   }
 });


module.exports = WorkLog;