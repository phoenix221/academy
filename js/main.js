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
var swiper = new Swiper(".tabs-carusel", {
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});