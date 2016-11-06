<script>
    $(document).ready(function(){
        $( "#area_id" ).keypress(function( event ) {
            event.preventDefault();
        });
        $( "#office_id" ).keypress(function( event ) {
            event.preventDefault();
        });
    });
    function clearDomainSelection_area_id(t){
        $(t).val('');
        $(t+'_txt').val('');
    }
    function clearDomainSelection_office_id(t){
        $(t).val('');
        $(t+'_txt').val('');
    }
    function OpenModalAreaSel(){
        Domain_Selector.fldName = 'area_id';
        Domain_Selector.removeNextToAll('#area_select');
        $('#modal-area-select').modal('show');
        $('#office_select').hide();
        $('#area_select').show();
        $('#office_selector').hide();
        $('#area_selector').show();
        $('#area_select').val('');
    }
    function OpenModalOfficeSel(){
        Domain_Selector.fldName = 'office_id';
        Domain_Selector.removeNextToAll('#office_select');
        $('#modal-area-select').modal('show');
        $('#office_select').show();
        $('#office_select').val('');
        $('#area_select').hide();
        $('#office_selector').show();
        $('#area_selector').hide();
    }
</script>