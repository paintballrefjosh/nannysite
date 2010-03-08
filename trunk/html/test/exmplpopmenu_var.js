// (c) Ger Versluis 2000-2004 version 7.00, July 17, 2004
//  You may use this script on non commercial sites
//  www.burmees.nl/menu/


	// Globals effecting all menus
	var PopNoOffMenus=7;	// number of seperate menus
	var BaseHref="";		// Root of the site
	var PopRClick=7;		// Defines which menu reacts on right click. 0=none

	var PopMenuSlide="";
	var PopMenuSlide="progid:DXImageTransform.Microsoft.RevealTrans(duration=.5, transition=19)";
	var PopMenuSlide="progid:DXImageTransform.Microsoft.GradientWipe(duration=.5, wipeStyle=1)";

	var PopMenuShadow="";
	var PopMenuShadow="progid:DXImageTransform.Microsoft.DropShadow(color=#888888, offX=2, offY=2, positive=1)";
	var PopMenuShadow="progid:DXImageTransform.Microsoft.Shadow(color=#888888, direction=135, strength=3)";

	var PopMenuOpacity="";
	var PopMenuOpacity="progid:DXImageTransform.Microsoft.Alpha(opacity=75)";

	function P_BeforeStart(){return}
	function P_AfterBuild(){return}
	function P_BeforeFirstOpen(){return}
	function P_AfterCloseAll(){return}

	// Globals effecting one menu
	// Notation of PopMenu1 is different from PopMenu2. The result is the same. PopMenu1 is more understandable. PopMenu2 loads faster.

PopMenu1=new Array(		// global variables for PopMenu1
	6,			// number of main items
	0,			// Left position
	0,			// Top position
	"yellow",			// Normal font color
	"maroon",		// Normal back color
	"blue",			// High font color
	"yellow",			// High back color
	"yellow",			// Border color
	"times new roman",	// Fontfamily
	0,			// Bold
	0,			// Italic
	13,			// Font size in pixel
	1,			// First line horizontal
	1,			// First line permanent visible
	1,			// Border width
	"left",			// Text align "left", "center" or "right"
	.25,			// Horizontal overlap
	.25,			// Vertical overlap
	1000,			// Delay
	0,			// Right to left unfold
	"LyrOne",			// Target div
	0,			// Border between elements
	"left",			// Menu horizontal centered "left", "center" or "right"
	"top",			// Menu vertical centered "top", "center" or "bottom"
	BaseHref+"tri.gif",		// Arrow right
	5,			// Arrow Width
	10,			// Arrow Height
	BaseHref+"tridown.gif",	// Arrow down
	10,			// Arrow Width
	5,			// Arrow Height
	BaseHref+"trileft.gif",	// Arrow left
	5,			// Arrow Width
	10,			// Arrow Height
	2,			// Top padding
	2,			// Left padding
	0);			// Unfold On Click

//	Menu Items:
//	MenuX=new Array(ItemText, Link, background image, number of sub elements, height, width,bgcolor,bghighcolor,
//	fontcolor,fonthighcolor,bordercolor,fontfamily,fontsize,fontbold,fontitalic,textalign,statustext);
// 	Fontsize, fontbold and fontitalic are ignored when set to -1.
//	For rollover images ItemText format is:  "rollover?Image1.jpg?Image2.jpg"

