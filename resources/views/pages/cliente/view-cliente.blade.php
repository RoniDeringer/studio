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

    <div class="col-10 mx-auto">
        <div class="row">
            <div class="col-6">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 float-start">
                                <i class="material-icons opacity-10">paid</i>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="mb-0">Faturamento</h6>
                                </div>
                                <div class="col-md-6 align-items-center text-end">
                                    <p class="text-sm mb-0 text-capitalize">Total Atendimentos</p>
                                <h5 class="mb-0">
                                    12
                                </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-10 mx-auto">
                            <a href="#"><h2 class="mb-0 text-primary">R$ 1212,00</h2></a>
                            <span class="font-weight-bolder">20 anos</span>
                        </div>
                        
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0">
                                <span class="text-success text-sm font-weight-bolder">
                                    25
                                </span>
                                atendimentos
                            </p>
                        </div>
                    </div>
                </div>


                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 float-start">
                                <i class="material-icons opacity-10">account_circle</i>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="mb-0">Funcionário</h6>
                                </div>
                                <div class="col-md-6 align-items-center text-end">
                                    <p class="text-sm mb-0 text-capitalize">Total ganho</p>
                                <h5 class="mb-0">
                                    R$ 4520,00
                                </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-10 mx-auto">
                            <a href="#"><h2 class="mb-0 text-primary">Eduarda Iomes</h2></a>
                            <span class="font-weight-bolder">19 anos</span>
                        </div>
                        
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0">
                                <span class="text-success text-sm font-weight-bolder">
                                    25
                                </span>
                                atendimentos
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    {{-- <span class="badge rounded-pill bg-dark w-30 mt-n2 mx-auto">Atendimento</span> --}}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-10 mx-auto">
                                <div class="d-flex justify-content-center">
                                    <h1 class="text-primary">Roni Deringer</h1>
                                </div>
                                <br>

                                <div class="mt-1 d-flex justify-content-between">
                                    <div class="col-6">
                                        <span class="badge badge-primary">Telefone</span>
                                        <h5 class="pt-2">(47)222222</h5>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex justify-content-end"><span class="badge badge-primary">Idade</span></div>
                                        <div class="d-flex justify-content-end"><h5 class="mb-0 mt-1">20 anos</h5></div>
                                        <div class="d-flex justify-content-end"><span class="text-xs">06/08/2002</span></div>
                                    </div>
                                </div>
                                <div class="mt-5 d-flex justify-content-between">
                                    <div class="col-6">
                                        <span class="badge badge-primary">Cidade</span>
                                        <h5 class="pt-2">Presidente Getúlio</h5>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex justify-content-end"><span class="badge badge-primary">Último Atendimento</span></div>
                                        <div class="d-flex justify-content-end"><span class="text-xs pt-2">Maio: Terça-Feira</span></div>
                                        <div class="d-flex justify-content-end"><h5 >12/04/2023</h5></div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <span class="mt-4 font-weight-bolder">Observação</span>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <div class="col-4 text-xs">
                                        The most beautiful curves of this swivel stool
                                        adds an elegant touch to any environment
                                    </div>
                                </div>



                                {{-- <td class="py-3">
                                    @if ($integrador->valor_total)
                                        R$ {{ number_format($integrador->valor_total, 2, ',', '.') }}
                                    @endif
                                </td>
                                <td class="py-3">
                                    @if ($integrador->data_recente)
                                        {{ date('d/m/Y', strtotime($integrador->data_recente)) }}
                                    @endif
                                </td> --}}



                                
                            </div>
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
