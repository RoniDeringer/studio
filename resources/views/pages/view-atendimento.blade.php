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
        <div class="col-5"></div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-10 mx-auto">
                            <div class="d-flex justify-content-center">
                                <h2>Corte de Cabelo </h2>
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
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js" integrity="sha256-2RS1U6UNZdLS0Bc9z2vsvV4yLIbJNKxyA4mrx5uossk=" crossorigin="anonymous"></script>
    <script>
        
    </script>
@endsection