//	Notation of PopMenu1_1 is different from PopMenu1_1_1. The result is the same. PopMenu1_1 is more understandable. PopMenu1_1_1 loads faster.

	PopMenu1_1=new Array(
		"rollover?"+BaseHref+"busts.jpg?"+BaseHref+"appies.jpg",	// ElementText
		"",		// ElementLink
		"",		// ElementBgImage
		1,		// ElementNoOfSubElements
		80,		// ElementHeight
		80,		// ElementWidth
		"red",		// ElementBgColor
		"yellow",		// ElementBgHighColor
		"yellow",		// ElementFontColor
		"red",		// ElementFontHighColor
		"white",		// ElementBorderColor
		"",		// ElementFontFamily
		-1,		// ElementFontSize in pixel
		-1,		// ElementBold
		-1,		// ElementItalic
		"left",		// ElementTextAlign
		"");		// ElementStatusText

		PopMenu1_1_1=new Array("Example1_1","file.htm","busts.jpg",1,18,160,"","","","","","",-1,-1,-1,"","");
			PopMenu1_1_1_1=new Array("<img src="+BaseHref+"\"busts.jpg\">","","",1,158,158,"","","","","","",-1,-1,-1,"","");
				PopMenu1_1_1_1_1=new Array("<img src="+BaseHref+"\"busts.jpg\">","","",1,128,128,"","","","","","",-1,-1,-1,"","");
					PopMenu1_1_1_1_1_1=new Array("<img src="+BaseHref+"\"busts.jpg\">","","",1,128,128,"","","","","","",-1,-1,-1,"","");
						PopMenu1_1_1_1_1_1_1=new Array("<img src="+BaseHref+"\"busts.jpg\">","","",1,128,128,"","","","","","",-1,-1,-1,"","");
							PopMenu1_1_1_1_1_1_1=new Array("<img src="+BaseHref+"\"busts.jpg\">","","",1,128,128,"","","","","","",-1,-1,-1,"","");
								PopMenu1_1_1_1_1_1_1_1=new Array("<img src="+BaseHref+"\"busts.jpg\">","","",1,128,128,"","","","","","",-1,-1,-1,"","");
									PopMenu1_1_1_1_1_1_1_1_1=new Array("<img src="+BaseHref+"\"busts.jpg\">","","",0,128,128,"","","","","","",-1,-1,-1,"","");
	PopMenu1_2=new Array("Example 2","file.htm","",5,18,125,"black","white","white","black","green","comic sans ms",15,1,1,"right","Own_Text");
		PopMenu1_2_1=new Array("Example2_1","file.htm","",0,20,200,"","","","","","",-1,-1,-1,"","");
		PopMenu1_2_2=new Array("Example2_2","file.htm","",0,20,200,"","","","","","",-1,-1,-1,"","");
		PopMenu1_2_3=new Array("Example2_3","file.htm","",0,20,200,"","","","","","",-1,-1,-1,"","");
		PopMenu1_2_4=new Array("Example2_4","file.htm","",3,20,200,"","","","","","",-1,-1,-1,"","");
			PopMenu1_2_4_1=new Array("Example2_4_1","file.htm","",0,40,100,"","","","","","",-1,-1,-1,"","");
			PopMenu1_2_4_2=new Array("Example2_4_2","file.htm","",2,40,100,"","","","","","",-1,-1,-1,"","");
				PopMenu1_2_4_2_1=new Array("Example2_4_2_1","file.htm","",0,20,400,"","","","","","",-1,-1,-1,"","");
				PopMenu1_2_4_2_2=new Array("Example2_4_2_2","file.htm","",1,20,400,"","","","","","",-1,-1,-1,"","");
					PopMenu1_2_4_2_2_1=new Array("<img src="+BaseHref+"\"busts.jpg\">","","",0,128,128,"","","","","","",-1,-1,-1,"","");
			PopMenu1_2_4_3=new Array("Example2_4_3","file.htm","",0,40,100,"","","","","","",-1,-1,-1,"","");
		PopMenu1_2_5=new Array("Example2_5","file.htm","",0,20,130,"","","","","","",-1,-1,-1,"","");
	PopMenu1_3=new Array("Example3","","",1,30,125,"red","yellow","yellow","red","","",-1,-1,-1,"center","");
		PopMenu1_3_1=new Array("Example3<br>Open file in new window<br>&nbsp;<br>Background image","javascript:NewWin=window.open(\"file.htm\",\"NWin\");window[\"NewWin\"].focus()","busts.jpg",0,300,500,"","","","","","",-1,-1,-1,"","");
	PopMenu1_4=new Array("Example4","file.htm","",0,18,50,"blue","silver","silver","blue","arial","",9,1,1,"","");
	PopMenu1_5=new Array("Example5","file.htm","",0,18,50,"gold","black","black","gold","","technical",-1,-1,1,"","");
	PopMenu1_6=new Array("Example6","file.htm","",0,18,100,"green","white","white","green","","arial",13,-1,-1,"","");

PopMenu2=new Array(1,-1,-1,"yellow","black","black","yellow","blue","arial",1,0,13,0,0,1,"left",.25,.25,2000,0,"",0,"left","top",BaseHref+"tri.gif",5,10,BaseHref+"tridown.gif",10,5,BaseHref+"trileft.gif",5,10,2,2,0);
	PopMenu2_1=new Array("<br>&nbsp;Top and Left -1","","",0,70,160,"","","","","","",-1,-1,-1,"","");

PopMenu3=new Array(1,-2,-2,"black","white","white","black","red","technical",1,0,18,0,0,1,"left",.25,.25,1000,0,"",0,"left","top",BaseHref+"tri.gif",5,10,BaseHref+"tridown.gif",10,5,BaseHref+"trileft.gif",5,10,15,15,0);
	PopMenu3_1=new Array("Top and Left -2","file.htm","",0,70,160,"","","","","","",-1,-1,-1,"","");

PopMenu4=new Array(1,0,0,"yellow","purple","purple","yellow","yellow","arial",1,0,11,0,0,1,"center",.25,.25,1000,0,"",0,"center","center",BaseHref+"tri.gif",5,10,BaseHref+"tridown.gif",10,5,BaseHref+"trileft.gif",5,10,2,2,0);
	PopMenu4_1=new Array("<br>&nbsp;Triggered by anchor,<br>position independent from anchor","","",1,90,180,"","","","","","",-1,-1,-1,"","");
		PopMenu4_1_1=new Array("Example1","file.htm","",1,18,160,"","","","","","",-1,-1,-1,"","");
			PopMenu4_1_1_1=new Array("Example1_1","file.htm","",1,18,160,"","","","","","",-1,-1,-1,"","");
				PopMenu4_1_1_1_1=new Array("<img src="+BaseHref+"\"busts.jpg\">","","",1,128,128,"","","","","","",-1,-1,-1,"","");
					PopMenu4_1_1_1_1_1=new Array("<img src="+BaseHref+"\"busts.jpg\">","","",0,128,128,"","","","","","",-1,-1,-1,"","");

