$(function() {

    ///getLoggedInCookie();

    $("#login-form").on('submit', function () {
        let url = $(this).attr('action');

        let param = JSON.stringify(objectifyForm($(this).serializeArray()));

        $.ajax({
            url: url,
            method: "POST",
            contentType: 'application/json',
            accept: 'application/json',
            dataType: 'JSON',
            data: param,
            success: function (data) {
                console.log(data);
                setCookie('accessToken', data.User.accessToken, 15);

                setCookie('user', JSON.stringify(data.User), 15);

                window.location.href="/home";
            },
            error: function (err, error, message) {
                alert(err.responseJSON.message);
                $('*[class^="error-"]').css('display', 'none').text('');
                $.each(err.responseJSON.errors, function (i, item) {
                    $('.error-'+i).text(item[0]).css('display', 'block');
                })
            }
        });
        return false;
    }); 


    $("#register-form").on('submit', function () {
        let url = $(this).attr('action');

        let param = JSON.stringify(objectifyForm($(this).serializeArray()));

        $.ajax({
            url: url,
            method: "POST",
            contentType: 'application/json',
            accept: 'application/json',
            dataType: 'JSON',
            data: param,
            success: function (data) {
                setCookie('accessToken', data.User.accessToken, 15);

                setCookie('user', JSON.stringify(data.User), 15);

                window.location.href="/home";
            },
            error: function (err, error, message) {
                alert(err.responseJSON.message);
                $('*[class^="error-"]').css('display', 'none').text('');
                $.each(err.responseJSON.errors, function (i, item) {
                    $('.error-'+i).text(item[0]).css('display', 'block');
                })
            }
        });
        return false;
    }); 
});


function logout(element) {
    setCookie('user', '', -1);
    setCookie('accessToken', '', -1);
    $(element).submit();
    return false;
}
function objectifyForm(formArray) {
    //serialize data function
    var returnArray = {};
    for (var i = 0; i < formArray.length; i++){
        returnArray[formArray[i]['name']] = formArray[i]['value'];
    }
    return returnArray;
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
}

function getLoggedInCookie() {
    var cookie = document.cookie.indexOf('accessToken') !== -1;

    if(cookie){
        window.location.replace="/home";
    } else {
        window.location.replace="/login";
//        location.href = "/login";

        //return false;
    }
}
getLoggedInCookie();

function uiRender()
{
    let token = getCookie('accessToken');
    $.ajax({
        url: "/api/ui-render",
        method: "GET",
        contentType: 'application/json',
        accept: 'application/json',
        headers: { 
            'Authorization':'Bearer ' + token, 
            'Content-Type':'application/json' 
        },
        success: function (data) {
            $('.ui-render').html(data);
        },
        error: function (err, error, message) {
            alert(err.responseJSON.message);
        }
    });
}
uiRender();