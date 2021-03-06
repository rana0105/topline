@extends('admin.layouts.app')
@section('content')
    
<div class="page-content fade-in-up">
{{-- Add Sliders Modal --}}

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog  modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLongTitle">Create Menu</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form enctype="multipart/form-data" action="{{url('/grocery_menu/store')}}" method="post">
  @csrf
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-6 form-group">
                <label for="Max Value">Menu</label>
                <input class="form-control" required  type="text" name="menu">
            </div> 
            <div class="col-sm-6 form-group">
              <label for="Max Value">Icon</label>
              <input class="form-control" type="text" name="icon">
          </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="reset" class="btn btn-primary" >Clear</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Submit</button>
    </div>
</form>
</div>
</div>
</div>

{{-- Edit slider Modal --}}

<div class="modal fade" id="exampleModalCenter_edit" tabindex="-1" role="dialog"
aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog   modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Update Form</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
<form enctype="multipart/form-data" action="{{url('/grocery_menu/update')}}" method="post" >
        @csrf
    <div class="modal-body">
                    <div class="row">
          <div class="col-sm-6 form-group">
          <label for="Max Value">Menu</label>
              <input class="form-control menu"  type="text" name="menu">
              <input class="cId" type="hidden" name="id" id="id">
          </div>
          <div class="col-sm-6 form-group">
          <label for="Max Value">Icon</label>
           <input class="form-control icon"  type="text" name="icon">
          </div>        
          <div class="col-sm-6 form-group">
                    <label for="Max Value">Sort</label>
                    <input class="form-control sort" min="1" type="number" name="sort">
              </div>
            </div>
          </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Update</button>
    </div>
   </form>
   </div>
</div>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-12">
    <div class="row">
        <div class="col-md-6"><h5 class="m-0 font-weight-bold "> Grocery Menu List</h5></div>
        <div class="col-md-6">
                <button type="button" class="btn btn-success fa-pull-right" data-toggle="modal" data-target="#exampleModalCenter" >
                    New Menu                
            </button>
        </div>
    </div>
  </div>
</div> 
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>SL</th>
              <th>Menu</th>
              <th>Icon</th>
              <th>Sort</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $me=1; ?>
            @foreach($menu as $Value)
            <tr>
            <td>{{$me++}}</td>
            <td>{{$Value->menu}}</td>
            <td><i class="{{$Value->icon}}" aria-hidden="true"></i></td>
              <td>{{$Value->sort}}</td>
               <td>
              <button onclick= 'edit({{$Value->id}});'  data-toggle="modal" id="edit" data-target="#exampleModalCenter_edit" class=" btn btn-sm btn-info btn-circle">
                  <span></span>  <i class="fas fa-edit"></i>
              </button>
            
              <a href="{{ url('/grocery_menu/delete/'.$Value->id) }}"  onclick="return confirm('Are you sure to delete this');" class="btn btn-sm btn-danger btn-circle">
                    <i class="fas fa-trash"></i>
              </a>
              
            </td> 
            </tr> 
            @endforeach          
          </tbody>
        </table>
      </div>
    </div>
  </div>  
<script>
  function edit(id) {
          var x =id;
          
          $.ajax({
              type:'GET',
              url:"{{url('grocery_menu/edit')}}/"+x,
              success:function(response){
                  console.log(response);
                  $('.menu').val(response.menu);
                  $('.cId').val(response.id);
                  $('.icon').val(response.icon);
                  $('.sort').val(response.sort);                                        
  
              },
              error:function(xhr,status,error){
                  console.log(error);
                  
              }
  
          });
      }
  $(document).ready(function(){
  });   
          
  </script>
@endsection