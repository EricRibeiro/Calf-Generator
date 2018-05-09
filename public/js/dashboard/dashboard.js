jQuery(function ($) {
    moveModals();
  });




function moveModals() {
    jQuery("#modals").detach().appendTo('body')
}