@extends('admin.settings.textblocks.elements.partials.layout')

@section('panel')
    <div class="panel-heading">
        <h2>Textbausteine - Einsatzplan</h2>
    </div>
    <div class="panel-body">
        <textblocks-operation-plan :data="{{ $textblocks }}"></textblocks-operation-plan>
    </div>
@endsection
