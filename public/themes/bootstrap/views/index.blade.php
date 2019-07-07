@extends('bootstrap::layouts.default')

@section('content')
<div>
    <h1>{{ tt('welcome_message') }}</h1>
    <p>{{ tt('desc_message') }}</p>
</div>
@endsection

@push('scripts')
<script>
    console.log('run from push script')
</script>
@endpush