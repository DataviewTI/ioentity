<div class = 'row'>
  <div class="col-md-3 col-sm-12">
    <div class="form-group">
      <label for='cpf_cnpj'>CPF / CNPJ</label>
      <input type="text" id='cpf_cnpj' name='cpf_cnpj' class = 'form-control input-lg' />
    </div>
  </div>
  <div class="col-md-5 col-sm-12">
    <div class="form-group">
      <label for='nome_fantasia'>Nome Completo / Nome Fantasia</label>
      <input type="text" id='nome_fantasia' name='nome_fantasia' class = 'form-control input-lg' />
    </div>
  </div>
  <div class="col-md-4 col-sm-12">
    <label for='sexo'>Tipo de cadastro</label><br>
    <div class="custom-control custom-radio custom-control-inline">
      <input type="checkbox" class="custom-control-input" onclick="return false;" checked id="tipoCLI" name="tipo[]" value="CLI">
      <label class="custom-control-label" for="tipoCLI">Cliente</label>
    </div>
    <div class="custom-control custom-radio custom-control-inline">
      <input type="checkbox" class="custom-control-input" id="tipoFOR" name="tipo[]" value="FOR">
      <label class="custom-control-label" for="tipoFOR">Fornecedor</label>
    </div>
    <div class="custom-control custom-radio custom-control-inline">
      <input type="checkbox" class="custom-control-input" id="tipoFUN" name="tipo[]" value="FUN">
      <label class="custom-control-label" for="tipoFUN">Funcionário</label>
    </div>
  </div>
</div>
<div class = 'row pf_container'>
  <div class="col-md-3 col-sm-12" style="margin-bottom:-20px">
    <div class="form-group">
      <label for='dt_nascimento'>Data de nascimento</label>
      <input type="text" id='dt_nascimento' name='dt_nascimento' class = 'form-control input-lg' />
    </div>
  </div>
  <div class="col-md-5 col-sm-12">
    <div class="form-group">
      <label for='rg'>Número do RG / Órgão Emissor - UF</label>
      <input type="text" id='rg' name='rg' class = 'form-control input-lg'/>
    </div>
  </div>
  <div class="col-md-4 col-sm-12">
    <label for='sexo'>Sexo</label><br>
    <div class="custom-control custom-radio custom-control-inline">
      <input type="radio" class="custom-control-input" id="sexoF" name="sexo" value="F">
      <label class="custom-control-label" for="sexoF">Feminino</label>
    </div>
    <div class="custom-control custom-radio custom-control-inline">
      <input type="radio" class="custom-control-input" id="sexoM" name="sexo" value="M">
      <label class="custom-control-label" for="sexoM">Masculino</label>
    </div>
    <div class="custom-control custom-radio custom-control-inline">
      <input type="radio" class="custom-control-input" checked id="sexoI" name="sexo" value="O">
      <label class="custom-control-label" for="sexoI">Não Informado</label>
    </div>
  </div>
  <div class="col-md-3 col-sm-12">
    <div class="form-group selectContainer">
      <label for='estado_civil'>Estado Civil</label>
      <select name="estado_civil" id="estado_civil" class="form-control input-lg">
        <option value=""></option>
        <option value="Casado">Casado</option>
        <option value="Divorciado">Divorciado</option>
        <option value="Separado">Separado</option>
        <option value="Solteiro">Solteiro</option>
        <option value="Viúvo">Viúvo</option>
      </select>
    </div>
  </div>
  <div class="col-md-5 col-sm-12">
    <div class="form-group">
      <label for='profissao'>Profissão</label>
      <input type="text" id='profissao' name='profissao' class = 'form-control input-lg'/>
    </div>
  </div>
  <div class="col-md-4 col-sm-12">
    <div class="form-group">
      <label for='nacionalidade'>Nacionalidade</label>
      <input type="text" id='nacionalidade' name='nacionalidade' value='Brasileira' class = 'form-control input-lg'/>
    </div>
  </div>
</div>
<div  class = 'row pj_container d-none'>
  <div class="col-md-3 col-sm-12">
    <div class="form-group">
      <label for='insc_estadual'>Inscrição Estadual</label>
      <input type="text" id='insc_estadual' name='insc_estadual' class = 'form-control input-lg'/>
    </div>
  </div>
  <div class="col-md-5 col-sm-12">
    <div class="form-group">
      <label for='razaosocial'>Razão Social</label>
      <input type="text" id='razaosocial' name='razaosocial' class = 'form-control input-lg'/>
    </div>
  </div>
  <div class="col-md-4 col-sm-12">
      <div class="form-group">
        <label for='responsavel'>Responsável</label>
        <input type="text" id='responsavel' name='responsavel' class = 'form-control input-lg'/>
      </div>
    </div>
</div>
<div class="row">
  <div class="col-md-12 col-sm-12">
    <div class="form-group">
      <label for='observacao'>Observação</label>
      <textarea id='observacao' name='observacao' rows="4" class = 'form-control'></textarea>
    </div>
  </div>
</div>