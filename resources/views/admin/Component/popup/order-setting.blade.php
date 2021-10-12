<div class="modal fade" id="user-order-setting-model" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Order settings</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="position:relative">
                <form action="/order/setting/status-paid/change/store" method="post">
                
                    <input type="text" name="oid"  hidden id="order-id"/>

                    <div class="card border RT-radius RT-shadow mb-3">
                        <div class="card-header" style="color:#000;">
                            Order status
                        </div>
                        <div class="card-body">
                        <div class="input-group">
                                <select class="custom-select" name="status" id="order-status">
                                    <option value="process">Processing</option>
                                    <option value="couriered">Couriered</option>
                                    <option value="delivered">Delivered</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card border RT-radius RT-shadow mb-3">
                        <div class="card-header" style="color:#000;">
                            Payment status
                        </div>
                        <div class="card-body">
                        <div class="input-group">
                                <select class="custom-select" name="paid" id="order-paid">
                                    <option value="1">Paid</option>
                                    <option value="0">Unpaid</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card border RT-radius RT-shadow">
                        <div class="card-header" style="color:#000;">
                            Order complete
                        </div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-3">
                                <p class="font-weight-bold" >If you want to complete this order?</p>
                                <footer class="blockquote-footer">Delivery status willbe delivered.</footer>
                                <footer class="blockquote-footer">Payment status willbe paid.</footer>
                            </blockquote>
                        </div>
                    </div>

                    <div class="d-flex">
                        <button type="reset" class="btn btn-google mt-3 w-25 mr-2">Reset</button>
                        <button type="submit" class="btn btn-facebook mt-3 w-75 ">Update</button>
                    </div>
                </form>

            </div>
            <!--
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary mr-2" data-dismiss="modal">Submit</button>
                
            </div>
            -->
        </div>
    </div>
</div>