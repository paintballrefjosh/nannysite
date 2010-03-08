// (c) Ger Versluis 2000-2004 version 7.00, July 14, 2004
//  You may use this script on non commercial sites
//  www.burmees.nl/menu/

	var PosStrt=0;
	if(document.getElementById){
		var 	AgntUsr=navigator.userAgent.toLowerCase(),AppVer=navigator.appVersion.toLowerCase(),
			Opr7=AgntUsr.indexOf("opera")!=-1&&parseInt(AgntUsr.substring(AgntUsr.indexOf("opera")+6))>6?true:false;
		if(AgntUsr.indexOf("opera")==-1||Opr7){
			PosStrt=1;
			var 	Mzzlla=(AgntUsr.indexOf('mozilla')!=-1&&AgntUsr.indexOf('compatible')==-1)||Opr7?1:0,
				MsExp=AgntUsr.indexOf('msie')!=-1&&!Opr7?1:0,
				Exp6Plus=(AppVer.indexOf("msie 6")!= -1||AppVer.indexOf("msie 7")!= -1)&&!Opr7?1:0,
				MacExp5=AppVer.indexOf("mac")!=-1&&AppVer.indexOf("msie 5")!=-1?1:0,
				P_WW,P_WH,P_RcrsLvl=0,P_Crtd=0,P_IniFlg,P_ShwFlg=0,
				P_FrstMnu=null,P_CrrntOvr=null,P_FC=null,P_RCCnt=null,
				P_ClsTmr,P_Ztp=100,
				P_show="visible",P_hide="hidden",P_px="px",P_Html=null,P_Cmplnt=0,P_Pd,
				P_Win,P_Doc,P_Bod}}
	
function Pop_Go(){
	if(PosStrt){
		P_BeforeStart();
		P_Win=window;P_Doc=P_Win.document;P_Bod=P_Doc.body;
		if((Exp6Plus||Opr7)&&document.compatMode){
			P_Html=P_Doc.getElementsByTagName("HTML")[0];P_Cmplnt=P_Doc.compatMode.indexOf('CSS')==-1?0:1}
		P_Pd=(Mzzlla&&!Opr7)||MacExp5||P_Cmplnt?1:0;
		P_Crtd=0; 
		P_Create();
		P_Pos();
		P_Initiate();
		P_Win.onresize=P_Pos;
		if(PopRClick){
			document.onmouseup=P_RClick;
			document.oncontextmenu=new Function("return false")}
		if(MsExp)P_Bod.onunload=P_KillMenu;
		P_Crtd=1;
		P_AfterBuild()}}

function P_RClick(e){
	var Evnt=MsExp?event:e,But=Evnt.button;
	if(But==2){P_Initiate();PopMenu("PopMenu"+PopRClick,Evnt)}
	else if(P_RCCnt.style.visibility==P_show)P_Initiate()}

function P_Pos(){
	var i,MPntr=P_FrstMnu,PreLft,PreTp,TP,Sz,PA;
	P_WW=MsExp?P_Cmplnt?P_Html.clientWidth:P_Bod.clientWidth:P_Win.innerWidth;
	P_WH=MsExp?P_Cmplnt?P_Html.clientHeight:P_Bod.clientHeight:P_Win.innerHeight;
	for(i=0;i<PopNoOffMenus;i++){
		PreLft=PreTp=0;
		PA=MPntr.PropArr;
		if(PA[20]){
			TP=P_Doc.getElementById(PA[20]);
			while(TP){PreTp+=TP.offsetTop;PreLft+=TP.offsetLeft;TP=TP.offsetParent}}
		if(PA[22]!='left'){Sz=P_WW-parseInt(MPntr.style.width);PreLft+=PA[22]=='right'?Sz:Sz/2}
		if(PA[23]!='top'){Sz=P_WH-parseInt(MPntr.style.height);PreTp+=PA[23]=='bottom'?Sz:Sz/2}
		P_PosMenu(MPntr,(MPntr.StrtTp+PreTp),(MPntr.StrtLft+PreLft));
		MPntr=MPntr.PrvMnu}}

