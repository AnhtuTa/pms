<?php
	function showPost($item, $commentOfThisPost) {
		$STR_SHOW_CMT = "Show comments";
		$STR_HIDE_CMT = "Hide comments";
		$STR_SO_TYPING = "Someone is typing...";
		$MY_WEBSITE = "http://$_SERVER[HTTP_HOST]"."/project3";

		$post_id = $item['p']['id'];
		$post_posterId = $item['u']['id'];
		$post_poster = $item['u']['name'];
		$post_content = $item['p']['content'];
		$post_time = $item['p']['time'];
		$post_hashtag = $item['p']['hashtag'];
		$post_num_of_cmt = $item['p']['num_of_comments'];

		$tagArr = explode(",", $post_hashtag);
		if(count($tagArr) > 1) {
			for ($i=0; $i < count($tagArr) - 1; $i++) { 
				$post_content = str_replace("#".$tagArr[$i], "<a class='a_hashtag' target='_blank' href='".$MY_WEBSITE."/posts/tagged/".$tagArr[$i]."'><span class='span_hashtag'>"."#".$tagArr[$i]."</span></a>", $post_content);
			}
		}

		$cmt_box = "comment_box_".$post_id;		//VD: format: txt_comment_12 nghĩa là người dùng đang đăng nhập comment ở post có id = 12
		$cmt_btn = "comment_btn_".$post_id;
		$cmt_div_show_hide_cmt_id = "comment_div_show_hide_".$post_id."_id";
		$cmt_a_show_hide_cmt_id = "comment_a_show_hide_".$post_id."_id";
		$cmt_div_all_cmt_id = "comment_all_comments_".$post_id."_id";
		$post_tooltip_id = "post_tooltip_id_".$post_id;
		?>
	<div class="post_wrapper" id="<?php echo "post_wrapper_id_".$post_id ?>">
		<div class="post_body">
			<div class="post_poster">
				<div class="post_tooltip" id="<?php echo $post_tooltip_id ?>"></div>
				<span <?php if($post_posterId == $_SESSION['userId'] && $_SESSION['userId'] == 'admin') echo "style='color: #f4427a;'"; ?> ><?php echo $post_poster; ?></span>

				<?php if ($post_posterId == $_SESSION['userId'] || $_SESSION['userId'] == 'admin') { ?>
						
				<span class="post_dropdown">
					<div class="post_drop_btn" style="<?php 
								//echo ($post_posterId != 'admin' && $_SESSION['userId'] == 'admin') ? "color: #1a5fce" : '') 
								if($_SESSION['userId'] == 'admin') {
									if($post_posterId == 'admin') echo "color: #f4427a";
									else echo "color: #1a5fce";
								} else echo "color: #1a5fce";
							?>"
					>...</div>
					
					<div class="post_dropdown_content">
						<?php if($post_posterId == $_SESSION['userId']) { ?>
						<span class="a_tag" onclick="editPost(this)" postId="<?php echo $post_id ?>" 
							onmouseover="mouseOverEdit_post(<?php echo $post_id ?>)" 
							onmouseout="mouseOutED_post(<?php echo $post_id ?>)">Edit</span>
						<?php } ?>
						<span class="a_tag" onclick="deletePost(<?php echo $post_id ?>)" postId="<?php echo $post_id ?>" 
							onmouseover="mouseOverDelete_post(<?php echo $post_id ?>)" 
							onmouseout="mouseOutED_post(<?php echo $post_id ?>)">Delete</span>
					</div>
				</span>
				<div style="clear: both;"></div>

				<?php } ?>
			</div>
			<div class="post_time">
				<a href="<?php echo $MY_WEBSITE."/posts/permalink?postId=".$post_id ?>"><?php echo myFormatDate(strtotime($post_time)); ?></a>
			</div>
			<div class="post_content"><?php echo $post_content; ?></div>

			<?php //if(count($tagArr) > 1) { ?>
			<!-- <div class="post_tags"> -->
				<?php
				// for ($i=0; $i < count($tagArr) - 1; $i++) { 
				// 	echo "<a href='".$MY_WEBSITE."/posts/tagged/".$tagArr[$i]."'><span class='span_hashtag'>".$tagArr[$i]."</span></a> ";
				// }
				?>
			<!-- </div> -->
			<?php //} ?>
		</div>
		<div class="comment_body">
			<div class="comment_num_of_cmt"><?php echo $post_num_of_cmt > 0 ? $post_num_of_cmt." comments" : "" ; ?></div>
			<div class="comment_show_hide_comments" id="<?php echo $cmt_div_show_hide_cmt_id ?>" style="">
				<span class="cmt_span_show_hide" onclick="showHideComments(this)"
					id="<?php echo $cmt_a_show_hide_cmt_id ?>" postId="<?php echo $post_id ?>">
						<?php echo $STR_SHOW_CMT ?>
				</span>
			</div>
			
			<div class="comment_all_comments" id="<?php echo $cmt_div_all_cmt_id ?>" style="display: none;">
				<?php
					if(count($commentOfThisPost) == 0) {
						echo 
							'<script type="text/javascript">
								document.getElementById("'.$cmt_div_show_hide_cmt_id.'").style.display = "none";
							</script>';
					}
					foreach ($commentOfThisPost as $comment) {
						$cmt_id = $comment['c']['id'];
						$comment_content = $comment['c']['content'];
						$comment_time = $comment['c']['time'];
						$comment_commentorId = $comment['u']['id'];
						$comment_commentor =  $comment['u']['name'];
						$cmt_each_cmt_id = "comment_each_cmt_id_".$cmt_id;
						$cmt_tooltip_id = "cmt_tooltip_id_".$cmt_id;
					?>
				<div class="comment_each_comment" id="<?php echo $cmt_each_cmt_id ?>">
					<div class="cmt_tooltip" id="<?php echo $cmt_tooltip_id ?>"></div>
					
					<div class="comment_commentor">
						<?php echo $comment_commentor; ?>
						
						<?php if ($comment_commentorId == $_SESSION['userId']) { ?>
						
						<span class="cmt_dropdown">
							<div class="cmt_drop_btn">...</div>
							
							<div class="cmt_dropdown_content">
								<span class="a_tag" onclick="editComment(this)" cmtId="<?php echo $cmt_id ?>" 
									onmouseover="mouseOverEdit(<?php echo $cmt_id ?>)" 
									onmouseout="mouseOutED(<?php echo $cmt_id ?>)">Edit</span>
								
								<span class="a_tag" onclick="deleteComment(<?php echo $cmt_id ?>)" cmtId="<?php echo $cmt_id ?>" 
									onmouseover="mouseOverDelete(<?php echo $cmt_id ?>)" 
									onmouseout="mouseOutED(<?php echo $cmt_id ?>)">Delete</span>
							</div>
						</span>
						<div style="clear: both;"></div>

						<?php } ?>
					</div>
					<div class="comment_time"><?php echo myFormatDate(strtotime($comment_time)); ?></div>
					<div class="comment_content"><?php echo $comment_content; ?></div>
				</div>
					<?php
					}
				?>
			</div>

			<div id="<?php echo "loading_icon_id_".$post_id ?>"></div>	<!-- insert loading icon here when we need! -->

			<div class="comment_write_comment">
				<div class="someone_typing" id="<?php echo "someone_typing_id_".$post_id ?>" style="display: none">
					<img class="img_so_typing" src="<?php echo $MY_WEBSITE."/img/typing.svg" ?>" width='50' style="border-radius: 18px;"> <span class="txt_so_typing"><?php echo $STR_SO_TYPING ?></span>
				</div>
				<div class="write_cmt_wrapper">
					<textarea class="comment_box" onkeyup="cmtBoxKeyUp(this)" postId="<?php echo $post_id ?>" onfocus="cmtBoxOnFocus(this)" onfocusout="cmtBoxOnFocusOut(this)"
						name="<?php echo $cmt_box; ?>" id="<?php echo $cmt_box."_id"; ?>" placeholder="write a comment..."></textarea>
					<input class="normal_btn btn_save comment_btn" type="submit" name="<?php echo $cmt_btn; ?>"value="Comment"
						disabled="disabled" id="<?php echo $cmt_btn."_id" ?>" postId="<?php echo $post_id ?>"
						onclick="btnCommentEvent_AJAX(this)" />
				</div>
			</div>
		</div>
	</div>
	<?php
	}
?>

<?php
	function showSearchedPost($post) {
		$MY_WEBSITE = "http://$_SERVER[HTTP_HOST]"."/project3";
		$poster = $post['u']['name'];
		$postId = $post['p']['id'];
		$content = $post['p']['content'];

		echo '<div class="page_wrapper">';
			echo '<div class="search_post_body">';
				echo "<div style='margin-bottom: 7px;'>";
					echo "<a class='post_poster' href='".$MY_WEBSITE."/posts/permalink?postId=".$postId."'>";
						echo $poster." > forum";
					echo "</a>";
				echo "</div>";
				echo "<div class='search_post_content'>";
					echo $content;
				echo "</div>";
			echo '</div>';
		echo '</div>';
	}

	function noPostsFound() {
		echo '<div class="page_wrapper">';
			echo "<h3>No posts found!</h3>";
		echo '</div>';
	}
?>