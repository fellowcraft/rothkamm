<CFQUERY DATASOURCE="rothkamm" NAME="all">
SELECT DISTINCT email
FROM         People
WHERE status = 1
UNION
SELECT DISTINCT email
FROM         users
UNION
SELECT DISTINCT PAYER_EMAIL As 'email'
FROM         CUSTOMERS
UNION
SELECT DISTINCT email
FROM         links

</CFQUERY>

<!--- SELECT DISTINCT email
FROM         People
WHERE State LIKE '%ny%'

UNION
SELECT DISTINCT email
FROM         links
WHERE     (State LIKE '%ny%' OR
                      State LIKE '%nj%' OR
                      State LIKE '%ct%') AND (email <> '') AND (Aus <> 1)

UNION
SELECT DISTINCT PAYER_EMAIL As 'email'
FROM         CUSTOMERS
WHERE (address_state LIKE '%ny%')  --->


<CFFLUSH INTERVAL="10">

<CFSET TheContent = ''>

<CFSET EmailSubject = 'Ghost of New York : Radio Transmission : 10/10/09'>

<CFLOOP QUERY="all">

<cfsavecontent variable="letter">
<HTML>
   		
   <HEAD>
     <TITLE>ROTHKAMM</TITLE><STYLE TYPE="text/css">
<!--
BODY{
	background-image: url(../pictures/editanB.GIF);
}

.style1ALT {
	font-size: 10px;
	color: 2C2C2C;
	font-family: Georgia, "Times New Roman", Times, serif;
}


.styleTimes {
	font-size: 11px;
	font-family: "Times New Roman", Times, serif;
}

.style1Trans {
	font-size: 12px;
	color: 2C2C2C;
	font-family: "Courier New", Courier, mono;
	background-color: #FFFFFF;
}


.style1b {
	font-size: 12px;
	color: 2C2C2C;
	font-family: "Courier New", Courier, mono;
	border: none #FFDDDD;
	letter-spacing: 2px;
	background-color: #FFFFFF;
}

.styleTiny {
	font-size: 10px;
	color: 333333;
	font-family: "Courier New", Courier, mono;
	border: none FFDDDD;
	
}

.style1c {
	font-size: 12px;
	color: 2C2C2C;
	font-family: "Courier New", Courier, mono;
	border: 1px solid EBCD29;
}

.style2rothkamm {
	font-size: 7px;
	font-style: normal;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: 666666;
	border: 1px solid EBCD29;
	background-color: FFFFFF;
}

.style2b {
	font-size: 9px;
	font-style: normal;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: 666666;
	border: 1px solid EBCD29;
	background-color: FAFAFA;
}

.style2bTrans {
	font-size: 9px;
	font-style: normal;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: 666666;
	border: 1px solid EBCD29;
}

.style2bTransb {
	font-size: 9px;
	font-style: normal;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: 666666;
	border: 1px solid 3F3F3F;
}

.style2bstrong {
	font-size: 9px;
	font-style: normal;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #222222;
	border: 1px solid EBCD29;
    background-color: FAFAFA;
}

.style2c {
	font-size: 9px;
	font-style: normal;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: 666666;
	border: 1px solid eeeeee;
	background-color: FAFAFA;
}

.style2cfade {
	font-size: 9px;
	font-style: normal;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: CCCCCC;

}

.style2cc {
	font-size: 12px;
	font-style: normal;
	font-family: "Courier New", Courier, mono;
	color: 555555;
	border: 1px solid eeeeee;
	background-color: FAFAFA;
}

.style2cTranz {
	font-size: 9px;
	font-style: normal;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: 666666;
	border: 1px solid eeeeee;
}


.style3 {
	font-size: 9px;
	font-style: normal;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: 666666;
	
}

.style3Trans {
	font-size: 9px;
	font-style: normal;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	
	background-color: FAFAFA;
}


.style3b {
	font-size: 10px;
	font-style: normal;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: 8A0000;
}


.style3c {
	font-size: 10px;
	font-style: normal;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: 111111;
}

.tiny {
    font-size: 6px;
	font-family: Verdana, Arial, Helvetica, sans-serif;

}


a:link {   text-decoration: none; color: 8A0000;}
a:visited {  text-decoration: none; color: 8A0000;}
a:active  {  text-decoration: none; color: 8A0000;}
a:hover {
    
	text-decoration: none;
	color: 330066;
	background-color: EBCD29;
}


