//<!--
//1@@m22

function EbayHTMLFrame(pParent,pName,pCfg)
{if(!this.objType)
this.objType="EbayHTMLFrame";this.base=EbayHTML;this.base(pParent,pName,pName,false,pCfg);this.eFrameElem=null;this.getElem=ebHTMLFrameGetElem;this.bindHTML=ebHTMLFrameBindHTML;this.bindEvents=this.enable=function(){};this.setSource=ebHTMLFrameSetSource;this.cleanupMemoryBase=this.cleanupMemory;this.cleanupMemory=ebHTMLFrameCleanupMemory;this.resize=ebHTMLFrameResize;this.onBeforeResize=this.onAfterResize=null;}
function ebHTMLFrameGetElem(pName)
{with(this)
{var f=null,oD=oDocument;var d=oD.doc,w=oD.win;if(w.frames)
f=eFrameElem=w.frames[pName];if(d.getElementById)
f=d.getElementById(pName);return f;}}
function ebHTMLFrameBindHTML()
{with(this)
{eElem=getElem(sElemName);if(eElem)
assignJSObject(eElem);}}
function ebHTMLFrameCleanupMemory()
{this.cleanupMemoryBase();this.eFrameElem=null;}
function ebHTMLFrameSetSource(pURL)
{if(pURL==null||pURL.trim()==''){return;}
with(this)
{oDocument.setGlobalParent(this);if(pURL.has("ej2child=true"))
pURL+="&ej2parent="+name;if(eFrameElem)
eFrameElem.location.replace(pURL);else if(eElem)
eElem.src=pURL;}}
function ebHTMLFrameResize(pMaxWidth)
{with(this)
{if(onBeforeResize)
onBeforeResize();var f=eFrameElem;if(!f||!(f.document||f.contentDocument))
f=getElem(sElemName);if(f&&typeof(f.document)!="unknown")
{var oDoc=f.document?f.document:f.contentDocument,db=oDoc.body,es=eElem.style,c=this.parent.oGlobals.oClient,w="100%",h=db.offsetHeight,oh;if(c.bSafari)
{oh=db.offsetHeight;w=oDoc.width;h=ebay.oDocument.doc.doctype!=null?oDoc.height+15:oDoc.height+1;}
else if(c.bFirefox)
{w=oDoc.width;h=oDoc.height}
else if(c.bWin||c.bOpera)
{w=db.scrollWidth;h=c.bNav&&ebay.oDocument.doc.doctype!=null?db.scrollHeight+30:db.scrollHeight;}
if(pMaxWidth&&c.bFirefox)
w="100%";if(this.oConfig)
{w=this.oConfig.iWidth||w;h=this.oConfig.iHeight||h;}
es.width=(w=="100%")?w:w+"px";es.height=h+"px";if(onAfterResize)
onAfterResize();}}}

//2@@m13

function EbayHTMLFrameAutoSize(pParent,pName,pCfg,pUrl)
{if(!this.objType)
this.objType="EbayHTMLFrameAutoSize";this.base=EbayHTML;this.base(pParent,pName,pName,false,pCfg);this.oFrame=this.sWidth=this.sHeight="";this.onAfterResize=null;this.ORIENTATION_HORIZONTAL="0";this.DEFAULT_FRAMEID="myAutoResizeFrame";this.sDefFrameWidth=(pCfg&&pCfg.sWidth)?pCfg.sWidth:"";this.sDefaultUrl=pUrl||"";this.sFrameName=pCfg&&pCfg.sFrameName&&pCfg.sFrameName.length>0?pCfg.sFrameName:this.DEFAULT_FRAMEID;this.bLoaded=false;this.bAutoResize=pCfg.bAutoResize?pCfg.bAutoResize:false;this.getHTML=function()
{with(this)
{var s,c=oConfig,w=c.sDefWidth,sSep=':',src=(sDefaultUrl)?' src="'+sDefaultUrl+'"':'';w=typeof(w)!='undefined'?w+'px;':'100%;';s='<iframe name="'+sFrameName+'" id="'+sFrameName+'" '+src+' marginwidth="0" marginheight='+((c.sOrientation==ORIENTATION_HORIZONTAL)?'"1"':'"0"')+' scrolling="no" frameborder="0" '+'style="width'+sSep+w+'height'+sSep+'1px;">'+'&nbsp;</iframe>';return s;}}
this.loadContent=function()
{if(this.oConfig.sContentUrl.has('downgradeDomain')&&!this.oConfig.bPageDowngraded)
this.parent.oDocument.downgradeDomain();this.oFrame.setSource(this.oConfig.sContentUrl);}
this.resize=function()
{with(this)
{if(oFrame)
{oFrame.resize();var st=oFrame.eElem.style;if(sDefFrameWidth)
st.width=(sDefFrameWidth.has('%')||sDefFrameWidth.has('px'))?sDefFrameWidth:sDefFrameWidth+"px";sWidth=st.width;sHeight=st.height;if(onAfterResize)
onAfterResize();if(!bLoaded)
{_registerListener(this.oDocument._getEvent("resize"),EVENT_AFTER,"resize");bLoaded=true;}}}}
this.writeContainer=function(pConfig)
{with(this)
{var b=pConfig.bShowContentAfterPageLoad,oP=parent,oD=oP.oDocument;oConfig=pConfig;sFrameName=pConfig&&pConfig.sFrameName&&pConfig.sFrameName.length>0?pConfig.sFrameName:DEFAULT_FRAMEID;if(sFrameName==DEFAULT_FRAMEID||bAutoResize)
oD.write(getHTML());oFrame=new EbayHTMLFrame(this,sFrameName,oConfig);oFrame.bind();b=(typeof(b)!='undefined')?b:true;if(b)
_registerListener(oD._getEvent("load"),EVENT_AFTER,"loadContent");else
loadContent();return oFrame;}}}

//3@@m3

function EbayIFrameAutoResize(pParent,pName,pCfg)
{if(!this.objType)
this.objType="EbayIFrameAutoResize";this.base=EbayHTMLFrameAutoSize;this.base(pParent,pName,pName,false,pCfg);this.iFrames=[];this.getElement=function(pUrl)
{for(var i=0;i<this.iFrames.length;i++)
{if(pUrl.toLowerCase()==this.iFrames[i].sContentUrl.toLowerCase())
{return this.iFrames[i];}}}
this.writeContainerBase=this.writeContainer;this.writeContainer=function(pCfg)
{pCfg.sDefWidth=pCfg.iWidth?pCfg.iWidth+"":"";pCfg.sDefWidth=pCfg.iwidth?pCfg.iwidth+"":pCfg.sDefWidth;var s=pCfg.sContentUrl;if(s&&!s.has('downgradeDomain=true'))
{if(!s.has('?'))
s+='?downgradeDomain=true';else
s+='&downgradeDomain=true';pCfg.sContentUrl=s;}
pCfg.bShowContentAfterPageLoad=false;this.iFrames.push(pCfg);pCfg.oFrame=this.writeContainerBase(pCfg);}
this.resizeWithSize=function(pCfg,pWidth,pHeight)
{if(pCfg)
{var f=pCfg.oFrame.getElem(pCfg.oFrame.sElemName);var es=f.style;if(pCfg.sDefWidth.length>0)
es.width=pCfg.sDefWidth+"px";else
es.width=pWidth+"px";es.height=pHeight+"px";}}}
new EbayIFrameAutoResize(ebay.oDocument.oPage,"IFrame_AutoResize");

//4@@m22
<!--
function adjustIFrameSize(iframeWindow)
{var iframeElement=iframeWindow.name?this.document.getElementById(iframeWindow.name):null;if(!iframeElement||typeof(iframeElement)=='undefined')
return false;var aDimensions=getFrameDim(iframeWindow.document);iframeElement.style.height=aDimensions[1]+'px';iframeElement.style.width=aDimensions[0]+'px';}
function changeFrame()
{if(parent.adjustIFrameSize)parent.adjustIFrameSize(window);}
function adjustIFrameHeight(iframeWindow)
{var iframeElement=iframeWindow.name?this.document.getElementById(iframeWindow.name):null;if(!iframeElement||typeof(iframeElement)=='undefined')
return false;if(iframeWindow.document.height)
iframeElement.style.height=iframeWindow.document.height+'px';else if(document.all)
{if(iframeWindow.document.compatMode&&iframeWindow.document.compatMode!='BackCompat')
iframeElement.style.height=iframeWindow.document.documentElement.scrollHeight+5+'px';else
iframeElement.style.height=iframeWindow.document.body.scrollHeight+5+'px';}
else
{var oF=new EbayHTMLFrame(ebay.oDocument.oPage,iframeElement.name);oF.bind();oF.resize();oF=null;}
iframeElement.style.width="100%";}
function changeFrameHeight()
{if(parent.adjustIFrameHeight)parent.adjustIFrameHeight(window);}
function getIframeHeight(iframeWindow){if(is.mac)
{return 0;}
if(iframeWindow.document.height){var iframeElement=this.document.getElementById(iframeWindow.name);return iframeWindow.document.height;}
else if(document.all){var iframeElement=this.document.all[iframeWindow.name];if(iframeWindow.document.compatMode&&iframeWindow.document.compatMode!='BackCompat')
{return iframeWindow.document.documentElement.scrollHeight;}
else{return iframeWindow.document.body.scrollHeight;}}}
function ssTrackIframeRequest()
{}
function getFrameDim(frameDoc)
{var frame_size=[];frame_size=["100%",frameDoc.body.offsetHeight];if(frameDoc.height||is.safari)
{frame_size=[frameDoc.width,frameDoc.height+1];}
else if(document.all)
{if(is.win)
frame_size=[frameDoc.body.scrollWidth,frameDoc.body.scrollHeight];}
return frame_size;}
function submitWithParams(form_id,fields)
{var form=document.forms[form_id];if(typeof(form)=="undefined")
{form=parent.document.forms[form_id];}
if(typeof(form)!="undefined"&&typeof(fields)!="undefined")
{for(var i=0;i<fields.length;i++)
{var field=form[fields[i][0]];var value=fields[i][1];if(typeof(field)!="undefined")
{field.value=value;}}
form.submit();return true;}
return false;}
function changeFrameLocation(sName,sLocation)
{var iDelay=1000;if(typeof(parent.frames[sName])!="undefined")
{if(is.mac&&is.ie)
setTimeout('parent.frames["'+sName+'"].location = "'+sLocation+'"',iDelay);else
setTimeout('parent.frames["'+sName+'"].location.replace("'+sLocation+'")',iDelay);}}

