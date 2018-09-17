<?
include_once ROOT.'/models/Form.php';

class FormController {

  public function actionAddGallery() {
    $form = new Form();
    $form->addGalleryForm();
    return true;
  }

  public function actionDeleteGallery($idForDelete) {
    $form = new Form();
    $form->deleteGalleryForm($idForDelete[0]);
    return true;
  }

  public function actionEditGallery($idForEdit) {
    $form = new Form();
    $form->editGalleryForm($idForEdit[0]);
    return true;
  }

  public function actionAddPhotos($galleryId) {
    $form = new Form();
    $form->addPhotosForm($galleryId[0]);
    return true;
  }
}
?>
