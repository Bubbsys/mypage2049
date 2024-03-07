#!/usr/local/bin/php
<?php
function post_text($arg1_author, $arg2_post){
    if(!$arg2_post){
        echo "Nobody has made a post.";
        }
    else {
         $post = fopen('posts.txt', 'a');
        fwrite($post, "<p><b>" . $arg1_author . "</b>" . ' says: ' . $arg2_post . "</p>" . "\n");
        fclose($post);
        echo "Post successfully written go back to <a href='https://www.pic.ucla.edu/~hwbubb/Final/blog.php'>blog.php</a>";
         }
}
if(isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'blog.php') !== false){
    $author = $_POST['author'];
    $postContent = $_POST['post'];
    if(isset($author) && isset($postContent)){
        post_text($author, $postContent);
    }
} else {
    echo "Nobody has made a post.";
}
?>