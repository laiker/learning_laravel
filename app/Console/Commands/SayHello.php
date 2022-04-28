<?php

namespace App\Console\Commands;
use \Illuminate\Support\Str;
use \Illuminate\Console\Command;

class SayHello extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:say_hello 
        {users* : Пользователи} 
        {--subject=No Subject : Заголовок письма} 
        {--c|class : Преобразовать в имя класса camelCase}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Отправить привет пользователю';

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
        $users = \App\User::findOrFail($this->argument('users'));
        $subject = $this->option('subject');
        
        if($this->option('class')){
            $subject = Str::studly($subject);
        }

        $users->map->notify(new \App\Notifications\SayHello($subject));

        $this->info('Уведомление отправлено');
    }
}
