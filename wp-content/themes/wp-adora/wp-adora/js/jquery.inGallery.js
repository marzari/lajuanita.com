/**
 * inGallery - Non invasive Image Gallery
 * @version: 0.3.1 - (2010/10/26)
 * @requires jQuery v1.4.2 or later 
 * @author Nicolae Gabriel
  
 * Licensed under MIT licence:
 *   http://www.opensource.org/licenses/mit-license.php
 **/
 
function inGallery(elem, options) {
	this.settings =  {
		name			: 'inGallery', 	// test purpose variable :))
		slideInArticle 	: false,		// wether to slide down/up the pager on article hover or on image hover
		fadeSpeed 		: 500,			// cross fade image timer
		slideSpeed 		: 100,			// slide Up/Down animation time
		pagerActive		: 'active', 	// this should be a class name not a selector
		element			: '', 			// internal used variable pointing tu div.img element form article
		bodySelector	: 'div.img'
	};
	
	this.init = function(elem, options) {
		var currentING = this;
		this.settings = $.extend({}, this.settings, options );
		this.settings.element = elem;
		
		//** Attach gallery  html elements
		this.attachUI();
		
		//** Attach pager behavior
		this.pager();
		
		if (this.settings.slideInArticle){
			//** Slide on  article hover
			var article = $(elem).parent();
			$(article).hover(function(){
				currentING.slideDown();
			},function(){
				currentING.slideUp();
			});
		}else{
			//** Slide on inGallery hover
			$(elem).hover(function(){
				currentING.slideDown();
			},function(){
				currentING.slideUp();
			});
		}
	};
	
	this.pager = function(elem)  {
		if (!elem) { elem = this.settings.element; }
		var inGall = this;
		
		$('.pager li',elem).click(function(){
			var index = $(this).index();
			
			$('li.'+inGall.settings.pagerActive,elem).removeClass(inGall.settings.pagerActive);
			$(this).addClass(inGall.settings.pagerActive);
			
			var newBackground = $('img:eq('+index+')',elem).attr('src');
			var oldBackground = $('.overlay>div',elem).css('background');
			
			$('.overlay',elem).css('background',oldBackground);
			$('.overlay>div',elem)
				.css('display','none')
				.css('background','url('+newBackground+') no-repeat center center')
				.fadeIn(inGall.settings.fadeSpeed,function(){  });
		});
	},
	
	this.attachUI = function (elem) {
		if (!elem) { elem = this.settings.element; }
		
		$(elem).append('<ul class="pager"></ul>');
		
		var imageElm = $('img:first-child',elem);
		var imageSrc = imageElm.attr('src');
		
		var position = imageElm.position();
		var elWidth = parseInt(imageElm.width());
		var elHeight = parseInt(imageElm.height());
		var paddingTop = parseInt(imageElm.css('padding-top'));
		var paddingLeft = parseInt(imageElm.css('padding-left'));
		var inGall = this;
		
		$(elem).append('<div class="overlay" style="width:'+elWidth+'px;height:'+elHeight+'px;position:absolute;z-index:9999;top:'+(position.top+paddingTop+1)+'px;left:'+(position.left+paddingLeft+1)+'px;background:url('+imageSrc+') no-repeat center center;"><div style="width:'+elWidth+'px;height:'+elHeight+'px;display:none;"></div></div>');
		
		$('img',elem).each(function(){
			if($(this).css('display')=='block'){
				$('.pager',elem).append('<li class="'+inGall.settings.pagerActive+'"></li>')
			}else{
				$('.pager',elem).append('<li></li>')
			}
		});
	},
	
	this.slideDown = function(elem){			
		if (!elem) { elem = this.settings.element; }
		
		var divHolder = $(elem).parent();
		var distance = 20;
		
		$(elem).animate(
			{ paddingBottom:distance+'px' },
			{ duration:this.settings.slideSpeed,
			  step: function( paddingBottom ){
				$(divHolder).css('padding-bottom',(distance-Math.round(paddingBottom)));
			}, complete:function(){
				$('.pager',elem).fadeIn(); 
				} 
			}
		);
	}, 
	
	this.slideUp = function(elem){
		if (!elem) { elem = this.settings.element; }
		
		var divHolder = $(elem).parent();
		var distance = 21;
		
		$('.pager',elem).fadeOut(this.settings.slideSpeed,function(){
			$(elem).stop(true,false).animate(
				{ paddingBottom:'7px' },
				{ duration:'fast',
				  step: function( paddingBottom ){
					$(divHolder).css('padding-bottom',(distance-Math.round(paddingBottom)));
				}
			});
		});
	}
	
	this.init(elem, options);
	
};	