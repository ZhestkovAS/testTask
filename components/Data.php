<?

class Data {

  private
    $host,
    $dbname,
    $user,
    $password,
    $db,
    $query; // запрос

  public function __construct() {
    $this->host = '127.0.0.1';
    $this->dbname = 'testTask';
    $this->user = 'root';
    $this->password = '';
    $this->open();
  }

  private function open() {
    try {
      $this->db = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname,$this->user,$this->password);
      return true;
    } catch (PDOException $e) {
      print "Ошибка подключения базы: " . $e->getMessage();
      die();
    }
  }

  public function query($q) {
    $this->query = $q;
    $result = $this->db->query($this->query);
    return $result;
  }

  /*
  * Получение всех строк результатов запроса
  */
  public function getRows($q) {
    $r = array();
		if ($result = $this->query($q)) while ($row = $result->fetch()) $r[] = $row;
		return $r;
  }

  public function quote($param) {
    return $this->db->quote($param);
  }

  /*
  * Получение первого поля первой строки результатов запроса
  */
  public function dLookup($q) {
    $result = $this->query($q);
    if ($array = $result->fetch()) {
      ksort($array);
      $return = array_shift($array);
      return $return;
    } else {
      return false;
    }
	}

}

?>
