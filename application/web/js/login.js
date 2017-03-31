


Vue.component('modal-login', {
    template: '#login-template'
})

Vue.component('modal-account', {
    template: '#account-template'
})

new Vue({
    el: '.header-menu',
    data: {
        showLogin: false,
        showAccount: false,
    }
})