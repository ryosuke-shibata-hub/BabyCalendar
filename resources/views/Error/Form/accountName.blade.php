@if ($errors->has('accountName'))
  <p class="text-danger">{{$errors->first('accountName')}}</p>
@endif
