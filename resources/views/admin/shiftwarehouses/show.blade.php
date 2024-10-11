@extends('layouts.app')
@section('shiftwarehouse-active-class', 'active')
<style>
    .select2-container {
        width: 100% !important;
    }

    .user-card {
        width: 300px;
        /* Set the desired width for each card */
        margin: 10px;
        /* Add some margin to separate cards */
        border: 1px solid #ccc;
        /* Add a border for visual separation */
        padding: 10px;
        /* Add padding to the card content */
        text-align: center;
        /* Center the content horizontally */
    }

    .user-card img {
        max-width: 30%;
        /* Ensure the image doesn't exceed the card width */
        border-radius: 50%;
        /* Make the image a circle by setting border-radius */
    }

    .card {
        margin: 10px;
        padding: 10px;
    }

    .select2-container {
        width: 100% !important;
    }
</style>
@section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <form id="shift_warehouse_form">
                            <div class="row">
                                <div class="col-md-9">
                                    <h2 class="pb-3">Update Shiftwarehouse Detail</h2>
                                </div>
                                <div class="col-md-3 text-right">
                                    <h6>{{ $subwarehosue->date }}</h6>
                                </div>
                            </div>
                            <hr>
                            {{--  <div class="container">  --}}
                            <div class="row">
                                <!-- Left-side card with customer details -->
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <h3>Main Warehouse</h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <h5 for="main_warehouse_id">Warehouse</h5>
                                                    <h6>{{ optional($subwarehosue->mainWarehouse)->name }}</h6>
                                                </div>
                                                <div class="form-group">
                                                    <h5 for="main_location_id">Location</h5>
                                                    <h6>{{ optional($subwarehosue->mainLocation)->name }}</h6>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <h3>New Warehouse</h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <h5 for="sub_warehouse_id">Warehouse</h5>
                                                    <h6>{{ optional($subwarehosue->newWarehouse)->name }}</h6>
                                                </div>
                                                <div class="form-group">
                                                    <h5 for="sub_location_id">Location</h5>
                                                    <h6>{{ optional($subwarehosue->newLocation)->name }}</h6>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Add Items</h3>
                                    <p class="text-danger" id="checklist-error"></p>
                                    <hr>
                                    <table id="myTable" class=" table order-list">
                                        <thead class="bg-info text-white">
                                            <tr>
                                                <td><strong>Item</strong></td>
                                                <td><strong>Image</strong></td>
                                                <td><strong>Unit Type</strong></td>
                                                <td><strong>Store QTY</strong></td>
                                                <td><strong>QTY</strong></td>
                                                <td><strong>Remarks</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($subwarehosue->shifttedItems as $index => $shifttedItem)
                                                <tr>
                                                    <td class="col-3">
                                                        {{ optional($shifttedItem->item)->item_name }}
                                                    </td>
                                                    <td class="col-1 text-center">
                                                        <img src="{{ asset(optional($shifttedItem->item)->image_url ? optional($shifttedItem->item)->image_url : 'img/pic.png') }}"
                                                            alt="" width="50" id="item_image_0">
                                                    </td>
                                                    <td class="col-2">
                                                        {{ optional(optional($shifttedItem->item)->unitType)->name }}
                                                    </td>
                                                    <td class="col-1">
                                                        {{ optional($shifttedItem->item)->qty }}

                                                    </td>
                                                    <td class="col-1">
                                                        {{ $shifttedItem->item_assigned_qty }}
                                                    </td>
                                                    <td class="col-8">
                                                        {{ $shifttedItem->item_remarks }}
                                                    </td>

                                                </tr>
                                            @endforeach

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="6" style="text-align: left;">
                                                    <input type="button" class="btn btn-lg btn-block save-btn"
                                                        id="addrow" value="Add Row" />
                                                </td>
                                            </tr>
                                            <tr>
                                            </tr>
                                        </tfoot>
                                    </table>

                                </div>
                            </div>
                            <hr>

                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <textarea class="form-control" name="notes" id="notes" cols="30" rows="2">{{ $subwarehosue->notes }}</textarea>
                            </div>
                            <div class="row text-center">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5 for="recommanded_by">Recommanded BY</h5>
                                        <h6>{{ optional($subwarehosue->recommandedBy)->full_name }}</h6>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5 for="approved_by">Approved By</h5>
                                        <h6>{{ optional($subwarehosue->approvedBy)->full_name }}</h6>
                                    </div>
                                </div>
                            </div>


                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
