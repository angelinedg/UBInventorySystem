
<html>
 <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>UNIVERSITY OF BAGUIO</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

  <script src="/alert.js"></script>

 </head>
 <body>
    <div clas='col'>
  <div class="container">    
     <br />
     <div class="jumbotron">
          <h2><center><img src="{{URL::asset('/user.png')}}" alt="profile Pic" height="50" width="50">Users</center></h2>
    
      </div>
     <br />
     <div align="right">
      <!--<button type="button" name="CreateUser" id="CreateUser" class="btn btn-success btn-sm">Create User</button>-->
      <a href="{{ route('home') }}" type="button" name="home"  class="btn btn-success btn-sm">Back to home</a>
      <!--<a href="{{ route('Ctrash') }}" type="button" name="home"  class="btn btn-success btn-sm">Trash</a>-->

     </div>
     <br />
   <div class="table-responsive">
    <table class="table table-bordered table-striped" id="user_table">
           <thead>
            <tr>
                <th width="20%">Name</th>
                <th width="35%">Email</th>
                <th width="15%">Admin</th>
                <th width="30%">Action</th>
            </tr>
           </thead>
       </table>
   </div>
   <br />
   <br />
  </div>
</div>
 </body>
</html>

<div id="UserFormModal" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modaluser">Change Role</h4>
         
        </div>
        <div class="modal-body">
         <span id="FormUser"></span>
         <form method="post" id="UserForm" class="form-horizontal" enctype="multipart/form-data">
          @csrf

          <div class="form-group">
            <label class="control-label col-md-4" >Name : </label>
            <div class="col-md-8">
             <input type="text" name="name" id="name" class="form-control" />
            </div>
           </div>
           <div class="form-group">
            <label class="control-label col-md-4">Email : </label>
            <div class="col-md-8">
             <input type="text" name="email" id="email" class="form-control" />
            </div>
           </div>

          <div class="form-group">
            <label for="admin" class="control-label col-md-4">Admin</label>
            <div class="col-md-8">
            <select class="form-control" name="admin" id="admin">
              <option selected>Select</option>
              <option value="0">Admin</option>
              <option value="1">User</option>
            </select>
            </div>
          </div>
           
           <br />
           <div class="form-group" align="center">
            <input type="hidden" name="action" id="action" />
            <input type="hidden" name="hidden_id" id="hidden_id" />
            <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add" />
           </div>
         </form>
        </div>
     </div>
    </div>
</div>

<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modalitem">Confirmation</h2>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">Are you sure you want to remove? <p id="output"></p></h4>
            </div>
            <div class="modal-footer">
             <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
            
        </div>
    </div>
</div>



<script>
$(document).ready(function(){

 $('#user_table').DataTable({
  processing: true,
  serverSide: true,
  ajax:{
   url: "{{ route('Uindex') }}",
  },
  columns:[
   
   {
    data: 'name',
    name: 'name'
   },
   {
    data: 'email',
    name: 'email'
   },
   {
    data: 'admin',
    name: 'admin'
   },
   {
    data: 'action',
    name: 'action',
    orderable: false
   }
  ]
 });


 $('#UserForm').on('submit', function(event){
  event.preventDefault();
  if($('#action').val() == "Edit")
  {
   $.ajax({
    url:"{{ route('Uupdate') }}",
    method:"POST",
    data:new FormData(this),
    contentType: false,
    cache: false,
    processData: false,
    dataType:"json",
    success:function(data)
    {
     var html = '';
     if(data.errors)
     {
      html = '<div class="alert alert-danger">';
      for(var count = 0; count < data.errors.length; count++)
      {
       html += '<p>' + data.errors[count] + '</p>';
      }
      html += '</div>';
     }
     if(data.success)
     {
      //html = '<div class="alert alert-success">' + data.success + '</div>';
      $('#UserForm')[0].reset();
      $('#store_image').html('');
      $('#user_table').DataTable().ajax.reload();
      $('#UserFormModal').modal('hide');
      $.alert('User Edited Successfully', {
                title: 'Success',
                closeTime: 5000,
                autoClose: true,
                position: ['top-right', [-0.42, 0]],
                withTime: false,
                type: 'success',
                isOnly: !$('#isOnly').is(':checked')
            });
     }
     $('#FormUser').html(html);
    }
   });
  }
 });

 $(document).on('click', '.edit', function(){
  var id = $(this).attr('id');
  $('#FormUser').html('');
  $.ajax({
   url:"/Users/Users/"+id+"/edit",
   dataType:"json",
   success:function(html){
    $('#name').val(html.data.name);
    $('#email').val(html.data.email);
    $('#admin').val(html.data.admin);
    $('#store_image').html("<img src={{ URL::to('/') }}/images/" + html.data.image + " width='70' class='img-thumbnail' />");
    $('#store_image').append("<input type='hidden' name='hidden_image' value='"+html.data.image+"' />");
    $('#hidden_id').val(html.data.id);
    $('.modaluser').text("Edit Role");
    $('#action_button').val("Edit");
    $('#action').val("Edit");
    $('#UserFormModal').modal('show');
   }
  })
 });


});
</script>