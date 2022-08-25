<!-- Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="post" id="updateProductForm">
            @csrf
            <input type="hidden" id="up_id">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Edit Contact</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="errMsgContainer mb-3">

                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="up_name" id="up_name" placeholder="Name">
                    </div>
                    <div class="form-group mt-2">
                        <label for="company">Company</label>
                        <input type="text" class="form-control" name="up_company" id="up_company" placeholder="Company">
                    </div>
                    <div class="form-group mt-2">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" name="up_phone" id="up_phone" placeholder="Phone">
                    </div>
                    <div class="form-group mt-2">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="up_email" id="up_email" placeholder="Email">
                    </div>

                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                    <button type="button" class="btn btn-primary update_product">Submit</button>
                </div>
                </div>
        </form>
    </div>
</div>

