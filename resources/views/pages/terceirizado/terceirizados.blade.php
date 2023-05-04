@extends('layouts.app')
@php session()->put('activePage', 'terceirizados'); @endphp
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
    <div class="row my-4">
        <div class="col-11 mx-auto">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-primary shadow text-center border-radius-xl mt-n4 float-start">
                        <i class="material-icons opacity-10">handshake</i>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="mb-0">Terceirizados</h5>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-end">
                                <a href="{{route('add-terceirizado')}}">
                                    <button class="btn btn-icon btn-3 btn-primary" type="button">
                                        <span class="btn-inner--icon"><i class="material-icons">add</i></span>
                                      <span class="btn-inner--text">Terceirizado</span>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive mt-4">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Nome</th>
                                <th class="text-uppercase text-xxs font-weight-bolder opacity-7 ps-2">Função</th>
                                <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">Atendimentos</th>
                                <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">Rendimento</th>
                                <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($terceirizados as $terceirizado)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                @if($terceirizado->foto)
                                                    <img class="avatar avatar-sm me-3"  src="{{ asset('storage/imagens/' . $terceirizado->foto) }}" alt="Imagem">
                                                @else
                                                    <img class="avatar avatar-sm me-3"  src="{{ asset('storage/imagens/default_avatar.png') }}" alt="Imagem">
                                                @endif
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 font-weight-normal text-sm">{{$terceirizado->nome}}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-normal mb-0">{{$terceirizado->funcao}}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <p class="text-sm font-weight-normal mb-0">{{$terceirizado->total_atendimentos}}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        @if ($terceirizado->rendimento)
                                            <span class="badge badge-success">
                                                R$ {{ number_format($terceirizado->rendimento, 2, ',', '.') }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="align-middle text-center">
                                        {{-- <a href="#" data-bs-toggle="tooltip" data-bs-original-title="Preview product">
                                            <i class="material-icons text-secondary position-relative text-lg">visibility</i>
                                        </a> --}}
                                        <a href="{{route('editar-terceirizado', $terceirizado->terceirizado_id)}}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit product">
                                            <i class="material-icons text-secondary position-relative text-lg">drive_file_rename_outline</i>
                                        </a>
                                        <a  href="#" onclick="modalDelete({{$terceirizado->terceirizado_id}})" data-bs-toggle="tooltip" data-bs-original-title="Delete product">
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
            text: "Todos os atendimentos desse terceirizado irão ficar com registros vazios",
            icon: 'error',
            showCancelButton: true,
            confirmButtonText: 'Excluir',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                const inputValor = result.value;
                fetch('{{ route("terceirizado-destroy", ":id") }}'.replace(':id', $id), {
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
                            title: 'Terceirizado excluído!',
                        })

                        setTimeout(function() {
                            location.reload();
                        }, 3000);
                    }
                    console.log('Erro na solicitação de excluír terceirizado.')
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
