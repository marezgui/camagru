function delete_image()
{
	let xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() 
	{
		if (this.readyState == 4 && this.status == 200) 
		{
			document.getElementById("myImages").innerHTML = this.responseText;
			for (var i = 0; i < btn.length; i++) 
			{
			    btn[i].addEventListener('click', delete_image, false);
			}
		}
	};
	xhttp.open("POST", "/camagru/controllers/delete.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("id_image="+this.id);
}

let	btn	= document.getElementsByClassName("btn");

for (var i = 0; i < btn.length; i++) 
{
    btn[i].addEventListener('click', delete_image, false);
}

let	take = document.querySelector('#take');

take.addEventListener('click', function()
{
	if (dataUrl != "data:,")
	{
		let xhttp;
		xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() 
		{
			if (this.readyState == 4 && this.status == 200) 
			{
				document.getElementById("myImages").innerHTML = this.responseText;
				for (var i = 0; i < btn.length; i++) 
				{
				    btn[i].addEventListener('click', delete_image, false);
				}
			}
		};
		xhttp.open("POST", "/camagru/controllers/resample.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("size="+size+"&dst_x="+setoffX+"&dst_y="+setoffY+"&filtre="+idfiltre+"&photo="+dataUrl);
	}
});

const form = document.querySelector('#form');

form.addEventListener('submit', e => {
    e.preventDefault();

    const files = document.querySelector('#add_filtre').files;
    const formData = new FormData();

    for (let i = 0; i < files.length; i++) 
    {
        let file = files[i];
        formData.append('files[]', file);
    }

    let xhttp;
    xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function() 
    {
	    if (this.readyState == 4 && this.status == 200) 
	    {
	    	document.getElementById("listfiltre").innerHTML = this.responseText;
	    	for (var i = 0; i < allfiltre.length; i++) 
	    	{
	    	    allfiltre[i].addEventListener('click', get_filtre, false);
	    	}
	    }
    };
    xhttp.open("POST", "/camagru/controllers/process.php", true);
    xhttp.send(formData);
});