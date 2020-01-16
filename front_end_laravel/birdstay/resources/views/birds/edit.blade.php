@extends("layout")

@section('content')
    <form method="post" action="{{ route('birds.update', ['bird' => $bird->id]) }}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <input type="hidden" name="is-female" value="false">
        <div class="field">
            <div class="control">
                <input type="text" name="tracker_id" required
                       class="input {{ $errors->has('tracker_id') ? 'is-danger' : '' }}"
                       value="{{ $bird->tracker_id }}">
            </div>
        </div>
        <div class="field">
            <div class="control">
                <input type="text" name="name" required
                       class="input {{ $errors->has('name') ? 'is-danger' : '' }}" value="{{ $bird->name }}">
            </div>
        </div>
        <div class="field">
            <label for="is-female">Vrouwelijk</label>
            <input type="checkbox" name="is-female">
        </div>
        <div class="field">
            <button type="submit">Edit Bird</button>
        </div>

    </form>
@endsection
