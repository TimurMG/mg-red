<? 
$db = mysql_connect("localhost","mgorod_kz","BepSjq2YyAMLzTpJ");
mysql_select_db("mgorod_kz",$db);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<title>Вакансии от uJOB.kz</title>
</head>

<body>

<?
$result_cat = mysql_query("SELECT * FROM mt_posts WHERE  post_type='news'");      
$myrow_cat = mysql_fetch_array($result_cat);

do 
{
printf ("<table borser='0' style='font-family:Arial; font-zise:12px; border-bottom:1px #CCC solid; display:block;'>
		<tr>
		<td>
		<a href='http://www.ujob.kz/view-vak.php?id=%s' style='font-family:Arial; font-zise:12px; color:#228AA8;' target='_blank'><b>%s</b></a>
		</td>
		</tr>
		<tr>
		<td>
		<div style='font-size:12px; color:#999;'><b>Город:</b> %s</div>
		</td>
		</tr>
		</table>",$myrow_cat['id'],$myrow_cat['post_title'],$myrow_cat['post_content']);
}

while ($myrow_cat = mysql_fetch_array($result_cat));
?>

</body>
</html>