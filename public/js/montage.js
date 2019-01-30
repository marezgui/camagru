(function() {

var streaming = false,
	video		= document.querySelector('#video'),
	cover		= document.querySelector('#cover'),
	canvas		= document.querySelector('#canvas'),
	photo		= document.querySelector('#photo'),
	startbutton	= document.querySelector('#startbutton'),
	take		= document.querySelector('#take'),
	form		= document.querySelector('form'),
	frame		= document.querySelector('#kitten'),
	ctx 		= canvas.getContext('2d'),
	img_h	= frame.offsetHeight,
	img_w	= frame.offsetWidth,
	filtre	= "kitten",
	size	= 1,
	setoffX = 0,
	setoffY = 0,
	width	= 500,
	mouse	= 1,
	height	= 0;

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
	},
	function(err) {
	console.log("An error occured! " + err);
	}
);

video.addEventListener('canplay', function(ev){
	if (!streaming) {
	height = video.videoHeight / (video.videoWidth/width);
	video.setAttribute('width', width);
	video.setAttribute('height', height);
	canvas.setAttribute('width', width);
	canvas.setAttribute('height', height);
	streaming = true;
	}
}, false);

//Obliger de declare img_h et img_w car firefox ne les detecte pas avec offsetHeight
if (img_h == 0 || img_w == 0)
{
	img_w = 500;
	img_h = 500;
}

canvas.addEventListener('mousemove', function(e)
{
	img_w
	if (mouse == '1')
	{
		setoffX = e.offsetX - img_w/2*size;
		setoffY = e.offsetY - img_h/2*size;
		srcX = e.offsetX;
		srcY = e.offsetY;
	}
});

function updateCanvas()
{
	canvas.width = width;
	canvas.height = height;
	ctx.drawImage(video, 0, 0, width, height);
	if (filtre != 'none')
		ctx.drawImage(document.getElementById(filtre), setoffX, setoffY, img_w * size, img_h * size);
	setTimeout(updateCanvas, 100);
};

document.addEventListener('keydown', (event) => {
	if(event.key == '+')
	{
	size += 0.1;
	}
	else if (event.key == '-')
	{
	if (size > 0.2)
		size -= 0.1;
	}
	else if(event.key == '0')
	mouse ^= 1;
	
});

form.addEventListener("change", function(event) {
	size = 0.6;
	var data = new FormData(form);
	for (const entry of data) {
	filtre = entry[1];
	frame = document.querySelector('#' + filtre);0
	};
});

startbutton.addEventListener('click', function(ev){
	updateCanvas();
});

take.addEventListener('click', function(ev){
	console.log(size, srcX, srcY);
	console.log(setoffX, setoffY);
});

})();