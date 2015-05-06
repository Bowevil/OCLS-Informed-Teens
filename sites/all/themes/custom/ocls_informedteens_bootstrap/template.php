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

/**
 * @file
 * pager.func.php
 */

/**
 * Overrides theme_pager().
 */
function ocls_informedteens_bootstrap_pager($variables) {
    $output = "";
    $items = array();
    $tags = $variables['tags'];
    $element = $variables['element'];
    $parameters = $variables['parameters'];
    $quantity = $variables['quantity'];

    global $pager_page_array, $pager_total;

    // Calculate various markers within this pager piece:
    // Middle is used to "center" pages around the current page.
    $pager_middle = ceil($quantity / 2);
    // Current is the page we are currently paged to.
    $pager_current = $pager_page_array[$element] + 1;
    // First is the first page listed by this pager piece (re quantity).
    $pager_first = $pager_current - $pager_middle + 1;
    // Last is the last page listed by this pager piece (re quantity).
    $pager_last = $pager_current + $quantity - $pager_middle;
    // Max is the maximum page number.
    $pager_max = $pager_total[$element];

    // Prepare for generation loop.
    $i = $pager_first;
    if ($pager_last > $pager_max) {
        // Adjust "center" if at end of query.
        $i = $i + ($pager_max - $pager_last);
        $pager_last = $pager_max;
    }
    if ($i <= 0) {
        // Adjust "center" if at start of query.
        $pager_last = $pager_last + (1 - $i);
        $i = 1;
    }

    // End of generation loop preparation.
    // @todo add theme setting for this.
    $li_first = theme('pager_first', array(
        'text' => (isset($tags[0]) ? $tags[0] : t('first')),
        'element' => $element,
        'parameters' => $parameters,
    ));
    $li_previous = theme('pager_previous', array(
        'text' => (isset($tags[1]) ? $tags[1] : t('previous')),
        'element' => $element,
        'interval' => 1,
        'parameters' => $parameters,
    ));
    // @todo add theme setting for this.
    $li_last = theme('pager_last', array(
        'text' => (isset($tags[4]) ? $tags[4] : t('last')),
        'element' => $element,
        'parameters' => $parameters,
    ));
    $li_next = theme('pager_next', array(
        'text' => (isset($tags[3]) ? $tags[3] : t('next')),
        'element' => $element,
        'interval' => 1,
        'parameters' => $parameters,
    ));
    if ($pager_total[$element] > 1) {
        // @todo add theme setting for this.
        // if ($li_first) {
        // $items[] = array(
        // 'class' => array('pager-first'),
        // 'data' => $li_first,
        // );
        // }
        if ($li_previous) {
            $items[] = array(
                'class' => array('prev'),
                'data' => $li_previous,
            );
        }
        // When there is more than one page, create the pager list.
        if ($i != $pager_max) {
            if ($i > 1) {
                $items[] = array(
                    'class' => array('pager-ellipsis', 'disabled'),
                    'data' => '<span>…</span>',
                );
            }
            // Now generate the actual pager piece.
            for (; $i <= $pager_last && $i <= $pager_max; $i++) {
                if ($i < $pager_current) {
                    $items[] = array(
                        // 'class' => array('pager-item'),
                        'data' => theme('pager_previous', array(
                            'text' => $i,
                            'element' => $element,
                            'interval' => ($pager_current - $i),
                            'parameters' => $parameters,
                        )),
                    );
                }
                if ($i == $pager_current) {
                    $items[] = array(
                        // Add the active class.
                        'class' => array('active'),
                        'data' => l($i, '#', array('fragment' => '', 'external' => TRUE)),
                    );
                }
                if ($i > $pager_current) {
                    $items[] = array(
                        'data' => theme('pager_next', array(
                            'text' => $i,
                            'element' => $element,
                            'interval' => ($i - $pager_current),
                            'parameters' => $parameters,
                        )),
                    );
                }
            }
            if ($i < $pager_max) {
                $items[] = array(
                    'class' => array('pager-ellipsis', 'disabled'),
                    'data' => '<span>…</span>',
                );
            }
        }
        // End generation.

        // @todo add theme setting for this.
        if ($li_last) {
        $items[] = array(
        'class' => array('pager-last'),
        'data' => $li_last,
        );
        }
        if ($li_next) {
            $items[] = array(
                'class' => array('next'),
                'data' => $li_next,
            );
        }
        return '<div class="text-center">' . theme('item_list', array(
            'items' => $items,
            'attributes' => array('class' => array('pagination')),
        )) . '</div>';
    }
    return $output;
}

function ocls_informedteens_bootstrap_preprocess_html(&$variables) {
  drupal_add_js(drupal_get_path('theme', 'ocls_informedteens_bootstrap') . '/js/ocls_js.js', array(
    'scope' => 'footer',
    'weight' => '15'
  ));
}
