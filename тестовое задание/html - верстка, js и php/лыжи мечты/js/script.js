$(document).ready(function() {
	
	/* geography block */
	$('.b-geo-list > li > a').click(function() {
		if (!($(this).hasClass('active')))
		{
				$(this).addClass('active');
				$(this).parent().find(' > ul').slideDown(200);
				return false;
			
		}
		else {
				$(this).removeClass('active');
				$(this).parent().find(' > ul').slideUp(200);
				return false;
		}
	});

	$('.b-geo-list > li > ul > li > a').click(function() {
		if (!($(this).hasClass('active')))
		{
				$(this).addClass('active');
				$(this).parent().find(' > .b-inner').slideDown(200);
				return false;
			
		}
		else {
				$(this).removeClass('active');
				$(this).parent().find(' > .b-inner').slideUp(200);
				return false;
		}
	});

	

	/* tabs */
	$('.b-ntabs').tabs();
	
	/* qtip hover popups */
	$('.b-program-top a').each(function() {
         $(this).qtip({
             content: {
                 text: $('.b-program-top-popup')
             },
			 position: {
				my: 'top center',  
				at: 'bottom center',
				adjust: {
					y: 2
				}
			}
         });
     });

	 $('.b-soc-list .b-link-fb').each(function() {
         $(this).qtip({
             content: {
                 text: $('.b-fb-popup')
             },
			 position: {
				my: 'top center',  
				at: 'bottom center',
				adjust: {
					y: -5
				}
			}
         });
     });

	 

	/* placeholder */
	$('input[placeholder], textarea[placeholder]').focus(function() {
	  var input = $(this);
	  if (input.val() == input.attr('placeholder')) {
		input.val('');
		input.removeClass('placeholder');
	  }
	}).blur(function() {
	  var input = $(this);
	  if (input.val() == '' || input.val() == input.attr('placeholder')) {
		input.addClass('placeholder');
		input.val(input.attr('placeholder'));
	  }
	}).blur();

	
	/* input highlight */
	$('.b-inp input, .b-tarea textarea').focus(function() {
	  $(this).parent().addClass('i-light');
	}).blur(function() {
	  $(this).parent().removeClass('i-light');
	}).blur();

	
	/*textarea*/
	autosize($('textarea'));
	

	/* select */
	$('.b-select').select2({
		dropdownCssClass: 'b-sel-drop',
		language: 'ru'
	});


	
	/* cycle slider plugin */
	$('.b-sdig-slider').after('<div class="b-sdig-prev"></div><div class="b-sdig-next"></div>').cycle({ 
		prev: '.b-sdig-prev',
		next: '.b-sdig-next',
		allowWrap: false,
		slides: '> .b-sdig-slide',
		fx: 'scrollHorz',
		timeout: 0
	});

	$('.b-mn-slider').after('<div class="b-mns-pager"></div>').cycle({ 
		pager: '.b-mns-pager',
		slides: '> .b-mn-slide',
		fx: 'fade',
		timeout: 0
	});

	
	$('#bntab1 .b-news-slider').after('<div class="b-news-pager"></div>').cycle({ 
		pager: '#bntab1 .b-news-pager',
		slides: '> .b-news-slide',
		fx: 'scrollHorz',
		timeout: 0
	});
	
	$('#bntab2 .b-news-slider').after('<div class="b-news-pager"></div>').cycle({ 
		pager: '#bntab2 .b-news-pager',
		slides: '> .b-news-slide',
		fx: 'scrollHorz',
		timeout: 0
	});
	

	
	/* jcarousel */
	$('#jc').jcarousel({
            interval: 0,
            target: '+=1',
            autostart: false
        });
	
	$('.wrap-j-car .jcarousel-prev').click(function() {
		$('#jc').jcarousel('scroll', '-=1');
	});

	$('.wrap-j-car .jcarousel-next').click(function() {
		$('#jc').jcarousel('scroll', '+=1');
	});

	
	/* fancybox */
	$('.pop-link').fancybox({
		padding : 0,
		margin : 0,
		prevEffect	: 'none',
		nextEffect	: 'none'
	});

	$('.b-fancy-photo').fancybox({
		padding : 0,
		margin : 0,
		prevEffect	: 'none',
		nextEffect	: 'none'
	});
	

	$('.breg-car li a').click(function() {
		if (!($(this).hasClass('breg-p-active')))
		{
				$('.breg-car li a').removeClass('breg-p-active');
				var newpic = $(this).attr('href');
				$('#brb-pic').attr('src',newpic);
				$(this).addClass('breg-p-active');
				return false;
			
		}
		else {
				return false;
		}
	});
	
	

	/* datepicker */
	$.datepicker.regional['ru'] = {
        closeText: 'Закрыть',
        prevText: '',
        nextText: '',
        currentText: 'Сегодня',
        monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
	        'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
	        monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
	        'Июл','Авг','Сен','Окт','Ноя','Дек'],
	        dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
	        dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
	        dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
	        weekHeader: 'Нед',
	        dateFormat: 'dd.mm.yy',
	        firstDay: 1,
	        isRTL: false,
	        showMonthAfterYear: false,
	        yearSuffix: ''};
    $.datepicker.setDefaults($.datepicker.regional['ru']);
	$('.b-datepicker').datepicker({ showOtherMonths: true});
	
	
	$('.nav ul li').each( function() {
		if ($(this).find('ul').length != 0)
		{
			$(this).addClass('is-parent');
		}
	});
	$('.nav ul li.is-parent').hover(function() {
			$(this).addClass('nav-hover-li');
			$(this).find('a:first').addClass('nav-hover');
			$(this).find('.submenu').show();
		}, function(){
			$(this).removeClass('nav-hover-li');
			$(this).find('a:first').removeClass('nav-hover');
			$(this).find('.submenu').hide();
	});


});

