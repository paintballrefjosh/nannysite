var popupMode=1; 

//--- Common
var isHorizontal=0;
var smColumns=1;
var smOrientation=0;
var smViewType=0;
var dmRTL=0;
var pressedItem=-2;
var itemCursor="default";
var itemTarget="_blank";
var statusString="link";
var blankImage="images/blank.gif";

//--- Dimensions
var menuWidth="";
var menuHeight="";
var smWidth="";
var smHeight="";

//--- Positioning
var absolutePos=0;
var posX="0";
var posY="0";
var topDX=0;
var topDY=3;
var DX=-5;
var DY=0;

//--- Font
var fontStyle="normal 10px Arial";
var fontColor=["#000000","#FFFFFF"];
var fontDecoration=["none","none"];
var fontColorDisabled="#AAAAAA";

//--- Appearance
var menuBackColor="#DC9489";
var menuBackImage="";
var menuBackRepeat="repeat";
var menuBorderColor="#C87D7D";
var menuBorderWidth=1;
var menuBorderStyle="solid";

//--- Item Appearance
var itemBackColor=["#E7B3A9","#883737"];
var itemBackImage=["",""];
var itemBorderWidth=0;
var itemBorderColor=["#E4E1DE","#FFFFFF"];
var itemBorderStyle=["solid","solid"];
var itemSpacing=0;
var itemPadding="5px 5px 5px 10px";
var itemAlignTop="left";
var itemAlign="left";
var subMenuAlign="";

//--- Icons
var iconTopWidth=24;
var iconTopHeight=24;
var iconWidth=30;
var iconHeight=15;
var arrowWidth=11;
var arrowHeight=11;
var arrowImageMain=["images/arrow_sub1.gif","images/arrow_sub2.gif"];
var arrowImageSub=["images/arrow_sub1.gif","images/arrow_sub2.gif"];

//--- Separators
var separatorImage="";
var separatorWidth="100%";
var separatorHeight="3";
var separatorAlignment="left";
var separatorVImage="";
var separatorVWidth="3";
var separatorVHeight="100%";
var separatorPadding="0px";

//--- Floatable Menu
var floatable=0;
var floatIterations=6;
var floatableX=1;
var floatableY=1;

//--- Movable Menu
var movable=0;
var moveWidth=12;
var moveHeight=20;
var moveColor="#AA0000";
var moveImage="";
var moveCursor="default";
var smMovable=0;
var closeBtnW=15;
var closeBtnH=15;
var closeBtn="";

//--- Transitional Effects & Filters
var transparency="85";
var transition=24;
var transOptions="";
var transDuration=400;
var transDuration2=200;
var shadowLen=4;
var shadowColor="#BBBBBB";
var shadowTop=1;

//--- CSS Support (CSS-based Menu)
var cssStyle=0;
var cssSubmenu="";
var cssItem=["",""];
var cssItemText=["",""];

//--- Advanced
var dmObjectsCheck=0;
var saveNavigationPath=1;
var showByClick=0;
var noWrap=1;
var pathPrefix_img="images/";
var pathPrefix_link="";
var smShowPause=200;
var smHidePause=1000;
var smSmartScroll=1;
var topSmartScroll=0;
var smHideOnClick=1;
var dm_writeAll=0;

//--- AJAX-like Technology
var dmAJAX=0;
var dmAJAXCount=0;

//--- Dynamic Menu
var dynamic=0;

//--- Keystrokes Support
var keystrokes=1;
var dm_focus=1;
var dm_actKey=113;


var menuItems = [

    ["Home","testlink.htm"],
    ["Product Info",""],
        ["|Features","testlink.htm"],
        ["|Installation",""],
            ["||Description of Files","testlink.htm"],
            ["||How To Setup","testlink.htm"],
        ["|Parameters Info","testlink.htm"],
        ["|Dynamic Functions","testlink.htm"],
        ["|Supported Browsers",""],
            ["||Windows OS",""],
                ["|||Internet Explorer",""],
                ["|||Firefox",""],
                ["|||Mozilla",""],
                ["|||Opera",""],
                ["|||Netscape Navigator",""],
            ["||MAC OS",""],
                ["|||Firefox",""],
                ["|||Safari",""],
                ["|||Internet Explorer",""],
            ["||Unix/Linux OS",""],
                ["|||Firefox",""],
                ["|||Konqueror",""],
    ["Samples",""],
        ["|Sample 1","testlink.htm"],
        ["|Sample 2","testlink.htm"],
        ["|Sample 3","testlink.htm"],
        ["|Sample 4","testlink.htm"],
        ["|Sample 5","testlink.htm"],
        ["|Sample 6","testlink.htm"],
    ["Purchase","testlink.htm"],
    ["Contact Us","testlink.htm"],
];

apy_init();

