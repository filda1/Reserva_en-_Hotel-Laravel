@extends('admin.layouts.app')

@section('headSection')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection

@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Blank page
      <small>it all starts here</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Examples</a></li>
      <li class="active">Blank page</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Title</h3>
        
          <a class='col-lg-offset-5 btn btn-success' href="{{ route('post.create') }}">Add New</a>
       
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="box">
                    <div class="box-header">
                      <h3 class="box-title">Data Table With Full Features</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="table-responsive">
                      <table id="example1" class="table table-bordered table-striped" >
                        <thead>
                        <tr>
                          <th>S.No</th>
                          <th>picture</th>
                          <th>Creatd At</th>                   
                          <th>Edit</th>                 
                          <th>Info</th>        
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($posts as $post)
                          <tr>
                            <td># {{ $loop->index + 1 }}</td>
                            <td>{{ $post->picturehotel }}</td>
                            <td>{{ $post->name_hotel }}</td>                     
                              <td><a href="{{ route('post.edit',$post->id) }}"><span class="fa fa-pencil-square-o"></span></a></td>                                 
                            <td>
                              <form  method="post">
                              </form>
                              <a 
                              if(confirm(''))
                                  {
                            
                                  }
                                  else{
                                    event.preventDefault();
                                  }" ><span  class="fa fa-info"></span></a>
                            </td>
                    
                          </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                      
                        <tr>
                                  
                        </tr>
                        </tfoot>
                      </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        Footer
      </div>
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('footerSection')
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script>
  $(function () {
    $("#example1").DataTable();
  });
</script>
@endsection