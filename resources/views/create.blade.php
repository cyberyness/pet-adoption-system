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

      Add Pet Data

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

      <form method="post" action="{{ route('pets.store') }}" enctype="multipart/form-data">

        <div class="form-group">

          @csrf

          <label for="name">Name:</label>

          <input type="text" class="form-control" name="name" />

        </div>

        <div class="form-group">
          <br>
          <label for="type">Type:</label>

          <input type="text" class="form-control" name="type" />

        </div>

        <div class="form-group">
          <br>
          <label for="breed">Breed:</label>

          <input type="text" class="form-control" name="breed" />

        </div>

        <div class="form-group">
          <br>
          <label for="age">Age:</label>

          <input type="number" class="form-control" name="age" min="0">

        </div>

        <br>
        <select class="form-control" name="gender">
          <option value="">Select Gender</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>

        <div class="form-group">
          <br>
          <label for="weight">Weight:</label>

          <input type="number" class="form-control" name="weight" min="0" step="0.1">

        </div>
        <br>
        <div class="form-group">
          <label class="form-check-label" for="vaccinated">Vaccinated:</label>
          <input input class="form-check-input" type="checkbox" name="vaccinated" value="1">
        </div>
        <br>
        <select name="status" class="form-control">
          <option value="available">Available</option>
          <option value="adopted">Adopted</option>
        </select>
        <br>
        <div class="form-group">

          <label for="file_name">Picture :</label>

          <input type="file" class="form-control" name="file_name" />

        </div>
        <br>
        <button type="submit" class="btn btn-primary">Add Pet</button>

      </form>

    </div>

  </div>

@endsection