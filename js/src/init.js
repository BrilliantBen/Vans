(function(){

	fallback.load({
		jQuery: [
			'//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js',
			'js/vendor/jquery/dist/jquery.min.js'
		],
		'paper': [
			'//cdnjs.cloudflare.com/ajax/libs/paper.js/0.9.18/paper-full.min.js',
			'js/vendor/paper/dist/paper-full.min.js'
		],
		'bean': [
			'//cdnjs.cloudflare.com/ajax/libs/bean/1.0.15/bean.min.js',
			'js/vendor/bean/bean.min.js'
		],
		'moment': [
			'//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js',
			'js/vendor/moment/moment.min.js'
		]
	});

	fallback.ready(function () {
			var saveApplication = require('./classes/saveApplication.js');
			var Moment = require('./classes/Moment.js');
			var Validation = require('./classes/Validation.js');
			var Navigation = require('./classes/Navigation.js');

		function init () {

			this.$play = $('.play');
			this.$pause = $('.pause');
			this.$video = $('.promo');

			this.$app = $('.app');
			this.$practice = $('.practice');
			this.$colors = $('.color');
			this.$stroke = $('.stroke');
			this.$uploadForm = $('.uploadform');
			this.$searchForm = $('.searchform');


			//check video
			if(this.$video[0] !== undefined){
				if(this.$video[0].canPlayType('video/mp4; codecs="avc1.4D401E, mp4a.40.2"')){
					this.$video[0].setAttribute('src', 'assets/video/video.mp4');
				}
				else {
				this.$video[0].setAttribute('src', 'assets/video/video.webm');
				}

				this.$play.on('click', playHandler);
				this.$pause.on('click', pauseHandler);
			}

			//check page
			if(this.$uploadForm[0] !== undefined){
				this.validateForm = new Validation(this.$uploadForm[0]);
				this.gallery = new Navigation(this.$searchForm[0]);
				  $('#ajaxSpinner').hide();
			}

			if(this.$practice[0] !== undefined) {
				new saveApplication(this.$practice, "large");
				this.Moment = new Moment();
			}

			//save header/practice
			this.$header = new saveApplication(this.$app);
		}

		function playHandler(){
			$('.promo')[0].play();
		}

		function pauseHandler(){
			$('.promo')[0].pause();
		}

		init();

	});

})();
