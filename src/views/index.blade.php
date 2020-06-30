@extends('IntranetOne::io.layout.dashboard')

{{-- page level styles --}}
@section('header_styles')
  <link rel="stylesheet" type="text/css" href="{{ asset('io/services/io-entity.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/pickadate-full.min.css') }}">
@stop

@section('main-content')
    @component('IntranetOne::io.components.nav-tabs',
    [
      "_id" => "default-tablist",
      "_active"=>0,
      "_tabs"=> [
        [
          "tab"=>"Listar",
          "icon"=>"ico ico-list",
          "view"=>"Entity::table-list"
        ],
        [
          "tab"=>"Cadastrar",
          "icon"=>"ico ico-new",
          "view"=>"Entity::form"
        ],
        [
          "tab"=>"Histórico",
          "icon"=>"ico ico-history",
          "view"=>"Entity::form-historico"
        ],      
      ]
    ])
    @endcomponent
@stop
@section('footer_scripts')
<script src="{{ asset('js/pickadate-full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/optimized_cities.js') }}" charset="ISO-8859-1" type="text/javascript"></script>

<script src="{{ asset('io/services/io-entity-history.min.js') }}"></script>
<script src="{{ asset('io/services/io-entity-babel.min.js') }}"></script>
<script src="{{ asset('io/services/io-entity-mix.min.js') }}"></script>

@stop
