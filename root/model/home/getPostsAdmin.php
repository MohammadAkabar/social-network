<?php
//jika session nya sebagai admin maka semua post akan tertampil di timeline
$posts = selectAll("SELECT user.user_name,user.user_id,biodata.graduation_at,biodata.faculty,biodata.name,biodata.picture, post.post FROM socmed.post, socmed.user, socmed.biodata where user.user_id = post.user_id and user.user_id = biodata.user_id ORDER BY post.post_id DESC");