function P_PosMenu(CntPtr,Tp,Lt){
	var 	Tpi,Lefti,Hori, SubTp,SubLt,CCW,
		CPSt=CntPtr.style,Mmbr=CntPtr.FrstMmbr,MSt=Mmbr.style,PA=CntPtr.PropArr,
		Bw=PA[14],Bbtw=PA[21],Hovl=PA[16],Vovl=PA[17],
		P_PadLft=Mmbr.value.indexOf('<')==-1?P_Pd?PA[34]:0:0,P_PadTp=Mmbr.value.indexOf('<')==-1?P_Pd?PA[33]:0:0,
		MbrWdt=parseInt(Mmbr.style.width)+P_PadLft,MbrHgt=parseInt(Mmbr.style.height)+P_PadTp,
		CntWdt=parseInt(CPSt.width),CntHgt=parseInt(CPSt.height);
	CPSt.top=CntPtr.ulyr.top=Tp+P_px;CPSt.left=CntPtr.ulyr.left=Lt+P_px;
	CntPtr.OrgTp=Tp;CntPtr.OrgLft=Lt;
	P_RcrsLvl++;
	if(P_RcrsLvl==1 && PA[12]){	Hori=1;Lefti=CntWdt-MbrWdt-2*Bw;Tpi=0}
	else{Hori=Lefti=0;Tpi=CntHgt-MbrHgt-2*Bw}
	while(Mmbr!=null){
		MSt.left=Lefti+Bw+P_px;MSt.top=Tpi+Bw+P_px;
		if(Mmbr.ChldCntnr){
			CCW=parseInt(Mmbr.ChldCntnr.style.width);
			if(Hori){	SubTp=Tpi+MbrHgt+Bw;SubLt=Lefti}
			else{	if(PA[19]){SubLt=Lefti-CCW+Hovl*MbrWdt+Bw;SubTp=Tpi+(1-Vovl)*MbrHgt}
				else {SubLt=Lefti+(1-Hovl)*MbrWdt+Bw;SubTp=Tpi+(1-Vovl)*MbrHgt}}
			P_PosMenu(Mmbr.ChldCntnr,SubTp,SubLt)}
		Mmbr=Mmbr.PrvMbr;
		if(Mmbr){MSt=Mmbr.style;
			P_PadLft=Mmbr.value.indexOf('<')==-1?P_Pd?PA[34]:0:0;
			P_PadTp=Mmbr.value.indexOf('<')==-1?P_Pd?PA[33]:0:0;
			MbrWdt=parseInt(MSt.width)+P_PadLft;
			MbrHgt=parseInt(MSt.height)+P_PadTp;
			Hori?Lefti-=Bbtw?(MbrWdt+Bw):MbrWdt:Tpi-=Bbtw?(MbrHgt+Bw):MbrHgt}}
	P_RcrsLvl--}

function P_Initiate(){
	var MPntr=P_FrstMnu;
	while(MPntr){P_ResetHide(MPntr);MPntr=MPntr.PrvMnu}}

function P_KillMenu(){
	var MPntr=P_FrstMnu,MPntr2=null;
	while(MPntr){
		MPntr2=MPntr;
		P_Kill(MPntr);
		MPntr=MPntr.PrvMnu;
		MPntr2.PrvMnu=MPntr2.FrstMmbr=MPntr2.PrevCntnr=MPntr2.PropArr=null;MPntr2=null}
	P_FrstMnu=P_CrrntOvr=P_FC=P_Html=P_ClsTmr=P_Win=P_Doc=P_Bod=null}

