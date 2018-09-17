<?
include_once ROOT.'/models/Main.php';

class MainController {

  public function actionDisplay() {
    global $data;
    $galleries = $data->getRows("SELECT * FROM `gallery` ORDER BY `id` ASC");
    if (!$galleries) $main = new Main(false);
    else $main = new Main($galleries);
    $main->displayGalleries();
    return true;
  }

}
?>
