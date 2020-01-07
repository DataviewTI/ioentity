new IOService(
  {
    name: 'History',
    dfId: 'hist-form',
    path: 'entity',
    wz: $('#hist-wizard').wizard()
  },
  function (self) {

    setTimeout(() => {
      self.tabs['historico'].tab.on('shown.bs.tab', e => {
        IO.active = self
        self.dt.ajax.url(`${self.path}/history/list/${IO.services.entity.toView && IO.services.entity.toView.id}`);
        self.dt.ajax.reload()
        self.dt.columns.adjust();
      })
    })


    $("#vl_compra, #vl_entrada").maskMoney({
      prefix: "R$ ",
      decimal: ",",
      thousands: "."
    })


    $("#vl_compra").on('keyup', function (e) {
      self.fv[0].revalidateField($(this).attr('id'));
    });

    self.override.create.onSuccess = (data) => {
      if (data.success) {
        self.callbacks.create.onSuccess(data);
        HoldOn.close();
        swal({
          title: 'histórico cadastrado com sucesso!',
          confirmButtonText: 'OK',
          type: 'success',
          onClose: function () {
            self.callbacks.unload(self);
            self.dt.ajax.reload()
            self.dt.columns.adjust();
          }
        });
      }
    };

    //Datatables initialization
    self.dt = $('#hist-table')
      .DataTable({
        ajax: null,
        initComplete: function () {
          let api = this.api();
          $.fn.dataTable.defaults.initComplete(this);
        },
        footerCallback: function (row, data, start, end, display) { },
        columns: [
          { data: 'id', name: 'id' },
          { data: null },
          { data: null },
          { data: null },
          { data: null },
          { data: null },
          { data: null }
        ],
        columnDefs: [
          { targets: '__dt_', width: "3%", searchable: true, orderable: true },
          {
            targets: '__dt_loja', searchable: true, orderable: true, width: '13%', render: function (data, type, row) {
              return row.alias
            }
          },
          {
            targets: '__dt_produto', searchable: true, orderable: true, width: "auto", render: function (data, type, row) {
              return row.pivot.product
            }
          },
          {
            targets: '__dt_data', orderable: true, width: '5%', className: "text-center", render: function (data, type, row) {
              return moment(row.pivot.date).format('DD/MM/YYYY');
            }
          },
          {
            targets: '__dt_valor', orderable: true, width: '12%', className: "text-right", render: function (data, type, row) {
              return parseFloat(row.pivot.value).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })
            }
          },
          {
            targets: '__dt_entrada', className: "text-right", orderable: true, width: '12%', render: function (data, type, row) {
              return parseFloat(row.pivot.payment).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })
            }
          },
          {
            targets: '__dt_acoes',
            width: '5%',
            className: 'text-center',
            searchable: false,
            orderable: false,
            render: function (data, type, row, y) {
              return self.dt.addDTButtons({
                buttons: [
                  // { ico: 'ico-edit', _class: 'text-info', title: 'editar' },
                  { ico: 'ico-trash', _class: 'text-danger', title: 'excluir' }
                ]
              });
            }
          }
        ]
      })
      .on('click', '.ico-trash', function () {
        var data = self.dt.row($(this).parents('tr')).data();
        self.delete(data.id);
      })
      // .on('click', '.btn-dt-button[data-original-title=editar]', function () {
      //   var data = self.dt.row($(this).parents('tr')).data();
      //   self.view(data.id);
      // })
      .on('draw.dt', function () {
        $('[data-toggle="tooltip"]').tooltip();
      });

    $('#dt_compra').pickadate({
      formatSubmit: 'yyyy-mm-dd 00:00:00',
      max: 'today'
    }).pickadate('picker').on('render', function () {
      self.fv[0].revalidateField('dt_compra');
    });
    ;

    let form = document.getElementById('hist-form');

    let fv1 = FormValidation.formValidation(
      form.querySelector('.step-pane[data-step="1"]'),
      {
        fields: {
          dt_compra: {
            validators: {
              notEmpty: {
                message: 'Data Obrigatória'
              },
              date: {
                format: 'DD/MM/YYYY',
                message: 'Informe uma data válida!'
              }
            }
          },
          vl_compra: {
            validators: {
              callback: {
                message: 'Valor não pode ser 0!',
                callback: function (value, validator, $field) {
                  let v = $('#vl_compra').maskMoney('unmasked')[0];
                  return v > 0
                }
              }
            }
          },
        },
        plugins: {
          trigger: new FormValidation.plugins.Trigger(),
          submitButton: new FormValidation.plugins.SubmitButton(),
          bootstrap: new FormValidation.plugins.Bootstrap(),
          icon: new FormValidation.plugins.Icon({
            valid: 'fv-ico ico-check',
            invalid: 'fv-ico ico-close',
            validating: 'fv-ico ico-gear ico-spin'
          })
        }
      }
    )
      .setLocale('pt_BR', FormValidation.locales.pt_BR)
      .on('core.validator.validated', function (e) {
      });

    self.fv = [fv1];

    //need to transform wizardActions in a method of Class
    self.wizardActions(function () {
      self.extraData.vl_entrada_clean = $('#vl_entrada').maskMoney('unmasked')[0];
      self.extraData.vl_compra_clean = $('#vl_compra').maskMoney('unmasked')[0];
      self.extraData.entityId = IO.services.entity.toView.id
    })

    self.onNew = self => {
      self.unload(self);
      document.location.reload()      // self.unload()
      // self.callbacks.unload(self)
    }

    // self.callbacks.view = histVew(self);

    // self.callbacks.update.onSuccess = () => {
    //   swal({
    //     title: 'Sucesso',
    //     text: 'Configurações atualizadas com sucesso!',
    //     type: 'success',
    //     confirmButtonText: 'OK',
    //     onClose: function () {
    //       self.unload(self);
    //       location.reload();
    //     }
    //   });
    // };

    // self.callbacks.create.onSuccess = (data) => {

    //   if (data.success) {
    //     // self.callbacks.create.onSuccess(data);
    //     HoldOn.close();
    //     swal({
    //       title: 'Histórico cadastrado com sucesso!',
    //       confirmButtonText: 'OK',
    //       type: 'success',
    //       onClose: function () {
    //         // self.unload(self);
    //         //fazer o on Edit, e após habilitar aba de histórico
    //       }
    //     });
    //   }
    // };

    self.callbacks.unload = self => {
      console.log('agora sim!!')
      $('#vl_entrada, #vl_compra, #dt_compra, #product, #details').val('');
    };
  }


); //the end ??



/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                                                                                            
  ██╗      ██████╗  ██████╗ █████╗ ██╗         ███╗   ███╗███████╗████████╗██╗  ██╗ ██████╗ ██████╗ ███████╗
  ██║     ██╔═══██╗██╔════╝██╔══██╗██║         ████╗ ████║██╔════╝╚══██╔══╝██║  ██║██╔═══██╗██╔══██╗██╔════╝
  ██║     ██║   ██║██║     ███████║██║         ██╔████╔██║█████╗     ██║   ███████║██║   ██║██║  ██║███████╗
  ██║     ██║   ██║██║     ██╔══██║██║         ██║╚██╔╝██║██╔══╝     ██║   ██╔══██║██║   ██║██║  ██║╚════██║
  ███████╗╚██████╔╝╚██████╗██║  ██║███████╗    ██║ ╚═╝ ██║███████╗   ██║   ██║  ██║╚██████╔╝██████╔╝███████║
  ╚══════╝ ╚═════╝  ╚═════╝╚═╝  ╚═╝╚══════╝    ╚═╝     ╚═╝╚══════╝   ╚═╝   ╚═╝  ╚═╝ ╚═════╝ ╚═════╝ ╚══════╝
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/



function histView(self) {
  return {
    onSuccess: function (data) {
      const _conf = data;
      // $('#__form_edit').val(_conf.id);
      $('#loja_origem').val(_conf.loja_origem);
      // $('#refs_comerciais').val(_conf.refs_comerciais);
    },
    onError: function (self) {
      console.log('executa algo no erro do callback');
    }
  };
}