function P_Kill(MP){
	var Mbr=MP.FrstMmbr,Mbr2=null;
	while(Mbr!=null){
		Mbr2=Mbr;
		if(Mbr.ChldCntnr){
			P_Kill(Mbr.ChldCntnr);
			Mbr.ChldCntnr.PropArr=Mbr.ChldCntnr.FrstMmbr=Mbr.ChldCntnr.PrvMnu=Mbr.ChldCntnr.PrevCntnr=null;Mbr.ChldCntnr=null}
		Mbr=Mbr.PrvMbr;
		Mbr2.FCntnr=Mbr2.PrvMbr=Mbr2.Arr=null;Mbr2=null}
	MP=null}

function P_Reset(){
	if(P_IniFlg){
		var ItemPntr=P_CrrntOvr.FCntnr;
		P_ResetHide(ItemPntr);
		if(P_ShwFlg)P_AfterCloseAll();P_ShwFlg=0}}

function P_LwItem(P){
	if(P.ro)P_Doc.images[P.rid].src=P.ri1;
	else{	if(P.Arr[6])P.style.backgroundColor=P.Arr[6];
		P.style.color=P.Arr[8]}}

function P_HLItem(P){
	P.hl=1;
	if(P.ro)P_Win.document.images[P.rid].src=P.ri2;
	else{	if(P.Arr[7])P.style.backgroundColor=P.Arr[7];
		P.style.color=P.Arr[9]}}

function P_ResetHide(Cpntr){
	var Mbr=Cpntr.FrstMmbr,Cst=Cpntr.style,PA=Cpntr.PropArr;
	Cst.visibility=Cpntr.ulyr.style.visibility=!(PA[13]&&Cpntr.Lvl==1)?P_hide:P_show;
	while(Mbr!=null){
		if(Mbr.hl){Mbr.hl=0;
			Mbr.FCntnr.Clckd=0;
			P_LwItem(Mbr)}
		if(Mbr.ChldCntnr) P_ResetHide(Mbr.ChldCntnr);
		Mbr=Mbr.PrvMbr}}

function P_ClearAllChilds(Pntr){
	var CPstl=null;
	while (Pntr){
		if(Pntr.hl){Pntr.hl=0;
			P_LwItem(Pntr);
			if(Pntr.ChldCntnr){
				CPstl=Pntr.ChldCntnr.style;
				CPstl.visibility=Pntr.ChldCntnr.ulyr.style.visibility=P_hide;
				P_ClearAllChilds(Pntr.ChldCntnr.FrstMmbr)}
			break}
		Pntr=Pntr.PrvMbr}}	

function P_GoTo(){
	if(this.LinkTxt){
		var P_tmp;
		status=''; 
		this.style.backgroundColor=this.Arr[6];
		this.style.color=this.Arr[8];
		if(this.LinkTxt.indexOf('javascript:')!=-1)eval(this.LinkTxt);
		else{P_tmp=BaseHref+this.LinkTxt;P_Win.location.href=P_tmp}}}	

