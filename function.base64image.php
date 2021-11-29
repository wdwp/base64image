<?php
#-------------------------------------------------------------------------
# Plugin: base64
# Author: Yuri Haperski (wdwp@yandex.ru)
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2012 by Ted Kulp (wishy@cmsmadesimple.org)
# This project's homepage is: http://www.cmsmadesimple.org
# The plugin's homepage is: http://dev.cmsmadesimple.org/projects/
#-------------------------------------------------------------------------
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
# Or read it online: http://www.gnu.org/licenses/licenses.html#GPL
#-------------------------------------------------------------------------

function smarty_function_base64image($params, &$smarty)
{
	$gCms = CmsApp::get_instance();
	$root_path = $gCms->config['root_path'];
	$root_url =	$gCms->config['root_url'];

	#Get parameters from the function call
	$src = isset($params['src']) ? str_replace(array($root_url . '/', '//'), array('', '/'), $params['src']) : '';

	if (isset($src) && !empty($src)) {

		$path = $root_path . '/' . urldecode($src);

		#Get source data
		$data = file_get_contents($path);
	} //end if

	if (isset($data) && !empty($data)) {

		#Get source path
		$pathinfo = pathinfo($path);

		#Get source type
		$type = strtolower($pathinfo['extension']);

		#Return encoded image
		return 'data:image/' . $type . ';base64,' . base64_encode($data);
	} else {

		return 'Error: image path is not valid';
	} //end if

} // End Function
/**
 * Help text
 */
function smarty_cms_help_function_base64image()
{
?>
	<h3>What does this do?</h3>
	<p>This plugin encodes an image to base64 format.</p>

	<h3>How do I use it?</h3>
	<p>HTML: &lt;img src="{base64image src="uploads/simplex/images/cmsmadesimple-logo.png"}" width="227" height="59" alt="{sitename}"/&gt;</p>
	<p>CSS: background: url([[base64image src="uploads/simplex/images/palm-circle.png"]]) no-repeat;</p>
	<p>You can use an absolute and relative url for the image src.</p>
<?php
} // End Function
/**
 * About text
 */
function smarty_cms_about_function_base64image()
{
?>
	<p><b>Plugin author: Yuri Haperski (wdwp@yandex.ru)</b></p>

	<p><b>Version:</b> 1.1</p>
	<p><b>Change History:</b></p>
	<p><b>18-03-2021 - Initial release (v1.0)</b></p>
	<p><b>29-11-2021 - Some improvements</b></p>
<?php
} // End Function
?>