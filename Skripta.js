function showTime() {
	document.getElementById('currentTime').innerHTML = Date('hr-HR', { month: 'long' });
}
showTime();
setInterval(function () {
	showTime();
}, 1000);


