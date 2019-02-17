function handleImage(e)
{
	let files = this.files;
	let imgType = files[0].name.split('.');

	imgType = imgType[imgType.length - 1].toLowerCase();

	if (allowedTypes.indexOf(imgType) != -1)
	{
		let reader = new FileReader();
		reader.onload = function(event)
		{
		    img.onload = function()
		    {
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

let allowedTypes 	= ['png', 'jpg', 'jpeg', 'gif'];
let imageLoader 	= document.getElementById('imageLoader');

imageLoader.addEventListener('change', handleImage, false);