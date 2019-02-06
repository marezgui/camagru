(function() {

var streaming = false,
	video		= document.querySelector('#video'),
	cover		= document.querySelector('#cover'),
	canvas		= document.querySelector('#canvas'),
	photo		= document.querySelector('#photo'),
	take		= document.querySelector('#take'),
	form		= document.querySelector('form'),	
	list_filtre	= document.querySelector('list_filtre'),
	frame		= document.querySelector('#kitten'),
	ctx 		= canvas.getContext('2d'),
	img 		= new Image(),
	dataUrl,
	img_h	= frame.naturalHeight,
	img_w	= frame.naturalWidth,
	filtre	= "kitten",
	size	= 0.6,
	setoffX = 0,
	setoffY = 0,
	width	= 500,
	mouse	= 1,
	height	= 0;

canvas.width = width;
canvas.height = height;

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

document.addEventListener("load", updateCanvas());

function updateCanvas()
{
	if (img['src'] == '')
		ctx.drawImage(video, 0, 0, width, height);
	else
		ctx.drawImage(img, 0, 0, width, height);
	dataUrl = canvas.toDataURL();
	if (filtre != 'none')
		ctx.drawImage(document.getElementById(filtre), setoffX, setoffY, img_w * size, img_h * size);
	setTimeout(updateCanvas, 25);
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

canvas.addEventListener('click', function(){
	mouse ^= 1;
});

document.getElementById('kitten').addEventListener('click', get_filtre);
document.getElementById('dog').addEventListener('click', get_filtre);
document.getElementById('billet').addEventListener('click', get_filtre);
document.getElementById('cigare').addEventListener('click', get_filtre);
document.getElementById('piercing').addEventListener('click', get_filtre);
document.getElementById('ours').addEventListener('click', get_filtre);
document.getElementById('nuage').addEventListener('click', get_filtre);

function get_filtre()
{
	size = 0.6;
	filtre = this.id;
	frame = document.querySelector('#' + filtre);0
	img_h = frame.naturalHeight;
	img_w = frame.naturalWidth;
}

take.addEventListener('click', function(){
	let xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		document.getElementById("myImages").innerHTML = this.responseText;
		console.log(this.responseText);
	}
	};
	xhttp.open("POST", "resample.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("size="+size+"&dst_x="+setoffX+"&dst_y="+setoffY+"&filtre="+filtre+".png"+"&photo="+dataUrl);
});

//upload image

var allowedTypes = ['png', 'jpg', 'jpeg', 'gif'],
       fileInput = document.querySelector('#file'),
       prev = document.querySelector('#prev');

var imageLoader = document.getElementById('imageLoader');
imageLoader.addEventListener('change', handleImage, false);

function handleImage(e){
	var files = this.files,
	imgType;
	imgType = files[0].name.split('.');
	imgType = imgType[imgType.length - 1].toLowerCase();

	if (allowedTypes.indexOf(imgType) != -1)
	{
		var reader = new FileReader();
		reader.onload = function(event){
		    img.onload = function(){
		        ctx.drawImage(img,0,0);
		    }
		    img.src = event.target.result;

		}
		reader.readAsDataURL(e.target.files[0]);

	}
	else
		alert("It's not an image");
}
})();