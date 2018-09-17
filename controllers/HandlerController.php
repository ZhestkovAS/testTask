<?
include_once ROOT.'/models/Handler.php';

class HandlerController {

  public function actionAddPhoto() {
    $handler = new Handler();
    $handler->addPhoto($_FILES,$_POST['gallery']);
    return true;
  }

  public function actionLoadMorePhotos() {
    $handler = new Handler();
    $handler->loadMorePhotos($_POST['from'],$_POST['num'],$_POST['gallery']);
    return true;
  }
}
?>
