@extends('Notees.layout')

@section('content')
    <div class="row mt-5 mb-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2> index</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('Notees.create') }}"> Create Notees</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th width="20px" class="text-center">No</th>
            <th></th>
            <th width="280px"class="text-center">Action</th>
        </tr>
        @foreach ($Notees as $Notee)
        <tr>
            <td class="text-center">{{ ++$i }}</td>
            <td>{{ $Notee->title }}</td>
            <td class="text-center">
                <form action="{{ route('posts.destroy',$Notee->id) }}" method="POST">

                    <a class="btn btn-info btn-sm" href="{{ route('posts.show',$Notee->id) }}">Show</a>

                    <a class="btn btn-primary btn-sm" href="{{ route('posts.edit',$Notee->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {!! $Notees->links() !!}

@endsection
