$(function () {

        loadActivePolls();
        loadAnsweredPolls();

        $(document).on('click', ".submit-poll", function () {
            let element = $('input[name^=poll]:checked');

            var poll = element.data('poll_id');
            var answer = element.val();
            
            answerPoll(poll, answer);
        });
    
});


function loadActivePolls(){

    let url = $("#active_poll").val();

    let token = getCookie('accessToken');
    
    $.ajax({
        url: url,
        method: 'GET',
        contentType: 'application/json',
        dataType: 'JSON',
        headers: { 
            'Authorization':'Bearer ' + token, 
            'Content-Type':'application/json' 
        }, 
        success: function (data) {
            renderPolls(data.data, '.active-polls');
        },
        error: function(jqXHR, exception) {
            alert(jqXHR.responseJSON.message);
            if (jqXHR.responseJSON.message == 'Unauthenticated.') {
                window.location.href="/login";
            }
        }
    });
}

function loadAnsweredPolls(){

    let url = $("#answered_poll").val();

    let token = getCookie('accessToken');
    
    $.ajax({
        url: url,
        method: 'GET',
        contentType: 'application/json',
        dataType: 'JSON',
        headers: { 
            'Authorization':'Bearer ' + token, 
            'Content-Type':'application/json' 
        }, 
        success: function (data) {
            renderPolls(data.data, '.answered-polls');
        }
    });
}


function renderPolls(poll, target) {
    $.each(poll, function (i, item) {
        let token = getCookie('accessToken');
        let url = '/api/poll/render-poll/'+item.id;
        $.ajax({
            url: url,
            method: 'GET',
            contentType: 'application/json',
            dataType: 'html',
            headers: { 
                'Authorization':'Bearer ' + token, 
                'Content-Type':'application/json' 
            }, 
            success: function (data) {
                $(target).append(data);
            }
        });
    });
}

function answerPoll(poll, answer)
{
    let token = getCookie('accessToken');
    let url = '/api/answer-poll/'+poll+'/'+answer;    

    $.ajax({
        url: url,
        method: 'GET',
        contentType: 'application/json',
        dataType: 'html',
        headers: { 
            'Authorization':'Bearer ' + token, 
            'Content-Type':'application/json' 
        }, 
        success: function (data) {

            $(".active-polls").html('');
            $(".answered-polls").html('');
            loadActivePolls();
            loadAnsweredPolls();
        }
    });
}