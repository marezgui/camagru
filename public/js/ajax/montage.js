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