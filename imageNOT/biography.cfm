<CFQUERY DATASOURCE="#ds#" NAME="websites">
SELECT * FROM websites
</CFQUERY>

<CFQUERY NAME="allstyles" DATASOURCE="#ds#">
SELECT * FROM Style 
ORDER BY Style
</CFQUERY>

<CFQUERY NAME="allparts" DATASOURCE="#ds#">
SELECT * FROM PART
WHERE status <> 0
ORDER BY YEAR DESC, Month DESC, Day DESC
</CFQUERY>

<cfset myarray = listToArray(valueList(websites.url))>

<HTML>

<!-- (c) rothkamm 2004 | Rothkamm.com case study | coldfusion mx 6.1 | dreamweaver mx 7.0 | sql server 2000 | fireworks MX 6.0 | photoshop 7.0 | windows 2003 server -->

<HEAD>
<TITLE><CFOUTPUT>#ds##script_name#</CFOUTPUT> </TITLE>
<CFINCLUDE TEMPLATE="_javascript.cfm">
<LINK HREF="css.css" REL="stylesheet" TYPE="text/css">
</HEAD>

<BODY >
<div id="margin-left:auto; margin-right:auto;">
<DIV ID="menue"><CFINCLUDE TEMPLATE="_menue2.cfm"></DIV>
<DIV ID="Layer2"><CFINCLUDE TEMPLATE="_header.cfm"></DIV>
<cfinclude template="_layers.cfm">
<DIV ID="Layer1"><!--- CONTENT --->
<TABLE WIDTH="100%" BORDER="0" ALIGN="right" CELLPADDING="1" CELLSPACING="0"  BGCOLOR="#3F3F3F">

  <TR>
  
    <TD VALIGN="TOP"><TABLE BORDER="0"  WIDTH="100%" CELLPADDING="10" CELLSPACING="0" BGCOLOR="#FFFFFF">
	     		 

	    <TR>
        
         <TD ALIGN="center" VALIGN="middle" ><img src="image/rothkamm_with_sculpture.jpg" width="600"><!--- <IMG SRC="http://chart.apis.google.com/chart?cht=t&chs=300x160&chld=CA,US&chtm=world" BORDER="0" CLASS="style2" ID="Image7"><IMG SRC="http://chart.apis.google.com/chart?cht=t&chs=300x160&chd=t:0,100,50&chco=FFFFFF,FF0000,00FF00&chld=DE&chtm=europe" BORDER="0" CLASS="style2" ID="Image7"> ---></TD>
		</TR>
		
		
	      <TR> 
			
	        <TD><P CLASS="style2c"><STRONG>Frank Holger Rothkamm</STRONG> (born on July 2nd, 1965 in G&uuml;tersloh, West Germany) is a <EM><a href="http://en.wikipedia.org/wiki/Composer">composer</a></EM> &amp; <a href="http://en.wikipedia.org/wiki/Conceptual_art"><EM>conceptual artist</EM></a>. He lives and works in Los Angeles.</P>
	          <P CLASS="style2c"> As an &quot;<A HREF="http://rothkamm.com/album.cfm?ALT">extremely prolific</A>&quot; (Exclaim!) &quot;<A HREF="http://zookeeper.stanford.edu/index.php?s=byAlbumKey&n=956437&q=10&action=search&session=">experimental favorite</A>&quot; (KZSU) &quot;<A HREF="http://rothkamm.com/album.cfm?Moers-Works">lone wolf genius</A>&quot; (Sound Projector) and <A HREF="http://rothkamm.com/album.cfm?ALT">&quot;German sound art legend</A>&quot; (Earlabs), who &quot;<A HREF="http://rothkamm.com/album.cfm?Frank-Genius-Is-Star-Struck">never seems to do the same thing twice</A>&quot; (Vital Weekly), his &quot;<A HREF="http://rothkamm.com/album.cfm?just-3-organs">charmingly eccentric</A>&quot; (Rare Frequency) and &quot;<A HREF="http://rothkamm.com/album.cfm?just-3-organs">enigmatically unpigeonholeable</A>&quot; (Touching Extremes) work is &quot;<A HREF="http://rothkamm.com/album.cfm?opus-spongebobicum">always delivered with an unceasing attention to detail, precision and humour</A>&quot; (Furthernoise) in a &quot;<A HREF="http://www.rermegacorp.com/Merchant2/merchant.mv?Screen=PROD&Store_Code=RM&Product_Code=FLX12&Category_Code=CU">variety of media</A>&quot; (ReR) with the &quot;<A HREF="http://rothkamm.com/album.cfm?FB02">quasi-mystical principles of a philosopher-cum-musician</A>&quot; (e|i).</P>
	          <P CLASS="style2c"><STRONG>ROTHKAMM </STRONG>  provided <STRONG>rhythm synthesis</STRONG> for the <A HREF="http://sunburn.org">Hardkiss Bros</A>. (1992), <A HREF="http://peterscherer.com">Peter Scherer</A> (1994) <A HREF="http://corin.ch/" >Corin Curschellas</A> (1995-1997), <A HREF="http://elliottsharp.com" >Elliott Sharp</A> (1996-1997), <A HREF="http://alfredharth.blogspot.com/" >Alfred 23 Harth</A> (1996), <A HREF="http://www.materialrecords.com" >Wolfgang Muthspiel</A> (1997)<A HREF="http://www.myspace.com/lesacarlson"> Lesa Carlson</A> (2000) and <A HREF="http://djspooky.com" >DJ Spooky</A> (2002); <STRONG>sonic concepts</STRONG> to  <A HREF="http://en.wikipedia.org/wiki/Rodney_Graham">Rodney Graham</A> (1989), <A HREF="http://www.haraldfuchs.de/">Harald Fuchs</A> (1985-1987), <A HREF="http://www.artleak.org/thater.html">Diane Thater &amp; T. Kelly M</A><A HREF="http://www.artleak.org/thater.html">ason</A> (1999), and <A HREF="http://www.thing.net/~glove/tuning/page2.html" >DJ Glove</A> (1997); <!--- <STRONG>remixes</STRONG> for  the <A HREF="http://www.cranberries.ie/">Cranberries</A>, <A HREF="http://www.zeenaparkins.com/" >Zeena Parkins</A>, <A HREF="http://www.tyrantsintherapy.com" >Tyrants in Therapy</A>, and <A HREF="http://rebekkabakken.universalmusic.at/ " >Rebekka Bakken</A>, --->  <STRONG>track licensing</STRONG> under  <A HREF="http://fluxrecords.org?kw=blowpop">Mrs. Blowpop</A> (1992), <A HREF="http://www.amazon.com/gp/product/B0000030ZQ/sr=1-2/qid=1150754762/ref=sr_1_2/002-1930463-5810401?%5Fencoding=UTF8&s=music">Speed Genius Overdose</A> (1993), <A HREF="http://kzsu.stanford.edu/%7Edoom/Playlists/083195.html">Frank Genius</A> (1990-1995) and <A HREF="http://fluxrecords.com">Flux Records</A> (since 1994) ; a <STRONG><STRONG>computer language</STRONG></STRONG><A HREF="http://iformm.com"> IFORMM</A> that descended from his studies with <A HREF="http://en.wikipedia.org/wiki/Clarence_Barlow">Clarence Barlow</A> (1986) and his software emulation of<A HREF="http://membres.lycos.fr/musicand/INSTRUMENT/DIGITAL/UPIC/UPIC.htm"> Iannis Xenakis' UPIC</A> for <A HREF="http://www.scienceworld.bc.ca/">Science World of British Columbia</A> (1989); <STRONG><STRONG>web integration</STRONG> for </STRONG><A HREF="http://www2.warnerbros.com/web/music/jukebox.jsp">Warner Bros.</A> (1999), <A HREF="http://jazz.external.hp.com/">Hewlett-Packard</A> (1999-2000), <A HREF="http://www.mercuryvehicles.com/">Ford </A>(2000), <A HREF="http://BMC.com">BMC</A> (2000),  the <A HREF="http://latimes.com">Los Angeles Times </A> (1999) and the <A HREF="http://nyphil.org">New York Philharmonic</A> (2006-2009); <STRONG>commercials</STRONG> for <A HREF="http://www.us.levi.com/lsco/levi/prod/l_prod.jsp?FOLDER%3C%3Efolder_id=2534374305317099&bmUID=1150753997253">Levi Strauss</A> (1992), <A HREF="http://sears.com">Sears</A> (1997) and <A HREF="http://www.philips.com">Philips</A> (1995);  and <STRONG>soundtracks</STRONG> to film  experiments in 3-D projection technology, among them George Lucas' &quot;<A HREF="http://starwars.com">Star Wars</A>&quot; (1995-1996).</P>
