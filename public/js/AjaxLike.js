/* LIKE */
	function like(form, result)
	{
		let data = new FormData(form);
		let xhr = getXMLHttpRequest();
		
		xhr.onreadystatechange = function () 
		{
			if (this.readyState == 4 && (this.status == 200))
			{
				let postback = this.responseText;

				result.innerHTML = postback;
			}
		};
		xhr.open('POST', form.getAttribute('action'), true);
		xhr.setRequestHeader('X-Requested-With', 'xmlhttprequest');
		xhr.send(data);
	}