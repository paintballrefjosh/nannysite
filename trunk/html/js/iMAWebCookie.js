var VTRENZ = {};

VTRENZ.Class = {
  create: function() {
    return function() {
      this.initialize.apply(this, arguments);
    }
  }
}

VTRENZ.iMAWebCookie = VTRENZ.Class.create();

VTRENZ.iMAWebCookie.prototype.parent = function(type) {
  var p = new Object();
  for (x in type.prototype) {
    if (x != "parent") {
      p[x.toString()] = this[x.toString()];          
    }
  }   
  return p;  
}

VTRENZ.iMAWebCookie.prototype = {
	initialize: function() {
		this.accesskey = "";
		this.pageparams = {pagename: "", referrer: document.referrer};
		this.urlparams = {};
		this.webservicedomain = location.protocol + "//gw-services.vtrenz.net/";
//		this.legacyWebCookieName = "com.vtrenz.iMAWebCookie";
//		this.legacyImaCookieName = "com.vtrenz.iMASyncCookie";
		this.webCookieName = "com.vtrenz.iMAWebCookie";
		this.imaCookieName = "com.vtrenz.iMA.imaSyncID";
		this.cidCookieName = "com.vtrenz.iMA.imaCID";
		this.webSyncID = "";
		this.imaSyncID = "";
		this.contactID = 0;
		this.isNew = 0;
		
		
		this.main();
	},

	getPageParameters: function() {
		var metatags = document.getElementsByTagName("meta");
		
		//Look for meta data parameters
		for(var i=0; i<metatags.length; i++) {
			if(! metatags[i].name.match(/^com\.vtrenz\.(pagename|referrer)$/i))
				continue;
		
			if(metatags[i].name.match(/^com\.vtrenz\.pagename$/i))
				this.pageparams.pagename = metatags[i].content;
		
			if(metatags[i].name.match(/^com\.vtrenz\.referrer$/i) && metatags[i].content != "")
				this.pageparams.referrer = metatags[i].content;	
		}
		
		//Override meta data parameter with url parameter - PRECEDENCE
		if(this.urlparams.vpagename && this.urlparams.vpagename != "")
			this.pageparams.pagename = this.urlparams.vpagename;
		
		if(this.urlparams.vreferrer && this.urlparams.vreferrer != "")
			this.pageparams.referrer = this.urlparams.vreferrer;
	}
};

VTRENZ.iMAWebCookie.prototype.main = function() {
//	var legacyWebSyncID = this.readCookie(this.legacyWebCookieName);
//	var legacyImaSyncID = this.readCookie(this.legacyImaCookieName);

	this.webSyncID = this.readCookie(this.webCookieName);
	this.imaSyncID = this.readCookie(this.imaCookieName);
	this.contactID = this.readCookie(this.cidCookieName);
	
//	//Check for legacy cookies and erase if new cookies exist or copy into new cookies.
//	if(this.webSyncID == '' && legacyWebSyncID != ''){
//		this.createCookie(this.webCookieName,legacyWebSyncID,1000);
//		this.webSyncID = legacyWebSyncID;
//		this.eraseCookie(this.legacyWebCookieName);
//	}
	
//	if(this.imaSyncID == '' && legacyImaSyncID != ''){
//		this.createCookie(this.imaCookieName,legacyImaSyncID,1000);
//		this.imaSyncID = legacyImaSyncID;
//		this.eraseCookie(this.legacyImaCookieName);
//	}
	
	//Check to see if cookie does not exists
	if(this.webSyncID == '')
		this.webSyncID = this.generateWebSyncID();
	
	//write cookie to keep it from expiring and ultimately losing the GUID
	if(this.webSyncID.length > 0)
		this.createCookie(this.webCookieName,this.webSyncID,1000);
	else
		return false;
			
	//Get AccessKey
	this.getAccessKey();

	//Initialize urlparams
	this.getUrlParameters();
	
	//Get pageparams
	this.getPageParameters();
	
	//Get contactID if present
	if(this.urlparams.vcontactid && this.urlparams.vcontactid != '' && (this.contactID == 0 || this.contactID == '')) {
		this.contactID = this.urlparams.vcontactid;
		this.createCookie(this.cidCookieName,this.urlparams.vcontactid,1000);
	} else if(this.urlparams.vcontactid && this.urlparams.vcontactid != '' && this.urlparams.vcontactid != this.contactID) {
		this.eraseCookie(this.cidCookieName);
		this.eraseCookie(this.webCookieName);

		this.webSyncID = this.generateWebSyncID();
		this.contactID = this.urlparams.vcontactid;

		this.createCookie(this.webCookieName,this.webSyncID,1000);
		this.createCookie(this.cidCookieName,this.contactID,1000);
	} else if(this.urlparams.contactid && this.urlparams.contactid != '' && (this.contactID == 0 || this.contactID == '')) {
		this.contactID = this.urlparams.contactid;
		this.createCookie(this.cidCookieName,this.urlparams.contactid,1000);
	} else if(this.urlparams.contactid && this.urlparams.contactid != '' && this.urlparams.contactid != this.contactID) {
		this.eraseCookie(this.cidCookieName);
		this.eraseCookie(this.webCookieName);

		this.webSyncID = this.generateWebSyncID();
		this.contactID = this.urlparams.contactid;

		this.createCookie(this.webCookieName,this.webSyncID,1000);
		this.createCookie(this.cidCookieName,this.contactID,1000);
	} else if(this.contactID == '') {
		this.contactID = 0;
	}

	//write cookie to keep imaSyncId if it doesn't already exist
	if(this.urlparams.vimasyncid && this.urlparams.vimasyncid != '' && this.imaSyncID == '') {
		this.imaSyncID = this.urlparams.vimasyncid;
		this.createCookie(this.imaCookieName,this.urlparams.vimasyncid,1000);
	}
	else if(this.urlparams.vimasyncid && this.urlparams.vimasyncid != '' && this.urlparams.vimasyncid != this.imaSyncID){
			this.eraseCookie(this.imaCookieName);
			this.eraseCookie(this.webCookieName);
			
			this.webSyncID = this.generateWebSyncID();
			this.imaSyncID = this.urlparams.vimasyncid;
			
			this.createCookie(this.webCookieName,this.webSyncID,1000);
			this.createCookie(this.imaCookieName,this.imaSyncID,1000);
	}
	else if(this.imaSyncID.length > 0)
		this.createCookie(this.imaCookieName,this.imaSyncID,1000);
	
	//Register page visit
	this.registerPageVisit();
};

