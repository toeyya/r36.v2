<div id="footer">© Copyright All Right Reserved. ระบบการรายงานผู้สัมผัส หรือสงสัยว่าสัมผัสโรคพิษสุนัขบ้า</div> 
<div id="relate" class="modal hide fade">
    <form id="frm_relate" class="form-horizontal" method="post" action="webboards/save_relate">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>แจ้งลบความเห็น</h3>
    </div>
    <div class="modal-body">
        <fieldset>
            <div class="control-group">
                <label class="control-label" for="inputLogin">เหตุผล</label>
                <div class="controls">
                    <textarea name="reason" rows="3"></textarea>
                    <input type="hidden" name="webboard_quiz_id" value="" >
                    <input type="hidden" name="webboard_answer_id" value="" >
                </div>
            </div>
        </fieldset>
    </div>
    <div class="modal-footer">
        <button type="submit" id="send-relate" class="btn btn-primary">ยืนยัน</button>
        <a href="#" class="btn" data-dismiss="modal">ปิด</a>
    </div>
    </form>
</div>