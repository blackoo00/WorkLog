var React = require('react');
var LogList = require('./LogList');

module.exports = React.createClass({
	render:function(){
		return(
			<main><LogList source='/work_log/index.php?m=Home&c=WorkLog&a=getLogListByScroll'/></main>
		)
	}
})
