
<?php
include_once("../includes/session.php");
include_once("../includes/DB.php");
include_once("../includes/functions.php");
include_once("../includes/DateTime.php");
global $connectingDB;

$post_id = $_GET["commentId"];
$original_id = $_GET["originalId"];



$sql = 
"
SELECT *
FROM comments
WHERE id = $post_id
";
$stmt = $connectingDB -> prepare($sql);
$stmt->execute();
$Result = $stmt->rowcount();

if ($Result > 0){
   
    while ($DataRow = $stmt->fetch()){
    $comment = $DataRow["comment"];
    ?>
    <div class="comment-on-comment-popup">
    <div class="original-comment-section">
        <img class="backBTN" src="./assets/images/arrow-left-short.svg" alt="" srcset="">
        <span>Origial Comment:</span>
        <img class='close-sub-comments-BTN closeIMG' src="./assets/images/remove.png" alt="">
        <span class="original-comment">
        <?php echo $comment?>
        </span>
    </div>
    <?php

    }
}
?>
<div class="comments-scroll-container">
     <div class="sub-comment-container">
<?php
$sql = 
"
SELECT c.id, c.comment, COUNT(s.id) AS sub_comment_count
FROM comments c
LEFT JOIN comments s ON c.id = s.parent_id
WHERE c.parent_id = $post_id
GROUP BY c.id;
";
// SELECT *
// FROM comments
// WHERE parent_id = $post_id
$stmt = $connectingDB -> prepare($sql);
$stmt->execute();
$Result = $stmt->rowcount();
if ($Result > 0){
    while ($DataRow = $stmt->fetch()){
    $comment = $DataRow["comment"];
    $comment_id = $DataRow ["id"];
    $sub_comment_count = $DataRow["sub_comment_count"];
    ?>
            <div class="comments comnet-id-<?php echo $comment_id?>">
                <span class='sub-comment clickable'><?php echo $comment?></span>
                
                <div class="commnent-icon">
                    <img src="./assets/images/comment.png" alt="" srcset="">
                    <span> <?php echo $sub_comment_count?></span>
                    
                    <div class="screen clickable"></div>
                </div>
            </div>
    <?php

    }
}

?>
    </div>
</div>

<form action="./full-post-page.php?postId=<?php echo $original_id?>" method="post" class="form-for-submiting">
    <span class="reply">Reply:</span>
    <textarea name="sub-comment" id="sub-comment" cols="30" rows="10"></textarea>
    <!-- <span class="submit-sub-comment-BTN">Submit</span> -->
    <input type="hidden" name="parent_comment_id" value="<?php echo $post_id?>">
    <span class="submit-form-BTN-span sub_comment">Post</span>
    <!-- <button type="submit" class="submit-form-BTN" name="submit-sub-comment-BTN" hidden >Post</button> -->
    <!-- <button name="submit-sub-comment-BTN" type="submit">Submit</button> -->
</form>
</div>




