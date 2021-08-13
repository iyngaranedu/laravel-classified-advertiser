<?php


namespace Iyngaran\Advertiser\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Iyngaran\Advertiser\Mail\PostedSuccessfullyMail;
use Iyngaran\Advertiser\Models\Post;

class SendPostedSuccessfullyMail implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected Post $post;
    protected $user;

    public function __construct(Post $post, $user)
    {
        $this->post = $post;
        $this->user = $user;
    }

    public function handle()
    {
        Mail::to($this->user)->queue(new PostedSuccessfullyMail($this->post));
    }
}
