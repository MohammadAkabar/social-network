<?php
//query mendapatkan profle user untuk di tampilkan di widget find people

$getFindPeople = selectAll("SELECT biodata.name, biodata.picture, user.user_name, user.user_id, biodata.faculty, biodata.graduation_at
FROM socmed.biodata, socmed.user 
WHERE user.user_id = biodata.user_id AND
user.user_id != {$ID["user_id"]}");
