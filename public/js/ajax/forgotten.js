let form = document.querySelector('#form');
let error = document.querySelector('#error');
let success = document.querySelector('#success');

form.addEventListener('submit', function (e){
	
	e.preventDefault();

	let data = new FormData(form);
	let xhr = getXMLHttpRequest();
	
	xhr.onreadystatechange = function () 
	{
		
		if (this.readyState == 4 && (this.status == 200))
		{
			let postback = this.responseText;
			
			if (postback == "OK")
			{
				error.innerHTML = "";
				success.innerHTML = "Un mail de réinitialisation de mot de passe vient de vous être envoyé !"
				form.reset();
			}
			else
				error.innerHTML = postback;
		}
	};

	xhr.open('POST', form.getAttribute('action'), true);
	xhr.setRequestHeader('X-Requested-With', 'xmlhttprequest');
	xhr.send(data);
});
