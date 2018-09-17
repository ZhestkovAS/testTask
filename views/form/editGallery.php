<?if (!$_POST) {?>
  <form method="post" class="defaultForm">
    <p>Название галереи:
      <input type="text" name="title" value="<?=$title?>" required>
      <input type="hidden" name="id" value="<?=$idForEdit?>">
    </p>
    <input type="submit" value="Изменить">
  </form>
<?} else {
  if ($_POST['title']&&$_POST['id']) $this->editGallery($_POST['id'],$_POST['title']);
  header('Location: /');
}?>
