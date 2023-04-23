<?php
$posts = selectAll("SELECT post.post,biodata.name,user.user_id, user.user_name,biodata.picture,biodata.graduation_at, biodata.faculty
FROM socmed.post,socmed.biodata,socmed.user,socmed.follow
WHERE
follow.following_id = post.user_id AND 
user.user_id = follow.following_id AND
biodata.user_id = follow.following_id AND
follow.user_id = {$ID['user_id']} and
post LIKE '%{$topic}%'
ORDER BY post.post_id DESC");
