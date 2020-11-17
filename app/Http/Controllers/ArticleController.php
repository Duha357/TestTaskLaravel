<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ArticleController extends Controller
{
    public function getPagination(Request $request)
    {
        $count = $request->input('count', 10);
        $articles = Article::orderBy('created_at', 'desc')->paginate($count);

        return response()->json([
            'status' => '200',
            'articles' => $articles,
        ]);
    }

    public function getPaginationView()
    {
        $articles = Article::orderBy('created_at', 'desc')->paginate(10);

        return view('articles', ['articles' => $articles]);
    }

    public function get($id)
    {
        $article = Article::findOrFail($id);

        Log::error($article->get());

        return view('article_detail', ['article' => $article]);
    }

    public function getLikes($id)
    {
        $pivotRelations = DB::table('article_user')
            ->where('article_id', '=', $id)
            ->where('like', '=', 1)
            ->get();

        return response()->json([
            'status' => '200',
            'likes' => $pivotRelations->count()
        ]);
    }

    public function setLike(Request $request)
    {
        $this->validate($request, [
            'articleId' => 'required|integer|min:1',
            'like' => 'required|boolean',
        ]);

        $articleId = $request->input('articleId');

        DB::table('article_user')->insert([
            'article_id' => $articleId,
            'like' => $request->input('like'),
        ]);

        $pivotRelations = DB::table('article_user')
            ->where('article_id', '=', $articleId)
            ->where('like', '=', 1)
            ->get();

        return response()->json([
            'status' => '200',
            'likes' => $pivotRelations->count()
        ]);
    }

    public function getViews($id)
    {
        $pivotRelations = DB::table('article_user')
            ->where('article_id', '=', $id)
            ->where('view', '=', 1)
            ->get();

        return response()->json([
            'status' => '200',
            'views' => $pivotRelations->count()
        ]);
    }

    public function setView(Request $request)
    {
        $this->validate($request, [
            'articleId' => 'required|integer|min:1',
            'view' => 'required|boolean',
        ]);

        $articleId = $request->input('articleId');

        DB::table('article_user')->insert([
            'article_id' => $articleId,
            'view' => $request->input('view'),
        ]);

        $pivotRelations = DB::table('article_user')
            ->where('article_id', '=', $articleId)
            ->where('view', '=', 1)
            ->get();

        return response()->json([
            'status' => '200',
            'views' => $pivotRelations->count()
        ]);
    }
}