//5@@m5

function EbayHTMLForm(pParent,pName,pCfg)
{if(!this.objType)
this.objType="EbayHTMLForm";this.base=EbayHTML;this.base(pParent,pName,pName,false,pCfg);this.getElem=function(){return this.getDocElem(arguments[0],'forms');};this.enable=function(){};this.getElementValue=ebHTMLFormGetElementValue;this.setElementValue=ebHTMLFormSetElementValue;this.getElements=ebHTMLFormGetElements;this.getElement=ebHTMLFormGetElement;this.setAction=ebHTMLFormSetAction;this.getAction=ebHTMLFormGetAction;this.setTarget=ebHTMLFormSetTarget;this.getTarget=ebHTMLFormGetTarget;this.submit=ebHTMLFormSubmit;this.clear=ebHTMLFormClear;this.subscribeEvents("onsubmit");this.onBeforeSubmit=null;this.onAfterSubmit=null;}
function ebHTMLFormGetElements()
{var e=this.eElem;return e?e.elements:new Array;}
function ebHTMLFormGetElement(pName)
{var elems=this.getElements();return elems[pName]?elems[pName]:null;}
function ebHTMLFormGetElementValue(pName)
{var elems=this.getElements();if(elems[pName]&&elems[pName].value)
return elems[pName].value;return"";}
function ebHTMLFormSetElementValue(pName,pValue)
{var elems=this.getElements();if(elems[pName])
elems[pName].value=pValue;}
function ebHTMLFormSetAction(pAction)
{var e=this.eElem;if(e)
e.action=pAction;}
function ebHTMLFormGetAction()
{var e=this.eElem;if(e)
return e.action;}
function ebHTMLFormSetTarget(pTarget)
{var e=this.eElem;if(e)
e.target=pTarget;}
function ebHTMLFormGetTarget()
{var e=this.eElem;if(e)
return e.target;}
function ebHTMLFormSubmit()
{if(this.onBeforeSubmit)
this.onBeforeSubmit();var e=this.eElem;if(e)
{e.submit();if(this.onAfterSubmit)
this.onAfterSubmit();}
else
this.throwError("Element '"+this.sElemName+"' does not exist on the page","submit");}
function ebHTMLFormClear()
{var elems=this.getElements();for(i=0;i<elems.length;i++)
{var elem=elems[i];var type=elem.type;switch(type)
{case"text":case"textarea":elem.value="";break;case"checkbox":elem.checked=false;break;case"select-one":elem.selectedIndex=0;}}}

//6@@m10

function EbayHTMLText(pParent,pName,pDisabled,pCfg,bHidden)
{if(!this.objType)
this.objType="EbayHTMLText";this.base=EbayHTMLFormElem;this.base(pParent,pName,pDisabled,pCfg);this.value=ebHTMLTextValue;this.getValue=ebHTMLTextGetValue;this.setValue=ebHTMLTextSetValue;this.select=ebHTMLTextSelect;if(bHidden!=true)
this.subscribeEvents("onchange","onblur","onfocus","onkeydown","onkeyup");}
function ebHTMLTextValue(pVal)
{var e=this.eElem;if(e)
{if(typeof(pVal)=="undefined")
return e.value;else
e.value=pVal;}}
function ebHTMLTextGetValue()
{return this.value();}
function ebHTMLTextSetValue(pVal)
{return this.value(pVal);}
function ebHTMLTextSelect()
{var e=this.eElem;if(e)
e.select();}

//7@@m9

function EbayHTMLPopup(pParent,pName,pCfg)
{if(!this.objType)
this.objType="EbayHTMLPopup";this.base=EbayBaseControl;this.base(pParent,pName);this.oConfig=pCfg||null;if(!pCfg)
{this.sUrl="";this.iWidth=this.iHeight=this.iLeft=this.iTop=null;this.bToolbar=this.bLocation=this.bStatus=this.bScrollbars=this.bResizable=this.bMenubar=true;}
else
{var u="undefined";this.sUrl=typeof(pCfg.sUrl)!=u?pCfg.sUrl:"";this.iWidth=typeof(pCfg.iWidth)!=u?pCfg.iWidth:null;this.iHeight=typeof(pCfg.iHeight)!=u?pCfg.iHeight:null;this.iLeft=typeof(pCfg.iLeft)!=u?pCfg.iLeft:null;this.iTop=typeof(pCfg.iTop)!=u?pCfg.iTop:null;this.bToolbar=typeof(pCfg.bToolbar)!=u?pCfg.bToolbar:true;this.bLocation=typeof(pCfg.bLocation)!=u?pCfg.bLocation:true;this.bStatus=typeof(pCfg.bStatus)!=u?pCfg.bStatus:true;this.bScrollbars=typeof(pCfg.bScrollbars)!=u?pCfg.bScrollbars:true;this.bResizable=typeof(pCfg.bResizable)!=u?pCfg.bResizable:true;this.bMenubar=typeof(pCfg.bMenubar)!=u?pCfg.bMenubar:true;}
this.oWin=null;this.sProps=this.sCustomProps="";this.bModal=false;this.sSavedFocusFunction=null;this.iHBuffer=this.iWBuffer=0;this.show=ebHTMLPopupShow;this.getParamString=ebHTMLGetParamString;this.modality=ebHTMLModality
this.showEx=ebHTMLPopupShowEx;this.resizeParent=ebHTMLPopupResizeParent;this.close=ebHTMLPopupClose;this.focus=ebHTMLPopupFocus;this.sizeToContent=ebHTMLPopupSizeToContent;this.clearControls=ebHTMLPopupClearControls;}
function ebHTMLPopupShow()
{with(this)
{if(sUrl.length==0)
return null;var sP=getParamString();var oD=oDocument,tWin=oD.win;oD.setGlobalParent(this);modality(tWin);if(sUrl.has("ej2child=true")&&!sUrl.has("ej2parent="))
sUrl+="&ej2parent="+name;var w=tWin.open(sUrl,name,sP);if(w)
w.focus();oWin=w;return w;}}
function ebHTMLGetParamString()
{with(this)
{sP=(iWidth!=null)?",width="+iWidth:"";sP+=(iHeight!=null)?",height="+iHeight:"";sP+=(iLeft!=null)?",screenX="+iLeft+",left="+iLeft:"";sP+=(iTop!=null)?",screenY="+iTop+",top="+iTop:"";sP+=",toolbar="+((bToolbar)?"1":"0");sP+=",location="+((bLocation)?"1":"0");sP+=",status="+((bStatus)?"1":"0");sP+=",scrollbars="+((bScrollbars)?"1":"0");sP+=",resizable="+((bResizable)?"1":"0");sP+=",menubar="+((bMenubar)?"1":"0");sP+=(sCustomProps.length>0)?","+sCustomProps:"";if(sP.length>0)
sP=sP.substring(1);sProps=sP;return sP;}}
function ebHTMLModality(pWin)
{if(pWin)
{with(this)
{if(bModal)
{pWin.g_ebPopupObject=this;sSavedFocusFunction=pWin.onfocus;pWin.onfocus=function()
{g_ebPopupObject.focus();}}}}}
function ebHTMLPopupShowEx(pUrl,pWidth,pHeight,pToolbar,pLocation,pStatus,pScrollbars,pResizable,pMenubar,pLeft,pTop,pCustomsProps,pModal,pWBuffer,pHBuffer)
{with(this)
{if(pUrl)
sUrl=pUrl;iWidth=pWidth;iHeight=pHeight;iLeft=pLeft;iTop=pTop;bToolbar=pToolbar;bLocation=pLocation;bStatus=pStatus;bScrollbars=pScrollbars;bResizable=pResizable;bMenubar=pMenubar;if(pCustomsProps)
sCustomProps=pCustomsProps;bModal=pModal;iHBuffer=pHBuffer;iWBuffer=pWBuffer;return show();}}
function ebHTMLPopupResizeParent(pX,pY,pW,pH)
{var p=this.parent;if(p)
{if(!isNaN(pX)&&!isNaN(pY))
p.moveTo(pX,pY);if(!isNaN(pW)&&!isNaN(pH))
p.resizeTo(pW,pH);}}
function ebHTMLPopupClose()
{with(this)
{if(bModal)
oDocument.win.onfocus=sSavedFocusFunction;oDocument.closeWindow(oWin);}
this.clearControls();}
function ebHTMLPopupClearControls()
{this.controls=[];}
function ebHTMLPopupFocus()
{var w=this.oWin;if(w&&!w.closed)
w.focus();else
this.close();}
function ebHTMLPopupSizeToContent()
{with(this)
{var c=oGlobals.oClient;if(!(c.bNav&&(c.iVer<5)))
{var ims=oWin.document.images,len=ims.length;var bottom=0,right=0,cB,cR;for(var i=0;i<len;i++)
{cB=ims[i].offsetTop+ims[i].offsetHeight;cR=ims[i].offsetLeft+ims[i].offsetWidth;if(cB>bottom)bottom=cB;if(cR>right)right=cR;}
oWin.resizeTo(right+iWBuffer,bottom+iHBuffer);}}}

