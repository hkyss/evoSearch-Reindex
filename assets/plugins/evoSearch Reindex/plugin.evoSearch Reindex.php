<?php
/**
 * evoSearch Reindex Ajax
 *
 * evoSearch Reindex ajax plugin
 *
 * @category        parser
 * @version         0.1
 * @author          hkyss
 * @documentation   empty
 * @lastupdate      09.11.2020
 * @internal    	@events OnPageNotFound
 * @internal    	@modx_category Ajax
 * @license         GNU General Public License (GPL), http://www.gnu.org/copyleft/gpl.html
 */

if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
    return;
}
switch ($_GET['q']) {
    case 'reindex':
        $start = (int)$_POST['start'];
        $step = (int)$_POST['step'];

        include_once MODX_BASE_PATH.'assets/lib/MODxAPI/modResource.php';
        $doc = new modResource($modx);

        $select = $modx->db->query('Select id From '.$modx->getFullTableName('site_content').' Where template in (9)');
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

    default:
        break;
}
?>