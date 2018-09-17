<?
include_once ROOT.'/models/Gallery.php';

class GalleryController {

  public function actionDisplay($galleryNum) {
    if ($galleryNum === false || !isset($galleryNum)) return false;
    global $data;
    $photos = $data->getRows("SELECT * FROM `photos` WHERE `gallery` = ".$data->quote($galleryNum[0])." ORDER BY `id` ASC LIMIT 4");
    $title = $data->dLookup("SELECT `title` FROM `gallery` WHERE `id` = ".$data->quote($galleryNum[0]));
    if (!$photos&&!$title)  {
      print Router::get404();
      return false;
    }
    if ($photos) $gallery = new Gallery($photos,$galleryNum[0],$title);
    else $gallery = new Gallery(false,$galleryNum[0],$title);
    $gallery->displayPhotos();
    return true;
  }

}
?>
