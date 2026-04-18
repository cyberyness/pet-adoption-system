@extends('layout')
@section('content')
  <style>
    .uper {
      margin-top: 40px;
    }
  </style>

  <div class="uper">

    @if(session()->get('success'))

      <div class="alert alert-success">

        {{ session()->get('success') }}

      </div><br />

    @endif

    @if(session()->get('error'))

      <div class="alert alert-danger">

        {{ session()->get('error') }}

      </div><br />

    @endif

    <a href="{{ route('pets.create')}}" class="btn btn-success">+ ADD</a>

    <div class="float-end">

      <a href="{{ route('home') }}" class="btn btn-outline-dark">Home</a>

      {{ Auth::user()->name }}

      <a href="{{ route('logout') }}" class="btn btn-dark"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

        {{ __('Logout') }}

      </a>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">

        @csrf

      </form>

    </div>

    <table class="table table-striped mt-4">

      <thead class="table-dark">

        <tr>

          <td class="text-center">ID</td>

          <td class="text-center">Pet Name</td>

          <td class="text-center">Image</td>

          <td class="text-center">Type</td>

          <td class="text-center">Breed</td>

          <td class="text-center">Age</td>

          <td class="text-center">Gender</td>

          <td class="text-center">Weight</td>

          <td class="text-center">Vaccinated</td>

          <td class="text-center">Status</td>

          <td class="text-center" colspan="3">Action</td>

        </tr>

      </thead>

      <tbody>

        @foreach($pets as $pet)

          <tr>

            <td class="text-center">{{ $pet->id}}</td>

            <td class="text-center">{{ $pet->name }}</td>

            <td class="align-middle text-center">

              @if($pet->file_name)

                <img class="rounded" src="{{ asset('pics/' . $pet->file_name) }}" width="100">

              @else

                <img src="https://img.icons8.com/color/help" width="50">
              @endif

            </td>

            <td class="text-center">{{$pet->type}}</td>

            <td class="text-center">{{$pet->breed}}</td>

            <td class="text-center">{{$pet->age}}</td>

            <td class="text-center">{{$pet->gender}}</td>

            <td class="text-center">{{$pet->weight}}</td>

            <td class="text-center">
              @if($pet->vaccinated)
                <span class="badge bg-success">Yes</span>
              @else
                <span class="badge bg-danger">No</span>
              @endif
            </td>

            <td class="text-center">
              @if($pet->status == 'available')
                <span class="badge bg-success">Available</span>
              @else
                <span class="badge bg-secondary">Adopted</span>
              @endif
            </td>

            <td> @if(Auth::user()->isAdmin == 1 || Auth::user()->id == $pet->user_id)

              <a href="{{ route('pets.edit', $pet->id)}}" class="btn btn-primary">Edit</a>

            @endif

            </td>

            <td>

              @if(Auth::user()->isAdmin == 1 || Auth::user()->id == $pet->user_id)

                <form action="{{ route('pets.destroy', $pet->id)}}" method="post"
                  onsubmit="return confirm('The record will be deleted');">

                  @csrf

                  @method('DELETE')

                  <button class="btn btn-danger" type="submit">Delete</button>

                </form>

              @endif

            </td>

            <td>
              @if(Auth::user()->isAdmin == 1 && $pet->status == 'available')
                <form action="{{ route('pets.adopt', $pet->id) }}" method="POST" style="display:inline;"
                  onsubmit="return confirm('The Pet will be adopted');">
                  @csrf
                  @method('PATCH')
                  <button class="btn btn-success">Adopt</button>
                </form>
              @endif
            </td>

          </tr>

        @endforeach

      </tbody>

    </table>

    {{$pets->links()}}

  </div>

@endsection