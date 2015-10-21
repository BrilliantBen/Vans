module.exports = (function(){

	function HeaderApplication($el, large) {
		this.large = large;
		this.$el = $el;

		this.$scope = new paper.PaperScope();
		//switch contexts
		if(this.large === undefined){
			this.$scope.setup('cnvs');
			this.$view_1 = this.$scope.View._viewsById['cnvs'];
			this.$view_1._project.activate();
			this.centerPoint = new this.$scope.Point(37, 238);
			//random colors
			var back = ["rgb(56,122,239)","rgb(245,63,125)","rgb(80,42,117)","rgb(206,19,36)", "rgb(60,172,33)","rgb(23,71,143)" ];
  			var rand = back[Math.floor(Math.random() * back.length)];
			this.activeColor = rand;
		}
		else{
			this.$scope.setup('canvas');
			this.$view_2 = this.$scope.View._viewsById['canvas'];
			this.$view_2._project.activate();
			this.centerPoint = new this.$scope.Point(345, 222);
			this.activeColor = "rgb(0,0,0)";

		}

		this.strokeWidth = 3;
		this.topShoeData = '';

		tool = new this.$scope.Tool();
		tool.on('mousedown', this.mouseDownHandler.bind(this));
		tool.on('mousedrag', this.mouseDragHandler.bind(this));

		this.makePaths();
		this.group = new this.$scope.Group(this.topShoePath);
		this.group.clipped = true;
	}

	HeaderApplication.prototype.makePaths = function() {
		if(this.large === undefined){
		this.topShoeData = 'M424.276,98.883c-7.333-23.664-14.667-47.336-22-71c-6.747-1.213-15.205-1.345-21.917-0.792L380.192,0L0.526,6.883l24.75,486.625l246.375-25.25l-9.081-19.544c1.931-9.819,12.836-9.52,23.706-11.831c7.895-1.679,15.677-5.3,21-6c7.847,5.058,14.607,10.068,12,20c3.666-0.333,6.334,0.333,10,0c0.536-0.924,2.979-0.925,3-2c0.383-19.744-2.372-44.774-4-62c-0.372-3.933-0.038-8.001,0-12c0.492-51.333-1.041-101.089-42-118c-6.76-2.791-14.865-2.694-24,0c-33.719,17.828-35.718,42.442-41,73c-0.933,5.4,0.189,12.823-1,19c-0.965,5.015-3.154,16.221-1,24c3.039,10.973,4.355,22.638,8,34c3.116,9.711,5.801,22.635,9,32c2.008,5.876,5.362,4.459,6,14c6.666,0,13.334,0,20,0c-0.022-0.606-0.012-1.175,0.013-1.728l0.987,1.728l8,15l-239,24.75L1.526,10.883l378.75-8v24.351c-15.226,1.519-29.395,6.508-38.719,10.615c-3.517,1.549-6.345,2.972-8.281,4.034c-5.371-3.485-9.932-7.061-11-15c-4,0-10-1-14-1c-0.124,12.322-0.36,26.884,2,43c1.458,9.955,5.698,30.513,3,41c-2.771,10.769,1.464,35.497,6,52c8.942,32.531,26.509,56.322,57,53c15.428-1.681,27.787-13.639,36-34C420.945,159.391,424.814,129.359,424.276,98.883z';
		this.topShoePath = this.topPathMaker(this.topShoeData);
		}

		else{
		this.topShoeData = 'M16.791,215.338c7.958,12.41,17.572,26.918,36.209,29.75c46.741,7.102,92.863-7.708,131-16c55.37-12.039,113.403-17.014,168-27c18.331-0.667,36.668-1.333,55-2c42.735-7.696,79.952-22.003,110-43c42.109-29.425,47.258-98.897,9-125c-40.769-27.816-98.584-32.859-165-32c-7.666,0.667-15.334,1.333-23,2c-8.018,1.897-11.035,6.585-25,9c-9.248,1.6-20.395,5.012-28,8c-25.187,9.896-54.842,23.119-78,36c-31.33,9.999-62.67,20.001-94,30c-55.156,17.332-108.984,20.76-113,112c6.205,1.836,10.836,8.957,16.117,17.198l0.492-0.386c0,0,10.099-7.312,11.016-7.813c-0.888-0.785-1.731-1.589-2.526-2.41c-12.153-12.562-13.22-29.3,1.901-46.589c28.149-32.185,91.297-61.756,117-69c25.703-7.245,51.721,5.069,63,10c3.915,1.305,7.393,2.465,13,6c0.823,11.769,16.576,59.147,27,67c-8.421,40.828-124.386,59.114-173,53c-14.978-1.884-27.791-5.991-37.549-11.69c-2.895-1.691-5.521-3.522-7.855-5.476C28.031,207.463,16.791,215.338,16.791,215.338z';
		this.topShoePath = this.topPathMaker(this.topShoeData);
		}
	};

	HeaderApplication.prototype.topPathMaker = function( data ) {
		var topPath = new this.$scope.Path( data );
		topPath.position = this.centerPoint;
		return topPath;
	};

	HeaderApplication.prototype.mouseDownHandler = function( e ) {
		this.prevPoint = e.point;
		this.makePath( e.point );
	};


	HeaderApplication.prototype.makePath = function( point ) {
		this.path = new this.$scope.Path();
		this.path.strokeColor = this.activeColor;
		this.path.opacity = 0.7;
		this.path.strokeWidth = this.strokeWidth;
		this.path.name = 'path';
		this.path.add(point);
		this.group.addChild(this.path);
	};

	HeaderApplication.prototype.map = function( value, low1, high1, low2, high2 ) {
		return parseInt(low2 + (value - low1) * (high2 - low2) / (high1 - low1));
	};

	HeaderApplication.prototype.dist = function( x1, y1, x2, y2 ) {
		return parseInt(Math.sqrt(Math.pow((x1 - x2), 2) + Math.pow((y1 - y2), 2)));
	};

	HeaderApplication.prototype.mouseDragHandler = function( e ) {
		this.path.add( e.point );
	};

	return HeaderApplication;

})();
