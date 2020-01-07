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

let arrActionModule = [];

function onChangeAcl(actionId, moduleId) {
    let status = $('#' + actionId + '-' + moduleId).prop('checked');

    let index = -1;
    index = arrActionModule.findIndex(x => x.action_id == actionId && x.module_id == moduleId);
    if (index !== -1) {
        arrActionModule.splice(index, 1);
    }

    arrActionModule.push(
        {
            'action_id': actionId,
            'module_id': moduleId,
            'status': status,
        }
    );
}

function doSendAcl(adminId) {
    ajaxDoSendAcl(adminId)
}

function ajaxDoSendAcl(adminId) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax(
        {
            url: '/admin/admin/create/acl',
            type: 'post',
            data: {
                'data': JSON.stringify(arrActionModule),
                'admin_id': adminId
            },
            dataType: 'json',
            success: function (data) {
                window.location.href = data.url;
            },
        }
    )
}