PopMenu5=new Array(1,-2,-1,"yellow","black","black","yellow","blue","arial",1,0,13,0,0,1,"left",.25,.25,1000,0,"",0,"left","top",BaseHref+"tri.gif",10,20,BaseHref+"tridown.gif",20,10,BaseHref+"trileft.gif",10,20,2,2,0);
		PopMenu5_1=new Array("<br>&nbsp;move your mouse<br>&nbsp;over this example","","",1,70,160,"","","","","","",-1,-1,-1,"","");
			PopMenu5_1_1=new Array("<br>&nbsp;HorizontalOverlap=.25<br>&nbsp;VerticalOverlap=.25","","",0,70,200,"","","","","","",-1,-1,-1,"","");

PopMenu6=new Array(7,0,0,"white","blue","blue","white","black","comic sans ms",1,0,12,0,1,1,"right",.15,.85,1000,1,"LyrTwo",1,"left","top",BaseHref+"tri.gif",5,10,BaseHref+"tridown.gif",10,5,BaseHref+"trileft.gif",5,10,2,2,1);
		PopMenu6_1=new Array("Example relative positioned menu, first line vertical, right to left orientated, permanent visible, unfolds on click","","",0,120,160,"silver","silver","black","black","","",13,-1,-1,"center","");
		PopMenu6_2=new Array("Example1","file.htm","",1,20,0,"","","","","","",-1,-1,-1,"","");
			PopMenu6_2_1=new Array("Example1_1","file.htm","",0,18,160,"","","","","","",-1,-1,-1,"","");
		PopMenu6_3=new Array("Example2","file.htm","",5,30,160,"","","","","","",-1,-1,-1,"","");
			PopMenu6_3_1=new Array("Example2_1","file.htm","",0,20,200,"","","","","","",-1,-1,-1,"","");
			PopMenu6_3_2=new Array("Example2_2","file.htm","",0,20,200,"","","","","","",-1,-1,-1,"","");
			PopMenu6_3_3=new Array("Example2_3","file.htm","",0,20,200,"","","","","","",-1,-1,-1,"","");
			PopMenu6_3_4=new Array("Example2_4","file.htm","",3,20,200,"","","","","","",-1,-1,-1,"","");
				PopMenu6_3_4_1=new Array("Example2_4_1","file.htm","",0,40,100,"","","","","","",-1,-1,-1,"","");
				PopMenu6_3_4_2=new Array("Example2_4_2","file.htm","",0,40,100,"","","","","","",-1,-1,-1,"","");
				PopMenu6_3_4_3=new Array("Example2_4_3","file.htm","",0,40,100,"","","","","","",-1,-1,-1,"","");
			PopMenu6_3_5=new Array("Example2_5","file.htm","",0,20,200,"","","","","","",-1,-1,-1,"","");
		PopMenu6_4=new Array("Example3","","",1,40,160,"","","","","","",-1,-1,-1,"","");
			PopMenu6_4_1=new Array("Example3","","",0,300,500,"","","","","","",-1,-1,-1,"","");
		PopMenu6_5=new Array("Example4","file.htm","",0,50,160,"","","","","","",-1,-1,-1,"","");
		PopMenu6_6=new Array("Example5","file.htm","",0,60,160,"","","","","","",-1,-1,-1,"","");
		PopMenu6_7=new Array("Example6","file.htm","",0,70,160,"","","","","","",-1,-1,-1,"","");

PopMenu7=new Array(4,-1,-1,"black","silver","silver","black","black","arial",1,0,11,0,1,1,"left",.25,.25,1000,0,"",1,"left","top",BaseHref+"tri.gif",5,10,BaseHref+"tridown.gif",10,5,BaseHref+"trileft.gif",5,10,2,2,0);
		PopMenu7_1=new Array("Example use as context menu","file.htm","",0,20,200,"","","","","","",-1,-1,-1,"","");
		PopMenu7_2=new Array("Example use as context menu","","",3,20,200,"","","","","","",-1,-1,-1,"","");
			PopMenu7_2_1=new Array("Example use as context menu","","",0,20,200,"","","","","","",-1,-1,-1,"","");
			PopMenu7_2_2=new Array("Example use as context menu","","",0,20,200,"","","","","","",-1,-1,-1,"","");
			PopMenu7_2_3=new Array("Example use as context menu","","",0,20,200,"","","","","","",-1,-1,-1,"","");
		PopMenu7_3=new Array("Example use as context menu","","",0,20,200,"","","","","","",-1,-1,-1,"","");
		PopMenu7_4=new Array("Example use as context menu","","",0,20,200,"","","","","","",-1,-1,-1,"","");
