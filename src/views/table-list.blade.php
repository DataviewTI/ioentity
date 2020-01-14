@php
  use Dataview\IntranetOne\IntranetOne;
  use Dataview\IOEntity\Models\Otica;
  $oticas = Otica::select('id','alias','main','name')->orderBy('main')->orderBy('alias')->get();
  $situacao = IntranetOne::getEnumValues('entity_group','status');
@endphp

	<div class = 'row dt-filters-container'>
		<div class="col-sm-4 col-xs-12">
			<div class="form-group">
        <label for = 'subtitulo' class = 'bmd-label-static'><i class = 'ico ico-filter'></i> Nome, CPF/CNPJ ou Código</label>
        <input type = 'text' class = 'form-control form-control-lg' name ='ft_search' id = 'ft_search' />
			</div>
		</div>
    <div class="col-md-3 col-sm-12">
      <div class="form-group">
        <label for = 'ft_loja' class = 'bmd-label-static'><i class = 'ico ico-filter'></i> Ótica Origem</label>
        <select id = 'ft_loja' class = 'form-control form-control-lg'>
          <option value = ''>Todas</option>
            @foreach($oticas as $o)
              <option value="{{$o->name}}">{{$o->name}}</option>
            @endforeach
        </select>
      </div>
    </div>   
    <div class="col-md-2 col-sm-12">
      <div class="form-group">
        <label for = 'ft_status' class = 'bmd-label-static'><i class = 'ico ico-filter'></i> Situação Cliente</label>
        <select id = 'ft_status' class = 'form-control form-control-lg'>
          <option value = ''></option>
          <option value = 'no-history'>Sem Histórico</option>
            @foreach($situacao as $r)
              <option value="{{$r}}">{{$r}}</option>
            @endforeach
          </select>
      </div>
    </div> 
		<div class="col-md-3 col-sm-12">
			<div class = 'row'>
				<div class="col-md-6 col-sm-12">
          <div class="form-group">
            <label for = 'ft_dtini' class = 'bmd-label-static'><i class = 'ico ico-filter'></i> Data Inicial</label>  
            <input type = 'text' name = 'ft_dtini' id = 'ft_dtini' class = 'form-control form-control-lg'>
          </div>
        </div>
        <div class="col-md-6 col-sm-12">
          <div class="form-group">
          <label for = 'ft_dtfim' class = 'bmd-label-static'><i class = 'ico ico-filter'></i> Data Final</label>  
          <input type = 'text' name = 'ft_dtfim' id = 'ft_dtfim' class = 'form-control form-control-lg'>
          </div>
        </div>
			</div>
		</div>    

  </div>
	@component('IntranetOne::io.components.datatable',[
	"_id" => "default-table",
	"_columns"=> [
			["title" => "#"],
			["title" => "Nome"],
			["title" => "CPF/CNPJ"],
			["title" => "Origem"],
			["title" => "Celular"],
			["title" => "Cadastro"],
			["title" => "S"],
			["title" => "Ações"]
		]
	])
@endcomponent