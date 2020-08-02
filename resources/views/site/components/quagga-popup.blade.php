<div class="mfp-hide" id="quagga-popup">
    <div id="quagga-popup__freeze-frame" ><img id="freeze-frame" src=""></div>
    <div id="quagga-popup__video"></div>
    <form class="form-horizontal" method="" action="">
        <div class="form-group">
            <label for="name" class="col-sm-4 control-label">UPC</label>
            <div class="col-sm-8">
                <input disabled type="text" class="form-control" id="barcode-reader-input" value="" name="reader_upc" placeholder="">
            </div>
        </div>

        <div class="form-group">
            <label for="" class="col-sm-4 control-label">Action</label>
            <div class="col-sm-8 barcode-actions">
                <button
                    class="btn btn-primary"
                    type="button"
                    id="barcode-reader-button"
                    disabled
                ><i class="fa fa-chevron-right"></i> &nbsp; Accept and Search</button>
                <button
                    class="btn btn-primary"
                    type="button"
                    id="barcode-reader-refresh"
                    disabled
                ><i class="fa fa-refresh"></i> &nbsp; Retry</button>
            </div>
        </div>
    </form>
</div>
