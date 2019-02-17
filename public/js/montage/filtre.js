function get_filtre()
{
	size[size.length - 1] = 0.6;
	idfiltre[idfiltre.length - 1] = this.id;
	frame = document.getElementById(idfiltre[idfiltre.length - 1]);
	img_h[img_h.length - 1] = frame.naturalHeight;
	img_w[img_w.length - 1] = frame.naturalWidth;
}

let	addfiltre	= document.querySelector('#addfiltre');
let	nofiltre	= document.querySelector('#nofiltre');	
let	allfiltre	= document.getElementsByClassName("filtre");

addfiltre.addEventListener('click', function()
{
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

nofiltre.addEventListener('click', function()
{
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

for (let i = 0; i < allfiltre.length; i++) 
{
    allfiltre[i].addEventListener('click', get_filtre, false);
}