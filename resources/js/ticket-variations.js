jQuery(document).ready(function($) {


    console.log('ticket variations ready')
    // When the user selects a variation from the dropdown
    $('.tax-location #variation_select').change(function() {
        // Get the selected variation ID
        var variation_id = $(this).val();
        // Update the hidden input with the selected variation ID
        $('input[name="variation_id"]').val(variation_id);
    });
    // When the user submits the form
    $('.tax-location .variations_form').submit(function(e) {
        // Prevent the form from submitting normally
        e.preventDefault();
        // Get the product ID and selected variation ID
        var product_id = $(this).find('input[name="add-to-cart"]').val();
        var variation_id = $('input[name="variation_id"]').val()
        // Add the variation to the cart using AJAX
        window.location.href = '/booking-information?add-to-cart=' + product_id + '&variation_id=' + variation_id + '&quantity=1'
    });
});