<div class="modal" tabindex="-1" role="dialog" id="payment-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Set Advertisment Price</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('advert.make_payment') }}" method="post" id="payment-form">
                <div class="modal-body">
                    @csrf
                    <label class="sr-only" for="price">Advert Price</label>
                    <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Price (GHC)</div>
                        </div>
                        <input type="text" class="form-control" id="price" name="price" disabled>
                    </div>
                    <input type="hidden" id="advert" name="advert">
                    <label class="sr-only" for="price">Enter mobile money number (MTN)</label>
                    <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">+233</div>
                        </div>
                        <input type="text" class="form-control" id="momo_number" name="momo_number" required
                            placeholder="Mobile Money Number (MTN)">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" id="btn-submit" class="btn btn-primary" value="Make Payment">
                </div>
            </form>
        </div>
    </div>
</div>
