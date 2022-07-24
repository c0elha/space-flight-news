<?php

namespace App\Console\Commands;

use App\Http\Services\PopulateArticleService;
use App\Jobs\ProcessNewArticle;
use App\Models\Article;
use App\Models\PopulateArticleCallLog;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class PopulateDailyArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'populate:daily-articles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Popula novos artigos todos os dias';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        (new PopulateArticleService())->call();
    }
}
