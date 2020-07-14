@php
  use Dataview\IntranetOne\IntranetOne;
  use Dataview\IOEntity\Models\Otica;
  $ecivil = IntranetOne::getEnumValues('entities','estado_civil');
  $oticas = Otica::select('id','alias','main','name')->orderBy('main')->orderBy('alias')->get();
  // $situacao = IntranetOne::getEnumValues('entities','status');
@endphp

<div class = 'row'>
  <div class="col-xs-12 col-sm-2">
    <div class = 'row d-flex'>
      <div class="col-sm-12 d-flex p-0">
          <div id = 'custom-dropzone' class = 'entity-dz w-100 d-flex justify-content-center dz-drop-files-here flex-wrap dropzone'>
          </div>
          @include('IntranetOne::io.components.dropzone.dropzone-infos-modal-default',[])
        <input type = 'hidden' id = 'hasImages' name='hasImages' value='0' />
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-sm-10 px-0 pl-3">
    <div class = 'row'>
      <div class="col-sm-4 col-xs-12">
        <div class = 'row my-0'>
          <div class="col-sm-5 col-xs-12">
            <div class="form-group">
              <label for='cod_cliente'>Cod Cliente</label>
              <input type="text" id='cod_cliente' name='cod_cliente' class = 'form-control input-lg' />
            </div>
          </div>
          <div class="col-sm-7 col-xs-12">
            <div class="form-group selectContainer">
              <label for='otica_id'>Loja Origem</label>
              <select name="otica_id" id="otica_id" class="form-control input-lg mt-1">
                @foreach($oticas as $o)
                  <option value="{{$o->id}}">{{$o->name}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-8 col-xs-12">
        <div class = 'row'>
          <div class="col-sm-3 col-xs-12">
            <div class="form-group">
              <label for='cpf_cnpj'>CPF / CNPJ</label>
              <input type="text" id='cpf_cnpj' name='cpf_cnpj' class = 'form-control input-lg' />
            </div>
          </div>
          <div class="col-sm-9 col-xs-12">
            <div class="form-group">
              <label for='nome_fantasia'>Nome Completo / Nome Fantasia</label>
              <input type="text" id='nome' name='nome' class = 'form-control input-lg' />
            </div>
          </div>
          {{-- <div class="col-sm-3 col-xs-12">
            <div class="form-group">
              <label for='status'>Situação</label>
            <select name="status" id="status" class="form-control input-lg mt-1">
                  @foreach($situacao as $r)
                    <option value="{{$r}}">{{$r}}</option>
                  @endforeach
              </select>
            </div>
          </div> --}}
        </div>
      </div>
    </div>
    <div class = 'row px-0'>
      <div class="col-sm-3 col-xs-12">
        <div class="form-group">
          <label for='rg'>Número do RG / Órgão Emissor - UF</label>
          <input type="text" id='rg' name='rg' class = 'form-control input-lg'/>
        </div>
      </div>
      <div class="col-xs-12 col-sm-2">
        <div class="form-group selectContainer">
          <label for='sexo'>Sexo</label>
          <select name="sexo" id="sexo" class="form-control input-lg mt-1">
            <option value="F">Feminino</option>
            <option value="M">Masculino</option>
            <option value="I">Não Informado</option>
          </select>
        </div>
      </div>
      <div class="col-xs-12 col-sm-2">
        <div class="form-group selectContainer">
          <label for='estado_civil'>Estado Civil</label>
          <select name="estado_civil" id="estado_civil" class="form-control input-lg mt-1">
            <option value="">Não Informado</option>
              @foreach($ecivil as $r)
                <option value="{{$r}}">{{$r}}</option>
              @endforeach
          </select>
        </div>
      </div>
      <div class="col-md-3 col-sm-12">
        <div class="form-group">
          <label for='local_trabalho'>Local de Trabalho</label>
          <input type="text" id='local_trabalho' name='local_trabalho' class = 'form-control input-lg'/>
        </div>
      </div>
      <div class="col-sm-2 col-xs-12">
        <div class="form-group">
          <label for='dt_nascimento'>Dt Nascimento</label>
          <input type="text" id='dt_nascimento' name='dt_nascimento' class = 'form-control input-lg' />
        </div>
      </div>
    </div>

    <div class = 'row px-0 mx-0'>
      <div class="col-xs-12 w-100">
          @component('IntranetOne::io.components.nav-tabs',
          [
            "_id" => "aditional-data",
            "_active"=>0,
            '_controls'=>false,
            "_tabs"=> [
              [
                "tab"=>"Telefones e Endereço",
                "icon"=>"ico ico-business-card",
                "view"=>"Entity::form-parts.address",
                "params"=>[
                ],
              ],
              [
                "tab"=>"Referências/Informações Pessoais e Comerciais",
                "icon"=>"ico ico-talking",
                "view"=>"Entity::form-parts.refs",
                "params"=>[
                ],
              ],
              [
                "tab"=>"Outras Observações",
                "icon"=>"ico ico-talking",
                "view"=>"Entity::form-parts.details",
                "params"=>[
                ],
              ]            
            ]
          ])
          @endcomponent
      </div>
    </div>
  </div>

</div>

