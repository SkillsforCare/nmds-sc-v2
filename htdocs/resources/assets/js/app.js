
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VModal from 'vue-js-modal';
Vue.use(VModal, { dialog: true });

import VueFormWizard from 'vue-form-wizard'
Vue.use(VueFormWizard)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('modal-component', require('./components/ModalComponent.vue'));
Vue.component('form-builder', require('./components/FormBuilder.vue'));
Vue.component('question-index', require('./components/QuestionIndex.vue'));
Vue.component('training-index', require('./components/TrainingIndex.vue'));

Vue.component('f-display', require('./components/form/FDisplay.vue'));
Vue.component('f-status-tag', require('./components/form/FStatusTag.vue'));
Vue.component('f-wizard', require('./components/form/FWizard.vue'));

if (typeof Object.assign != 'function') {
    // Must be writable: true, enumerable: false, configurable: true
    Object.defineProperty(Object, "assign", {
        value: function assign(target, varArgs) { // .length of function is 2
            'use strict';
            if (target == null) { // TypeError if undefined or null
                throw new TypeError('Cannot convert undefined or null to object');
            }

            var to = Object(target);

            for (var index = 1; index < arguments.length; index++) {
                var nextSource = arguments[index];

                if (nextSource != null) { // Skip over if undefined or null
                    for (var nextKey in nextSource) {
                        // Avoid bugs when hasOwnProperty is shadowed
                        if (Object.prototype.hasOwnProperty.call(nextSource, nextKey)) {
                            to[nextKey] = nextSource[nextKey];
                        }
                    }
                }
            }
            return to;
        },
        writable: true,
        configurable: true
    });
}

const app = new Vue({
    el: '#app'
});
