<?php defined("SYSPATH") or die("No direct script access.");
/**
 * Gallery - a web based photo album viewer and editor
 * Copyright (C) 2000-2008 Bharat Mediratta
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or (at
 * your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street - Fifth Floor, Boston, MA  02110-1301, USA.
 */
class Admin_Themes_Controller extends Admin_Controller {
  public function index() {
    $view = new Admin_View("admin.html");
    $view->content = new View("admin_themes.html");
    $themes = scandir(THEMEPATH);
    $view->content->themes = array_diff($themes, array(".", "..", ".svn"));
    $view->content->active = module::get_var("core", "active_theme");
    print $view;
  }
  
  public function save() {
    access::verify_csrf();
    $theme = $this->input->post("theme");
    if ($theme != module::get_var("core", "active_theme")) {
      module::set_var("core", "active_theme", $theme);
      message::success(_("Updated Theme"));
      log::success("graphics", sprintf(_("Changed theme to %s"), $theme));
    }
    url::redirect("admin/themes");
  }
}

