@component('mail::message')
Hello {{$user->first_name}},

Your new post {{$post->title}} has been posted successfully and its under the review.

We will review your post and publish on our website ASAP.

See you again!,<br>
Team "{{ config('app.name') }}"
@endcomponent
