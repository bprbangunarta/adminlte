<!-- Modal Add -->
<div class="modal fade" id="modal-add">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 5px;">
            <div class="modal-header bg-bpr" style="border-radius: 5px 5px 0px 0px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">FORM TAMBAH</h4>
            </div>
            <div class="modal-body">
                <div class="mb-10">
                    <label class="mb-0">Perizinan</label>
                    <input type="text" class="form-control" name="perizinan_add" id="perizinan_add">
                </div>

                <div>
                    <label class="mb-0">Guard</label>
                    <input type="text" class="form-control" name="guard_name_add" id="guard_name_add" placeholder="(Optional)">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">
                    <i class="fa fa-close"></i>&nbsp; Tutup
                </button>

                <button type="button" class="btn btn-sm btn-bpr" id="btn-save">
                    <i class="fa fa-plus"></i>&nbsp; Tambah
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 5px;">
            <div class="modal-header bg-yellow" style="border-radius: 5px 5px 0px 0px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">FORM UPDATE</h4>
            </div>
            <div class="modal-body">
                <div class="mb-10">
                    <label class="mb-0">Perizinan</label>
                    <input type="text" class="form-control" name="perizinan" id="perizinan">

                    @error('perizinan')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div>
                    <label class="mb-0">Guard</label>
                    <input type="text" class="form-control" name="guard_name" id="guard_name" placeholder="(Optional)">

                    @error('guard_name')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">
                    <i class="fa fa-close"></i>&nbsp; Tutup
                </button>

                <button type="button" class="btn btn-sm btn-warning" id="btn-update">
                    <i class="fa fa-save"></i>&nbsp; Simpan
                </button>
            </div>
        </div>
    </div>
</div>