<div class="row p-3 text-dark">
    <div class="col-sm-12">
        <table id="example" class="table table-hover dataTable no-footer dtr-inline" cellspacing="0">
            <thead>
                <tr role="row">
                    <th class="text-center">
                        ORDER ID
                    </th>
                    <th class="text-center">
                        ORDER DATE
                    </th>
                    <th class="text-center">
                        DELIVERED DATE
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
                            @if ($stage->stage == 'complete')
                                
                                <tr style="position:relative;z-index:100;">
                                    <td class="text-center">BO_{{ $item->oid }}</td>
                                    <td class="text-center">2021-07-10 8.45</td>
                                    <td class="text-center">2021-08-10 12.45</td>
                                    <td class="d-flex w-100 justify-content-center">
                                       
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
