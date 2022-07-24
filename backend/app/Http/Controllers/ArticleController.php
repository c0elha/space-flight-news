<?php

namespace App\Http\Controllers;

use App\Http\Services\PopulateArticleService;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return LengthAwarePaginator
     */
    public function index(Request $request)
    {
        $search = $request->search ?? null;
        $filter = $request->filter ?? null;

        $articles = Article::orderBy('publishedAt', ($filter && $filter === 'old') ? 'ASC' : 'DESC');

        if ($search) {
            $articles->where('title', 'like', '%' . $request->search . '%');
        }

        $count = $articles->count();
        $per_page = 10;
        $current_page = $request->page ?: 1;

        $responses = $articles->skip($per_page * ($current_page - 1))->take($per_page)->get();

        return new LengthAwarePaginator($responses, $count, $per_page, $current_page, [
            'path' => request()->url(),
            'query' => request()->query(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $article = Article::create([
            'id' => $request->id,
            'featured' => $request->featured,
            'title' => $request->title,
            'url' => $request->url,
            'imageUrl' => $request->imageUrl,
            'newsSite' => $request->newsSite,
            'summary' => $request->summary,
            'publishedAt' => $request->publishedAt,
        ]);

        return response()->json($article, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Article $article
     * @return JsonResponse
     */
    public function show(Article $article)
    {
        return response()->json($article);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param Article $article
     * @return JsonResponse
     */
    public function update(Request $request, Article $article)
    {
        $article->update([
            'featured' => $request->featured,
            'title' => $request->title,
            'url' => $request->url,
            'imageUrl' => $request->imageUrl,
            'newsSite' => $request->newsSite,
            'summary' => $request->summary,
            'publishedAt' => $request->publishedAt,
        ]);

        return response()->json($article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Article $article
     * @return JsonResponse
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return response()->json();
    }
}
