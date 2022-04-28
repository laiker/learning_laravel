<?php

namespace App\Console\Commands;
use \Illuminate\Support\Str;
use \Illuminate\Console\Command;

class NotyNewPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:noty_new_posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Отправить все пользователям опубликованные статьи за последнюю неделю';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = \App\User::all();
        $subject = 'Новые посты за последние 7 дней';

        $posts = \App\Post::whereDate('created_at', '>', date("Y-m-d", strtotime("-7 days")))->where('published', 1)->get(); 

        $users->map->notify(new \App\Notifications\SendNewPosts($subject, $posts));
        
        $this->info('Уведомление отправлено');
    }
}
