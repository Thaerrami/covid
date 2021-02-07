@extends('layouts.adminapp')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container">
    <p class="m-2 alert-warning">use + to list points</p>
    <div class="row">
        {{-- @foreach ($advices as $key=>$i)
           <div class="m-4">{{$key}} {{$i->question}}  <button class="btn btn-outline-danger m-1">Delete <span class="bg-white border-0 pl-2 pr-2 text-black-50" style="border-radius: 50%">-</span></button><button  class="btn btn-outline-info m-1">Update !</button></div>
        @endforeach --}}
        
        <button class="btn btn-primary position-sticky " style="top: 10px;left:90%;" id='create'>Or Create new +</button>

        
        <table id='userTable' class="table" style='border-collapse: collapse;'>
            <tbody id="tbody">
                @foreach ($advices as $key=>$i)
                <tr>
           <div class="m-4 p-1 border rounded w-100" style="background-color: rgb(227, 250, 250)"><span class="bg-primary pl-1 pr-1 ml-3 " style="border-radius: 50%">{{$key+1}}</span> {{$i->question}}  
            
            <div class="bg-white p-2 m-2 border rounded">
            <ul >
                @foreach (explode('+',$i->answer)  as $item)
                   <li class="list-unstyled"> {{$item}} </li>
                @endforeach
            </ul>
            </div>
            <div class="d-flex justify-content-center"><button class="btn btn-outline-danger m-1 delete" data-id="{{$i->id}}">Delete -</button><button  class="btn btn-outline-info m-1 update" data-id="{{$i->id}}" data-question="{{$i->question}}" data-answer="{{$i->answer}}">Update !</button></div>
            </div>
        </tr>
           @endforeach
              
            </tbody>
          </table>
    </div>
    <div class="text-center bg-info p-2 rounded pop-card w-75"   id="card">
        <h2 class="w-100 mb-1 text-white " >Advice</h2> <span class="float-right bg-danger rounded p-1 m-1 text-white" id='cls-btn'>cancle X</span><br>
        <form   method="POST" class="form-group btn-submit " style="text-align: left" id="formupdate">
            @csrf
        <div> Qusetion</div>
        <input type="text" placeholder="question" name="question" id="question" class="mb-1 form-control w-100" /> 
        <div>answer</div>
        <textarea     cols="30" id="answer" placeholder="edite answer" name="answer" rows="8" class="form-control w-100"></textarea>
        <input type="submit" name="submit" class="btn btn-primary float-left mt-1" value="submit" />
      </form>
    </div>
</div>
@endsection

<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
</script>
<script type='text/javascript'>

$(document).ready(()=>{
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $('#card').hide();
    $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
    $(document).on("click", ".delete" , function() {
        var did=$(this).data('id');
        $.ajax({
    type: "DELETE",
    url: '/admin/deletead',
    data: { 
        "deleteid":did 
        , _token: '{{csrf_token()}}' 
    },
    success: function (data) {
        alert('deleted successfuly');
        window.location.reload();
    },
    error: function (data, textStatus, errorThrown) {
        console.log(data);

    },
});
            })
/////////end of delete
var updateid;


$(document).on("click", ".update" , function() {
        updateid=$(this).data('id');
        var ques=$(this).data('question');
        var ans=$(this).data('answer');
        // alert(ans);
        $('#card').show('slow')
        $('#question').val(ques);
        $('#answer').val(ans);

            })
////////////////submit

$('#formupdate').on('submit', function(event){
        event.preventDefault();
        var question = $("input[name=question]").val();
        var answer = $("textarea[name=answer]").val();
        var url = '{{ route('admin.updateadvice') }}';

        // alert(updateid);
        $.ajax({
            url:url,
            method:"POST",
            data:{
                question:question,
                answer:answer,
                id:updateid
                , _token: '{{csrf_token()}}'
            },
            success:function(data)
            {
                console.log(data);
                // $('#tbody').remove();
            //     var tr_str = "<tr>"+
            // "<td align='center'><input type='text' value='" + username + "' id='username_"+id+"' disabled ></td>" +
            // "<td align='center'><input type='text' value='" + name + "' id='name_"+id+"'></td>" +
            // "<td align='center'><input type='email' value='" + email + "' id='email_"+id+"'></td>" +
            // "<td align='center'><input type='button' value='Update' class='update' data-id='"+id+"' ><input type='button' value='Delete' class='delete' data-id='"+id+"' ></td>"+
            // "</tr>";
                window.location.reload();
            },
            error: function (data, textStatus, errorThrown) {
        console.log(data);

    }
        })
    });

////////////////////end of update

$('#cls-btn').click(()=>{
    // $(this).parent().hide();
    $('#card').hide('slow')
});

$('#create').click(()=>{
    // $(this).parent().hide();
    $('#question').val('');
    $('#answer').val('');
    updateid=null;
    $('#card').show('slow')
});


})


</script>