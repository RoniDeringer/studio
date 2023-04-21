@extends('layouts.app')
@php session()->put('activePage', 'clientes'); @endphp
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
        @isset($clientes)
        <div class="text-dark">
            https://www.creative-tim.com/live/material-dashboard-pro-laravel
        </div>
        <div class="card mt-5 pb-5">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-info shadow text-center border-radius-xl mt-n4 float-start">
                    <i class="material-icons opacity-10">groups</i>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="mb-0">Clientes</h5>
                    </div>
                    <div class="col-md-5">
                        <div class="d-flex justify-content-end">
                            <a href="{{route('add-cliente')}}"
                                class="mr-3 justify-content-end btn bg-gradient-primary btn-sm mb-0">+&nbsp; Cliente
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="table-responsive">
                            <div id="table-listagem-integrador_filter" class="dataTables_filter ">
                            </div>
                            <table class="table align-items-center mb-0" id="table-listagem-integrador">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">Nome</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">Cidade</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">Telefone</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">Aniversário</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">Total gasto</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">Nº Atendimentos</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clientes as $cliente)
                                        <tr>
                                            <td class="py-3"><a href="{{route('atendimentos-cliente',$cliente->id_user)}}">{{ $cliente->nome }}</a></td>
                                            <td class="py-3">{{ $cliente->cidade }}</td>
                                            <td class="py-3">{{ $cliente->telefone }}</td>
                                            <td class="py-3">
                                                @if ($cliente->data_nascimento)
                                                    {{ date('d/m/Y', strtotime($cliente->data_nascimento)) }}
                                                @endif
                                            </td>
                                            <td class="py-3">
                                                @if ($cliente->cidade)
                                                    {{-- R$ {{ number_format($cliente->valor_total, 2, ',', '.') }} --}}
                                                    R$ 500,00
                                                @endif
                                            </td>
                                            <td class="py-3">5</td>
                                            <td class="text-sm">
                                                <a href="javascript:;" data-bs-toggle="tooltip" data-bs-original-title="Preview product">
                                                    <i class="material-icons text-secondary position-relative text-lg">visibility</i>
                                                </a>
                                                <a href="{{route('editar-cliente',$cliente->id_cliente)}}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit product">
                                                    <i class="material-icons text-secondary position-relative text-lg">drive_file_rename_outline</i>
                                                </a>
                                                <a href="#" onclick="modalDelete({{$cliente->id_cliente}})" data-bs-toggle="tooltip" data-bs-original-title="Delete product">
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
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="{{asset('js/theme/plugins/datatables.min.js')}}"></script>
<script src="{{asset('js/theme/core/bootstrap.min.js')}}"></script>
<script src="{{asset('js/theme/plugins/sweetalert.min.js')}}"></script>

<script>
    $(document).ready(function() {
        $('#table-listagem-integrador').DataTable({
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
    function modalDelete(id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-danger ms-3',
                cancelButton: 'btn btn-secondary' // adiciona uma margem de 3px para a direita
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Deseja mesmo excluir?',
            text: "Você excluirá todos os registros de atendimentos desse cliente!",
            icon: 'error',
            showCancelButton: true,
            confirmButtonText: 'Excluir',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('cliente-destroy', ':id') }}".replace(':id', id);
            }
        })
    }
</script>