VTRENZ.iMAWebCookie.prototype.generateWebSyncID = function() {
	this.isNew = 1;
	var g = '';
	for(var i = 0; i < 32; i++)
		g += Math.floor(Math.random() * 0xF).toString(0xF) + (i == 7 || i == 11 || i == 15 || i == 19 ? "-" : "")

	return g;
};

VTRENZ.iMAWebCookie.prototype.getAccessKey = function() {
	var scripttags = document.getElementsByTagName("script");
	for(var i=0; i<scripttags.length; i++) {
		if(scripttags[i].src && scripttags[i].src.match(/iMAWebCookie\.js(\?.*)$/i)) {
			this.accesskey = scripttags[i].src.replace(/^.*iMAWebCookie\.js\?(.*)$/i,'$1');
			return;
		}
	}
};

VTRENZ.iMAWebCookie.prototype.registerPageVisit = function() {
	var params = 'webSyncID='+this.webSyncID+'&accesskey='+this.accesskey+'&pagename='+this.pageparams.pagename;
	params += '&hostname='+location.hostname+'&pathname='+encodeURIComponent(location.pathname)+'&referrer='+encodeURIComponent(this.pageparams.referrer)
	params += '&contactID='+this.contactID+'&imaSyncID='+this.imaSyncID+'&isNew='+this.isNew;

	var url = this.webservicedomain + 'WebCookies/RegisterWebPageVisit.cfm/';
//	VTRENZ.Ajax.Request.request(url, params);
	var head = document.getElementsByTagName("head").item(0);
    var script = document.createElement("script");
    script.setAttribute("type", "text/javascript");
    script.setAttribute("src", url+'?'+params);
    head.appendChild(script);
};

VTRENZ.iMAWebCookie.prototype.createCookie = function(name, value, days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	
	document.cookie = name+"="+value+expires+"; path=/";
};

VTRENZ.iMAWebCookie.prototype.eraseCookie = function(name) {
	this.createCookie(name, "", -1);
};

VTRENZ.iMAWebCookie.prototype.readCookie = function(name) {
	var ca = document.cookie.split(';');
	var nameEQ = name + "=";
	
	for(var i=0; i < ca.length; i++) {
		var c = ca[i];

		while (c.charAt(0)==' ')
			c = c.substring(1, c.length); //delete spaces

		if (c.indexOf(nameEQ) == 0) {
			var value = c.substring(nameEQ.length, c.length);
			this.createCookie(name, value, 1000);

			return value;
		}
	}
	
	return "";
};

VTRENZ.iMAWebCookie.prototype.getUrlParameters = function() {
	var params = document.URL;
	params = params.substr(params.indexOf("?")+1);

	var nameValuePairs = params.split("&");
	
	for(var i=0; i<nameValuePairs.length; i++) {
		var pair = nameValuePairs[i].split("=");
		this.urlparams[pair[0].toLowerCase()] = unescape(pair[1]);
	}
};

VTRENZ.Try = {
  these: function() {
    var returnValue;

    for (var i = 0; i < arguments.length; i++) {
      var lambda = arguments[i];
      try {
        returnValue = lambda();
        break;
      } catch (e) {}
    }

    return returnValue;
  }
};

VTRENZ.Ajax = {
  getTransport: function() {
    return VTRENZ.Try.these(
      function() {return new XMLHttpRequest()},
      function() {return new ActiveXObject('Msxml2.XMLHTTP')},
      function() {return new ActiveXObject('Microsoft.XMLHTTP')}
    ) || false;
  }
};

VTRENZ.Ajax.Request = {
  request: function(url, params) {
    this.transport = VTRENZ.Ajax.getTransport();
	this.status = true;
    this.url = url;
    this.method = "POST";

    try {
      this.transport.open(this.method, this.url, true);
      this.transport.onreadystatechange = function(){};
      this.setRequestHeaders();

	  if (/Konqueror|Safari|KHTML/.test(navigator.userAgent))
        params += '&_=';

      this.body = params;
      this.transport.send(this.body);
    }
    catch (e) {
      this.status = false;
    }
  },
  
  setRequestHeaders: function() {
    var headers = {
      'X-Requested-With': 'XMLHttpRequest',
      'Accept': 'text/javascript, text/html, application/xml, text/xml, */*'
    };

	headers['Content-type'] = 'application/x-www-form-urlencoded; charset=UTF-8';

	/* Force "Connection: close" for older Mozilla browsers to work
	* around a bug where XMLHttpRequest sends an incorrect
	* Content-length header. See Mozilla Bugzilla #246651.
	*/
	if (this.transport.overrideMimeType &&
	  (navigator.userAgent.match(/Gecko\/(\d{4})/) || [0,2005])[1] < 2005)
		headers['Connection'] = 'close';

    for (var name in headers)
      this.transport.setRequestHeader(name, headers[name]);
  }
};

new VTRENZ.iMAWebCookie();
