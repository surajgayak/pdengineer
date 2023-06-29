@props(['id', 'title'])


<div  wire:ignore.self id="{{ $id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    databackdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="margin-top: 5rem">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>

{{-- <script>
    $("#{{ $id }}").prepend("section");
</script> --}}
