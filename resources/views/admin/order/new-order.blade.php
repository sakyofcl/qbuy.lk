<div class="w-100">

    <div class="table-responsive">
        <table class="table" id="dataTable" width="100%" cellspacing="0">
            <thead class="bg-gray">
                <tr class="product-table-head-tr">
                    <th>ID</th>
                    <th>User</th>
                    <th>Contact</th>
                    <th>Amount</th>
                    <th>Payment</th>
                    <th>Date</th>
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
                            <div class="user-profile-avatar">
                                <div class="avatar RT-shadow">
                                    <a href="#" class="link rounded-circle" id="profile">
                                        <img src="data:image/png;base64,{{$ordersItem->image}}" class="avatar-img" />
                                    </a>
                                </div>
                            </div>
                            
                        </td>

                        <td>
                            <div>{{$ordersItem->phone}}</div>
                        </td>
                        <td>
                            <div>Rs 254.00</div>
                        </td>
                        <td>
                            <div>

                                @if($ordersItem->payment=="cash")
                                    <span class="badge badge-primary rounded-0 p-2 text-uppercase border">
                                        <i class="fas fa-money-bill-alt"></i>
                                        Cash
                                    </span>
                                @elseif($ordersItem->payment=="card")
                                    <span class="badge badge-primary rounded-0 p-2 text-uppercase border">
                                        <i class="fas fa-credit-card"></i>
                                        Card
                                    </span>
                                @endif
                            
                            </div>
                        </td>
                    
                        <td>
                            <div>{{$ordersItem->date}}</div>
                        </td>
                        <td>
                            <div>
                                <button class="btn btn-danger text-white border-0 RT-shadow">
                                    <i class="fas fa-eye font-weight-bold"></i>
                                    <span class="font-weight-bold">View</span>
                                </button>
                            </div>
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</div>