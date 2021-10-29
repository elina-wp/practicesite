class postFilter {
	constructor() {
        this.postSearchFilter();
    }
    
    postSearchFilter() {
        $( document ).on( 'keyup', '.search-filter__js', (e) => {
            var elem = $(e.currentTarget),
                val = elem.val();
                console.log(val);

            if ( '' == val ) {
                $( '.search-data__js' ).html('');
                $( '.search-data__js' ).css( 'display', 'none' );
                return false;
            }

            var data = {
                'serachVal' : val,
                'action': 'landmarkTeamSearchFilter',
            }
            $.ajax({
                url: landmark_object.ajaxurl,
                data: data,
                type: 'POST',
                success: (response) => {
                    $( '.search-data__js' ).html( response.html );
                    $( '.search-data__js' ).css( 'display', 'block' );
                }
            });
        });
    }
}
new postFilter();