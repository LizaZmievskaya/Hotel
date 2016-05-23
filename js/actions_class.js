$(document).ready(function() {
    //DELETE
    $('input[name="delete"]').on('click',function (){
        var id = $(this).closest('tr').data('id');
        var table = "class_nomera";
        var ident = "naimenov_id";
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
        var naimenov = $('input#inputNaimenov').val();
        var cena = $('input#inputCena').val();
        $.ajax({
            url:'../add_class.php',
            method:'post',
            data:'naimenov=' + naimenov + '&cena=' + cena,
            type:'json',
            success:function(data){
                $("#addModal").modal("hide");
            }
        });
    });
    //EDIT
    $('button[name=edit]').on('click', function(){
        var id = $(this).closest('tr').data('id');
        var naimenov = $(this).closest('tr').data('naim');
        var cena = $(this).closest('tr').data('cena');
        $('#editModal').attr('data-id',id);
        $('#editModal').attr('data-naim',naimenov);
        $('#editModal').attr('data-cena',cena);
        $('input[name="naimenov"]').val(naimenov);
        $('input[name="cena"]').val(cena);
    });
    $('button[name=save]').on('click', function(){
        var id = $('#editModal').data('id');
        var naimenov = $('#editModal input[name="naimenov"]').val();
        var cena = $('#editModal input[name="cena"]').val();
        $.ajax({
            url:'../update_class.php',
            method:'POST',
            data:'id=' + id + '&naimenov=' + naimenov + '&cena=' + cena,
            type:'json',
            success:function(data){
                $("#editModal").modal("hide");
            }
        });
    });
})