@extends('layouts.admin-app')

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
            @isset($projetos)
                <div class="card mt-5 pb-5">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-info shadow text-center border-radius-xl mt-n4 float-start">
                            <i class="material-icons opacity-10">view_list</i>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <h5 class="mb-0">Projetos / Oportunidades</h5>
                            </div>
                            <div class="col-md-3" style="text-align: right" id="export-csv">
                                <a href="{{route('admin-export-csv')}}">
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
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary font-weight-bolder opacity-7">Projeto</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($projetos as $projeto)
                                                {{-- @dump($projeto) --}}
                                                <tr>
                                                    <td>
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item border-0 flex-column align-items-start ps-0 py-0 mb-3">
                                                                <div class="checklist-item checklist-item-primary ps-2 ms-3">
                                                                    <div class="d-flex align-items-center">
                                                                        <h6 class="mb-0 text-dark">
                                                                            <a href="{{route('admin-projetos-ver', $projeto)}}">{{ $projeto->nome_cliente }}</a>
                                                                        </h6>
                                                                        <div class="dropstart  float-lg-end ms-auto">
                                                                            {{-- <a href="{{route('admin-projetos-edit', $projeto)}}" class="btn btn-icon btn-info">
                                                                                <span class="btn-inner--icon"><i class="material-icons">edit</i></span>
                                                                            </a> --}}
                                                                        </div>
                                                                    </div>
                                                                    <a href="{{route('admin-projetos-ver', $projeto)}}" class="d-flex align-items-center ms-4 mt-3 ps-1 link-principal">
                                                                        <div class="col-md-3 text-secondary">
                                                                            <p class="mb-0">CNPJ</p>
                                                                            <span class="text-xs text-bold">{{ $projeto->cnpj_cliente }}</span>
                                                                        </div>
                                                                        <div class="col-md-4 text-secondary">
                                                                            <p class="mb-0 text-secondary">Integrador</p>
                                                                            <span class="text-xs text-bold">{{ $projeto->name }}</span>
                                                                        </div>
                                                                        <div class="col-md-2 text-secondary">
                                                                            <p class="mb-0 text-secondary">Tipo</p>
                                                                            <span class="text-xs text-bold">{{ ucfirst($projeto->tipo) }}</span>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <p class="mb-0 text-secondary">Status</p>
                                                                            <span class="text-xs">
                                                                                @if ($projeto->status == 'aberto')
                                                                                    <span class="badge badge-success">Aberto</span>
                                                                                @elseif($projeto->status == 'finalizado')
                                                                                    <span class="badge badge-dark">Finalizado</span>
                                                                                @elseif($projeto->status == 'cancelado')
                                                                                    <span class="badge badge-danger">Cancelado</span>
                                                                                @else
                                                                                    <span class="badge badge-info">Concluído</span>
                                                                                @endif
                                                                            </span>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <form method="POST" action="{{ route('admin-projetos-cancelar', $projeto->id) }}" onsubmit="return confirm('Deseja mesmo cancelar?')">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit"  {{ $projeto->status != 'aberto' ? 'disabled' : '' }} class="btn btn-danger float-end">Cancelar</button>
                                                                            </form>
                                                                            <form method="POST" action="{{ route('admin-projetos-finalizar', $projeto->id) }}" onsubmit="return confirm('Deseja mesmo Finalizar?')">
                                                                                @csrf
                                                                                <button type="submit" {{ $projeto->status != 'aberto' ? 'disabled' : '' }} class="btn btn-dark float-end">Finalizar</button>
                                                                            </form>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <hr class="horizontal dark mt-4 mb-0">
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>

                                                <!-- Modal de confirmação -->
                                                <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="confirmModalLabel">Confirmação</h5>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body"></div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                <form method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="_method" value="DELETE">
                                                                    <button type="submit" class="btn btn-danger">Confirmar</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- MODAL EXCLUIR --}}
                                                {{-- <div class="modal fade" id="deleteProduto-{{$produto->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteProduto-{{$produto->id}}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-danger">
                                                                <h5 class="modal-title text-white" id="addCategoriaLabel">Excluir produto</h5>
                                                                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{route('admin-produtos-delete', $produto)}}" method="post">
                                                                    @csrf

                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <p>Tem certeza que deseja excluir o produto? Essa ação não poderá ser desfeita.</p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mt-3 text-end">
                                                                        <div class="col">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                                            <button type="submit" class="btn btn-danger">
                                                                                <span class="btn-inner--icon"><i class="material-icons">close</i></span>
                                                                                <span class="btn-inner--text">Excluir</span>
                                                                            </button>
                                                                        </div>
                                                                    </div>

                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> --}}

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

<script type="text/javascript" src="{{asset('/js/jsqrcode/src/grid.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/jsqrcode/src/version.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/jsqrcode/src/detector.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/jsqrcode/src/formatinf.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/jsqrcode/src/errorlevel.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/jsqrcode/src/bitmat.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/jsqrcode/src/datablock.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/jsqrcode/src/bmparser.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/jsqrcode/src/datamask.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/jsqrcode/src/rsdecoder.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/jsqrcode/src/gf256poly.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/jsqrcode/src/gf256.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/jsqrcode/src/decoder.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/jsqrcode/src/qrcode.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/jsqrcode/src/findpat.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/jsqrcode/src/alignpat.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/jsqrcode/src/databr.js')}}"></script>

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
