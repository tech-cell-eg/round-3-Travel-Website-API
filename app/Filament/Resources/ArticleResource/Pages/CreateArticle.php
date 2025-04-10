<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use Filament\Actions;
use App\Models\Newsletter;
use App\Mail\NewArticleNotification;
use Illuminate\Support\Facades\Mail;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\ArticleResource;

class CreateArticle extends CreateRecord
{
    protected static string $resource = ArticleResource::class;


    protected function afterCreate(): void
    {
        $article = $this->record;

        Newsletter::chunk(100, function ($subscribers) use ($article) {
            foreach ($subscribers as $subscriber) {
                Mail::to($subscriber->email)
                    ->queue(new NewArticleNotification($article));
            }
        });

        Notification::make()
            ->title('Article created and newsletter notifications queued')
            ->success()
            ->send();
    }
}
