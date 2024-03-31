<div>
    <h1>Dear {{$post->user->name}}!</h1>
    <h5>You created post on {{ $post->created_at }}</h5>
    <div>{{ $post->title }}</div>
    <div>{{ $post->short_content }}</div>
    <div>{{ $post->content }}</div>
    <strong>Thanks</strong>
</div>