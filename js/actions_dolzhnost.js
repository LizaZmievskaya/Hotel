$(document).ready(function() {
    //DELETE
    $('input[name="del"]').on('click',function (){
        var id = $(this).closest('tr').data('id');
        var dol = 'dolzhnost';
        $.ajax({
            url:'delete_dol.php',
            method:'POST',
            data: 'id=' + id + '&table=' + dol,
            type: 'Json',
            success: function(data){
                data = jQuery.parseJSON(data);
                if(data.status=='success'){
                    $(this).closest('tr').remove();
                } else {//NEVEDOMAYA HUJNYA
                    $("#errorModal").modal("show");
                }
            }
        });
    });
    //ADD
    $('button[name=add]').on('click', function(){
        var dol = $('input#inputDol').val();
        $.ajax({
            url:'add_dol.php',
            method:'post',
            data:'dolzhnost=' + dol,
            type:'json',
            success:function(data){
                $("#addModal").modal("hide");
            }
        });
    });
    //EDIT
    $('button[name=edit]').on('click', function(){
        var id = $(this).closest('tr').data('id');
        var dol = $(this).closest('tr').data('dol');
        $('#editModal').attr('data-dol',dol);
        $('input[name="dolzhnost"]').val(dol);
    });
    $('button[name=save]').on('click', function(){
        var id = $('#editModal').data('id');
        var dol = $('#editModal input[name="dolzhnost"]').val();
        $.ajax({
            url:'update_dol.php',
            method:'post',
            data:'id=' + id + '&dol=' + dol,
            type:'json',
            success:function(data){
                $("#editModal").modal("hide");
            }
        });
    });
})