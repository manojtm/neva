$(document).ready(function() {

    var first_name = localStorage.getItem('first_name');
    var full_name = localStorage.getItem('full_name');

    var api = 'http://localhost/neva/api/index.php/';

    if ( null === localStorage.getItem('user') ) {
        window.location = 'index.html';
    }

    $('#user_full_name').text(full_name);

    $('#logout').click(function() {

        $.ajax({
            type: "GET",
            url: api + "logout",
            success: function() {
                localStorage.removeItem('user');
                localStorage.removeItem('full_name');
                localStorage.removeItem('first_name');
                window.location = 'index.html';
            },
            error: function() {

            }
        });

    });

    load_friends = function()
    {
        $.ajax({
            type: "GET",
            url : api + 'dashboard/load_friends',
            success: function (data) {
                console.log(data);
                $('#friends_list tbody').html(data);
            },
            error: function() {
                alert('error: while loading friends.');
            }
        });
    }

    load_friends();

    $('#add_friend').submit(function() {
        var friend_email = $('#friend_email').val();
        $.ajax({
            type: "POST",
            url : api + 'dashboard/add_friend', 
            data: { friend_email: friend_email },
            success: function(data) {

                $('#exampleModal').modal('hide');

                $('#alert_main').removeClass('hide');
                $('#alert_msg').text(data.msg);

                load_friends();

            },
            error: function() {
                alert('Failed: Adding Friend');
            }
        });
        return false;
    });

    load_chats = function(fid)
    {
        $.ajax({
            type: "GET",
            data: { fid: fid },
            url: api + 'dashboard/load_chats',
            success: function(data) {
                console.log(data);
                $('#chats_list').html(data);
            },
            error: function() {
                alert('Failed to load chats');
            }
        });
    }

    chat = function(fid, friend_name)
    {
        $('#mcont').removeClass('hide');
        $('#chat_with').html('with ' + friend_name);
        $('#friend_to').val(fid);
        $('#f_name').val(friend_name);
        load_chats(fid);
    }

    $('#send_message').submit(function() {

        var message = $('#message').val();
        var friend_to = $('#friend_to').val();
        var f_name = $('#f_name').val();

        $.ajax({
            type: "POST",
            url: api + 'dashboard/new_message',
            data: { friend_to: friend_to, message: message },
            success: function (data) {
                chat(friend_to, f_name);
            },
            error: function () {
                alert('Failed to send Message,');
            }
        });

        $('#message').val('');

        return false;

    });


});