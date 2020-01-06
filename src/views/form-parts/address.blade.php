    <div class = 'row px-0 mx-2 mt-2'>
      <div class="col-md-2 col-sm-12 pl-0">
          <div class="form-group">
              <label for='celular1'>Celular / WhatsApp</label>
              <input type="text" id='celular1' name='celular1' class='form-control input-lg'/>
          </div>
      </div>
      <div class="col-md-2 col-sm-12">
          <div class="form-group">
              <label for='celular2'>Celular Secundário</label>
              <input type="text" id='celular2' name='celular2' class='form-control input-lg'/>
          </div>
      </div>
      <div class="col-md-2 col-sm-12">
              <div class="form-group">
                  <label for='telefone1'>Telefone Fixo</label>
                  <input type="text" id='telefone1' name='telefone1' class = 'form-control input-lg' />
              </div>
          </div>
      <div class="col-md-2 col-sm-12">
          <div class="form-group">
              <label for='telefone2'>Telefone Comercial</label>
              <input type="text" id='telefone2' name='telefone2' class='form-control input-lg'/>
          </div>
      </div>
      <div class="col-md-4 col-sm-12 pr-0">
          <div class="form-group">
              <label for='email'>E-mail</label>
              <input type="text" id='email' name='email' class = 'form-control input-lg'/>
          </div>
      </div>
    </div>
    <div class = 'row px-0 mx-2 mt-2'>
      <div class="col-xs-12">
        @include("IntranetOne::io.forms.form-address",[])
      </div>
    </div>