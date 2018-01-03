var STR_EDIT = "Edit comment";
var STR_DELETE = "Delete this comment";
var STR_EDIT_POST = "Edit post";
var STR_DELETE_POST = "Delete this post";
var STR_HIDE_CMT = "Hide comments";
var STR_MY_WEBSITE = location.protocol + '//' + location.hostname + (location.port ? (':' + location.port) : '') + "/project3";

// DEMO:
// console.log("window.location.href = " + window.location.href);
// console.log("window.location = " + window.location);
// console.log("document.URL = " + document.URL);
// console.log("STR_MY_WEBSITE = " + STR_MY_WEBSITE);

// console.log("window.location = " + window.location);
// console.log("window.location.pathname = " + window.location.pathname);
// console.log("window.location.hash = " + window.location.hash);
// console.log("window.location.host = " + window.location.host);
// console.log("window.location.hostname = " + window.location.hostname);
// console.log("window.location.href = " + window.location.href);
// console.log("window.location.port = " + window.location.port);
// console.log("window.location.protocol = " + window.location.protocol);
// console.log("window.location.search = " + window.location.search);

/**
* Tạo mới 1 hàm
* hàm này mã hóa các ký tự HTML. VD: '&' trở thành '&amp;'
**/
String.prototype.escapeHTML = function() {
	var tagsToReplace = {
		'&': '&amp;',
        '<': '&lt;',
        '>': '&gt;'
	};
	return this.replace(/[&<>]/g, function(tag) {
        return tagsToReplace[tag] || tag;
    });
};
var a = "<abc>";
var b = a.escapeHTML(); // "&lt;abc&gt;"
console.log("b = " + b);

function mouseOverEdit(cmtId) {
	var toolTip = document.getElementById("cmt_tooltip_id_" + cmtId);
	toolTip.innerHTML = STR_EDIT;
	toolTip.setAttribute("style", "display: block; color: #000");
}

function mouseOverDelete(cmtId) {
	var toolTip = document.getElementById("cmt_tooltip_id_" + cmtId);
	toolTip.innerHTML = STR_DELETE;
	toolTip.setAttribute("style", "display: block; color: red");
}

function mouseOverEdit_post(postId) {
	var toolTip = document.getElementById("post_tooltip_id_" + postId);
	toolTip.innerHTML = STR_EDIT_POST;
	toolTip.setAttribute("style", "display: block; color: #000");
}

function mouseOverDelete_post(postId) {
	var toolTip = document.getElementById("post_tooltip_id_" + postId);
	toolTip.innerHTML = STR_DELETE_POST;
	toolTip.setAttribute("style", "display: block; color: red");
}

function mouseOutED(cmtId) {
	document.getElementById("cmt_tooltip_id_" + cmtId).style.display = 'none';
}
function mouseOutED_post(postId) {
	document.getElementById("post_tooltip_id_" + postId).style.display = 'none';
}

function cmtBoxChanging() {
	alert("cmtBoxChanging");
}

function cmtBoxKeyUp(element) {

	//alert("cmtBoxKeyUp, " + window.event.keyCode);
	//var cmtBoxValue = document.getElementById()
	var postId = element.getAttribute("postId");
	if(element.value != "") {
		document.getElementById("comment_btn_" + postId + "_id").removeAttribute("disabled");
	} else {
		document.getElementById("comment_btn_" + postId + "_id").setAttribute("disabled", "disabled");
	}

	if(window.event.keyCode == 13 && !window.event.shiftKey) {
		btnCommentEvent_AJAX(document.getElementById("comment_btn_" + postId + "_id"));
	}
}

class Demo {

}
Demo.tag = "";
Demo.isHashTag = false;
Demo.tagSet = new Set();

var isHashTag = false;
var tag = "";

function writePostKeyUp(element) {
	if(element.value != "") {
		document.getElementById("write_post_btn_id").removeAttribute("disabled");
	} else {
		document.getElementById("write_post_btn_id").setAttribute("disabled", "disabled");
	}
}

