<?php

// $Id: formhtmlarea.php,v 1.1 2006/06/14 02:56:52 mikhail Exp $
// ------------------------------------------------------------------------ //
// XOOPS - PHP Content Management System //
// Copyright (c) 2000 xoopscube.org //
// <http://www.xoopscube.org> //
// ------------------------------------------------------------------------ //
// This program is free software; you can redistribute it and/or modify //
// it under the terms of the GNU General Public License as published by //
// the Free Software Foundation; either version 2 of the License, or //
// (at your option) any later version.  //
//   //
// You may not change or alter any portion of this comment or credits //
// of supporting developers from this source code or any supporting //
// source code which is considered copyrighted (c) material of the //
// original comment or credit authors.  //
//   //
// This program is distributed in the hope that it will be useful, //
// but WITHOUT ANY WARRANTY; without even the implied warranty of //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the //
// GNU General Public License for more details. //
//   //
// You should have received a copy of the GNU General Public License //
// along with this program; if not, write to the Free Software //
// Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA //
// ------------------------------------------------------------------------ //
// Author: Kazumi Ono (AKA onokazu)  //
// URL: http://www.myweb.ne.jp/, http://www.xoopscube.org/, http://jp.xoopscube.org/ //
// Project: The XOOPS Project  //
// ------------------------------------------------------------------------- //
/**
 * @author     phppp (D.J., php_PP@hotmail.com)
 * @copyright  copyright (c) 2000-2003 xoopscube.org
 */

/**
 * Adapted HTMLarea wysiwyg editor
 *
 * @author     phppp
 * @copyright  copyright (c) 2000-2003 xoopscube.org
 */
class XoopsFormHtmlarea extends XoopsFormTextArea
{
    public $language = _LANGCODE;

    public $width;

    public $height;

    /**
     * Constructor
     *
     * @param string $caption Caption
     * @param string $name    "name" attribute
     * @param string $value   Initial text
     * @param string $width   iframe width
     * @param string $height  iframe height
     */
    public function __construct($caption, $name, $value = '', $width = '100%', $height = '300px')
    {
        $this->XoopsFormTextArea($caption, $name, $value);

        $this->width = $width;

        $this->height = $height;
    }

    /**
     * get textarea width
     *
     * @return string
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * get textarea height
     *
     * @return string
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * get language
     *
     * @return string
     */
    public function getLanguage()
    {
        return str_replace('_', '-', mb_strtolower($this->language));
    }

    /**
     * set language
     *
     * @param mixed $lang
     */
    public function setLanguage($lang = 'en')
    {
        $this->language = $lang;
    }

    /**
     * prepare HTML for output
     *
     * @return sting HTML
     */
    public function render()
    {
        static $isJsLoaded = false;

        $ret = '';

        if (!$isJsLoaded) {
            $ret .= "
<script type='text/javascript'>
_editor_url = '" . XOOPS_URL . "/class/htmlarea/';
_editor_lang='" . $this->getLanguage() . "';
</script>
<script src='" . XOOPS_URL . "/class/htmlarea/htmlarea.js'></script>\n
";

            $isJsLoaded = true;
        }

        $ret .= "<textarea name='"
                . $this->getName()
                . "' id='"
                . $this->getName()
                . "' rows='"
                . $this->getRows()
                . "' cols='"
                . $this->getCols()
                . "' "
                . $this->getExtra()
                . " style='width:"
                . $this->getWidth()
                . ';height:'
                . $this->getHeight()
                . ";display:none;'>"
                . $this->getValue()
                . '</textarea>';

        $ret .= "<script type='text/javascript'>
var config = new HTMLArea.Config();
config.width = '" . $this->getWidth() . "';
config.height = '" . $this->getHeight() . "';
HTMLArea.replace('" . $this->getName() . "',config);</script>\n
";

        return $ret;
    }
}
