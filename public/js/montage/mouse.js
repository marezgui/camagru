let	mouse	= 1;

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

document.addEventListener('keydown', (event) => 
{
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

canvas.addEventListener('click', function()
{
	mouse ^= 1;
});