$(document).ready(function() {
    //DELETE
    $('input[name="delete"]').on('click',function (){
        var id = $(this).closest('tr').data('nom');
        var table = "nomer";
        var ident = "nom_komnaty";
        $.ajax({
            url:'../delete.php',
            method:'POST',
            data: 'id=' + id + '&table=' + table + '&ident=' + ident,
            type: 'Json',
            success: function(data){
                data = jQuery.parseJSON(data);
                if(data.status=='success'){
                    $("tr[data-nom='" + id +"']").remove();
                } else {
                    $("#errorModal").modal("show");
                }
            }
        });
    });
    //ADD
    $('button[name=add]').on('click', function(){
        var nom = $('input#inputNom').val();
        var etazh = $('input#inputEtazh').val();
        var mest = $('input#inputMest').val();
        var tel = $('input#inputTel').val();
        var vremya = $('input#inputVremya').val();
        var naimenov = $('select[name=naimenov]').val();
        $.ajax({
            url:'../add_nomer.php',
            method:'post',
            data:'nom=' + nom + '&etazh=' + etazh + '&mest=' + mest + '&tel=' + tel + '&vremya=' + vremya + '&naimenov=' + naimenov,
            type:'json',
            success:function(data){
                $("#addModal").modal("hide");
            }
        });
    });
    //EDIT
    $('button[name=edit]').on('click', function(){
        var nom = $(this).closest('tr').data('nom');
        var etazh = $(this).closest('tr').data('etazh');
        var mest = $(this).closest('tr').data('mest');
        var tel = $(this).closest('tr').data('tel');
        var vremya = $(this).closest('tr').data('vremya');
        var naimenov = $(this).closest('tr').data('naimenov');
        $('#editModal').attr('data-nom',nom);
        $('#editModal').attr('data-etazh',etazh);
        $('#editModal').attr('data-mest',mest);
        $('#editModal').attr('data-tel',tel);
        $('#editModal').attr('data-vremya',vremya);
        $('#editModal').attr('data-naimenov',naimenov);
        $('input[name="nom"]').val(nom);
        $('input[name="etazh"]').val(etazh);
        $('input[name="mest"]').val(mest);
        $('input[name="tel"]').val(tel);
        $('input[name="vremya"]').val(vremya);
        $("select[name='naimenov'] :contains('" + naimenov + "')").attr("selected", "selected");
    });
    $('button[name=save]').on('click', function(){
        var nom = $('#editModal').data('nom');
        var etazh = $('#editModal input[name="etazh"]').val();
        var mest = $('#editModal input[name="mest"]').val();
        var tel = $('#editModal input[name="tel"]').val();
        var vremya = $('#editModal input[name="vremya"]').val();
        var naimenov = $('#editModal select[name="naimenov"] :selected').val();
        $.ajax({
            url:'../update_nomer.php',
            method:'POST',
            data:'nom=' + nom + '&etazh=' + etazh + '&mest=' + mest + '&tel=' + tel + '&vremya=' + vremya + '&naimenov=' + naimenov,
            type:'json',
            success:function(data){
                $("#editModal").modal("hide");
            }
        });
    });
})