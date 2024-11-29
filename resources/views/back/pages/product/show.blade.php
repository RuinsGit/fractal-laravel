@extends('back.layouts.master')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Məhsul Detalları</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Məhsullar</a></li>
                            <li class="breadcrumb-item active">Detal</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Ürün Detayları -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ asset($product->thumbnail) }}" alt="{{ $product->name_az }}" 
                                         class="img-thumbnail me-3" style="width: 100px;">
                                    <h5 class="card-title mb-0">{{ $product->name_az }}</h5>
                                </div>
                            </div>
                            <div class="col-md-6 text-end">
                                <div class="d-inline-flex align-items-center p-2 bg-light rounded">
                                    <i class="bx bx-time font-size-18 text-primary me-2"></i>
                                    <span class="fw-medium">{{ $product->total_duration }}</span>
                                </div>
                                <div class="d-inline-flex align-items-center p-2 bg-light rounded ms-2">
                                    <i class="bx bx-download font-size-18 text-primary me-2"></i>
                                    <span class="fw-medium">{{ number_format($product->total_downloads) }} yükləmə</span>
                                </div>
                            </div>
                        </div>

                        <!-- Diğer ürün bilgileri -->
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <strong>Qiymət:</strong>
                                    @if($product->discount_percentage > 0)
                                        <div class="flex flex-col space-y-1 mt-1">
                                            <div class="flex items-center space-x-2">
                                                <span class="text-gray-500 line-through">{{ number_format($product->price, 2) }} ₼</span>
                                                <span class="bg-red-500 text-white text-xs px-2 py-1 rounded">-{{ $product->discount_percentage }}%</span>
                                            </div>
                                            <div class="text-green-600 font-bold">
                                                {{ number_format($product->discounted_price, 2) }} ₼
                                            </div>
                                        </div>
                                    @else
                                        <span class="font-bold">{{ number_format($product->price, 2) }} ₼</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Video listesi -->
                        <div class="table-responsive mt-4">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Video</th>
                                        <th>Müddət</th>
                                        <th>Əməliyyatlar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($product->videos()->orderBy('order')->get() as $video)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="bx bx-play-circle text-primary me-2 font-size-18"></i>
                                                <span>{{ $video->title }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-info font-size-12">
                                                <i class="bx bx-time me-1"></i>
                                                {{ $video->formatted_duration }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary btn-sm" 
                                                        onclick="previewVideo('{{ asset($video->video_path) }}', '{{ $video->formatted_duration }}')">
                                                    <i class="bx bx-play me-1"></i> İzlə
                                                </button>
                                                <a href="{{ route('admin.product.video.download', $video->id) }}" 
                                                   class="btn btn-info btn-sm">
                                                    <i class="bx bx-download me-1"></i> Yüklə
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Video Preview Modal -->
<div class="modal fade" id="videoPreviewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Video Önizləmə 
                    <span class="badge bg-info ms-2" id="videoDuration"></span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <video id="previewVideo" controls style="width: 100%;">
                    <source src="" type="video/mp4">
                    Brauzeriniz video təğini dəstəkləmir.
                </video>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
function previewVideo(videoUrl, duration) {
    const video = document.getElementById('previewVideo');
    const durationElement = document.getElementById('videoDuration');
    
    video.src = videoUrl;
    durationElement.textContent = duration;
    
    const modal = new bootstrap.Modal(document.getElementById('videoPreviewModal'));
    modal.show();
}

document.getElementById('videoPreviewModal').addEventListener('hidden.bs.modal', function () {
    const video = document.getElementById('previewVideo');
    video.pause();
    video.currentTime = 0;
});
</script>
@endpush
@endsection