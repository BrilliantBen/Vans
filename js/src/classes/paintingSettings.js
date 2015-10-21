module.exports = (function(){

	function PaintingSettings($el) {

		this.$el = $el;
		this.$colors = $('.color li');
		this.$stroke = $('.stroke li');

		//click events
		this.$colors.on('click', this.colorHandler.bind(this));
		this.$stroke.on('click', this.strokeHandler.bind(this));
	}

	PaintingSettings.prototype.strokeHandler = function( e ) {
		e.preventDefault();
		bean.fire(this, "stroke", e.target);
	};

	PaintingSettings.prototype.colorHandler = function( e ) {
		e.preventDefault();
		bean.fire(this, "color", e.target);
	};

	return PaintingSettings;

})();
