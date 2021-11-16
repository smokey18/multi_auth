@if($message->from_user == \Auth::user()->id)

<div class="row msg_container base_sent" data-message-id="{{ $message->id }}" id="message-line-{{$message->id}}">
    <div class="col-md-9 col-xs-9">
        <div class="messages msg_sent text-right">
            @if($message->content)
            <p>{!! $message->content !!}</p>
            @elseif($message->image)
            <div style="width: 100%;"><img class="img-responsive" src="{{$message->image_url}}" /></div>
            @endif
            <time
                datetime="{{ date("Y-m-dTH:i", strtotime($message->created_at->toDateTimeString())) }}">{{ $message->fromUser->name }}
                • {{ $message->created_at->diffForHumans() }}</time>
        </div>
    </div>
    <div class="col-md-3 col-xs-3 avatar">
        <img src="{{ url('images/user-avatar.png') }}" width="50" height="50" class="img-responsive">
    </div>
</div>

@else

<div class="row msg_container base_receive" data-message-id="{{ $message->id }}" id="message-line-{{$message->id}}">
    <div class="col-md-3 col-xs-3 avatar">
        <img src="{{ url('images/user-avatar.png') }}" width="50" height="50" class=" img-responsive ">
    </div>
    <div class="col-md-9 col-xs-9">
        <div class="messages msg_receive text-left">
            @if($message->content)
            <p>{!! $message->content !!}</p>
            @elseif($message->image)
            <div style="width: 100%;"><img class="img-responsive" src="{{$message->image_url}}" /></div>
            @endif
            <time
                datetime="{{ date("Y-m-dTH:i", strtotime($message->created_at->toDateTimeString())) }}">{{ $message->fromUser->name }}
                • {{ $message->created_at->diffForHumans() }}</time>
        </div>
    </div>
</div>

@endif