<!--- <cfflush interval="10"> --->

<CFIF IsDefined('url.RequestTimeOut')>
<CFSETTING RequestTimeOut="#url.RequestTimeOut#">
</CFIF>


<CFIF NOT FileExists('/home/frank/rothkamm/ROTHKAMM/press/FluxRecords[#NumberFormat(trim(id),"00")#].html') >
<CFLOCATION url="http://rothkamm.com/press/FluxRecords[#NumberFormat(trim(id),'00')#].pdf" addtoken="no">
<CFABORT>
</CFIF>


<CFQUERY DATASOURCE="rothkamm" NAME="all" >
SELECT DISTINCT email
FROM         People
WHERE status <> 1
UNION
SELECT DISTINCT PAYER_EMAIL As 'email'
FROM         CUSTOMERS
WHERE status <> 1
UNION
SELECT DISTINCT email
FROM         links
where status < 1 or status = 2
</CFQUERY>


<CFFILE action = "read" 
file = "/home/frank/rothkamm/ROTHKAMM/press/FluxRecords[#trim(numberformat(id,'00'))#].html" 
variable = "TheContent">


<cfscript>

s = FindNoCase('<title>',TheContent)+7;
e = FindNoCase('</title>',TheContent,s);
if(e GT s) 
EmailSubject = Mid(TheContent,s,int(e-s));
else
EmailSubject = 'Flux Records Press Publication #id#';

</cfscript>

<CFSAVECONTENT variable="letter"><CFOUTPUT>#TheContent#</CFOUTPUT></CFSAVECONTENT>

<CFSCRIPT>
letter = Replace(letter,'  ',' ','ALL');
letter = Replace(letter,'../','http://fluxrecords.com/','ALL');
letter = Replace(letter,'#chr(13)#','','ALL'); 

// if(IsDefined('addr') or IsDefined('total'))
// letter = ReplaceNoCase(letter,'<body>','<body><P ALIGN="center"><font face="Verdana, Arial, Helvetica, sans-serif;" size="1" color="CCCCCC">Trouble seeing ///this email? <A HREF="http://rothkamm.com/press/release.cfm?id=#id#">View it as a web page</A>.<BR />&nbsp;<BR /></font></P>');
// else
// letter = ReplaceNoCase(letter,'<body>','<body><P ALIGN="center"><A HREF="http://rothkamm.com"><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="CCCCCC">Flux Records Press Publication No#id#</font></A></P>');


</CFSCRIPT>
 
<CFLOOP QUERY="all" startrow="1" endrow="#all.recordcount#">

 <CFIF NOT IsDefined('URL.total')><!--- <div align="center"><a href="http://rothkamm.com">[+]</a> ---></div><CFOUTPUT>#letter#</CFOUTPUT></CFIF>

 <CFIF IsDefined('URL.addr')>
  <CFIF REFindNoCase('[0-9a-z\-]@[0-9a-z\-]*\.',URL.addr)>
   <CFMAIL FROM = "FluxRecords <info@fluxrecords.com>" TO = "#URL.addr#" SUBJECT = '#EmailSubject#'>
    <cfmailpart type="text" wraptext="74">#REReplace(letter,'<[^>]*>','','all')#</cfmailpart>
    <cfmailpart type="html">#letter#</cfmailpart>
</CFMAIL
><CFOUTPUT>#URL.addr#<BR>#HTMLEditFormat(letter)#</CFOUTPUT>


  </CFIF>
 </CFIF>

<CFIF NOT IsDefined('URL.total')><CFABORT></CFIF>


<CFIF IsDefined('URL.total') and IsDefined('client.ClientID')>
<CFSET email2 = Replace(trim(email),"mailto:","","ALL")>
<CFIF REFindNoCase('[0-9a-z\-]@[0-9a-z\-]*\.',email2)>
<CFMAIL FROM = "FluxRecords <info@fluxrecords.com>" TO = "#email2#" SUBJECT = '#EmailSubject#'>
<cfmailpart type="text" wraptext="74">#REReplace(letter,'<[^>]*>','','all')#</cfmailpart>
<cfmailpart type="html">#letter#</cfmailpart>
</CFMAIL>

<CFOUTPUT>#email2#</CFOUTPUT><BR>
<!--- <cfset thread = CreateObject("java", "java.lang.Thread")>
<cfset thread.sleep(60000)> --->
</CFIF>
</CFIF>

</CFLOOP>
