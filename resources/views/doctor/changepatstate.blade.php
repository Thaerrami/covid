@extends('layouts.auth')

<!------ Include the above in your HEAD tag ---------->
@section('content')
    <div class="container ">
        <div class="row">
            <div class="col-12 text-center">
                <form action="{{route('doc.changestatus')}}" method="POST">
                    @csrf
                    <input type="hidden" value={{$patdata['id']}} name="id">
                    <label class="col-form-label bg-success border rounded p-2 mb-2 text-white" for="state">please enter the paitent status</label>
                    <select name="state" id="state" class="form-control">
                        <option class="text-center" value="1">recovered</option>
                        <option class="text-center" value="3">death</option>
                    </select>
                    <label class="col-form-label bg-success border rounded p-2 mb-2 mt-3 text-white" for="state">Write Finalization Report</label><br>
                    <span  style="width: fit-content;word-wrap: none;word-wrap: wrap none;" class="btn btn-info text-white pl-4 pr-4 rounded  m-2 float-left">Suggestions</span>
                    <div class="bg-dark rounded w-100 d-inline-block p-2 "  >
                        <span  style="width: fit-content;word-wrap: none;word-wrap: wrap none;" class="bg-secondary  pl-4 pr-4 rounded text-white mt-2 sugg">{{$patdata['name']}}</span>
                        <span  style="width: fit-content;word-wrap: none;word-wrap: wrap none;" class="bg-secondary  pl-4 pr-4 rounded text-white mt-2 sugg">{{$patdata['phone']}}</span>
                        <span  style="width: fit-content;word-wrap: none;word-wrap: wrap none;" class="bg-secondary  pl-4 pr-4 rounded text-white mt-2 sugg">{{$patdata['date']}}</span>
                        <span  style="width: fit-content;word-wrap: none;word-wrap: wrap none;" class="bg-secondary  pl-4 pr-4 rounded text-white mt-2 sugg">{{$patdata['email']}}</span>
                        <span  style="width: fit-content;word-wrap: none;word-wrap: wrap none;" class="bg-secondary  pl-4 pr-4 rounded text-white mt-2 sugg">{{$patdata['city']}}</span>
                        <span  style="width: fit-content;word-wrap: none;word-wrap: wrap none;" class="bg-secondary  pl-4 pr-4 rounded text-white mt-2 sugg">{{$patdata['country']}}</span>
                        <span  style="width: fit-content;word-wrap: none;word-wrap: wrap none;" class="bg-secondary  pl-4 pr-4 rounded text-white mt-2 sugg">starts at{{date("d M Y", strtotime($patdata['created_at']))}}</span>
                        <span  style="width: fit-content;word-wrap: none;word-wrap: wrap none;" class="bg-secondary  pl-4 pr-4 rounded text-white mt-2 sugg ">last update at {{date("d M Y", strtotime($patdata['updated_at']))}}</span>
                    </div>
                    <textarea name="finalreport" id="finalreport" cols="50" rows="20" class="form-control mt-3 mb-3 text-black" value=''></textarea>
                    <input type="submit" class="btn btn-primary mb-5 float-left" value="submit">
                </form>
            </div>
        </div>
    </div> 
      
    @endsection


<script>
    var text=document.getElementById('finalreport').value;
    var sugg=document.getElementsByClassName('sugg');
    for(var s of sugg){
        s.addEventListener('click',function(){
            var myTextArea = document.querySelector('#finalreport');
            myTextArea.val(myTextArea.value + ' '+this.innerText);
            console.log(myTextArea.value);
        });
    }

    
</script> 