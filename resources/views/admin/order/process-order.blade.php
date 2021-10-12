<div class="w-100">

    <div class="table-responsive">
        <table class="table" id="dataTable" width="100%" cellspacing="0">
            <thead class="bg-gray">
                <tr class="product-table-head-tr">
                    <th>ID</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Payment method</th>
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
                           

                            @if($ordersItem->stage=="process")
                                <span class="badge text-white rounded-0 p-2 text-uppercase border" style="background-color:#f49025;">Processing</span>
                            @elseif($ordersItem->stage=="couriered")
                                <span class="badge text-white rounded-0 p-2 text-uppercase border" style="background-color:#619ffc;">Couriered</span>
                            @elseif($ordersItem->stage=="delivered")
                                <span class="badge text-white rounded-0 p-2 text-uppercase border" style="background-color:#a900b2;">Delivered</span>
                            @endif
                              
                            </div>
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
                                @if($ordersItem->paid=="0")
                                    <span class="badge badge-danger rounded-0 p-2 text-uppercase border">
                                        unPaid
                                    </span>
                                @elseif($ordersItem->paid=="1")
                                    <span class="badge badge-success rounded-0 p-2 text-uppercase border">
                                        paid
                                    </span>
                                @endif
                                

                            </div>
                        </td>

                        
                        <td>
                            <div>
                                <button class="btn btn-danger text-white border-0 RT-shadow order-view-btn mr-2" tab="process"  oid={{$ordersItem->oid}} data-toggle="modal" data-target="#order-info-model">
                                    <i class="fas fa-eye font-weight-bold order-view-btn"  oid={{$ordersItem->oid}} tab="process"></i>
                                    
                                </button>
                                <!--
                                <a href="/order/status/change?oid={{$ordersItem->oid}}&status=complete" class="btn btn-success text-white border-0 RT-shadow">
                                    <i class="fas fa-check"></i>
                                    <span class="font-weight-bold" >Complete</span>
                                </a>
                                -->
                                <button class="btn btn-dark text-white border-0 RT-shadow order-setting-btn" oid={{$ordersItem->oid}} paid={{$ordersItem->paid}} stage={{$ordersItem->stage}} data-toggle="modal" data-target="#user-order-setting-model">
                                    <i class="fas fa-cog" oid={{$ordersItem->oid}} paid={{$ordersItem->paid}} stage={{$ordersItem->stage}}></i>
                                </button>
                            </div>
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</div>