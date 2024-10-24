@extends('layouts.tabler')
@section('content')
    <livewire:tables.expense-table />


@endsection
<script>
    // This is working but handled thisn in add-edit file
    // document.addEventListener('DOMContentLoaded', function () {
    //     window.addEventListener('closeModal', function () {
    //         // Use your preferred method to hide the modal
    //         console.log("we are here ");

    //         $('#yourModalId').modal('hide'); // If using Bootstrap
    //     });
    // });
</script>



