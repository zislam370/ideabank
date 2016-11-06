<!-- CREATE TASK MODAL -->
<div class="modal fade Modal-Domain-Selector" id="modal-area-select">

    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal heading -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 id="area_selector" class="modal-title">@lang('form/title.area_selector')</h3>
                <h3 id="office_selector" class="modal-title">@lang('form/title.office_selector')</h3>
            </div>
            <!-- // Modal heading END -->

            <!-- Modal body -->
            <div class="modal-body">

                <div class="innerAll">
                    <div id="selection_div">
                        <div>
                            <select class="form-control" onchange="Domain_Selector.get_subdomains_by_cat(this)" id="area_select">
                                <option value="">বাছাই করুন</option>
                                <option value="4">বিভাগ</option>
                            </select>
                            <select class="form-control" onchange="Domain_Selector.get_subdomains_by_cat(this)" id="office_select">
                                <option value="">বাছাই করুন</option>
                                <option value="1">মন্ত্রণালয়</option>
                            </select>
                        </div>
                    </div>
                </div>

            </div>
            <!-- // Modal body END -->

        </div>
    </div>

</div>
<!-- // Modal END -->