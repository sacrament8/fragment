@if($errors->any())
  <div class="alert alert-danger col-12 mt-3">
    <ul>
      @foreach($errors->all() as $message)
        <li>{{ $message }}</li>
      @endforeach
    </ul>
  </div>
@endif