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
        <div class="col-12">
            <div class="multisteps-form mb-2">
                <div class="row">
                    <div class="col-12 col-lg-8 mx-auto my-5">
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-8 m-auto">
                        <div class="card">
                           <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary text-center shadow-primary border-radius-lg pt-3 pb-3">
                                    <h5 class="mb-0 text-white">Editar Atendimento</h4></h5>
                                </div>
                            </div>
                            <div class="card-body">  
                                <form action="{{route('atendimento-edit', $atendimento->id)}}" method="post" enctype="multipart/form-data" class="multisteps-form__form" style="height: 300px;">
                                @csrf
                                    <div class="multisteps-form__panel border-radius-xl bg-white js-active"
                                        data-animation="FadeIn">
                                        <div class="multisteps-form__content">
                                            <div class="row mt-3">
                                                <div class="col-12 col-sm-6">
                                                    <div class="input-group input-group-dynamic @isset($atendimento->id_cliente) focused is-focused @endisset">
                                                        <label class="form-label" for="cliente_id">Cliente</label>
                                                        <select name="cliente_id" class="form-control" style="display: none" id="cliente_id">
                                                            <option value=""  disabled></option>
                                                            @foreach ($data['clientes'] as $cliente)
                                                                <option value="{{$cliente['id']}}" @if($atendimento->id_cliente == $cliente['id']) selected @endif>{{$cliente['nome']}}</option>
                                                            @endforeach
                                                        </select>
                                                            @foreach ($data['clientes'] as $cliente)
                                                                @if($atendimento->id_cliente == $cliente['id'])
                                                                    <input value="{{$cliente['nome']}}" name="cliente" autocomplete="new-password" required onfocus="focused(this)" onfocusout="defocused(this)" class="form-control" type="text" list="choices-cliente" id="clientes_datalist">
                                                                @endif
                                                            @endforeach
                                                        <datalist  class="form-control" name="choices-cliente" id="choices-cliente" style="display: none">
                                                            @foreach ($data['clientes'] as $cliente)
                                                                <option data-value="{{$cliente['id']}}">{{$cliente['nome']}}</option>
                                                            @endforeach
                                                        </datalist>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    @if(isset($atendimento->id_terceirizado))
                                                        <div class="input-group input-group-dynamic @isset($atendimento->id_terceirizado) focused is-focused @endisset">
                                                            <label class="form-label" for="profissional_id">Profissional</label>
                                                            <select name="profissional_id" class="form-control" style="display: none" id="profissional_id">
                                                                <option value="" disabled></option>
                                                                @foreach ($data['profissionais'] as $profissional)
                                                                    <option value="{{$profissional['id_user']}}" @if($atendimento->id_terceirizado == $profissional['id_terceirizado']) selected @endif>{{$profissional['nome']}}</option>
                                                                @endforeach
                                                            </select>
                                                                @foreach ($data['profissionais'] as $profissional)
                                                                    @if($atendimento->id_terceirizado == $profissional['id_terceirizado'])
                                                                        <input value="{{$profissional['nome']}}" name="profissional" autocomplete="new-password" required onfocus="focused(this)" onfocusout="defocused(this)" class="form-control" type="text" list="choices-profissional" id="profissionais_datalist">
                                                                    @endif
                                                                @endforeach
                                                            <datalist  class="form-control" name="choices-profissional" id="choices-profissional" style="display: none">
                                                                @foreach ($data['profissionais'] as $profissional)
                                                                    <option data-value="{{$profissional['id_user']}}">{{$profissional['nome']}}</option>
                                                                @endforeach
                                                            </datalist>
                                                        </div>
                                                    @else


                                                        <div class="input-group input-group-dynamic @isset($atendimento->id_funcionario) focused is-focused @endisset">
                                                            <label class="form-label" for="profissional_id">Profissional</label>
                                                            <select name="profissional_id" class="form-control" style="display: none" id="profissional_id">
                                                                <option value="" disabled></option>
                                                                @foreach ($data['profissionais'] as $profissional)
                                                                    <option value="{{$profissional['id_user']}}" @if($atendimento->id_funcionario == $profissional['id_funcionario']) selected @endif>{{$profissional['nome']}}</option>
                                                                @endforeach
                                                            </select>
                                                                @foreach ($data['profissionais'] as $profissional)
                                                                    @if($atendimento->id_funcionario == $profissional['id_funcionario'])
                                                                        <input value="{{$profissional['nome']}}" name="profissional" autocomplete="new-password" required onfocus="focused(this)" onfocusout="defocused(this)" class="form-control" type="text" list="choices-profissional" id="profissionais_datalist">
                                                                    @endif
                                                                @endforeach
                                                            <datalist  class="form-control" name="choices-profissional" id="choices-profissional" style="display: none">
                                                                @foreach ($data['profissionais'] as $profissional)
                                                                    <option data-value="{{$profissional['id_user']}}">{{$profissional['nome']}}</option>
                                                                @endforeach
                                                            </datalist>
                                                        </div>



                                                    @endif
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="col-12 col-sm-4">
                                                        <div class="input-group input-group-dynamic @isset($atendimento->servico) focused is-focused @endisset">
                                                            <label class="form-label" for="servico_id">Serviço</label>
                                                            <select name="servico_id" class="form-control" style="display: none" id="servico_id">
                                                                <option value="" disabled></option>
                                                                @foreach ($data['servicos'] as $servico)
                                                                    <option value="{{$servico['id']}}" @if($atendimento->servico == $servico['id']) selected @endif>{{$servico['nome']}}</option>
                                                                @endforeach
                                                            </select>
                                                                @foreach ($data['servicos'] as $servico)
                                                                    @if($atendimento->servico == $servico['id'])
                                                                        <input value="{{$servico['nome']}}" name="servico" autocomplete="new-password" required onfocus="focused(this)" onfocusout="defocused(this)" class="form-control" type="text" list="choices-servico" id="servicos_datalist">
                                                                    @endif
                                                                @endforeach
                                                            <datalist  class="form-control" name="choices-servico" id="choices-servico" style="display: none">
                                                                @foreach ($data['servicos'] as $servico)
                                                                    <option data-value="{{$servico['id']}}">{{$servico['nome']}}</option>
                                                                @endforeach
                                                            </datalist>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-4">
                                                        <div class="input-group input-group-dynamic @isset($atendimento->valor) focused is-focused @endisset">
                                                            <label class="form-label">Valor</label>
                                                            <input name="valor" value="{{ number_format($atendimento->valor, 2, ',', '.') }}" id="valor" class="multisteps-form__input form-control" type="text"
                                                                onfocus="focused(this)" onfocusout="defocused(this)">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-4">
                                                        <div class="input-group input-group-dynamic @isset($atendimento->data) focused is-focused @endisset">
                                                            <label class="form-label">Data</label>
                                                            <input required name="data" value="{{ date('d/m/Y', strtotime($atendimento->data)) }}" class="multisteps-form__input form-control" type="text"
                                                                onfocus="focused(this)" onfocusout="defocused(this)" id="data">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="col-12">
                                                        <div class="input-group input-group-dynamic @isset($atendimento->observacao) focused is-focused @endisset">
                                                            <textarea name="observacao" class="multisteps-form__textarea form-control" rows="2"
                                                                placeholder="Observação">{{$atendimento->observacao}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                            <hr class="mt-5">
                                            <div class="button-row d-flex justify-content-between mt-1">
                                                <a href="{{route('atendimentos')}}">
                                                    <button class="btn btn-outline-secondary mb-3 mb-md-0 ms-auto" type="button">
                                                        Cancelar
                                                    </button>
                                                </a>
                                                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit" >
                                                    Salvar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

<script defer>
    function handleFileSelect(event) {
        var input = event.target;
        var button = document.getElementById("upload-button");
        if (input.files.length > 0) {
            button.disabled = true;
        }
    }
    document.addEventListener("DOMContentLoaded", function(e) {

            document.querySelectorAll('#clientes_datalist').forEach(input => {
                input.addEventListener('change', function(e){
                    let valueDatalist = 0
                    let pai = input.parentElement

                    let listagem = document.querySelectorAll('#choices-cliente option')
                    listagem.forEach(nome => {
                        if(nome.value == input.value){
                            valueDatalist = nome.getAttribute('data-value')
                        }
                    })
                    pai.childNodes[3].value = valueDatalist
                })
            })
       
        document.querySelectorAll('#profissionais_datalist').forEach(input => {
            console.log('querySelect')
            input.addEventListener('change', function(e){
                console.log('change')
                let valueDatalist = 0
                let pai = input.parentElement

                let listagem = document.querySelectorAll('#choices-profissional option')
                listagem.forEach(nome => {
                    if(nome.value == input.value){
                        valueDatalist = nome.getAttribute('data-value')
                    }
                })
                pai.childNodes[3].value = valueDatalist
            })
        })
       
        document.querySelectorAll('#servicos_datalist').forEach(input => {
            input.addEventListener('change', function(e){
                let valueDatalist = 0
                let pai = input.parentElement

                let listagem = document.querySelectorAll('#choices-servico option')
                listagem.forEach(nome => {
                    if(nome.value == input.value){
                        valueDatalist = nome.getAttribute('data-value')
                    }
                })
                pai.childNodes[3].value = valueDatalist
            })
        })
    });
    
    $(document).ready(function() {
        $('#data').mask('00/00/0000');
        $('#telefone').mask('(00) 00000-0000');
    });
    
  

    
</script>
