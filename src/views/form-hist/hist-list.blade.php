	<div class = 'row dt-filters-container'>
		<div class="col-sm-12 col-xs-12">
			<div class="form-group">
        <label for = 'subtitulo' class = 'bmd-label-static'><i class = 'ico ico-filter'></i> Palavra Chave</label>
        <input type = 'text' class = 'form-control form-control-lg' name ='ft_hist_search' id = 'ft_hist_search' />
			</div>
		</div>
    
  </div>
	@component('IntranetOne::io.components.datatable',[
	"_id" => "hist-table",
	"_columns"=> [
			["title" => "#"],
			["title" => "Loja"],
			["title" => "Responsável"],
			["title" => "Produto"],
			["title" => "Data"],
			["title" => "Valor"],
			["title" => "S"],
			["title" => "Ações"]
		]
	])
@endcomponent