//Close button on modal
document.getElementById('close').addEventListener('click', function(){
	document.getElementById('modal').style.display = 'none';
});

//Auto show and hide modal
$(document).ready(function(){

	function showPopup(){
		document.getElementById('modal').style.display = 'flex';
		setTimeout(hidePopup, 6000)

	}

	function hidePopup(){
		document.getElementById('modal').style.display = 'none';

	}

	setTimeout(showPopup, 1000);

})