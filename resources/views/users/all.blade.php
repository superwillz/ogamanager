@extends('layouts.app')

@section('content')
  <div class="panel-body">
      @include('partials.flash_message')

      <h4>View All Users</h4><hr>

    <div class="row">
      <div class="col col-md-3">
          @include('partials.navbar');
      </div>

      <div class="col col-md-9 menu_action_box">
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="row">Name</th>
              <th scope="row">Email</th>
              <th scope="row">Type</th>
              <th scope="row">Date Added</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users AS $user)
              <tr>
                <td>
                  @if($user->type != 'admin')
                    <a href="/user/{{ $user->id }}/delete" onclick="return confirm('Are You Sure You Want to Delete {{ $user->name }}\'s Account? This process can\'t be undone')" class="btn btn-xs btn-danger">x</a> 
                  @endif
                  &nbsp; 
                  <a href="/user/{{ $user->id }}/edit" title="Click to Edit/Modify">{{ $user->name }}</a></td>
                <td>{{ $user->email }}</td>
                <td>
                  {{ ucfirst($user->type) }}<br>
                  <small>
                    @if($user->type == 'staff')
                      <a href="/user/{{ $user->id }}/make/manager">Change to Manager</a>
                    @elseif($user->type == 'manager')
                      <a href="/user/{{ $user->id }}/make/staff">Change to Staff</a>
                    @endif  
                  </small>
                </td>
                <td>{{ $user->created_at }}</td>
              </tr>
            @endforeach
          
          </tbody>
        </table>
      </div>
    </div>

  </div>
@endsection
