<?php
$start = gettimeofday(); //начало
file_get_contents ("http://backup.kz");
$end = gettimeofday();
$result = (float)($end['sec'] - $start['sec']) + ((float)($end['usec'] - $start['usec'])/1000000);
 
printf('Страница сгенерирована за %.5f сек.', $result);
?>
</body>
</html>