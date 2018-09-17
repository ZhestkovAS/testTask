<?
class Handler {


	public function addPhoto($files,$gallery) {
		$uploaddir = ROOT.'/images/';
		$src = '/images/'; 
		  $result['photos'] = false;
		  foreach ($files as $file) {
			if(is_uploaded_file($file['tmp_name'])) {
				if(move_uploaded_file($file['tmp_name'], $uploaddir . $file['name'])) {
				  $result['photos'][] = Array('src' => ($src . $file['name']), 'title' => $file['name'], 'id' => $file['name']);
				  if ($this->addPhotoToBase($gallery,$src . $file['name'])) continue;
				  else echo "Ошибка при добавлении изображения в базу.";
				}
				else {
				  echo "Ошибка при загрузке изображения.";
				}
			}
		  }
		header("Content-Type: application/json");
		print json_encode($result);
		exit;		
	}
	
	private function addPhotoToBase($gallery,$link) {
		global $data;
		$id = $data->quote($gallery);
		$link = $data->quote($link);
		$preview = $data->dLookup("SELECT `preview` FROM `gallery` WHERE `id` = {$id}");
		if (!$preview) $data->query("UPDATE `gallery` SET `preview` = {$link} WHERE `id` = {$id} ");
		$result = $data->query("INSERT INTO `photos` (`id`, `gallery`, `link`, `date`) VALUES (NULL, {$id}, {$link}, CURRENT_TIMESTAMP)");
		if ($result) return true;
		else return false;
	}
	
	public function loadMorePhotos($from,$num,$gallery) {
		global $data;
		$photos = $data->getRows("SELECT * FROM `photos` WHERE `gallery` = ".$data->quote($gallery)." ORDER BY `id` ASC LIMIT {$from},{$num}");
		if ($photos) {
			ob_start();
				foreach ($photos as $photo) {
					include(ROOT . '/views/photo/index.php');
				}
			$result['html'] = ob_get_clean();
		} else {
			$result['html'] = false;
		}
		header("Content-Type: application/json");
		print json_encode($result);
		exit;
	}
	

}
?>
