function showHideTable(element) {
	var userId = element.getAttribute("userId");
	var userTable = document.getElementById("task_table_" + userId);

	if(userTable.style.display == 'none') {
		userTable.style.display = '';
	} else  {
		userTable.style.display = 'none';
	}
}

function showFinishedTasks(element) {
	alert("function showFinishedTasks");
	var userId = element.getAttribute("userId");	// DÙNG NHƯ SAU KO ĐC: var userId = element.userId;
	var finishedTable = document.getElementById("task_finished_table_" + userId);

	if(finishedTable != null) {
		// Nếu bảng này đã có rồi thì chỉ cần show/hide nó đi
		if(finishedTable.style.display == 'none') {
			finishedTable.style.display = '';
			element.innerHTML = "Hide finished task";
		} else {
			finishedTable.style.display = 'none';
			element.innerHTML = "Show finished task";
		}
		
	} else {
		// Nếu bảng này chưa có thì chỉ lấy data từ server = AJAX, sau đó show cho người dùng
		document.getElementById("loading_icon_" + userId).style.display = '';
		var tb = document.createElement("table");
		tb.setAttribute("class", "task_finished_table");
		tb.setAttribute("id", "task_finished_table_" + userId);

		userTable = document.getElementById("task_table_" + userId);
		userTable.appendChild(tb);

		// using AJAX...
		if (window.XMLHttpRequest) {
			xmlhttp = new XMLHttpRequest();	// code for modern browsers
		} else {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");	// code for old IE browsers
		}

		xmlhttp.onreadystatechange = function() {
			if(this.readyState == 4 && this.status == 200) {
				insertFinishedTasks(userId, this.responseText);
			}
			turnOffLoadingIcon(userId, element);
		}

		xmlhttp.open("GET", "../demos/show_finished_tasks?userId=" + userId, true);
		xmlhttp.send();
	}
}

function insertFinishedTasks(userId, responseText) {
	var finishedTable = document.getElementById("task_finished_table_" + userId);
	var json = JSON.parse(responseText);
	var len = json.length;
	if(len == 0) {
		var newDiv = document.createElement("div");
		newDiv.setAttribute("class", "no_finished_task");
		newDiv.appendChild(document.createTextNode("This student has no finished task!!!"));
		finishedTable.appendChild(newDiv);

	} else {
		for(var i = 0; i < len; i++) {
			var tr = document.createElement("tr");
			tr.innerHTML = json[i];
			finishedTable.appendChild(tr);
		}
	}
}

function sleep(ms) {
	return new Promise(resolve => setTimeout(resolve, ms));
}

async function turnOffLoadingIcon(userId, element) {
	await sleep(500);
	document.getElementById("loading_icon_" + userId).style.display = 'none';
	element.innerHTML = "Hide finished task";
}