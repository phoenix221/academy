function cart_databank(id){
    $("#Modal").modal('show');

    $.post('/ajax/get_cart', {id:id}, function(data) {
        $('.modal-body').html(data);
    });
}

function auth(id){
    var user = $('#user').val();

    if(user == 1){
        cart_databank(id)
    }else{
        $("#auth").modal('show');
        $('#number_bank').val(id);
    }
}

function authentication(){
    var email = $('#email').val();
    var pass = $('#password').val();
    var id_bank = $('#number_bank').val();

    console.log(email);
    console.log(pass);

    $.post('/ajax/authentication', {email:email, pass:pass}, function(data){
        console.log(data);

        if(data == 'success'){
            $("#auth").modal('hide');
            $('#user').val(1);
            cart_databank(id_bank);
        }
        if(data == 'error'){
            $('.hint').html('Неправильный логин или пароль');
        }
    });
}