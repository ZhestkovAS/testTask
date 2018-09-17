<?
class Form {

  private $galleryId;

  public $defaultHtml = "<html>
                    <head>
                      <link rel=\"stylesheet\" type=\"text/css\" href=\"/css/index.css\">
                      <link rel=\"stylesheet\" type=\"text/css\" href=\"/css/system.css\">
                      <script
                        src=\"https://code.jquery.com/jquery-3.3.1.min.js\"
                        integrity=\"sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=\"
                        crossorigin=\"anonymous\"></script>
                        <script src=\"/js/photos.js\"></script>
                        <script src=\"/js/index.js\"></script>
                    </head>
                    <body>
                      <div class=\"form\">%1\$s</div>
                    </body>
                   </html>";


  public function addGalleryForm() {
    ob_start();
    include(ROOT . '/views/form/addGallery.php');
    $html = ob_get_clean();
    print sprintf($this->defaultHtml,$html);
    return true;
  }

  private function addGallery($params) {
    global $data;
    $title = $data->quote($params['title']);
    $result = $data->query("INSERT INTO `gallery` (`id`, `title`, `preview`, `date`) VALUES (NULL, {$title}, '', CURRENT_TIMESTAMP)");
    if ($result) return true;
    else {
      print "Что-то пошло не так";
      return false;
    }
  }

  public function deleteGalleryForm($idForDelete) {
    ob_start();
    include(ROOT . '/views/form/deleteGallery.php');
    $html = ob_get_clean();
    print sprintf($this->defaultHtml,$html);
    return true;
  }

  public function deleteGallery($idForDelete) {
    global $data;
    $result = $data->query("DELETE FROM `gallery` WHERE `id` = ".$data->quote($idForDelete));
    $photos = $data->getRows("SELECT `link` FROM `photos` WHERE `gallery` = ".$data->quote($idForDelete));
    foreach ($photos as $photo) {
      unlink(ROOT.$photo['link']);
    }
    $result = $data->query("DELETE FROM `photos` WHERE `gallery` = ".$data->quote($idForDelete));
    if ($result) return true;
    else {
      print "Что-то пошло не так";
      return false;
    }
  }

  public function editGalleryForm($idForEdit) {
    global $data;
    $title= $data->dLookup("SELECT `title` FROM `gallery` WHERE `id` = ".$data->quote($idForEdit));
    ob_start();
    include(ROOT . '/views/form/editGallery.php');
    $html = ob_get_clean();
    print sprintf($this->defaultHtml,$html);
    return true;
  }

  public function editGallery($idForEdit,$newTitle) {
    global $data;
    $result = $data->query("UPDATE `gallery` SET `title` = ".$data->quote($newTitle)." WHERE `id` = " . $data->quote($idForEdit));
    if ($result) return true;
    else {
      print "Что-то пошло не так";
      return false;
    }
  }

  public function addPhotosForm($galleryId) {
    ob_start();
    include(ROOT . '/views/form/addPhotos.php');
    $html = ob_get_clean();
    print sprintf($this->defaultHtml,$html);
    return true;
  }

}
?>
