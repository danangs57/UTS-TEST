<section>

    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">
        Input Reimbursement
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Form Reimbursement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('reimbursement.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="validationDefault01">Date</label>
                                <input name="date" type="date" class="form-control" id="validationDefault01" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="validationDefault01">Description</label>
                                <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>

                            <div class="col-md-12 mb-3 controls">
                                <div class="entry input-group upload-input-group">
                                    <input class="form-control" name="images[]" type="file" required>
                                    <button class="btn btn-upload btn-success btn-add" type="button">
                                        <i class="fa fa-plus">+</i>
                                    </button>
                                </div>
                            </div>
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        @foreach($reimbursement as $reim)
        <div class="col-sm-6">
            <div class="card text-white bg-dark mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{$reim->date}}</h5>
                    <p class="card-text">{{$reim->description}}.</p>
                    <div class="row">
                        @foreach($reim->images as $rr)
                        <div class="col-md-2">
                            <a href="{{ asset('images/ReimbursementImage/'. $rr->path ) }}">

                                <img width="100px" height="50px" src="{{ asset('images/ReimbursementImage/'. $rr->path ) }}" alt="">
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</section>