@extends('IntranetOne::io.layout.dashboard')

{{-- page level styles --}}
@section('header_styles')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/pickadate-full.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('io/services/io-entity.min.css') }}">
@stop

@section('main-heading')
@stop

@section('main-content')
	<!--section ends-->
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
				]
			])
			@endcomponent
	<!-- content -->
  @stop

  @section('after_body_scripts')
    @include('IntranetOne::base.social.fb-sdk',[
        'app_id'=>config('intranetone.social_media.facebook.app_id'),
        'app_version'=>config('intranetone.social_media.facebook.app_version'),
        'app_locale'=>config('intranetone.social_media.facebook.locale')
        ])
  @endsection

@section('footer_scripts')
<script src="{{ asset('js/pickadate-full.min.js') }}" type="text/javascript"></script>
{{-- <script src="{{ asset('io/services/jQuery-Mask-Plugin-master/dist/jquery.mask.min.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('io/services/jQuery-Autocomplete-master/dist/jquery.autocomplete.min.js') }}" type="text/javascript"></script> --}}
<script src="{{ asset('io/services/cidades_otimizado.js') }}" charset="ISO-8859-1" type="text/javascript"></script>
<script src="{{ asset('io/services/ext-jquery.mask.js') }}"></script>
<script src="{{ asset('io/services/io-entity-babel.min.js') }}"></script>
<script src="{{ asset('io/services/io-entity-mix.min.js') }}"></script>
<script src="{{ asset('io/services/io-entity.min.js') }}"></script>
@stop
