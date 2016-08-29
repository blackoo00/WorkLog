<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="<?php echo (WORK_LOG); ?>/fonts/style.css">
	<link rel="stylesheet" href="<?php echo (WORK_LOG); ?>/css/reactindex.css">
	<script src="<?php echo (WORK_PUBLIC); ?>/react/react.js"></script>
	<script src="<?php echo (WORK_PUBLIC); ?>/react/react-dom.js"></script>
	<script src="<?php echo (WORK_PUBLIC); ?>/react/browser.min.js"></script>
</head>
<body>
	<div id="app">
		
	</div>
</body>
</html>
<script type="text/babel">
		var ReactCSSTransitionGroup = require('react-addons-css-transition-group');

		var TodoList = React.createClass({
		  getInitialState: function() {
		    return {items: ['hello', 'world', 'click', 'me']};
		  },
		  handleAdd: function() {
		    var newItems =
		      this.state.items.concat([prompt('Enter some text')]);
		    this.setState({items: newItems});
		  },
		  handleRemove: function(i) {
		    var newItems = this.state.items.slice();
		    newItems.splice(i, 1);
		    this.setState({items: newItems});
		  },
		  render: function() {
		    var items = this.state.items.map(function(item, i) {
		      return (
		        <div key={item} onClick={this.handleRemove.bind(this, i)}>
		          {item}
		        </div>
		      );
		    }.bind(this));
		    return (
		      <div>
		        <button onClick={this.handleAdd}>Add Item</button>
		        <ReactCSSTransitionGroup transitionName="example" transitionEnterTimeout={500} transitionLeaveTimeout={300}>
		          {items}
		        </ReactCSSTransitionGroup>
		      </div>
		    );
		  }
		});
		var formApp = ReactDOM.render(
			<TodoList/>,
			document.getElementById('app')
		)
	</script>