function PopMenu(WMnu,Evnt){
	if(P_Crtd){
		var 	Tp,Lft,Pntr=null,
			P_TpScrlld=MsExp?P_Cmplnt?P_Html.scrollTop:P_Bod.scrollTop:P_Win.pageYOffset,
			P_LftScrlld=MsExp?P_Cmplnt?P_Html.scrollLeft:P_Bod.scrollLeft:P_Win.pageXOffset,
			EventX=Evnt.clientX+P_LftScrlld,EventY=Evnt.clientY+P_TpScrlld;
		Pntr=P_FrstMnu;
		WMnu=PopNoOffMenus-WMnu.substr(7,WMnu.length-7);
		while(WMnu){Pntr=Pntr.PrvMnu;WMnu--}
		P_CrrntOvr=Pntr.FrstMmbr;
		P_Initiate();
		var 	CntStl=Pntr.style,
			CntHt=parseInt(CntStl.height),CntWt=parseInt(CntStl.width);
		Tp=Pntr.OrgTp==-1?EventY:Pntr.OrgTp==-2?EventY-CntHt/2:Pntr.OrgTp;
		Lft=Pntr.OrgLft==-1?Pntr.PropArr[19]?EventX-CntWt:EventX:Pntr.OrgLft==-2?EventX-CntWt/2:Pntr.OrgLft;
		if((Pntr.OrgTp==-1||Pntr.OrgTp==-2)&&!Pntr.PropArr[13]){
			if(Tp+CntHt>P_WH+P_TpScrlld)Tp-=Pntr.OrgTp==-1?CntHt:CntHt/2;
			if(Lft+CntWt>P_WW+P_LftScrlld)Lft-=Pntr.OrgLft==-1?CntWt:CntWt/2;
			if(Tp<P_TpScrlld)Tp=P_TpScrlld;
			if(Lft<P_LftScrlld)Lft=P_LftScrlld}
		CntStl.top=Pntr.ulyr.style.top=Tp+P_px;CntStl.left=Pntr.ulyr.style.left=Lft+P_px;
		if(Exp6Plus&&PopMenuSlide){Pntr.filters[0].Apply();Pntr.filters[0].play()}
		CntStl.visibility=Pntr.ulyr.style.visibility=P_show;
		P_IniFlg=0}}

function P_OpenMenuClick(e){
	if(P_Crtd){
		if(!this.FCntnr.Clckd){
			var x,y;
			if(P_CrrntOvr==this||!P_Crtd){P_IniFlg=0;return}
			if(P_CrrntOvr){
				x=P_CrrntOvr.FCntnr;y=this.FCntnr;
				x!=y&&x?P_ResetHide(x):P_ClearAllChilds(this.Contnr.FrstMmbr)}
			else P_ClearAllChilds(this.Contnr.FrstMmbr);
			P_CrrntOvr=this; P_IniFlg=0;
			P_HLItem(this);
			status=this.Arr[16]}
		else P_OpenGnrl(this)}}

function P_OpenGnrl(P){
	var 	PA=P.Contnr.PropArr,Lft,Tp,x,y,
		P_TpScrlld=MsExp?P_Cmplnt?P_Html.scrollTop:P_Bod.scrollTop:P_Win.pageYOffset,
		P_LftScrlld=MsExp?P_Cmplnt?P_Html.scrollLeft:P_Bod.scrollLeft:P_Win.pageXOffset,
		ChldCont=P.ChldCntnr;PCSt=P.Contnr.style,PSt=P.style,
		ContTp=parseInt(PCSt.top),ContLft=parseInt(PCSt.left),CntWt=parseInt(PCSt.width),
		ThisHt=parseInt(PSt.height),ThisWt=parseInt(PSt.width);
	if(ChldCont)P.FCntnr.Clckd=1;
	if(P_CrrntOvr){
		x=P_CrrntOvr.FCntnr;y=P.FCntnr;
		x!=y&&x?P_ResetHide(x):P_ClearAllChilds(P.Contnr.FrstMmbr)}
	else P_ClearAllChilds(P.Contnr.FrstMmbr);
	P_CrrntOvr=P; P_IniFlg=0;
	P_HLItem(P);
	if(ChldCont!=null){
		if(!P_ShwFlg){P_ShwFlg=1;P_BeforeFirstOpen()}
		var 	CCSt=P.ChldCntnr.style,
			CCW=parseInt(CCSt.width),CCH=parseInt(CCSt.height);
		Tp=ChldCont.OrgTp+ContTp;Lft=ChldCont.OrgLft+ContLft;
		if(PA[19]){
			if(Lft<P_LftScrlld)Lft=PA[12]&&P.Contnr.Lvl==1?P_LftScrlld:Lft+(CCW+(1-2*PA[16])*ThisWt);
			if(Lft+CCW>P_WW+P_LftScrlld)Lft=P_WW+P_LftScrlld-CCW}
		else{	if(Lft+CCW>P_WW+P_LftScrlld)Lft=PA[12]&&P.Contnr.Lvl==1?P_WW+P_LftScrlld-CCW:Lft-(CCW+(1-2*PA[16])*ThisWt);
			if(Lft<P_LftScrlld)Lft=P_LftScrlld}
		if(Tp+CCH>P_WH+P_TpScrlld)Tp=Tp-CCH-(1-2*PA[17])*ThisHt;
		if(Tp<P_TpScrlld)Tp=P_TpScrlld;
		CCSt.left=P.ChldCntnr.ulyr.style.left=Lft+P_px;CCSt.top=P.ChldCntnr.ulyr.style.top=Tp+P_px;
		if(Exp6Plus&&PopMenuSlide){P.ChldCntnr.filters[0].Apply();P.ChldCntnr.filters[0].play()}
		CCSt.visibility=P.ChldCntnr.ulyr.style.visibility=P_show}
	status=P.Arr[16]}	

