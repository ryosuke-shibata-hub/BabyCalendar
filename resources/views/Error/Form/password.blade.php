@if ($errors->has('password'))
  <p class="text-danger">{{$errors->first('password')}}</p>
@endif
