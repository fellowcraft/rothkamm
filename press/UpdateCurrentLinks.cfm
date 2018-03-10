<CFQUERY DATASOURCE="rothkamm" NAME="kill">
DELETE FROM CurrentLinks
</CFQUERY>

<CFQUERY DATASOURCE="rothkamm" NAME="all">
SELECT * 
FROM         links
where status < 1 and Address1 <> ''
</CFQUERY>

<cfoutput query="all">

<CFQUERY NAME="update" DATASOURCE="rothkamm">
INSERT INTO CurrentLinks (FirstName,LastName,CompanyName,Address1,Address2,City,State,ZIP,country) VALUES ('#FirstName#','#LastName#','#CompanyName#','#Address1#','#Address2#','#City#','#State#','#ZIP#','#country#')
</CFQUERY> 

</cfoutput>