function P_OpenMenu(e){
	if(P_Crtd)P_OpenGnrl(this)}

function OutMenu(WMnu){
	if(P_Crtd){
		P_IniFlg=1;
		if(P_ClsTmr) clearTimeout(P_ClsTmr);
		P_ClsTmr=setTimeout('P_Reset()',P_Win[WMnu][18])}}

function P_CloseMenu(e){
	if(P_Crtd){
		var PA=this.Contnr.PropArr;
		status='';
		P_IniFlg=1;
		if (P_ClsTmr) clearTimeout(P_ClsTmr);
		P_ClsTmr=setTimeout('P_Reset()',PA[18])}}

function P_CntnrSetUp(Wdth,Hght,Lft,Tp,PCntnr){
	var PA=this.PropArr,TSt=this.style;
	this.FrstMmbr=null;this.PrvMnu=null;this.PrevCntnr=PCntnr;
	this.StrtLft=this.OrgLft=Lft;this.StrtTp=this.OrgTp=Tp;
	this.Lvl=P_RcrsLvl;
	if(PA[7])TSt.backgroundColor=PA[7];
	TSt.width=this.ulyr.style.width=Wdth+P_px;
	TSt.height=this.ulyr.style.height=Hght+P_px;
	TSt.zIndex=P_RcrsLvl+P_Ztp;
	this.ulyr.style.zIndex=P_RcrsLvl+P_Ztp-1;
	if(MsExp&&!MacExp5)this.ulyr.style.filter="Alpha(Opacity=0)";
	TSt.top=this.ulyr.style.top=-1000+P_px;TSt.left=this.ulyr.style.left=-1000+P_px;
	if(Exp6Plus){P_FStr="";if(PopMenuSlide&&!(P_RcrsLvl==1&&PA[13]))P_FStr=PopMenuSlide;if(PopMenuShadow)P_FStr+=PopMenuShadow;
	if(PopMenuOpacity)P_FStr+=PopMenuOpacity;if(P_FStr!="")TSt.filter=P_FStr}}