// Sau khi user post 1 bài thì sẽ hiển thị thông báo trên phần tử có id = info_after_post_id, do đó cần hide nó đi sau 3s
window.onload = function() {
	var element = document.getElementById("info_after_post_id");
	if(element == null) return;
	if(element.innerHTML != "") {
		element.setAttribute("style", "padding: 5px;");
		setTimeout(hideInfoString, 3000);
	}
}

function hideInfoString() {
	$("#info_after_post_id").hide(1000);
}

$(document).ready(function() {

});

function showHideComments(element) {
	var postId = element.getAttribute("postId");
	var divWantToHideShow = document.getElementById("comment_all_comments_" + postId + "_id");
	var aToHideShow = document.getElementById("comment_a_show_hide_" + postId + "_id");
	if(divWantToHideShow.style.display == 'none') {
		divWantToHideShow.style.display = '';
		aToHideShow.innerHTML = "Hide comments";
	} else {
		divWantToHideShow.style.display = 'none';
		aToHideShow.innerHTML = "Show comments";
	}
}

function editComment(cmtId) {
	swal(
		'Oops...',
		'You can\'t edit a comment!',
		'error'
	)
}

function editPost(postId) {
	swal(
		'Oops...',
		'You can\'t edit a post!',
		'error'
	)
}

function deleteComment(cmtId) {
	swal({
		title: "Are you sure to delete?",
		text: "Once deleted, you will not be able to recover this comment!",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	}).then((willDelete) => {
		if (willDelete) {
			// swal("Poof! Your comment has been deleted!", {
			// 	icon: "success",
			// });

			//document.getElementById("comment_each_cmt_id_" + cmtId).style.display = 'none';
			$("#comment_each_cmt_id_" + cmtId).hide(500);

			// delete this comment in DB
			// CHÚ Ý: cách này chỉ mang tính chất minh họa, vì nếu người dùng truy cập vào trang 
			// http://localhost:8080/project3/demos/delete_comment_jsonp?cmtId=12345 thì comment
			// có id=12345 trong DB sẽ bị xóa. Cách an toàn hơn là dùng AJAX với method post
			var sc = document.createElement("script");
			sc.src = STR_MY_WEBSITE + "/demos/delete_comment_jsonp?cmtId=" + cmtId;
			document.body.appendChild(sc);
		} 
		// else {
		// 	swal("Your comment is still standing there! Hehe...");
		// }
	});
}

function deletePost(postId) {
	swal({
		title: "Are you sure to delete?",
		text: "Once deleted, you will not be able to recover this post!",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	}).then((willDelete) => {
		if (willDelete) {
			//delete this post in DB
			// ko nên dùng JSONP như phần delete comment nữa
			if (window.XMLHttpRequest) {
				xmlhttp = new XMLHttpRequest();	// code for modern browsers
			} else {
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");	// code for old IE browsers
			}

			xmlhttp.onreadystatechange = function() {
				if(this.readyState == 4 && this.status == 200) {
					console.log("Bạns vừa xóa 1 bài post! ID của post này là: " + this.responseText);
					hidePost(postId);
				}
			}

			xmlhttp.open("POST", STR_MY_WEBSITE + "/demos/delete_post");
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.send("postId=" + postId);
		}
	});
}

function showLoadingIcon(postId) {
	// show loading icon
	var divLoading = document.getElementById("loading_icon_id_" + postId);
	var newDiv = document.createElement("div");
	newDiv.setAttribute("id", "icon_id_" + postId);
	newDiv.setAttribute("class", "lds-rolling-20 loading_icon");
	newDiv.innerHTML = "<div></div>";
	divLoading.appendChild(newDiv);
}

function sleep(ms) {
	return new Promise(resolve => setTimeout(resolve, ms));
}

async function hideLoadingIcon(postId) {
	await sleep(100);
	var parent = document.getElementById("loading_icon_id_" + postId);
	var child = document.getElementById("icon_id_" + postId);
	parent.removeChild(child); 
}

