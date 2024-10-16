@if(session()->has($type))
<div class="alert alert-{{$type}}">
      <p>{{session($type)}}</p>
</div>
@endif