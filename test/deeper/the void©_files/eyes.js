/*
script edited by David Gardner (toolmandav@geocities.com)
Permission granted to Dynamicdrive.com to feature the script
For more DHTML scripts, visit Dynamicdrive.com
*/

//put your text here
var theText = "fuck you!";
var theDiv = document.getElementById("theDiv");

function nextSize(i,incMethod,textLength)
{
if (incMethod == 1) return (72*Math.abs( Math.sin(i/(textLength/3.14))) );
if (incMethod == 2) return (255*Math.abs( Math.cos(i/(textLength/3.14))));
}

function sizeCycle(text,method,dis)
{
	output = "";
	for (i = 0; i < text.length; i++)
	{
		size = parseInt(nextSize(i +dis,method,text.length));
		output += "<font style='font-size: "+ size +"pt'>" +text.substring(i,i+1)+ "</font>";
	}
	theDiv.innerHTML = output;
}

function doWave(n) 
{   
	sizeCycle(theText,1,n);
	if (n > theText.length) {n=0}
	setTimeout("doWave(" + (n+1) + ")", 50);
}
