<?php
function signupform_admin_settings_form() {
  $form = array();
  $form['signupform_types'] = array(
    '#title' => t('The content types to enable signupform subscriptions for'),
    '#description' => t('On the specified node types, a signupform subscription option will
    be available and can be enabled while that node is being edited.'),
    '#type' => 'checkboxes',
    '#options' => node_type_get_names(),
    '#default_value' => variable_get('signupform_types', array()),
  );
  return system_settings_form($form);
}
function signupform_signups() {
  $output = '';
  $rows = array();
  $header = array(
   'User',
   'Node',
   'Email',
   'Created',
  );
  $fields = drupal_get_schema('signupform');
  $query = db_select('signupform', 'm');
  $table_alias = $query->innerJoin('node', 'n', 'n.nid =
    m.nid', array());
  $results = $query->fields('m',array_keys($fields['fields']))
    ->fields($table_alias, array('title'))
    ->orderBy('m.created', $direction = 'ASC')
    ->execute()
    ->fetchAll();

  foreach ($results as $value) {
    $account = $value->uid ? user_load($value->uid) : '';
    $rows[] = array(
      $value->uid ? theme('username', array('account' =>
       $account)) : '',
      $value->nid ? l($value->title, 'node/' . $value->nid) : '',
      $value->mail,
      date('F j, Y g:i A', $value->created),
    );
  }

  $output .= theme('table', array('header' => $header, 'rows' =>
   $rows));
  return $output;
}

