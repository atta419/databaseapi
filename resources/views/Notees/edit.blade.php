@extends('Notees.layout')

@section('content')


<div class="container"   style="padding-top: 12%">
    <div class="card ">

        <div class="card-body">

          <p class="card-text">  <span><a href="{{ route('Notees.index')}}"> back</a> </span> Notees title : {{ $Notees->title  }}  </p>
        </div>
      </div>
</div>


<div class="container" style="padding-top: 2%">
<form action="{{ route('Notees.update',$Notees->id)}}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="exampleFormControlInput1"> id</label>
        <input type="text" name="name" value="{{ $Notees->id  }} " class="form-control"  placeholder="id">
      </div>
        <div class="form-group">
          <label for="exampleFormControlInput1"> title</label>
          <input type="text" name="name" value="{{ $Notees->title  }} " class="form-control"  placeholder="Notees title">
        </div>


        <div class="form-group">
          <label for="exampleFormControlTextarea1">content  </label>
          <textarea class="form-control" name="content"   rows="3">
            {!! $Notees->content  !!}
          </textarea>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Update</button>

        </div>



    </form>
</div>





@endsection
