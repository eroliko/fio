@php use App\Http\Containers\AwardContainer\RequestFilters\AwardRequestFilter; @endphp
<form action="{{ route('action-ward-store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="gender" value="{{ $gender }}">
    <div class="mb-3">
        <label for="file-{{ $gender }}" class="form-label">Csv file</label>
        <input type="file" class="form-control" id="file-{{ $gender }}" name="{{ AwardRequestFilter::FIELD_FILE }}">
    </div>
    <div class="mb-3">
        <input type="submit" class="form-control btn btn-primary" value="Upload">
    </div>
</form>
