<?

//чекаем ошибочки
error_reporting(E_ALL);
ini_set('display_errors', 1);

//подключаем системные файлы
define('ROOT',dirname(__FILE__));
require_once(ROOT.'/components/Router.php');
require_once(ROOT.'/components/Data.php'); // вспомогательный класс для работы с базой

//начинаем работу
$router = new Router();
$data = new Data();
$router->start();



?>
