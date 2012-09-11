

<!--ajax view... <?php if(isset($data)) echo $data;?>-->

<?php

//require_once "ajax.php";
$ajax = ajax();

//The settings are optional.

//overlay using cache
//Elemene ID, URL
//no settings  ( default settings)
$ajax->Exec("overlay_cache",$ajax->overlay("/ajax/a_jazzy/callback",array(),true));



//no cache
//with dimension settings
// All of these settings are optional. If not specified, default settings are used.
// also these settings can be associated with css style properies, but may differ a little.
$settings['top'] = '150px';
$settings['left'] = '20%';
$settings['transparent'] = '60%'; // from 1 transparent to 100 solid, how transparent should it be? default is 80.
$settings['color'] = '#FF8040'; //color will only work if the setting above (transparent) is present. 
$ajax->Exec("overlay_no_cache",$ajax->overlay("/ajax/a_jazzy/callback",array(),$settings));


//pass content..
//with settings..
$ajax->Exec("overlay_content",$ajax->overlayContent("Hello World",array('top'=> '200px')));


$ajax->Exec("overlay_dialog", $ajax->dialog('Hello World','Dialog#1'));

?>
<html>
<head>
<?php echo $ajax->init();?>
</head>
<body>
<h2>Overlay Examples</h2>
<br />
<br />
The following examples demonstrates ways the overlay can be used. Some of them have timeouts just so that you 
can fully see the functionality.
<br />
<br />
#1 triggers an ajax URL, and displays the response in the content area. The response is cached then the
next time it is requested, it displays the response from the cached request, does not make a new request.
<br />
<a id='overlay_cache' href='#'>See overlay (using cache)</a>
<br />
<br />
#2 Triggers an ajax URL and refreshes the content each time by making a new request. Also demonstrate how alternatively the content window can be
positioned in certain parts of the screen, not necesarly in the middle. It is also possible to customize colors.
<br />
<a id='overlay_no_cache' href='#'>See overlay (no cache)</a>
<br />
<br />
#3 Does not trigger a URL, the content is provided directly instead, and displayed, as simple as that.
<br />
<a id='overlay_content' href='#'>See overlay content</a>
<br />
<br />
#4 Show overlay dialog
<br />
<a id='overlay_dialog' href='#'>See a formatted overlay dialog</a>

<br />
<br />
<br />
Code used:
<?php 
echo $ajax->code("
//Overlay #1
\$ajax->Exec(\"overlay_cache\",\$ajax->overlay(\"ajax.php?overlay/view_overlay\",array(),true));


//Overlay #2
\$settings['top'] = '150px';
\$settings['left'] = '20%';
\$settings['transparent'] = '60%'; 
\$settings['color'] = '#FF8040'; 
\$ajax->Exec(\"overlay_no_cache\",\$ajax->overlay(\"ajax.php?overlay/view_overlay\",\$settings));


//Overlay #3
\$ajax->Exec(\"overlay_content\",\$ajax->overlayContent(\"Hello World\",array('top'=> '200px')));


//Overlay #4
\$ajax->Exec(\"overlay_dialog\",\$ajax->dialog(\"Hello World\",'Dialog#1'));

");?>

</body>
</html>
