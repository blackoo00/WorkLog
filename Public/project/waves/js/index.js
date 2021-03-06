function SiriWave(opt){
	this.opt = opt || {};

	this.K = 1;
	this.F = 6;
	this.speed = this.opt.speed || 0.1;
	this.noise = this.opt.noise || 0;
	this.phase = this.opt.phase || 0;
	this.phase2 = this.opt.phase || 0;

	if (!devicePixelRatio) devicePixelRatio = 1;
	this.width = devicePixelRatio * (this.opt.width || 320);
	this.height = devicePixelRatio * (this.opt.height || 100);
	this.MAX = (this.height/2)-4;

	// this.canvas = document.createElement('canvas');
	this.canvas = document.getElementById('myCanvas');
	this.canvas.width = this.width;
	this.canvas.height = this.height;
	this.canvas.style.width = (this.width/devicePixelRatio)+'px';
	this.canvas.style.height = (this.height/devicePixelRatio)+'px';
	this.ctx = this.canvas.getContext('2d');

	this.run = false;
}

SiriWave.prototype = {

	_drawLine: function(attenuation, color, width){
		this.ctx.moveTo(0,0);
		this.ctx.beginPath();
		this.ctx.strokeStyle = color;
		this.ctx.lineWidth = width || 1;
		var x, y;
		for (var i=-this.K; i<=this.K + 1; i+=0.01) {
			x = this.width*((i+this.K)/(this.K*2));
			y = this.height/2 + this.noise * (1/attenuation) * Math.sin(this.F*i-this.phase);
			this.ctx.lineTo(x, y);
		}
		this.ctx.lineTo(x, 400);
		this.ctx.lineTo(0, 400);
		this.ctx.closePath();
		this.ctx.fillStyle = color;
		this.ctx.fill();
		this.ctx.stroke();
	},
	_drawLine2: function(attenuation, color, width){
		this.ctx.moveTo(0,0);
		this.ctx.beginPath();
		this.ctx.strokeStyle = color;
		this.ctx.lineWidth = width || 1;
		var x, y;
		for (var i=-this.K; i<=this.K + 1; i+=0.01) {
			x = this.width*((i+this.K)/(this.K*2));
			y = this.height/2 + this.noise * (1/attenuation) * Math.sin(this.F*i-this.phase2);
			this.ctx.lineTo(x, y);
		}
		this.ctx.lineTo(x, 400);
		this.ctx.lineTo(0, 400);
		this.ctx.closePath();
		this.ctx.fillStyle = color;
		this.ctx.fill();
		this.ctx.stroke();
	},

	_clear: function(){
		this.ctx.globalCompositeOperation = 'destination-out';
		this.ctx.fillRect(0, 0, this.width, this.height);
		this.ctx.globalCompositeOperation = 'source-over';
	},

	_draw: function(){
		if (!this.run) return;

		this.phase = (this.phase+this.speed)%(Math.PI*64);
		this.phase2 = (this.phase2+this.speed*2)%(Math.PI*64);
		this._clear();
		this._drawLine2(0.9, 'rgba(0,0,0,0.5)');
		this._drawLine(1, 'rgba(0,0,0,1)', 1.5);

		requestAnimationFrame(this._draw.bind(this), 1000);
	},

	start: function(){
		this.phase = 0;
		this.run = true;
		this._draw();
	},

	stop: function(){
		this.run = false;
		this._clear();
	},

	setNoise: function(v){
		this.noise = Math.min(v, 1)*this.MAX;
	},

	setSpeed: function(v){
		this.speed = v;
	},

	set: function(noise, speed) {
		this.setNoise(noise);
		this.setSpeed(speed);
	}

};

var SW = new SiriWave({
  width: window.innerWidth,
  height: 200
});
SW.setSpeed(0.03);
SW.start();

setInterval(function(){
  SW.setNoise(0.08);
}, 0);