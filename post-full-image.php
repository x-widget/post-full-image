	<?php
	widget_css();
	widget_javascript();
	
	$width = $widget_config['width'];
	$height = $widget_config['height'];
	if ( empty($width) ) $width = 270;
	if ( empty($height) ) $height = 280;
	for ( $forum_ctr = 1; $forum_ctr <=7; $forum_ctr++ ) {
		$menu_url = $widget_config['forum'.$forum_ctr];
		if ( empty($menu_url) ) continue;
		
		$icon_url = widget_data_url($widget_config['code'], 'full_image_post_icon-'.$forum_ctr );
		$icon_valid = @get_headers($icon_url);
		if ( $icon_valid[0] == 'HTTP/1.1 404 Not Found') $icon_url = '';
		
		$menu_name = $widget_config['full_image_menu_name'.$forum_ctr];
		if ( empty($menu_name) ) $menu_name = $menu_url;
		
		$posts_full_image[] = array( 'url' => $menu_url, 'name' => $menu_name, 'info' => $widget_config["full_image_menu_info$forum_ctr"], 'icon_url' => $icon_url  );
	}
	if ( empty($posts_full_image) ) $posts_full_image[] = array( 'url' => bo_table(1) , 'name' => 'forum 1' );
?>
<div class='post-full-image-container'>
<div class='panel-titles'><?=$widget_config['title']?></div>
<?
	$title_colors = array( '#ff9b38', '#ffaf30', '#ec5c60', '#bb8df4', '#ff7271', '#ffaf30', '#ff7271', '#b1c516', '#70bcd2', '#8ba6ff' );
	$color = 0; $menu_color = 0; $i = 0;
	echo "<div class='image-menu-wrapper' style='background: url(".x::url()."/widget/$widget_config[name]/menu_container_bg.png)'>
			<div class='inner'>
				<div class='left_arrow'><img src='".x::url()."/widget/$widget_config[name]/left_arrow.png'/></div>
					<div class='image-menu'>";
						foreach ( $posts_full_image as $menu ) { 
							$menu_color++;?>
							<span class='image-menu-name' menu_name="<?=$menu['url']?>">
								<span class='inner <? if ( $i++ == 0 ) echo "selected"?>'>
									<div class='menu-photo'>
										<? if ( empty($menu['icon_url']) ) $imgsrc = x::url()."/widget/$widget_config[name]/menu1_noimage.png"; 
											else $imgsrc = g::thumbnail_from_image_tag("<img src='$menu[icon_url]'/>", $menu[url], $width, $height);
										?>
										<img src="<?=$imgsrc?>"/>
										<div class='menu-overlay' style="opacity: 0.7; background-color: <?=$title_colors[$menu_color]?>"><?=$menu['name']?></div>
									</div>
									<?=$menu['name']?>
								</span>
							</span> <? } ?>
						<div style='clear: left'></div>
					</div>
				<div class='right_arrow'><img src="<?=x::url()?>/widget/<?=$widget_config['name']?>/right_arrow.png"/></div>
				<div style='clear: left'></div>
			</div>
		</div>
	<?
	foreach ( $posts_full_image as $forum ) { 
		$list = db::rows("select * from $g5[write_prefix]$forum[url] where wr_is_comment = 0 order by wr_num limit 0, 3 ");
	?>
		<div class='post-full-image <? if ( $color++ == 0 ) echo "selected"?> <?=$forum['url']?>'>
			<style>
				.gallery4-full-image .shadow { background: url("<?=x::url()?>/widget/<?=$widget_config['name']?>/shadow.png") 0 bottom repeat-x }
				.gallery4-full-image.<?=$forum['url']?> { background-color: <?=$title_colors[$color]?> }
			</style>

			<div class='gallery_full_image'>
				
				<?
				if ( $list ) {
				$post_number = 1;
				?>
				
				<div class='gallery4-full-image post_info <?=$forum['url']?>'>
					<?
						$img = "<img src='".x::url()."/widget/$widget_config[name]/transparent.png'/>";
						$transparent_background = g::thumbnail_from_image_tag( $img, $forum['url'], $width, $height );
					?>
					<img src="<?=$transparent_background?>"/>
					<div class='inner'>
						<div class='post_subject'>
							<?=$forum['name']?>
						</div>
						<div class='post_information'>
							<?=$forum['info']?>
						</div>
					</div>
					<a href="<?=g::url()?>/bbs/board.php?bo_table=<?=$forum['url']?>" class='read_more'></a>
				</div>
				
				<?
				foreach ( $list as $post ) {
					$imgsrc = get_list_thumbnail($forum['url'], $post['wr_id'], $width, $height);
					if ( $imgsrc['src'] ) {
						$img = $imgsrc['src'];
					} elseif ( $image_from_tag = g::thumbnail_from_image_tag( $post['wr_content'], $forum['url'], $width, $height )) {
						$img = $image_from_tag;
					} else $img = g::thumbnail_from_image_tag("<img src='".x::url()."/widget/$widget_config[name]/no-image.png'/>", $forum['url'], $width, $height);
					?>
						<div class='gallery4-full-image post_<?=$post_number++?>'>
								<? if ( $post ) {
										$url = g::url()."/bbs/board.php?bo_table=$forum[url]&wr_id=$post[wr_id]";
										$subject = cut_str($post['wr_subject'],15,'');
										$content = cut_str(strip_tags($post['wr_content']), 30,'...');
								}
								else {
									$url = "javascript:void(0);";
									$subject = "회원님께서는 현재";
									$content = "필고 갤러리 테마 No.3를 선택 하셨습니다.";
								}
								?>
							<div class='inner'>
								<div class='post-image'><a href="<?=$url?>" ><img src="<?=$img?>"/></a></div>
								<div class='subject-wrapper'><div class='subject'><a href="<?=$url?>" ><?=$subject?></a></div></div>
								<div class='content-wrapper'><div class='content'><a href="<?=$url?>" ><?=$content?></a></div></div>
								<span class='shadow'></span>
							</div>
							<a href='<?=$url?>' class='read_more'></a>
						</div>
				<?
				} 
					echo "<div style='clear: left'></div>";
				} else {
					echo "
							<div class='no_post'>
								<img src='".x::url()."/widget/$widget_config[name]/no_image_banner.png' />
							</div>
						";
				
				}	
				?>
		</div>
	</div>
	<?}?>
</div>