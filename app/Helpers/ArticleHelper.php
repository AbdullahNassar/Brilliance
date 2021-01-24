<?php

namespace App\Helpers;

use App\Article;
use App\ArticleGroup;
use App\ArticleTranslation;
use Illuminate\Support\Str;
use App\Helpers\Request as RequestHelper;
use Intervention\Image\ImageManagerStatic as Image;

class ArticleHelper{
	
	public static function addArticle($request)
	{
        $avatar = $request->image_name;
        if($request->top == '1'){
            $article = Article::create(array_merge(['top' => '1','status' => '1'],RequestHelper::mergeTransAttrs($request)));
        }else{                
            $article = Article::create(array_merge(['top' => '0','status' => '1'],RequestHelper::mergeTransAttrs($request)));
        }
        if($article){
            $groups = $request->categories;
            if(!empty($groups)){
                foreach($groups as $group){
                    ArticleGroup::create([
                        'article_id' => $article->id,
                        'group_id' => $group,
                    ]);
                }
            }
            if($avatar != null) {
                Article::where('id',$article->id)->update([
                    'image' => $avatar,
                ]);
            }
            return ['data' => $article];
        }       
    }
    
    public static function draftArticle($request)
	{
        $avatar = $request->image_name;
        $article = new Article;
        $article->status = 0;
        if($request->top == '1'){
            $article->top = 1;
        }else{                
            $article->top = 0;
        }
        $article->group_id = $request->group_id;
        //$article->scholarship_id = $request->scholarship_id;
        $article->user_id = $request->user_id;
        
        if($article->save()){
            $attrs = [
                [
                    'article_id' => $article->id,
                    'title' => $request->translatedAttrs['en']['title'],
                    'slug' => $request->translatedAttrs['en']['slug'],
                    'content' => $request->translatedAttrs['en']['content'],
                    'locale' => 'en',
                ],
                [
                    'article_id' => $article->id,
                    'title' => $request->translatedAttrs['ar']['title'],
                    'content' => $request->translatedAttrs['ar']['content'],
                    'slug' => $request->translatedAttrs['ar']['slug'],
                    'locale' => 'ar',
                ]
            ];
            foreach ($attrs as $item) {
                ArticleTranslation::create($item);
            }
            if($avatar != null) {
                Article::where('id',$article->id)->update([
                    'image' => $avatar,
                ]);
            }
            $groups = $request->categories;
            if(!empty($groups)){
                foreach($groups as $group){
                    ArticleGroup::create([
                        'article_id' => $article->id,
                        'group_id' => $group,
                    ]);
                }
            }
            return ['data' => $article];
        }       
	}

    public static function editArticle($request,$id)
	{		
		if($article = Article::find($id)) {
            $avatar = $request->image_name;
            if($request->top == '1'){
                $article->update(array_merge(['top' => '1','status' => '1'],RequestHelper::mergeTransAttrs($request)));
            }else{                
                $article->update(array_merge(['top' => '0','status' => '1'],RequestHelper::mergeTransAttrs($request)));
            }
            if($article){
                ArticleGroup::where('article_id',$id)->delete();
                $groups = $request->categories;
                if(!empty($groups)){
                    foreach($groups as $group){
                        ArticleGroup::create([
                            'article_id' => $id,
                            'group_id' => $group,
                        ]);
                    }
                }
                if($avatar != null) {
                    Article::where('id',$article->id)->update([
                        'image' => $avatar,
                    ]);
                }
                return ['data' => $article];
            }       
		}
    }
    
    public static function editDraft($request,$id)
	{		
		if($article = Article::find($id)) {
            $avatar = $request->image_name;
            $article->status = 0;
            if($request->top == '1'){
                $article->top = 1;
            }else{                
                $article->top = 0;
            }
            $article->group_id = $request->group_id;
            //$article->scholarship_id = $request->scholarship_id;
            $article->user_id = $request->user_id;
            
            if($article->save()){
                ArticleTranslation::where('article_id',$id)->where('locale','en')->update([
                    'article_id' => $article->id,
                    'title' => $request->translatedAttrs['en']['title'],
                    'slug' => $request->translatedAttrs['en']['slug'],
                    'content' => $request->translatedAttrs['en']['content'],
                    'locale' => 'en',
                ]);
                ArticleTranslation::where('article_id',$id)->where('locale','ar')->update([
                    'article_id' => $article->id,
                    'title' => $request->translatedAttrs['ar']['title'],
                    'content' => $request->translatedAttrs['ar']['content'],
                    'slug' => $request->translatedAttrs['ar']['slug'],
                    'locale' => 'ar',
                ]);
                
                if($avatar != null) {
                    Article::where('id',$article->id)->update([
                        'image' => $avatar,
                    ]);
                }
                ArticleGroup::where('article_id',$id)->delete();
                $groups = $request->categories;
                if(!empty($groups)){
                    foreach($groups as $group){
                        ArticleGroup::create([
                            'article_id' => $id,
                            'group_id' => $group,
                        ]);
                    }
                }
                return ['data' => $article];
            }       
		}
	}
}