@extends('back.layouts.master')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Məhsullar</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Səhifə</a></li>
                            <li class="breadcrumb-item active">Məhsullar</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Əlavə et butonu -->
                        <div class="mb-3">
                            <a href="{{ route('admin.product.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Yeni Məhsul
                            </a>
                        </div>

                        <!-- Filter -->
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <select name="category_id" class="form-select filter-select">
                                    <option value="">Bütün Kateqoriyalar</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name_az }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="sub_category_id" class="form-select">
                                    <option value="">Alt Kateqoriya Seçin</option>
                                    @foreach($sub_categories as $sub_category)
                                        <option value="{{ $sub_category->id }}">{{ $sub_category->name_az }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="status" class="form-select filter-select">
                                    <option value="">Bütün Statuslar</option>
                                    <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktiv</option>
                                    <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Deaktiv</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Axtar..." value="{{ request('search') }}">
                                    <button class="btn btn-primary" type="button" id="search-btn">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Cədvəl -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 50px">#</th>
                                        <th style="width: 100px">Şəkil</th>
                                        <th>Ad</th>
                                        <th>Kateqoriya</th>
                                        <th>Alt Kateqoriya</th>
                                        <th>Qiymət</th>
                                        <th>Video Sayı</th>
                                        <th>Status</th>
                                        <th style="width: 150px">Əməliyyatlar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($products as $product)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ asset($product->thumbnail) }}" 
                                                     alt="{{ $product->name_az }}" 
                                                     class="img-thumbnail" 
                                                     style="width: 50px">
                                            </td>
                                            <td>{{ $product->name_az }}</td>
                                            <td>{{ $product->category->name_az ?? '-' }}</td>
                                            <td>{{ $product->sub_category->name_az ?? '-' }}</td>
                                            <td>
                                                @if($product->discount_percentage > 0)
                                                    <div class="d-flex flex-column">
                                                        <span class="text-decoration-line-through text-muted">
                                                            {{ number_format($product->price, 2) }} ₼
                                                        </span>
                                                        <span class="text-success fw-bold">
                                                            {{ number_format($product->discounted_price, 2) }} ₼
                                                        </span>
                                                        <span class="badge bg-danger">-{{ $product->discount_percentage }}%</span>
                                                    </div>
                                                @else
                                                    <span>{{ number_format($product->price, 2) }} ₼</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge bg-info">
                                                    {{ $product->videos()->count() }} video
                                                </span>
                                            </td>
                                            <td>
                                                @if($product->status)
                                                    <span class="badge bg-success">Aktiv</span>
                                                @else
                                                    <span class="badge bg-danger">Deaktiv</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.product.show', $product->id) }}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('admin.product.destroy', $product->id) }}" class="btn btn-danger btn-sm" 
                                                   onclick="return confirm('Silmək istədiyinizə əminsiniz?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">Məhsul tapılmadı</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="row">
                            <div class="col-12">
                                <div class="pagination justify-content-end">
                                    {{ $products->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tablo dışında, sayfanın sonunda modaller için -->
@foreach($products as $product)
    <div class="modal fade" id="productModal{{ $product->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Məhsul Detalları</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            @if($product->thumbnail)
                                <img src="{{ asset($product->thumbnail) }}" alt="" class="img-fluid rounded mb-3">
                            @endif
                        </div>
                        <div class="col-md-6">
                            <h4>{{ $product->name_az }}</h4>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p><strong>Kateqoriya:</strong> {{ $product->category->name_az ?? '-' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Alt Kateqoriya:</strong> {{ $product->sub_category->name_az ?? '-' }}</p>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p><strong>Qiymət:</strong> {{ number_format($product->price, 2) }} ₼</p>
                                </div>
                                @if($product->discount_percentage)
                                    <div class="col-md-6">
                                        <p><strong>Endirim:</strong> {{ $product->discount_percentage }}%</p>
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <strong>Status:</strong>
                                @if($product->status)
                                    <span class="badge bg-success">Aktiv</span>
                                @else
                                    <span class="badge bg-danger">Deaktiv</span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <strong>Açıqlama:</strong>
                                <div class="mt-2">{!! $product->description_az !!}</div>
                            </div>
                        </div>
                    </div>

                    @if($product->videos && $product->videos->count() > 0)
                        <div class="row mt-4">
                            <div class="col-12">
                                <h5>Videolar (Toplam: {{ $product->videos->count() }} video)</h5>
                                <div class="row">
                                    @foreach($product->videos as $video)
                                        <div class="col-md-4 mb-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <video width="100%" controls id="video{{ $video->id }}" 
                                                           onplay="incrementViewCount({{ $video->id }})">
                                                        <source src="{{ asset($video->video_path) }}" type="video/mp4">
                                                        Brauzeriniz video təğini dəstəkləmir.
                                                    </video>
                                                    
                                                    <div class="mt-3">
                                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                                            <span class="badge bg-info">
                                                                <i class="fas fa-clock"></i> 
                                                                {{ gmdate("i:s", $video->duration) }}
                                                            </span>
                                                            <span class="badge bg-success">
                                                                <i class="fas fa-download"></i> 
                                                                {{ number_format($video->download_count) }}
                                                            </span>
                                                        </div>
                                                        
                                                        <div class="text-center mb-2">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                <i class="fa{{ $i <= ($video->rating ?? 5) ? 's' : 'r' }} fa-star text-warning"></i>
                                                            @endfor
                                                        </div>
                                                        
                                                        <a href="{{ route('admin.product.video.download', $video->id) }}" 
                                                           class="btn btn-primary btn-sm w-100">
                                                            <i class="fas fa-download"></i> Yüklə
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bağla</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection

@push('js')
<script>
    // Filter
    $('.filter-select').change(function() {
        filterProducts();
    });

    $('#search-btn').click(function() {
        filterProducts();
    });

    function filterProducts() {
        let url = new URL(window.location.href);
        
        // Filterleri URL'e əlavə et
        $('.filter-select').each(function() {
            if ($(this).val()) {
                url.searchParams.set($(this).attr('name'), $(this).val());
            } else {
                url.searchParams.delete($(this).attr('name'));
            }
        });

        // Axtarış
        let search = $('input[name="search"]').val();
        if (search) {
            url.searchParams.set('search', search);
        } else {
            url.searchParams.delete('search');
        }

        window.location.href = url.toString();
    }

    // Silmə təsdiqi
    function deleteConfirm(url) {
        Swal.fire({
            title: 'Əminsiniz?',
            text: "Bu əməliyyat geri alına bilməz!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Bəli, sil!',
            cancelButtonText: 'Xeyr'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }

    $(document).ready(function() {
        // Video süresini otomatik hesapla
        $('video').on('loadedmetadata', function() {
            let videoId = $(this).attr('id').replace('video', '');
            let duration = Math.round(this.duration);
            
            // AJAX ile video süresini güncelle
            $.post('{{ route("admin.product.video.update-duration") }}', {
                _token: '{{ csrf_token() }}',
                video_id: videoId,
                duration: duration
            });
        });

        // Modal açıldığında videoları yükle
        $('.modal').on('shown.bs.modal', function () {
            $(this).find('video').each(function() {
                if (this.paused) {
                    this.load();
                }
            });
        });

        // Modal kapandığında videoları durdur
        $('.modal').on('hidden.bs.modal', function () {
            $(this).find('video').each(function() {
                this.pause();
                this.currentTime = 0;
            });
        });
    });

    function incrementViewCount(videoId) {
        // Video izlenme sayısını artır
        $.post('{{ route("admin.product.video.increment-view") }}', {
            _token: '{{ csrf_token() }}',
            video_id: videoId
        });
    }

    function rateVideo(videoId, rating) {
        $.post('{{ route("admin.product.video.rate") }}', {
            _token: '{{ csrf_token() }}',
            video_id: videoId,
            rating: rating
        });
    }
</script>
@endpush

@push('css')
<link href="{{ asset('back/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
