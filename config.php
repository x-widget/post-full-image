<?
	include widget_config_form( 'forum', array(	'no' => 7 ) );
	echo "<hr>";
	for ($i=1; $i<=7; $i++) {
		echo "<span class='caption'>Menu $i Name:</span> : <input type='text' name='full_image_menu_name$i' value='".$widget_config['full_image_menu_name'.$i]."'/>";
		include widget_config_form( 'textarea', array (
			'name' => "full_image_menu_info$i",
			'caption' => "Menu $i Info",
		) );
		include widget_config_form( 'file', array(
			'name'				=> 'full_image_post_icon-'.$i ,
			'caption'			=> ln('Icon '.$i.'<br>105px w x 153px h', '아이콘 '.$i.'<br>105px h x 153px w '),
		) );
		echo "<br><hr><br>";
	}

	include widget_config_form('height'); 
	include widget_config_form('width');
	include widget_config_form('title');