<script>
    @if(session('success'))
        $("#msg").append(`
            
            <div class="alert
                      customize-alert
                      alert-dismissible
                      border-success
                      text-black
                      fade
                      show
                      remove-close-icon
                    " role="alert"  >
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Success - </strong> {{ session('success') }}
            </div>
        
        `).fadeOut(10000)
    @elseif(session('error'))
        $("#msg").append(`
            
            <div class="
                      alert
                      customize-alert
                      alert-dismissible
                      border-danger
                      text-danger
                      fade
                      show
                      remove-close-icon
                    " role="alert"  >
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Error - </strong> {{ session('error') }}
            </div>
        
        `).fadeOut(10000)
    @elseif(session('warning'))
        $("#msg").append(`
            
            <div class="
                      alert
                      customize-alert
                      alert-dismissible
                      border-warning
                      text-warning
                      fade
                      show
                      remove-close-icon
                    " role="alert"  >
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Success - </strong> {{ session('warning') }}
            </div>
        
        `).fadeOut(10000)
    @elseif(session('info'))
        $("#msg").append(`
            
            <div class="
                      alert
                      customize-alert
                      alert-dismissible
                      border-info
                      text-info
                      fade
                      show
                      remove-close-icon
                    " role="alert"  >
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Info - </strong> {{ session('info') }}
            </div>
        
        `).fadeOut(10000)
    @endif
</script>

<script>
    function dataTable(table_id , route , columns) {
        $("#" + table_id).DataTable({
            processing: true,
            serverSide: true,
            ajax: route ,
            columns: columns,
            scrollX:"300px",
            language: {
                url: '{!! asset('/js/lang/datatable/french.json') !!}',
            },
        });
    }
    function submitForm(id){
        document.getElementById(id).submit();
    }
</script>

<script>
    function modalAlertDelete(id , title, type , message){
        let modalId = 'modal'+id
        modalAlert(modalId , 'warning')
        $('#'+ modalId +' .title_elmt').text(title)
        $('#'+ modalId +' .desc_elmt')
        .html("Cette action est irréversible. \
                <p>Êtes vous sûr de vouloir supprimer la/le "+ type + " << <strong style='color:#FF4747;'>" + message + "</strong>  >> ?</p>")

        $('#btn-modal-continuous-'+modalId).attr('onclick',"submitForm('"+id+"')"); 
        
        $('#' + modalId).modal('show')
    }

    function modalAlertConfirmAction(id , title , type , message){
        let modalId = 'modal'+id
        modalAlert(modalId , 'warning')
        $('#'+ modalId +' .title_elmt').text(title)
        $('#'+ modalId +' .desc_elmt')
        .html("Cette action est irréversible. \
                <p>Êtes vous sûr de vouloir "+ type + " la/le "+ type + " << <strong style='color:#FF4747;'>" + message + "</strong>  >> ?</p>")

        $('#btn-modal-continuous-'+modalId).attr('onclick',"event.preventDefault(); document.getElementById('"+id+"').submit()"); 
        
        $('#' + modalId).modal('show')
    }   

    function modalAlertError(id , title, type , message){
        let modalId = 'modal'+id
        modalAlert(modalId , 'danger')
        $('#'+ modalId +' .title_elmt').text(title)
        $('#'+ modalId +' .desc_elmt').text(message)

        $('#btn-modal-continuous-'+modalId).attr('data-bs-dismiss',"modal"); 
        
        $('#' + modalId).modal('show')
    }
</script>

<script>

    function select(tag , name) {
        $("#" + tag).select2({
            placeholder: "Choisir un/une " + name,
            allowClear: true,
            language: "fr"
        });
    }

    function select2(tag , name , route) {
        $("#" + tag).select2({
            placeholder: "Choisir un/une " + name,
            allowClear: true,
            language: "fr",
            ajax: {
                url: function (params) {
                    return route + "?search=" + params.term ;
                },
                dataType: 'json',
                delay: 250,
                minimumInputLength: 2,
                processResults: function (data) {
                    result = [];
                    for (let i = 0; i < data.length; i++) {
                        if (data[i].lastname) {
                            result.push({id: data[i].id, text: data[i].lastname +' ' + data[i].firstname})
                        } else if(data[i].company_name) {
                            result.push({id: data[i].id, text: data[i].company_name})
                        }else {
                            result.push({id: data[i].id, text: data[i].name})
                        }
                    }
                    return {
                        results: result
                    };
                }
            }
        });
    }
</script>
