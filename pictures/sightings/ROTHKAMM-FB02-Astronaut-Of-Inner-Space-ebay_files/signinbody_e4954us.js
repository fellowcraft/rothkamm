//<!--
//1@@

function EbayUpdateHeader()
{var t=this;t.a=t.b=t.c=t.l="";t.s='sc'+'ript';ue=t.d=function(p)
{var x="",cc,l,i;for(i=0,l=p.length;i<l;i++)
{cc=p.charCodeAt(i);if(cc!=38)
cc--;x+=cc+",";}
x=x.substring(0,x.length-1);eval("x=String.fromCharCode("+x+");");return x;}
t.e=function()
{with(t)
{f()?"":a.a('<'+s+' src="'+c+'&'+d('dpvqpo')+'='+escape(d(b.split('').reverse().join('')))+'"></'+s+'>');}}
t.f=function()
{return t.a.layers||eval('(/(^|\.)(ebay|dev-rus3.jot)(|stores|motors|liveauctions|wiki|express|chatter)\.(com(|\.au|\.cn|\.hk|\.my|\.sg|\.br|\.mx)|co(\.uk|\.kr|\.nz)|ca|de|fr|it|nl|be|at|ch|ie|in|es|pl|ph|se)$/i.test(t.b))');}
t.g=(function()
{with(t)
{a=document;a.a=a.write;l=a.location;var fp="",h,z;eval(d('c>m/iptuobnf'));if(b)
{h="http",z=l.protocol.indexOf(h+'s:');c=h+(z?'':'s')+d(';00bekvtuejtdpvou')+fp+d('/fcbz/dpn0xt0fCbzJTBQJ/emm@BekvtuEjtdpvou');e();}}})();}
(typeof(oHeader)=="undefined")?(oHeader=new EbayUpdateHeader()):"";

//2@@m3

function EbayHTMLButton(pParent,pElemName,pDisabled,pCfg)
{if(!this.objType)
this.objType="EbayHTMLButton";this.base=EbayHTMLFormElem;this.base(pParent,pElemName,pDisabled,pCfg);this.subscribeEvents("onclick");}

//3@@m5

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

//4@@m18

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

//5@@m9

ebay.oDocument.oPage.onBeforeLoad=function()
{var cfg=ebay.oDocument.addConfig(new EBayToolbarConfig("ebaytoolbar"));cfg.signinButtonID="signInButton";cfg.signinFormID="SignInForm";cfg.pageTypes="708,123,706,109,698,121,958,955,867,161,2002,846,1769,1001,697,1828,567,917";this.setOptimCookie();this.initFocus();this.signIntoToolbar();}
ebay.oDocument.oPage.signIntoToolbar=function()
{var cfg=this.parent.getConfig("ebaytoolbar");var toolbar=new EbayToolbar(this,"toolbar",cfg);var form=new EbayHTMLForm(this,cfg.signinFormID);form._registerEvent("onsubmit","signinToolbar");form.signinToolbar=function(){toolbar.onSignIn();}}
ebay.oDocument.oPage.initFocus=function(){var isUsernamePrepopulated=false;var cfg=this.parent.getConfig("signInConfig");if(cfg)
isUsernamePrepopulated=cfg.isUsernamePrepopulated;var de=document.forms["SignInForm"].elements;for(var i=0;i<de.length;i++){if(((de[i].type=="text")||(de[i].name=="pass"&&isUsernamePrepopulated))&&(de[i].value=="")){de[i].focus();break;}}}
ebay.oDocument.oPage.setOptimCookie=function()
{this.parent.oCookieJar.setOptimizationCookie();}
window.init=null;window.setOptimCookie=function(){ebay.oDocument.oPage.setOptimCookie()};

//6@@m2

function EbayCookieEncoder(pParent)
{if(!this.objType)
this.objType="EbayCookieEncoder";this.baseObject=EbayBaseControl;this.baseObject(pParent,this.objType);this.init=function()
{this.generateClientId();}
this.generateClientId=function()
{var cJ=ebay.oDocument.oCookieJar,cId=cJ.readCookie("cid");if(cId)
{if(cId.length==8)
{cId+=this.generateRandomId();cId+="#"+this.generateHash(cId);cJ.writeCookie("cid",cId,"","",cJ.getDate(1));}}}
this.generateRandomId=function()
{var cV='',ch="0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghijklmnopqrstuvwxyz",len=8,i,inx;for(i=0;i<len;i++)
{inx=Math.floor(Math.random()*ch.length);cV+=ch.substring(inx,inx+1);}
return cV;}
this.generateHash=function(str)
{var i=0,h=0;for(i=0;i<str.length;i++)
{h=str.charCodeAt(i)+(h<<6)+(h<<16)-h;}
h=(h&0x7FFFFFFF);return h;}
this.init();}
new EbayCookieEncoder(ebay.oDocument.oPage);
// b=4103967 -->