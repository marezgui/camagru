var streaming = false,
	video		= document.querySelector('#video'),
	cover		= document.querySelector('#cover'),
	canvas		= document.querySelector('#canvas'),
	photo		= document.querySelector('#photo'),
	take		= document.querySelector('#take'),
	frame		= document.querySelector('#kitten'),	
	nofiltre	= document.querySelector('#nofiltre'),	
	addfiltre	= document.querySelector('#addfiltre'),
	ctx 		= canvas.getContext('2d'),
	btn			= document.getElementsByClassName("btn"),
	allfiltre	= document.getElementsByClassName("filtre"),
	img 		= new Image(),
	dataUrl	,
	camera	= 0,
	img_h	= [frame.naturalHeight],
	img_w	= [frame.naturalWidth],
	idfiltre = ["none"],
	size	= [0.6],
	setoffX = [0],
	setoffY = [0],
	width	=  window.innerWidth * 0.30,
	mouse	= 1,
	height	= 0,
	heightInner = width*0.9 ;

canvas.width = width;
canvas.height = height;

window.addEventListener("resize", updateSize);


function updateSize()
{	
	width	=  window.innerWidth *0.3;
	height = width*0.9;	
	canvas.width = width;
	canvas.height = height;
	console.log(height, width, window.innerHeight, window.innerWidth);
};

navigator.getMedia = ( navigator.getUserMedia ||
						navigator.webkitGetUserMedia ||
						navigator.mozGetUserMedia ||
						navigator.msGetUserMedia);

navigator.getMedia(
	{
	video: true,
	audio: false
	},
	function(stream) {
	if (navigator.mozGetUserMedia) {
		video.srcObject = stream;
	} else {
		var vendorURL = window.URL || window.webkitURL;
		video.srcObject = stream;
	}
	video.play();
	camera = 1;
	},
	function(err) {
		height = heightInner;
	console.log("An error occured! " + err);
	}
);

nofiltre.addEventListener('click', function(){
	if (img_w.length > 1)
	{
		img_h.pop();
		img_w.pop();
		idfiltre.pop();
		size.pop();
		setoffX.pop();
		setoffY.pop();
	}
	else
		idfiltre[idfiltre.length - 1] = "none";
});

addfiltre.addEventListener('click', function(){
	img_h.push(frame.naturalHeight);
	img_w.push(frame.naturalWidth);
	idfiltre.push("kitten");
	size.push(0.6);
	setoffX.push(0);
	setoffY.push(0);
	size[size.length - 1] = 0.6;
	idfiltre[idfiltre.length - 1] = "kitten";
	frame = document.getElementById(idfiltre[idfiltre.length - 1]);
	img_h[img_h.length - 1] = frame.naturalHeight;
	img_w[img_w.length - 1] = frame.naturalWidth;
});

video.addEventListener('canplay', function(ev){
	if (!streaming) {
	height = width*0.9;
	video.setAttribute('width', width);
	video.setAttribute('height', height);
	canvas.setAttribute('width', width);
	canvas.setAttribute('height', height);
	streaming = true;
	}
}, false);

canvas.addEventListener('mousemove', function(e)
{
	if (mouse == '1')
	{
		setoffX[setoffX.length - 1] = e.offsetX - img_w[img_w.length - 1]/2*size[size.length - 1];
		setoffY[setoffY.length - 1] = e.offsetY - img_h[img_h.length - 1]/2*size[size.length - 1];
		srcX = e.offsetX;
		srcY = e.offsetY;
	}
});

document.addEventListener("load", updateCanvas());

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
	for (var i = 0; i < idfiltre.length; i++) 
	{			
		if (idfiltre[i] != 'none')
			ctx.drawImage(document.getElementById(idfiltre[i]), setoffX[i], setoffY[i], img_w[i] * size[i], img_h[i] * size[i]);
	}
	setTimeout(updateCanvas, 25);
};

document.addEventListener('keydown', (event) => {
	if(event.key == '+')
	{
	size[size.length - 1] += 0.1;
	}
	else if (event.key == '-')
	{
	if (size[size.length - 1] > 0.2)
		size[size.length - 1] -= 0.1;
	}
	else if(event.key == '0')
	mouse ^= 1;
	
});

canvas.addEventListener('click', function(){
	mouse ^= 1;
});

for (var i = 0; i < allfiltre.length; i++) {
    allfiltre[i].addEventListener('click', get_filtre, false);
}


function get_filtre()
{
	size[size.length - 1] = 0.6;
	idfiltre[idfiltre.length - 1] = this.id;
	frame = document.getElementById(idfiltre[idfiltre.length - 1]);
	img_h[img_h.length - 1] = frame.naturalHeight;
	img_w[img_w.length - 1] = frame.naturalWidth;
}