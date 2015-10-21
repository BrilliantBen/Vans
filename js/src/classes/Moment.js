module.exports = (function(){

	function Moment() {
		this.$dates = $('#inhoud p');
		this.$dateArr = [];
		this.$times = [];

		for(var i = 0; i< this.$dates.length; i++){
			this.$split = this.$dates[i].innerHTML.split(/-|:| /);
			this.$dateArr.push(this.$split);
		}

		for(var y = 0; y<this.$dateArr.length; y++){
			this.$dateArr[y][0] = parseInt(this.$dateArr[y][0]);
			this.$dateArr[y][1] = parseInt(this.$dateArr[y][1])-1;
			this.$dateArr[y][2] = parseInt(this.$dateArr[y][2]);
			this.$dateArr[y][3] = parseInt(this.$dateArr[y][3]);
			this.$dateArr[y][4] = parseInt(this.$dateArr[y][4]);
			this.$dateArr[y][5] = parseInt(this.$dateArr[y][5]);
			var now = moment(this.$dateArr[y]).fromNow();
			this.$times.push(now);
		}

		this.$p = $('#inhoud p');
		this.$p[0].innerHTML = this.$times[0];
		this.$p[1].innerHTML = this.$times[1];
		this.$p[2].innerHTML = this.$times[2];
	}

	return Moment;

})();
