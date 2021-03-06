@extends('layouts.layout')
@section('title'){{'Contact'}}@endsection
@section('main')
    <div class="w3-panel">
        <div class="w3-row-padding" style="margin:0 -16px">
            <div class="w3-halv">
                <h5>Contact us</h5>
                <table class="w3-table w3-striped w3-white">
                    <tr>
                        <td>Name</td>
                        <td>picture</td>
                        <td>Email</td>
                        <td>Phone number</td>
                    </tr>
                    @for ($i = 0; $i < 10; $i++)
                        <tr>
                            <td>{{ $faker->name }}</td>
                            <td><i class="fas fa-user-circle fa-3x" aria-hidden="true"></i></td>
                            <td>{{ $faker->unique()->email }}</td>
                            <td>{{ $faker->numerify('06-### ## ###') }}</td>
                        </tr>
                    @endfor
                </table>
            </div>
        </div>
    </div>
@endsection
