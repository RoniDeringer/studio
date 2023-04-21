@extends('layouts.app')
@php session()->put('activePage', 'atendimentos'); @endphp
@section('style')
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

<style>
    td button.btn-icon{
        padding: 10px;
    }
</style>
@endsection
@section('content')
    <div class="row">
        <div class="col">
            @isset($atendimentos)
                <div class="card mt-5 pb-5">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-primary shadow text-center border-radius-xl mt-n4 float-start">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <h5 class="mb-0">Atendimentos</h5>
                            </div>
                            <div class="col-md-3">
                                <div class="d-flex justify-content-end">
                                    <a href="{{route('add-atendimento')}}">
                                        <button class="btn btn-icon btn-3 btn-primary" type="button">
                                            <span class="btn-inner--icon"><i class="material-icons">add</i></span>
                                          <span class="btn-inner--text">Atendimento</span>
                                        </button>
                                    </a>
                                    
                                    <a href="#" style="padding-left:5px">
                                        <button class="justify-content-end btn btn-outline-primary mb-0 mt-sm-0 mt-1" data-type="csv" type="button"
                                            name="button">Export
                                        </button>
                                    </a>
                                </div>
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
                                                                                <h5 class="btn-inner--icon"><i class="material-icons">edit</i></h5>
                                                                            </a> --}}
                                                                        </div>
                                                                    </div>
                                                                    <a href="{{route('view-atendimento',$atendimento->id)}}" class="d-flex align-items-center ms-4 mt-3 ps-1 link-principal">
                                                                        <div class="col-md-2 text-dark">
                                                                            <h6 class="text-xs mb-1 opacity-8">Data</h6>
                                                                            <h5 class="text-md text-bold opacity-9">
                                                                                {{ date('d/m/Y', strtotime($atendimento->data_atendimento)) }}
                                                                            </h5>
                                                                        </div>
                                                                        <div class="col-md-3 text-dark">
                                                                            <h6 class="text-xs mb-1 opacity-8">Serviço</h6>
                                                                            <h5 class="text-md text-bold opacity-9">{{ $atendimento->servico}}</h5>
                                                                        </div>
                                                                        
                                                                        <div class="col-md-3 text-dark">
                                                                            <h6 class="text-xs mb-1 opacity-8">Valor</h6>
                                                                            <h5 class="text-md text-bold  opacity-9">
                                                                                R$ {{ number_format($atendimento->valor, 2, ',', '.') }}
                                                                            </h5>
                                                                        </div>
                                                                        <div class="col-md-3 text-dark">
                                                                            <h6 class="text-xs mb-1 opacity-8">
                                                                                @if($atendimento->nome_func)
                                                                                    Funcionário
                                                                                @else
                                                                                    Terceirizado
                                                                                @endif
                                                                            </h6>
                                                                            <h5 class="text-md text-bold opacity-9">
                                                                                @if($atendimento->nome_func)
                                                                                    {{$atendimento->nome_func}}
                                                                                @else
                                                                                    {{$atendimento->nome_terc}}
                                                                                @endif
                                                                            </h5>
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
@endsection

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
@endsection
