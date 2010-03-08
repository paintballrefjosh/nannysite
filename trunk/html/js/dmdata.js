var dmAJAX=0;
var dmObjectsCheck = 0;

var dmRTL=0;

var dynamic=0;
var smHideOnClick=1;
var itemAlignTop="left";
var smSmartScroll=1;


//-- Keyboard Support
var keystrokes = 1;
var dm_actKey  = 113;
var dm_focus   = 1;

var dm_writeAll=0;

//-- Delays
var smShowPause = 200;
var smHidePause = 1000;

//-- Submenus appearance
var smViewType = 0;
var smColumns = 1;
var smWidth   = 0;
var smHeight  = 0;

// -- CSS Support
var cssStyle     = 1;
var cssSubmenu   = 'dmSubmenu';
var cssItem      = ['dmItem1','dmItem2'];
var cssItemText  = ['dmText1','dmText2'];

//-- Common
var smOrientation = 0;
var noWrap = 1;
var isHorizontal = 1;
var saveNavigationPath = 1;
var showByClick = 0;
var pressedItem = -1;
var blankImage = "images/blank.gif";
var statusString = "link";

var pathPrefix_link  = "";
var pathPrefix_img   = "images/"


//-- Menu
var menuWidth = "100%";
var menuHeight = "";
var menuBorderWidth = 1;
var menuBorderStyle = "";
var menuBackImage = "";
var menuBackRepeat = "";

//-- Menu Positioning
var absolutePos = 0;
var posX = 0;
var posY = 0;

//-- Floatable
var floatable = 0;
var floatIterations = 6;
var floatableX=1;
var floatableY=1;

//-- Movable
var movable = 0;
var smMovable = 0;
var moveWidth = 12;
var moveHeight = 20;
var moveCursor = "default";
var moveImage = "";
var moveColor = "#AAAAAA";

//-- Submenus Positioning
var topDX = 0;
var topDY = 0;
var DX = -2;
var DY = -1;

//-- Font
var fontStyle = "";
var fontColor = ["",""];
var fontDecoration = ["",""];
var fontColorDisabled = "#AAAAAA";

//-- Items
var itemBorderWidth = 1;
var itemBorderStyle = ["",""];
var itemBackImage = ["",""];
var itemAlign = "";
var subMenuAlign = "";
var itemSpacing = 2;
var itemPadding = "2px";
var itemCursor = "";
var itemTarget = "_self";

//-- Colors
var menuBackColor = "";
var menuBorderColor = "";
var itemBackColor   = ["",""];
var itemBorderColor = [""," "];

//-- Icons
var iconTopWidth = 0;
var iconTopHeight = 0;
var iconWidth = 17;
var iconHeight = 16;
var arrowImageMain = ["",""];
var arrowImageSub = ["arrow1.gif","arrow1.gif"];
var arrowWidth = 11;
var arrowHeight = 12;

//-- Separators
var separatorWidth = "100%";
var separatorHeight = "1";
var separatorAlignment = "left";
var separatorImage = "msep.gif";
var separatorVWidth = "3";
var separatorVHeight = "100%";
var separatorVImage = "";
var separatorPadding = "4px 4px 4px 30px";

//-- Visual Effects
var transparency = "100";
var transition = 24;
var transDuration  = 200;
var transDuration2 = 100;
var transOptions = "gradientSize=1, wipestyle=1, motion=forward";
var shadowLen = 2;
var shadowTop = 0;
var shadowColor = "#222222";


var menuStyles = [
    ['CSS=dmSubmenuTop',"itemSpacing=0"],
];


var itemStyles = [
    ['CSS=dmItemTop11,dmItemTop12',"CSSText=dmTextTop1,dmTextTop2"],
    ['CSS=dmItemTop21,dmItemTop22',"CSSText=dmTextTop1,dmTextTop2"],
    ['CSS=dmItemTop31,dmItemTop32',"CSSText=dmTextTop1,dmTextTop2"],
    ['CSS=dmItemTop41,dmItemTop42',"CSSText=dmTextTop1,dmTextTop2"],
    ['CSS=dmItemTop51,dmItemTop52',"CSSText=dmTextTop1,dmTextTop2"],
    ['CSS=dmItemTop61,dmItemTop62',"CSSText=dmTextTop1,dmTextTop2"],
];


var item1  = '<div align=center><img src="images/';
var item2 = '.gif" width=34 height=32 vspace=3><br>';
var item3 = '</div>';
