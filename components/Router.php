<?

class Router {

  private $routes;
  private $mainController;


  public function __construct() {
    $this->routes = include(ROOT.'/config/routes.php');
  }

  /*
  * Возвращаем строку запроса для дальнейшей обработки
  */
  private function getURI() {
    if (!empty($_SERVER['REQUEST_URI'])) return $uri = trim($_SERVER['REQUEST_URI'],'/');
    else {
      print self::get404();
      return false;
    }
  }

  public function start() {
    $uri = $this->getURI();
    if ($uri === false) return false;
    if ($uri == "") {
      $this->mainController = ROOT.'/controllers/MainController.php';
      include_once($this->mainController);
      $controller = new MainController();
      $controller->actionDisplay();
      return true;
    }
    $error = true;
    foreach ($this->routes as $uriSimple => $process) {
      if (preg_match("~$uriSimple~",$uri)) {
        $internalRoute = preg_replace("~$uriSimple~",$process,$uri);
        $elements = explode('/',$internalRoute);
        $controllerClass = ucfirst(array_shift($elements) . "Controller");
        $controllerFile = $controllerClass.'.php';
        $controllerPath = ROOT . "/controllers/" . $controllerFile;
        $method = 'action' . ucfirst(array_shift($elements));
        if (count($elements)>1) { // входящий в routes, но с лишними параметрами
          print $this->get404();
          return false;
        }
        if (file_exists($controllerPath)) {
          include_once($controllerPath);
          $controller = new $controllerClass;
          $controller->$method($elements);
          $error = false;
        }
      }
    }
    if ($error === true) {
      print self::get404();
      return false;
    }
  }

  public static function get404() {
    return "упс, 404 ошибка";
  }

}

?>
