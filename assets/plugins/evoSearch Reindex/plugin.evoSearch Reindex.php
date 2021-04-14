<?php
if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
  return;
}

if(empty($include_tpl)) {
  $modx->logEvent(0,1,'empty resource templates','evoSearch reindex error.');
  die('evoSearch reindex error.');
}

switch ($_GET['q']) {
  case 'reindex':
    $start = (int)$_POST['start'];
    $step = (int)$_POST['step'];

    include_once MODX_BASE_PATH.'assets/lib/MODxAPI/modResource.php';
    $doc = new modResource($modx);

    $select = $modx->db->query('Select id From '.$modx->getFullTableName('site_content').' Where template in ('.$include_tpl.') and published in (1) and deleted = 0');
    $select = $modx->db->makeArray($select);
    $items = array_slice($select,$start,$step);

    foreach($items as $item) {
      $doc->edit((int)$item['id']);
      $doc->save(true,false);
      $doc->close();
    }
    $start = $start + $step;
    $modx->clearCache('full');

    echo json_encode(['start'=>$start,'step'=>$step,'arr_count'=>count($select)]);
    die();
    break;
  case 'truncate':
    $modx->db->query('TRUNCATE TABLE '.$modx->getFullTableName('evosearch_table'));

    echo json_encode(['status'=>true]);
    die();
    break;

  default:
    break;
}
?>