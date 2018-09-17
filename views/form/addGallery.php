<?if (!$_POST) {?>
  <form method="post" class="defaultForm">
    <p>Введите название:</p>
    <input type="text" name="title" required>
    <input type="submit" value="Создать">
  </form>
<?} else {
  $this->addGallery($_POST);
  header('Location: /');
}?>
