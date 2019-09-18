/**
 * Created by dsola on 22/11/15.
 */
FormScope = {
    init: function() {
        FormScope.FormListener();
    },
    FormListener: function() {
        $('#form').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                'url': '/api/index,php?op=tweet',
                'type': 'POST',
                'data': {
                    'name': $("#text").val(),
                    'email': $("#email").val()
                },
                beforeSend: function() {
                    $("#ajax-response").html('Loading...').show('fade');;
                },
                statusCode: {
                    501: function (response) {
                        var message = JSON.parse(response.responseText);
                        $("#ajax-response").html(message.message)
                    },
                    500: function(response) {
                        var message = JSON.parse(response.responseText);
                        $("#ajax-response").html(message.message);
                    },
                    404: function(response) {
                        var message = JSON.parse(response.responseText);
                        console.log(message);
                        $("#ajax-response").html(message.message);
                    },
                    200: function(response) {
                        $("#ajax-response").html(response.tweet);
                    }
                }
            });
            //prevent submit
            return false;
        });
    }
};
/**
 * Created by dsola on 22/11/15.
 */
