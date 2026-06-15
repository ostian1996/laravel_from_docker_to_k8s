function emptySelect(tag) {
    $("#"+tag).empty();
}

function submitForm(formId) {
    $("#" + formId).submit()
}


function modalAlert(id, type="default"){
    var color = type == 'success' ? '#57B657' :
                    (type == 'warning' ? '#FFC100' :
                        (type == 'danger' ? '#FF4747' :
                            (type == 'info' ? '#248AFD' : '#f8f9fa')
                        )
                    );
    $('body').append(`
        <div id="${id}" class="modal fade" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="${id}Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-${type} text-white">
                        <h4 class="title_elmt modal-title" id="${type}-header-modalLabel">
                        </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="desc_elmt modal-text"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            Annuler
                        </button>
                        <button type="button" id="btn-modal-continuous-${id}" class=" btn btn-light-${type}  text-${type} font-weight-medium">
                            Continuer
                        </button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

    `)
}

