<?
class Gallery {

  private
        $gallery,
        $title,
        $photos;
  public
        $defaultHtml = "<html>
                          <head>
                            <link rel=\"stylesheet\" type=\"text/css\" href=\"/css/index.css\">
                            <link rel=\"stylesheet\" type=\"text/css\" href=\"/css/jquery.fancybox.min.css\">
                            <script
                              src=\"https://code.jquery.com/jquery-3.3.1.min.js\"
                              integrity=\"sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=\"
                              crossorigin=\"anonymous\"></script>
                            <script src=\"/js/jquery.fancybox.min.js\"></script>
                            <script src=\"/js/index.js\"></script>
                          </head>
                          <body>
                            <h1 class=\"galleryTitle\">%3\$s</h1>
                            <div class=\"photos\" data-gallery=\"%4\$s\">%1\$s</div>
                            %2\$s
                          </body>
                         </html>",
        $mainPanel = "<div class=\"adminPanel\">
                        <a href=\"/addPhotos/%1\$s\" class=\"add\" title=\"Добавить изображения\"></a>
                        <a href=\"/editGallery/%1\$s\" class=\"edit\" title=\"Редактировать название\"></a>
                        <a href=\"/deleteGallery/%1\$s\" class=\"delete\" title=\"Удалить галерею\"></a>
                        <a href=\"/\" class=\"main\" title=\"На главную\"></a>
                      </div>";

  public function __construct($photos,$gallery,$title) {
    $this->photos = $photos;
    $this->gallery = $gallery;
    $this->title= $title;
  }

  public function displayPhotos() {
    if ($this->photos !== false) {
      ob_start();
      foreach ($this->photos as $photo) {
        include(ROOT . '/views/photo/index.php');
      }
      $html = ob_get_clean();
    } else {
      $html = "<span class=\"notif\">В данной галерее отсутствуют изображения</span>";
    }
    $this->mainPanel = sprintf($this->mainPanel,$this->gallery);
    print sprintf($this->defaultHtml,$html,$this->mainPanel,$this->title,$this->gallery);
    return true;
  }

}
?>
