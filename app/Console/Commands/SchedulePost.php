<?php

namespace App\Console\Commands;

use App\Enums\Status;
use App\Jobs\PublishPost;
use Illuminate\Console\Command;
use App\Models\Post;

class SchedulePost extends Command 
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:schedule-post';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scan and send schedule post every minute';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Post::where('publish_at','<=',now())->update(array('status'=>Status::Publish));
        PublishPost::dispatch();
    }
}
