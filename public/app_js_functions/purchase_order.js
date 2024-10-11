// Add an event listener to the vendor select dropdown using jQuery
var vendorWiseData = [];
var itemIDs = [];
$('#vendor_id').on('change', function () {
    // Clear existing price columns
    $('.vendor-price').remove();

    // Get the selected vendor IDs
    var selectedVendorIds = $(this).val();

    // Add a column for each selected vendor
    $.each(selectedVendorIds, function (index, vendorId) {

        getVendorName(vendorId, function (vendorName) {
            $('#priceHeader').after('<th class="col-1 vendor-price" data-vendor-id="' + vendorId +
                '">' + vendorName + ' Price</th>');

            // Create a new cell for the price input
            $('.priceCell').each(function () {
                var item_id = $(this).attr('id').replace('priceCell_',
                    ''); // Extract item_id from the cell ID
                $(this).after('<td class="vendor-price" data-vendor-id="' + vendorId +
                    '" data-item-id="' + item_id +
                    '"><input type="text" class="form-control" data-vendor-id="' +
                    vendorId +
                    '" data-item-id="' + item_id + '" /></td>');

            });
        });
        // Create a new header cell for the vendor's name
        // var vendorName = getVendorName(vendorId);

    });
});

// Listen to changes in the price text boxes
$(document).on('input', '.vendor-price input', function () {
    var item_id = $(this).closest('.vendor-price').data('item-id');
    var vendorId = $(this).closest('.vendor-price').data('vendor-id');
    var price = $(this).val();

    // Update the price for the specific item and vendor
    updatePriceForItemAndVendor(item_id, vendorId, price);
});

// Function to update the price for a specific item and vendor
function updatePriceForItemAndVendor(item_id, vendor_id, price) {
    // Implement your logic to update the price, e.g., make an AJAX request
    // Here, we'll just update the cell text for demonstration purposes
    $('#priceCell_' + item_id + ', .vendor-price[data-item-id="' + item_id + '"][data-vendor-id="' + vendor_id +
        '"] input').val(price);
}

// Replace this with your actual function to get vendor names by ID
function getVendorName(vendorId, callback) {
    $.ajax({
        type: "GET",
        url: $('#get_vendor_by_id').val(),
        data: {
            vendorId: vendorId
        },
        success: function (response) {
            var vendorName = response.vendor.name;
            callback(vendorName); // Call the callback function with the vendor name
        }
    });

}



// Add an event listener to the vendor select dropdown using jQuery
$('#vendor_id').on('change', function () {
    // Clear existing vendor sections
    $('#tab_logic_total tbody').empty();

    // Get the selected vendor IDs
    var selectedVendorIds = $(this).val();

    // Create and update financial information sections
    var titlesRow = $('<tr>');
    titlesRow.append('<th class="text-center">Vandor Name</th>');
    titlesRow.append('<th class="text-center">Sub Total</th>');
    titlesRow.append('<th class="text-center">CGST%</th>');
    titlesRow.append('<th class="text-center">CGST Tax Amount</th>');
    titlesRow.append('<th class="text-center">Grand Total</th>');
    titlesRow.append('<th class="text-center">Approve</th>');
    $('#tab_logic_total tbody').append(titlesRow);

    // Create rows for each selected vendor
    $.each(selectedVendorIds, function (index, vendorId) {
        getVendorName(vendorId, function (vendorName) {
            var vendorRow = $('<tr>');
            var itemId = 1; // Replace with the actual item ID
            vendorRow.append('<td class="text-center">' + vendorName + '</td>');
            vendorRow.append('<td class="text-center"><input type="number" name="sub_total_vendor_' +
                vendorId + '" placeholder="0.00" class="form-control" readonly /></td>');
            vendorRow.append(
                '<td class="text-center"><div class="input-group mb-2 mb-sm-0"><input value="0" type="number" name="cgst_vendor_' +
                vendorId + '" class="form-control" id="cgst_vendor_' +
                vendorId + '" placeholder="0"></div></td>');
            vendorRow.append(
                '<td class="text-center"><input type="number" name="cgst_tax_amount_vendor_' +
                vendorId + '" id="cgst_tax_amount_vendor_' + vendorId +
                '" placeholder="0.00" class="form-control" readonly /></td>');
            vendorRow.append('<td class="text-center"><input type="number" name="total_amount_vendor_' +
                vendorId + '" id="total_amount_vendor_' + vendorId +
                '" placeholder="0.00" class="form-control" readonly /></td>');
            vendorRow.append(
                '<td class="text-center"><input type="radio" name="approve_vendor_" id="approve_vendor_' +
                vendorId + '" class="form-control" data-item-id="' +
                itemId + '" data-vendor-id="' +
                vendorId + '" data-purchase-order-id="' + purchaseOrderId + '" /></td>');
            $('#tab_logic_total tbody').append(vendorRow);
        });

    });

    // Add click event listener to radio buttons for each vendor to allow only one selection
    $.each(selectedVendorIds, function (index, vendorId) {
        $("input[name='approve_vendor_" + vendorId + "']").click(function () {
            $("input[name='approve_vendor_" + vendorId + "']").not(this).prop('checked',
                false);
        });
    });
});

