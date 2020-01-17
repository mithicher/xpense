/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

import Alpine from "alpinejs";
var autosize = require("autosize");

var Turbolinks = require("turbolinks");
Turbolinks.start();

document.addEventListener("turbolinks:load", () => {
    // window.livewire.rescan();
});

autosize(document.querySelectorAll("textarea"));

// window.Vue = require('vue');
