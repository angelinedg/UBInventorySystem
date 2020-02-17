
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
  @auth
                            
    @endauth
    @guest                 
      <meta http-equiv="refresh" content="0; URL='../login'" />
    @endguest
  <div class="container">    
     <br />
     <div class="jumbotron">
          <h2><center><img src="{{URL::asset('/trash.png')}}" alt="profile Pic" height="40" width="50">Category Trash</center></h2>
      </div>
     
     <br />
     <div align="right">
           <a href="{{ route('Cindex') }}" type="button" name="home"  class="btn btn-primary btn-sm">Back to Category</a>
     </div>
     <br />
   <div class="table-responsive">
    <table class="table table-bordered table-striped" id="category_table">
           <thead>
            <tr>
                <th width="40">Category Name</th>
                <th width="40%">Category Description</th>
                <th width="20%">Action</th>
            </tr>
           </thead>
       </table>
   </div>
   <br />
   <br />
  </div>
 </body>
</html> 

<!--restore-->

<div id="restoreModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modalitem">Confirmation</h2>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">Are you sure you want to restore this data?</h4>
            </div>
            <div class="modal-footer">
             <button type="button" name="confirmbutton" id="confirmbutton" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- delete-->
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

 $('#category_table').DataTable({
  processing: true,
  serverSide: true,
  ajax:{
   url: "{{ route('Ctrash') }}",
  },
  columns:[
   
   {
    data: 'category_name',
    name: 'category_name'
   },
   {
    data: 'category_desc',
    name: 'category_desc'
   },
   {
    data: 'action',
    name: 'action',
    orderable: false
   }
  ]
 });

var id;

$(document).on('click', '.restore', function(){

 id = $(this).attr('id');
 $('#restoreModal').modal('show');
});

$('#confirmbutton').click(function(){
 $.ajax({
  url:"restore/"+id,
  beforeSend:function(){
   $('#confirmbutton').text('Restoring...');
  },
  success:function(data)
  {
   setTimeout(function(){
    $('#restoreModal').modal('hide');
    $('#category_table').DataTable().ajax.reload();
   }, 2000);
   $.alert('Category Restored Successfully', {
                title: 'Success',
                closeTime: 5000,
                autoClose: true,
                position: ['top-right', [-0.42, 0]],
                withTime: false,
                type: 'success',
                isOnly: !$('#isOnly').is(':checked')
            });
  }
 })
});

 var id;

$(document).on('click', '.delete', function(){

 id = $(this).attr('id');
 name = $(this).attr('delname');
 document.getElementById('output').innerHTML = name;
 $('#confirmModal').modal('show');
});

$('#ok_button').click(function(){
 $.ajax({
  
  url:"delete/"+id,
  beforeSend:function(){
   $('#ok_button').text('Deleting...');
  },
  success:function(data)
  {
   setTimeout(function(){
    $('#confirmModal').modal('hide');
    $('#category_table').DataTable().ajax.reload();
   }, 2000);
    $.alert('Category Deleted Successfully', {
                title: 'Success',
                closeTime: 5000,
                autoClose: true,
                position: ['top-right', [-0.42, 0]],
                withTime: false,
                type: 'danger',
                isOnly: !$('#isOnly').is(':checked')
            });
  }
 })
});

});
</script>

