@extends('layouts.app')

@section('pageTitle')
    Users
@endsection

@section('content')
    <h1 class="heading-xlarge">Users</h1>
    <p>This is a list of users currently registered on the system. The password has been provided separately.</p>
    <table>
        <thead>
        <tr>
            <th>Username</th>
            <th>Name</th>
            <th>Role(s)</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->username }}</td>
            <td>{{ $user->person->full_name }}</td>
            <td>
                @foreach($user->roles as $role)
                {{ $role->name }}
                @if (!$loop->last)
                    ,
                @endif
                @endforeach
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection
