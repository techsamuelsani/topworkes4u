(function($){
	$('.accordion').xmaccordion({
		startOn: 2,
		speed: 500
	});

	$('.pie-chart1').xmpiechart({
		width: 176,
		height: 176,
		percent: 24,
		fillWidth: 8,
		gradient: true,
		gradientColors: ['#ff6589', '#f92552'],
		speed: 2,
		outline: true,
		linkPercent: '.percent'
	});

	/*-----------------
		COUNTDOWN
	-----------------*/	


})(jQuery);