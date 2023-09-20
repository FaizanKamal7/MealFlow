<div>

    @if (!is_null($batch))
    <div class="mt-4">
        Uploading Deliveries Progress
        <br>
        {{$batch->processedJobs()}} completed out of {{ $batch->totalJobs()}}
        ({{$batch->progress()}} %)
    </div>
    @endif
</div>

@push('scripts')
<script>
    if (!is_null($batch) && $batch->progress()<100) {
            window.setInterval(() => {
               window.location.reload(); 
            }, 2000);
        }
</script>
@endpush