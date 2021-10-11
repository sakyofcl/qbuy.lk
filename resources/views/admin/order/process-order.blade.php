<div class="w-100">

    <div class="table-responsive">
        <table class="table" id="dataTable" width="100%" cellspacing="0">
            <thead class="bg-gray">
                <tr class="product-table-head-tr">
                    <th>ID</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Payment</th>
                    
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>


                @foreach ($orders as $ordersItem )
                    <tr class="product-list-tr">
                        <td>
                            <div>#{{$ordersItem->oid}}</div>
                        </td>
                        <td>
                            <div class="text-uppercase">
                            <?php
                        
                                echo date('m/d/Y', strtotime($ordersItem->date));
                                echo " ";
                                echo date('h:i a',strtotime($ordersItem->date));
                                
                            ?>
                            
                            
                            </div>
                        </td>
                        <td>
                            <?php 
                                $totalAmount=0;
                                foreach($orderProduct as  $orderProductItem){
                                    if($orderProductItem['oid']==$ordersItem->oid){
                                        $totalAmount+=$orderProductItem['price']*$orderProductItem['qty'];
                                    }
                                }
                                
                            ?>
                            
                            <div>Rs {{number_format($totalAmount,2)}}</div>
                        </td>
                        
                        <td>
                            <div>

                                @if($ordersItem->payment=="cash")
                                    <span class="badge badge-primary rounded-0 p-2 text-uppercase border">
                                        <i class="fas fa-money-bill-alt"></i>
                                        Cash
                                    </span>
                                @elseif($ordersItem->payment=="card")
                                    <span class="badge badge-danger rounded-0 p-2 text-uppercase border">
                                        <i class="fas fa-credit-card"></i>
                                        Card
                                    </span>
                                @endif
                            
                            </div>
                        </td>

                        
                        <td>
                            <div>
                                <button class="btn btn-danger text-white border-0 RT-shadow order-view-btn mr-2" tab="process"  oid={{$ordersItem->oid}} data-toggle="modal" data-target="#order-info-model">
                                    <i class="fas fa-eye font-weight-bold order-view-btn"  oid={{$ordersItem->oid}} tab="process"></i>
                                    <span class="font-weight-bold order-view-btn"  oid={{$ordersItem->oid}} tab="process" >View</span>
                                </button>
                                <a href="/order/status/change?oid={{$ordersItem->oid}}&status=complete" class="btn btn-success text-white border-0 RT-shadow">
                                    <i class="fas fa-check"></i>
                                    <span class="font-weight-bold" >Complete</span>
                                </a>
                            </div>
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</div>