//------------- Dashboard.js -------------//
$(document).ready(function() {

	//get object with colros from plugin and store it.
	var objColors = $('body').data('sprFlat').getColors();
	var colours = {
		white: objColors.white,
		dark: objColors.dark,
		red : objColors.red,
		blue: objColors.blue,
		green : objColors.green,
		yellow: objColors.yellow,
		brown: objColors.brown,
		orange : objColors.orange,
		purple : objColors.purple,
		pink : objColors.pink,
		lime : objColors.lime,
		magenta: objColors.magenta,
		teal: objColors.teal,
		textcolor: '#5a5e63',
		gray: objColors.gray
	}

	//------------- Add carouse to tiles -------------//
	$('.carousel-tile').carousel({
		interval:   6000
	});

	randNum = function(){
		return (Math.floor( Math.random()* (1+150-50) ) ) + 80;
	}

	//------------- Percentile Plot -------------//
	$(function() {

		var data=percentileplot;
		var d1 = [];
		for (var i = 0; i < data.length; i++)
		{
			var testtopic = percentileplot[i].exam.testtopic;
			var percentile = percentileplot[i].percentile;
			d1.push([testtopic,percentile]);
		}
    	var options = {
    		grid: {
				show: true,
			    aboveData: true,
			    color: colours.white ,
			    labelMargin: 20,
			    axisMargin: 0, 
			    borderWidth: 0,
			    borderColor:null,
			    minBorderMargin: 5 ,
			    clickable: true, 
			    hoverable: true,
			    autoHighlight: true,
			    mouseActiveRadius: 100,
			},
			series: {
				grow: {
		            active: true,
		     		duration: 1500
		        },
	            lines: {
            		show: true,
            		fill: false,
            		lineWidth: 2.5
	            },
	            points: {
	            	show:true,
	            	radius: 4,
	            	lineWidth: 2.5,
	            	fill: true,
	            	fillColor: colours.brown
	            }
	        },
	        colors: ['#fcfcfc'],
	        shadowSize:0,
	        tooltip: true, //activate tooltip
			tooltipOpts: {
				content: "%y.0%",
				// xDateFormat: "%d/%m",
				shifts: {
					x: -30,
					y: -50
				},
				theme: 'dark',
				defaultTheme: false
			},
			yaxis: { 
				min: 0,
				max: 100

			},
			xaxis: { 
	        	mode: "categories",
	        	tickLength: 0,
	            
	        }
    	}

		var plot = $.plot($("#percentile-plot"),[{
    			data: d1,
    		}], options
    	);

	});
	//------------- Donut chart -------------//
	$(function () {
		var options = {
			series: {
				pie: { 
					show: true,
					innerRadius: 0.55,
					highlight: {
						opacity: 0.1
					},
					radius: 1,
					stroke: {
						width: 10
					},
					startAngle: 2.15
				}					
			},
			legend:{
				show:true,
				labelFormatter: function(label, series) {
				    return '<div style="font-weight:bold;font-size:15px;">'+ label +'</div>'
				},
				labelBoxBorderColor: null,
				margin: 50,
				width: 20,
				padding: 2
			},
			grid: {
	            hoverable: true,
	            clickable: true,
	        },
	        tooltip: true, //activate tooltip
			tooltipOpts: {
				content: "%s : %y.1"+"%",
				shifts: {
					x: -30,
					y: -50
				},
				theme: 'dark',
				defaultTheme: false
			}
		};
		data = accuracystats.Overall;
		console.log(data);
	    $.plot($("#donut-chart-Overall"), data, options);

	});
	
});

$plotdonut = function (data,id) {
	var objColors = $('body').data('sprFlat').getColors();
	var colours = {
		white: objColors.white,
		dark: objColors.dark,
		red : objColors.red,
		blue: objColors.blue,
		green : objColors.green,
		yellow: objColors.yellow,
		brown: objColors.brown,
		orange : objColors.orange,
		purple : objColors.purple,
		pink : objColors.pink,
		lime : objColors.lime,
		magenta: objColors.magenta,
		teal: objColors.teal,
		textcolor: '#5a5e63',
		gray: objColors.gray
	}
		var options = {
			series: {
				pie: { 
					show: true,
					innerRadius: 0.55,
					highlight: {
						opacity: 0.1
					},
					radius: 1,
					stroke: {
						width: 10
					},
					startAngle: 2.15
				}					
			},
			legend:{
				show:true,
				labelFormatter: function(label, series) {
				    return '<div style="font-weight:bold;font-size:15px;">'+ label +'</div>'
				},
				labelBoxBorderColor: null,
				margin: 50,
				width: 20,
				padding: 2
			},
			grid: {
	            hoverable: true,
	            clickable: true,
	        },
	        tooltip: true, //activate tooltip
			tooltipOpts: {
				content: "%s : %y.1"+"%",
				shifts: {
					x: -30,
					y: -50
				},
				theme: 'dark',
				defaultTheme: false
			}
		};
	    $.plot($("#donut-chart-"+id), data, options);

	};