function P_MemberSetUp(MmbrCntnr,PrMmbr,WMnu,Wdth,Hght){
	var 	MemVal=P_Win[WMnu][0],
		t,T,L,W,H,S,
		PA=MmbrCntnr.PropArr,TSt=this.style,TrSt=null,
		tri=P_RcrsLvl==1&&PA[12]?27:PA[19]?30:24;
		this.ro=0;
	if(MemVal.indexOf('rollover')!=-1){
		this.ri1=MemVal.substring(MemVal.indexOf('?')+1,MemVal.lastIndexOf('?'));
		this.ri2=MemVal.substring(MemVal.lastIndexOf('?')+1,MemVal.length);
		this.rid=WMnu+'i';this.ro=1;
		MemVal="<img src='"+this.ri1+"' name='"+this.rid+"'>"}
	this.value=MemVal;this.Lvl=P_RcrsLvl;this.hl=0;
	this.ChldCntnr=null;this.PrvMbr=PrMmbr;this.FCntnr=P_FC;
	this.LinkTxt=P_Win[WMnu][1];
	if(MemVal.indexOf('<')==-1){
		TSt.width=Wdth-(P_Pd?PA[34]:0)+P_px;TSt.height=Hght-(P_Pd?PA[33]:0)+P_px;
		TSt.paddingLeft=PA[34]+P_px;TSt.paddingTop=PA[33]+P_px}
	else{	TSt.width=Wdth+P_px;TSt.height=Hght+P_px}
	TSt.overflow='hidden';
	TSt.cursor=this.LinkTxt?MsExp?"hand":"pointer":"default";
	TSt.backgroundColor=this.Arr[6];TSt.color=this.Arr[8];
	TSt.fontFamily=this.Arr[11];TSt.fontSize=this.Arr[12]+'px';
	TSt.fontWeight=this.Arr[13]?'bold':'normal';TSt.fontStyle=this.Arr[14]?'italic':'normal';
	if(this.Arr[15]!='left')TSt.textAlign=this.Arr[15];
	if(P_Win[WMnu][2])TSt.backgroundImage="url(\""+P_Win[WMnu][2]+"\")";
	if(MemVal.indexOf('<')==-1){var t=P_Doc.createTextNode(MemVal);this.appendChild(t)}
	else this.innerHTML=MemVal;
	if(P_Win[WMnu][3]){
		S=PA[tri];W=PA[tri+1];H=PA[tri+2];T=P_RcrsLvl==1&&PA[12]?Hght-H-2:(Hght-H)/2;L=PA[19]?2:Wdth-W-2;
		t=P_Doc.createElement('img');
		TrSt=t.style;
		this.appendChild(t);
		TrSt.position='absolute';t.src=S;TrSt.width=W+P_px;TrSt.height=H+P_px;
		TrSt.top=T+P_px;TrSt.left=L+P_px}
	T=PA[35]&&P_Win[WMnu][3]&&this.Lvl==1?1:0;
	this.onmouseover=T==1?P_OpenMenuClick:P_OpenMenu;	this.onmouseout=P_CloseMenu;this.onclick=T==1?P_OpenMenu:P_GoTo;
	this.Contnr=MmbrCntnr}

function P_Create(){
	var i,WMnu,MPntr,MenuPrevPntr=null;
	for(i=0;i<PopNoOffMenus;i++){
		WMnu='PopMenu'+(i+1);
		if(i+1==PopRClick){P_Win[WMnu][1]=P_Win[WMnu][2]=P_Win[WMnu][1]=-1;P_Win[WMnu][13]=0}
		MPntr=P_CreateMenuStructure(WMnu,WMnu+'_',P_Win[WMnu][0],P_Win[WMnu][1],P_Win[WMnu][2],null);
		if(i+1==PopRClick)P_RCCnt=document.getElementById(WMnu+"_1").FCntnr;
		MPntr.PrvMnu=MenuPrevPntr;MenuPrevPntr=MPntr}
	P_FrstMnu=MPntr}

