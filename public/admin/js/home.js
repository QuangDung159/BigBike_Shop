function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

async function triggerModalCreatedGallery() {
    await sleep(500);
    document.getElementById('btn_trigger_modal_list_gallery').click();
}

triggerModalCreatedGallery().then(r => function () {
});

function doClickActive() {
    document.getElementById('update_status_trigger').click();
}

function onChange() {
    alert('asd');
}
