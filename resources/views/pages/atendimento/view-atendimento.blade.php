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

    <div class="col-10 mx-auto">
        <div class="row">
            <div class="col-6">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 float-start">
                                <i class="material-icons opacity-10">account_circle</i>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="mb-0">Cliente</h6>
                                </div>
                                <div class="col-md-6 align-items-center text-end">
                                    <p class="text-sm mb-0 text-capitalize">Total gasto</p>
                                <h5 class="mb-0">
                                    R$ 1500,00
                                </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-10 mx-auto">
                            <a href="#"><h2 class="mb-0 text-primary">Roni Deringer</h2></a>
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
                                    <h2 class="text-primary">Corte de Cabelo</h2>
                                </div>
                                <br>

                                <div class="mt-1 d-flex justify-content-between">
                                    <div class="col-6">
                                        <span class="badge badge-success">Valor</span>
                                        <h5 class="pt-2">R$ 250,00</h5>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex justify-content-end"><span class="badge badge-info">Data</span></div>
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
                                
                                <div class="row mt-4">
                                    <div class="col-lg-5 mt-lg-0 mt-2">
                                        <label class="ms-0">Frame Material</label>
                                        <div class="choices" data-type="select-one" tabindex="0" role="listbox"
                                            aria-haspopup="true" aria-expanded="false">
                                            <div class="choices__inner"><select class="form-control choices__input"
                                                    name="choices-material" id="choices-material" hidden="" tabindex="-1"
                                                    data-choice="active">
                                                    <option value="Choice 1">Wood</option>
                                                </select>
                                                <div class="choices__list choices__list--single">
                                                    <div class="choices__item choices__item--selectable" data-item=""
                                                        data-id="1" data-value="Choice 1" data-custom-properties="null"
                                                        aria-selected="true">Wood</div>
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
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js" integrity="sha256-2RS1U6UNZdLS0Bc9z2vsvV4yLIbJNKxyA4mrx5uossk=" crossorigin="anonymous"></script>
    <script>
        
    </script>
@endsection
