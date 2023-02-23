(() => {
  // resources/js/app.js
  jQuery(document).ready(function($) {
    $("#variation_select").change(function() {
      var variation_id = $(this).val();
      $('input[name="variation_id"]').val(variation_id);
    });
    $(".variations_form").submit(function(e) {
      console.log($("#variation_select").val());
      e.preventDefault();
      var product_id = $(this).find('input[name="add-to-cart"]').val();
      var variation_id = $("#variation_select").val();
      window.location.href = "/booking-information?add-to-cart=" + product_id + "&variation_id=" + variation_id + "&quantity=1";
    });
  });
})();
