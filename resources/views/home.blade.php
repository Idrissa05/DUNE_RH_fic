@extends('layouts.app')

@section('content')

    <div class="main-card card mb-3">
        <div class="card-header">Dashboard</div>


        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>email</th>
                <th>actions</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>Khall</td>
                <td>Khall@site.com</td>
                <td>
                    <a href="" class="btn btn-sm btn-outline-info"><i class="fa fa-edit"></i></a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
