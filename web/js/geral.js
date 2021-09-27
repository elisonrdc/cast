$(function() {

});

function getBaseURL() {
    var getUrl = window.location;
    var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
    return baseUrl + "/";
}

$(document).on('click', '.btn-modal-gridview', function(e) {

    var url = $(this).val();
    var titleModal = $(this).data('title_modal');

    $('#modalGridView').modal('show').find('.modal-body').load(url);
    $('#modalGridView .modal-title').html(titleModal);
});

$(document).on('click', '.btn-delete-gridview', function(e) {
    var url = $(this).val();
    Swal.fire({
        title: "Tem certeza de que deseja excluir?",
        text: "Você não poderá reverter isso!",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Sim",
        cancelButtonText: "Cancelar"
    }).then(function(result) {
        if (result.value) {
            $.ajax({
                url: url,
                dataType: 'JSON',
                cache: false,
                data: {},
                type: 'POST',
                beforeSend: function() {
                    exibeLoading();
                },
                success: function (response) {
                    fechaLoading();
                }
            });
        }
    });
});

function exibeLoading(message) {

    if(typeof message == 'undefined' || message == '' || message == null) { message = 'Por favor, aguarde...'; }

    HoldOn.open({
        theme: 'sk-circle',
        message: "<h4>"+message+"</h4>"
    });
}

function fechaLoading() {
    HoldOn.close();
}

function exibeAlert2(message, type, title, fCallbackConfirm) {

    if(typeof type == 'undefined' || type == '' || type == null) { type = ''; }
    if(typeof message == 'undefined' || message == '' || message == null) { message = ''; }
    if(typeof title == 'undefined' || title == '' || title == null) { title = ''; }
    if(typeof fCallbackConfirm == 'undefined' || fCallbackConfirm == '' || fCallbackConfirm == null) { fCallbackConfirm = ''; }

    Swal.fire({
        type: type,
        title: title,
        html: message,
    }).then(function(result) {
        if(result.value) {
            if (fCallbackConfirm != '') {
                fCallbackConfirm();
            }
        }
    });
}

function exibeAlert2TopEnd(message, type, timer) {

    if(typeof type == 'undefined' || type == '' || type == null) { type = ''; }
    if(typeof message == 'undefined' || message == '' || message == null) { message = ''; }
    if(typeof timer == 'undefined' || timer == '' || timer == null) { timer = 1500; }

    Swal.fire({
        position: 'top-end',
        type: type,
        title: message,
        showConfirmButton: false,
        timer: timer
    });
}