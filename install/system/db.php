<?php




/*
* Security fix to dis allow direct file access!
*/
defined('____DONT')
or die('Not allowed to directly access ME :( Sorry folk :)!');


/*
* Now let's update the database with these new records!
* and then later we will need to install the sample data!
*/
$query = "SELECT * FROM settings";
// execute query
$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
// see if any rows were returned
if (mysql_num_rows($result) > 0) {
$theQueryOne = mysql_query("
INSERT INTO settings
(id,title,description,keywords,url,web_name,web_email,max_filesize,default_language,default_theme)
VALUES ('1','$configTitle','$configDesc','$configKeywords','','','$configEmail','$configUploadSize','','');

");
}else{
$theQueryOne = mysql_query("
UPDATE `settings` SET
`id`='1',
`title`='$configTitle',
`description`='$configDesc',
`keywords`='$configKeywords',
`url`='',
`web_name`='',
`web_email`='$configEmail',
`max_filesize`='$configUploadSize',
`default_language`='',
`default_theme`=''
");
}


/*
$query = "SELECT * FROM settings";
// execute query
$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
// see if any rows were returned
if (mysql_num_rows($result) > 0) {
    echo "Table is not Empty";
}
else echo "Table is Empty";
*/



