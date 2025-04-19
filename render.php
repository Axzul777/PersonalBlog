<?php

function render_template(string $template_name, array $data = [])
{
  $path = __DIR__ . "/" . $template_name;

  if (!file_exists($path)) {
    http_response_code(404);
    echo "Template not found" . PHP_EOL;
  } else {
    extract($data, EXTR_PREFIX_SAME, "wddx");

    include $path;
  }
}
