@extends('layouts.app')
@php session()->put('activePage', 'terceirizados'); @endphp
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
                                    <h5 class="mb-0 text-white">Novo Terceirizado</h5>
                                </div>
                            </div>
                            <div class="card-body">  
                                <form action="{{route('terceirizado-store')}}" method="post" enctype="multipart/form-data" class="multisteps-form__form" style="height: 320px;">
                                @csrf
                                    <div class="multisteps-form__panel border-radius-xl bg-white js-active"
                                        data-animation="FadeIn">
                                        <div class="multisteps-form__content">
                                            <div class="row mt-3">
                                                <div class="col-12 col-sm-6">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Nome</label>
                                                        <input name="nome" class="multisteps-form__input form-control" type="text"
                                                            onfocus="focused(this)" onfocusout="defocused(this)">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Telefone</label>
                                                        <input name="telefone" id="telefone" class="multisteps-form__input form-control" type="text"
                                                            onfocus="focused(this)" onfocusout="defocused(this)">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-12 col-sm-6">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Data Nascimento</label>
                                                        <input name="dt_nascimento" id="dt_nascimento" class="multisteps-form__input form-control" type="text"
                                                            onfocus="focused(this)" onfocusout="defocused(this)">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Cidade</label>
                                                        <select name="cidade_id" class="form-control" style="display: none" id="cidade_id">
                                                            <option value="" selected disabled></option>
                                                            @foreach ($cidades as $key => $value)
                                                                <option value="{{$key}}">{{$value}}</option>
                                                            @endforeach
                                                        </select>
                                                        <input name="cidade" autocomplete="off" required onfocus="focused(this)" onfocusout="defocused(this)" class="form-control" type="text" list="choices-cidade" id="cidades_datalist">
                                                        <datalist  class="form-control" name="choices-cidade" id="choices-cidade" style="display: none">
                                                            @foreach ($cidades as $key => $value)
                                                                <option data-value="{{$key}}">{{$value}}</option>
                                                            @endforeach
                                                        </datalist>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12 col-sm-6">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Função</label>
                                                        <input name="funcao" class="multisteps-form__input form-control" type="text"
                                                            onfocus="focused(this)" onfocusout="defocused(this)">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Foto</label>
                                                        <input name="foto" id="foto" class="multisteps-form__input form-control" type="text"
                                                            onfocus="focused(this)" onfocusout="defocused(this)">
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
                                                <a href="{{route('clientes')}}">
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
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function(e) {
     
        document.querySelectorAll('#cidades_datalist').forEach(input => {
            input.addEventListener('change', function(e){
                let valueDatalist = 0
                let pai = input.parentElement
                let listagem = document.querySelectorAll('#choices-cidade option')
                console.log(listagem)

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
        $('#dt_nascimento').mask('00/00/0000');
        $('#telefone').mask('(00) 00000-0000');
    });
  

    
</script>
