@extends('layouts.pagebuilder.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                      
                        <a href="/" class="btn btn-sm btn-primary">Back</a>
                        <div style="display: flex">
                        <button onclick="addPage()" type="button" class="btn btn-sm btn-success"><i class="fas fa-plus"></i></button> 
                        <form action="{{route('logout')}}" method="POST" class="ml-3">
                          @csrf
                          <button class="btn btn-danger btn-sm" type="submit"><i class="fas fa-power-off"></i></button>
                        </form>

                      </div>
                    </div>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Layouts</th>
                        <th scope="col">URI</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($pageList as $key => $list)
                      <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$list->name}}</td>
                        <td>{{$list->layout}}</td>
                        <td><span class="badge badge-light">{{$list->uri}}</span></td>
                        <td>
                            <a href="{{url('/').$list->uri}}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                            <a class="btn btn-warning btn-sm" href="{{url('/')}}/admin/pages/build?page={{$list->id}}"><i class="fas fa-edit"></i></a>
                            <form style="display: inline" action="{{route('pages.delete',$list->id)}}" method="POST">
                              @csrf
                              @method('delete')
                              <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                            </form>
                            
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
     
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{route('pages.create')}}" method="POST">
                @csrf
                  <div class="form-group">
                      <label for="name" >Page Name</label>
                      <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter Page Name" value="{{old('name')}}">
                      @error('name')
                      <div class="invalid-feedback">
                       {{$message}}
                      </div>
                      @enderror
                  </div>

                  <div class="form-group">
                    <label for="uri" >URI</label>
                    <input type="text" class="form-control @error('uri') is-invalid @enderror" name="uri" placeholder="Enter page URI" value="{{old('uri')}}">
                    @error('uri')
                    <div class="invalid-feedback">
                     {{$message}}
                    </div>
                    @enderror

                    <p class="alert alert-warning mt-3">please slash before URI. eg: /test</p>
                </div>


                  <div class="form-group">
                    <label for="layouts" >Select Layouts</label>
                    <select name="layouts" id="layouts" class="form-control @error('layouts') is-invalid @enderror">
                      {{old('layouts')}}
                        <option value="master" @if (old('layouts') == 'master') selected="selected" @endif>master</option>
                        <option value="onepage" @if (old('layouts') == 'onepage') selected="selected" @endif>onepage</option>
                    </select>
                    @error('layouts')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">ADD</button>
              </form>
            </div>

          </div>
        </div>
      </div>
@endsection
@push('js')
@if($errors->any())
<script>
  $(document).ready(function(){
    $("#exampleModal").modal('show')
});
</script>
@endif
<script>
    
    function addPage(){
        $("#exampleModal").modal('show')
    }

</script>
@endpush