<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer">

    <title>Input Data</title>
  </head>
  <body>
    <h1 class="text-center mb-4">Input Data Cleaning Status</h1>

    <div class="container">
      <div class="row">
        <div class="col"><a href="/tambahcustomer" class="btn btn-success mb-1">Tambah +</a></div>        
        <div class="col-auto"><a href="/exportpdf" class="btn btn-info">Export PDF</a></div>
        <div class="col-auto"><a href="/exportexcel" class="btn btn-success">Export Excel</a></div>
        </div>
        <div class="row">
          <div class="col">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Import Excel
            </button></div>
        <div class="col-auto">
            <form action="/customer" method="GET">            
            <input type="search" id="inputPassword5" name="search" class="form-control mb-2" aria-describedby="passwordHelpBlock">
            <input type="submit" value="search">
          </form>
        </div>
        </div>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import Data Room</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/importexcel" method="post" enctype="multipart/form-data">
      @csrf
      <div class="modal-body">
        <div class="form-group">
          <input type="file" name="file" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </form>
  </div>
</div>    


        <div class="row">
          {{-- @if ($massage = Session::get('success'))
          <div class="alert alert-success" role="alert">
            {{$massage}}
          </div>
              
          @endif --}}
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Customer</th>
                    <th scope="col">Room</th>
                    <th scope="col">Cleaning Status</th>
                    <th scope="col">Created</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                      $no = 1;
                  @endphp
                @foreach ($data as $index => $row)
                <tr>
                    <th scope="row">{{$index + $data->firstItem() }}</th>
                    <td>{{$row->nama}}</td>
                    <td>{{$row->room}}</td>
                    <td>{{$row->cleaningstatus}}</td>
                    <td>{{$row->created_at->format('d M Y')}}</td>
                    <td>
                        <a href="/tampilkandata/{{$row->id}}" class="btn btn-info">Edit</a>
                        <a href="#" class="btn btn-danger delete" data-id="{{$row->id}}" 
                          data-room="{{$row->room}}">Delete</a>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
              {{ $data->links() }}
        </div>

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
    crossorigin="anonymous"></script>

    <!--jquery cdn-->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" 
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
    crossorigin="anonymous"></script>

    <!--sweet alert-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <!--toastr cdn-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" 
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" 
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
  <script>
    $('.delete').click(function(){
      var customerid = $(this).attr('data-id');
      var room = $(this).attr('data-room');

      swal({
      title: "Apakah kamu yakin?",
      text: "Setelah dihapus, Anda tidak akan dapat memulihkan data room "+room+" !",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location = "/delete/"+customerid+""
        swal("Poof! Data Anda telah dihapus!!", {
          icon: "success",
        });
      } else {
        swal("Data Anda Aman!");
      }
    });
    });
    </script>

<!--Set a success toast, with a title-->
<script>
@if (Session::has('success'))
    toastr.success("{{Session::get('success')}}")
@endif
    </script>
</html>