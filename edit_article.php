<?php

function get_articles(): array
{
  $articles = [];

  $files_iter = new FilesystemIterator(
    "articles",
    FilesystemIterator::SKIP_DOTS
  );

  // var_dump($files_iter);
  $id = 0;

  foreach ($files_iter as $file_name) {
    $id += 1;
    $real_path = "articles/" . $file_name->getFilename();
    if (file_exists($real_path)) {
      $contents = @file_get_contents($real_path);
      $article_deserialized = json_decode($contents, true);

      $articles[] = [
        "id" => $id,
        "date" => $article_deserialized["date"],
        "title" => $article_deserialized["title"],
        "body" => $article_deserialized["body"],
      ];

      // var_dump($article_deserialized);
    }
  }

  return $articles;
}

$articles = get_articles();
?>

<?php if (isset($id)) { ?>
  <section>
    <form method="post">
      <input type="hidden" name="article_id" value="<?= $id ?>">
   <input type="hidden" name="date" value="<?= $articles[$id]["date"] ?>">
   <label for="article">
      <br>
      <label for="title">Edit article:</label>
      <input type="text" name="title" id="title" value="<?= $articles[$id][
        "title"
      ] ?>">
      <br>
      <textarea id="article_edit" name="article_edit" row="10" cols="50"><?= $articles[
        $id
      ]["body"] ?></textarea>
      <br>
      <button type="submit">Save Changes</button>
      <button><a href="/home">Cancel</a>
    </form>
</section>
<?php } else {foreach (get_articles() as $article) {
    echo '<section style="display: flex;">';
    echo '<div style="padding-right: 2rem;">' . $article["title"] . "</div>";
    echo "<button>";
    echo '<a href="/edit/' . $article["id"] . '">';
    echo "edit";
    echo "</a>";
    echo "</button>";
    echo "</section>";
    echo "<br>";
  }} ?>
