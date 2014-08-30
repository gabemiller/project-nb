<?php

namespace Site;

use Divide\CMS\Article;
use View;
use Request;
use Conner\Tagging\Tag;

class ArticleController extends \BaseController {

    protected $layout = '_frontend.master';

    /**
     * Display a listing of the resource.
     * GET /site\article
     *
     * @return Response
     */
    public function index() {
       
    }

    /**
     * Display the specified resource.
     * GET /site\article/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        
        $article = Article::find($id);
        
        View::share('title', $article->title);
        
        $this->layout->content = View::make('site.article.show')->with('article', $article)->with('url',Request::url());
    }
    
    /**
     * 
     * @param type $tagSlug
     */
    public function tag($id) {
        
        $tag = Tag::where('id','=',$id)->first();
        
        View::share('title', 'Hírek: '.$tag->name);
        
        $article = Article::withAnyTag($tag->name)->orderBy('created_at','desc')->paginate(10);

        $this->layout->content = View::make('site.article.tag')->with('articles',$article)->with('tag',$tag);
    }

}
