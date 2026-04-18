@extends('layout')


@section('content')

  <style>
    .uper {

      margin-top: 40px;

    }
  </style>
  <div class="d-flex justify-content-between align-items-center uper">

    <a href="{{ route('home') }}" class="btn btn-outline-dark">
      Home
    </a>

    <div class="d-flex align-items-center gap-3">

      <span class="fw-bold">
        {{ Auth::user()->name }}
      </span>

      <a href="{{ route('logout') }}" class="btn btn-dark"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Logout
      </a>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>

    </div>
  </div>
  <div class="card uper">

    <div class="card-header bg-dark text-white">

      Edit Pet Data

    </div>

    <div class="card-body">

      @if ($errors->any())

        <div class="alert alert-danger">

          <ul>

            @foreach ($errors->all() as $error)

              <li>{{ $error }}</li>

            @endforeach

          </ul>

        </div><br />

      @endif

      <form method="post" action="{{ route('pets.update', $pet->id) }}" enctype="multipart/form-data">

        <div class="form-group">

          @csrf

          @method('PATCH')

          <label for="name">Name:</label>

          <input type="text" class="form-control" name="name" value="{{$pet->name}}" />

        </div>

        <br>
        <div class="form-group">

          <label for="type">Type:</label>

          <input type="text" class="form-control" name="type" value="{{$pet->type}}" />

        </div>

        <div class="form-group">
          <br>
          <label for="breed">Breed:</label>

          <input type="text" class="form-control" name="breed" value="{{$pet->breed}}" />

        </div>

        <div class="form-group">
          <br>
          <label for="age">Age:</label>

          <input type="number" class="form-control" name="age" min="0" value="{{$pet->age}}">

        </div>

        <br>
        <select class="form-control" name="gender">
          <option value="">Select Gender</option>
          <option value="male" {{ $pet->gender == 'male' ? 'selected' : '' }}>Male</option>
          <option value="female" {{ $pet->gender == 'female' ? 'selected' : '' }}>Female</option>
        </select>

        <div class="form-group">
          <br>
          <label for="weight">Weight:</label>

          <input type="number" class="form-control" name="weight" min="0" step="0.1" value="{{$pet->weight}}">

        </div>
        <br>
        <div class="form-group">
          <label class="form-check-label" for="vaccinated">Vaccinated:</label>
          <input class="form-check-label" type="checkbox" name="vaccinated" value="1" {{ $pet->vaccinated ? 'checked' : '' }}>
        </div>
        <br>
        <select name="status" class="form-control">
          <option value="available">Available</option>
          <option value="adopted">Adopted</option>
        </select>
        <div class="form-group mt-3">
          <label for="file_name">Pet Image:</label>
          <input type="file" class="form-control" name="file_name">
        </div>
        <br>
        @if($pet->file_name)
          <img src="{{ asset('pics/' . $pet->file_name) }}" width="100">
        @endif
        <br><br>
        <button type="submit" class="btn btn-primary">Update Data</button>

      </form>


    </div>

  </div>

@endsection