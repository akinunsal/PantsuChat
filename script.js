window.onload = function () {
	document.onclick = update_status;
	document.onkeypress = update_status;
}

function update_status () {
	// ajax start
	var xhr;
	if (window.XMLHttpRequest) xhr = new XMLHttpRequest(); // all browsers
	else xhr = new ActiveXObject("Microsoft.XMLHTTP");     // for IE

	xhr.open('GET', 'update-status.php', false);
	xhr.send();
	// ajax stop
}