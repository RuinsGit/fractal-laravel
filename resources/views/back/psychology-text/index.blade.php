@extends('back.layouts.master')
@section('title', 'Psixologiya Mətnləri')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Psixologiya Mətnləri</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Səhifə</a></li>
                                <li class="breadcrumb-item active">Psixologiya Mətnləri</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-12">
                                <div class="d-flex justify-content-end mb-4">
                                    <a href="{{ route('admin.psychology-text.create') }}" class="btn btn-primary">
                                        <i class="ri-add-line"></i> Yeni
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#az" role="tab">
                                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                    <span class="d-none d-sm-block">Az</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#en" role="tab">
                                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                    <span class="d-none d-sm-block">En</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#ru" role="tab">
                                                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                                    <span class="d-none d-sm-block">Ru</span>
                                                </a>
                                            </li>
                                        </ul>

                                        <div class="tab-content p-3 text-muted">
                                            <div class="tab-pane active" id="az" role="tabpanel">
                                                <table id="datatable-az" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Mətn</th>
                                                            <th>Status</th>
                                                            <th>Əməliyyatlar</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($psychologyTexts as $psychologyText)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{!! Str::limit($psychologyText->text_az, 100) !!}</td>
                                                                <td>
                                                                    <button type="button" data-id="{{ $psychologyText->id }}" class="btn btn-{{ $psychologyText->status == 1 ? 'success' : 'danger' }} waves-effect waves-light change-status">
                                                                        {{ $psychologyText->status == 1 ? 'Aktiv' : 'Deaktiv' }}
                                                                    </button>
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('admin.psychology-text.edit', $psychologyText->id) }}" class="btn btn-warning waves-effect waves-light">
                                                                        <i class="ri-pencil-line"></i>
                                                                    </a>
                                                                    <button type="button" data-id="{{ $psychologyText->id }}" class="btn btn-danger waves-effect waves-light delete-data">
                                                                        <i class="ri-delete-bin-line"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="tab-pane" id="en" role="tabpanel">
                                                <table id="datatable-en" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Text</th>
                                                            <th>Status</th>
                                                            <th>Operations</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($psychologyTexts as $psychologyText)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{!! Str::limit($psychologyText->text_en, 100) !!}</td>
                                                                <td>
                                                                    <button type="button" data-id="{{ $psychologyText->id }}" class="btn btn-{{ $psychologyText->status == 1 ? 'success' : 'danger' }} waves-effect waves-light change-status">
                                                                        {{ $psychologyText->status == 1 ? 'Active' : 'Inactive' }}
                                                                    </button>
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('admin.psychology-text.edit', $psychologyText->id) }}" class="btn btn-warning waves-effect waves-light">
                                                                        <i class="ri-pencil-line"></i>
                                                                    </a>
                                                                    <button type="button" data-id="{{ $psychologyText->id }}" class="btn btn-danger waves-effect waves-light delete-data">
                                                                        <i class="ri-delete-bin-line"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="tab-pane" id="ru" role="tabpanel">
                                                <table id="datatable-ru" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Текст</th>
                                                            <th>Статус</th>
                                                            <th>Операции</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($psychologyTexts as $psychologyText)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{!! Str::limit($psychologyText->text_ru, 100) !!}</td>
                                                                <td>
                                                                    <button type="button" data-id="{{ $psychologyText->id }}" class="btn btn-{{ $psychologyText->status == 1 ? 'success' : 'danger' }} waves-effect waves-light change-status">
                                                                        {{ $psychologyText->status == 1 ? 'Активный' : 'Неактивный' }}
                                                                    </button>
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('admin.psychology-text.edit', $psychologyText->id) }}" class="btn btn-warning waves-effect waves-light">
                                                                        <i class="ri-pencil-line"></i>
                                                                    </a>
                                                                    <button type="button" data-id="{{ $psychologyText->id }}" class="btn btn-danger waves-effect waves-light delete-data">
                                                                        <i class="ri-delete-bin-line"></i>
                                                                    </button>
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
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#datatable-az').DataTable();
            $('#datatable-en').DataTable();
            $('#datatable-ru').DataTable();

            // Status dəyişdirmə
            $('.change-status').on('click', function() {
                let id = $(this).data('id');
                $.ajax({
                    url: `{{ route('admin.psychology-text.status', '') }}/${id}`,
                    type: 'GET',
                    success: function(response) {
                        if(response.status == 'success') {
                            toastr.success(response.message);
                            setTimeout(function() {
                                window.location.reload();
                            }, 2000);
                        }
                    }
                });
            });

            // Silmə əməliyyatı
            $('.delete-data').on('click', function() {
                let id = $(this).data('id');
                Swal.fire({
                    title: "Əminsiniz?",
                    text: "Silinən məlumat geri qaytarılmır!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Bəli, sil!",
                    cancelButtonText: "Xeyr"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `{{ route('admin.psychology-text.destroy', '') }}/${id}`,
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                if(response.status == 'success') {
                                    Swal.fire({
                                        title: "Silindi!",
                                        text: response.message,
                                        icon: "success"
                                    });
                                    setTimeout(function() {
                                        window.location.reload();
                                    }, 2000);
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush