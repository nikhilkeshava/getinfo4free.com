/*
Copyright (c) 2003-2020, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
*/

.cke_tpl_list
{
	border: #dcdcdc 2px solid;
	background-color: #ffffff;
	overflow-y: auto;
	overflow-x: hidden;
	width: 100%;
	height: 220px;
}

.cke_tpl_item
{
	margin: 5px;
	padding: 7px;
	border: #eeeeee 1px solid;
	*width: 88%;
}

.cke_tpl_preview
{
	border-collapse: separate;
	text-indent:0;
	width: 100%;
}
.cke_tpl_preview td
{
	padding: 2px;
	vertical-align: middle;
}
.cke_tpl_preview .cke_tpl_preview_img
{
	width: 100px;
}
.cke_tpl_preview span
{
	white-space: normal;
}

.cke_tpl_title
{
	font-weight: bold;
}

.cke_tpl_list a:hover .cke_tpl_item,
.cke_tpl_list a:focus .cke_tpl_item,
.cke_tpl_list a:active .cke_tpl_item
{
	border: #ff9933 1px solid;
	background-color: #fffacd;
}

.cke_tpl_list a:hover *,
.cke_tpl_list a:focus *,
.cke_tpl_list a:active *
{
	cursor: pointer;
}

/* IE Quirks contextual selectors children will not get :hover transition until
	the hover style of the link itself contains certain CSS declarations. */
.cke_browser_quirks .cke_tpl_list a:active,
.cke_browser_quirks .cke_tpl_list a:hover,
.cke_browser_quirks .cke_tpl_list a:focus
{
	background-position: 0 0;
}

.cke_hc .cke_tpl_list a:hover .cke_tpl_item,
.cke_hc .cke_tpl_list a:focus .cke_tpl_item,
.cke_hc .cke_tpl_list a:active .cke_tpl_item
{
	border-width: 3px;
}

.cke_tpl_empty, .cke_tpl_loading
{
	text-align: center;
	padding: 5px;
}
