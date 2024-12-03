@extends('back.layouts.master')

@section('title', 'Şirkət Adı')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Şirkət Adı</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Səhifə</a></li>
                                <li class="breadcrumb-item active">Şirkət Adı</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">Şirkət Adı Məlumatları</h4>
                                    @if($companies->count() == 0)
                                        <a href="{{ route('admin.home.company.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Yeni</a>
                                    @endif
                                </div>
                            </div>

                            <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Text 1</th>
                                        <th>Text 2</th>
                                        <th>Text 3</th>
                                        <th>Status</th>
                                        <th>Əməliyyatlar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($companies as $company)
                                        <tr>
                                            <td>{{ $company->text_1 }}</td>
                                            <td>{{ $company->text_2 }}</td>
                                            <td>{{ $company->text_3 }}</td>
                                            <td>
                                                <button type="button" 
                                                    onclick="changeStatus({{ $company->id }})"
                                                    class="btn btn-{{ $company->status == 1 ? 'success' : 'danger' }}">
                                                    {{ $company->status == 1 ? 'Aktiv' : 'Deaktiv' }}
                                                </button>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.home.company.edit', $company->id) }}" class="btn btn-warning">
                                                    <i class="fas fa-edit"></i> Redaktə et
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
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function changeStatus(id) {
            $.ajax({
                url: `{{ route('admin.home.company.status', '') }}/${id}`,
                type: 'GET',
                success: function(response) {
                    if(response.status === 'success') {
                        Swal.fire({
                            title: 'Uğurlu!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'Tamam'
                        }).then(() => {
                            window.location.reload();
                        });
                    }
                }
            });
        }
    </script>
@endpush