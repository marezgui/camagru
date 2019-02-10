(function() {

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
	width	= window.innerWidth * 0.25,
	mouse	= 1,
	height	= window.innerHeight * 0.6;


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
	camera = 1;
	},
	function(err) {
		height = window.innerHeight * 0.6;
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
	height = window.innerHeight * 0.6;
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



take.addEventListener('click', function(){
	if (dataUrl != "data:,")
	{
		let xhttp;
		xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("myImages").innerHTML = this.responseText;
			for (var i = 0; i < btn.length; i++) {
			    btn[i].addEventListener('click', delete_image, false);
			}
		}
		};
		xhttp.open("POST", "/camagru/controllers/resample.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("size="+size+"&dst_x="+setoffX+"&dst_y="+setoffY+"&filtre="+idfiltre+"&photo="+dataUrl);
	}
});


//delete image

for (var i = 0; i < btn.length; i++) {
    btn[i].addEventListener('click', delete_image, false);
}

function delete_image(){
	let xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		document.getElementById("myImages").innerHTML = this.responseText;
		for (var i = 0; i < btn.length; i++) {
		    btn[i].addEventListener('click', delete_image, false);
		}
	}
	};
	xhttp.open("POST", "/camagru/controllers/delete.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("id_image="+this.id);
};

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
		        ctx.drawImage(img,0, 0, width, height);
		    }
		    img.src = event.target.result;	

		}
		reader.readAsDataURL(e.target.files[0]);
		canvas.setAttribute('width', width);
		canvas.setAttribute('height', height);
	}
	else
		alert("It's not an image");
}

//Download filtre
const form = document.querySelector('#form');

form.addEventListener('submit', e => {
    e.preventDefault();

    const files = document.querySelector('#add_filtre').files;
    const formData = new FormData();

    for (let i = 0; i < files.length; i++) {
        let file = files[i];
        formData.append('files[]', file);
    }
    let xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    	document.getElementById("listfiltre").innerHTML = this.responseText;
    	for (var i = 0; i < allfiltre.length; i++) {
    	    allfiltre[i].addEventListener('click', get_filtre, false);
    	}
    }
    };
    xhttp.open("POST", "/camagru/controllers/process.php", true);
    xhttp.send(formData);
});
})();