var React = require('react');
var ReactDOM = require('react-dom');
var $ = require('jquery');

/*添加日志*/
module.exports = React.createClass({
	getInitialState:function(){
		return {
			difficulty: [],
			classification:[],
			trueBtnIsVisible: false,
		}
	},
	componentDidMount:function(){
		if (this.isMounted()) {
			this.setState({
				difficulty : [{'name':'狼','click':'on'},{'name':'虎','click':'off'},{'name':'鬼','click':'off'},{'name':'龙','click':'off'},{'name':'神','click':'off'}],
				classification : [{'name':'功能','click':'on'},{'name':'BUG','click':'off'}],
			})
		};
	},
	handleChooseDfct:function(index){
		var difficulty = this.state.difficulty;
		difficulty.map(function(elem, num) {
			if(num == index){
				difficulty[num]['click'] = 'on';
			}else{
				difficulty[num]['click'] = 'off';
			}
		})
		this.setState({
			difficulty:difficulty,
		})
	},
	/*选择类型*/
	handleChooseType:function(index){
		var classification = this.state.classification;
		classification.map(function(elem, num) {
			if(num == index){
				classification[num]['click'] = 'on';
			}else{
				classification[num]['click'] = 'off';
			}
		})
		this.setState({
			classification:classification,
		})
	},
	/*随着内容的输入显示确定按钮*/
	handleShowTrueBtn:function(e){
		var con = e.target.value;
		var re;
		if(con != ''){
			re = true;
		}else{
			re = false;
		}
		this.setState({
			trueBtnIsVisible : re,
		})
	},
	/*确认提交*/
	handleSubmit:function(){
		var content = ReactDOM.findDOMNode(this.refs.content).value;
		var difficulty = 0;
		var type = 0;
		this.state.difficulty.map(function(item,index){
			if(item['click'] == 'on'){
				difficulty = index + 1;
			}
		}.bind(this));
		this.state.classification.map(function(item,index){
			if(item['click'] == 'on'){
				type = index + 1;
			}
		}.bind(this));
		if(difficulty == 0 || type == 0){
			alert('难度或类别选择出错！');
			return;
		};
		// $.ajax({
		// 	url:"/work_log/index.php?m=Home&c=WorkLog&a=addlogs",
		// 	data:{content:content,difficulty:difficulty,type:type},
		// 	dataType:'json',
		// 	success:function(data){
		// 		console.log(data);
		// 		if(data.status==1){
					
		// 		}else{
		// 			console.log("添加日志出错");
		// 		}
		// 	}
		// });
	},
	render:function(){
		var addshow={
			display: this.props.LogAddIsVisible ? 'block' : 'none',
		};
		/*选择难度*/
		var difficultyList = [];
		this.state.difficulty.map(function(item,index){
			difficultyList.push(
				<span key={'difficulty-nums' + index} className={item.click} onClick={this.handleChooseDfct.bind(this,index)}>{item.name}</span>
			)
		}.bind(this));
		/*选功能*/
		var classification = [];
		this.state.classification.map(function(item,index){
			classification.push(
				<span key={'add-log-type' + index} className={item.click} onClick={this.handleChooseType.bind(this,index)}>{item.name}</span>
			)
		}.bind(this));
		/*确定按钮是否显示*/
		var truebtnshow = {
			display : this.state.trueBtnIsVisible ? 'inline-block' : 'none',
		};
		return (<div><div id="calendar-mask" style={addshow}></div>
			<div id="add-log" style={addshow}>
			<div className="add-log-box">
				<p className="difficulty-nums">
					{difficultyList}
				</p>
				<p className="add-log-type">
					{classification}
				</p>
				<p className="add-log-content">
					<textarea ref="content" onKeyUp={this.handleShowTrueBtn}></textarea>
				</p>
				<p className="add-log-button">
					<button style={truebtnshow} onClick={this.handleSubmit}>确认</button>
					<button onClick={this.props.onToggleForm}>取消</button>
				</p>
			</div>
			</div></div>);
	}
})