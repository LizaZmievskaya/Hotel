$(document).ready(function() {
    //DELETE
    $('input[name="delete"]').on('click',function (){
        var id = $(this).closest('tr').data('id');
        var table = "sotrudnik";
        var ident = "sotrudnik_id";
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
        var fam = $('input#inputFam').val();
        var imya = $('input#inputImya').val();
        var ot = $('input#inputOt').val();
        var tel = $('input#inputTel').val();
        var dolzhnost = $('select[name=dolzhnost]').val();
        $.ajax({
            url:'../add_sotr.php',
            method:'post',
            data:'fam=' + fam + '&imya=' + imya + '&ot=' + ot + '&tel=' + tel + '&dolzhnost=' + dolzhnost,
            type:'json',
            success:function(data){
                $("#addModal").modal("hide");
            }
        });
    });
    //EDIT
    $('button[name=edit]').on('click', function(){
        var id = $(this).closest('tr').data('id');
        var fam = $(this).closest('tr').data('fam');
        var imya = $(this).closest('tr').data('imya');
        var ot = $(this).closest('tr').data('ot');
        var tel = $(this).closest('tr').data('tel');
        var dolzhnost = $(this).closest('tr').data('dol');
        $('#editModal').attr('data-id',id);
        $('#editModal').attr('data-fam',fam);
        $('#editModal').attr('data-imya',imya);
        $('#editModal').attr('data-ot',ot);
        $('#editModal').attr('data-tel',tel);
        $('#editModal').attr('data-dol',dolzhnost);
        $('input[name="fam"]').val(fam);
        $('input[name="imya"]').val(imya);
        $('input[name="ot"]').val(ot);
        $('input[name="tel"]').val(tel);
        $("select[name='dolzhnost'] :contains('" + dolzhnost + "')").attr("selected", "selected");
    });
    $('button[name=save]').on('click', function(){
        var id = $('#editModal').data('id');
        var fam = $('#editModal input[name="fam"]').val();
        var imya = $('#editModal input[name="imya"]').val();
        var ot = $('#editModal input[name="ot"]').val();
        var tel = $('#editModal input[name="tel"]').val();
        var dolzhnost = $('#editModal select[name="dolzhnost"] :selected').val();
        $.ajax({
            url:'../update_sotr.php',
            method:'POST',
            data:'id=' + id + '&fam=' + fam + '&imya=' + imya + '&ot=' + ot + '&tel=' + tel + '&dolzhnost=' + dolzhnost,
            type:'json',
            success:function(data){
                $("#editModal").modal("hide");
            }
        });
    });
})