<?php

/**
 * @file
 * template.php
 */
function ocls_informedteens_bootstrap_preprocess_page(&$variables) {
  // Add information about the number of sidebars.
  if (!empty($variables['page']['sidebar_first']) && !empty($variables['page']['sidebar_second'])) {
    $variables['content_column_class'] = ' class="col-sm-6"';
  }
  elseif (!empty($variables['page']['sidebar_first']) || !empty($variables['page']['sidebar_second'])) {
    $variables['content_column_class'] = ' class="col-xs-12 col-sm-8 col-md-9 col-lg-9"';
  }
  else {
    $variables['content_column_class'] = ' class="col-sm-12"';
  }
}