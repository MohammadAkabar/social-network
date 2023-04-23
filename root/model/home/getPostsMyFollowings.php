<?php
//jika sessionnya sebagai member maka post yang akan tertammpil hanya dari teman yang di follow
$posts = selectAll("SELECT post.post,biodata.name,user.user_id, user.user_name,biodata.picture,biodata.graduation_at, biodata.faculty,post.post_id
FROM socmed.follow, socmed.post ,socmed.biodata, socmed.user WHERE 
follow.following_id = post.user_id AND 
user.user_id = follow.following_id AND
biodata.user_id = follow.following_id AND
follow.user_id = {$ID['user_id']}
UNION ALL
SELECT post.post,biodata.name,user.user_id, user.user_name,biodata.picture,biodata.graduation_at, biodata.faculty,post.post_id
FROM  socmed.post ,socmed.biodata, socmed.user
WHERE post.user_id = user.user_id AND
biodata.user_id = user.user_id AND
post.user_id = {$ID['user_id']}
ORDER BY post_id DESC");
