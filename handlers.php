<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["article"])) {
  $date = date("Y-m-d H:i:s");
  $article_id = iterator_count(new DirectoryIterator("articles")) - 1;

  // echo $article_id;

  file_put_contents(
    "articles/" . $article_id . ".json",
    json_encode(
      [
        "title" => $_POST["title"],
        "date" => $date,
        "body" => $_POST["article"],
      ],
      JSON_PRETTY_PRINT
    )
  );

  // var_dump($new_article);
  echo "New article was created <br>";
  // var_dump($_POST);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["article_edit"])) {
  echo $_POST["article_id"];
  echo $_POST["article_edit"];
  file_put_contents(
    "articles/" . $_POST["article_id"] . ".json",
    json_encode(
      [
        "title" => $_POST["title"],
        "date" => $_POST["date"],
        "body" => $_POST["article_edit"],
      ],
      JSON_PRETTY_PRINT
    )
  );
}
