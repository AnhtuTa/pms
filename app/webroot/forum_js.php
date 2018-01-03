<script type="text/javascript">
	//=============== socket ============================//
	// var socket = io("http://localhost:8000/");
	var socket = io("https://project3nodejs.herokuapp.com");
	socket.emit("logined_user", "<?php echo $_SESSION['userId'] ?>");
	socket.on("message", function(data) {
	    console.log("data from server: " + data);
	});

	socket.on("someone_comments", function(data) {
		console.log(data);
		insertComment(data, -1);
	});

	socket.on("someone_is_typing", function(postId) {
		console.log("There are someone is typing in postId = " + postId);
		//document.getElementById("someone_typing_id_" + postId).style.display = '';
		$("#someone_typing_id_" + postId).show(500);
	});

	socket.on("noone_is_typing", function(postId) {
		console.log("There's no body is typing in postId = " + postId);
		//document.getElementById("someone_typing_id_" + postId).style.display = 'none';
		$("#someone_typing_id_" + postId).hide(500);
	});

	
	//=============== end of socket ============================//
	function btnCommentEvent_AJAX(element) {
		var postId = element.getAttribute("postId");
		showLoadingIcon(postId);

		// trim and escape HTML tags as HTML entities and replace all line breaks in a string with <br /> tags?
		var content = document.getElementById("comment_box_" + postId + "_id").value.trim();
		content = content.escapeHTML();
		console.log("[1] content = " + content);
		content = content.replace(/(?:\r\n|\r|\n)/g, '<br />');
		console.log("[2] content = " + content);

		document.getElementById("comment_box_" + postId + "_id").value = "";	//delete comment box
		document.getElementById("comment_box_" + postId + "_id").blur();	//remove focus
		document.getElementById("comment_btn_" + postId + "_id").setAttribute("disabled", "disabled");	//disable button comment

		sendCommentToServer(postId, content);
		hideLoadingIcon(postId);
		sendCommentToNodeJS(postId, content);
		cmtBoxOnFocusOut(element);
	}

	function sendCommentToServer(postId, content) {
		contentSendToServer = content.replace(/'/g, '\\\'');	// replace all ' to \'
		console.log("contentSendToServer = " + contentSendToServer);

		if (window.XMLHttpRequest) {
			xmlhttp = new XMLHttpRequest();	// code for modern browsers
		} else {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");	// code for old IE browsers
		}

		xmlhttp.onreadystatechange = function() {
			if(this.readyState == 4 && this.status == 200) {
				console.log("Bạns vừa comment! ID của comment này là: " + this.responseText);
				displayComment(postId, content, this.responseText);
			}
		}

		xmlhttp.open("POST", "<?php echo $MY_WEBSITE ?>/comments/add_comment_jsonp");
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send("postId=" + postId + "&content=" + contentSendToServer);
	}

	function displayComment(postId, content, cmtId) {
		console.log("[function displayComment] cmtId = " + cmtId);
		var json_str = {
			"postId": postId,
			"commentor": "<?php echo $_SESSION['userName'] ?>",
			"time": "<?php echo myFormatDate(strtotime(date('Y-m-d H:i:s'))) ?>",
			"content": content
		}

		// display comment ở giao diện người dùng
		insertComment(json_str, cmtId);
	}

	/**
	* Hàm này gửi nội dung comment tới NodeJS, để nó thông báo tới các user khác biết
	* rằng thằng này vừa comment, để các browser của các user khác hiển thị comment đó
	* format của data gửi đi giống hệt json_str trong hàm displayComment
	**/
	function sendCommentToNodeJS(postId, content) {
		socket.emit("client_comments", {
			postId: postId,
			commentor: "<?php echo $_SESSION['userName'] ?>",
			"time": "<?php echo myFormatDate(strtotime(date('Y-m-d H:i:s'))) ?>",
			content: content
		});
	}

	function cmtBoxOnFocus(element) {
		//console.log(element.value);
		var postId = element.getAttribute("postId");
		socket.emit("client_typing", postId);
	}

	function cmtBoxOnFocusOut(element) {
		var postId = element.getAttribute("postId");
		socket.emit("client_stop_typing", postId);
	}
</script>
