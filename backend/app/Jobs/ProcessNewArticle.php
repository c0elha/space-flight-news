<?php

namespace App\Jobs;

use App\Models\Article;
use App\Models\Event;
use App\Models\Launche;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessNewArticle implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $article;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $article)
    {
        $this->article = $article;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->article['launches']) {
            foreach ($this->article['launches'] as $launch) {
                $this->_launchesUpdateOrCreate($launch['id'], $launch['provider']);
            }
        }

        if ($this->article['events']) {
            foreach ($this->article['events'] as $event) {
                $this->_eventsUpdateOrCreate($event['id'], $event['provider']);
            }
        }

        $articleCreate = $this->_articlesCreateOrUpdate($this->article);

        $launches = $this->article['launches'] ? array_map(fn($launch): string => $launch['id'], $this->article['launches']) : [];
        $articleCreate->launches()->sync($launches);

        $events = $this->article['events'] ? array_map(fn($event): string => $event['id'], $this->article['events']) : [];
        $articleCreate->events()->sync($events);
    }

    private function _launchesUpdateOrCreate(string $id, string $provider)
    {
        Launche::updateOrCreate(
            ['id' => $id],
            ['provider' => $provider]
        );
    }

    private function _eventsUpdateOrCreate(string $id, string $provider)
    {
        Event::updateOrCreate(
            ['id' => $id],
            ['provider' => $provider]
        );
    }

    private function _articlesCreateOrUpdate(array $data)
    {
        return Article::create([
                'id' => $data['id'],
                'featured' => $data['featured'],
                'title' => $data['title'],
                'url' => $data['url'],
                'imageUrl' => $data['imageUrl'],
                'newsSite' => $data['newsSite'],
                'summary' => $data['summary'],
                'publishedAt' => $data['publishedAt'],
            ]);
    }
}
