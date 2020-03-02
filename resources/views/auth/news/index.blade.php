
@extends('layouts/app')

@section('content')
<div class="container">
  <form method="POST" action="/home/news/store">
    @csrf
    <div class="form-group">
      <label for="img">Email address</label>
      <input type="text" class="form-control" id="img" name="img">
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
        <label for="title">Email address</label>
        <input  type="text" class="form-control" id="title" name="title">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
      </div>
    <div class="form-group">
      <label for="content">Password</label>
      <input type="password" class="form-control" id="content" name="content">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
@endsection



