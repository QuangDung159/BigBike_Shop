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
    ajaxDoSendAcl(adminId);
    arrActionModule = [];
}

function doSendAclUpdate(adminId) {
    ajaxDoSendAclUpdate(adminId);
    arrActionModule = [];
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

function ajaxDoSendAclUpdate(adminId) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax(
        {
            url: '/admin/admin/update/acl',
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

function onClickLabelChangePassword() {
    $('#input_admin_password_new').prop('hidden', null);
    $('#input_admin_password_re').prop('hidden', null);
    $('#admin_password_current').prop('disabled', null).val('');
    $('#label_change').attr('hidden', true);
    $('#label_cancel').prop('hidden', null);
}

function onClickCancelChangePassword(adminPassword) {
    $('#input_admin_password_new').prop('hidden', true);
    $('#input_admin_password_re').prop('hidden', true);
    $('#admin_password_current').prop('disabled', true).val(adminPassword);
    $('#label_change').attr('hidden', null);
    $('#label_cancel').prop('hidden', true);
}
