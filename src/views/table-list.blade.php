	<div class = 'row dt-filters-container'>
		<div class="col-sm-12 col-xs-12">
			<div class="form-group">
        <label for = 'subtitulo' class = 'bmd-label-static'><i class = 'ico ico-filter'></i> Palavra Chave</label>
        <input type = 'text' class = 'form-control form-control-lg' name ='ft_search' id = 'ft_search' />
			</div>
		</div>
    
  </div>
	@component('IntranetOne::io.components.datatable',[
	"_id" => "default-table",
	"_columns"=> [
			["title" => "Id"],
			["title" => "Nome"],
			["title" => "CPF/CNPJ"],
			["title" => "Email"],
			["title" => "Telefone"],
			["title" => "Celular"],
			["title" => "Ações"]
		]
	])
@endcomponent