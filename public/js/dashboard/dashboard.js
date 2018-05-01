window.onload = function () {
    moveModals();
};

function moveModals() {
    jQuery("#modals").detach().appendTo('body')
}