$(document).ready(function() {
    //DELETE
    $('input[name="delete"]').on('click',function (){
        var id = $(this).closest('tr').data('id');
        var table = "dolzhnost";
        var ident = "dolzhnost_id";
        $.ajax({
            url:'../delete.php',
            method:'POST',
            data: 'id=' + id + '&table=' + table + '&ident=' + ident,
            type: 'Json',
            success: function(data){
                data = jQuery.parseJSON(data);
                if(data.status=='success'){
                    $("tr[data-id='" + id +"']").remove();
                } else {
                    $("#errorModal").modal("show");
                }
            }
        });
    });
    //ADD
    $('button[name=add]').on('click', function(){
        var dolzhnost = $('input#inputDolzhnost').val();
        $.ajax({
            url:'../add_dol.php',
            method:'post',
            data:'dolzhnost=' + dolzhnost,
            type:'json',
            success:function(data){
                $("#addModal").modal("hide");
            }
        });
    });
    //EDIT
    $('button[name=edit]').on('click', function(){
        var id = $(this).closest('tr').data('id');
        var dolzhnost = $(this).closest('tr').data('dol');
        $('#editModal').attr('data-id',id);
        $('#editModal').attr('data-dol',dolzhnost);
        $('input[name="dolzhnost"]').val(dolzhnost);
    });
    $('button[name=save]').on('click', function(){
        var id = $('#editModal').data('id');
        var dolzhnost = $('#editModal input[name="dolzhnost"]').val();
        $.ajax({
            url:'../update_dol.php',
            method:'POST',
            data:'id=' + id + '&dolzhnost=' + dolzhnost,
            type:'json',
            success:function(data){
                $("#editModal").modal("hide");
            }
        });
    });
})