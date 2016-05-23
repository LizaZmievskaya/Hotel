$(document).ready(function() {
    //DELETE
    $('input[name="delete"]').on('click',function (){
        var id = $(this).closest('tr').data('pass');
        var table = "client";
        var ident = "passport";
        $.ajax({
            url:'../delete.php',
            method:'POST',
            data: 'id=' + id + '&table=' + table + '&ident=' + ident,
            type: 'Json',
            success: function(data){
                data = jQuery.parseJSON(data);
                if(data.status=='success'){
                    $("tr[data-pass='" + id +"']").remove();
                } else {
                    $("#errorModal").modal("show");
                }
            }
        });
    });
    //ADD
    $('button[name=add]').on('click', function(){
        var pass = $('input#inputPass').val();
        var fam = $('input#inputFam').val();
        var imya = $('input#inputImya').val();
        var ot = $('input#inputOt').val();
        var adres = $('input#inputAdres').val();
        var tel = $('input#inputTel').val();
        $.ajax({
            url:'../add_client.php',
            method:'post',
            data:'pass=' + pass + '&fam=' + fam + '&imya=' + imya + '&ot=' + ot + '&adres=' + adres + '&tel=' + tel,
            type:'json',
            success:function(data){
                $("#addModal").modal("hide");
            }
        });
    });
    //EDIT
    $('button[name=edit]').on('click', function(){
        var pass = $(this).closest('tr').data('pass');
        var fam = $(this).closest('tr').data('fam');
        var imya = $(this).closest('tr').data('imya');
        var ot = $(this).closest('tr').data('ot');
        var adres = $(this).closest('tr').data('adres');
        var tel = $(this).closest('tr').data('tel');
        $('#editModal').attr('data-pass',pass);
        $('#editModal').attr('data-fam',fam);
        $('#editModal').attr('data-imya',imya);
        $('#editModal').attr('data-ot',ot);
        $('#editModal').attr('data-adres',adres);
        $('#editModal').attr('data-tel',tel);
        $('input[name="pass"]').val(pass);
        $('input[name="fam"]').val(fam);
        $('input[name="imya"]').val(imya);
        $('input[name="ot"]').val(ot);
        $('input[name="adres"]').val(adres);
        $('input[name="tel"]').val(tel);
    });
    $('button[name=save]').on('click', function(){
        var pass = $('#editModal').data('pass');
        var fam = $('#editModal input[name="fam"]').val();
        var imya = $('#editModal input[name="imya"]').val();
        var ot = $('#editModal input[name="ot"]').val();
        var adres = $('#editModal input[name="adres"]').val();
        var tel = $('#editModal input[name="tel"]').val();
        $.ajax({
            url:'../update_client.php',
            method:'POST',
            data:'pass=' + pass + '&fam=' + fam + '&imya=' + imya + '&ot=' + ot + '&adres=' + adres + '&tel=' + tel,
            type:'json',
            success:function(data){
                $("#editModal").modal("hide");
            }
        });
    });
})