module.exports = (function(){

	function Navigation($el) {

		this.$schoen = $("select[name=schoen]");
		$($('.gobtn')[0]).addClass('hidden');

		//bind actions
		this.bindHandler(this);

		//update gallery
		this.$schoen.on("change", this.updateGallery.bind(this));
	}


Navigation.prototype.bindHandler = function (e){

	//remove Active class
	$($('.navActive')[0]).removeClass('navActive');

	//get active page number
	var url = document.URL;
	url = url.split("p=");
	url = url[1].split("&");
	url = url[0];

	//add active element
	var newNav = $(".pag:contains('"+url+"')");
	if(newNav[0] !== undefined){
		$(newNav[0]).addClass('navActive');
	}

	//bind clicks
	$('.pagination a').on('click', this.updateGallery.bind(this));
};


Navigation.prototype.updateGallery = function( e ) {
	e.preventDefault();

	//get size of gallery
	$('.sec')[0].innerHTML = this.$schoen.val();
	this.$size = parseInt($('.sec')[0].innerHTML);

	//set size as p-element.
	if($.isNumeric(e.currentTarget.innerHTML)){
		this.$p = e.currentTarget.innerHTML;
	}

	else{
		this.$p = 1;
	}

	//if no size, p = 1.
	if(this.$p === ""){
		this.$p=1;
	}

	// push state url
	var url = "index.php?page=gallery&p="+this.$p+"&size="+this.$size;


	$.ajax({
   	 	url: 'index.php?page=gallery',
    	type: 'GET',

    	data: {
    		p: this.$p,
			size: this.$size,
			search: "search"
		},
   		 beforeSend: function() {
      		  $('#ajaxSpinner').show();
    		},

   		 complete: function() {
    		    $('#ajaxSpinner').hide();
    		},

    		success: function(respond) {
				if(window.history.pushState){
					window.history.pushState('','', url);
				}

				var $el = $(respond);
				var $content = $el.get(0);
				$('.gallery').replaceWith($el.find('.gallery'));
				$("select[name=schoen]").val(''+this.$size+'');

				//rebind clicks
				this.bindHandler(this);
    		}.bind(this),

    		fail: function(respond){
    	console.log(respond);
    		}
		});
   	};

	return Navigation;

})();

