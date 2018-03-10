
<CFDIRECTORY ACTION="list" SORT="name ASC" NAME="IFORM"  DIRECTORY="#GetDirectoryFromPath(ExpandPath("*.*"))#">

<CFOUTPUT> 
<CFLOOP QUERY="IFORM" STARTROW="3">
 <CFIF Find('.pdf',name)>
  <cfexecute name="convert" arguments="-thumbnail 200x #name# #name#.png"></cfexecute>
 </CFIF>
</CFLOOP>

</CFOUTPUT>

