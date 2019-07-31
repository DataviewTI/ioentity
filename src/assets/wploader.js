'use strict';
let mix = require('laravel-mix');

function IOEntity(params = {}) {
    let $ = this;
    this.dep = {
        entity: 'node_modules/intranetone-entity/src/',
        devbridgeAC: 'node_modules/devbridge-autocomplete/dist/',
        moment: 'node_modules/moment/'
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
                IO.src.io.root + 'custom/custom-devbridge.css',
                IO.src.css + 'helpers/dv-buttons.css',
                IO.dep.io.toastr + 'toastr.min.css',
                IO.src.io.css + 'toastr.css',
                $.dep.entity + 'entity.css'
            ],
            IO.dest.io.root + 'services/io-entity.min.css'
        );

        mix.babel(
            [IO.src.js + 'extensions/ext-jquery.js'],
            IO.dest.io.root + 'services/io-entity-mix-babel.min.js'
        );

        // mix.babel(
        //     [
        //         $.dep.devbridgeAC + 'jquery.autocomplete.min.js',
        //         IO.dep.io.toastr + 'toastr.min.js',
        //         IO.src.io.js + 'defaults/def-toastr.js'
        //     ],
        //     IO.dest.io.root + 'services/io-entity-babel.min.js'
        // );

        mix.scripts(
            [
                IO.dep.jquery_mask + 'jquery.mask.min.js',
                IO.src.js + 'extensions/ext-jquery.mask.js',
                $.dep.moment + 'min/moment.min.js',
                IO.src.io.vendors + 'moment/moment-pt-br.js'
            ],
            IO.dest.io.root + 'services/io-entity-mix.min.js'
        );

        //copy separated for compatibility
        mix.babel(
            $.dep.service + 'entity.js',
            IO.dest.io.root + 'services/io-entity.min.js'
        );

        callback(IO);
    };
}

module.exports = IOEntity;
