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
                                            <form action="{{ route('inventory.category.create') }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label class="login2">Name</label>
                                                    <input type="text" name="category_name" class="form-control"
                                                        placeholder="Category Name"
                                                        value="{{ old('category_name') }}" />
                                                </div>
                                        </div>
                                        <div class="login-btn-inner mt-2 text-center">
                                            <div class="col-md-12">
                                                <div class="login-horizental">
                                                    <button class="btn btn-sm btn-primary login-submit-cs"
                                                        type="submit">Create</button>
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
