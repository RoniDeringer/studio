@extends('layouts.app')
@php session()->put('activePage', 'clientes'); @endphp
@section('style')
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

<style>
    td button.btn-icon{
        padding: 10px;
    }
</style>
@endsection
@section('content')

    <div class="row justify-content-center">
        {{-- <div class="col-10 mx-auto"> --}}
        {{-- <div class=""> --}}
            <div class="col-3 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Atendimentos</p>
                            <h2 class="mb-2">{{$atendimentos->total_atendimentos}}</h2>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        {{-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+2 </span>nesse mês</p> --}}
                    </div>
                </div>
            </div>
            <div class="col-3 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">payments</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Faturamento</p>
                            <h2 class="mb-2">R$ {{ number_format($atendimentos->valor_total, 2, ',', '.') }}</h2>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        {{-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">R$ 1.245,90 </span>nesse mês</p> --}}
                    </div>
                </div>
            </div>
            <div class="col-3 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">person</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">New Clients</p>
                            <h2 class="mb-0">3,462</h2>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">-2%</span> than
                            yesterday</p>
                    </div>
                </div>
            {{-- </div> --}}
        </div>
    </div>

    <div class="col-9  mt-6 mx-auto">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    {{-- <span class="badge rounded-pill bg-dark w-30 mt-n2 mx-auto">Atendimento</span> --}}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-10 mx-auto">
                                <div class="d-flex justify-content-center">
                                    <h1 class="text-primary">{{$cliente->nome}}</h1>
                                </div>
                                <hr class="dark horizontal my-0">
                                <br>

                                <div class="mt-1 d-flex justify-content-between">
                                    <div class="col-6">
                                        @if($cliente->telefone)
                                            <span class="badge badge-primary">Telefone</span>
                                            <h5 class="pt-2">
                                                {{ '(' . substr($cliente->telefone, 0, 2) . ') ' . substr($cliente->telefone, 2, 4) . '-' . substr($cliente->telefone, 6) }}
                                            </h5>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        @if($cliente->idade)
                                            <div class="d-flex justify-content-end"><span class="badge badge-primary">Idade</span></div>
                                            <div class="d-flex justify-content-end"><h5 class="mb-0 mt-1">{{$cliente->idade}} anos</h5></div>
                                            <div class="d-flex justify-content-end"><span class="text-xs">{{$cliente->dt_nascimento}}</span></div>
                                        @endif
                                    </div>
                                </div>
                                <div class="mt-5 d-flex justify-content-between">
                                    <div class="col-6">
                                        @if($cliente->cidade)
                                            <span class="badge badge-primary">Cidade</span>
                                            <h5 class="pt-2">{{$cliente->cidade}}</h5>
                                        @endif
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <span class="mt-4 font-weight-bolder">Observação</span>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <div class="col-4 text-xs">
                                        {{$cliente->observacao}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card h-100" style="padding-left:20px">
                    <div class="card-header pb-0">
                        <h6>Atendimentos Recentes</h6>
                        <p class="text-sm">
                            <i class="fa fa-arrow-down text-primary" aria-hidden="true"></i>
                            <span class="font-weight-bold">5 </span> últimos antendimentos
                        </p>
                    </div>
                    <div class="card-body p-3">
                        <div class="timeline timeline-one-side">
                            @foreach($ultimosAtendimentos as $ultimoAtendimento )
                                <div class="timeline-block mb-4">
                                    <span class="timeline-step">
                                        <i class="material-icons text-primary text-gradient">receipt_long</i>
                                    </span>
                                    <a href="{{route('view-atendimento', $ultimoAtendimento->id_atendimento)}}">
                                        <div class="timeline-content">
                                            <h6 class="text-dark text-sm font-weight-bold mb-0">R$ {{ number_format($ultimoAtendimento->valor, 2, ',', '.') }} | {{$ultimoAtendimento->servico}}
                                            </h6>
                                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0"> {{$ultimoAtendimento->data}}
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js" integrity="sha256-2RS1U6UNZdLS0Bc9z2vsvV4yLIbJNKxyA4mrx5uossk=" crossorigin="anonymous"></script>
    <script>
        
    </script>
@endsection
