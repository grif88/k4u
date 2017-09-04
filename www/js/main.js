function str_brs(str1)
{
	str1 = str1.replace(new RegExp("\n",'g'),'<br>');
	return str1;
}

function loadScript(url)
{
    var e = document.createElement("script");
    e.src = url;
    e.type="text/javascript";
    document.getElementsByTagName("head")[0].appendChild(e); 
}