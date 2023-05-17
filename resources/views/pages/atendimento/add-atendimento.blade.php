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
            <div class="multisteps-form mb-9">

                <div class="row">
                    <div class="col-12 col-lg-8 mx-auto my-5">
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-8 m-auto">
                        <div class="card">
                           <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary text-center shadow-primary border-radius-lg pt-3 pb-3">
                                    <h5 class="mb-0 text-white">Novo Atendimento</h5>
                                </div>
                            </div>
                            <div class="card-body">  
                                <form action="{{route('atendimento-store')}}" method="post" enctype="multipart/form-data" class="multisteps-form__form" style="height: 260px;">
                                @csrf
                                    <div class="multisteps-form__panel border-radius-xl bg-white js-active"
                                        data-animation="FadeIn">
                                        <div class="multisteps-form__content">
                                            <div class="row mt-3">
                                                <div class="col-12 col-sm-6">
                                                    @if($clienteSelected)
                                                        <div class="input-group input-group-dynamic focused is-focused">
                                                            <label class="form-label" for="cliente_id">Cliente</label>
                                                            <select name="cliente_id" class="form-control" style="display: none" id="cliente_id">
                                                                <option value=""  disabled></option>
                                                                @foreach ($data['clientes'] as $cliente)
                                                                    <option value="{{$cliente['id']}}" @if($clienteSelected->id == $cliente['id']) selected @endif>{{$clienteSelected->nome}}</option>
                                                                @endforeach
                                                            </select>
                                                                @foreach ($data['clientes'] as $cliente)
                                                                    @if($clienteSelected->id == $cliente['id'])
                                                                        <input value="{{$cliente['nome']}}" name="cliente" autocomplete="new-password" required onfocus="focused(this)" onfocusout="defocused(this)" class="form-control" type="text" list="choices-cliente" id="clientes_datalist">
                                                                    @endif
                                                                @endforeach
                                                            <datalist  class="form-control" name="choices-cliente" id="choices-cliente" style="display: none">
                                                                @foreach ($data['clientes'] as $cliente)
                                                                    <option data-value="{{$cliente['id']}}">{{$cliente['nome']}}</option>
                                                                @endforeach
                                                            </datalist>
                                                        </div>
                                                    @else
                                                        <div class="input-group input-group-dynamic">
                                                            <label class="form-label">Cliente</label>
                                                            <select name="cliente_id" class="form-control" style="display: none" id="cliente_id">
                                                                <option value="" selected disabled></option>
                                                                @foreach ($data['clientes'] as $cliente)
                                                                    <option value="{{$cliente['id']}}">{{$cliente['nome']}}</option>
                                                                @endforeach
                                                            </select>
                                                            <input  name="cliente" autocomplete="new-password" required onfocus="focused(this)" onfocusout="defocused(this)" class="form-control" type="text" list="choices-cliente" id="clientes_datalist">
                                                            <datalist  class="form-control" name="choices-cliente" id="choices-cliente" style="display: none">
                                                                @foreach ($data['clientes'] as $cliente)
                                                                    <option data-value="{{$cliente['id']}}">{{$cliente['nome']}}</option>
                                                                @endforeach
                                                            </datalist>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Profissional</label>
                                                        <select name="profissional_id" class="form-control" style="display: none" id="profissional_id">
                                                            <option value="" selected disabled></option>
                                                            @foreach ($data['profissionais'] as $profissional)
                                                                <option value="{{$profissional['id_user']}}">{{$profissional['nome']}}</option>
                                                            @endforeach
                                                        </select>
                                                        <input  name="profissional" autocomplete="new-password" required onfocus="focused(this)" onfocusout="defocused(this)" class="form-control" type="text" list="choices-profissional" id="profissionais_datalist">
                                                        <datalist  class="form-control" name="choices-profissional" id="choices-profissional" style="display: none">
                                                            @foreach ($data['profissionais'] as $profissional)
                                                                <option data-value="{{$profissional['id_user']}}">{{$profissional['nome']}}</option>
                                                            @endforeach
                                                        </datalist>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-12 col-sm-4">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Serviço</label>
                                                        <select name="servico_id" class="form-control" style="display: none" id="servico_id">
                                                            <option value="" selected disabled></option>
                                                            @foreach ($data['servicos'] as $servico)
                                                                <option value="{{$servico['id']}}">{{$servico['nome']}}</option>
                                                            @endforeach
                                                        </select>
                                                        <input  name="servico" autocomplete="new-password" required onfocus="focused(this)" onfocusout="defocused(this)" class="form-control" type="text" list="choices-servico" id="servicos_datalist">
                                                        <datalist  class="form-control" name="choices-servico" id="choices-servico" style="display: none">
                                                            @foreach ($data['servicos'] as $servico)
                                                                <option data-value="{{$servico['id']}}">{{$servico['nome']}}</option>
                                                            @endforeach
                                                        </datalist>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-4">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Valor</label>
                                                        <input name="valor" id="valor" class="multisteps-form__input form-control" type="text"
                                                            onfocus="focused(this)" onfocusout="defocused(this)">
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-4">
                                                    <div class="input-group input-group-dynamic is-filled">
                                                        <label class="form-label">Data</label>
                                                        <input required name="data" class="multisteps-form__input form-control" value="{{$data['dataAtual']}}" type="text"
                                                            onfocus="focused(this)" onfocusout="defocused(this)" id="data">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-12">
                                                    <div class="input-group input-group-dynamic">
                                                        <textarea name="observacao" class="multisteps-form__textarea form-control" rows="2"
                                                            placeholder="Observação"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="button-row d-flex justify-content-between mt-4">
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
{{-- <script defer="" src="https://static.cloudflareinsights.com/beacon.min.js/v2b4487d741ca48dcbadcaf954e159fc61680799950996" integrity="sha512-D/jdE0CypeVxFadTejKGTzmwyV10c1pxZk/AqjJuZbaJwGMyNHY3q/mTPWqMUnFACfCTunhZUVcd4cV78dK1pQ==" data-cf-beacon="{&quot;rayId&quot;:&quot;7ba0e988a878f8fd&quot;,&quot;version&quot;:&quot;2023.3.0&quot;,&quot;r&quot;:1,&quot;token&quot;:&quot;1b7cbb72744b40c580f8633c6b62637e&quot;,&quot;si&quot;:100}" crossorigin="anonymous"></script> --}}
{{-- <script src="{{asset('js/theme/plugins/multistep-form.js')}}"></script> --}}
{{-- <script src="{{asset('js/theme/plugins/choices.min.js')}}"></script> --}}
{{-- <script src="{{asset('js/theme/plugins/popper.min.js')}}"></script> --}}
{{-- <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script> --}}
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.min.js" integrity="sha512-Ty04j+bj8CRJsrPevkfVd05iBcD7Bx1mcLaDG4lBzDSd6aq2xmIHlCYQ31Ejr+JYBPQDjuiwS/NYDKYg5N7XKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>

    $(document).ready(function() {
        $('#valor').mask('000,00');
        $('#data').mask('00/00/0000');
    });

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
            input.addEventListener('change', function(e){
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


    })

    
</script>
