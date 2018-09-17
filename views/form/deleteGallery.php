<?if (!$_POST) {?>
  <form method="post" class="defaultForm">
    <p>Подтвердите удаление галереи:
      <input type="checkbox" name="confirm" value="Y" required>
      <input type="hidden" name="id" value="<?=$idForDelete?>">
    </p>
    <input type="submit" value="Удалить">
  </form>
<?} else {
  if ($_POST['confirm'] == "Y") $this->deleteGallery($_POST['id']);
  header('Location: /');
}?>
