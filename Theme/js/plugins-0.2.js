// plugins

/**
 * Copyright (c) 2007-2012 Ariel Flesler - aflesler(at)gmail(dot)com | http://flesler.blogspot.com
 * Dual licensed under MIT and GPL.
 * @author Ariel Flesler
 * @version 1.4.3.1
 */
;(function($){var h=$.scrollTo=function(a,b,c){$(window).scrollTo(a,b,c)};h.defaults={axis:'xy',duration:parseFloat($.fn.jquery)>=1.3?0:1,limit:true};h.window=function(a){return $(window)._scrollable()};$.fn._scrollable=function(){return this.map(function(){var a=this,isWin=!a.nodeName||$.inArray(a.nodeName.toLowerCase(),['iframe','#document','html','body'])!=-1;if(!isWin)return a;var b=(a.contentWindow||a).document||a.ownerDocument||a;return/webkit/i.test(navigator.userAgent)||b.compatMode=='BackCompat'?b.body:b.documentElement})};$.fn.scrollTo=function(e,f,g){if(typeof f=='object'){g=f;f=0}if(typeof g=='function')g={onAfter:g};if(e=='max')e=9e9;g=$.extend({},h.defaults,g);f=f||g.duration;g.queue=g.queue&&g.axis.length>1;if(g.queue)f/=2;g.offset=both(g.offset);g.over=both(g.over);return this._scrollable().each(function(){if(e==null)return;var d=this,$elem=$(d),targ=e,toff,attr={},win=$elem.is('html,body');switch(typeof targ){case'number':case'string':if(/^([+-]=)?\d+(\.\d+)?(px|%)?$/.test(targ)){targ=both(targ);break}targ=$(targ,this);if(!targ.length)return;case'object':if(targ.is||targ.style)toff=(targ=$(targ)).offset()}$.each(g.axis.split(''),function(i,a){var b=a=='x'?'Left':'Top',pos=b.toLowerCase(),key='scroll'+b,old=d[key],max=h.max(d,a);if(toff){attr[key]=toff[pos]+(win?0:old-$elem.offset()[pos]);if(g.margin){attr[key]-=parseInt(targ.css('margin'+b))||0;attr[key]-=parseInt(targ.css('border'+b+'Width'))||0}attr[key]+=g.offset[pos]||0;if(g.over[pos])attr[key]+=targ[a=='x'?'width':'height']()*g.over[pos]}else{var c=targ[pos];attr[key]=c.slice&&c.slice(-1)=='%'?parseFloat(c)/100*max:c}if(g.limit&&/^\d+$/.test(attr[key]))attr[key]=attr[key]<=0?0:Math.min(attr[key],max);if(!i&&g.queue){if(old!=attr[key])animate(g.onAfterFirst);delete attr[key]}});animate(g.onAfter);function animate(a){$elem.animate(attr,f,g.easing,a&&function(){a.call(this,e,g)})}}).end()};h.max=function(a,b){var c=b=='x'?'Width':'Height',scroll='scroll'+c;if(!$(a).is('html,body'))return a[scroll]-$(a)[c.toLowerCase()]();var d='client'+c,html=a.ownerDocument.documentElement,body=a.ownerDocument.body;return Math.max(html[scroll],body[scroll])-Math.min(html[d],body[d])};function both(a){return typeof a=='object'?a:{top:a,left:a}}})(jQuery);

/**
 * jQuery.LocalScroll - Animated scrolling navigation, using anchors.
 * Copyright (c) 2007-2009 Ariel Flesler - aflesler(at)gmail(dot)com | http://flesler.blogspot.com
 * Dual licensed under MIT and GPL.
 * Date: 3/11/2009
 * @author Ariel Flesler
 * @version 1.2.7
 **/
