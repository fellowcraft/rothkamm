<?xml version='1.0' encoding="UTF-8"?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:output method="html" />

<xsl:template match="/">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
    Untitled Document
</title>
<meta http-equiv="Content-Type" content="text/html;CHARSET=utf-8"/>

<xsl:text disable-output-escaping="yes">

<![CDATA[

<script type="text/javascript">
<!--

function ApplyFilter() {
	var imgName,image,objStr = ApplyFilter.arguments[0];
	image = document.getElementById (objStr);
	image.onload = null;
	imgName = ApplyFilter.arguments[1];
	if (navigator.platform == "Win32" && navigator.appName == "Microsoft Internet Explorer") {
		image.style.filter="progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true, sizingmethod=scale, src='" + imgName + "' );"
	}
	else {
		image.src = imgName;
	}
}
//-->
</script>
]]>

</xsl:text>

<style type="text/css">
<xsl:text disable-output-escaping="yes">

<![CDATA[

<!-- 
    a:link {
        color:blue;
        text-decoration:underline;
    }
    a:active { color:red }
    a:visited { color:purple }
    body {
        background-color:white;
        color:#393838;
    }
    .box1 {
        width:540px;
        height:720px;
    }
    .box2 {
        position:absolute;
        left:50px;
        top:36px;
        background-color:white;
        width:526px;
        height:471px;
    }
    .box3 {
        position:absolute;
        left:46px;
        top:516px;
        width:538px;
        height:117px;
    }
    .box4 {
        position:absolute;
        left:36px;
        top:648px;
        width:531px;
        height:114px;
    }
    .box5 {
        position:absolute;
        left:225px;
        top:15px;
        width:184px;
        height:41px;
    }
    .box6 {
        position:absolute;
        left:37px;
        top:32px;
        width:13px;
        height:124px;
    }
 -->
]]>

</xsl:text>

</style>
</head>

<body topmargin="0" leftmargin="0" marginheight="0" marginwidth="0">
<table border="0" cellspacing="0" cellpadding="0" align="left">
    <tr>
        <td colspan="2"></td><td valign="top" width="1" height="36">
        <img src="image/qwdspacer.gif" alt="" width="1" height="36" border="0" 
        /></td>
    </tr>
    <tr>
        <td></td><td valign="top" width="540" height="720">
        <div class="box1">
            <img src="image/qwdspacer.gif" alt="" width="540" height="720" 
            border="0" id="Text19Copy19" onLoad=
            "ApplyFilter('Text19Copy19','image/Text19_Copy19.png')" name=
            "Text19Copy19" /></div>
        </td><td valign="top" width="1" height="720">
        <img src="image/qwdspacer.gif" alt="" width="1" height="720" border="0" 
        /></td>
    </tr>
    <tr>
        <td valign="top" width="36" height="1">
        <img src="image/qwdspacer.gif" alt="" width="36" height="1" border="0" 
        /></td><td valign="top" width="540" height="1">
        <img src="image/qwdspacer.gif" alt="" width="540" height="1" border="0" 
        /></td><td valign="top" width="1" height="1">
        <img src="image/qwdspacer.gif" alt="" width="1" height="1" border="0" 
        /></td></tr>
</table>
<div class="box2">
    <img src="image/rothkamm-413_Copy17.jpg" alt="rothkamm-4.jpg" width="526" 
    height="471" border="0" /></div>
<div class="box3">
    <img src="image/qwdspacer.gif" alt="IF I AM AN ARTIST I STILL DO NOT KNOW" 
    width="538" height="118" border="0" id="Text16Copy16" onLoad=
    "ApplyFilter('Text16Copy16','image/Text16_Copy16.png')" name="Text16Copy16" 
    /></div>
<div class="box4">
    <img src="image/qwdspacer.gif" alt=
    "ABOUT THE COMPOSER FRANK HOLGER ROTHKAMM, UNCONVENTIONAL OPUS C" width=
    "531" height="114" border="0" id="Text15Copy15" onLoad=
    "ApplyFilter('Text15Copy15','image/Text15_Copy15.png')" name="Text15Copy15" 
    /></div>
<div class="box5">
    <img src="image/qwdspacer.gif" alt="NZFM.jpg" width="184" height="41" 
    border="0" id="NZFM60Copy13" onLoad=
    "ApplyFilter('NZFM60Copy13','image/NZFM60_Copy13.png')" name="NZFM60Copy13" 
    /></div>
<div class="box6">
    <img src="image/qwdspacer.gif" alt="Photo by Ken Montgomery" width="13" 
    height="123" border="0" id="Text12Copy12" onLoad=
    "ApplyFilter('Text12Copy12','image/Text12_Copy12.png')" name="Text12Copy12" 
    /><img src="image/qwdspacer.gif" alt="" width="1" height="1" border="0" 
    align="right" /></div>

</body>
</html>
</xsl:template>

</xsl:stylesheet>