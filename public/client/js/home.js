function submitAddToCartHomePage(productId) {
    document.getElementById('add_to_cart_form_' + productId).submit();
}

async function triggerModal() {
    await sleep(500);
    document.getElementById('btn_trigger_modal').click();

}

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

triggerModal().then(r => function () {
});