//8@@m3

function EbayHTMLButton(pParent,pElemName,pDisabled,pCfg)
{if(!this.objType)
this.objType="EbayHTMLButton";this.base=EbayHTMLFormElem;this.base(pParent,pElemName,pDisabled,pCfg);this.subscribeEvents("onclick");}

//9@@m18

function EbayToolbar(pParent,pName,pCfg)
{if(!this.objType)
this.objType="EbayToolbar";this.baseObject=EbayBaseControl;this.baseObject(pParent,pName);this.TBDaemonID="eBayToolbarCommLib.IWebEvent.1";this.sTBHelper="eBayToolbar.Helper";var g=this.oGlobals;var env=this.oEnv=g.oEnvironment;this.isInstalled=false;this.client=g.oClient;this.config=pCfg||(new EBayConfig(pName));new EbayHTMLForm(this,this.config.signinFormID);this.qualifyPageType=function(){with(this)
{var t=true;for(var i=0;i<aPageTypes.length;i++)
{if(nPageType==aPageTypes[i])
{t=false;}}}
return t;}
this.onSignIn=function()
{var oF,PageType,sAction,u,sID,oSF,oCfg=this.config,oNI;oF=this.controls[oCfg.signinFormID];PageType=0;this.nPageType=oF.getElementValue("pageType");this.aPageTypes=oCfg.pageTypes.split(",");oSF=document.forms[oCfg.signinFormID];if(this.nPageType!=""&&this.qualifyPageType())
{if(this.activeXSupported(this.TBDaemonID))
{if(oSF!=null)
{sAction=new String(oSF.action);if(this.oDocument.doc.location.protocol.has("https"))
sAction=sAction.replace("http:","https:");oSF.action=sAction;}
u=oF.getElementValue("userid");TBDaemon=new ActiveXObject(this.TBDaemonID);sID=TBDaemon.GetSIDForUser(u);if(sID!="")
{this.createElement(oSF,'runame',env.sCountry.hasAny("cn")?'Soda1-EBAYTOOLBAK7I2R-mwwbb':'EBAYTOOLBAR');if(typeof(oSF.sid)=="undefined")
{this.createElement(oSF,'SID',sID);}}}}}
this.createElement=function(oF,n,v)
{var o=document.createElement("input");o.type='hidden';o.name=n;o.value=v;oF.appendChild(o);}
this.activeXSupported=function(n)
{var oC=this.client;return(!(oC.bMac||oC.bMacppc)&&oC.bIE)&&this.client.activeXLibLoaded(n);}
this.refresh=function()
{with(this)
{var oTBH,oTB,done,oCfg=config;if(activeXSupported(sTBHelper))
{oTBH=new ActiveXObject(sTBHelper);done=oTBH.doSomething(oCfg.toolbarCommand+"?00="+oCfg.eBayUserId+"&05="+oCfg.eBayItemId);}
if(activeXSupported(TBDaemonID))
{oTB=new ActiveXObject(TBDaemonID);oTB.WatchListChanged();}}}
this.refreshListItem=function()
{with(this)
{var oTB;if(activeXSupported(TBDaemonID))
{oTB=new ActiveXObject(TBDaemonID);if(typeof(oTB.OnItemListed)=="undefined"||typeof(oTB.OnItemListed)==false||typeof(oTB.OnItemListed)=="unknown")return;oTB.OnItemListed();}}}}
function EBayToolbarConfig(name)
{if(!this.objType)
this.objType="EBayToolbarConfig";this.base=EbayConfig;this.base(name);}

//10@@m6

function EbayHTMLLayer(pParent,pName,pDisabled,pCfg)
{if(!this.objType)
this.objType="EbayHTMLLayer";this.base=EbayHTML;this.base(pParent,pName,pName,pDisabled,pCfg);this.aBindEvents=new Array;this.getElem=ebHTMLLayerGetElem;this.getValue=ebHTMLLayerGetValue;this.setValue=ebHTMLLayerSetValue;}
function ebHTMLLayerGetElem(pName)
{var s=pName,d=this.oDocument.doc;if(d.getElementById)
return d.getElementById(s);else if(d.all)
return d.all(s);this.throwWarning("Not supported","getElem");}
function ebHTMLLayerGetValue(pIsText)
{if(this.eElem)
{if(pIsText)
{if(this.oDocument.oGlobals.oClient.bFirefox)
return this.eElem.textContent;else
return this.eElem.innerText;}
else
return this.eElem.innerHTML;}
else
return"";}
function ebHTMLLayerSetValue(pVal,pIsText)
{if(this.eElem)
{if(pIsText)
{if(this.oDocument.oGlobals.oClient.bFirefox)
this.eElem.textContent=pVal;else
this.eElem.innerText=pVal;}
else
this.eElem.innerHTML=pVal;}}

//11@@m7

function EbayHTMLImage(pParent,pName,pDisabled,pSource,pDisabledSource,pCfg)
{if(!this.objType)
this.objType="EbayHTMLImage";this.base=EbayHTML;this.base(pParent,pName,pName,pDisabled,pCfg);this.sEnabledSource=this.sDisabledSource=pSource;if(pDisabledSource)
this.sDisabledSource=pDisabledSource;this.getElem=ebHTMLImageGetElem;this.source=ebHTMLImageSource;this.enableBase=this.enable;this.enable=ebHTMLImageEnable;this.subscribeEvents("onclick","onmouseover","onmouseout");}
function ebHTMLImageGetElem(pName)
{return this.getDocElem(pName,'images');}
function ebHTMLImageSource(pSrc,pText)
{var im=this.eElem;if(typeof(im)=='undefined')
return;if(typeof(pSrc)=="undefined")
return(im)?im.src:"";else
{im.src=pSrc;if(pText!=null)
im.alt=pText;}}
function ebHTMLImageEnable(pEnable)
{with(this)
{enableBase(pEnable);if(sDisabledSource&&eElem)
eElem.src=(pEnable)?sEnabledSource:sDisabledSource;}}

//12@@m6

