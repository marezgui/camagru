function updateSize()
{
	if (vw.matches)
	{
		width = 310;
		height = 300;
	}
	else
	{
		width = 372;
		height = 334;
	}
	canvas.width = width;
	canvas.height = height;
	video.width = width;
	video.height = height;
}

function updateCanvas()
{
	if (img['src'] == '' && camera == 1)
		ctx.drawImage(video, 0, 0, width, height);
	else
	{		
		ctx.fillStyle = "#FFFFFF";
		ctx.fillRect(0, 0, width, height);
		ctx.drawImage(img, 0, 0, width, height);
	}
	dataUrl = canvas.toDataURL();
	for (let i = 0; i < idfiltre.length; i++) 
	{			
		if (idfiltre[i] != 'none')
			ctx.drawImage(document.getElementById(idfiltre[i]), setoffX[i], setoffY[i], img_w[i] * size[i], img_h[i] * size[i]);
	}
	setTimeout(updateCanvas, 25);
}

let streaming = false;
let	video		= document.querySelector('#video');
let	canvas		= document.querySelector('#canvas');
let	frame		= document.querySelector('#kitten');
let	ctx 		= canvas.getContext('2d');
let	img 		= new Image();
let	dataUrl	= "";
let	camera	= 0;
let	img_h	= [frame.naturalHeight];
let	img_w	= [frame.naturalWidth];
let	idfiltre = ["none"];
let	size	= [0.6];
let	setoffX = [0];
let	setoffY = [0];

let vw = window.matchMedia("(max-width: 412px)");
let	width	= canvas.width;
let	height	= canvas.height;

navigator.getMedia = (navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia);

navigator.getMedia(
	{
		video: true,
		audio: false
	},
	function(stream) 
	{
		if (navigator.mozGetUserMedia) 
		{
			video.srcObject = stream;
		} 
		else 
		{
			let vendorURL = window.URL || window.webkitURL;
			video.srcObject = stream;
		}
		video.play();
		camera = 1;
	},
	function(err) 
	{
		console.log("An error occured! " + err);
	}
);

canvas.width = 0;
canvas.height = 0;

video.addEventListener('canplay', function(ev)
{
	if (!streaming) 
	{
		updateSize();
		streaming = true;
	}
}
	,false
);

document.addEventListener("load", updateCanvas());
vw.addListener(updateSize);