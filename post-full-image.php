<?php
	widget_css();
	widget_javascript();
?>
<div class='post-full-image-container'>
<div class='panel-titles'>Panel Title</div>
<?
	$posts_full_image = $widget_config['menus'];
	$title_colors = $widget_config['title_colors'];
	$color = 0; $i = 0;
	echo "<div class='image-menu-wrapper' style='background: url(".x::url()."/widget/$widget_config[name]/menu_container_bg.png)'>
			<div class='inner'>
				<div class='left_arrow'><img src='".x::url()."/widget/$widget_config[name]/left_arrow.png'/></div>
					<div class='image-menu'>";
						foreach ( $posts_full_image as $menu ) { ?>
							<span class='image-menu-name' menu_name="<?=$menu['url']?>">
								<span class='inner <? if ( $i++ == 0 ) echo "selected"?>'>
									<div class='menu-photo'>
										<img src="<?=x::theme_url('img/menu1_noimage.png')?>"/>
										<div class='menu-overlay'><?=$menu['name']?></div>
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
		$bo_subject = db::result("SELECT bo_subject FROM $g5[board_table] WHERE bo_table='$forum[url]'");
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
						$transparent_background = g::thumbnail_from_image_tag( $img, $forum['url'], $widget_config['width'], $widget_config['height'] );
					?>
					<img src="<?=$transparent_background?>"/>
					<div class='inner'>
						<div class='post_subject'>
							<?=$bo_subject?>
						</div>
					</div>
				</div>
				
				<?
				foreach ( $list as $post ) {
					$imgsrc = get_list_thumbnail($forum['url'], $post['wr_id'], $widget_config['width'], $widget_config['height']);
					if ( $imgsrc['src'] ) {
						$img = $imgsrc['src'];
					} elseif ( $image_from_tag = g::thumbnail_from_image_tag( $post['wr_content'], $forum['url'], $widget_config['width'], $widget_config['height'] )) {
						$img = $image_from_tag;
					} else $img = g::thumbnail_from_image_tag("<img src='".x::url()."/widget/$widget_config[name]/no-image.png'/>", $forum['url'], $widget_config['width'], $widget_config['height']);
					?>
						<div class='gallery4-full-image post_<?=$post_number++?>'>
								<? if ( $post ) {
										$url = $post['href'];
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