TD{font-family:Arial, helvetica, sans-serif; color:333333; font-size:11px; text-decoration:none;}

.credit{color:#99999; text-align:right; line-height:19px;}
A.n{color:#335C85; font-size:11px; font-weight:bold; text-transform:uppercase; text-decoration:none;  word-spacing: -1px}

A.n:hover{color:#073869; font-size:11px; font-weight:bold; text-transform:uppercase; text-decoration:none; word-spacing: -1px}
A.nm{color:#81ABCC; font-size:11px; font-weight:bold; text-transform:uppercase; text-decoration:none;}
A.nm:hover{color:#073869; font-size:11px; font-weight:bold; text-transform:uppercase; text-decoration:none}
.subT2,.contents,.secHead,.secHeadmedia{font-weight:bold; text-transform:uppercase;}
.secHead{font-size:22px;}
.secHead1{font-size:22px; color:#8A0000;}
.secHeadmedia{font-size:12px;}
.contents,.secHead,.secHeadmedia{color:#8A0000;}
.contents,.date{font-size:17px;}
.subT2{font-size:12px;}
A.review{font-size:11px; font-weight:bold;}
A.review:hover{font-size:11px; font-weight:bold;}
.subT{font-size:11px;}
.subT,.date{color:#000000; font-weight:bold;}
.spacey{line-height:4px;}
.spacey2{line-height:14px;}
.bb{border:#D0D0D0 1px solid;}
.b2{border:#FFFFFF 4px solid;}
.b{width:190px;}
.mediab{width:128px;}
.grey{color:#999999;}
.footer {font-family:verdana; color:000000; text-decoration:none; font-size:11px;}
.footer:hover{font-family:verdana; color:#FFFFFF; text-decoration:none; font-size:11px;}
A.footer{font-family:verdana; color:#000000; text-decoration:none; font-size:11px;}
.footer2 {font-family:verdana; color:#000000; text-decoration:none; font-size:11px;}
A.footer2:hover{font-family:verdana; color:#FFFFFF; text-decoration:none; font-size:11px;}
.newscredit{font-size:10px; text-align:right;}
.mp{padding-top:6px;padding-bottom:6px;}
.secSubHead{font-family:helvetica; font-size:14px; font-weight:bold; color:#A30000;}
.bar{padding-top:10px; padding-bottom:10px; padding-left:10px; background-color:#EEEEEE}
.contents1 {font-size:17px;}
.subT1 {color:#000000; font-weight:bold;}
.secHeadmedia1 {font-size:12px; color: #8A0000;}
.date1 {color:#000000; font-weight:bold;}
-->
      </STYLE><META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1"></HEAD>
   <BODY>
   <div align="center">&nbsp;<br>
   <TABLE width="470" bgcolor="000000" cellpadding="1" cellspacing="0">
<TR>
  <TD ALIGN="center">
<TABLE WIDTH="468" BORDER="0" ALIGN="center" CELLPADDING="0" CELLSPACING="0" BGCOLOR="000000">
              
                 <TR>
                   <TD ALIGN="center"><TABLE BGCOLOR="D7DFE7" BORDER="0" CELLSPACING="0" WIDTH="100%">
                       <TR>
                         <TD ALIGN="center" CLASS="bar">&nbsp;</TD>
                       </TR>
                   </TABLE></TD>
                 </TR>
                 <TR>
                   <TD BGCOLOR="FFFFFF"><BR>
                       <TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" WIDTH="100%">
                         <TR>
                           <TD WIDTH="140" nowrap CLASS="secHead1">&nbsp;EVENT </TD>
                           <TD CLASS="secHeadmedia1">[ <a href="http://rothkamm.com:81/listen.pls" target="_blank">Ghost of New York : Radio Transmission</a> ]</TD>
                         </TR>
                     </TABLE></TD>
                 </TR>
                 <TR>
                   <TD  ALIGN="center" BGCOLOR="FFFFFF"><br>
                     <br>
<A HREF="http://rothkamm.com?ghost" target="_blank"><IMG SRC="../pictures/CD/Ghost%20of%20New%20York.jpg" WIDTH="280" HEIGHT="278" BORDER="0"></A><BR>
                       <TABLE CELLPADDING="5" CELLSPACING="0" BORDER="0" WIDTH="467">
                         <TR>
                           <TD COLSPAN="3" >&nbsp;</TD>
                         </TR>
                         <TR >
                           <TD height="10" VALIGN="TOP" CLASS="style2cTranz"><STRONG><IMG SRC="../pictures/questionmark.gif" WIDTH="16" HEIGHT="11" ALIGN="absmiddle"></STRONG><EM>What</EM></TD>
                           <TD COLSPAN="2" rowspan="2" ALIGN="LEFT"><SPAN CLASS="style2cTranz">  [+]<br>
                           Live internet <a href="http://rothkamm.com:81/listen.pls">RADIO</a> broadcast with real-time <a href="http://rothkamm.com/chat.cfm">CHAT</a> featuring the <em>premiere transmission</em> of <strong>Frank Rothkamm's</strong> first TETRALOGY compact disc: <strong class="subT"><a href="http://rothkamm.com?ghost">Ghost of New York</a></strong>. Mr. Rothkamm will introduce the electronic music as featured on this album and its relation to his 3CD+1DVD TETRALOGY series as a whole. For greater edification the historic and spiritual roots of the work will be heard in the context of compositions by <strong>Luigi Nono</strong> and <strong>Karlheinz Stockhausen</strong>.<br> 
                           [+]</SPAN></TD>
                         </TR>
                         <TR >
                           <TD VALIGN="TOP" >&nbsp;</TD>
                         </TR>
                         <TR >
                           <TD CLASS="style2cTranz"><IMG SRC="../pictures/questionmark.gif" WIDTH="16" HEIGHT="11" ALIGN="absmiddle"><EM>When </EM></TD>
                           <TD COLSPAN="2" ALIGN="LEFT" CLASS="subT">Saturday, October 10, 2009 (10/10/09)</TD>
                         </TR>
            
                         <TR >
                          
                             <TD ALIGN="LEFT" VALIGN="TOP" CLASS="style3">&nbsp;</TD>
                           <TD colspan="2" ALIGN="LEFT" ><TABLE WIDTH="200" BORDER="0" CELLPADDING="5" CLASS="style2cTranz">
                                 <TR>
                                   <TD ALIGN="LEFT" nowrap><LABEL>10:00 AM</LABEL></TD>
                                   <TD>Los Angeles</TD>
                                 </TR>
                                 <TR>
                                   <TD ALIGN="LEFT"><LABEL></LABEL>                                     <LABEL>1:00 PM</LABEL></TD>
                                   <TD> New York</TD>
                                 </TR>
                                 <TR>
                                   <TD ALIGN="LEFT"><LABEL></LABEL>
                                   18:00</TD>
                                   <TD> London</TD>
                                 </TR>
                                 <TR>
                                   <TD ALIGN="LEFT">19:00</TD>
                                   <TD>Paris - Berlin - Stockholm</TD>
                                 </TR>
                           </TABLE></TD>
                         </TR>
                         
                       
                       <TR >
                           <TD CLASS="style2cTranz"><IMG SRC="../pictures/questionmark.gif" WIDTH="16" HEIGHT="11" ALIGN="absmiddle"><EM>How </EM></TD>
                           <TD width="30" rowspan="2" ALIGN="left" valign="top" ><a href="http://rothkamm.com:81/listen.pls" target="_blank">&nbsp;<img src="../pictures/radio.jpg" width="32" height="31" border="0"></a></TD>
                           <TD rowspan="2" ALIGN="left" valign="middle" ><a href="http://rothkamm.com:81/listen.pls" target="_blank">[ click to listen ]</a></TD>
                       </TR>
            
                         <TR >
                          
                             <TD rowspan="2" ALIGN="LEFT" VALIGN="TOP" CLASS="style3">&nbsp;</TD>
                         </TR>
                         <TR >
                           <TD ALIGN="left" valign="top"  ><a href="http://rothkamm.com/chat.cfm" target="_blank">&nbsp;<img src="../pictures/chat.jpg" alt="" width="32" height="31" border="0"></a></TD>
                           <TD ALIGN="left" VALIGN="MIDDLE" ><a href="http://rothkamm.com/chat.cfm" target="_blank">[ click to chat ]</a></TD>
                         </TR>
                       </TABLE>
                   </TD>
                 </TR>
        
                 <TR>
                   <TD><TABLE BGCOLOR="#FFFFFF" BORDER="0" CELLPADDING="0" CELLSPACING="0" WIDTH="100%">
                       <TR>
                         <TD ALIGN="center"><TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" WIDTH="468">
                             <TR>
                               <TD ALIGN="center" CLASS="grey"><P><br>
                                   <br>
                                   <br>
                                 <img src="../pictures/cheleasebitmap.gif" width="15" height="15"><br>
                                   <BR>
                                 &copy;2009<A HREF="http://fluxrecords.com"> Flux Records Management Group</A>.  All Rights Reserved.<br>
                               2619 Wilshire Blvd 1002 - Los Angeles, CA 90057 - USA - (213)368-0806</P></TD>
                             </TR>
                         </TABLE></TD>
                       </TR>
                     </TABLE>
                       <!-- MAILER VERSION FOOTER -->
                       <TABLE BORDER="0" CELLPADDING="6" CELLSPACING="0" WIDTH="468" BGCOLOR="#CCCCCC">
                         <TR>
                           <TD ALIGN="left" nowrap CLASS="footer">AUDIO-VIDEO-DISCO</TD>
                           <TD ALIGN="right"><A CLASS="footer" HREF="http://rothkamm.com/register.cfm">[+] register/log-in</A></TD>
                         </TR>
                       </TABLE></TD>
           </TR>
      </TABLE>
  </BODY>
</HTML>
</cfsavecontent>

<cfscript>
letter = Replace(letter,'  ',' ','ALL');
letter = Replace(letter,'../','http://rothkamm.com/','ALL');
letter = Replace(letter,'#chr(13)#','','ALL'); 
</cfscript>

<CFIF IsDefined('URL.test')>

<!--- <HTML>
<HEAD>
<TITLE><CFOUTPUT>#ds#script_name#</CFOUTPUT> </TITLE>
<CFINCLUDE TEMPLATE="../_javascript.cfm">
<LINK HREF="../css.css" REL="stylesheet" TYPE="text/css">
</HEAD>

<BODY >
<div id="margin-left:auto; margin-right:auto;">
<div id="menue"><CFINCLUDE TEMPLATE="../_menue2.cfm"></div>
<div id="Layer2"><CFINCLUDE TEMPLATE="../_header.cfm"></div>
<CFINCLUDE template="../_layers.cfm">

<div id="Layer1"> ---><!--- CONTENT --->
<!--- <TABLE WIDTH="100%" BORDER="0" ALIGN="right" CELLPADDING="1" CELLSPACING="0"  BGCOLOR="#3F3F3F">

  <TR>
    <TD ><TABLE BORDER="0" WIDTH="100%" CELLPADDING="0" CELLSPACING="0" BGCOLOR="#FFFFFF">
	    
		 
<TR>
<TD  ALIGN="center" VALIGN="TOP" CLASS="style1"> ---><cfoutput>#letter#</cfoutput><!--- <CFINCLUDE TEMPLATE="../foot.cfm"> ---><!--- </TD>
</TR>
</TABLE>

</TD>
</TR>
</TABLE> ---><!--- </TD></TR></TABLE>
</div>
</BODY>
</HTML> --->



<CFIF REFindNoCase('[0-9a-z\-]@[0-9a-z\-]*\.',URL.test)>
<CFMAIL TYPE="HTML" FROM = "ROTHKAMM <frank@rothkamm.com>" TO = "#URL.test#" SUBJECT = '#EmailSubject#'>#letter#</CFMAIL
><CFOUTPUT>#URL.test#<BR>#HTMLEditFormat(Replace(letter,"#chr(13)#","","ALL"))#</CFOUTPUT>
</CFIF>
<CFABORT>
</CFIF>


<CFIF IsDefined('URL.total') and IsDefined('client.ClientID')>
<CFSET email2 = Replace(trim(email),"mailto:","","ALL")>
<CFIF REFindNoCase('[0-9a-z\-]@[0-9a-z\-]*\.',email2)>
<CFMAIL TYPE="HTML" FROM = "ROTHKAMM <frank@rothkamm.com>" TO = "#email2#" SUBJECT = '#EmailSubject#'>#letter#</CFMAIL>
<CFOUTPUT>#email2#</CFOUTPUT><BR>
</CFIF>
</CFIF>

</CFLOOP>


