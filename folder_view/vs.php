<?php
$DS = DIRECTORY_SEPARATOR;
show_source('..'.$DS.$_GET["pagename"]);

echo "<p><h1>functions.php source</h1></p>";

show_source('..'.$DS.'includes'.$DS.'functions.php');