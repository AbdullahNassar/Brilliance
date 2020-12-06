<?php

namespace App\Http\Controllers\Site\Articles;

use App\Http\Controllers\Admin\MainController;
use App\Http\Requests\Article\StoreArticleReportRequest;
use App\Helpers\Request as RequestHelper;
use App\ArticleTranslation;
use App\Article;
use App\Group;
use App\ArticleReport;
use Illuminate\Http\Request;


class ArticlesController extends MainController
{
    public $model = Article::class;

    public static function articles(){
        $groups = Group::all();
        $group_id = 0;
        $r_articles = Article::where('status', 1)->orderBy('id', 'DESC')->get();
        $articles = Article::where('status', 1)->where('top', 1)->orderBy('id', 'DESC')->get();
        return view('site.pages.articles.index', compact('articles','groups','group_id','r_articles'));
    }

    public static function discover(){
        $groups = Group::all();
        $r_articles = Article::where('status', 1)->orderBy('id', 'DESC')->get();
        $articles = Article::where('status', 1)->where('top', 1)->orderBy('id', 'DESC')->get();
        return view('site.pages.discover.index', compact('articles','groups','r_articles'));
    }

    public static function article($id,$slug){
        $article = Article::find($id);
        if($article){
            $slug = ArticleTranslation::where('article_id', $id)->where('slug', $slug)->first();
            if($slug){
                $articles = Article::where('status', 1)->where('id','!=' ,$article->id)->get();
                return view('site.pages.article.index', compact('article','articles'));
            }else{
                return redirect('/articles');
            }
        }else{
            return redirect('/articles');
        }
    }

    public static function group($id){
        $groups = Group::all();
        $group_id = $id;
        $group = Group::find($id);
        $articles = $group->articles;
        $r_articles = $group->articles;
        return view('site.pages.articles.index', compact('articles','groups','group_id','r_articles'));
    }

    public function report(StoreArticleReportRequest $request){
        Article::where('id',$request->article_id)->update([
            'report' => 1,
        ]);
        $report = ArticleReport::create(RequestHelper::mergeTransAttrs($request));
        if($report)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.speak',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }
}