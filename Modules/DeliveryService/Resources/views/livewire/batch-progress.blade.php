<div>
    @if (isset($batch) )
    Deliveries Upload Progress
    <br>
    {{ $batch->processedJobs() }} completed out of {{ $batch->totalJobs() }} <br>
    ({{ $batch->progress() }}%)

    @endif
</div>

@push('scripts')
<script>
    window.setInterval(refresh, 2000);

    function refresh()
    {
        window.location.reload();
    }
</script>
@endpush