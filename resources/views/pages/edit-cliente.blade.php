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
                                    <h5 class="mb-0 text-white">Editar <h4 class="mb-0 text-white">{{$user->nome}}</h4></h5>
                                </div>
                            </div>
                            <div class="card-body">  
                                <form action="{{route('cliente-edit', $user->id)}}" method="post" enctype="multipart/form-data" class="multisteps-form__form" style="height: 300px;">
                                @csrf
                                    <div class="multisteps-form__panel border-radius-xl bg-white js-active"
                                        data-animation="FadeIn">
                                        <div class="multisteps-form__content">
                                            <div class="row mt-3">
                                                <div class="col-12 col-sm-6">
                                                    <div class="input-group input-group-dynamic @isset($user->nome) focused is-focused @endisset">
                                                        <label class="form-label">Nome</label>
                                                        <input name="nome" class="multisteps-form__input form-control" value="{{$user->nome}}" type="text"
                                                            onfocus="focused(this)" onfocusout="defocused(this)">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                    <div class="input-group input-group-dynamic  @isset($user->telefone) focused is-focused @endisset">
                                                        <label class="form-label">Telefone</label>
                                                        <input name="telefone" id="telefone" class="multisteps-form__input form-control" value="{{$user->telefone}}"
                                                            type="text" onfocus="focused(this)" onfocusout="defocused(this)">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-12 col-sm-6">
                                                    <div class="input-group input-group-dynamic @isset($user->data_nascimento) focused is-focused @endisset">
                                                        <label class="form-label">Data Nascimento</label>
                                                        <input name="dt_nascimento" class="multisteps-form__input form-control" value="{{$user->data_nascimento}}"
                                                            type="text" onfocus="focused(this)" onfocusout="defocused(this)" id="dt_nascimento">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                    <div class="input-group input-group-static mb-4">
                                                        <label for="cidade" class="ms-0">Cidade</label>
                                                        <select class="form-control" id="cidade" name="cidade">
                                                          <option value="dona_emma">Dona Emma</option>
                                                          <option value="presidente_getulio">Presidente Getúlio</option>
                                                          <option value="ibirama">Ibirama</option>
                                                          <option value="rio_do_sul">Rio do Sul</option>
                                                          <option value="Witmarsum">Witmarsum</option>
                                                          <option value="vitor_meireles">Vitor Meireles</option>
                                                          <option value="salete">Salete</option>
                                                          <option value="apiuna">Apiúna</option>
                                                        </select>
                                                      </div>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-12">
                                                    <div class="input-group input-group-dynamic @isset($cliente->observacao) focused is-focused @endisset">
                                                        <textarea name="observacao" class="multisteps-form__textarea form-control" rows="2"
                                                            placeholder="Observação">{{$cliente->observacao}}</textarea>
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
    //  if (document.getElementById('choices-state')) {
    //     var element = document.getElementById('choices-state');
    //     const example = new Choices(element, {
    //         searchEnabled: false
    //     });
    // };
    $(document).ready(function() {
        $('#dt_nascimento').mask('00/00/0000');
        $('#telefone').mask('(00) 00000-0000');
    });
    
  

    
</script>
