function show_blocks(id, str){
    $("#Modal").modal('show');

    $.post('/ajax/get_cart', {id:id, str:str}, function(data) {
        if(data == 'auth'){
            auth(id,str);
        }else{
            $('.modal-body').html(data);
        }
    });
}

function auth(id, str){
    var user = $('#user').val();

    if(user == 1){
        show_blocks(id, str);
    }else{
        $("#auth").modal('show');
        $('#number_bank').val(id);
        $('#number_str').val(str);
    }
}

function authentication(){
    var email = $('#email').val();
    var pass = $('#password').val();
    var id_bank = $('#number_bank').val();
    var str_bank = $('#number_str').val();

    console.log(email);
    console.log(pass);

    $.post('/ajax/authentication', {email:email, pass:pass}, function(data){
        console.log(data);

        if(data == 'success'){
            $("#auth").modal('hide');
            $('#user').val(1);
            show_blocks(id_bank, str_bank);
        }
        if(data == 'error'){
            $('.hint').html('Неправильный логин или пароль');
        }
    });
}

function filter(){
    $('#filter').modal('show');

    $.post('/ajax/filter', function (data){
        $('.modal-body').html(data);
    });
}