function EbayImgSizeThresholdReport(pParent,pName,pCfg)
{if(!this.objType)
this.objType="EbayImgSizeThresholdReport";this.base=EbayBaseControl;this.base(pParent,pName);var cl=this.oGlobals.oClient;if(!cl.bIE||cl.bMac||typeof(pCfg)=='undefined')
return;this.oConfig=pCfg;this.iNumUnits=1048576;this.iThreshold=1;this.iImgSize=this.iNumUnits*this.iThreshold;this.iTotMB=0;this.sLayerName='eb_img_size_thresh_report_layer';this.sImagePrefix='eb_img_size_thresh_report_image';this.oLayerOut=new EbayHTMLLayer(this,this.oConfig.sDivOutID);this.oLayerIn=new EbayHTMLLayer(this,this.oConfig.sDivInID);this.aImageObjs=[];this.createControl=ebImgSizeThresholdReportCreateControl;this.getImageTable=ebImgSizeThresholdReportGetImageTable;this.getThresholdUnits=ebImgSizeThresholdReportGetThresholdUnits;this.getCellContent=ebImgSizeThresholdReportGetCellContent;this.display=ebImgSizeThresholdReportDisplay;this.getMinutes=ebImgSizeThresholdReportGetMinutes;this.createControl();function ebImgSizeThresholdReportCreateControl()
{var cfg=this.oConfig;if(cfg)
{with(this)
{oConfig=cfg;var d=oDocument;iThreshold=cfg.iThreshold;iImgSize=iNumUnits*iThreshold;var s='<div id="'+sLayerName+'" style="display:none; position:absolute;left:0px; top:0px;">';new EbayHTMLLayer(this,sLayerName);var l=cfg.aWebURLs.length,imName;if(l>1)
{oLayerOut.bind();oLayerOut.setValue(oConfig.sEvalMsg);}
for(var i=0;i<l;i++)
{imName=sImagePrefix+i;s+='<img name="'+imName+'" src="';s+=cfg.aWebURLs[i]+'">';aImageObjs[aImageObjs.length]=new EbayHTMLImage(this,imName);}
d.write(s+'</div>');var e=oDocument._getEvent("load");_registerListener(e,EVENT_AFTER,"display");}}}
function ebImgSizeThresholdReportDisplay()
{var numOver=0,numMinutes=0,numMB=0;var c=this.oConfig;var aWI=this.aImageObjs;var oD=this.oLayerOut;var aDI=this.oLayerIn.eElem.getElementsByTagName("img");var ln=aWI.length;var ln2=aDI.length;if(ln2>0)
oD.setValue(this.oConfig.sEvalMsg);if((ln+ln2)==0)
{oD.setValue("");return;}
var aWebImages=new Array();for(var i=0;i<ln;i++)
{var im=aWI[i];if(im.eElem.fileSize>this.iImgSize)
aWebImages.push(im);}
var aDescImagesOvr=new Array();for(var i=0;i<ln2;i++)
{if(aDI[i].fileSize>this.iImgSize)
aDescImagesOvr.push(aDI[i]);}
numOver=aDescImagesOvr.length+aWebImages.length;if(numOver==0)
{oD.setValue(c.sUndrThreshMsg.replaceTokensEx("##n##",this.iThreshold));}
else
{var strHTMLPart1=c.sTemplate;var strTable=this.getImageTable(aDescImagesOvr,aWebImages);numMinutes=this.getMinutes();var iT=this.iThreshold,sS=c.sMsgseg4ahref,sE=c.sMsgseg4ahrefend,sT="##n##";var sMSS1=c.sMsgSeg1Single,sMSS2=c.sMsgSeg2Single,sMSS4=c.sMsgSeg4Single;if(numOver==1)
{sMSS1=sMSS1.replaceTokensEx(sT,numOver,iT,sS,sE);sMSS2=sMSS2.replaceTokensEx(sT,numOver,iT,sS,sE);sMSS4=sMSS4.replaceTokensEx(sT,numOver,iT,sS,sE);strHTMLPart1=strHTMLPart1.replaceTokensEx(sT,sMSS1,sMSS2,numMinutes,sMSS4);}
else
{c.sMsgSeg1=c.sMsgSeg1.replaceTokensEx(sT,numOver,iT,sS,sE);c.sMsgSeg2=c.sMsgSeg2.replaceTokensEx(sT,numOver,iT,sS,sE);c.sMsgSeg4=c.sMsgSeg4.replaceTokensEx(sT,numOver,iT,sS,sE);strHTMLPart1=strHTMLPart1.replaceTokensEx(sT,c.sMsgSeg1,c.sMsgSeg2,numMinutes,c.sMsgSeg4);}
strHTMLPart1=strHTMLPart1.replaceTokensEx(sT,numOver,iT,sS,sE);strHTMLPart1+=strTable;oD.setValue(strHTMLPart1);}}
function ebImgSizeThresholdReportGetImageTable(apDescImagesOvr,apWebImages)
{with(this)
{var Dl=apDescImagesOvr.length;var Wl=apWebImages.length;var tot=Dl+Wl;var numMB=0;var sT='';var arrIndex=0;var sE='<table><tr><td>';if((tot>1)&&(Dl>0&&Wl>0))
sE+=oConfig.sMsgseg5psls;else
if((tot==1)&&(Dl>0&&Wl>0))
sE+=oConfig.sMsgseg5pls;else
if((tot>1)&&(Dl==0||Wl==0))
sE+=oConfig.sMsgseg5ps;else
if((tot==1)&&(Dl==0||Wl==0))
sE+=oConfig.sMsgseg5pl;sE+='</td></tr><tr><td> </td></tr><tr><td align="left"><b>';if((Dl>3)||(Wl>3))
{for(var i=0;i<apDescImagesOvr.length;i++)
{numMB=getThresholdUnits(apDescImagesOvr[i].fileSize,iNumUnits);iTotMB+=numMB;}
for(var i=0;i<apWebImages.length;i++)
{numMB=getThresholdUnits(apWebImages[i].eElem.fileSize,iNumUnits);iTotMB+=numMB;}
return sT;}
else if((Dl>0)&&(Wl>0))
{arrIndex=Math.max(apDescImagesOvr.length,apWebImages.length);sT+=sE;sT+=oConfig.sDescHdr;sT+='</b></td><td width="100"/><td align="left"><b>';sT+=oConfig.sPDHdr;sT+='</b></td></tr>';for(var i=0;i<=arrIndex;i++)
{sT+='<tr><td valign="top">';if(typeof apDescImagesOvr[i]!='undefined')
{numMB=getThresholdUnits(apDescImagesOvr[i].fileSize,iNumUnits);iTotMB+=numMB;sT+=getCellContent(apDescImagesOvr[i].src,numMB);}
else
{sT+=" ";}
sT+='</td><td width="100"></td><td valign="top">';if(typeof apWebImages[i]!='undefined')
{numMB=getThresholdUnits(apWebImages[i].eElem.fileSize,iNumUnits);iTotMB+=numMB;sT+=getCellContent(apWebImages[i].eElem.src,numMB);}
else
{sT+=" ";}
sT+='</td></tr>';}
sT+='</table>';}
else if((Dl<=3)&&(Wl==0))
{sT+=sE;sT+=oConfig.sDescHdr;sT+='</b></td></tr>';for(var i=0;i<=Dl;i++)
{sT+='<tr><td valign="top">';if(typeof apDescImagesOvr[i]!='undefined')
{numMB=getThresholdUnits(apDescImagesOvr[i].fileSize,iNumUnits);iTotMB+=numMB
sT+=getCellContent(apDescImagesOvr[i].src,numMB);}
sT+='</td></tr>';}
sT+='</table>';}
else if((Dl==0)&&(Wl<=3))
{sT+=sE;sT+=oConfig.sPDHdr;sT+='</b></td></tr>';for(var i=0;i<=Wl;i++)
{sT+='<tr><td valign="top">';if(typeof apWebImages[i]!='undefined')
{numMB=getThresholdUnits(apWebImages[i].eElem.fileSize,iNumUnits);iTotMB+=numMB
sT+=getCellContent(apWebImages[i].eElem.src,numMB);}
sT+='</td></tr>';}
sT+='</table>';}
return sT;}}
function ebImgSizeThresholdReportGetThresholdUnits(piBytes,piThreshold)
{return Math.round(10*(piBytes/piThreshold))/10;}
function ebImgSizeThresholdReportGetCellContent(psSrc,pfMB)
{var sN=psSrc.substring(psSrc.lastIndexOf('/')+1);return sN+" ("+pfMB+"MB)";}
function ebImgSizeThresholdReportGetMinutes()
{with(this)
{var minsec=((Math.round(iTotMB))*oConfig.fLoadTime);var min=Math.floor(minsec);var sec=((minsec-min)*60);if(sec==0)
return oConfig.sMsgseg3m.replaceTokensEx("##n##",min);else
return oConfig.sMsgseg3ms.replaceTokensEx("##n##",min,sec);}}}
new EbayImgSizeThresholdReport(ebay.oDocument.oPage,"ia",ebay.oDocument.getConfig("imageThresholdConfig"));

//13@@m6

ebay.oUtils.sGLBL_CFG="globalVarsConfigObj";ebay.oUtils.mkVarsGlbl=function(){var gt,oD,oBc,oVC,sGlblCfg;oD=ebay.oDocument;oBc=oD.getConfig("config");var sGlblCfg=ebay.oUtils.sGLBL_CFG;function globalIt(pPropName,pVal){eval(pPropName+" = pVal;");}
gt=globalIt;oVC=oD.getConfig(sGlblCfg);for(var i in oVC.glbls){gt(i,oVC.glbls[i]);}}
ebay.oDocument.oPage.openPicShowPopup=function()
{var cfg=ssPopupData;var oPop=new EbayHTMLPopup(ebay.oDocument.oPage,"itemPopup"+cfg.itemId);oPop.iWidth=screen.width/2+25;oPop.iHeight=screen.height/2+5;oPop.iLeft=(screen.width-oPop.iWidth)/2;oPop.iTop=(screen.availHeight-oPop.iHeight)/2;oPop.bMenubar=false;oPop.bToolbar=false;oPop.bLocation=false;oPop.bStatus=false;oPop.bResizable=true;oPop.sUrl=CoreHtmlHost+'viewitem/viewitem_popup.html?domain='+escape(document.domain);oPop.show();}

//14@@m2

