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

                            <!-- Video Yükleme -->
                            <div class="mb-3">
                                <label>Video Faylları</label>
                                <input type="file" name="videos[]" class="form-control" multiple accept="video/*">
                                <small class="text-muted">Birdən çox video fayl seçə bilərsiniz</small>
                                @error('videos')<div class="text-danger">{{ $message }}</div>@enderror
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
</script>
@endpush

@push('css')
<link href="{{ asset('back/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
