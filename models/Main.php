<?
class Main {

  private $galleries;

  public
        $defaultHtml = "<html>
                          <head>
                            <link rel=\"stylesheet\" type=\"text/css\" href=\"css/index.css\">
                          </head>
                          <body>
                            <div class=\"galleries\">%1\$s</div>
                            %2\$s
                          </body>
                         </html>",
        $mainPanel = "<div class=\"adminPanel\"><a href=\"/addGallery\" class=\"add\" title=\"Добавить фотогалерею\"></a></div>";

  public function __construct($galleries) {
    $this->galleries = $galleries;
  }

  public function displayGalleries() {

    if ($this->galleries !== false) {
      ob_start();
      foreach ($this->galleries as $gallery) {
        include(ROOT . '/views/gallery/index.php');
      }
      $html = ob_get_clean();
    } else {
      $html = "<span class=\"notif\">Не создано ни одной галереи</span>";;
    }

    print sprintf($this->defaultHtml,$html,$this->mainPanel);
    return true;
  }

}
?>
