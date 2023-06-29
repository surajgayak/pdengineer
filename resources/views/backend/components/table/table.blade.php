@props(['id'=>'tableExport'])
<div class="table-responsive">
    <table class=" table table-striped table-hover" id="{{$id }}" style="width:100%;">
        {{$slot}}
    </table>
</div>

{{-- @once --}}
@push('scripts')
<script>
//     $('#{{$id}}').DataTable( {
//     responsive: true
// } );
var table = $('#{{$id}}').DataTable();

new $.fn.dataTable.Responsive( table, {

    details: true,
    responsive: true
} );
</script>
@endpush
{{-- @endonce --}}
