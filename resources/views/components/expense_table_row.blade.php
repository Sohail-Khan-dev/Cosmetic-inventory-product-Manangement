


<tr>
    <th scope="row">{{$exp->id}}</th>
    <td>{{$exp->exp_name}}</td>
    <td>{{$exp->exp_purpose}}</td>
    <td>{{$exp->exp_description}}</td>
    <td>{{$exp->exp_payment_mode}}</td>
    <td>{{$exp->exp_amount}} pkr</td>
    <td>{{$exp->exp_status}}</td>
    <td>
        <div style="display: inline-flex;gap: 2px">
            <a class="btn btn-primary edit-btn" id="edit-btn" data-expence="{{$exp}}">Edit</a>

            <form action="{{ route('expense.destroy',$exp) }}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">Delete</button>
            </form>
        </div>

    </td>
</tr>




{{--@push('page-scripts')--}}
{{--    <script>--}}
{{--        console.log('Your Doc is ready');--}}

{{--        --}}{{--$('#edit-btn').on('click', function () {--}}
{{--        --}}{{--    --}}{{----}}{{--$.ajax({--}}
{{--        --}}{{--    --}}{{----}}{{--    url:'{{route('expense.edit',$exp)}}',--}}
{{--        --}}{{--    --}}{{----}}{{--    method:'get',--}}
{{--        --}}{{--    --}}{{----}}{{--    content:this,--}}
{{--        --}}{{--    --}}{{----}}{{--    success:function(response){--}}
{{--        --}}{{--    --}}{{----}}{{--        $("#modalHtml").html(response);--}}
{{--        --}}{{--    --}}{{----}}{{--    }--}}
{{--        --}}{{--    --}}{{----}}{{--})--}}
{{--        --}}{{--    return  new Promise(function () {--}}
{{--        --}}{{--        fetch('{{route('expense.edit',$exp)}}')--}}
{{--        --}}{{--            .then((response)=> response.text())--}}
{{--        --}}{{--            .then((data)=>{--}}
{{--        --}}{{--                $("#modalHtml").html(response);--}}
{{--        --}}{{--            })--}}
{{--        --}}{{--    })--}}
{{--        --}}{{--})--}}
{{--    </script>--}}
{{--@endpush--}}





