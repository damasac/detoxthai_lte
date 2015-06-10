<?php
    for($i=1;$i<=140;$i++)
    {
        $sqlInsertI = "
        INSERT INTO `thaipalliative_lte`.`puser` (

	`username`,
	`password`,
	`email`,
	`fname`,
	`lname`,
	`status`,
	`hcode`,
	`area`,
	`district`,
	`amphur`,
	`province`,
	`createdate`
)
VALUES
	(
		usersite".$i.",
		".sha1(md5("usersite".$i."")).",
		'usersite".$I."@thaipalliative.com',
		'user".$i."',
		'thaipalliative',
		'5',
		,
		NULL,
		NULL,
		NULL,
		NULL,
		NULL,
		NULL
	);
        "
    }
?>