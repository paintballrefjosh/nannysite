// (c) Ger Versluis 2000-2004 version 7.00, July 8, 2004

	var PopNoOffMenus=2;
	var BaseHref="";
	var PopRClick=0;

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

PopMenu1=new Array(2,-1,-1,'white','blue','blue','white','black','comic sans ms,arial',1,0,10,0,0,1,'center',.25,.25,500,0,'',1,'left','top','tri.gif',5,10,'tridown.gif',10,5,'trileft.gif',5,10,2,2,0);
		PopMenu1_1=new Array("Anchor linked",'',"",2,20,120,"","","","","","",-1,-1,-1,"","");
			PopMenu1_1_1=new Array("<br>Anchor linked",'',"",0,60,120,"","","","","","",-1,-1,-1,"","");
			PopMenu1_1_2=new Array("Anchor linked",'',"",0,20,120,"","","","","","",-1,-1,-1,"","");
		PopMenu1_2=new Array("Anchor linked",'',"",1,0,0,"","","","","","",-1,-1,-1,"","");
			PopMenu1_2_1=new Array("<img src='appies.jpg'>",'',"",0,128,128,"","","","","","",-1,-1,-1,"","");
PopMenu2=new Array(2,150,0,'yellow','green','green','yellow','red','new times roman,arial',0,1,18,1,1,1,'center',.25,.5,500,0,'exampleid',1,'left','top','tri.gif',5,10,'tridown.gif',10,5,'trileft.gif',5,10,2,2,0);
		PopMenu2_1=new Array("rollover?appies.jpg?busts.jpg",'',"",2,100,100,"","","","","","",-1,-1,-1,"","");
			PopMenu2_1_1=new Array("Element1",'',"",2,30,160,"","","","","","",-1,-1,-1,"","");
				PopMenu2_1_1_1=new Array("SubElement1",'',"",0,30,180,"","","","","","",-1,-1,-1,"","");
				PopMenu2_1_1_2=new Array("SubElement2",'',"",2,0,0,"","","","","","",-1,-1,-1,"","");
					PopMenu2_1_1_2_1=new Array("SubSubElement1",'',"",0,30,200,"","","","","","",-1,-1,-1,"","");
					PopMenu2_1_1_2_2=new Array("SubSubElement2",'',"",0,0,0,"","","","","","",-1,-1,-1,"","");
			PopMenu2_1_2=new Array("Element2",'',"",0,0,0,"","","","","","",-1,-1,-1,"","");
		PopMenu2_2=new Array("Relative to tag",'',"",1,0,200,"","","","","","",-1,-1,-1,"","");
			PopMenu2_2_1=new Array("rollover?busts.jpg?appies.jpg",'',"",1,128,128,"","","","","","",-1,-1,-1,"","");
				PopMenu2_2_1_1=new Array("<img src='busts.jpg' width='128' height='128'>",'',"",1,128,128,"","","","","","",-1,-1,-1,"","");
					PopMenu2_2_1_1_1=new Array("<img src='busts.jpg' width='128' height='128'>",'',"",0,128,128,"","","","","","",-1,-1,-1,"","");
