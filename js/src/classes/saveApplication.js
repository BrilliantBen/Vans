module.exports = (function(){

	var HeaderApplication = require('./headerApplication');
	var PaintingSettings = require('./PaintingSettings');
	var Moment = require('./Moment.js');

	var url = "10px";
	var secondUrl = "50px";


	function SaveApplication($el, large) {
		this.large = large;
		this.$el = $el;

		//if only header app
		if(this.large === undefined){
			this.HeaderApplication = new HeaderApplication(this.$el.find('canvas#cnvs'));
			this.$el.on('mouseup', this.uploadHandler.bind(this));
			this.$el.on('mousedown', this.uploadHandler.bind(this));
			// this.$el.on('mouseleave', this.uploadHandler.bind(this));
		}
		//if also drawing app
		else {
			this.appSetup();

		}

		this.$el.on('mousedown', this.backgroundHandler.bind(this));
	}

	SaveApplication.prototype.appSetup = function() {
		this.MainApplication = new HeaderApplication(this.$el.find('canvas#canvas'), "large");
		this.PaintingSettings = new PaintingSettings(this.$el.find('.settings'));
		$($('canvas')).addClass('move');

		//bean settings events
		bean.on(this.PaintingSettings, "color", this.colorChanger.bind(this));
		bean.on(this.PaintingSettings, "stroke", this.strokeChanger.bind(this));

		//save&clear
		$('.save').on('click', this.uploadHandler.bind(this));
		$('.clear').on('click', this.clearHandler.bind(this));
	};

	SaveApplication.prototype.backgroundHandler = function() {
		var canvas = this.$el.find('canvas')[0];
		canvas.style.backgroundImage = "none";
	};

	SaveApplication.prototype.colorChanger = function( color ) {
		$($('.colorActive')[0]).removeClass('colorActive');
		$(color).addClass('colorActive');

		var rgb = $(color).attr('class').split(' ')[0];
		this.MainApplication.activeColor = rgb;
	};

	SaveApplication.prototype.clearHandler = function( color ) {
		//seems to work fine
		this.MainApplication = new HeaderApplication(this.$el.find('canvas#canvas'), "large");
		this.PaintingSettings = new PaintingSettings(this.$el.find('.settings'));
		this.MainApplication.activeColor = $('.colorActive').attr('class').split(' ')[0];
		this.MainApplication.strokeWidth = $('.select').attr('class').split(' ')[0];
	};

	SaveApplication.prototype.strokeChanger = function( stroke ) {
		$($('.select')[0]).removeClass('select');
		$(stroke).addClass('select');

		var width = $(stroke).attr('class').split(' ')[0];
		this.MainApplication.strokeWidth = width;
	};

	SaveApplication.prototype.uploadHandler = function($el) {
		var dataURL = this.$el.find('canvas')[0].toDataURL();
		var hasClass = $($el.currentTarget).attr('class');

		$.post("index.php?page=save", {
			image: dataURL,
			class: hasClass,
		})
		.success( function ( respond ) {
			if(hasClass === "save"){
			var $el = $(respond);
			$('#inhoud').replaceWith($el.find('#inhoud'));
			this.Moment = new Moment();
			$('html, body').animate({ scrollTop: $(document).height() }, 'slow');
		}


		})
		.fail ( function ( respond ) {
			console.log(respond);
		});
	};

	return SaveApplication;

})();
