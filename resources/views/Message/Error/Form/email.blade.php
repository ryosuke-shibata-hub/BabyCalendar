@if ($errors->has('email'))
  <p class="text-danger">{{$errors->first('email')}}</p>
@endif