async function hidePost(postId) {
	$("#post_wrapper_id_" + postId).hide(500);
	await sleep(600);
	swal("Nice man! That post has been deleted!", {
		icon: "success",
	});
}

/**
* Chèn comment vào trang web của người dùng
* @param postId : id của post cần chèn comment
* @param cmtObj : các thông tin liên quan đến comment
* @param cmtId : id của comment, để giúp cho việc xóa và edit comment này
* 	nếu cmtId = -1 nghĩa là comment này là của người khác, do đó sẽ ko hiển 
* 	thị phần edit và delete comment
**/
function insertComment(cmtObj, cmtId) {	//cmtObj là object chứa info comment, có dạng JSON
	console.log("[function insertComment] cmtId = " + cmtId);

	var postId = cmtObj.postId;
	var innerToolTip = "";
	if(cmtId > 0) innerToolTip = "cmt_tooltip_id_" + cmtId;

	var innerCommentorTag = cmtObj.commentor;
	if(cmtId > 0) {
		innerCommentorTag += '<span class="cmt_dropdown">';
			innerCommentorTag += '<div class="cmt_drop_btn">...</div>'
							
				innerCommentorTag += '<div class="cmt_dropdown_content">';
					innerCommentorTag += '<span class="a_tag" onclick="editComment(this)" cmtId="' + cmtId + '" ';
						innerCommentorTag += 'onmouseover="mouseOverEdit(' + cmtId + ')" ';
						innerCommentorTag += 'onmouseout="mouseOutED(' + cmtId + ')">Edit</span>'
			
					innerCommentorTag += '<span class="a_tag" onclick="deleteComment(' + cmtId + ')" cmtId="' + cmtId + '" ';
						innerCommentorTag += 'onmouseover="mouseOverDelete(' + cmtId + ')" ';
						innerCommentorTag += 'onmouseout="mouseOutED(' + cmtId + ')">Delete</span>';
				innerCommentorTag += '</div></span>';
		innerCommentorTag += '<div style="clear: both;"></div>';
	}

	var wrapper = document.getElementById("comment_all_comments_" + postId + "_id");

	// bây giờ tạo thẻ div chứa comment và append nó vào wrapper trên
	var divComment = document.createElement("div");
	divComment.setAttribute("class", "comment_each_comment anim_new_comment");
	divComment.setAttribute("id", "comment_each_cmt_id_" + cmtId);

	var divToolTip = document.createElement("div");
	var divCommentor = document.createElement("div");
	var divTime = document.createElement("div");
	var divContent = document.createElement("div");

	divToolTip.setAttribute("class", "cmt_tooltip");
	divToolTip.setAttribute("id", "cmt_tooltip_id_" + cmtId);
	divCommentor.setAttribute("class", "comment_commentor");
	divTime.setAttribute("class", "comment_time");
	divContent.setAttribute("class", "comment_content");

	divToolTip.innerHTML = innerToolTip;
	divCommentor.innerHTML = innerCommentorTag;
	divTime.innerHTML = cmtObj.time;
	divContent.innerHTML = cmtObj.content;

	divComment.appendChild(divToolTip);
	divComment.appendChild(divCommentor);
	divComment.appendChild(divTime);
	divComment.appendChild(divContent);

	wrapper.appendChild(divComment);

	//show comments (if comments are still being hidden)
	document.getElementById("comment_all_comments_" + postId + "_id").style.display = '';
	var divShowHide = document.getElementById("comment_div_show_hide_" + postId + "_id");
	if(divShowHide.style.display == 'none') divShowHide.style.display = '';
	divShowHide.innerHTML = "<span class='cmt_span_show_hide' onclick=\"showHideComments(this)\"" +
			"id=\"comment_a_show_hide_" + postId + "_id\" postId='" + postId + "'>" + STR_HIDE_CMT + "</span>";
}