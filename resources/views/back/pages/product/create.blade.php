@extends('back.layouts.master')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Məhsul Əlavə Et</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Məhsullar</a></li>
                            <li class="breadcrumb-item active">Əlavə et</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <form id="productForm" class="needs-validation" method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- Dil Sekmeleri -->
                            <ul class="nav nav-tabs nav-justified mb-3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#az" role="tab">
                                        <span>AZ</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#en" role="tab">
                                        <span>EN</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#ru" role="tab">
                                        <span>RU</span>
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab məzmunu -->
                            <div class="tab-content p-3">
                                <!-- AZ Tab -->
                                <div class="tab-pane active" id="az" role="tabpanel">
                                    <div class="mb-3">
                                        <label>Ad (AZ)</label>
                                        <input type="text" name="name_az" class="form-control" value="{{ old('name_az') }}">
                                        @error('name_az')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="mb-3">
                                        <label>Başlıq (AZ)</label>
                                        <input type="text" name="title_az" class="form-control" value="{{ old('title_az') }}">
                                        @error('title_az')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="mb-3">
                                        <label>Təsvir (AZ)</label>
                                        <textarea name="description_az" class="form-control summernote">{{ old('description_az') }}</textarea>
                                        @error('description_az')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <!-- EN Tab -->
                                <div class="tab-pane" id="en" role="tabpanel">
                                    <div class="mb-3">
                                        <label>Ad (EN)</label>
                                        <input type="text" name="name_en" class="form-control" value="{{ old('name_en') }}">
                                        @error('name_en')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="mb-3">
                                        <label>Başlıq (EN)</label>
                                        <input type="text" name="title_en" class="form-control" value="{{ old('title_en') }}">
                                        @error('title_en')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="mb-3">
                                        <label>Təsvir (EN)</label>
                                        <textarea name="description_en" class="form-control summernote">{{ old('description_en') }}</textarea>
                                        @error('description_en')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <!-- RU Tab -->
                                <div class="tab-pane" id="ru" role="tabpanel">
                                    <div class="mb-3">
                                        <label>Ad (RU)</label>
                                        <input type="text" name="name_ru" class="form-control" value="{{ old('name_ru') }}">
                                        @error('name_ru')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="mb-3">
                                        <label>Başlıq (RU)</label>
                                        <input type="text" name="title_ru" class="form-control" value="{{ old('title_ru') }}">
                                        @error('title_ru')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="mb-3">
                                        <label>Təsvir (RU)</label>
                                        <textarea name="description_ru" class="form-control summernote">{{ old('description_ru') }}</textarea>
                                        @error('description_ru')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Kateqoriya və Alt Kateqoriya -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label>Kateqoriya</label>
                                    <select name="category_id" class="form-select" onchange="getSubCategories(this)">
                                        <option value="">Seçin</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name_az }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label>Alt Kateqoriya</label>
                                    <select name="sub_category_id" class="form-select">
                                        <option value="">Əvvəlcə kateqoriya seçin</option>
                                    </select>
                                    @error('sub_category_id')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <!-- Qiymət və Endirim -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label>Qiymət</label>
                                    <div class="input-group">
                                        <input type="number" 
                                               name="price" 
                                               step="0.01" 
                                               class="form-control" 
                                               value="{{ old('price') }}" 
                                               required>
                                        <span class="input-group-text">₼</span>
                                    </div>
                                    @error('price')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label>Endirim Faizi</label>
                                    <div class="input-group">
                                        <input type="number" 
                                               name="discount_percentage" 
                                               class="form-control" 
                                               value="{{ old('discount_percentage', 0) }}" 
                                               min="0" 
                                               max="100">
                                        <span class="input-group-text">%</span>
                                    </div>
                                    @error('discount_percentage')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <!-- Əsas Media -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label>Əsas Şəkil</label>
                                    <input type="file" name="thumbnail" class="form-control">
                                    @error('thumbnail')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label>Önbaxış Videosu</label>
                                    <input type="file" name="preview_video" class="form-control">
                                    @error('preview_video')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <!-- Video Yükleme Bölümü - Eski kodu bu kısımla değiştirin -->
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Video Məlumatları</h5>
                                </div>
                                <div class="card-body">
                                    <div id="videoList">
                                        <!-- İlk video satırı -->
                                        <div class="video-item border rounded p-3 mb-3">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="mb-2">
                                                        <label class="form-label">Video</label>
                                                        <input type="file" 
                                                               class="form-control video-file" 
                                                               name="videos[]" 
                                                               accept="video/*"
                                                               onchange="handleVideoChange(this)">
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="mb-2">
                                                        <label class="form-label">Video Başlığı</label>
                                                        <input type="text" 
                                                               class="form-control video-title" 
                                                               name="video_titles[]" 
                                                               placeholder="Video başlığını daxil edin">
                                                    </div>
                                                </div>
                                                <div class="col-md-2 d-flex align-items-end">
                                                    <button type="button" 
                                                            class="btn btn-danger btn-sm remove-video" 
                                                            onclick="removeVideo(this)" 
                                                            style="display: none;">
                                                        <i class="fas fa-trash me-1"></i> Sil
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center mt-3">
                                        <button type="button" class="btn btn-success" onclick="addNewVideo()">
                                            <i class="fas fa-plus me-1"></i> Yeni Video Əlavə Et
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Status və Sıralama -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label>Status</label>
                                    <select name="status" class="form-select">
                                        <option value="1">Aktiv</option>
                                        <option value="0">Deaktiv</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label>Sıralama</label>
                                    <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Yadda Saxla</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function getSubCategories(elem) {
        let categoryId = elem.value;
        let subCategorySelect = document.querySelector('[name="sub_category_id"]');
        
        if (!categoryId) {
            subCategorySelect.innerHTML = '<option value="">Əvvəlcə kateqoriya seçin</option>';
            return;
        }

        fetch(`/admin/product/get-sub-category/${categoryId}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    subCategorySelect.innerHTML = data.view;
                } else {
                    subCategorySelect.innerHTML = '<option value="">Alt kateqoriya tapılmadı</option>';
                }
            })
            .catch(error => {
                console.error('Xəta:', error);
                subCategorySelect.innerHTML = '<option value="">Xəta baş verdi</option>';
            });
    }

    $(document).ready(function() {
        $('.summernote').summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        $('.form-select').select2();

        $('#productForm').on('submit', function(e) {
            e.preventDefault();
            
            // Form verilerini al
            var formData = new FormData(this);
            
            // Loading modalı göster
            $('#loadingModal').modal('show');
            
            $.ajax({
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = ((evt.loaded / evt.total) * 100);
                            $(".progress-bar").width(percentComplete + '%');
                        }
                    }, false);
                    return xhr;
                },
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Loading modalı gizle
                    $('#loadingModal').modal('hide');
                    
                    // Başarılı mesajı göster
                    Swal.fire({
                        icon: 'success',
                        title: 'Uğurlu!',
                        text: 'Məhsul uğurla əlavə edildi',
                        showConfirmButton: true,
                        confirmButtonText: 'Tamam'
                    }).then((result) => {
                        // Listeye yönlendir
                        window.location.href = "{{ route('admin.product.index') }}";
                    });
                },
                error: function(xhr) {
                    // Loading modalı gizle
                    $('#loadingModal').modal('hide');
                    
                    // Hata mesajlarını göster
                    var errors = xhr.responseJSON.errors;
                    var errorMessage = '';
                    
                    $.each(errors, function(key, value) {
                        errorMessage += value[0] + '<br>';
                    });
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Xəta!',
                        html: errorMessage,
                        showConfirmButton: true,
                        confirmButtonText: 'Tamam'
                    });
                }
            });
        });
    });

    // Video işlemleri için JavaScript kodları
    function addNewVideo() {
        const videoList = document.getElementById('videoList');
        const videoCount = videoList.getElementsByClassName('video-item').length;
        
        // Yeni video elementi
        const newVideo = document.createElement('div');
        newVideo.className = 'video-item border rounded p-3 mb-3';
        newVideo.innerHTML = `
            <div class="row">
                <div class="col-md-5">
                    <div class="mb-2">
                        <label class="form-label">Video</label>
                        <input type="file" 
                               class="form-control video-file" 
                               name="videos[]" 
                               accept="video/*"
                               onchange="handleVideoChange(this)">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="mb-2">
                        <label class="form-label">Video Başlığı</label>
                        <input type="text" 
                               class="form-control video-title" 
                               name="video_titles[]" 
                               placeholder="Video başlığını daxil edin">
                    </div>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" 
                            class="btn btn-danger btn-sm remove-video" 
                            onclick="removeVideo(this)">
                        <i class="fas fa-trash me-1"></i> Sil
                    </button>
                </div>
            </div>
        `;
        
        videoList.appendChild(newVideo);
        updateRemoveButtons();
    }

    function removeVideo(button) {
        const videoItem = button.closest('.video-item');
        videoItem.remove();
        updateRemoveButtons();
    }

    function updateRemoveButtons() {
        const removeButtons = document.getElementsByClassName('remove-video');
        const videoCount = document.getElementsByClassName('video-item').length;
        
        for (let button of removeButtons) {
            button.style.display = videoCount === 1 ? 'none' : 'block';
        }
    }

    function handleVideoChange(input) {
        if (input.files && input.files[0]) {
            const fileName = input.files[0].name;
            const titleInput = input.closest('.video-item').querySelector('.video-title');
            if (!titleInput.value) {
                titleInput.value = fileName.replace(/\.[^/.]+$/, "");
            }
        }
    }

    // Form submit kontrolü
    document.getElementById('productForm').addEventListener('submit', function(e) {
        const videoFiles = document.querySelectorAll('.video-file');
        let hasVideo = false;

        videoFiles.forEach(input => {
            if (input.files.length > 0) {
                hasVideo = true;
            }
        });

        if (!hasVideo) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Xəta!',
                text: 'Ən azı bir video yükləməlisiniz!',
                confirmButtonText: 'Tamam'
            });
        }
    });

    // Sayfa yüklendiğinde
    document.addEventListener('DOMContentLoaded', function() {
        updateRemoveButtons();
    });

    // Başarı bildirimi
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Uğurlu!',
            text: "{{ session('success') }}",
            showConfirmButton: true,
            confirmButtonText: 'Tamam',
            timer: 3000,
            customClass: {
                popup: 'animated fadeIn faster'
            }
        });
    @endif

    // Hata bildirimi
    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Xəta!',
            text: "{{ session('error') }}",
            showConfirmButton: true,
            confirmButtonText: 'Tamam',
            timer: 3000,
            customClass: {
                popup: 'animated fadeIn faster'
            }
        });
    @endif

    // Validasyon hataları
    @if($errors->any())
        Swal.fire({
            icon: 'warning',
            title: 'Diqqət!',
            html: `
                <div class="text-left">
                    Zəhmət olmasa, bütün məlumatları düzgün daxil edin:<br><br>
                    @foreach($errors->all() as $error)
                        <div class="flex items-center gap-2 mb-2">
                            <i class="fas fa-exclamation-circle text-warning"></i>
                            {{ $error }}
                        </div>
                    @endforeach
                </div>
            `,
            showConfirmButton: true,
            confirmButtonText: 'Tamam',
            timer: 5000,
            customClass: {
                popup: 'animated fadeIn faster'
            }
        });
    @endif
</script>
@endpush

@push('css')
<link href="{{ asset('back/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<style>
/* Ana Kart Tasarımı */
.card {
    border: none;
    border-radius: 16px;
    box-shadow: 0 2px 20px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    background: #fff;
}

.card-header {
    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    color: white;
    border-radius: 16px 16px 0 0;
    padding: 1.2rem 1.5rem;
    border: none;
}

.card-body {
    padding: 2rem;
}

/* Form Elemanları */
.form-control, .form-select {
    border: 2px solid #e2e8f0;
    padding: 0.7rem 1rem;
    border-radius: 10px;
    font-size: 0.95rem;
    transition: all 0.2s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    background-color: #fff;
}

.form-control::placeholder {
    color: #94a3b8;
}

/* Etiketler */
label {
    font-weight: 500;
    color: #1e293b;
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
    display: block;
}

/* Tab Tasarımı */
.nav-tabs {
    border: none;
    background: #f1f5f9;
    border-radius: 12px;
    padding: 0.4rem;
    margin-bottom: 2rem;
}

.nav-tabs .nav-link {
    border: none;
    padding: 0.8rem 2rem;
    border-radius: 8px;
    font-weight: 500;
    color: #64748b;
    transition: all 0.3s ease;
}

.nav-tabs .nav-link:hover {
    color: #6366f1;
}

.nav-tabs .nav-link.active {
    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(99, 102, 241, 0.35);
}

/* Video Bölümü */
.video-item {
    background: #fff;
    border: 2px solid #e2e8f0 !important;
    border-radius: 12px;
    padding: 1.5rem !important;
    margin-bottom: 1rem;
    transition: all 0.3s ease;
}

.video-item:hover {
    border-color: #6366f1 !important;
    box-shadow: 0 5px 15px rgba(99, 102, 241, 0.1);
    transform: translateY(-2px);
}

/* Butonlar */
.btn {
    padding: 0.7rem 1.5rem;
    border-radius: 10px;
    font-weight: 500;
    transition: all 0.3s ease;
    border: none;
}

.btn-primary {
    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    box-shadow: 0 4px 15px rgba(99, 102, 241, 0.35);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
}

.btn-success {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.35);
}

.btn-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
}

.btn-danger {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    box-shadow: 0 4px 15px rgba(239, 68, 68, 0.35);
}

.btn-danger:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
}

/* Input Group */
.input-group-text {
    background: #f1f5f9;
    border: 2px solid #e2e8f0;
    border-left: none;
    color: #64748b;
    border-radius: 0 10px 10px 0;
    padding: 0.7rem 1rem;
}

/* Select2 Özelleştirme */
.select2-container--default .select2-selection--single {
    border: 2px solid #e2e8f0;
    height: 45px;
    border-radius: 10px;
    background-color: #fff;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 43px;
    padding-left: 1rem;
    color: #1e293b;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 43px;
}

/* Summernote Özelleştirme */
.note-editor.note-frame {
    border: 2px solid #e2e8f0;
    border-radius: 10px;
}

.note-editor.note-frame .note-toolbar {
    background: #f8fafc;
    border-bottom: 2px solid #e2e8f0;
    border-radius: 10px 10px 0 0;
    padding: 0.5rem;
}

/* Animasyonlar */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.tab-pane {
    animation: fadeIn 0.3s ease-in-out;
}

/* Hata Mesajları */
.text-danger {
    color: #ef4444;
    font-size: 0.85rem;
    margin-top: 0.4rem;
    display: block;
}

/* Responsive Düzenlemeler */
@media (max-width: 768px) {
    .card-body {
        padding: 1.5rem;
    }
    
    .nav-tabs .nav-link {
        padding: 0.6rem 1rem;
    }
    
    .video-item {
        padding: 1rem !important;
    }
}

/* Ana Bildirim Stilleri */
.alert {
    padding: 1rem 1.5rem;
    border: none;
    border-radius: 12px;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    animation: slideIn 0.3s ease-out;
}

/* Başarı Bildirimi */
.alert-success {
    background: linear-gradient(145deg, #10b981 0%, #059669 100%);
    color: #fff;
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.2);
}

/* Hata Bildirimi */
.alert-danger {
    background: linear-gradient(145deg, #ef4444 0%, #dc2626 100%);
    color: #fff;
    box-shadow: 0 4px 15px rgba(239, 68, 68, 0.2);
}

/* Uyarı Bildirimi */
.alert-warning {
    background: linear-gradient(145deg, #f59e0b 0%, #d97706 100%);
    color: #fff;
    box-shadow: 0 4px 15px rgba(245, 158, 11, 0.2);
}

/* SweetAlert2 Özelleştirmeleri */
.swal2-popup {
    border-radius: 16px !important;
    padding: 2rem !important;
}

.swal2-title {
    font-size: 1.5rem !important;
    font-weight: 600 !important;
    color: #1e293b !important;
}

.swal2-html-container {
    font-size: 1rem !important;
    color: #64748b !important;
}

.swal2-confirm {
    background: linear-gradient(145deg, #6366f1 0%, #4f46e5 100%) !important;
    border-radius: 10px !important;
    padding: 0.8rem 1.5rem !important;
    font-weight: 500 !important;
    box-shadow: 0 4px 15px rgba(99, 102, 241, 0.35) !important;
    border: none !important;
}

.swal2-confirm:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4) !important;
}

/* Animasyonlar */
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

/* Bildirim İkonları */
.alert::before {
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    font-size: 1.2rem;
}

.alert-success::before {
    content: "\f00c";
}

.alert-danger::before {
    content: "\f071";
}

.alert-warning::before {
    content: "\f06a";
}

/* Responsive */
@media (max-width: 768px) {
    .alert {
        padding: 1rem;
        font-size: 0.9rem;
    }
    
    .swal2-popup {
        padding: 1.5rem !important;
    }
    
    .swal2-title {
        font-size: 1.2rem !important;
    }
    
    .swal2-html-container {
        font-size: 0.9rem !important;
    }
}
</style>
@endpush
