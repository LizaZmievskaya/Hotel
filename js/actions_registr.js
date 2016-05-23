$(document).ready(function() {
    //DELETE
    $('input[name="delete"]').on('click',function (){
        var id = $(this).closest('tr').data('id');
        var table = "registration";
        var ident = "registr_id";
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
        var pass = $('select[name=pass]').text();
        var date1 = $('input#inputData1').val();
        var date2 = $('input#inputData2').val();
        var nom = $('select[name=nom]').text();
        var oplata = $('select[name=oplata]').val();
        var sotr = $('select[name=sotr]').text();
        $.ajax({
            url:'../add_registr.php',
            method:'post',
            data:'pass=' + pass + '&date1=' + date1 + '&date2=' + date2 + '&nom=' + nom + '&oplata=' + oplata + '&sotr=' + sotr,
            type:'json',
            success:function(data){
                $("#addModal").modal("hide");
            }
        });
    });
    //EDIT
    $('button[name=edit]').on('click', function(){
        var id = $(this).closest('tr').data('id');
        var pass = $(this).closest('tr').data('pass');
        var date1 = $(this).closest('tr').data('1');
        var date2 = $(this).closest('tr').data('2');
        var nom = $(this).closest('tr').data('nom');
        var oplata = $(this).closest('tr').data('oplata');
        var sid = $(this).closest('tr').data('sid');
        $('#editModal').attr('data-id',id);
        $('#editModal').attr('data-pass',pass);
        $('#editModal').attr('data-1',date1);
        $('#editModal').attr('data-2',date2);
        $('#editModal').attr('data-nom',nom);
        $('#editModal').attr('data-oplata',oplata);
        $('#editModal').attr('data-sid',sid);
        $('input[name="id"]').val(id);
        $('input[name="pass"]').val(pass);
        $('input[name="date1"]').val(date1);
        $('input[name="date2"]').val(date2);
        $("select[name='nom'] :contains('" + nom + "')").attr("selected", "selected");
        $("select[name='oplata'] :contains('" + oplata + "')").attr("selected", "selected");
        $("select[name='sid'] :contains('" + sid + "')").attr("selected", "selected");
    });
    $('button[name=save]').on('click', function(){
        //var id = $('#editModal').data('id');
        var id = $('#editModal input[name="id"]').val();
        var pass = $('#editModal input[name="pass"]').val();
        var date1 = $('#editModal input[name="date1"]').val();
        var date2 = $('#editModal input[name="date2"]').val();
        var nom = $('#editModal select[name="nom"] :selected').text();
        var oplata = $('#editModal select[name="oplata"] :selected').val();
        var sid = $('#editModal select[name="sid"] :selected').text();
        $.ajax({
            url:'../update_registr.php',
            method:'POST',
            data:'id=' + id + '&pass=' + pass + '&date1=' + date1 + '&date2=' + date2 + '&nom=' + nom + '&oplata=' + oplata + '&sid=' + sid,
            type:'json',
            success:function(data){
                $("#editModal").modal("hide");
            }
        });
    });
})