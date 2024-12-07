@extends('back.layouts.master')
@section('title', 'Şirkət Siyahısı')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Şirkət Siyahısı</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Səhifə</a></li>
                                <li class="breadcrumb-item active">Şirkət</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="card-title">Şirkət Siyahısı</h4>
                                @if($companyCount == 0)
                                    <a href="{{ route('admin.home.company.create') }}" class="btn btn-primary waves-effect waves-light">
                                        <i class="fas fa-plus"></i> Yeni
                                    </a>
                                @endif
                            </div>

                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

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
                                                <table class="table table-bordered dt-responsive nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Mətn 1</th>
                                                            <th>Mətn 2</th>
                                                            <th>Mətn 3</th>
                                                            <th>Status</th>
                                                            <th>Əməliyyatlar</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($companies as $company)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $company->text_1_az }}</td>
                                                                <td>{{ $company->text_2_az }}</td>
                                                                <td>{{ $company->text_3_az }}</td>
                                                                <td>
                                                                    <button type="button" 
                                                                        onclick="changeStatus({{ $company->id }})"
                                                                        class="btn btn-{{ $company->status == 1 ? 'success' : 'danger' }} btn-sm status-button-{{ $company->id }}">
                                                                        {{ $company->status == 1 ? 'Aktiv' : 'Deaktiv' }}
                                                                    </button>
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('admin.home.company.edit', $company->id) }}" 
                                                                        class="btn btn-warning btn-sm">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>
                                                                    <button type="button" 
                                                                        onclick="deleteData({{ $company->id }})"
                                                                        class="btn btn-danger btn-sm">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="tab-pane" id="en" role="tabpanel">
                                                <table class="table table-bordered dt-responsive nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Text 1</th>
                                                            <th>Text 2</th>
                                                            <th>Text 3</th>
                                                            <th>Status</th>
                                                            <th>Operations</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($companies as $company)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $company->text_1_en }}</td>
                                                                <td>{{ $company->text_2_en }}</td>
                                                                <td>{{ $company->text_3_en }}</td>
                                                                <td>
                                                                    <button type="button" 
                                                                        onclick="changeStatus({{ $company->id }})"
                                                                        class="btn btn-{{ $company->status == 1 ? 'success' : 'danger' }} btn-sm status-button-{{ $company->id }}">
                                                                        {{ $company->status == 1 ? 'Active' : 'Deactive' }}
                                                                    </button>
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('admin.home.company.edit', $company->id) }}" 
                                                                        class="btn btn-warning btn-sm">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>
                                                                    <button type="button" 
                                                                        onclick="deleteData({{ $company->id }})"
                                                                        class="btn btn-danger btn-sm">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="tab-pane" id="ru" role="tabpanel">
                                                <table class="table table-bordered dt-responsive nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Текст 1</th>
                                                            <th>Текст 2</th>
                                                            <th>Текст 3</th>
                                                            <th>Статус</th>
                                                            <th>Операции</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($companies as $company)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $company->text_1_ru }}</td>
                                                                <td>{{ $company->text_2_ru }}</td>
                                                                <td>{{ $company->text_3_ru }}</td>
                                                                <td>
                                                                    <button type="button" 
                                                                        onclick="changeStatus({{ $company->id }})"
                                                                        class="btn btn-{{ $company->status == 1 ? 'success' : 'danger' }} btn-sm status-button-{{ $company->id }}">
                                                                        {{ $company->status == 1 ? 'Активный' : 'Неактивный' }}
                                                                    </button>
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('admin.home.company.edit', $company->id) }}" 
                                                                        class="btn btn-warning btn-sm">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>
                                                                    <button type="button" 
                                                                        onclick="deleteData({{ $company->id }})"
                                                                        class="btn btn-danger btn-sm">
                                                                        <i class="fas fa-trash"></i>
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

@push('css')
    <link href="{{ asset('back/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('back/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('back/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@push('js')
    <script src="{{ asset('back/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('back/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('back/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('back/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function changeStatus(id) {
            $.ajax({
                url: `{{ route('admin.home.company.status', '') }}/${id}`,
                type: 'GET',
                success: function(response) {
                    if(response.status === 'success') {
                        let buttons = document.querySelectorAll(`.status-button-${id}`);
                        buttons.forEach(button => {
                            if(response.newStatus) {
                                button.classList.remove('btn-danger');
                                button.classList.add('btn-success');
                                button.textContent = 'Aktiv';
                            } else {
                                button.classList.remove('btn-success');
                                button.classList.add('btn-danger');
                                button.textContent = 'Deaktiv';
                            }
                        });

                        Swal.fire({
                            title: 'Uğurlu!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'Tamam'
                        });
                    } else {
                        Swal.fire({
                            title: 'Xəta!',
                            text: response.message,
                            icon: 'error',
                            confirmButtonText: 'Tamam'
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        title: 'Xəta!',
                        text: 'Əməliyyat zamanı xəta baş verdi',
                        icon: 'error',
                        confirmButtonText: 'Tamam'
                    });
                }
            });
        }

        function deleteData(id) {
            Swal.fire({
                title: 'Əminsiniz?',
                text: "Bu məlumatı silmək istədiyinizə əminsiniz?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Bəli, Sil!',
                cancelButtonText: 'Xeyr'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `{{ route('admin.home.company.destroy', '') }}/${id}`;
                }
            });
        }
    </script>
@endpush