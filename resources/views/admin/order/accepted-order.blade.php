<div class="row p-3 text-dark">
    <div class="col-sm-12">
        <table id="example" class="table table-hover dataTable no-footer dtr-inline" cellspacing="0">
            <thead>
                <tr role="row">
                    <th class="text-center">
                        ORDER ID
                    </th>
                    <th class="text-center">
                        PAYMENT
                    </th>
                    <th class="text-center">
                        STATUS
                    </th>
                    <th class="text-center">
                        ACTIONS
                    </th>
                </tr>
            </thead>

            <tbody id="containProductData">

                @foreach ($order as $item)
                    @foreach ($orderStage as $stage)
                        @if ($stage->oid == $item->oid)
                            @if ($stage->stage == 'accept')
                                
                                <tr style="position:relative;z-index:100;">
                                    <td class="text-center">BO_{{ $item->oid }}</td>
                                    
                                    <td class="d-flex justify-content-center">
                                        @foreach ($orderPaymentStatus as $payStatus)
                                            @if($payStatus->oid==$item->oid)
                                            
                                                @switch($payStatus->status)
                                                    @case("0")
                                                        <select name="status" oid="{{ $item->oid }}" class="order-payment-status form-control w-50 bg-danger text-white font-weight-bold"style="appearance:none;text-align-last: center; padding: 5px;">
                                                            <option class="bg-white text-dark" value="1">Received</option>
                                                            <option class="bg-white text-dark" value="0" selected>Not Received</option>
                                                        </select>
                                                        @break
                                                    @case("1")
                                                        <select name="status" oid="{{ $item->oid }}" class="order-payment-status form-control w-50 bg-success text-white font-weight-bold"style="appearance:none;text-align-last: center; padding: 5px;">
                                                            <option class="bg-white text-dark" value="1" selected>Received</option>
                                                            <option class="bg-white text-dark" value="0">Not Received</option>
                                                        </select>
                                                        @break
                                                @endswitch

                                            @endif
                                        @endforeach
                                        
                                    </td>
                                    <td>
                                        <div class="w-100 d-flex justify-content-center">

                                            @switch($item->status)
                                                @case("prepare")
                                                    <select id="order-status" name="status" orderid="{{ $item->oid }}"
                                                        class="form-control w-50 bg-dark text-white font-weight-bold order-status"
                                                        style="appearance:none;text-align-last: center; padding: 5px;">

                                                        <option class="bg-white text-dark" value="prepare" selected>Preparing
                                                        </option>
                                                        <option class="bg-white text-dark" value="courier">Sent to Courier</option>
                                                        <option class="bg-white text-dark" value="delivered">Delivered
                                                        </option>
                                                    </select>
                                                    @break
                                                @case("courier")
                                                    <select id="order-status" name="status" orderid="{{ $item->oid }}"
                                                        class="form-control w-50 bg-primary text-white font-weight-bold order-status"
                                                        style="appearance:none;text-align-last: center; padding: 5px;">

                                                        <option class="bg-white text-dark" value="prepare">Prepare
                                                        </option>
                                                        <option class="bg-white text-dark" value="courier" selected>Courier
                                                        </option>
                                                        <option class="bg-white text-dark" value="delivered">Delivered
                                                        </option>
                                                    </select>
                                                    @break
                                                @case("delivered")
                                                    <select id="order-status" name="status" orderid="{{ $item->oid }}"
                                                        class="form-control w-50 bg-success text-white font-weight-bold order-status"
                                                        style="appearance:none;text-align-last: center; padding: 5px;">

                                                        <option class="bg-white text-dark" value="prepare">Prepare
                                                        </option>
                                                        <option class="bg-white text-dark" value="courier" >Courier
                                                        </option>
                                                        <option class="bg-white text-dark" value="delivered" selected>Delivered
                                                        </option>
                                                    </select>
                                                    @break
                                            @endswitch
                                        </div>
                                    </td>

                                    <td class="d-flex w-100 justify-content-center">
                                        <a href="/order/complete?v=complete&oid={{$item->oid}}" class="btn btn-success mr-2" data-toggle="tooltip" title="Order Complete">
                                            
                                            <i class="fas fa-check-circle"></i>
                                        </a>
                                        <a href="/order/cancel?v=cancel&oid={{$item->oid}}" class="btn btn-icon btn-danger mr-2"
                                            data-toggle="tooltip" title="Cancel">
                                            <i class="fas fa-times-circle pl-1 pr-1"></i>
                                        </a>
                                        <button class="btn btn-icon  btn-primary order-check-btn" id="{{ $item->oid }}"
                                            data-toggle="modal" data-target="#order-check-model">
                                            <i class="fas fa-info pl-2 pr-2" id="{{ $item->oid }}"></i>
                                        </button>
                                        
                                    </td>


                                </tr>
                            @break
                        @endif
                    @endif
                @endforeach
                @endforeach

            </tbody>
        </table>
    </div>
</div>
