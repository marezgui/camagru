/* Comment*/
	function comment(form, list, cptr, errorField)
	{
		let data = new FormData(form);
		let xhr = getXMLHttpRequest();
		let textarea = document.getElementsByTagName("textarea");

		xhr.onreadystatechange = function () 
		{
			if (this.readyState == 4 && (this.status == 200))
			{
				if (this.responseText == "0")
				{
					errorField.innerHTML = "Le champs commentaire doit être remplis.";
				}
				else if (this.responseText == "500")
				{
					errorField.innerHTML = "Votre commentaire ne doit pas dépasser 500 caractères !";
				}	
				else
				{
					errorField.innerHTML = "";
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