$(document).ready(function() {

    var api = 'http://localhost/neva/api/index.php/';

    val = function(element) {
        return $('#' + element).val();
    }


    $('#login').submit(function() {

        $('#login-msg').removeClass('hide');
        
        var username = val('username');
        var password = val('password');

        $.ajax({
            type: "POST",
            url : api + 'auth/login',
            data: { username: username, password: password },
            success: function (data) {
                $('#login-msg').text(data.msg);

                localStorage.setItem('user', data.data.id);
                localStorage.setItem('full_name', data.data.first_name+' '+data.data.last_name);
                localStorage.setItem('first_name', data.data.first_name);

                if ( data.status === 1 ) window.location = 'dashboard.html';
            },
            error: function() {
                alert('error');
            }
        });

        return false;

    });

    $('#register').submit(function() {

        var first_name = val('first_name');
        var last_name = val('last_name');
        var username = val('reg_username');
        var password = val('reg_password');

        $.ajax({
            type: "POST",
            url: api + "auth/register",
            data: { first_name: first_name, last_name: last_name, username: username, password: password },
            success: function(data) {
                $('#reg-msg').removeClass('hide').text(data.msg);
            },
            error: function () {
                alert('error: while registeration');
            }
        });

        return false;
    });


});