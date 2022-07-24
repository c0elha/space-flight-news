<?php

namespace App\Http\Services;

use App\Jobs\ProcessNewArticle;
use App\Models\Article;
use App\Models\Event;
use App\Models\Launche;
use App\Models\PopulateArticleCallLog;
use Illuminate\Support\Facades\Http;

class PopulateArticleService
{
    public function call()
    {
        $articleCount = Http::get("https://api.spaceflightnewsapi.net/v3/articles/count");

        $lastLost = PopulateArticleCallLog::orderBy('created_at', 'DESC')->first();

        $limit     = 30;
        $sortById  = 'id';
        $startWith = 0;

        if ($lastLost) {
            $startWith = $lastLost->last_id;
        }

        if ($startWith >= $articleCount->json()) {
            return true;
        }

        $response = Http::get("https://api.spaceflightnewsapi.net/v3/articles?_limit={$limit}&_sort={$sortById}&_start={$startWith}");

        foreach ($response->json() as $article) {
            if (!Article::where('id', $article['id'])->first()) {
                ProcessNewArticle::dispatch($article);
            }
        }

        PopulateArticleCallLog::create([
            'limit' => $limit,
            'start_with' => $startWith,
            'last_id' => +$startWith + +$limit,
        ]);
    }
}
