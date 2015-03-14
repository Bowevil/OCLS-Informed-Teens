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

/*
 * Implementation of hook_form_alter()
 */
function ocls_informedteens_bootstrap_form_views_exposed_form_alter(&$form, $form_state, $form_id) {  
  if ($form_id == 'views_exposed_form') {
        $form['tid']['#options']['All'] = t('All Locations');
        $form['keys']['#attributes']['title'] = t('Seach terms...');
        $form['keys']['#attributes']['placeholder'] = t('Seach terms...');    
  }
}