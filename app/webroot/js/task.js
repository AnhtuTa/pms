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

/**
* sort table khi click chuột vào table header
* @param tableId : id của table cần sort
* @param n : số thứ tự của cột của table cần sort (chỉ số của các cột của table bắt đầu từ 0).
* @param userId : id của user (trường hợp show all task thì mỗi 1 student sẽ có 1 table riêng)
**/
function sortTable(tableId, n, userId) {
	var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
	table = document.getElementById(tableId);
	switching = true;

	// Set the sorting direction to ascending:
	dir = "asc"; 
	
	/* Make a loop that will continue until
	no switching has been done: */
	while (switching) {
		// Start by saying: no switching is done:
		switching = false;
		rows = table.getElementsByTagName("TR");
		
		/* Loop through all table rows (except the
		first, which contains table headers): */
		for (i = 1; i < (rows.length - 1); i++) {
			// Start by saying there should be no switching:
			shouldSwitch = false;
			
			/* Get the two elements you want to compare,
			one from current row and one from the next: */
			x = rows[i].getElementsByTagName("TD")[n];
			y = rows[i + 1].getElementsByTagName("TD")[n];

			/* Check if the two rows should switch place,
			based on the direction, asc or desc: (Kiểm tra xem có 3 row nào
				cần sắp xếp lại kotheo thứ tự asc hoặc desc. Nếu tìm đc 2 row
				cần sắp xếp lại thì break luôn để sắp xếp bọn nó) */
			if (dir == "asc") {
				console.log("dir = asc");
				//Nếu thuộc tính compare_att của từng tag ko phải kiểu số hoặc tag đó ko có thuộc tính này thì ta sắp xếp theo thứ tự từ điển
				if (x.getAttribute('compare_att') == undefined && x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
					shouldSwitch= true;
					break;
				}
				//Nếu thuộc tính compare_att của từng tag là 1 số nguyên thì ta sắp xếp dựa trên việc so sánh số
				if (parseInt(x.getAttribute('compare_att')) > parseInt(y.getAttribute('compare_att'))) {
					shouldSwitch= true;
					break;
				}
			} else if (dir == "desc") {
				console.log("dir = desc");
				if (x.getAttribute('compare_att') == undefined && x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
					shouldSwitch= true;
					break;
				}
				if (parseInt(x.getAttribute('compare_att')) < parseInt(y.getAttribute('compare_att'))) {
					// If so, mark as a switch and break the loop:
					shouldSwitch= true;
					break;
				}
			}
		}
		if (shouldSwitch) {
			/* If a switch has been marked, make the switch
			and mark that a switch has been done: */
			(rows[i].parentNode).insertBefore(rows[i + 1], rows[i]);	// hoán vị row[i] và row[i+1] (ta chèn row[i+1] trước row[i])
			switching = true;
			// Each time a switch is done, increase this count by 1:
			switchcount ++; 
		} else {
			/* If no switching has been done AND the direction is "asc",
			set the direction to "desc" and run the while loop again. */
			if (switchcount == 0 && dir == "asc") {
				dir = "desc";
				switching = true;
			}
		}
	}

	console.log("[157] dir = " + dir);
	if(dir == "asc") {
		for (var i = 0; i < 6; i++) {	// Vì có 6 cột
			var x = document.getElementById("asc_" + i + userId);
			var y = document.getElementById("desc_" + i + userId);

			if(i == n) x.style.display = 'inline';
			if(i != n && x != undefined) x.style.display = 'none';
			if(y != undefined) y.style.display = 'none';
		};
	} else if(dir == 'desc') {
		for (var i = 0; i < 6; i++) {	// Vì có 6 cột
			var x = document.getElementById("asc_" + i + userId);
			var y = document.getElementById("desc_" + i + userId);

			if(i == n) y.style.display = 'inline';
			if(x != undefined) x.style.display = 'none';
			if(i != n && y != undefined) y.style.display = 'none';
		};
	}
}