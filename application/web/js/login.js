document.getElementById('login_button').onclick = function () {
    console.log('das');
    xml = new XMLHttpRequest();
    xml.open('/main/logIn');
    xml.onload = function () {
        if(JSON.parse(xml.response) == false) {
            alert('login error');
        }
    }
    xml.send();
}


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