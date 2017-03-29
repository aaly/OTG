<?php

$dir    = 'images';
$dirty = scandir($dir);

$ciao=	"Goodbye ;)";
$nextImageTXT="Click here to view next picture =)";



echo 	'<head>'.
	'<meta charset="UTF-8">'.
	'<meta http-equiv="cache-control" content="max-age=0" />'.
	'<meta http-equiv="cache-control" content="no-cache" />'.
	'<meta http-equiv="expires" content="0" />'.
	'<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />'.
	'<meta http-equiv="pragma" content="no-cache" />'.
	'</head>';

print ' <script language="javascript">    document.onmousedown=disableclick;    status="Right Click Disabled";    Function disableclick(event)    {      if(event.button==2)       {         alert(status);         return false;           }    }    </script>';


print '<body oncontextmenu="return false">';

print '<div  onmousedown="return false" >';
print '<div onmousedown="event.preventDefault ? event.preventDefault() : event.returnValue = false">';
if (file_exists($dir))
{
	while (true)
	{
		if ($dirty[0] == "." || $dirty[0] == "..")
		{
			array_shift($dirty);
		}
		else
		{
			break;
		}
	}


	// display the darn file
	//print '<<<<<<<<<<<<img src="'.$dir.'/'.$dirty[0].'">>>>>>>>>>.';

	$contents = file_get_contents($dir.'/'.$dirty[0]);
	$base64 = base64_encode($contents);
	//echo '<div id="image"><img src="data:image/jpg;base64,'.$base64.'" 	width="280" height="280"></div>';
	echo '<div id="image"><img src="data:image/jpg;base64,'.$base64.'"></div>';

	print '<br> <br>';
	// delete the darn file
	$dirtyFile = $dir.'/'.$dirty[0];
	$dirtyFileSize = filesize($dirtyFile);
	
	$fh = fopen($dirtyFile, 'w');
	
	if ($fh)
	{
		for ( $i = 0; $i < $dirtyFileSize; $i++)
		{
			fwrite($fh, '\0');
		}
		fclose($fh);
	}

	unlink($dir.'/'.$dirty[0]);
	

	if (count($dirty) > 1 ) // display next button
	{

		//print '<a href="'.__FILE__.'" onclick=" location.reload();"> Next Image ;) </a>';
		print '<br> <a  href="#" onclick="location.reload();">'.$nextImageTXT.' </a> <br>';
	}
	else
	{
		//print ('<br> uncomment to remove the directory ;)');
		rmdir($dir);
		print ('<br> <br>');
		print(' <a  href="#" onclick="location.reload();">'.$ciao.'</a>');
	}


}
else
{
	print 'NULL, self destructed :(';
	
	$selfFileSize = filesize(__FILE__);
	
	$fh = fopen(__FILE__, 'w');
	
	if ($fh)
	{
		for ( $i = 0; $i < $selfFileSize; $i++)
		{
			fwrite($fh, '\0');
		}
		fclose($fh);
	}

	unlink(__FILE__);
	
}

print '</div>';
print '</div>';

print '</body>';

?>

