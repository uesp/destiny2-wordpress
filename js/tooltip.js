
window.UespD2Tooltip_Visible = false;
window.UespD2Tooltip_LastElement = null;
window.UespD2TooltipElement = null;
window.UespD2Tooltip_CacheId = "";
window.UespD2Tooltip_Cache = { };


window.CreateUespDestiny2Tooltip = function()
{
	UespD2TooltipElement = jQuery('<div />').addClass('uespDestiny2Tooltip').hide();
	jQuery('body').append(UespD2TooltipElement);
}


window.ShowUespDestiny2Tooltip = function (parent, itemId, itemIcon, collectibleId)
{
	UespD2Tooltip_LastElement = parent;
	
	var linkSrc = "//destiny2.uesp.net/tooltip.php?";
	var dataOk = false;
	var cacheId = "";
	
	if (itemId) { linkSrc += "&item=" + itemId; dataOk = true; }
	if (collectibleId) { linkSrc += "&collectible=" + collectibleId; dataOk = true; }
	if (itemIcon) { linkSrc += "&icon=" + itemIcon; dataOk = true; }
	
	//if (!dataOk) return false;
	
	if (UespD2TooltipElement == null) CreateUespDestiny2Tooltip();
	
	var position = jQuery(parent).offset();
	var width = jQuery(parent).width();
	UespD2TooltipElement.css({ top: position.top-50, left: position.left + width });
	UespD2Tooltip_Visible = true;
	
	if (itemId)
	{
		cacheId = itemId.toString();
	}
	else if (collectibleId)
	{
		cacheId = collectibleId.toString();
	}
	else if (itemIcon)
	{
		cacheId = itemIcon.toString();
	}
	
	UespD2Tooltip_CacheId = cacheId;
	
	if (cacheId != "" && UespD2Tooltip_Cache[cacheId] != null)
	{
		UespD2TooltipElement.html(UespD2Tooltip_Cache[cacheId]);
		UespD2TooltipElement.show();
		
		AdjustUespDestiny2TooltipPosition(UespD2TooltipElement, jQuery(parent));
	}
	else
	{
		jQuery.get(linkSrc, function(data) {
			if (UespD2Tooltip_LastElement == null) return;
			if (UespD2Tooltip_LastElement !== parent) return;
			
			UespD2TooltipElement.html(data);
			
			if (UespD2Tooltip_Visible) UespD2TooltipElement.show();
			if (cacheId != "" && cacheId == UespD2Tooltip_CacheId) UespD2Tooltip_Cache[cacheId] = data;
			
			AdjustUespDestiny2TooltipPosition(UespD2TooltipElement, jQuery(parent));
		});
	}
}


window.AdjustUespDestiny2TooltipPosition = function(tooltip, parent)
{
	var windowWidth = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
	var windowHeight = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
	var tooltipChild = tooltip.children(":first");
	var toolTipWidth = tooltipChild.width();
	var toolTipHeight = tooltipChild.height();
	var elementHeight = parent.height();
	var elementWidth = parent.width();
	var NARROW_WINDOW_WIDTH = 800;
	
	var top = parent.offset().top - toolTipHeight/2;
	var left = parent.offset().left + parent.outerWidth() + 3;
	
	if (windowWidth < NARROW_WINDOW_WIDTH)
	{
		top = parent.offset().top - 25 - toolTipHeight;
		left = parent.offset().left - toolTipWidth/2 + elementWidth/2;
	}
	
	tooltip.offset({ top: top, left: left });
	
	var viewportTooltip = tooltipChild[0].getBoundingClientRect();
	
	if (viewportTooltip.bottom > windowHeight)
	{
		var deltaHeight = viewportTooltip.bottom - windowHeight + 10;
		top = top - deltaHeight;
	}
	else if (viewportTooltip.top < 150)
	{
		var deltaHeight = viewportTooltip.top - 160;
		
		if (windowWidth < NARROW_WINDOW_WIDTH) deltaHeight = -toolTipHeight - elementHeight - 30;
		
		top = top - deltaHeight;
	}
    
	if (viewportTooltip.right > windowWidth)
	{
		var deltaLeft = -toolTipWidth - parent.width() - 28;
	
		if (windowWidth < NARROW_WINDOW_WIDTH)
		{
			deltaLeft = windowWidth - viewportTooltip.right - 10;
		}
		
		left = left + deltaLeft;
	}
	
	if (viewportTooltip.left < 0)
	{
		if (windowWidth < NARROW_WINDOW_WIDTH)
			left = left - viewportTooltip.left + 10;
		else
			left = left;
	}
	 
	tooltip.offset({ top: top, left: left });
	viewportTooltip = tooltipChild[0].getBoundingClientRect();
	 
	if (viewportTooltip.left < 0 )
	{
		left = left - viewportTooltip.left + 10;
		tooltip.offset({ top: top, left: left });
	}
}


