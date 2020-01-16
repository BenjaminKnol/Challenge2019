@extends("layout")

    <!DOCTYPE html>
<html style="height: 100%">
<title>Bird stay dashboard</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<style>
    html, body, h1, h2, h3, h4, h5 {
        font-family: "Raleway", sans-serif
    }
</style>

@section('main')
    <form method="post" action="{{ route('birds.store') }}">
        {{ csrf_field() }}
        <input type="hidden" name="is-female" value="false">
        <div class="field">
            <div class="control">
                <input type="text" name="tracker_id" placeholder="tracker id" required
                       class="input {{ $errors->has('tracker_id') ? 'is-danger' : '' }}"
                       value="{{ old('tracker_id') }}">
            </div>
        </div>
        <div class="field">
            <div class="control">
                <input type="text" name="name" placeholder="Naam" required
                       class="input {{ $errors->has('name') ? 'is-danger' : '' }}" value="{{ old('name') }}">
            </div>
        </div>
        <div class="field">
            <label for="is-female">Vrouwelijk</label>
            <input type="checkbox" name="is-female">
        </div>
        <div class="field">
            <button type="submit">Create Bird</button>
        </div>

        <div class="notification is-danger">
            <ul>
                @foreach ($errors->all() as $message)
                    <li>
                        {{$message}}
                    </li>
                @endforeach
            </ul>
        </div>

    </form>

@endsection