// Listen to changes in the price text boxes
$(document).on('input', '.vendor-price input', function () {
    // Get the vendor ID and item ID for the changed input
    var vendorId = $(this).closest('.vendor-price').data('vendor-id');
    var item_id = $(this).closest('.vendor-price').data('item-id');

    var newItemId = $(this).closest('tr').find('.priceCell').data('item-id'); // Extract item_id from the priceCell
    itemIDs.push(newItemId);
    // Calculate and update the sum of prices and related fields for the current vendor
    updateSumForVendor(vendorId);

    // Calculate and update the sum of prices and related fields for all vendors
    $('.vendor-price[data-item-id="' + item_id + '"]').each(function () {
        var currentVendorId = $(this).data('vendor-id');
        updateSumForVendor(currentVendorId);
    });
});

// Function to calculate and update the sum of prices and related fields for a vendor
// Function to calculate and update the sum of prices and related fields for a vendor
function updateSumForVendor(vendorId) {
    var totalSubTotal = 0;
    var totalCgstTaxAmount = 0;

    // Iterate through all products for the current vendor
    $('.vendor-price[data-vendor-id="' + vendorId + '"] input').each(function () {
        var price = parseFloat($(this).val());
        var item_id = $(this).closest('.vendor-price').data('item-id');
        var qty = parseFloat($('#tbl tr#' + item_id + ' td:nth-child(5)').text());

        if (!isNaN(price) && !isNaN(qty)) {
            // Calculate the subtotal for this item
            var subtotal = price * qty;
            totalSubTotal += subtotal;
            var cgstText = $('input[name="cgst_vendor_' + vendorId + '"]').val();
            var cgst = (subtotal * cgstText) / 100;
            totalCgstTaxAmount += cgst;

            // Find and update existing item data in vendorWiseData
            var existingItemDataIndex = vendorWiseData.findIndex(function (item) {
                return item.item_id === item_id && item.vendorId === vendorId;
            });

            if (existingItemDataIndex !== -1) {
                // Update existing item data
                vendorWiseData[existingItemDataIndex].sub_total = subtotal;
                vendorWiseData[existingItemDataIndex].cgst = cgst;
                vendorWiseData[existingItemDataIndex].cgst_tax_amount = totalCgstTaxAmount;
                vendorWiseData[existingItemDataIndex].total_amount = subtotal + cgst;
                vendorWiseData[existingItemDataIndex].price = price;
                vendorWiseData[existingItemDataIndex].qty = qty;
            } else {
                // Push new item data when it doesn't exist in the array
                var itemData = {
                    item_id: item_id,
                    sub_total: subtotal,
                    cgst: cgst,
                    cgst_tax_amount: totalCgstTaxAmount,
                    total_amount: subtotal + cgst,
                    price: price,
                    vendorId: vendorId,
                    qty: qty
                };
                vendorWiseData.push(itemData);
            }
        }
    });

    // Update the total subtotal for the vendor
    $('input[name="sub_total_vendor_' + vendorId + '"]').val(totalSubTotal.toFixed(2));

    // Update the total CGST tax amount for the vendor
    $('input[name="cgst_tax_amount_vendor_' + vendorId + '"]').val(totalCgstTaxAmount.toFixed(2));

    // Update the total amount (subtotal + CGST tax amount) for the vendor
    var totalAmount = totalSubTotal + totalCgstTaxAmount;
    $('input[name="total_amount_vendor_' + vendorId + '"]').val(totalAmount.toFixed(2));
}




// Listen to changes in the CGST input fields for each vendor
$(document).on('input', 'input[name^="cgst_vendor_"]', function () {

    var vendorId = $(this).attr('name').replace('cgst_vendor_', ''); // Extract vendorId from the input name
    var cgst = parseFloat($(this).val()); // Get the CGST as a float

    var cgstTaxAmountField = $('input[name="cgst_tax_amount_vendor_' + vendorId + '"]');
    var totalAmountField = $('input[name="total_amount_vendor_' + vendorId + '"]');
    if (!isNaN(cgst)) {
        var subTotalField = parseFloat($('input[name="sub_total_vendor_' + vendorId + '"]').val());
        // Calculate the CGST tax amount
        var cgstTaxAmount = (subTotalField * cgst) / 100;
        cgstTaxAmountField.val(cgstTaxAmount.toFixed(2));

        // Calculate the total amount (subtotal + CGST tax amount)
        var totalAmount = subTotalField + cgstTaxAmount;
        totalAmountField.val(totalAmount.toFixed(2));

        for (var i = 0; i < vendorWiseData.length; i++) {
            if (vendorWiseData[i].vendorId == vendorId) {
                vendorWiseData[i].cgst = cgst;
                vendorWiseData[i].cgst_tax_amount = cgstTaxAmount;
                vendorWiseData[i].total_amount = totalAmount;
            }
        }
    }

});
