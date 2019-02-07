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

/* Comment*/
	function comment(form, list, cptr)
	{
		let data = new FormData(form);
		let xhr = getXMLHttpRequest();
		let textarea = document.getElementsByTagName("textarea");

		xhr.onreadystatechange = function () 
		{
			if (this.readyState == 4 && (this.status == 200))
			{
				if (0)
				{
					document.querySelector("#error").innerHTML = "Error";
				}	
				else
				{
					let postback = this.responseText;
					list.insertAdjacentHTML('afterbegin', postback);
					cptr.innerHTML = (parseInt(cptr.innerHTML, 10) + 1);
					for (i = 0; i < textarea.length; i ++)
					{
						textarea[i].value = "";
					}
				}
			}
		};
		xhr.open('POST', form.getAttribute('action'), true);
		xhr.setRequestHeader('X-Requested-With', 'xmlhttprequest');
		xhr.send(data);
	}