
<div><br><b>Icons must be 105px height by 153px width</b></div>
<?
	include widget_config_form( 'forum', array(	'no' => 7, 'caption' => 'hey'.$i++) );
	for ($i=1; $i<=7; $i++) {
		echo "<span class='caption'>Menu $i Name:</span> : <input type='text' name='full_image_menu_name$i' value='".$widget_config['full_image_menu_name'.$i]."'/>";

		include widget_config_form( 'file', array(
			'name'				=> 'full_image_post_icon-'.$i ,
			'caption'			=> ln('Icon '.$i, '아이콘 '.$i),
		) );
		echo "<br>";
	}

	include widget_config_form('height'); 
	include widget_config_form('width');
	include widget_config_form('title');