<div class="gallery">
  <span><?=$gallery['title']?></span>
  <?if ($gallery['preview']) {?>
    <img src="<?=$gallery['preview']?>" class="galleryImage" width="470" height="400">
  <?} else {?>
	<img src="/images/system/no-image.png" class="galleryImage" width="470" height="400">
  <?}?>
  <a href="/gallery/<?=$gallery['id']?>" class="absolute_full"></a>
</div>