function EbayHTMLMinMax(pParent,pName,pDisabled,pCfg)
{if(!this.objType)
this.objType="EbayHTMLMinMax";this.base=EbayHTML;this.base(pParent,pName,pName,pDisabled,pCfg);this.oMin=this.oMax=null;this.min=ebHTMLMinMaxMin;this.max=ebHTMLMinMaxMax;this.minimize=ebHTMLMinMaxMinimize;this.maximize=ebHTMLMinMaxMaximize;this.init=ebHTMLMinMaxInit;this.init(pParent,pName,pDisabled,pCfg);}
function ebHTMLMinMaxInit(pParent,pName,pDisabled,pCfg)
{with(this)
{var t,e="onclick";_registerEvent('onafterminimize');_registerEvent('onaftermaximize');t=new EbayHTML(this,pCfg.sMinCntrlName,pCfg.sMinCntrlName);t._registerEvent(e,"parent.min");t.subscribeEvents(e);oMin=t;t=new EbayHTML(this,pCfg.sMaxCntrlName,pCfg.sMaxCntrlName);t._registerEvent(e,"parent.max");t.subscribeEvents(e);oMax=t;}}
function ebHTMLMinMaxMinimize()
{this.oMin.onclick();}
function ebHTMLMinMaxMaximize()
{this.oMax.onclick();}
function ebHTMLMinMaxMin()
{with(this.parent)
{show();oMin.show();oMax.show(true);onafterminimize();return false;}}
function ebHTMLMinMaxMax()
{with(this.parent)
{show(true);oMax.show();oMin.show(true);onaftermaximize();return false;}}

//15@@m4

ebay.oDocument.oPage.createLinks=function()
{var oD=this.parent,oMM,oCfg=oD.getConfig("ViewItem.More.Info");if(oCfg)
{oMM=new EbayHTMLMinMax(this,oCfg.name,false,oCfg);oMM._registerListener(oMM._getEvent('onaftermaximize'),this.EVENT_AFTER,'onAfterMaximize');oMM._registerListener(oMM._getEvent('onafterminimize'),this.EVENT_AFTER,'onAfterMinimize');oMM.onAfterMaximize=function()
{if(oCfg.bOverrideCookie){this.parent.getCookieVal(false,true);}else{this.parent.getCookieVal(true,true);}}
oMM.onAfterMinimize=function()
{if(oCfg.bOverrideCookie){this.parent.getCookieVal(false,false);}else{this.parent.getCookieVal(true,false);}}
oMM.bind();oMM.oMin.bind();oMM.oMin.show(false);oMM.oMax.bind();oMM.oMax.show(false);this.oMM=oMM;}}
ebay.oDocument.oPage.createMoreInfoLayer=function()
{var oP=this,oD=oP.parent,t,oCfg=oD.getConfig("ViewItem.More.Info");if(oCfg)
{oP.oMMLayer=new EbayHTMLLayer(this,oCfg.sMoreInfoLayerName,false,oCfg);oP.oMMLayer.bind();oP.setMoreInfoState();}}
ebay.oDocument.oPage.setMoreInfoState=function()
{var oP=this,oD=oP.parent,t,oCfg=oD.getConfig("ViewItem.More.Info");if(this.oMM)
{var oMM=this.oMM;if(oCfg.bOverrideCookie){this.getCookieVal(false,true);oMM.maximize();}else{this.getCookieVal(false,false)?oMM.maximize():oMM.minimize();}}}
ebay.oDocument.oPage.getCookieVal=function(pWrite,pShow)
{var oP=this,oCJ=oP.parent.oCookieJar,pbf=oCJ.readCookielet("dp1","pbf"),cv=oCJ.getBitFlag(pbf,1);if(oP.oMMLayer)
oP.oMMLayer.show(pShow);if(pWrite)
oCJ.writeCookielet("dp1","pbf",oCJ.setBitFlag(pbf,1,pShow?'1':'0'),"","",oCJ.getDate(2));return cv;}
ebay.oDocument.oPage.writeMoreInfoLinks=function(pMinLinkId,pMaxLinkId,pMinLinkText,pMaxLinkText)
{var oP=this,oC=oP.oGlobals.oClient,oD=oP.parent,s;if(oP.bIsSupported)
{s="<a href='#' name='"+pMinLinkId+"' id='"+pMinLinkId+"'>"+pMinLinkText+"</a>";s+="<a href='#' name='"+pMaxLinkId+"' id='"+pMaxLinkId+"'>"+pMaxLinkText+"</a>";oD.doc.write(s);oP.createLinks();}}
ebay.oDocument.oPage.initMoreInfo=function()
{var oP=this,e=oP.parent._getEvent("load"),oC=this.oGlobals.oClient;oP.bIsSupported=!((oC.bNav&&(oC.iVer<7))||(oC.bWebTV))}
ebay.oDocument.oPage.initMoreInfo();

//16@@m1

ebay.oDocument.oPage.initMerchWidget=function()
{var c=this.parent.getConfig('Express.Merch.Widget');if(c)
{var og=this.oGlobals,cl=og.oClient;c.bShowContentAfterPageLoad=(cl.bOpera)?true:false;c.sContentUrl+="&random="+Math.round(Math.random()*1000);var oI=new EbayHTMLFrameAutoSize(this,"Exp_Merch_Ctrl",c,c.sContentUrl);oI.writeContainer(c);}}

//17@@m7

function EbayHTMLAnchor(pParent,pName,pDisabled,pCfg)
{if(!this.objType)
this.objType="EbayHTMLAnchor";this.base=EbayHTML;this.base(pParent,pName,pName,pDisabled,pCfg);this.getElem=ebHTMLAnchorGetElem;this.enableBase=this.enable;this.enable=ebHTMLAnchorEnable;this.subscribeEvents("onclick");}
function ebHTMLAnchorGetElem(pName)
{var d=this.oDocument.doc,l=null;l=d.links[pName];if(l)return l;if(d.getElementById)
l=d.getElementById(pName);if(l)return l;if(d.all)
l=d.all[pName];if(l)return l;if(d.layers)
{var lyrs=d.layers;var len=lyrs.length;for(var i=0;i<len;i++)
{l=this.getElem(lyrs[i].document,pName);if(l)
return l;}}
for(var j=0;j<d.links.length;j++)
{l=d.links[j];if(typeof(l.name)=="undefined")
{if(l.onclick)
{var oc=l.onclick.toString();if(oc.indexOf("{#"+pName+"#}")!=-1)
return l;}}
else
{if(l.name==pName)
return l;}
l=null;}
return l;}
function ebHTMLAnchorEnable(pEnable)
{var cur=(pEnable)?"hand":"default";var el=this.eElem;if(el&&el.style)
el.style.cursor=cur;this.enableBase(pEnable);}
function setEbayLink(pS)
{return true;}

//18@@m1

function EbayFastRefresh(pParent,pName,pCfg)
{if(!this.objType)
this.objType="EbayFastRefresh";this.base=EbayHTMLFrame;this.base(pParent,pName);this.sendRequest=ebFastRefreshSendRequest;this.processResponse=ebFastRefreshProcessResponse;this.rebind=ebFastRefreshRebind;}
function ebFastRefreshSendRequest(pUrl)
{this.setSource(pUrl);}
function ebFastRefreshProcessResponse(pDivInfos,pReBindInfos)
{var aDivs=pDivInfos,iLen=aDivs.length;for(var i=0;i<iLen;i++)
{oDiv=this.oDocument._getControl(aDivs[i][0]);if(!oDiv)
{oDiv=new EbayHTMLLayer(this.parent,aDivs[i][0]);oDiv.bind();}
oDiv.setValue(aDivs[i][1]);}
if(typeof(pReBindInfos)!="undefined"&&pReBindInfos)
this.rebind(pReBindInfos);}
function ebFastRefreshRebind(pReBindInfos)
{var aRBElems=pReBindInfos,iLen=aRBElems.length,oC=null;var oD=this.oDocument;for(var i=0;i<iLen;i++)
{oC=oD._getControl(aRBElems[i]);if(!oC)
oC=new EbayHTML(this,aRBElems[i])
oC.bind();}}

//19@@m24

