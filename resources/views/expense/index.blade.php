<?php
$to=$update_expense;

?>
@extends('layouts.tabler')
@section('content')
    @livewire('table.expense-table')

    @include('expense.add-edit');
@endsection
@push('page-scripts')
<script>
    $(document).ready(function (){
        console.log("we are here in the JQuery : ");
        // $(document).on("click",'#expenceModalButton', function (){
        //     console.log(" Button is clicked ")
        // });
        $("#expenceModalButton").on("click", function (){
            console.log(" Button is clicked "   )
            $.ajax({
                url : 'get-expence-form',
                method : 'get',
                data : {
                    test : 'Sajjad',
                },
                success : function (response) {
                    console.log(response);
                    $("modalHtml").html(response);
                }
            });
        });
        $('.edit-btn').on('click', function () {
                let expence = $(this).data('expence');
                console.log(expence)
            // expence=
            console.log(expence.id);
            // $("#add-edit-title").text("Edit Expence");
            $("#exp_id").val(expence.id);
            $("#expencetype").val(expence.exp_name);
            $("#exp_amount").val(expence.exp_amount);
            $("#notes").val(expence.exp_description);

            $("#add-edit-expence").modal('show');
            return;
                // return  new Promise(function () {
                fetch(`get-expence-form/${exp_id}`)
                    .then(response)

                    // .then((data)=>{
                        console.log(response.text());
                        $("#add-edit-body").html(response.text());
                        $("#add-edit-expence").modal('show');
                    // })
            // })


        });

    });
</script>
@endpush