window.HideUespDestiny2Tooltip = function()
{
	UespD2Tooltip_Visible = false;
	
	if (UespD2TooltipElement == null) return;
	
	UespD2TooltipElement.hide();
}


window.OnUespDestiny2TooltipEnter = function()
{
	var $this = jQuery(this);
	UespD2Tooltip_LastElement = $this;
	
	ShowUespDestiny2Tooltip(UespD2Tooltip_LastElement, $this.attr('itemid'), $this.attr('itemicon'), $this.attr('collectibleid'));
}


window.OnUespDestiny2TooltipLeave = function()
{
	UespD2Tooltip_LastElement = null;
	HideUespDestiny2Tooltip();
}


window.UpdateUespDestinyLinks = function()
{
	jQuery('.uespDestiny2Toolip').each(function() {
		var $this = jQuery(this);
		var itemid = $this.attr("itemid");
		
		if (itemid) $this.attr("href", "https://light.gg/db/items/" + parseInt(itemid) + "/");
	});
}


window.UespDestiny2FindTooltipLinks = function()
{
	jQuery("a").each(function() {
		var $this = jQuery(this);
		var href = $this.attr('href');
		
		if (href == null) return;
		
			//https://www.light.gg/db/items/136355432/mk-44-stand-asides/
			//https://light.gg/db/items/136355432/mk-44-stand-asides/
		var match = href.match(/https:\/\/www\.light\.gg\/db\/items\/([0-9]+)\/.*/);
		
		if (!match)
		{
			match = href.match(/https:\/\/light\.gg\/db\/items\/([0-9]+)\/.*/);
			
			if (!match)
			{
				match = href.match(/https:\/\/www\.light\.gg\/db\/collectibles\/([0-9]+)\/.*/);
				
				if (!match)
				{
					match = href.match(/https:\/\/light\.gg\/db\/collectibles\/([0-9]+)\/.*/);
					if (!match) return;
				}
				
				$this.attr("collectibleid", match[1]);
				$this.addClass('uespDestiny2Toolip');
				return;
			}
		}
		
		var hash = match[1];
		
		$this.attr("itemid", hash);
		$this.addClass('uespDestiny2Toolip');
	});
}


window.UespDestiny2FindTooltipImages = function()
{
	
	jQuery("img").each(function() {
		var $this = jQuery(this);
		var $parent = $this.parent();
		var src = $this.attr('src');
		
		if (src == null) return;
		
			// Ignore if parent is a link
		if ($parent.is('a')) return;
		
			//https://www.bungie.net/common/destiny2_content/icons/d8c01cef98518dbab0d895fc7b23c092.jpg
		var match = src.match(/https:\/\/www\.bungie\.net\/common\/destiny2_content\/icons\/([a-zA-Z0-9_]+\.[a-z]+)$/);
		if (!match) return;
		
		var filename = match[1];
		
		$this.attr("itemicon", filename);
		$this.addClass('uespDestiny2Toolip');
	});
}


jQuery( document ).ready(function()
{
	UespDestiny2FindTooltipLinks();
	UespDestiny2FindTooltipImages();
	
	jQuery('.uespDestiny2Toolip').hover(OnUespDestiny2TooltipEnter, OnUespDestiny2TooltipLeave);
	
	UpdateUespDestinyLinks();
});