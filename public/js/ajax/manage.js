let form1 = document.querySelector('#form1');
let form2 = document.querySelector('#form2');
let form3 = document.querySelector('#form3');
let form4 = document.querySelector('#form4');
let error = document.querySelectorAll('.error');
let success = document.querySelectorAll('.success');

form1.addEventListener('submit', function (e){
	
	e.preventDefault();

	let data = new FormData(form1);
	let xhr = getXMLHttpRequest();
	
	xhr.onreadystatechange = function () 
	{
		if (this.readyState == 4 && (this.status == 200))
		{
			let postback = this.responseText;
			
			if (postback == "Pseudo modifié !")
			{
				error[0].innerHTML = "";
				success[0].innerHTML = postback;
				let login = form1[1].value;
				form1.reset();
				document.getElementById("login").value = login;
			}
			else
			{
				success[0].innerHTML = "";
				error[0].innerHTML = postback;
			}
		}
	};

	xhr.open('POST', form1.getAttribute('action'), true);
	xhr.setRequestHeader('X-Requested-With', 'xmlhttprequest');
	xhr.send(data);
});

/*---*/

form2.addEventListener('submit', function (e){
	
	e.preventDefault();

	let data = new FormData(form2);
	let xhr = getXMLHttpRequest();
	
	xhr.onreadystatechange = function () 
	{
		if (this.readyState == 4 && (this.status == 200))
		{
			let postback = this.responseText;
			
			if (postback == "E-mail modifié !")
			{
				error[1].innerHTML = "";
				success[1].innerHTML = postback;
				let mail = form2[1].value;
				form2.reset();
				document.getElementById("mail").value = mail;
			}
			else
			{
				success[1].innerHTML = "";
				error[1].innerHTML = postback;
			}
		}
	};

	xhr.open('POST', form2.getAttribute('action'), true);
	xhr.setRequestHeader('X-Requested-With', 'xmlhttprequest');
	xhr.send(data);
});

/*---*/

form3.addEventListener('submit', function (e){
	
	e.preventDefault();

	let data = new FormData(form3);
	let xhr = getXMLHttpRequest();
	
	xhr.onreadystatechange = function () 
	{
		if (this.readyState == 4 && (this.status == 200))
		{
			let postback = this.responseText;
			
			if (postback == "Mot de passe modifié !")
			{
				error[2].innerHTML = "";
				success[2].innerHTML = postback;
				form3.reset();
			}
			else
			{
				success[2].innerHTML = "";
				error[2].innerHTML = postback;
			}
		}
	};

	xhr.open('POST', form3.getAttribute('action'), true);
	xhr.setRequestHeader('X-Requested-With', 'xmlhttprequest');
	xhr.send(data);
});

/*---*/

function change(form4)
{
	let data = new FormData(form4);
	let xhr = getXMLHttpRequest();
	
	xhr.open('POST', form4.getAttribute('action'), true);
	xhr.setRequestHeader('X-Requested-With', 'xmlhttprequest');
	xhr.send(data);
}