ebay.oDocument.oPage.onBeforeLoad=function()
{var oD=this.parent,a,b,l,oCfg,un="undefined",oC=this.oGlobals.oClient,oTB;if(typeof selfHostedIMAGEURL!=un&&selfHostedIMAGEURL!="")
eBayUser_SelfHosted_image_v.src=selfHostedIMAGEURL;oCfg=oD.getConfig("SupersizeListingConfig");if(typeof oCfg!=un&&!document.layers)
{a=new EbayHTMLAnchor(this,oCfg.linkName);l=new EbayHTMLLayer(this,oCfg.layerName);a.onclick=function(){l.setValue(oCfg.ssHTML);return false;};}
oCfg=oD.getConfig("ebaytoolbar");if(oC.bIE&&oCfg!=null&&oCfg.objType=="EBayToolbarConfig")
{oTB=new EbayToolbar(this,"toolbar",oCfg);oTB.refresh();}
oCfg=oD.getConfig("Vero.Viewitem.Preview")
if(typeof oCfg!=un)
{b=new EbayHTMLButton(this,oCfg.closeBtnId);b.onclick=function(){ebay.oDocument.win.close();};}
oCfg=oD.getConfig("ViewItem.Freight.Calculator");if(oCfg){var anch=new EbayHTMLAnchor(this,oCfg.sAnchName),calc=new EbayHTMLPopup(this,oCfg.sTargetName,oCfg),frm=new EbayHTMLForm(this,oCfg.sFormName);frm._registerEvent("onsubmit","onSubmit");frm.onSubmit=function(){calc.show();return true;}
anch._registerEvent("onclick","onClick");anch.onClick=function(){calc.show();frm.eElem.submit();return false;}}
oCfg=oD.getConfig("BusinessSellerInfo.BusinessSellerInfoWidget.PrintFriendly");if(oCfg)
{var oPopup=new EbayHTMLPopup(this,"Popup",oCfg),oAnch=new EbayHTMLAnchor(this,oCfg.sAnchId);new EbayHTMLText(this,oCfg.sTextareaId);oAnch._registerEvent("onclick","onClick");oAnch.onClick=function()
{oPopup.show();}}
if(this.createRolloverHelp)
this.createRolloverHelp();var oC=oD.getConfig("ViewItem.SkypeCheck");if(oC)
{var oAnchChat=new EbayHTMLAnchor(this,oC.sChatAnch);var oAnchCall=new EbayHTMLAnchor(this,oC.sCallAnch);var e=oAnchCall._registerEvent("onclick","parent.skypecheck");var e1=oAnchChat._registerEvent("onclick","parent.skypecheck");this.skypecheck=function()
{var c=ebay.oDocument.addConfig(new EbayConfig('SkypeCheck'));c.sPluginURL=oC.sPluginURL;c.iPluginWidth=oC.iPluginWidth;c.iPluginHeight=oC.iPluginHeight
c.oLink=this;return oD.oSkypeCheck.checkInstall();}}
var oSkypeCfg=this.parent.getConfig("ViewItem.SkypeRequest");if(oSkypeCfg)
{oFrame=new EbayHTMLFrame(this,oSkypeCfg.sSkypeiFrame);var oSkypeDiv=new EbayHTMLLayer(this,oSkypeCfg.sSkypeDiv);var oNADiv=new EbayHTMLLayer(this,oSkypeCfg.sNonAvailableDiv);oFrame._registerListener(this.oDocument._getEvent("load"),this.EVENT_AFTER,"setUrl");oFrame.setUrl=function()
{var oSkype=new EbaySkype(this,"skype");if(oSkypeCfg.sSkypeName&&oSkype.bInstalled)
{var sSkypeUrl="skype:"+oSkypeCfg.sSkypeName+"?";if(parseInt(oSkypeCfg.iSkypeAction)==1)
sSkypeUrl+="chat";else if(parseInt(oSkypeCfg.iSkypeAction)==2)
sSkypeUrl+="call";this.oDocument.doc.location.href=sSkypeUrl;}
var oSkypeSectionDiv=new EbayHTMLLayer(this.parent,oSkypeCfg.sSkypeSectionDiv);oSkypeSectionDiv.bind();if(this.oGlobals.oClient.bSafari)
this.eElem.src=oSkypeCfg.sUrl
else
this.setSource(oSkypeCfg.sUrl);}}
var picShowCfg=oD.getConfig("ViewItem.PictureShow");if(picShowCfg)
{this.aSlideshows=[];with(this)
{picShowCfg.aImageUrls=extractPictureArray(ssPopupData.imageUrls,picShowCfg.iImgDisplayIdx);window.itemPopup=openPicShowPopup;createSlideshow('view_item_pic_show',picShowCfg);var picCfgLarge=oD.getConfig("ViewItem.PictureShow.Larger");if(picCfgLarge)
{picCfgLarge.aImageUrls=extractPictureArray(ssPopupData.imageUrls,picCfgLarge.iImgDisplayIdx);createSlideshow('larger_view_item_pic_show',picCfgLarge);}}}
var oCfg=this.parent.getConfig("ViewItem.FastRefresh");if(oCfg)
this.fastRefresh(oCfg);var oImgCfg=this.parent.getConfig("ViewItem.AOLCounter");if(oImgCfg)
new EbayHTMLImage(this,oImgCfg.sImgName);var oMCfg=this.parent.getConfig('Express.Merch.Widget');if(oMCfg)
this.initMerchWidget();}
ebay.oDocument.oPage.onAfterLoad=function()
{with(this)
{var oPicCfg=parent.getConfig("ViewItem.PictureShow");if(oPicCfg)
for(var i=0;i<aSlideshows.length;i++)
{var oShow=this._getControl(aSlideshows[i]);if(oShow)
oShow.next();}
var oC=parent.getConfig("ViewItem.AOLCounter");if(oC)
{var rnd=(new Date()).getTime();var url=oC.sUrl+'&'+oC.sParam+'='+rnd;controls[oC.sImgName].source(url);}}}
ebay.oDocument.oPage.createSlideshow=function(pName,pConfig)
{var oShow=new EbayHTMLSlideshow(this,pName,false,pConfig);if(pConfig.iStartIndex)
oShow.iCurrentIdx=pConfig.iStartIndex-1;this.aSlideshows[this.aSlideshows.length]=pName;return oShow;}
ebay.oDocument.oPage.extractPictureArray=function(pArray,pIdx)
{var aImgs=[];for(var i=0;i<pArray.length;i++)
{var aSlide=pArray[i];aImgs[aImgs.length]=aSlide[pIdx];}
return aImgs;}
ebay.oDocument.oPage.fastRefresh=function(pCfg)
{var oCfg=pCfg,aRAIds=oCfg.aRefreshAnchIds,iLen=aRAIds.length;var oRI=new EbayFastRefresh(this,oCfg.sRefreshIframe,oCfg);for(var i=0;i<iLen;i++)
{oAnch=this.parent._getControl(aRAIds[i]);if(!oAnch)
oAnch=new EbayHTMLAnchor(this,aRAIds[i]);oAnch._registerEvent("onclick","submitIframe");oAnch.submitIframe=function()
{oRI.sendRequest(oCfg.sReqUrl);return false;}}
if(oCfg.bFastRefFuncKey&&this.oGlobals.oClient.bIE)
{this.parent.doc.onkeydown=function(pEvent)
{var evt=pEvent||event,sUrl;if(evt&&evt.keyCode==116)
{sUrl=oCfg.sReqUrl+(oCfg.sFuncKeyParam?oCfg.sFuncKeyParam:"");evt.keyCode=505;oRI.sendRequest(sUrl);return false;}}}
if(oCfg.bAutoRefresh&&oCfg.iAutoRfhTimer&&oCfg.iAutoRfhTimer>0)
{var sAutoRefresh="ebay.oDocument.oPage.autoRefresh()";this.autoRefresh=function()
{oRI.sendRequest(oCfg.sReqUrl);window.setTimeout(sAutoRefresh,oCfg.iAutoRfhTimer);}
window.setTimeout(sAutoRefresh,oCfg.iAutoRfhTimer);}}

//20@@m11

