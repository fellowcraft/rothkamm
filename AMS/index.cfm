<cfdirectory action="list" directory="#ExpandPath('/AMS')#" name="listAMS">

<pre>
====================================================
AMS open source modular (virtual) analog synthesizer

<cfloop query="ListAMS">
<CFIF NOT ReFind('\.*index*',name)><CFOUTPUT><a href="#name#">#name#</a></CFOUTPUT>
</CFIF></cfloop>
</pre>
