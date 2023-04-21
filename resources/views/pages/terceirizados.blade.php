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
                                {{-- </a> --}}
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
                                <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">Telefone</th>
                                <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">Admissão</th>
                                <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">Rendimento</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="https://material-dashboard-pro-laravel.creative-tim.com/assets/img/team-2.jpg"
                                                class="avatar avatar-sm me-3" alt="avatar image">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 font-weight-normal text-sm">John Michael</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-normal mb-0">Manager</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="mb-0 font-weight-normal text-sm">john@user.com</p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-sm font-weight-normal mb-0">15/09/2022</p>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="badge badge-success">R$ 123,00</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="https://material-dashboard-pro-laravel.creative-tim.com/assets/img/team-3.jpg"
                                                class="avatar avatar-sm me-3" alt="avatar image">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 font-weight-normal text-sm">Alexa Liras</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-normal mb-0">Programator</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="mb-0 font-weight-normal text-sm">alexa@user.com</p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-sm font-weight-normal mb-0">11/01/19</p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-sm font-weight-normal mb-0">93021</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="https://material-dashboard-pro-laravel.creative-tim.com/assets/img/team-4.jpg"
                                                class="avatar avatar-sm me-3" alt="avatar image">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 font-weight-normal text-sm">Laurent Perrier</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-normal mb-0">Executive</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="mb-0 font-weight-normal text-sm">laurent@user.com</p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-sm font-weight-normal mb-0">19/09/17</p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-sm font-weight-normal mb-0">10392</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="https://material-dashboard-pro-laravel.creative-tim.com/assets/img/team-3.jpg"
                                                class="avatar avatar-sm me-3" alt="avatar image">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 font-weight-normal text-sm">Michael Levi</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-normal mb-0">Backend developer</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="mb-0 font-weight-normal text-sm">michael@user.com</p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-sm font-weight-normal mb-0">24/12/08</p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-sm font-weight-normal mb-0">34002</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="https://material-dashboard-pro-laravel.creative-tim.com/assets/img/team-2.jpg"
                                                class="avatar avatar-sm me-3" alt="avatar image">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 font-weight-normal text-sm">Richard Gran</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-normal mb-0">Manager</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="mb-0 font-weight-normal text-sm">richard@user.com</p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-sm font-weight-normal mb-0">04/10/21</p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-sm font-weight-normal mb-0">91879</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="https://material-dashboard-pro-laravel.creative-tim.com/assets/img/team-4.jpg"
                                                class="avatar avatar-sm me-3" alt="avatar image">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 font-weight-normal text-sm">Miriam Eric</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-normal mb-0">Programtor</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="mb-0 font-weight-normal text-sm">miriam@user.com</p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-sm font-weight-normal mb-0">14/09/20</p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-sm font-weight-normal mb-0">23042</p>
                                </td>
                            </tr>
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
