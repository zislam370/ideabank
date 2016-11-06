/* Remove Envato Frame */
if (window.location != window.parent.location)
	top.location.href = document.location.href;

(function($, window)
{

	// fix for safari back button issue
	window.onunload = function(){};

	$.expr[':'].scrollable = function( elem ) 
    {
      var scrollable = false,
          props = [ '', '-x', '-y' ],
          re = /^(?:auto|scroll)$/i,
          elem = $(elem);
      
      $.each( props, function(i,v){
        return !( scrollable = scrollable || re.test( elem.css( 'overflow' + v ) ) );
      });
      
      return scrollable;
    };

	window.beautify = function (source)
	{
		var output,
			opts = {};

	 	opts.preserve_newlines = false;
		output = html_beautify(source, opts);
	    return output;
	}

	// generate a random number within a range (PHP's mt_rand JavaScript implementation)
	window.mt_rand = function (min, max) 
	{
		var argc = arguments.length;
		if (argc === 0) {
			min = 0;
			max = 2147483647;
		}
		else if (argc === 1) {
			throw new Error('Warning: mt_rand() expects exactly 2 parameters, 1 given');
		}
		else {
			min = parseInt(min, 10);
			max = parseInt(max, 10);
		}
		return Math.floor(Math.random() * (max - min + 1)) + min;
	}

	// scroll to element animation
	function scrollTo(id)
	{
		if ($(id).length)
			$('html,body').animate({scrollTop: $(id).offset().top},'slow');
	}

	window.resizeNiceScroll = function()
	{
		if (typeof $.fn.niceScroll == 'undefined')
			return;

		setTimeout(function(){
			$('.hasNiceScroll, #menu').getNiceScroll().show().resize();
			if ($('.container-fluid').is('.menu-hidden'))
				$('#menu').getNiceScroll().hide();
		}, 100);
	}

	// $('#content .modal').appendTo('body');
	
	// tooltips
	$('body').tooltip({ selector: '[data-toggle="tooltip"]' });
	
	// popovers
	$('[data-toggle="popover"]').popover();
	
	// print
	$('[data-toggle="print"]').click(function(e)
	{
		e.preventDefault();
		window.print();
	});
	
	// carousels
	$('.carousel').carousel();
	
	// Google Code Prettify
	if ($('.prettyprint').length && typeof prettyPrint != 'undefined')
		prettyPrint();

	$('[data-toggle="scrollTo"]').on('click', function(e){
		e.preventDefault();
		scrollTo($(this).attr('href'));
	});

	$('ul.collapse')
	.on('show.bs.collapse', function(e)
	{
		e.stopPropagation();
		$(this).closest('li').addClass('active');
	})
	.on('hidden.bs.collapse', function(e)
	{
		e.stopPropagation();
		$(this).closest('li').removeClass('active');
	});

	window.enableContentNiceScroll = function(hide)
	{
		if ($('html').is('.ie') || Modernizr.touch)
			return;

		if (typeof $.fn.niceScroll == 'undefined')
			return;

		if (typeof hide == 'undefined')
			var hide = true;

		$('#content .col-app, .col-separator, .applyNiceScroll')
		.filter(':scrollable')
		.not('.col-unscrollable')
		.filter(function(){
			return !$(this).find('> .col-table').length;
		})
		.addClass('hasNiceScroll')
		.each(function()
		{
			$(this).niceScroll({
				horizrailenabled: false,
				zindex: 2,
				cursorborder: "none",
				cursorborderradius: "0",
				cursorcolor: primaryColor
			});

			if (hide == true)
				$(this).getNiceScroll().hide();
			else
				$(this).getNiceScroll().resize().show();
		});
	}

	window.disableContentNiceScroll = function()
	{
		$('#content .hasNiceScroll').getNiceScroll().remove();
	}

	enableContentNiceScroll();

	if ($('html').is('.ie'))
		$('html').removeClass('app');

	if (typeof $.fn.niceScroll != 'undefined')
	{
		$('#menu > div')
		.add('#menu_kis > div')
		.addClass('hasNiceScroll')
		.niceScroll({
			horizrailenabled: false, 
			zindex: 2,
			cursorborder: "none",
			cursorborderradius: "0",
			cursorcolor: primaryColor
		}).hide();
	}

	if ($('#sidebar-discover-wrapper.mini').length)
		$('body').addClass('sidebar-discover-mini');

	if (typeof coreInit == 'undefined')
	{
		$('body')
		.on('mouseenter', '.navbar.main [data-toggle="dropdown"]', function()
		{ 
			if (!$(this).parent('.dropdown').is('.open'))
				$(this).click();
		});
	}
	else {
		$('[data-toggle="dropdown"]').dropdown();
	}

	$('.navbar.main')
	.on('mouseleave', function(){
		$(this).find('.dropdown.open').find('> [data-toggle="dropdown"]').click();
	});

	$('[data-height]').each(function(){
		$(this).css({ 'height': $(this).data('height') });
	});

	$('.app [data-toggle="tab"]')
	.on('shown.bs.tab', function(e)
	{
		$('.hasNiceScroll').getNiceScroll().resize();
	});

	$(window).setBreakpoints({
		distinct: false,
		breakpoints: [ 768, 992 ]
	});

	$(window).bind('exitBreakpoint768',function() {		
		$('.container-fluid').addClass('menu-hidden');
        $("#top-menu").collapse('toggle');
	});

	$(window).bind('enterBreakpoint768',function() {
		$('.container-fluid').removeClass('menu-hidden');
        if (!$('#top-menu').is('.in')) {
            $("#top-menu").collapse('toggle');
        }
	});

	$(window).bind('exitBreakpoint992',function() {		
		disableContentNiceScroll();
	});

	$(window).bind('enterBreakpoint992',function() {
		enableContentNiceScroll(false);

	});

	window.coreInit = true;
	
	$(window).on('load', function()
	{
		window.loadTriggered = true;

        if ($(window).width() < 768)
            $("#top-menu").collapse('toggle');

		if ($(window).width() < 992)
			$('.hasNiceScroll').getNiceScroll().stop();

		if (typeof animations == 'undefined')
			$('.hasNiceScroll, #menu').getNiceScroll().show().resize();

		if (typeof Holder != 'undefined')
		{
			Holder.add_theme("dark", {background:"#424242", foreground:"#aaa", size:9}).run();
			Holder.add_theme("white", {background:"#fff", foreground:"#c9c9c9", size:9}).run();
		}

		if ($('.scripts-async').length)
			$('.scripts-async .container-fluid').css('visibility', 'visible');
	});

	// weird chrome bug, sometimes the window load event isn't triggered
	setTimeout(function(){
		if (!window.loadTriggered)
			$(window).trigger('load');
	}, 2000);

    $('#select_project').on('change', function() {
        location = $(this).val();
    });
})(jQuery, window);

