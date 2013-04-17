
	//** on DOM loaded
	jQuery(function() {
	
		jQuery('.panel .controls').click(function(){
			var panelBody = $(this).closest('.panel');
			var panelContent = $('.panel-content', panelBody);
			
			
			if (jQuery(this).hasClass('down')){
				jQuery(panelContent).slideDown();
				jQuery(this).removeClass('down');
			}else{
				jQuery(panelContent).slideUp();
				jQuery(this).addClass('down');
			}	
		});		
		
		var fullPanel = jQuery('.full-panel');
		
		jQuery('.tabs li', fullPanel).click(function (){
			var tabID = jQuery(this).attr('id');
			
			jQuery('.tabs li.selected', fullPanel).removeClass('selected');
			jQuery(this).addClass('selected');
			
			jQuery('.panel:not(.'+tabID+')', fullPanel).css('display','none');
			jQuery('.panel.'+tabID, fullPanel).css('display','block');
		});
		
		jQuery('.btResConfirmYes').click(function(){
			alert('YES!');
		});
		
		jQuery('.btResConfirmNo').click(function(){
			alert('No!');
		});
		
		
		//*** Categories Meta
		
		if (jQuery('#ewf-categs-array').attr('value') == ''){
			ewfCategsMetaRefresh();
		}
		
		jQuery('.ewf-categs-meta-list li').click(function(){
			var item_name 	= jQuery('a', this).attr('href');
			var item_id 	= jQuery('a', this).attr('rel');
			
			if (jQuery(this).hasClass('removed')){
				jQuery(this).removeClass('removed');
				jQuery('input', this).remove();
			}else{
				jQuery(this).addClass('removed');
				jQuery(this).append('<input type="hidden" value="'+item_id+'" name="'+item_name+'">');
			}
			
			ewfCategsMetaRefresh();
			//jQuery('div', this).css('display', 'block');
		});
		
		//*** Sortable eitems
		jQuery('.ewf-categs-meta-list').sortable({
			'tolerance':'intersect',
			'cursor':'pointer',
			'items':'li',
			'placeholder':'ewf-categs-meta-holder',
			update: function(event, ui) { 
				ewfCategsMetaRefresh();
			}
		});
	
	});
	
	function ewfCategsMetaRefresh(){
		var categ_src = '';
		var categ_src_array = '';
		var categ_count = 0;
		
		jQuery('.ewf-categs-meta-list li:not(.removed)').each(function(){
			categ_count++;
			
			var item_id = jQuery('a', this).attr('rel');
			 
			if (categ_count>1){ 
				categ_src_array += ','+item_id;
			}else{
				categ_src_array += item_id;
			}
		});
		
		//categ_src = 'a:'+categ_count+':{'+categ_src_array+'}';
		categ_src = categ_src_array;
		jQuery('#ewf-categs-array').attr('value', categ_src);
	}