function showImg(url,style,w) {
    var frameid = 'frameimg' + Math.random();
    // console.log(style);
    // console.log(w);
    // console.debug(frameid);

    // console.debug(url);

    window.img = '<body style="margin:0"><img id="img" style="width:100%" src="' + url + '?' + Math.random() + '" /><script>window.onload = function() { parent.document.getElementById(\'' + frameid + '\').height = document.getElementById(\'img\').height+\'px\'; }<' + '/script></body>';
    var str = '<iframe id="' + frameid + '" src="javascript:parent.img;" frameBorder="0" scrolling="no" style="width:100%; max-width:'+w+'px; '+style+'"></iframe>';
    //document.write('<iframe id="' + frameid + '" src="javascript:parent.img'+frameid+';" frameBorder="0" scrolling="no" width="50%"></iframe>');
    return str;
}