function EbayBACException(pParent,pString,pFullString)
{if(!this.objType)
this.objType="EbayBACException";this.base=EbayObject;this.base(pParent,"BAC Exception");this.sString=pString;this.sFullString=pFullString;}
function EbayBlockActiveContent(pParent,pName,pCfg)
{if(!this.objType)
this.objType="EbayBlockActiveContent";this.base=EbayBaseControl;this.base(pParent,pName);this.sDocWrite='';this.aExceptions=[];this.iVersion=0;this.oConfig=pCfg||null;this.aAllowed=pCfg.aCustomStrings||["blockActiveContent","EbayBlockActiveContent","open\\s*\\(","createPopup\\s*\\(","ookie\\s*\\(","\\.\\s*cookie","\\.\\s*location\\s*[=.]","replace\\s*\\(","onerror","<iframe","<ilayer","<frameset","eval\\s*\\(","standardWrite","standardCreateElement","writePersonalHeader"];var ih=ebay.oGlobals.oEnvironment.sIncludeHost;this.aAllowedTags=pCfg.aTags||[["script","src",ih],["base","href"],["meta","refresh"],["frame","src",ih]];this.aAllowedElements=pCfg.aElements||["frame","script","layer"];this.addException=function(pStr,pFullString)
{with(this)
aExceptions[aExceptions.length]=new EbayBACException(this,pStr,pFullString);}
this.hasBlockedString=function(pStr)
{var b=this.aAllowed,len=b.length,rv=false,re;pStr=pStr.toLowerCase();for(var i=0;i<len&&!rv;i++)
{re=new RegExp(b[i].toLowerCase());rv=re.test(pStr);}
return rv;}
this.checkTagAndAttribute=function(pStr,pData)
{var tagRegExp=new RegExp("<"+pData[0]+"\\s");var attrRegExp=new RegExp("\\s*"+pData[1]+"\\s*="),attrInd;var str=tstr=pStr,tagInd=str.search(tagRegExp),exInd,qInd,bInd,rv=false;while(tagInd>-1)
{str=str.substr(tagInd+1);attrInd=str.search(attrRegExp);exInd=pData[2]?str.indexOf(pData[2],attrInd):-1;bInd=str.indexOf('>');if(attrInd>bInd)
{qInd=tstr.indexOf('\"');while((attrInd>bInd)&&(bInd!=-1)&&(qInd!=-1)&&(qInd<attrInd))
{tstr=tstr.substr(qInd+1);qInd=tstr.indexOf('\"');bInd=tstr.indexOf('>');}}
if(bInd==-1)
bInd=str.length;tagInd=str.search(tagRegExp);if((attrInd>-1)&&(bInd>attrInd)&&((exInd==-1)||(exInd>bInd)))
{rv=true;tagInd=-1;}}
return rv;}
this.hasTagAndAttribute=function(pStr)
{var ta=this.aAllowedTags;var rv=false,len=ta.length;for(var i=0;i<len&&!rv;i++)
rv=this.checkTagAndAttribute(pStr,ta[i]);return rv;}
this.blockString=function(pStr)
{with(this)
{var s=sDocWrite+pStr;var rv=(hasBlockedString(s)||hasTagAndAttribute(s));if(!rv)
{var a=oConfig.aFixedStrings||["<","<s","<sc","<scr","<scri","<scrip"];for(var i=0;i<a.length;i++)
{if(pStr.toLowerCase()==(a[i]))
return true;}}
sDocWrite+=rv?'':pStr;return rv;}}
this.doDocWrite=function(pStr,pWriteln)
{var ctl=ebay.oDocument._getControl("blockActiveContent");var fdws=ctl.sDocWrite;if(window.event)ctl.addException(pStr);else if(ctl.blockString(pStr))ctl.addException(pStr,fdws+pStr);else if(pWriteln)document.standardWriteln(pStr);else document.standardWrite(pStr);}
document.standardWrite=document.write;this.documentWrite=function(pStr)
{ebay.oDocument._getControl("blockActiveContent").doDocWrite(pStr);}
document.standardWriteln=document.writeln;this.documentWriteln=function(pStr)
{ebay.oDocument._getControl("blockActiveContent").doDocWrite(pStr,true);}
document.standardCreateElement=document.createElement;this.createElement=function(pStr)
{var ctl=ebay.oDocument._getControl("blockActiveContent"),b=ctl.aAllowedElements,tmp='pStr.hasAny(';for(var i=0;i<b.length;i++)
tmp+=(i<b.length-1)?'b['+i+'],':'b['+i+']';if(eval(tmp+')'))
ctl.addException(pStr,"document.createElement");else
return document.standardCreateElement(pStr);}}
ebay.oDocument.createBlockActiveContent=function()
{var g=this.parent.oGlobals,cl=g.oClient,e=g.oEnvironment,cfg=ebay.oDocument.getBACConfig(),v=cfg.iBACVersion,path="";if(!(cl.bMac&&cl.bIE))
{var c=new EbayBlockActiveContent(this,"blockActiveContent",cfg);if(typeof(v)!='undefined'&&(v!=c.iVersion))
{path=e.sIncludeDir+"features/block_active_content/filter_"+v+".js";var tag='<sc'+'ript src="'+path+'"> </sc'+'ript>';this.write(tag);}
document.write=c.documentWrite;document.writeln=c.documentWriteln;document.createElement=c.createElement;}
this._registerListener(this._getEvent("load"),this.EVENT_AFTER,"checkBlockActiveContent");}
ebay.oDocument.getBACConfig=function()
{var s="ViewItem.BlockActiveContent";var c=ebay.oDocument.getConfig(s)||new EbayConfig(s);return c;}
ebay.oDocument.checkBlockActiveContent=function()
{var aa=[],ee,ss,ih,ct,oD=this.doc,i,j,k,tt=["div","span"],cfg=this.getBACConfig(),aLayerStrings=cfg.aLayerStrings||[[["href","mailto:"],["position: absolute;","z-index: 1;"]]];for(var j=0;j<tt.length;j++)
{t=tt[j];if(oD.getElementsByTagName)
aa=oD.getElementsByTagName(t);else if(oD.all)
aa=oD.all;for(i=0;i<aa.length;i++)
{ee=aa[i];if(ee.tagName.toLowerCase()==t.toLowerCase())
{ih=ee.innerHTML;if(ih)
{ih=ih.toLowerCase();ct=ee.style.cssText.toLowerCase();for(k=0;k<aLayerStrings.length;k++)
{var a=aLayerStrings[k];if(ih.hasAllInArray(a[0])&&ct.hasAllInArray(a[1]))
{ee.innerHTML='<img src="http://pics.ebaystatic.com/aw/pics/s.gif" id="imgBlockActiveContent">';break;}}}}}}}
ebay.oDocument.createBlockActiveContent();

//21@@m2

function EBayAttributesLinkReplacer(pSpanId,pLinkText)
{var s;var str="";if(document.getElementById)
{s=document.getElementById(pSpanId);str="getElementById";}
else if(document.all)
{s=document.all(pSpanId);str="all";}
if(typeof s!="undefined")
{var repA=new RegExp("\"","g");var repB=new RegExp("\'","g");var newInner=s.innerHTML.replace(repA,"&quot;");newInner=newInner.replace(repB,"\\'");newInner=newInner.replace(/(\n|\r)/g,"");s.innerHTML='<a href="#" onclick="document.'+str+'(\''+pSpanId+'\').innerHTML=\''+newInner+'\';return false;">'+pLinkText+'</a>';}}

//22@@m2

function EbayPrefetch(pParent,pName)
{if(!this.objType)
this.objType="EbayPrefetch";this.base=EbayBaseControl;this.base(pParent,pName);this.iTimeout=3000;this.aList=[];this.load=function(pPath)
{this.aList[this.aList.length]=pPath;}
this.init=function()
{var a=this.aList,s='';for(var i=0;i<a.length;i++)
{s+='<scr'+'ipt id="'+this.name+'_'+i+'" type="text/x-ebayScript"></'+'script>';}
this.oDocument.write(s);}
this.fetch=function()
{var oClient=ebay.oGlobals.oClient;if(oClient&&oClient.bWin)
{var a=this.aList,nm,cnt=1;var elem=this.oDocument.getUIElem(this.name+"_0");if(elem&&a.length>0)
elem.src=a[0];for(var i=1;i<a.length;i++)
{nm=this.name+"_"+i;elem=this.oDocument.getUIElem(nm);if(elem&&a[i])
{setTimeout('ebay.oDocument.getUIElem("'+nm+'").src = "'+a[i]+'"',cnt*this.iTimeout);cnt++;}}}}
var e=this.oDocument._getEvent("footer");if(e)
this._registerListener(e,this.EVENT_AFTER,"init");this._registerListener(this.oDocument._getEvent("load"),this.EVENT_AFTER,"fetch");}
ebay.oUtils.oPrefetch=new EbayPrefetch(ebay.oUtils,"Prefetch_JS_Files");

//23@@m19

