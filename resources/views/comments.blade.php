@php 
    $comments = $comments ?? collect();
@endphp

<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="comments">
       
        <div class="comments-details">
          <span class="total-comments comments-sort">{{$comments->count()}} - комментариев</span>  
        </div>
        @include('layout.errors')
        <div class="comment-box add-comment">
          <span class="commenter-pic">
            <img src="https://uiuxstream.com/images/user-icon.jpg" class="img-fluid">
          </span>
          <span class="commenter-name">
            <form method="POST" action="/{{request()->path()}}/comment">
                @csrf
                <input type="text" placeholder="Введите текст комментария" required name="text">
                <button type="submit" class="btn btn-default">Добавить комментарий</button>
            </form>
          </span>
        </div>
        @foreach($comments as $comment)
            <div class="comment-box">
            <span class="commenter-pic">
                <img src="https://uiuxstream.com/images/user-icon.jpg" class="img-fluid">
            </span>
            <span class="commenter-name">
                <strong>{{$comment->user->name}}</strong> <span class="comment-time">{{$comment->created_at}}</span>
            </span>       
            <p class="comment-txt more">{{$comment->text}}</p>
            <div class="comment-box add-comment reply-box">
                <span class="commenter-pic">
                <img src="/images/user-icon.jpg" class="img-fluid">
                </span>
            </div>
            </div>
        @endforeach
      </div>
    </div>
  </div>
</div>