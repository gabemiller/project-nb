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

        foreach (Page::where('id', '<>', $id)->get(['id', 'menu']) as $page) {
            $array[$page->id] = $page->menu;
        }

        return $array;
    }

    /**
     *
     * @param type $menu
     * @param int $id
     * @param int $isCompetition
     */
    public static function getPagesForMenu($menu, $id, $isCompetition = 0) {
        $pages = Page::where('parent', '=', $id)->where('is_competition','=',$isCompetition)->get(['id', 'menu', 'parent', 'title']);

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
        if (Page::where('parent', '=', $this->id)->count() > 0) {
            return true;
        } else {
            return false;
        }
    }

}