function load_basic_ckeditor(txt_fld_id){
    var editor = CKEDITOR.instances[txt_fld_id];
    if (editor) { editor.destroy(true); }

    CKEDITOR.config.toolbar_Basic = [['Bold','Italic','Underline',
        '-','JustifyLeft','JustifyCenter','JustifyRight','-','Undo','Redo']];
    CKEDITOR.config.toolbar = 'Basic';
//        CKEDITOR.config.width=400;
//        CKEDITOR.config.height=300;
    CKEDITOR.replace('text_id', CKEDITOR.config);
}

function auto_init_components(){
    //load_basic_ckeditor('.ckeditor');
//    $( '.ckeditor' ).ckeditor();

    $(".datepicker1").datepicker({
        format: 'yyyy-mm-dd'
    });

    $.extend($.inputmask.defaults, {
        'autounmask': true
    });

    $(".inputmask-date").inputmask("d/m/y", {autoUnmask: true});
    $(".inputmask-date-1").inputmask("d/m/y",{ "placeholder": "*"});
    $(".inputmask-date-2").inputmask("d/m/y",{ "placeholder": "dd/mm/yyyy" });
    $(".inputmask-date-3").inputmask("y-m-d",{ "placeholder": "yyyy-mm-dd" });
    $(".inputmask-phone").inputmask("mask", {"mask": "(999) 999-9999"});
    $(".inputmask-tax").inputmask({"mask": "99-9999999"});
    $(".inputmask-decimal").inputmask('decimal');
    $(".inputmask-integer").inputmask('integer', { rightAlignNumerics: false });
    $(".inputmask-currency").inputmask('\u20AC 999,999,999.99', { numericInput: true, rightAlignNumerics: false, greedy: false});
    $(".inputmask-ssn").inputmask("999-99-9999", {clearMaskOnLostFocus: true });


    $('.txt_max_255').jqEasyCounter({
        'maxChars': 255,
        'maxCharsWarning': 255,
        'msgFontSize': '12px',
        'msgFontColor': '#000',
        'msgFontFamily': 'Arial',
        'msgTextAlign': 'left',
        'msgWarningColor': '#F00',
        'msgAppendMethod': 'insertBefore'
    });
    $('.txt_max_100').jqEasyCounter({
        'maxChars': 100,
        'maxCharsWarning': 100,
        'msgFontSize': '12px',
        'msgFontColor': '#000',
        'msgFontFamily': 'Arial',
        'msgTextAlign': 'left',
        'msgWarningColor': '#F00',
        'msgAppendMethod': 'insertBefore'
    });
}
