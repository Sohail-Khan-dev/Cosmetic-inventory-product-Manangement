@extends('layouts.tabler')

@section('content')
        <div class="d-flex w-100 flex-column gap-3" >
            <h3> There are some userful Tags that can we use in the development in future  :</h3>
            <q> the q Element define a shor quotation. it's perfect for in cluding inline quotes ithin you test </q>
            <s> The s Element render text wit ha a strikthrough, or a line through it  </s>
            <mark> Represent text that is marked or hilighted for reference or notation </mark>
            <details open>
                <summary>Details</summary>
                This is the summary of the detail. This tag must be open and have summary tag inside it to work it. It is used to show the detail realted to any thing and much more. You can find any use case for this.
            </details>
        </div>
@endsection
