jQuery(document).ready(function($) {
    $('#availability').change(function() {
        if ($(this).val() === 'yes') {
            $('#availability_details').show();
            $('#availability_details_year').show();
        } else {
            $('#availability_details').hide();
            $('#availability_details_year').hide();
        }
    }).change();;
});