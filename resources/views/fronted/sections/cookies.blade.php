<div class="cookies-message p-4 {{$general->cookies_style}}">
	<div class="p-4 shadow text-{{$general->cookies_alignment}} {{$general->cookies_color}}">
		@if ($general->cookies_title != '')
			<h3 class="mb-3">{{$general->cookies_title}}</h3>
        @endif
        @if ($general->cookies_text != '')
            <div class="cookies-message-content mb-3">{!!$general->cookies_text!!}</div>
        @endif
		<button type="button" class="btn m-0 cookies-close">
            {{__('content.accept')}}
        </button>
	</div>
</div>