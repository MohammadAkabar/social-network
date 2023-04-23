<?php
$profiles = select("SELECT *  FROM socmed.biodata, socmed.user WHERE biodata.user_id = {$ID["user_id"]} AND biodata.user_id = user.user_id ");
$followings = rowCount("SELECT following_id FROM socmed.follow WHERE user_id = {$getID} "); //count followings
$followers = rowCount("SELECT followers_id FROM socmed.followers WHERE user_id = {$getID} "); //count followers
$postsCount = rowCount("SELECT * FROM socmed.post WHERE user_id = {$getID} "); //count total posts
$posts = selectAll("SELECT post.post,biodata.name,user.user_id, user.user_name, biodata.picture,biodata.graduation_at, biodata.faculty FROM  socmed.post ,socmed.biodata, socmed.user WHERE post.user_id = user.user_id AND post.user_id = biodata.user_id AND  post.user_id = {$getID} ORDER BY post.post_id DESC");
