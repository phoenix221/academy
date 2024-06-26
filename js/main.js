new Vue({
    el: '#tabs',
    data: {
        tshow: 1,
        'isActive1': true,
        'isActive2': false,
        'isActive3': false,
        'isActive4': false,
        'isActive5': false,
        'isActive6': false,
    },
    methods: {
        show(message) {
            for (var i = 1; i < 7; i++){
                if(message == i){
                    this.tshow = i;
                    this['isActive'+i] = true;
                }else{
                    this['isActive'+i] = false;
                }
            }
        }
    }
});
// карусель
var swiper_tabs = new Swiper(".tabs-carusel", {
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});
// карусель

// всплывающее окно
// register modal component
Vue.component("modal", {
    template: "#modal-template"
});

// start app
new Vue({
    el: "#teacher",
    data: {
        showModal1: false,
        showModal2: false,
        showModal3: false,
        showModal4: false,
        showModal5: false,
        showModal6: false
    }
});

// преподователи
new Vue({
    el: "#graduates",
    data: {
        grshow: 1,
        'isActive1': true,
        'isActive2': false,
        'isActive3': false,
        'isActive4': false,
        'isActive5': false,
    },
    methods: {
        grashow(text) {
            for (var i = 1; i < 6; i++){
                if(text == i){
                    console.log(text);
                    this.grshow = i;
                    this['isActive'+i] = true;
                }else{
                    this['isActive'+i] = false;
                }
            }
        }
    }
});
// карусель преподователи
var swiper_graduates = new Swiper(".graduates-carusel", {
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});
// карусель
// карусель отзывов
var swiper_reviws = new Swiper(".reviews-carusel", {
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});