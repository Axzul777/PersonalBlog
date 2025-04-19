<?php
require_once "render.php";

$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

$uri_segmented = explode("/", trim($uri, "/"));

switch ($uri_segmented[0]) {
  case "":
    render_template("views/home.php");
    break;

  case "home":
    render_template("views/home.php");
    break;

  case "articles":
    if (isset($uri_segmented[1]) and is_numeric($uri_segmented[1])) {
      $articleId = (int) $uri_segmented[1];

      render_template("views/articles.php", data: ["id" => $articleId]);
    } elseif (!is_numeric($uri_segmented[1]) and isset($uri_segmented[1])) {
      // render_template("views/articles.php");

      http_response_code(404);
      echo "Page not found";
    } else {
      render_template("views/articles.php");
    }
    break;

  case "new":
    render_template("create_article.php");
    break;
  case "admin":
    render_template("admin.php");
    break;

  case "edit":
    if (isset($uri_segmented[1]) and is_numeric($uri_segmented[1])) {
      $articleId = (int) $uri_segmented[1];
      render_template("edit_article.php", data: ["id" => $articleId]);
    } elseif (!is_numeric($uri_segmented[1]) and isset($uri_segmented[1])) {
      http_response_code(404);
      echo "Page not found";
    } else {
      render_template("edit_article.php");
    }
    break;

  default:
    http_response_code(404);
    echo "Not foud" . PHP_EOL;
    break;
}
