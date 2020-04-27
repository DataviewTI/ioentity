"use strict";
let mix = require("laravel-mix");

function IOEntity(params = {}) {
  let $ = this;
  this.dep = {
    entity: "node_modules/intranetone-entity/src/",
    sortable: "node_modules/sortablejs/",
    moment: "node_modules/moment/",
    dropzone: "node_modules/dropzone/dist/",
    cropper: "node_modules/cropperjs/dist/",
    jquerycropper: "node_modules/jquery-cropper/dist/"
  };

  let config = {
    optimize: false,
    sass: false,
    fe: true,
    cb: () => {}
  };

  this.compile = (IO, callback = () => {}) => {
    mix.styles(
      [
        // IO.src.io.root + 'custom/custom-devbridge.css',
        IO.src.css + "helpers/dv-buttons.css",
        IO.dep.io.toastr + "toastr.min.css",
        IO.src.io.css + "toastr.css",
        $.dep.entity + "entity.css",
        IO.src.io.css + "dropzone.css",
        IO.src.io.css + "dropzone-preview-template.css",
        $.dep.entity + "dropzone.css",
        IO.src.io.css + "sortable.css",
        $.dep.cropper + "cropper.css"
      ],
      IO.dest.io.root + "services/io-entity.min.css"
    );

    mix.babel(
      [IO.src.js + "extensions/ext-jquery.js"],
      IO.dest.io.root + "services/io-entity-mix-babel.min.js"
    );

    mix.babel(
      [
        $.dep.sortable + "Sortable.min.js",
        IO.dep.io.toastr + "toastr.min.js",
        IO.src.io.js + "defaults/def-toastr.js",
        $.dep.dropzone + "dropzone.js",
        IO.src.io.js + "dropzone-loader.js",
        $.dep.entity + "jquery.maskMoney.min.js",
        IO.dep.jquery_mask + "jquery.mask.min.js",
        IO.src.js + "extensions/ext-jquery.mask.js"
      ],
      IO.dest.io.root + "services/io-entity-babel.min.js"
    );

    mix.scripts(
      [
        $.dep.cropper + "cropper.js",
        $.dep.jquerycropper + "jquery-cropper.js",
        $.dep.moment + "min/moment.min.js",
        IO.src.io.vendors + "moment/moment-pt-br.js"
      ],
      IO.dest.io.root + "services/io-entity-mix.min.js"
    );

    //copy separated for compatibility
    mix.babel(
      $.dep.entity + "entity.js",
      IO.dest.io.root + "services/io-entity.min.js"
    );

    //copy separated for compatibility
    mix.babel(
      $.dep.entity + "history.js",
      IO.dest.io.root + "services/io-entity-history.min.js"
    );

    mix.copy(
      IO.src.js + "data/optimized_cities.js",
      IO.dest.js + "optimized_cities.js"
    );

    mix.copyDirectory(
      $.dep.entity + "images",
      IO.dest.io.root + "images/entity"
    );

    // IO.__imgOptimize({
    //   from: $.dep.entity + 'entity',
    //   to: IO.dest.io.root + 'images/entity'
    // });

    callback(IO);
  };
}

module.exports = IOEntity;
