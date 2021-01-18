<div class="basic-login-form-ad">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div id="zoomInDown1" class="modal modal-edu-general modal-zoomInDown fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-close-area modal-close-df">
                            <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close mr-1 mt-1"></i></a>
                        </div>
                        <div class="modal-body">
                            <div class="modal-login-form-inner">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="basic-login-inner modal-basic-inner">
                                            <form action="{{ route('subscription.payment.create') }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label class="login2">Amount (GHC)</label></label>
                                                    <input type="text" name="amount" class="form-control"
                                                           value="{{ $amount }}" disabled/>
                                                </div>
                                                <div class="form-group">
                                                    <label class="login2">Mobile Money Number (MTN)</label>
                                                    <input type="text" name="momo_number" class="form-control"
                                                           placeholder="eg. 0245645344" value="{{ old('momo_number') }}"
                                                           required pattern="^(054|024|055)([0-9]{7,9})"
                                                           oninvalid="this.setCustomValidity('Enter valid mobile money number')"
                                                           oninput="this.setCustomValidity('')"/>
                                                </div>
                                                @php
                                                    $bus = \App\Models\Business::findOrFail(session('business_id'));
                                                @endphp
                                                <p class="text-bold">Hello {{ $bus->name }}, we require you have more
                                                    than <strong>GHC{{ $amount }}</strong> in your Mobile Money Wallet.
                                                </p>
                                        </div>
                                        <div class="login-btn-inner mt-2 text-center">
                                            <div class="col-md-12">
                                                <div class="login-horizental">
                                                    <button class="btn btn-sm btn-primary login-submit-cs"
                                                            type="submit">Pay
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
