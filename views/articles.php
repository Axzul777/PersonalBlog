<?php
$articles = new DirectoryIterator("articles");

if (!isset($id)) {
  foreach ($articles as $article) {
    if (!is_file("articles/" . $article->getFilename())) {
      continue;
    }

    $article_new = json_decode(
      @file_get_contents("articles/" . $article->getFilename()),
      true
    );

    $id = explode(".", trim($article->getFilename(), "."))[0];

    echo "<a href=\"/articles/{$id}\">" .
      $article_new["title"] .
      "</a>" .
      "<b>" .
      "  " .
      $article_new["date"] .
      "</b>" .
      "<br>";
  }
} else {
  if (file_exists("articles/{$id}.json")) {
    $article = json_decode(@file_get_contents("articles/{$id}.json"), true);
    echo "<article class=\"article\">";
    echo "<h1>" . $article["title"] . "</h1>";
    echo "<div class='article-content'>";
    echo "<p>" . $article["body"] . "</p>";
    echo "</div>";
    echo "</article>";
  } else {
    http_response_code(404);
    echo "<h2>404 Page not found</h2>";
  }
}
