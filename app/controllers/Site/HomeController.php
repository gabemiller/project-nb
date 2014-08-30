<?php

namespace Site;

use Divide\CMS\Article;
use Divide\CMS\Page;
use View;


class HomeController extends \BaseController {

    protected $layout = '_frontend.master';

    /**
     * Display a listing of the resource.
     * GET /site\index
     *
     * @return Response
     */
    public function index() {
        View::share('title', 'Főoldal');
        
        
        $article = Article::whereRaw('shows = ? ORDER BY created_at DESC',array(true))->paginate(10);

        $this->layout->content = View::make('index')->with('articles',$article);
    }


    /**
     * Display the specified resource.
     * GET /site\index/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
    }
    


}
