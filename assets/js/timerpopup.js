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


function getTimeRemaining(endtime) {
	const total = Date.parse(endtime) - Date.parse(new Date());
	const seconds = Math.floor((total / 1000) % 60);
	const minutes = Math.floor((total / 1000 / 60) % 60);
	const hours = Math.floor((total / (1000 * 60 * 60)) % 24);
	const days = Math.floor(total / (1000 * 60 * 60 * 24));

	return {
		total,
		days,
		hours,
		minutes,
		seconds
	};
}

function initializeClock(id, endtime) {
	const clock = document.getElementById(id);
	const daysSpan = clock.querySelector('.days');
	const hoursSpan = clock.querySelector('.hours');
	const minutesSpan = clock.querySelector('.minutes');
	const secondsSpan = clock.querySelector('.seconds');

	function updateClock() {
		const t = getTimeRemaining(endtime);

		daysSpan.innerHTML = ('0' + t.days).slice(-2);
		hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
		minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
		secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

		if (t.total <= 0) {
			clearInterval(timeinterval);
		}
	}

	updateClock();
	const timeinterval = setInterval(updateClock, 1000);
}

const deadline = 'December 3 2020 23:59:59 GMT+0530';

initializeClock('clockdiv', deadline);
