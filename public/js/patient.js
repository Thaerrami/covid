// document.getElementById('back').addEventListener('click',()=>{
//     window.history.back();
// });

// $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
//     $("#success-alert").slideUp(500);
// });


// $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
// });

// $("#btn-save").click(function(e){

//     e.preventDefault();

//     var emailtodoc = $("textarea[name=emailtodoc]").val();
    
//     $.ajax({
//        type:'POST',
//        url:"/maildoc",
//        data:{emailtodoc:emailtodoc },
//        success:function(data){
//           alert(data.success);
//           location.reload();
//        }
//     });

// });