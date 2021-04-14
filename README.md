# evoSearch-Reindex
version 1.0

#Install
1. Copy this repository into your site folder
2. Create new module in evo admin panel with code
```php
/**
* evoSearch Reindex
*
* reindex resources for evoSearch
*
* @category        parser
* @version         0.1
* @author          hkyss
* @documentation   empty
* @lastupdate      14.04.2021
* @internal    	@modx_category Search
* @license         GNU General Public License (GPL), http://www.gnu.org/copyleft/gpl.html
*/

include_once MODX_BASE_PATH.'assets/modules/evoSearch Reindex/module.evoSearch Reindex.tpl';
```
3. Create new plugin in evo admin panel with code
```php
/**
 * evoSearch Reindex Ajax
 *
 * evoSearch Reindex ajax plugin
 *
 * @category        parser
 * @version         0.1
 * @author          hkyss
 * @documentation   empty
 * @lastupdate      14.04.2021
 * @internal    	@events OnPageNotFound
 * @internal    	@modx_category Ajax
 * @internal    	@properties &include_tpl=ID шаблонов для обработки;string;1
 * @license         GNU General Public License (GPL), http://www.gnu.org/copyleft/gpl.html
 */

include_once MODX_BASE_PATH.'assets/plugins/evoSearch Reindex/plugin.evoSearch Reindex.php';
```
4. Update template id (ids with comma separator) in plugin configuration