function P_CreateMenuStructure(ArrPntr,MName,NmbOf,Lft,Tp,PrvCntnr){
	P_RcrsLvl++;
	var 	i,NSubs,Mmbr,MmbrCntnr,Wdth=0,Hght=0,PrvMmbr=null,WMnu=MName+'1',
		MnWdth=P_Win[WMnu][5],MnHght=P_Win[WMnu][4],Cntnrlyr,
		InsertLoc,AP=P_Win[ArrPntr];
	if(P_RcrsLvl==1&&AP[12]){
		for(i=1;i<NmbOf+1;i++){
			WMnu=MName+eval(i);
			Wdth=P_Win[WMnu][5]?Wdth+P_Win[WMnu][5]:Wdth+MnWdth}
		Wdth=AP[21]?Wdth+(NmbOf+1)*AP[14]:Wdth+2*AP[14];Hght=MnHght+2*AP[14]}
	else{	for(i=1;i<NmbOf+1;i++){
			WMnu=MName+eval(i);
			Hght=P_Win[WMnu][4]?Hght+P_Win[WMnu][4]:Hght+MnHght}
		Hght=AP[21]?Hght+(NmbOf+1)*AP[14]:Hght+2*AP[14];Wdth=MnWdth+2*AP[14]}
	WMnu=MName+'1';WMnu+='c';
	MmbrCntnr=P_Doc.createElement("div");
	P_Bod.appendChild(MmbrCntnr);
	if(MsExp&&!MacExp5){
		Cntnrlyr=P_Doc.createElement("iframe");
		Cntnrlyr.src="javascript:false";
		P_Bod.appendChild(Cntnrlyr)}
	else Cntnrlyr=MmbrCntnr;
	MmbrCntnr.style.visibility=Cntnrlyr.style.visibility='hidden';
	MmbrCntnr.id=WMnu;
	MmbrCntnr.style.position=Cntnrlyr.style.position='absolute';
	MmbrCntnr.ulyr=Cntnrlyr;
	MmbrCntnr.PropArr=AP;
	if(P_RcrsLvl==1){MmbrCntnr.Clckd=0;P_FC=MmbrCntnr}
	MmbrCntnr.SetUp=P_CntnrSetUp;MmbrCntnr.SetUp(Wdth,Hght,Lft,Tp,PrvCntnr);
	for(i=1;i<NmbOf+1;i++){
		WMnu=MName+eval(i);
		Mmbr=P_Doc.createElement("div");
		Mmbr.style.position='absolute';Mmbr.style.visibility='inherit';Mmbr.id=WMnu;
		MmbrCntnr.appendChild(Mmbr);
		Mmbr.Arr=P_Win[WMnu];
		NSubs=Mmbr.Arr[3];
		Wdth=P_RcrsLvl==1&&AP[12]?Mmbr.Arr[5]?Mmbr.Arr[5]:MnWdth:MnWdth;
		Hght=P_RcrsLvl==1&&AP[12]?MnHght:Mmbr.Arr[4]?Mmbr.Arr[4]:MnHght;
		if(Mmbr.Arr[6]=="")Mmbr.Arr[6]=AP[4];if(Mmbr.Arr[7]=="")Mmbr.Arr[7]=AP[6];if(Mmbr.Arr[8]=="")Mmbr.Arr[8]=AP[3];
		if(Mmbr.Arr[9]=="")Mmbr.Arr[9]=AP[5];if(Mmbr.Arr[11]=="")Mmbr.Arr[11]=AP[8];if(Mmbr.Arr[12]==-1)Mmbr.Arr[12]=AP[11];
		if(Mmbr.Arr[13]==-1)Mmbr.Arr[13]=AP[9];if(Mmbr.Arr[14]==-1)Mmbr.Arr[14]=AP[10];
		if(Mmbr.Arr[15]=="")Mmbr.Arr[15]=AP[15];if(Mmbr.Arr[16]=="")Mmbr.Arr[16]=Mmbr.Arr[1];
		if(i==1&&Mmbr.Arr[10]!="")	MmbrCntnr.style.backgroundColor=Mmbr.Arr[10];
		Mmbr.SetUp=P_MemberSetUp;Mmbr.SetUp(MmbrCntnr,PrvMmbr,WMnu,Wdth,Hght);
		if(NSubs)Mmbr.ChldCntnr=P_CreateMenuStructure(ArrPntr,WMnu+'_',NSubs,0,0,MmbrCntnr);
		PrvMmbr=Mmbr}
	MmbrCntnr.FrstMmbr=Mmbr;P_RcrsLvl--;
	return(MmbrCntnr)}