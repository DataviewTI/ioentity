@php
  use Dataview\IntranetOne\IntranetOne;
  use Dataview\IOEntity\Models\Otica;
  $oticas = Otica::select('id','alias','main','name')->orderBy('main')->orderBy('alias')->get();
@endphp

<div class = 'row'>
  <div class="col-xs-12 col-sm-8">
      @include('Entity::form-hist.hist-list')
  </div>
  <div class="col-xs-12 col-sm-4">
    <div class = 'row'>
      <div class="col-sm-12 col-xs-12">
        <div class="form-group selectContainer">
          <label for='hist_otica_id'>Loja Origem</label>
          <select name="hist_otica_id" id="hist_otica_id" class="form-control input-lg mt-1">
            @foreach($oticas as $o)
              <option value="{{$o->id}}">{{$o->name}}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>
    <div class = 'row'>
      <div class="col-sm-4 col-xs-12">
        <div class="form-group">
          <label for='dt_compra'>Data Compra</label>
          <input type="text" id='dt_compra' name='dt_compra' class = 'form-control input-lg' />
        </div>
      </div>
      <div class="col-sm-4 col-xs-12">
        <div class="form-group">
          <label for='vl_compra'>Valor Compra</label>
          <input type="text" id='vl_compra' name='vl_compra' class = 'form-control input-lg' placeholder="R$ 0,00"/>
        </div>
      </div>
      <div class="col-sm-4 col-xs-12">
        <div class="form-group">
          <label for='dt_compra'>Valor entrada</label>
          <input type="text" id='vl_entrada' name='vl_entrada' class = 'form-control input-lg' placeholder="R$ 0,00" />
        </div>
      </div>
    </div>

    <div class = 'row' class="b-red">
      <div class="col-xs-12 col-sm-12">
        <div class="form-group">
          <label for='product'>Produto</label>
          <input type="text" id='product' name='product' class = 'form-control input-lg' />
        </div>
      </div>
    </div>

    <div class = 'row' class="b-red">
      <div class="col-xs-12 col-sm-12">
        <div class="form-group">
          <label for='details'>Observações</label>
          <textarea id='details' name='details' class='form-control input-lg' style="height:80px"></textarea>
        </div>
      </div>
    </div>

    <input type="hidden" id='maskvalue' />

{{-- </div> --}}