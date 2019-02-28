<?php

namespace App\Observers;
//
// use App\Handlers\SlugTranslateHandler;
//資料表
use App\Models\Topic;
use App\Jobs\TranslateSlug;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{
    public function creating(Topic $topic)
    {
        //
    }

    public function updating(Topic $topic)
    {
        //
    }

    public function saving(Topic $topic)
    {
        // XSS 过滤
        $topic->body = clean($topic->body, 'user_topic_body');
        
        // 生成话题摘录
        $topic->excerpt = make_excerpt($topic->body);

        // 如 slug 字段无内容，即使用翻译器对 title 进行翻译
        // if(! $topic->slug) {
        //     // $topic->slug = app(SlugTranslateHandler::class)->translate($topic->title);

        //     // if (trim($topic->slug) === 'edit') {
        //     //     $topic->slug = 'edit-slug';
        //     // }
        //     // 推送任务到队列
        //     dispatch(new TranslateSlug($topic));
        // }
    }

    public function saved(Topic $topic) {
        if(!$topic->slug) {
            // 如 slug 字段无内容，即使用翻译器对 title 进行翻译
            // 推送任务到队列
            dispatch(new TranslateSlug($topic));
        }
    }
}