<P CLASS="style2c"> Since 2005 his complete works are being published in random order as a series of compact disc albums:  the <EM>machine trilogy</EM> of &quot;<A HREF="http://rothkamm.com/album.cfm?FB01">FB01</A>&quot; (2002-2003),&quot;<A HREF="http://rothkamm.com/album.cfm?FB02">FB02 (Astronaut of Inner Space)</A>&quot; (2003-2004) &amp; &quot;<A HREF="http://rothkamm.com/album.cfm?FB03">FB03 (E Pluribus Unum)</A>&quot; (2003-2006), the  teenage tape recovery of  &quot;<A HREF="http://moers-works.rothkamm.com">Moers Works</A>&quot; (1982-1984), the Y2K reenactment of <A HREF="http://rothkamm.com/album.cfm?LAX">LAX</A> (1998-2000), the story and sound of &quot;<A HREF="http://rothkamm.com/album.cfm?just-3-organs">just 3 organs</A>&quot; (2003-2004), the piano-forte of &quot;<A HREF="http://rothkamm.com/album.cfm?opus-spongebobicum">Opus Spongebobicum</A>&quot; (2006-2008), his  digital cantata &quot;<A HREF="http://rothkamm.com/album.cfm?frank-genius-is-star-struck">Frank Genius is Star Struck</A>&quot; (1990-1991), the ambient algorithms of &quot;<A HREF="http://rothkamm.com/album.cfm?ALT">ALT</A>&quot; (1989-2002), the ambitious <EM>TETRALOGY</EM> (3CD + 1DVD) that includes the haunting &quot;<a href="http://rothkamm.com/album.cfm?Ghost-of-New-York">Ghost of New York</a>&quot; (2005-2006), the classical  &quot;<A HREF="http://rothkamm.com/album.cfm?zahra-fugues">Zahra Fugues</A>&quot; (2008), the mesmerizing  &quot;<A HREF="http://rothkamm.com/album.cfm?birth-of-primary-cinema-from-the-spirit-of-sound">Birth of Primary Cinema From The Spirit Of Sound</A>&quot; (2008-2010) and the endurance testing &quot;<A HREF="http://rothkamm.com?amerika">Amerika</A>&quot; (2008), followed by the ballet of <a href="http://rothkamm.com/album.cfm?RENO">RENO</a> (1992-1997).</P></TD></TR>
</TABLE><CFINCLUDE TEMPLATE="foot.cfm"></TD></TR></TABLE>              
                          
                          
    </TD></TR></TABLE>


</DIV>
</BODY>

</HTML>




