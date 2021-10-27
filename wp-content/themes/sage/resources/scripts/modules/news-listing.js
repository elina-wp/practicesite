class newsList {
    constructor() {
        this.newsList();
    }

    newsList() {
        var ppp = 2;
        var pageNumber = 2;
        

        $('#load_more').click(function(e){
            e.preventDefault();
                $.ajax({
                url: landmark_object.ajaxurl,
                type: 'POST',
                dataType: "html",
                data: {
                    'action': 'blog_post',
                    'pageNumber': pageNumber,
                    'ppp': ppp,
                },
                beforeSend: function() {
                    $("#load_more").addClass('is-processing');
                },
                success: function(response) {
                    var _response = $.parseJSON(response);
                    console.log(_response);
                    if (_response) {
                        $("#blog-posts").append(_response.content);

                        if (_response.has_next) {
                            $("#load_more").show();
                        } else {
                            $("#load_more").hide();

                        }

                    } else {
                        $("#load_more").hide();
                    }
                },
                complete: function(data) {
                    $("#load_more").removeClass('is-processing');
                }
            });
            pageNumber++;
            return false;
        });
    }
}

// export default eventList;
new newsList();