function EbayHTMLSelect(pParent,pName,pDisabled,pCfg)
{if(!this.objType)
this.objType="EbayHTMLSelect";this.base=EbayHTMLFormElem;this.base(pParent,pName,pDisabled,pCfg);this.iSelIndex=-1;this.createOption=ebHTMLSelectCreateOption;this.clearOptions=ebHTMLSelectClearOptions;this.getValueByIndex=ebHTMLSelectGetValueByIndex;this.getSelectedIndex=ebHTMLSelectGetSelectedIndex;this.getSelectedValue=ebHTMLSelectGetSelectedValue;this.getSelectedText=ebHTMLSelectGetSelectedText;this.getOptionsLength=ebHTMLSelectGetOptionsLength;this.setOption=ebHTMLSelectSetOption;this.insertOption=ebHTMLSelectInsertOption;this.deleteOption=ebHTMLSelectDeleteOption;this.selectByIndex=ebHTMLSelectSelectByIndex;this.selectByValue=ebHTMLSelectSelectByValue;this.selectByText=ebHTMLSelectSelectByText;this.doSelect=ebHTMLSelectDoSelect;this.getIndexByValue=ebHTMLSelectGetIndexByValue;this.subscribeEvents("onchange");}
function ebHTMLSelectClearOptions()
{var e=this.eElem;if(e)
{var opts=e.options;while(opts.length>0)
opts[opts.length-1]=null;}}
function ebHTMLSelectCreateOption(pName,pText)
{if(this.eElem)
{var nOpt=new Option(pText,pName,false,false),opts,lo,oC=ebay.oGlobals.oClient;opts=this.eElem.options;opts[opts.length]=nOpt;idx=opts.length-1;lo=opts[idx];if(lo.innerHTML&&!((oC.bIE&&(oC.bWin&&oC.iVer==5)||(oC.bMac))))
lo.innerHTML=pText;return idx;}}
function ebHTMLSelectGetValueByIndex(pIdx,pTextOnly)
{if(pIdx>-1)
{opt=this.eElem.options[pIdx];if(opt)
return pTextOnly?opt.text:opt.value;}
this.throwError("Invalid index","get");return"";}
function ebHTMLSelectGetSelectedIndex()
{return this.eElem.selectedIndex;}
function ebHTMLSelectGetSelectedValue()
{return this.getValueByIndex(this.eElem.selectedIndex);}
function ebHTMLSelectGetSelectedText()
{return this.getValueByIndex(this.eElem.selectedIndex,true);}
function ebHTMLSelectGetOptionsLength()
{return this.eElem.options.length;}
function ebHTMLSelectSelectByIndex(pIndex)
{this.eElem.selectedIndex=this.iSelIndex=pIndex;}
function ebHTMLSelectDoSelect(pVal,pIsText)
{if(this.eElem)
{var e=this.eElem,o,rv=false,opts=e.options,len=opts.length;for(var i=0;i<len&&!rv;i++)
{o=opts[i];if(((pIsText||(o.value==""))&&(pVal==o.text))||(!pIsText&&(o.value==pVal)))
{e.selectedIndex=this.iSelIndex=i;rv=true;}}}
else
this.throwWarning("HTML element '"+this.name+"' not found","selectByValue");return rv;}
function ebHTMLSelectSelectByValue(pVal)
{return this.doSelect(pVal);}
function ebHTMLSelectSelectByText(pVal)
{return this.doSelect(pVal,true);}
function ebHTMLSelectSetOption(pVal,pText,pInd)
{if(this.eElem)
{if((pInd!=null)&&(pInd>-1))
{var o=this.eElem.options[pInd];o.value=pVal;o.text=pText;}
else
this.createOption(pVal,pText);}
else
this.throwWarning("HTML element '"+this.name+"' not found","selectByValue");}
function ebHTMLSelectInsertOption(pVal,pText,pInd)
{with(this)
{var e=eElem,opts=e.options,len=opts.length;var inOpt=new Array(pText,pVal),tmpOpt=new Array(2);var sel=getSelectedValue();len++;if(pInd>=len)
return;for(i=pInd;i<len;i++)
{if(i<len-1)
tmpOpt=[e.options[i].text,e.options[i].value];opts[i]=new Option(inOpt[0],inOpt[1]);inOpt=tmpOpt;}
selectByValue(sel);}}
function ebHTMLSelectDeleteOption(pInd)
{if(typeof(pInd)!='undefined')
{var opts=this.eElem.options;if(opts[pInd])
opts[pInd]=null;}}
function ebHTMLSelectGetIndexByValue(pVal,pIsText)
{var opts=this.eElem.options,len=opts.length,i=0;for(;i<len;i++)
{o=opts[i];if((o.value==pVal)||(pIsText&&(o.text==pVal)))
return i;}
return-1;}

//24@@m2

function EbayContentRetrieval(pParent,pName)
{if(!this.objType)
this.objType="EbayContentRetrieval";this.base=EbayBaseControl;this.base(pParent,pName);this.bTimeoutElapsed=false;this.bServerResponse=false;this.aTimeoutEntities=null;this._registerEvent("onInit");this._registerEvent("onUpdateContent");this.init=function(oCfg)
{this.oConfig=oCfg;this.aEntities=oCfg.aEntities;this.aTimeoutEntities=oCfg.aTimeoutEntities;this.bindElements(this.aEntities);this.bindElements(this.aTimeoutEntities);var dc=new EbayHTMLLayer(this,oCfg.sDataCommElemName);dc.bind();dc.setValue("<iframe id='datacommframe' style='width=0;height=0;visibility:hidden;display:none'></iframe>");var dcf=new EbayHTMLFrame(this,"datacommframe");dcf.bind();if(oCfg.bRetriveInline)
{this.execute();}
else
{for(var i=0;i<this.aEntities.length;i++)
this.aEntities[i][2].show(true);}
this._exec("onInit");}
this.execute=function(args)
{var url=this.oConfig.sDataUrl;url+=url.indexOf("?")!=-1?"&":"?";url+="ej2child=true&downgradeDomain=true";if(args)
{for(var i=0;i<args.length;i++)
{var elem=args[i];if(typeof(elem[1])!="undefined")
url+="&"+elem[0]+"="+elem[1];}}
var dcf=this._getControl("datacommframe");dcf.setSource(url);oTimer=setTimeout(ebay.oUtils.controlPath(this)+".populateTimeoutEntities();",this.oConfig.iTimeoutMS);}
this.populateEntities=function(pElems)
{if(!this.bTimeoutElapsed)
{this.bServerResponse=true;var elems=pElems;for(var i=0,elem=elems[i];i<elems.length;i++,elem=elems[i])
this.populateEntity(elem[0],elem[2].getValue());this._exec("onUpdateContent");}}
this.populateTimeoutEntities=function()
{if(!this.bServerResponse)
{this.bTimeoutElapsed=true;var elems=this.aTimeoutEntities;for(var i=0,elem=elems[i];i<elems.length;i++,elem=elems[i])
this.populateEntity(elem[0],elem[2].getValue());this._exec("onUpdateContent");}}
this.populateEntity=function(pName,pInnerHtml)
{var div=this.getEntity(pName);div.setValue(pInnerHtml);div.show(true);}
this.getEntity=function(pName)
{for(var i=0;i<this.aEntities.length;i++)
if(pName==this.aEntities[i][0])
return this.aEntities[i][2];}
this.bindElements=function(a)
{for(e in a)
with(a[e][2]=new EbayHTMLLayer(this,a[e][1]))
bind();}}
new EbayContentRetrieval(ebay.oDocument,"ContentRetrieval");

//25@@e1

function EbayShippingDetails(pParent,pName)
{if(!this.objType)
this.objType="EbayShippingDetails";this.base=EbayBaseControl;this.base(pParent,pName);this.oContentRetrieval=this.oDocument._getControl("ContentRetrieval");with(this)
{_registerListener(oContentRetrieval._getEvent("onInit"),EVENT_AFTER,"init");_registerListener(oContentRetrieval._getEvent("onUpdateContent"),EVENT_AFTER,"update");}
this.execute=function()
{with(this)
oContentRetrieval.execute([["country",oCountrySelect.getSelectedValue()],["zipcode",oZipCodeText.getValue()],["scquantity",oQuantityText.getValue()]]);}
this.updateZipcodeState=function()
{if(this.oCountrySelect.eElem!=null)
{var cur_site=this.oCountrySelect.getSelectedValue();var elems=this.oConfig.aZipCountries;for(var i=0;i<elems.length;i++)
{if(cur_site==elems[i])
{this.oZipCodeLayer.show(true);return;}
this.oZipCodeLayer.show(false);}}}
this.init=function()
{this.oConfig=this.oDocument.getConfig("ViewItem.ContentRetrieval.ShippingDetails");this.createElements();this.bindElements();this.oCalcLink._registerEvent("onclick","onClick");this.oCalcLink.onClick=function()
{this.parent.execute();}
this.oCountrySelect._registerEvent("onchange","onChange");this.oCountrySelect.onChange=function()
{this.parent.updateZipcodeState();if(this.parent.oConfig.bEnableSubmitOnCountryChange)
this.parent.execute();}
this.oErrorLink._registerEvent("onclick","onClick");this.oErrorLink.onClick=function()
{this.parent.oErrorLayer.show(true);this.show(false);return false;}
this.oForm._registerEvent("onsubmit","onSubmit");this.oForm.onSubmit=function()
{this.parent.execute();return false;}}
this.update=function()
{this.bindElements();this.updateZipcodeState();}
this.createElements=function()
{this.oCalcLink=new EbayHTMLButton(this,this.oConfig.sCalculateLinkElemName);this.oCountrySelect=new EbayHTMLSelect(this,this.oConfig.sCountrySelectElemName);this.oQuantityText=new EbayHTMLText(this,this.oConfig.sQuantityTextElemName);this.oZipCodeText=new EbayHTMLText(this,this.oConfig.sZipCodeTextElemName);this.oZipCodeLayer=new EbayHTMLLayer(this,this.oConfig.sZipCodeLayerElemName);this.oErrorLink=new EbayHTMLAnchor(this,this.oConfig.sErrorLinkElemName);this.oErrorLayer=new EbayHTMLLayer(this,this.oConfig.sErrorLayerElemName);this.oForm=new EbayHTMLForm(this,this.oConfig.sFormElemName);}
this.bindElements=function()
{with(this)
{oCalcLink.bind();oCountrySelect.bind();oQuantityText.bind();oZipCodeText.bind();oZipCodeLayer.bind();oErrorLink.bind();oErrorLayer.bind();oForm.bind();}}}
new EbayShippingDetails(ebay.oDocument,"ShippingDetails");

//26@@m4

function ebDowngradeDomainTo()
{var dd=document.domain,i=dd.indexOf(".ebay."),qs;if(i!=-1)
{dd=dd.substr(i+1);qs=unescape(document.location.search);if((i=qs.indexOf("downgradeDomainTo="))>-1)
dd=qs.substring(i+18,qs.indexOf(dd)+dd.length);if(document.domain!=dd||!document.all)
document.domain=new String(dd);}}
ebDowngradeDomainTo();
// b=4103967 -->