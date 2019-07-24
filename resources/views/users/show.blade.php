@extends('layouts.app')
@section('content')
<div class="container mt-5">
  <h2 class="text-center mb-3">User Infomation</h2>
  <table class="table table-dark">
    <tr>
      <thead>
        <th>ID</th>
        <th>user_name</th>
        <th>email</th>
      </thead>
    </tr>
    <tr>
      <tbody>
        <td>
          {{ $current_user->id }}
        </td>
        <td>
          {{ $current_user->name }}
        </td>
        <td>
          {{ $current_user->email }}
        </td>
      </tbody>
  </table>
</div>
<a href="{{ route('users.edit', ['id' => $current_user->id]) }}" class="btn btn-primary">ユーザー情報変更</a>
@endsection