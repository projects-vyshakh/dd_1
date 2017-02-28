// All scripts
$(document).ready(function(e) {

//Variables
	var $fsbg = $(".fsbg");
	var $menuH = $('ul.nav').height();
	var homeScr = $('#home');
	var pageScr = $('.page');
	var $sidebar = $('.sidebar');
	var $sidebarH = $sidebar.height();
	var $sidebarToggle = $('.sidebar-toggle');
	var $bottomBorder = $('.bottom-border');
	var $optionsPanel = $("#options-panel");
	var $panelToggle = $('.panel-toggle');
	
//Auto height
	$(window).load(function(){
		homeScr.css("min-height", $(window).height());
		pageScr.css("min-height", $(window).height());
		$fsbg.css("height", $('#home').height());
		$bottomBorder.css("min-height", $(window).height()-185);
	});
	$(window).on('resize', function(){
		homeScr.css("min-height", $(window).height());
		pageScr.css("min-height", $(window).height());
		$fsbg.css("height", $('#home').height());
		$bottomBorder.css("min-height", $(window).height()-185);
	});
	
	//Hiding Home screen sidebar after loading
	$(window).load(function(){
	setInterval(function(){
		$('.main-navi, .home-tw-feed').animate({'left':-1000}, 1000);
		$('.footer').animate({'left':-500}, 1000);
		$('.left-line').fadeOut(1000);
		homeScr.css("min-height", $(window).height());
		$fsbg.css("height", $('#home').height());
	}, 2000);
	
	//Show Sidebar Toggle
	setInterval(function(){
		$sidebarToggle.removeClass('hidden');
		$panelToggle.removeClass('hidden');
	}, 3000);
	});
	
	
	//Hide Sidebar when scrolling
	$(window).on('scroll', function(){
		$sidebar.removeClass('open');
		$sidebarToggle.removeClass('open');
	});
	
		//Sidebar Toggle
		$sidebarToggle.click(function(e){
			e.preventDefault();
			$(this).toggleClass('open');
			$sidebar.toggleClass('open');
		});
		

		//Sidebar close init
		$('nav li a').click(function(){
				$sidebar.removeClass('open');
				$sidebarToggle.removeClass('open');
		});
		
		pageScr.click(function(){
			$sidebar.removeClass('open');
			$sidebarToggle.removeClass('open');
			$optionsPanel.removeClass('open');
			$panelToggle.removeClass('open');
		});
		homeScr.click(function(){
			$sidebar.removeClass('open');
			$sidebarToggle.removeClass('open');
			$optionsPanel.removeClass('open');
			$panelToggle.removeClass('open');
		});
		
		$(window).on('resize', function(){
			$sidebar.removeClass('open');
			$sidebarToggle.removeClass('open');
			$optionsPanel.removeClass('open');
			$panelToggle.removeClass('open');
		});
		
	
	//INTERNAL ANCHOR LINKS SCROLLING (PAGINATION)
	
	$(".scroll").click(function(event){		
		event.preventDefault();
		$('html, body').animate({scrollTop:$(this.hash).offset().top}, 700);
	});
	
	/******SCROLL-SPY*****************/
	// Cache selectors
	var lastId,
		topMenu = $(".navbar-inner"),
		topMenuHeight = topMenu.outerHeight(),
		// All list items
		menuItems = topMenu.find("a"),
		// Anchors corresponding to menu items
		scrollItems = menuItems.map(function(){
		  var item = $($(this).attr("href"));
		  if (item.length) { return item; }
		});
	
	// Bind to scroll
	$(window).scroll(function(){
	   // Get container scroll position
	   var fromTop = $(this).scrollTop()+topMenuHeight;
	   
	   // Get id of current scroll item
	   var cur = scrollItems.map(function(){
		 if ($(this).offset().top < fromTop)
		   return this;
	   });
	   // Get the id of the current element
	   cur = cur[cur.length-1];
	   var id = cur && cur.length ? cur[0].id : "";
	   if (lastId !== id) {
		   lastId = id;
		   // Set/remove active class
		   menuItems
			 .parent().removeClass("active")
			 .end().filter("[href=#"+id+"]").parent().addClass("active");
	   }
	});
	
	
	//Team Grid Hover Effect
	$('.team-mate').hover(function(){
		$(this).addClass('expanded');	
	}, function(){
		$(this).removeClass('expanded');	
	});
	
	
	//Menu Collapsed Active Class
	$('.menu-btn').click(function(){
		$(this).toggleClass('active');
	});

	
	//Thumbs grid init
	Grid.init();
	
	
	//Ajax Form
	$('#submit').click(function(){
		sprytextfield1.validate();
		sprytextfield2.validate();
		sprytextarea1.validate();
		$.post("form.php", $("#feedback-form").serialize(),  function(data) {
			$('#success').html(data).animate({opacity: 1}, 500, function(){
				$("#feedback-form").trigger( 'reset' );
			});
		});
		return false;
	});
	
/************************************************/

    if ($("#bg-slideshow li").length > 0) {
        slider.bgSlider($("#bg-slideshow li").length);
    }

    //Change Slides on click
    $('#reload-btn').click(function(e) {
				e.preventDefault();
        slider.nextSlide();
    });
/******************************************************/

//Pages Animations
var lefts = $(".left"),
		rights = $(".right"),
		bottoms = $(".bottom"),
		rotates = $(".rotate")
		
	$(window).on('resize', function(){
		$(lefts).css({left: 0});
		$(rights).css({right: 0});
		$(bottoms).css({bottom: 0});
	});

	var scrollVisible = $(window).scrollTop() + $(window).height();
	$(lefts).each(function () {
		if (scrollVisible > $(this).offset().top)
			$(this).css({left: 0});
	});

	$(rights).each(function () {
		if (scrollVisible > $(this).offset().top)
			$(this).css({right: 0});
	});

	$(bottoms).each(function () {
		if (scrollVisible >  $(this).offset().top - 1000)
			$(bottoms[i]).css({bottom: 0});
	});
	
	$(rotates).each(function () {
		if (scrollVisible >  $(this).offset().top)
			$(rotates[i]).addClass("rotate-normal");
	});
        
	$(window).scroll(function () {
	
		var scrollVisible = $(window).scrollTop() + $(window).height();
	$(lefts).each(function () {
		if (scrollVisible > $(this).offset().top)
			$(this).css({left: 0});
	});

	$(rights).each(function () {
		if (scrollVisible > $(this).offset().top)
			$(this).css({right: 0});
	});

		$(bottoms).each(function (i) {
			if (scrollVisible >  $(this).offset().top - 1000)
				$(bottoms[i]).css({bottom: 0});
		});

		$(rotates).each(function (i) {
			if (scrollVisible >  $(this).offset().top)
				$(rotates[i]).addClass("rotate-normal");
		});
	});//End Pages Animations
	
	
/* -------------------------------------------------------------------
			Color Customization
--------------------------------------------------------------------*/
	$panelToggle.click(function() {
		$(this).toggleClass('open');
   	$optionsPanel.toggleClass('open');
 });

	$(".minicolors").minicolors({
        defaultValue: "#00e7b4",
        change: function(hex) {
            changeColor(hex);
        }
    });

    $(".color-scheme").click(function() {
        changeColor($(this)[0].attributes['data-color'].value);
    });

    var style = $('<style type="text/css" id="theme_color" />').appendTo('head');

    function changeColor(hex) {
        var rgba = parseInt(hex.substring(1), 16);
        var r = (rgba & 0xff0000) >> 16;
        var g = (rgba & 0x00ff00) >> 8;
        var b = rgba & 0x0000ff;
        style.html(' a.sidebar-toggle > .top-border, a.sidebar-toggle > .bottom-border, #options-panel > .top-border, #options-panel > .bottom-border, a.sidebar-toggle > .toggle > .ver-bar, a.sidebar-toggle > .toggle > .hor-bars > .top-bar, a.sidebar-toggle > .toggle > .hor-bars > .bottom-bar, a.sidebar-toggle > .toggle > .hor-bars > .middle-bar, a.sidebar-toggle:hover > .toggle > .ver-bar, a.sidebar-toggle:hover > .toggle > .hor-bars > .top-bar, a.sidebar-toggle:hover > .toggle > .hor-bars > .bottom-bar, a.sidebar-toggle:hover > .toggle > .hor-bars > .middle-bar, .panel-toggle > .top-border, .panel-toggle > .bottom-border, .team-mate > .overlay, .og-grid li a > .img-overlay, input[type=submit]{ background-color: ' + hex + ';} .button > .button-color, .button:hover > .button-color, .heart-color, .star-color, .cloud-color, .location-color, .phone-color, .mail-color, .video-color{ fill: ' + hex + ';} .default-color, .social-bar a:hover, .social-bar2 a:hover, .team-mate-info > h3, .og-grid li a:hover > .figcap h2, .og-grid li.og-expanded a > .figcap h2, .tw-feed-author a, .contact-info > p a{ color: ' + hex + ' !important;} .team-mate.expanded > .team-mate-info, .og-grid li a:hover > .figcap, .og-grid li.og-expanded a > .figcap, .textfieldFocusState input, input.textfieldFocusState, .textareaFocusState textarea, textarea.textareaFocusState{ border-color: ' + hex + ';}');
    }


});///END DOCUMENT READY

///Slideshow/Title animation function
var slider = {
    currentSlide: 0,
    currentTitle: 0,
    timeOut: 5000,
    pred2: true,
    offset: 0,
    selector: '#bg-slideshow',
    currentCls: "current",
    countItems: 0,
    titleSelector: 'ul.home-heading-fade li',
    titleActive: 'active',

    bgSlider: function (countItems) {
        var me = this;
        me.countItems = countItems || me.countItems;
        me._next();
        me._timeoutId = setTimeout(function(){me.bgSlider();}, me.timeOut);
    },
    _next: function(){
        var me = this;
        if (me.currentSlide === me.countItems) {
            me.currentSlide = 1;
        } else {
            me.currentSlide ++;
        }
        me.doSlide();
    },
    nextSlide: function(){
        var me = this;
        clearTimeout(me._timeoutId);
        me.bgSlider();
    },
    doSlide: function(){
        var me = this;
        // background
        $(me.selector + " li").removeClass(me.currentCls);
        $(me.selector + " li:nth-child(" + me.currentSlide + ")").addClass(me.currentCls);
        // title
        $(me.titleSelector).removeClass(me.titleActive);
        $(me.titleSelector + ":nth-child(" + me.currentSlide + ")").addClass(me.titleActive);
    }
};
