var app = new Vue({
    el: '#vue-app',
    data: {
        search: ''
    }
})

Vue.component('conversation', {
    props: ['conv'],
    template: '<p> {{conv}} </p>'
})