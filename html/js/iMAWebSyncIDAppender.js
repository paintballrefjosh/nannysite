function iMAWebSyncIDAppender() {
	var cookieName = 'com.vtrenz.iMAWebCookie';
	var iMAWindowOnLoad;
	
	this.main = function() {
		if(window.onload) iMAWindowOnLoad = window.onload;
		window.onload = _iMAWebSyncIDAppender.appendCookieToLinks;
	}

	this.appendCookieToLinks = function() {
		if(iMAWindowOnLoad) iMAWindowOnLoad();
		
		var webSyncID = readCookie(cookieName);
		
		if(webSyncID) {
			var linkarray = document.getElementsByTagName("A");
			var metatags = document.getElementsByTagName("meta");
			var param = 'webSyncID=' + webSyncID;										
		    
			for(var i=0; i< metatags.length; i++) {
				if(! metatags[i].name.match(/^com\.vtrenz\.(brandeddomains)$/i))
					continue;
				if(metatags[i].name.match(/^com\.vtrenz\.brandeddomains$/i))
					var brandeddomains = metatags[i].content;
				
			}
			
			// look for domains separated by comma
			var domainarray = [];
			if(brandeddomains)
				domainarray=brandeddomains.split(',');
              
			for(var i=0; i<linkarray.length; i++) {
				var href = linkarray[i].href;
				var appendWebSyncID = false;
				
				if(href.indexOf("://gw.vtrenz") > 0)
					appendWebSyncID = true;
				else {
					for(var x=0; x<domainarray.length; x++) {
						if(href.indexOf(domainarray[x]) > 0) {
							appendWebSyncID = true;
							break;
						}
					}
				}
		
				if(appendWebSyncID) {
					if(href.indexOf("?") > 0)
						linkarray[i].href += '&' + param;						
					else
						linkarray[i].href += '?' + param;
				}
					
			}
		}
	}

	var readCookie = function(name) {
		var ca = document.cookie.split(';');
		var nameEQ = name + "=";
		
		for(var i=0; i < ca.length; i++) {
			var c = ca[i];

			while (c.charAt(0)==' ')
				c = c.substring(1, c.length); //delete spaces

			if (c.indexOf(nameEQ) == 0)
				return c.substring(nameEQ.length, c.length);
		}
		
		return "";
	}
}

var _iMAWebSyncIDAppender = new iMAWebSyncIDAppender();
_iMAWebSyncIDAppender.main();
