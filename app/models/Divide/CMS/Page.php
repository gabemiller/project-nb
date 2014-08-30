<?php

namespace Divide\CMS;

use Str;

class Page extends \Eloquent {

//protected $fillable = [];
    protected $table = 'pages';

    /**
     * 
     * @return type
     */
    public function gallery() {
        return $this->belongsTo('Divide\CMS\Gallery');
    }

    /**
     * 
     * @return type
     */
    public function getGalleryId() {
        return $this->gallery_id == 0 ? 0 : $this->gallery->id;
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    public static function getPages($id = 0) {

        $array = array(0 => 'Nincs');

        foreach (Page::where('id', '<>', $id)->get() as $page) {
            $array[$page->id] = $page->menu;
        }

        return $array;
    }

    /**
     * 
     * @param type $menu
     * @param type $id
     */
    public static function getPagesForMenu($menu, $id) {
        $pages = Page::where('parent', '=', $id)->get();

        if ($id == 0) {
            foreach ($pages as $page) {
                $menu->add($page->menu, array('route' => array('oldalak.show', 'id' => $page->id, 'title' => Str::slug($page->title))));
                Page::getPagesForMenu($menu, $page->id);
            }
        } else {
            foreach ($pages as $page) {
                $parent = Page::find($page->parent);
                $menu->get(Str::camel($parent->menu))->add($page->menu, array('route' => array('oldalak.show', 'id' => $page->id, 'title' => Str::slug($page->title))));
                Page::getPagesForMenu($menu, $page->id);
            }
        }
    }

    /**
     * 
     */
    public function hasChildren() {
        if (count(Page::where('parent', '=', $this->id)->get()) > 0) {
            return true;
        } else {
            return false;
        }
    }

}