;(function($){var l=location.href.replace(/#.*/,'');var g=$.localScroll=function(a){$('body').localScroll(a)};g.defaults={duration:1e3,axis:'y',event:'click',stop:true,target:window,reset:true};g.hash=function(a){if(location.hash){a=$.extend({},g.defaults,a);a.hash=false;if(a.reset){var e=a.duration;delete a.duration;$(a.target).scrollTo(0,a);a.duration=e}i(0,location,a)}};$.fn.localScroll=function(b){b=$.extend({},g.defaults,b);return b.lazy?this.bind(b.event,function(a){var e=$([a.target,a.target.parentNode]).filter(d)[0];if(e)i(a,e,b)}):this.find('a,area').filter(d).bind(b.event,function(a){i(a,this,b)}).end().end();function d(){return!!this.href&&!!this.hash&&this.href.replace(this.hash,'')==l&&(!b.filter||$(this).is(b.filter))}};function i(a,e,b){var d=e.hash.slice(1),f=document.getElementById(d)||document.getElementsByName(d)[0];if(!f)return;if(a)a.preventDefault();var h=$(b.target);if(b.lock&&h.is(':animated')||b.onBefore&&b.onBefore.call(b,a,f,h)===false)return;if(b.stop)h.stop(true);if(b.hash){var j=f.id==d?'id':'name',k=$('<a> </a>').attr(j,d).css({position:'absolute',top:$(window).scrollTop(),left:$(window).scrollLeft()});f[j]='';$('body').prepend(k);location=e.hash;k.remove();f[j]=d}h.scrollTo(f,b).trigger('notify.serialScroll',[f])}})(jQuery);

// In-house functions
;(function($) {
	"use strict";
	
	var transformPrefixList = ["transform", "webkitTransform", "msTransform"];
	var transform;
	var carouselIndex = 0;
	var heroList = $(".hero-list-item");
	var heroArrow = $(".hero-wrapper-arrow");
	var heroWidth = heroList.width();
	var navigationFixed = false;
	var clickSuppressant = false;
	var leftArrow = $(".hero-wrapper-left-arrow");
	var rightArrow = $(".hero-wrapper-right-arrow");
	var carouselTotal = heroList.length;
	var carouselHovering = false;
	
	// Sets default carousel height
	function setDefaultCarouselHeight() {
		// minus 2 because of the bottom border
		// (may be able to fix using box-sizing: border-box;)
		$("#hero-wrapper").css("height", $(window).height() - 2);
	};
	
	// Sets the default CSS positions for the three carousels
	function setDefaultListPlacement() {
		var index = 0;
		if (Modernizr.csstransforms) {
			heroList.each(function() {
				var translation = 100 * index + "%";
				$(this).css(transform, "translate(" + translation + ", 0)");
				++index;
			});
			//heroArrow.css(transform, "translate(0px, 0px)");
		}
		else {
			heroList.each(function() {
				$(this).css("left", 100 * index + "%");
				++index;
			});
		}
	};
	
	// "Turns on" the carousel
	function activateCarousel() {
		setDefaultListPlacement();
		
		$("#hero-wrapper").on("click.leftClick touchend.leftTouch", ".hero-wrapper-left-arrow", function(evt) {
			// for the left arrow
			if (evt.preventDefault) {
				evt.preventDefault();
			}
			if (clickSuppressant) {
				return;
			}
			clickSuppressant = true;
			if (carouselIndex > 0) {
				rightArrow.removeClass("hidden-element");
				--carouselIndex;
				// use hardware to do the transitions for these large pages instead of CSS, if supported
				if (Modernizr.csstransforms) {
					heroList.each(function() {
						var newLeft = Number($(this)[0].style[transform].slice(10, $(this)[0].style[transform].indexOf(",") - 1)) + 100 + "%";
						$(this).css(transform, "translate(" + newLeft + ", 0)");
					});
					heroArrow.css(transform, "translate(" + (Number(heroArrow[0].style[transform].slice(10, heroArrow[0].style[transform].indexOf(",") - 2)) - 26) + "px, 0)");
				}
				// otherwise, use CSS
				else {
					heroList.each(function() {
						$(this).css("left", Number($(this)[0].style.left.replace(/%|px/, "")) + 100 + "%");
					});
					heroArrow.css("left", Number(heroArrow.css("left").replace(/px/, "")) - 26 + "px");
				}
				if (carouselIndex === 0) {
					leftArrow.addClass("hidden-element");
				}
			}
			setTimeout(function() {
				clickSuppressant = false;
			}, 500);
		}).on("click.rightClick touchend.rightTouch", ".hero-wrapper-right-arrow", function(evt) {
			// for the right arrow
			if (evt.preventDefault) {
				evt.preventDefault();
			}
			if (clickSuppressant) {
				return;
			}
			clickSuppressant = true;
			if (carouselIndex < carouselTotal - 1) {
				leftArrow.removeClass("hidden-element");
				++carouselIndex;
				// use hardware to do the transitions for these large pages instead of CSS, if supported
				if (Modernizr.csstransforms) {
					heroList.each(function() {
						var newRight = Number($(this)[0].style[transform].slice(10, $(this)[0].style[transform].indexOf(",") - 1)) - 100 + "%";
						$(this).css(transform, "translate(" + newRight + ", 0)");
					});
					heroArrow.css(transform, "translate(" + (Number(heroArrow[0].style[transform].slice(10, heroArrow[0].style[transform].indexOf(",") - 2)) + 26) + "px, 0)");
				}
				// otherwise, use CSS
				else {
					heroList.each(function() {
						$(this).css("left", Number($(this)[0].style.left.replace(/%|px/, "")) - 100 + "%");
					});
					heroArrow.css("left", Number(heroArrow.css("left").replace(/px/, "")) + 26 + "px");
				}
				if (carouselIndex === carouselTotal - 1) {
					rightArrow.addClass("hidden-element");
				}
			}
			setTimeout(function() {
				clickSuppressant = false;
			}, 500);
		});
	};
	
	// Check for transform support and which transform to use
	function checkTransformSupport() {
		for (var i = 0, length = transformPrefixList.length; i < length; ++i) {
			if (Modernizr.testProp(transformPrefixList[i])) {
				transform = transformPrefixList[i];
				break;
			}
		}
		activateCarousel();
	};
	
	$(document).ready(function() {
		// set up smooth scrolling using ScrollTo and LocalScroll
		$(".home").localScroll();
	});
	
	// Transition for fixing the main nav
	function fixNavigation() {
		var wrapper = $("#header-wrapper");
		navigationFixed = true;
		wrapper.addClass("header-wrapper-fixed");
		setTimeout(function() {
			wrapper.addClass("header-wrapper-fixed-floating");
		}, 200);
	};
	
	// Transition for unfixing the main nav
	function unfixNavigation() {
		var wrapper = $("#header-wrapper");
		navigationFixed = false;
		wrapper.removeClass("header-wrapper-fixed-floating");
		setTimeout(function() {
			wrapper.removeClass("header-wrapper-fixed");
		}, 200);
	};
	
	// Makes the carousel auto advance after 4 seconds
	function initializeAutoSlide() {
		var count = 0;
		setInterval(function() {
			if (!carouselHovering && count < carouselTotal - 1) {
				++count;
				rightArrow.click();
			}
			else if (count == carouselTotal -1) {
				count = 0;
				rightArrow.removeClass("hidden-element");
				carouselIndex = 0;
				// use hardware to do the transitions for these large pages instead of CSS, if supported
				if (Modernizr.csstransforms) {
					heroList.each(function() {
						var newLeft = Number($(this)[0].style[transform].slice(10, $(this)[0].style[transform].indexOf(",") - 1)) + 200 + "%";
						$(this).css(transform, "translate(" + newLeft + ", 0)");
					});
					heroArrow.css(transform, "translate(" + (Number(heroArrow[0].style[transform].slice(10, heroArrow[0].style[transform].indexOf(",") - 2)) - 52) + "px, 0)");
				}
				// otherwise, use CSS
				else {
					heroList.each(function() {
						$(this).css("left", Number($(this)[0].style.left.replace(/%|px/, "")) + 200 + "%");
					});
					heroArrow.css("left", Number(heroArrow.css("left").replace(/px/, "")) - 52 + "px");
				}
				leftArrow.addClass("hidden-element");
				setTimeout(function() {
					clickSuppressant = false;
				}, 500);
			}
		}, 7000); // original 4000
	};
	
	$(window).scroll(function(evt) {
		if ($(window).scrollTop() >= $(window).height()) {
			if (!navigationFixed) {
				fixNavigation();
			}
		}
		else {
			if (navigationFixed) {
				unfixNavigation();
			}
		}
	});
	
	$("#hero-wrapper").on("mouseover.heroOver", ".hero-link", function() {
		carouselHovering = true;
	}).on("mouseout.heroOut", ".hero-link", function() {
		carouselHovering = false;
	});
	
	function init() {
		setDefaultCarouselHeight();
		checkTransformSupport();
		initializeAutoSlide();
		// initialize tradeshow tab support
		$(".tradeshow-list").on("click.tradeClick touchend.tradeTouch", "li", function(evt) {
			var self = $(this);
			var tradeText = self.text().toLowerCase();
			var textSelector = $(".tradeshow-text");
			if (evt.preventDefault) {
				evt.preventDefault();
			}
			// change the active tab
			$(".tradeshow-list li").removeClass("trade-active");
			self.addClass("trade-active");
			// load appropriate content
			textSelector.removeClass("trade-text-active");
			if (tradeText === "associations") {
				textSelector.eq(1).addClass("trade-text-active");
			}
			else if (tradeText === "exhibits") {
				textSelector.eq(2).addClass("trade-text-active");
			}
			else if (tradeText === "overview") {
				textSelector.eq(0).addClass("trade-text-active");
			}
		});
	};
	
	init();

})(jQuery);