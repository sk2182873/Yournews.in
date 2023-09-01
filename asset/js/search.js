function search(){

	let search = document.getElementById('find').value.toLowerCase();

	let article = document.querySelectorAll('.article');

	let title = document.getElementsByClassName('title');

	

	for(var i=0; i<=title.length; i++){
		
		let a = article[i].getElementsByClassName('title')[0];

		let string = a.innerHTML || a.innerText || a.textContent;

		//console.log(article[i]);

		if(string.toLowerCase().indexOf(search) > -1){
			article[i].style.display = "";
		}else{
			article[i].style.display = "none";
		}
	}

	//console.log(title.length);
}

