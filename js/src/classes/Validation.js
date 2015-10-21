module.exports = (function(){
			var Navigation = require('./Navigation.js');

	function Validation($el) {
		this.$el = $el;
		this.$check = true;
		this.$email = $("input[name=email]");
		this.$maat = $("select[name=maat]");
		this.$afbeelding =$("input[name=image]");
		this.$all = $('#uploadform img');
		this.$up = $('.up')[0];

		//events
		this.$email.on("blur keyup", this.check.bind(this));
		this.$maat.on("change", this.check.bind(this));
		this.$afbeelding.on("change", this.check.bind(this));
		$("#uploadform").on("submit", this.submitHandler.bind(this));

	}


	Validation.prototype.check = function( e ) {
		$($('.info')[0]).addClass('hidden');
		this.attribute= e.currentTarget.getAttribute('name');

		if(this.attribute === "email"){
			this.checkEmail(e.currentTarget);
		}

		else if(this.attribute === "maat"){
			this.checkMaat(e.currentTarget);
		}

		else if(this.attribute === "image"){
			this.checkImage(e.currentTarget);
		}

	};

	Validation.prototype.checkEmail = function( val ) {
		this.image= $(val).parent().parent().parent().find('img.' + $(val).attr('name'));
		var regExp = new RegExp("^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$");

		if (regExp.test($(val).val())){
			this.setCorrect();
			return true;
		}
		else {
			this.setIncorrect();
			return false;
			}
		};


	Validation.prototype.checkMaat = function (val){
		this.$up.innerHTML = this.$maat.val();

		this.image= $(val).parent().parent().parent().find('img.' + $(val).attr('name'));
		if ($(val).val() > 37 || $(val).val()< 47){
			this.setCorrect();
			return true;
		}
			else {
			this.setIncorrect();
			return false;
		}
	};

	Validation.prototype.checkImage = function (val) {
		this.image= $(val).parent().parent().parent().find('img.' + $(val).attr('name'));
		var ext = $(val).val().split('.').pop().toLowerCase();

		if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
			this.setIncorrect();
			return false;
		}
		else {
			this.setCorrect();
			return true;
			}
		};

	Validation.prototype.setCorrect = function( e ) {

	$(this.image[0]).removeClass("hidden");
	this.image[0].setAttribute('src', 'assets/styling/gallery/check.png');
	return true;
	};

	Validation.prototype.setIncorrect = function( e ) {
				$(this.image[0]).removeClass("hidden");

				this.image[0].setAttribute('src', 'assets/styling/gallery/nocheck.png');
				return false;
	};

	Validation.prototype.submitHandler = function( e ) {
		$($('.info')[0]).addClass('hidden');
		this.checkMaat(this.$maat[0]);

		if((this.checkEmail(this.$email[0]) === true) & (this.checkImage(this.$afbeelding[0]) === true)){
			e.preventDefault();
			this.handlePost(this);
		}
		else {
			e.preventDefault();
		}


	};


	Validation.prototype.handlePost = function( e ) {

		var email = this.$email.val();
		var imageName = this.$afbeelding[0].files[0].name;
		var imageLocation = this.$afbeelding.val();
		var maat = this.$maat.val();

		var file = $('input[type=file]')[0].files[0];
		var files = [];
		var reader = new FileReader();

   		reader.onload = function(event) {
      		object = {};
      		object.filename = file.name;
      		object.data = event.target.result;
    		var result= reader.result;
			var formData = new FormData();

		 	formData.append('imageName', imageName);
		 	formData.append('image', result);
			formData.append('upload', "upload");
			formData.append('email', email);
			formData.append('imageName', imageName);
			formData.append('maat', maat);

			var redirect = document.URL;
			redirect = redirect.split("index.php?");

  			$.ajax({
          	  	url: "index.php?"+redirect[1],
           	 	type: "POST",
           	 	data: formData,
           	 	async: true,
            	success: function (msg) {

            		var $el = $(msg);
					var $content = $el.get(0);
					console.log($el.find('.gallery'));
					$('.gallery').replaceWith($el.find('.gallery'));
			 		$("#uploadform").each( function() { this.reset(); });

					$('#uploadform img').each( function() {
					this.setAttribute('src', 'assets/styling/gallery/nocheck.png');
					this.classList.add("hidden");
			 		});

					$('.up')[0].innerHTML = $("select[name=maat]").val();
					$($('.info')[0]).removeClass('hidden');
					this.gallery = new Navigation($('.searchform')[0]);

           		}.bind(this),

  				contentType: false,
				cache: false,
				processData:false,
        	});
   		};

		reader.readAsDataURL(file);
	};

	return Validation;

})();

