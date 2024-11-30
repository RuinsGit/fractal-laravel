@extends('back.layouts.master')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- Başlık -->
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

        <!-- Ürün Detayları -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!-- Sol Taraf - Ürün Bilgileri -->
                            <div class="col-md-8">
                                <h4>{{ $product->name_az }}</h4>
                                <p class="text-muted">{{ $product->title_az }}</p>
                                
                                <div class="mt-4">
                                    <h5>Qiymət Məlumatları</h5>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p><strong>Əsas Qiymət:</strong> {{ $product->formatted_price }}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p><strong>Endirim:</strong> {{ $product->discount_percentage }}%</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p><strong>Son Qiymət:</strong> {{ $product->formatted_discounted_price }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Sağ Taraf - İstatistikler -->
                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h5>Video Statistikaları</h5>
                                        <div class="mt-3">
                                            <p>
                                                <i class="fas fa-video me-2"></i>
                                                <strong>Video Sayı:</strong> {{ $product->total_videos }}
                                            </p>
                                            <p>
                                                <i class="fas fa-clock me-2"></i>
                                                <strong>Ümumi Müddət:</strong> {{ $product->total_duration }}
                                            </p>
                                            <p>
                                                <i class="fas fa-download me-2"></i>
                                                <strong>Yükləmə Sayı:</strong> {{ $product->total_downloads }}
                                            </p>
                                            <p>
                                                <i class="fas fa-star me-2 text-warning"></i>
                                                <strong>Ortalama Reytinq:</strong> {{ $product->average_rating }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Videolar Listesi -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <h5>Videolar</h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>№</th>
                                                <th>Başlıq</th>
                                                <th>Müddət</th>
                                                <th>Yükləmə</th>
                                                <th>Baxış</th>
                                                <th>Reytinq</th>
                                                <th>Əməliyyatlar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($product->videos as $video)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $video->title }}</td>
                                                <td>{{ gmdate("i:s", $video->duration) }}</td>
                                                <td>{{ $video->download_count }}</td>
                                                <td>{{ $video->view_count }}</td>
                                                <td>
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fas fa-star {{ $i <= $video->rating ? 'text-warning' : 'text-muted' }}"></i>
                                                    @endfor
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary" onclick="playVideo('{{ asset($video->video_path) }}')">
                                                        <i class="fas fa-play"></i>
                                                    </button>
                                                    <a href="{{ route('admin.product.video.download', $video->id) }}" class="btn btn-sm btn-success">
                                                        <i class="fas fa-download"></i>
                                                    </a>
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
    </div>
</div>

<!-- Video Modal -->
<div class="modal fade" id="videoModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Video Önizləmə</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <video id="videoPlayer" class="w-100" controls>
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
function playVideo(videoUrl) {
    const player = document.getElementById('videoPlayer');
    player.src = videoUrl;
    player.load();
    
    const modal = new bootstrap.Modal(document.getElementById('videoModal'));
    modal.show();
    
    // Video izlenme sayısını artır
    $.post('{{ route("admin.product.video.increment-view") }}', {
        _token: '{{ csrf_token() }}',
        video_id: videoId
    });
}

// Modal kapandığında videoyu durdur
document.getElementById('videoModal').addEventListener('hidden.bs.modal', function () {
    const player = document.getElementById('videoPlayer');
    player.pause();
    player.currentTime = 0;
});
</script>
@endpush

@push('css')
<link href="{{ asset('back/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush