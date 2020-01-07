new IOService(
  {
    name: 'Entity',
    dfId: 'default-form',
    wz: $('#default-wizard').wizard()
  },
  self => {

    setTimeout(() => {
      self.tabs['historico'].tab.addClass('disabled')

      // $("#user_name_container").style({ display: 'hidden' })
      document.getElementById('user_name').firstChild.nodeValue = ''


      self.tabs['cadastrar'].tab.on('shown.bs.tab', e => {
        IO.active = self
      })

      self.tabs['listar'].tab.on('shown.bs.tab', e => {
        IO.active = self
        self.dt.ajax.reload()
        self.dt.columns.adjust();
      })

      self.tabs['outras-observacoes'].tab.on('shown.bs.tab', e => {
        $('#observacao').focus()
      })

      self.tabs['referenciasinformacoes-pessoais-e-comerciais'].tab.on('shown.bs.tab', e => {
        $('#refs_pessoais').focus()
      })

      self.tabs['telefones-e-endereco'].tab.on('shown.bs.tab', e => {
        $('#celular1').focus()
      })


      self.tabs['cadastrar'].tab.tab('show');
    })

    self.dt = $('#default-table')
      .DataTable({
        ajax: self.path + '/list',
        initComplete: function () {
          //parent call
          let api = this.api();
          // this.teste = 10;
          $.fn.dataTable.defaults.initComplete(this);

          api.addDTSelectFilter([
            { el: $('#ft_loja'), column: 'otica' },
            { el: $('#ft_status'), column: 'status' },
          ]);


          $('#ft_dtini').pickadate().pickadate('picker').on('render', function () {
            api.draw()
          });

          $('#ft_dtfim').pickadate().pickadate('picker').on('render', function () {
            api.draw()
          });


          api.addDTBetweenDatesFilter({
            column: 'created_at',
            min: $('#ft_dtini'),
            max: $('#ft_dtfim')
          });

        },
        footerCallback: function (row, data, start, end, display) { },
        columns: [
          { data: 'id', name: 'id' },
          { data: 'nome' },
          { data: 'cpf_cnpj' },
          { data: 'otica.name', name: 'otica' },
          { data: 'celular1', name: 'celular1' },
          { data: 'created_at', name: 'created_at' },
          { data: 'status', name: 'status' },
          { data: 'actions', name: 'actions' }
        ],
        columnDefs: [
          { targets: '__dt_', width: "3%", searchable: true, orderable: true },
          { targets: '__dt_nome', searchable: true, orderable: true, width: 'auto' },
          { targets: '__dt_cpfcnpj', searchable: true, orderable: true, width: '10%' },
          { targets: '__dt_origem', searchable: true, orderable: true, width: '10%' },
          { targets: '__dt_celular', searchable: true, orderable: true, width: '10%' },
          {
            targets: '__dt_cadastro', type: 'date-br', width: "9%", orderable: true, className: "text-center", render: function (data, type, row) {
              return moment(data).format('DD/MM/YYYY');
            }
          },
          {
            targets: '__dt_s', width: "2%", orderable: true, className: "text-center", render: function (data, type, row) {
              let color;
              switch (row.status) {
                case 'Ativo':
                  color = "sts-ativo";
                  break
                case 'Bloqueado':
                  color = "sts-bloqueado";
                  break
                case 'De Risco':
                  color = 'sts-de-risco';
                  break
                case 'Avalisado':
                  color = "sts-avalisado";
                  break
                case 'Inativo':
                default:
                  color = "sts-inativo";
                  break
              }

              return self.dt.addDTIcon({ ico: 'ico-dot', title: row.status, value: row.status, pos: 'left', _class: color });
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
                  { ico: 'ico-edit', _class: 'text-info', title: 'editar' },
                  { ico: 'ico-trash', _class: 'text-danger', title: 'excluir' }
                ]
              });
            }
          }
        ]
      })
      .on('click', '.btn-dt-button[data-original-title=editar]', function () {
        var data = self.dt.row($(this).parents('tr')).data();
        self.view(data.id);
      })
      .on('click', '.ico-trash', function () {
        var data = self.dt.row($(this).parents('tr')).data();
        self.delete(data.id);
      })
      // .on('click', '.ico-eye', function () {
      //   var data = self.dt.row($(this).parents('tr')).data();
      //   preview({ id: data.id });
      // })
      .on('draw.dt', function () {
        $('[data-toggle="tooltip"]').tooltip();
      });

    $('#cpf_cnpj').removeAttr('readonly').mask($.jMaskGlobals.CPFCNPJMaskBehavior, {
      onKeyPress: function (val, e, field, options) {
        var args = Array.from(arguments);
        args.push(iscpf => {
          if (self.fv !== null) {
            if (iscpf) {
              self.fv[0]
                .disableValidator('cpf_cnpj', 'vat')
                .enableValidator('cpf_cnpj', 'id')
                .revalidateField('cpf_cnpj');
            } else {
              self.fv[0]
                .disableValidator('cpf_cnpj', 'id')
                // .enableValidator('cpf_cnpj', 'vat')
                .revalidateField('cpf_cnpj');
            }
          }
        });
        field.mask($.jMaskGlobals.CPFCNPJMaskBehavior.apply({}, args), options);
      },
      onComplete: function (val, e, field) { }
    });

    $('#dt_nascimento').pickadate({
      selectYears: 99,
      formatSubmit: 'yyyy-mm-dd 00:00:00',
      max: 'today'
    }).pickadate('picker').on('render', function () {
      self.fv[0].revalidateField('dt_nascimento');
    });


    $('#telefone1, #telefone2, #celular1, #celular2').mask(
      $.jMaskGlobals.SPMaskBehavior,
      {
        onKeyPress: function (val, e, field, options) {
          self.fv[0].revalidateField($(field).attr('id'));
          field.mask(
            $.jMaskGlobals.SPMaskBehavior.apply({}, arguments),
            options
          );
        },
        onComplete: function (val, e, field) {
          $(field)
            .parent()
            .parent()
            .next()
            .find('input')
            .first()
            .focus();
        }
        // onKeyPress: function(val, e, field, options) {
        //   if ($(field).attr('id') == 'celular1')
        //     self.fv[1].revalidateField($(field).attr('id'));
        //   field.mask(
        //     $.jMaskGlobals.SPMaskBehavior.apply({}, arguments),
        //     options
        //   );
        // },
        // onComplete: function(val, e, field) {
        //   $(field)
        //     .parent()
        //     .parent()
        //     .next()
        //     .find('input')
        //     .first()
        //     .focus();
        // }
      }
    );

    // $('#phone, #mobile').mask($.jMaskGlobals.SPMaskBehavior, {
    //   onKeyPress: function(val, e, field, options) {
    //     self.fv[0].revalidateField($(field).attr('id'));
    //     field.mask($.jMaskGlobals.SPMaskBehavior.apply({}, arguments), options);
    //   },
    //   onComplete: function(val, e, field) {
    //     $(field)
    //       .parent()
    //       .parent()
    //       .next()
    //       .find('input')
    //       .first()
    //       .focus();
    //   }
    // });

    $('#zipCode').mask('00000-000');

    $('#status').on('change', function (e) {
      const val = $(e.currentTarget).val()
      if (val === 'Avalisado') {
        self.tabs['outras-observacoes'].tab.tab('show');
        self.fv[0]
          .enableValidator('observacao', 'notEmpty')
          .revalidateField('observacao');
      }
      else {
        self.fv[0]
          .disableValidator('observacao', 'notEmpty')
          .revalidateField('observacao');
      }
    })

    let form = document.getElementById(self.dfId);

    let fv1 = FormValidation.formValidation(
      form.querySelector('.step-pane[data-step="1"]'),
      {
        fields: {
          cod_cliente: {
            validators: {
              notEmpty: {
                message: 'código obrigatório'
              }
            }
          },
          cpf_cnpj: {
            validators: {
              notEmpty: {
                message: 'O cpf/cnpj é obrigatório'
              },
              vat: {
                enabled: false,
                country: 'BR',
                message: 'cnpj inválido'
              },
              id: {
                country: 'BR',
                message: 'cpf inválido'
              }
            }
          },
          nome: {
            validators: {
              notEmpty: {
                message: 'O nome completo é obrigatório!'
              },
              stringLength: {
                min: 5,
                message: 'Mínimo de 5 caracteres'
              }
            }
          },
          dt_nascimento: {
            validators: {
              date: {
                format: 'DD/MM/YYYY',
                message: 'Informe uma data válida!'
              }
            }
          },
          zipCode: {
            validators: {
              promise: {
                notEmpty: {
                  message: 'The avatar is required'
                },
                enabled: true,
                promise: function (input) {
                  return getCep(input.value);
                }
              }
            }
          },
          address: {
            validators: {
              notEmpty: {
                message: 'O endereço é obrigatório'
              }
            }
          },
          address2: {
            validators: {
              notEmpty: {
                message: 'O bairro é obrigatório'
              }
            }
          },
          celular1: {
            validators: {
              // stringLength: {
              //   min: 14,
              //   message: 'Celular inválido'
              // },
              phone: {
                country: 'BR',
                message: 'Celular inválido'
              },
              notEmpty: {
                message: 'O telefone Celular é obrigatório'
              }
            }
          },
          celular2: {
            validators: {
              phone: {
                country: 'BR',
                message: 'Celular inválido'
              }
            }
          },
          telefone1: {
            validators: {
              phone: {
                country: 'BR',
                message: 'Telefone inválido'
              }
            }
          },
          telefone2: {
            validators: {
              phone: {
                country: 'BR',
                message: 'Telefone inválido'
              }
            }
          },
          email: {
            validators: {
              // notEmpty: {
              //   message: 'O e-mail principal é obrigatório'
              // },
              emailAddress: {
                message: 'E-mail Inválido'
              }
            }
          },
          observacao: {
            validators: {
              notEmpty: {
                enabled: false,
                message: 'Campo obrigatório!'
              },
            }
          },          // has_images: {
          //   validators: {
          //     callback: {
          //       message: 'Insira a logo da empresa!',
          //       callback: function(input) {
          //         if (self.dz.files.length == 0) {
          //           toastr['error']('Insira a logo da empresa!');
          //           return false;
          //         }
          //         $('#has_images').val(true);
          //         return true;
          //       }
          //     }
          //   }
          // }
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
        if (e.field === 'zipCode' && e.validator === 'promise') {
          if (e.result.meta.data !== null) setCEP(e.result.meta.data, self);
          else {
          }
        }
      });

    self.fv = [fv1];

    //Dropzone initialization
    Dropzone.autoDiscover = false;
    self.dz = new DropZoneLoader({
      id: '#custom-dropzone',
      autoProcessQueue: false,
      thumbnailWidth: 300,
      thumbnailHeight: 300,
      class: 'm-auto',
      maxFiles: 1,
      mainImage: false,
      copy_params: {
        original: true,
        sizes: {}
      },
      crop: {
        ready: cr => {
          cr.aspect_ratio_x = 1;
          cr.aspect_ratio_y = 1;
        }
      },
      buttons: {
        reorder: false
      },
      onSuccess: function (file, ret) {
        //self.fv[0].revalidateField('has_images');
      },
      onPreviewLoad: function (_t) {
        if (self.toView !== null) {
          let _conf = self.config.default;
          self.dz.removeAllFiles(true);
          // self.dz.reloadImages(self.config.default);
          self.fv[0].validate();
          //aa
        }
      }
    });

    //need to transform wizardActions in a method of Class
    self.wizardActions(function () {
      //self.dz.copy_params.sizes.default = {"w":$('#width').val(),"h":$('#height').val()}
      document
        .getElementById(self.dfId)
        .querySelector("[name='__dz_images']").value = JSON.stringify(
          self.dz.getOrderedDataImages()
        );
      document
        .getElementById(self.dfId)
        .querySelector("[name='__dz_copy_params']").value = JSON.stringify(
          self.dz.copy_params
        );
      // return false;
    });


    self.callbacks.view = view(self);
    // self.callbacks.update.onSuccess = () => {
    //   self.tabs['listar'].tab.tab('show');
    // }

    self.callbacks.delete.onSuccess = data => {
      console.log('no success do delete')
      self.callbacks.unload(self)
    }

    self.override.create.onSuccess = (data) => {
      if (data.success) {
        // try {
        //   self.tabs['listar'].setState(true);
        // } catch (err) { }
        self.callbacks.create.onSuccess(data);
        HoldOn.close();
        swal({
          title: 'Cadastro efetuado com sucesso!',
          confirmButtonText: 'OK',
          type: 'success',
          onClose: function () {
            self.unload(self);
            self.view(data.data.id);
            // setTimeout(() => {
            //   self.tabs['historico'].tab.tab('show');
            // }, 100)
          }
        });
      }
    };

    // self.callbacks.update.onSuccess = () => {
    //   swal({
    //     title: 'Sucesso',
    //     text: 'Registro atualizado com sucesso!',
    //     type: 'success',
    //     confirmButtonText: 'OK',
    //     onClose: function () {
    //       self.unload(self);
    //       location.reload();
    //     }
    //   });
    // };

    self.callbacks.unload = self => {

      self.tabs['historico'].tab.addClass('disabled')

      $('#cpf_cnpj, #cod_cliente')
        .removeAttr('readonly')

      $(
        '#cod_cliente,#cpf_cnpj, #nome, #email, #address, #address2, #city,#city_id, #state'
      ).val('');

      self.dz.removeAllFiles(true);
    };

    self.onNew = self => {
      self.unload(self);
      document.location.reload()      // self.unload()
      // self.callbacks.unload(self)
    }
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
function isAvalisado(s) {
  console.log('s', s)
}


function getCep(value) {
  return new Promise(function (resolve, reject) {
    if (value.replace(/\D/g, '').length < 8)
      resolve({
        valid: false,
        message: 'Cep Inválido!',
        meta: {
          data: null
        }
      });
    else {
      delete $.ajaxSettings.headers['X-CSRF-Token'];

      $.ajax({
        headers: {
          'Content-Type': 'application/json'
        },
        complete: jqXHR => {
          $.ajaxSettings.headers['X-CSRF-Token'] = laravel_token;
        },
        url: `https://viacep.com.br/ws/${$('#zipCode').cleanVal()}/json`,
        success: data => {
          if (data.erro == true) {
            resolve({
              valid: false,
              message: 'Cep não encontrado!',
              meta: {
                data: null
              }
            });
          } else {
            resolve({
              valid: true,
              meta: {
                data
              }
            });
          }
        }
      });
    }
  });
}

function view(self) {
  return {
    onSuccess: function (data) {
      const d = data;

      // $('#__form_edit').val(d.id);

      // //reload imagens
      self.dz.removeAllFiles(true);

      if (d.group != null) self.dz.reloadImages(d);

      $('#cod_cliente').val(d.cod_cliente);
      $('#otica_id').val(d.otica_id);

      $('#cpf_cnpj')
        .val(d.cpf_cnpj)
        .attr('readonly', true)
        .trigger('input');

      $('#cod_cliente')
        .val(d.cod_cliente)
        .attr('readonly', true)
        .trigger('input');


      if ($('#cpf_cnpj').cleanVal().length == 11) {
        self.fv[0]
          .disableValidator('cpf_cnpj', 'vat')
          .enableValidator('cpf_cnpj', 'id')
          .revalidateField('cpf_cnpj');
      } else {
        self.fv[0]
          .disableValidator('cpf_cnpj', 'id')
          // .enableValidator('cpf_cnpj', 'vat')
          .revalidateField('cpf_cnpj');
      }

      $('#nome').val(d.nome);
      $('#status').val(d.status);
      $('#rg').val(d.rg);
      $('#sexo').val(d.sexo);
      $('#estado_civil').val(d.estado_civil);
      $('#local_trabalho').val(d.local_trabalho);

      if (d.dt_nascimento !== null) {
        var dtn = d.dt_nascimento.split('-');
        $('#dt_nascimento')
          .pickadate('picker')
          .set('select', [dtn[0], dtn[1] - 1, dtn[2]]);
      }


      $('#refs_pessoais').val(d.refs_pessoais);
      $('#refs_comerciais').val(d.refs_comerciais);

      $('#telefone1')
        .val(d.telefone1)
        .trigger('input');

      $('#telefone2')
        .val(d.telefone2)
        .trigger('input');

      $('#celular1')
        .val(d.celular1)
        .trigger('input');

      $('#celular2')
        .val(d.celular2)
        .trigger('input');

      $('#email')
        .val(d.email)
        .trigger('input');


      $('#zipCode')
        .val(d.zipCode)
        .trigger('input');

      getCep(d.zipCode).then(el => {
        setCEP(el.meta.data, self);

        $('#address').val(d.address);
        $('#address2').val(d.address2);

      });


      self.tabs['historico'].tab.removeClass('disabled')
      document.getElementById('user_name').firstChild.nodeValue = d.nome
    },
    onError: function (self) {

      console.log('executa algo no erro do callback', this);
    }
  };
}

function setCEP(data, self) {
  const _conf = self.toView;

  if (self.toView !== null && $('#zipCode').val() == _conf.zipCode) {
    if ($('#address').val() == '' && _conf.address !== '') {
      $('#address').val(_conf.address);
    }

    if ($('#address2').val() == '' && _conf.address2 !== '')
      $('#address2').val(_conf.address2);

    $('#city_id').val(data.ibge);
    $('#city').val(data.localidade);
    $('#state').val(data.uf);
    $('#address').focus();
  } else {
    if (data !== null) {
      //com logradouro
      if (data.logradouro) {
        $('#address').val(`${data.logradouro}`);
        $('#address2').val(data.bairro);
      }

      $('#city').val(data.localidade);
      $('#city_id').val(data.ibge);
      $('#state').val(data.uf);
      $('#address').focus();
    } else $('#address, #address2, #city, #state').val('');
  }

  self.fv[0].revalidateField('address');
  self.fv[0].revalidateField('address2');
}
