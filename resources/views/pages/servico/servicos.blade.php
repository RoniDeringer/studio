@extends('layouts.app')
@php session()->put('activePage', 'atendimentos'); @endphp
@section('style')
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css" integrity="sha256-2bAj1LMT7CXUYUwuEnqqooPb1W0Sw0uKMsqNH0HwMa4=" crossorigin="anonymous" />

<style>
    td button.btn-icon{
        padding: 10px;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col">
        <div class="add-alert">
            @isset($servicos)
                <div class="card mt-5 pb-5">
                    <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-primary shadow text-center border-radius-xl mt-n4 float-start">
                            <i class="material-icons opacity-10">groups</i>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="mb-0">Serviços</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-end">
                                    <button onclick="modalAdd()" class="btn btn-icon btn-3 btn-primary" type="button">
                                        <span class="btn-inner--icon"><i class="material-icons">add</i></span>
                                    <span class="btn-inner--text">Serviço</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="table-responsive">
                                    <div id="table-listagem-servicos_filter" class="dataTables_filter">
                                    </div>
                                    <table class="table align-items-center mb-0" id="table-listagem-servicos">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary font-weight-bolder opacity-7">Data criação</th>
                                                <th class="text-uppercase text-secondary font-weight-bolder opacity-7">Nome</th>
                                                <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($servicos as $servico)
                                                <tr>
                                                    <td class="py-3">
                                                        @if ($servico->created_at)
                                                            {{ date('d/m/Y', strtotime($servico->created_at)) }}
                                                        @endif
                                                    </td>
                                                    
                                                    <td class="py-3">{{$servico->id}} - {{ $servico->nome }}</td>
                                                    <td class="py-3 text-sm">
                                                        <a style="cursor: pointer;" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit product">
                                                            <i class="material-icons text-secondary position-relative text-lg">drive_file_rename_outline</i>
                                                        </a>
                                                        <a onclick="modalDelete({{$servico->id}})" style="cursor: pointer;" data-bs-toggle="tooltip" data-bs-original-title="Delete product">
                                                            <i class="material-icons text-secondary position-relative text-lg">delete</i> 
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
            @endisset
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.min.js" integrity="sha512-Ty04j+bj8CRJsrPevkfVd05iBcD7Bx1mcLaDG4lBzDSd6aq2xmIHlCYQ31Ejr+JYBPQDjuiwS/NYDKYg5N7XKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="{{asset('js/theme/plugins/datatables.min.js')}}"></script>
<script src="{{asset('js/theme/core/bootstrap.min.js')}}"></script>
<script src="{{asset('js/theme/plugins/popper.min.js')}}"></script>

<script>
    $(document).ready(function() {
        $('#table-listagem-servicos').DataTable({
            responsive: true,
            pageLength: 25,
            order: [1, 'desc'],
            stateSave: true,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json"
            },
        });
    });

    // var form_rejeitar = document.getElementById('alert-delete');
    function modalAdd() {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success ms-3',
                cancelButton: 'btn btn-outline-secondary'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Adicionar novo serviço',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },

            showCancelButton: true,
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        })
        .then((result) => {
            if (result.isConfirmed) {
                const inputValor = result.value;
                fetch('{{ route("add-servico") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ 'valor': inputValor })
                })
                .then(response => {
                    if (response.ok) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Serviço criado!',
                        })

                        setTimeout(function() {
                            location.reload();
                        }, 3000);
                    }
                    console.log('Erro na solicitação de adicionar serviço.')
                })
                .catch(error => {
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro!',
                    })
                });
            }
        })
    }

    function modalDelete($id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-danger ms-3',
                cancelButton: 'btn btn-outline-secondary'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Deseja mesmo excluir?',
            text: "Todos os atendimentos desse serviço irão ficar com registros vazios",
            icon: 'error',
            showCancelButton: true,
            confirmButtonText: 'Excluir',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                const inputValor = result.value;
                fetch('{{ route("servico-destroy", ":id") }}'.replace(':id', $id), {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                })
                .then(response => {
                    if (response.ok) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Serviço excluído!',
                        })

                        setTimeout(function() {
                            location.reload();
                        }, 3000);
                    }
                    console.log('Erro na solicitação de excluír serviço.')
                })
                .catch(error => {
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro!',
                    })
                });
            }
        })
    }
</script>
