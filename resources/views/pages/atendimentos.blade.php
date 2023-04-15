<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<style>
    td button.btn-icon{
        padding: 10px;
    }
</style>
<x-layout bodyClass="g-sidenav-show  bg-gray-200">
        <x-navbars.sidebar activePage="atendimentos"></x-navbars.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <x-navbars.navs.auth titlePage="Atendimentos"></x-navbars.navs.auth>
            <!-- End Navbar -->
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col">
                        @isset($atendimentos)
                            <div class="card mt-5 pb-5">
                                <div class="card-header p-3 pt-2">
                                    <div
                                        class="icon icon-lg icon-shape bg-gradient-info shadow text-center border-radius-xl mt-n4 float-start">
                                        <i class="material-icons opacity-10">view_list</i>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <h5 class="mb-0">Atendimentos</h5>
                                        </div>
                                        <div class="col-md-3" style="text-align: right" id="export-csv">
                                            <a href="{{route('atendimentos')}}">
                                                <button type="button" class="btn btn-dark">Exportar CSV</button>
                                            </a>
            
                                            <thead>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="table-responsive">
                                                <table class="table align-items-center mb-0" id="table-projetos">
                                                    <tbody>
                                                        @foreach ($atendimentos as $atendimento)
                                                        {{-- @php dd($atendimento) @endphp --}}
                                                            <tr>
                                                                <td>
                                                                    <ul class="list-group list-group-flush">
                                                                        <li class="list-group-item border-0 flex-column align-items-start ps-0 py-0 mb-3">
                                                                            <div class="checklist-item checklist-item-primary ps-2 ms-3">
                                                                                <div class="d-flex align-items-center">
                                                                                    <h6 class="mb-0 text-dark">
                                                                                        {{-- <a href="{{route('admin-projetos-ver', $atendimento)}}">{{ $atendimento->nome_cliente }}</a> --}}
                                                                                        <a href="#">{{ $atendimento->nome_cli }}</a>
                                                                                    </h6>
                                                                                    <div class="dropstart  float-lg-end ms-auto">
                                                                                        {{-- <a href="{{route('admin-projetos-edit', $atendimento)}}" class="btn btn-icon btn-info">
                                                                                            <span class="btn-inner--icon"><i class="material-icons">edit</i></span>
                                                                                        </a> --}}
                                                                                    </div>
                                                                                </div>
                                                                                {{-- <a href="{{route('admin-projetos-ver', $atendimento)}}" class="d-flex align-items-center ms-4 mt-3 ps-1 link-principal"> --}}
                                                                                <a href="#" class="d-flex align-items-center ms-4 mt-3 ps-1 link-principal">
                                                                                    <div class="col-md-3 text-secondary">
                                                                                        <p class="mb-0">
                                                                                            @if($atendimento->nome_func)
                                                                                                Funcionário
                                                                                            @else
                                                                                                Terceirizado
                                                                                            @endif
                                                                                        </p>
                                                                                        <span class="text-xs text-bold">
                                                                                            @if($atendimento->nome_func)
                                                                                                {{$atendimento->nome_func}}
                                                                                            @else
                                                                                                {{$atendimento->nome_terc}}
                                                                                            @endif
                                                                                        </span>
                                                                                    </div>
                                                                                    <div class="col-md-4 text-secondary">
                                                                                        <p class="mb-0 text-secondary">Serviço</p>
                                                                                        <span class="text-xs text-bold">{{ $atendimento->servico}}</span>
                                                                                    </div>
                                                                                    <div class="col-md-2 text-secondary">
                                                                                        <p class="mb-0 text-secondary">Data</p>
                                                                                        <span class="text-xs text-bold">{{ $atendimento->data_atendimento }}</span>
                                                                                    </div>
                                                                                    <div class="col-md-2">
                                                                                        <p class="mb-0 text-secondary">Valor</p>
                                                                                        <span class="text-xs text-bold">{{ $atendimento->valor }}</span>
                                                                                    </div>
                                                                                </a>
                                                                            </div>
                                                                            <hr class="horizontal dark mt-4 mb-0">
                                                                        </li>
                                                                    </ul>
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
                <x-footers.auth></x-footers.auth>
            </div>
        </main>
        <x-plugins></x-plugins>

</x-layout>

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js" integrity="sha256-2RS1U6UNZdLS0Bc9z2vsvV4yLIbJNKxyA4mrx5uossk=" crossorigin="anonymous"></script>
<script>
    $(document).ready( function () {
        $('#table-projetos').DataTable(
            {
                responsive: true,
                pageLength: 25,
                stateSave: true,
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json"
                },
            }
        );
    });


</script>