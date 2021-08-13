<?php


namespace Iyngaran\Advertiser\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Iyngaran\Advertiser\Models\Post;

class PostedSuccessfullyMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    protected Post $post;
    protected $user;

    public function __construct(Post $post, $user)
    {
        $this->post = $post;
        $this->user = $user;
    }

    public function build(): self
    {
        $post_title = $this->post->title;
        return $this->markdown('emails.classified-advertiser.posted_successfully', [
            'post' => $this->post,
            'user' => $this->user,
        ])->subject("The post '$post_title' has been posted successfully");
    }
}
