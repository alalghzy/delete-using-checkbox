<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <title>Laravel Multi Checkboxes Example</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
      <meta name="csrf-token" content="{{ csrf_token() }}">
   </head>
   <body>
      <div class="container">
         @if ($message = Session::get('success'))
         <div class="alert alert-info">
            <p>{{ $message }}</p>
         </div>
         @endif
         <h2 class="mb-4">Laravel Checkbox Multiple Rows Delete Example</h2>
         <button class="btn btn-primary btn-xs removeAll mb-3">Remove All Data</button>
         <table class="table table-bordered">
            <tr>
               <th><input type="checkbox" id="checkboxesMain"></th>
               <th>Id</th>
               <th>Category Name</th>
               <th>Category Details</th>
            </tr>
            @if($students->count())
            @foreach($students as $key => $student)
            <tr id="tr_{{$student->id}}">
               <td><input type="checkbox" class="checkbox" data-id="{{$student->id}}"></td>
               <td>{{ ++$key }}</td>
               <td>{{ $student->name }}</td>
               <td>{{ $student->details }}</td>
            </tr>
            @endforeach
            @endif
         </table>
      </div>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

   </body>
   <script type = "text/javascript" >
    $(document).ready(function() {
        $('#checkboxesMain').on('click', function(e) {
            if ($(this).is(':checked', true)) {
                $(".checkbox").prop('checked', true);
            } else {
                $(".checkbox").prop('checked', false);
            }
        });
        $('.checkbox').on('click', function() {
            if ($('.checkbox:checked').length == $('.checkbox').length) {
                $('#checkboxesMain').prop('checked', true);
            } else {
                $('#checkboxesMain').prop('checked', false);
            }
        });
        $('.removeAll').on('click', function(e) {
            var studentIdArr = [];
            $(".checkbox:checked").each(function() {
                studentIdArr.push($(this).attr('data-id'));
            });
            if (studentIdArr.length <= 0) {
                alert("Choose min one item to remove.");
            } else {
                if (confirm("Are you sure?")) {
                    var stuId = studentIdArr.join(",");
                    $.ajax({
                        url: "{{url('delete-all')}}",
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: 'ids=' + stuId,
                        success: function(data) {
                            if (data['status'] == true) {
                                $(".checkbox:checked").each(function() {
                                    $(this).parents("tr").remove();
                                });
                                alert(data['message']);
                            } else {
                                alert('Error occured.');
                            }
                        },
                        error: function(data) {
                            alert(data.responseText);
                        }
                    });
                }
            }
        });
    });
 </script>
</html>
