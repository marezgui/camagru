let textarea = document.getElementsByTagName("textarea");

function comment(form, list, cptr)
{
	let data = new FormData(form);
	let xhr = getXMLHttpRequest();

	xhr.onreadystatechange = function () 
	{
		if (this.readyState == 4 && (this.status == 200))
		{
			let postback = this.responseText;
			list.insertAdjacentHTML('afterbegin', postback);
			cptr.innerHTML = (parseInt(cptr.innerHTML, 10) + 1);
			for (i = 0; i < textarea.length; i ++)
			{
				textarea[i].value = "";
			}	
		}
	};
	xhr.open('POST', form.getAttribute('action'), true);
	xhr.setRequestHeader('X-Requested-With', 'xmlhttprequest');
	xhr.send(data);
}