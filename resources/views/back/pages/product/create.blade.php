@extends('back.layouts.master')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            
            <!-- Bildirim alanı -->
            <div class="row">
                <div class="col-12">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
            </div>

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Məhsullar</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Məhsullar</a></li>
                                <li class="breadcrumb-item active">Əlavə et</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Məhsul əlavə et</h4>
                            <ul class="nav nav-pills nav-justified" role="tablist">
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#az" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block">AZ</span>
                                    </a>
                                </li>
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" data-bs-toggle="tab" href="#en" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                        <span class="d-none d-sm-block">EN</span>
                                    </a>
                                </li>
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" data-bs-toggle="tab" href="#ru" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                        <span class="d-none d-sm-block">RU</span>
                                    </a>
                                </li>
                            </ul>
                            <form class="needs-validation" method="POST" action="{{ route('admin.product.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="tab-content p-3 text-muted">
                                        <div class="tab-pane active" id="az">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="validationCustom03" class="form-label">Başlıq (Az)</label>
                                                    <input type="text" name="title_az" value="{{ old('title_az') }}"
                                                        class="form-control">
                                                    @error('title_az')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="validationCustom03" class="form-label">Şəkil başlıq
                                                        (Az)</label>
                                                    <input type="text" name="image_title_az"
                                                        value="{{ old('image_title_az') }}" class="form-control">
                                                    @error('image_title_az')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="validationCustom03" class="form-label">Şəkil alt
                                                        (Az)</label>
                                                    <input type="text" name="image_alt_az"
                                                        value="{{ old('image_alt_az') }}" class="form-control">
                                                    @error('image_alt_az')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="validationCustom03" class="form-label">Meta title
                                                        (Az)</label>
                                                    <input type="text" name="meta_title_az"
                                                        value="{{ old('meta_title_az') }}" class="form-control">
                                                    @error('meta_title_az')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="validationCustom03" class="form-label">Meta description
                                                        (Az)</label>
                                                    <input type="text" name="meta_description_az"
                                                        value="{{ old('meta_description_az') }}" class="form-control">
                                                    @error('meta_description_az')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="validationCustom03" class="form-label">Mətn (Az)</label>
                                                    <textarea name="description_az" class="summernote form-control">{{ old('description_az') }}</textarea>
                                                    @error('description_az')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror

                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="en">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="validationCustom03" class="form-label">Başlıq (En)</label>
                                                    <input type="text" name="title_en" value="{{ old('title_en') }}"
                                                        class="form-control">
                                                    @error('title_en')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="validationCustom03" class="form-label">Şəkil başlıq
                                                        (En)</label>
                                                    <input type="text" name="image_title_en"
                                                        value="{{ old('image_title_en') }}" class="form-control">
                                                    @error('image_title_en')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="validationCustom03" class="form-label">Şəkil alt
                                                        (En)</label>
                                                    <input type="text" name="image_alt_en"
                                                        value="{{ old('image_alt_en') }}" class="form-control">
                                                    @error('image_alt_en')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="validationCustom03" class="form-label">Meta title
                                                        (En)</label>
                                                    <input type="text" name="meta_title_en"
                                                        value="{{ old('meta_title_en') }}" class="form-control">
                                                    @error('meta_title_en')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="validationCustom03" class="form-label">Meta description
                                                        (En)</label>
                                                    <input type="text" name="meta_description_en"
                                                        value="{{ old('meta_description_en') }}" class="form-control">
                                                    @error('meta_description_en')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="validationCustom03" class="form-label">Mətn (En)</label>
                                                    <textarea name="description_en" class="summernote form-control">{{ old('description_en') }}</textarea>
                                                    @error('description_en')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror

                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="ru">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="validationCustom03" class="form-label">Başlıq (Ru)</label>
                                                    <input type="text" name="title_ru" value="{{ old('title_ru') }}"
                                                        class="form-control">
                                                    @error('title_ru')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="validationCustom03" class="form-label">Şəkil başlıq
                                                        (Ru)</label>
                                                    <input type="text" name="image_title_ru"
                                                        value="{{ old('image_title_ru') }}" class="form-control">
                                                    @error('image_title_ru')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="validationCustom03" class="form-label">Şəkil alt
                                                        (Ru)</label>
                                                    <input type="text" name="image_alt_ru"
                                                        value="{{ old('image_alt_ru') }}" class="form-control">
                                                    @error('image_alt_ru')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="validationCustom03" class="form-label">Meta title
                                                        (Ru)</label>
                                                    <input type="text" name="meta_title_ru"
                                                        value="{{ old('meta_title_ru') }}" class="form-control">
                                                    @error('meta_title_ru')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="validationCustom03" class="form-label">Meta description
                                                        (Ru)</label>
                                                    <input type="text" name="meta_description_ru"
                                                        value="{{ old('meta_description_ru') }}" class="form-control">
                                                    @error('meta_description_ru')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="validationCustom03" class="form-label">Mətn (Ru)</label>
                                                    <textarea name="description_ru" class="summernote form-control">{{ old('description_ru') }}</textarea>
                                                    @error('description_ru')
                                                        <div class="invalid-feedback" style="display: block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Satış qiyməti</label>
                                            <input type="text" class="form-control" name="sale_price"
                                                value="{{ old('sale_price') }}">
                                            @error('sale_price')
                                                <div class="invalid-feedback" style="display: block;">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Endirim Faizi</label>
                                            <input type="text" class="form-control" name="discount"
                                                value="{{ old('discount') }}">
                                            @error('discount')
                                                <div class="invalid-feedback" style="display: block;">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Say</label>
                                            <input type="number" name="count" value="{{ old('count') }}"
                                                class="form-control">
                                            @error('count')
                                                <div class="invalid-feedback" style="display: block;">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Əsas şəkil</label>
                                            <input type="file" class="form-control" accept=".png,.jpg,.jpeg,.svg"
                                                name="image">
                                            <div class="upload-container mt-3 row">
                                            </div>
                                            @error('image')
                                                <div class="invalid-feedback" style="display: block">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Şəkillər</label>
                                            <input type="file" name="images[]" multiple class="form-control"
                                                accept=".png,.svg,.jpg,.jpeg">
                                            <div class="upload-container row mt-3"></div>
                                            @error('images')
                                                <div class="invalid-feedback" style="display: block">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="mb-3">Kateqoriya</div>
                                        <select class="form-control select2" name="category_id" onchange="get_sub_categories(this)">
                                            <option value="">Seçim edin</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name_az }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback" style="display: block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="mb-3">Alt kateqoriya</div>
                                        <select class="form-control select2" name="sub_category_id">
                                            <option value="">Seçim edin</option>
                                        </select>
                                        @error('sub_category_id')
                                            <div class="invalid-feedback" style="display: block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary" type="submit">Təsdiqlə</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end card -->
                </div> <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link href="{{ asset('back/assets') }}/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css">
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="{{ asset('back/assets') }}/libs/select2/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".summernote").summernote();
            $('.dropdown-toggle').dropdown();
        });
    </script>
    <!-- //Summernote JS - CDN Link -->
    <script src="{{ asset('back/assets/js/pages/file-upload.js') }}"></script>
    <script>
        $('select').select2();
    </script>

    <script>
        function get_sub_categories(elem) {
            let category_id = elem.value;
            let sub_category_select = $('[name="sub_category_id"]');
            
            // Kategori seçili değilse
            if (!category_id) {
                sub_category_select.html('<option value="">Seçim edin</option>');
                return;
            }

            // Loading göster
            sub_category_select.html('<option>Yüklənir...</option>');
            
            // Alt kategorileri getir
            $.ajax({
                url: "{{ route('admin.product.get-sub-category', '') }}/" + category_id,
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status === 'success') {
                        sub_category_select.html(response.view);
                    } else {
                        sub_category_select.html('<option value="">Alt kateqoriya tapılmadı</option>');
                    }
                },
                error: function(xhr) {
                    console.error('AJAX Xətası:', xhr);
                    sub_category_select.html('<option value="">Xəta baş verdi</option>');
                }
            });
        }

        // Sayfa yüklendiğinde
        $(document).ready(function() {
            // Select2'yi başlat
            $('select').select2();
            
            // Seçili kategori varsa alt kategorileri getir
            let selected_category = $('[name="category_id"]').val();
            if (selected_category) {
                get_sub_categories({ value: selected_category });
            }
        });
    </script>
@endpush
