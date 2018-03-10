<cfquery datasource="#ds#" name="dict">
select * from dictionary 
order by Entry
</cfquery>

<cfquery datasource="#ds#" name="all">
select * from influences 
order by LastName
</cfquery>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<cfoutput query="all">
[#numberformat(currentrow,'00')#] <b>#Left(LastName,1)#</b>#Mid(LastName,2,Len(LastName))#<cfif len(FirstName) GT 1>,</cfif> #FirstName#<br />
</cfoutput>

<cfoutput query="dict">
[#numberformat(currentrow,'00')#] <b>#Left(Entry,1)#</b>#Mid(Entry,2,Len(Entry))#<br />
</cfoutput>

<table border="1" cellpadding="5" cellspacing="0"><tr><font color="red"><b><td><b>New</b></td><td><b>Can<br>Con</b></td><td><b>Artist</b></td><td><b>Title</b></td><td><b>Album</b></td><td><b>Label</b></td><td><b>Time</b></td><td><b>Length</b></td></b></font></tr><tr><td> </td><td>Y</td><td>Samuel Andreyev</td><td>Life Story</td><td>Songs of Elsewhere</td><td>Torpor Vigil Industries</td><td>23:35</td><td>7:33</td></tr><tr><td> </td><td> </td><td>Chat with...</td><td>Christine Duncan and...</td><td>Rob Piilonen</td><td>n/a</td><td>23:43</td><td>20:00</td></tr><tr><td> </td><td>Y</td><td>Samuel Andreyev</td><td>International Chimney and the Matyiko Boys</td><td>Songs of Elsewhere</td><td>Torpor Vigil Industries</td><td>00:04</td><td>8:04</td></tr><tr><td> </td><td>Y</td><td>live performance and cat with...</td><td>Christine Duncan and...</td><td>Rob Piilonen</td><td>n/a</td><td>00:12</td><td>33:00</td></tr><tr><td> </td><td> </td><td>John Cage & Lejaren Hiller</td><td>HPSCHD (excpt)Musicworks98</td><td>Musicworks98</td><td>Musicworks</td><td>00:45</td><td>6:42</td></tr><tr><td> </td><td> </td><td>Mike Kane</td><td>A Peacock Retraces Its Steps</td><td>Musicworks98</td><td>Musicworks</td><td>00:52</td><td>11:18</td></tr><tr><td>Y</td><td> </td><td><b>Rothkamm</b></td><td><b>Odyssey I 70</b></td><td>FB03</td><td>Flux</td><td>01:11</td><td>11:53</td></tr><tr><td>Y</td><td> </td><td>Thanos Chrysakis</td><td>Nekyomanteion</td><td>Klage</td><td>Aural Terrains</td><td>01:23</td><td>13:06</td></tr><tr><td>Y</td><td>Y</td><td>A_dontigny</td><td>Koons</td><td>Geisteswissenschaften</td><td>no type</td><td>01:46</td><td>3:04</td></tr><tr><td>Y</td><td>Y</td><td>A_dontigny</td><td>Pruitt-Igoe</td><td>Geisteswissenschaften</td><td>no type</td><td>01:49</td><td>2:05</td></tr><tr><td> </td><td> </td><td>Porest</td><td>Drain the Swamp</td><td>Mood Noose</td><td>Resipiscent</td><td>01:51</td><td>4:23</td></tr><tr><td> </td><td> </td><td>Masonic Youth</td><td>The Haunted Lodge</td><td>Veen Ridders</td><td>Resipiscent</td><td>01:55</td><td>4:32</td></tr></table


</body>
</html>
