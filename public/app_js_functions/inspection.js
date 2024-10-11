$(document).ready(function () {
    // When a file is selected in the input field
    $("#files_upload_input").change(function () {
        displaySelectedImages(this);
    });

    function displaySelectedImages(input) {
        var container = $("#imagePreviewContainer");
        container.empty(); // Clear previous images

        // Loop through selected files and create image elements
        for (var i = 0; i < input.files.length; i++) {
            var file = input.files[i];
            if (file.type.match("image.*")) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    // Create an img element and set its source to the selected file
                    var img = $("<img>");
                    img.attr("src", e.target.result);
                    img.attr("width", "100%");
                    container.append(img); // Append the image to the container
                };

                reader.readAsDataURL(file); // Read the selected file as a data URL
            }
        }
    }

    // Trigger the file input when the "Upload Photos" button is clicked
    $(".files_upload_btn").click(function () {
        $("#files_upload_input").click();
    });
});

$(document).ready(function () {
    var counter = 1;
    console.log(items);
    $("#addrow").on("click", function () {
        var newRow = $("<tr>");
        var cols = "";
        var selectOptions = '';
        for (var i = 0; i < items.length; i++) {
            selectOptions += '<option value="' + items[i].id + '">' + items[i].name + '</option>';
        }

        cols += `<td><select type="dropdown" class="form-control" name="inspection_items[]">
            <option value=""> Chosse...</option>
            ${selectOptions}
        </select>
        <p class="text-danger" id="inspection_items.${counter}"></p>
        </td>`;
        cols += `<td><select type="dropdown" class="form-control" name="inspection_items_status[]">
        <option value=""> Chosse...</option>
        <option value="OK"> OK</option>
        <option value="NOT OK"> NOT OK</option>
    </select>
    <p class="text-danger" id="inspection_items_status.${counter}"></p>
    </td>`;
        cols += `<td><input type="text" class="form-control" name="remarks[]"/><p class="text-danger" id="remarks.${counter}"></p></td>`;

        cols +=
            '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td>';
        newRow.append(cols);
        $("table.order-list").append(newRow);
        counter++;
    });

    $("table.order-list").on("click", ".ibtnDel", function (event) {
        $(this).closest("tr").remove();
        counter -= 1
    });


});

function calculateRow(row) {
    var price = +row.find('input[name^="price"]').val();

}

function calculateGrandTotal() {
    var grandTotal = 0;
    $("table.order-list").find('input[name^="price"]').each(function () {
        grandTotal += +$(this).val();
    });
    $("#grandtotal").text(grandTotal.toFixed(2));
}


$(document).ready(function () {
    $('#inspection_type').change(function () {
        if ($(this).val() == 0) {
            $('.vehcile-section').addClass('d-flex justify-content-between');
            $('.vehcile-section').removeClass('d-none');
            $('.inputMtr').removeClass('d-none');
            $('.property-section').addClass('d-none');

        } else {
            $('.vehcile-section').removeClass('d-flex justify-content-between');
            $('.vehcile-section').addClass('d-none');
            $('.inputMtr').addClass('d-none');
            $('.property-section').removeClass('d-none');


        }
    });
});


$(document).ready(function () {
    $('#inspection_bies').change(function () {
        // Clear existing selected users
        $('.selected-users').empty();

        // Get all selected options
        var selectedOptions = $('#inspection_bies option:selected');

        // Loop through selected options and append their details
        selectedOptions.each(function () {
            var selectedOption = $(this);
            var userImage = selectedOption.data('image');
            var userName = selectedOption.data('name');
            var userDesignation = selectedOption.data('designation');

            // Append user details to the target div
            $('.selected-users').append(`
                <div class="user-card text-center">
                    <img id="blah" src="${userImage}" alt="your image"
                        class="rounded-circle" />
                    <div>
                        <p id="user-name">${userName}</p>
                        <p id="user-designation">${userDesignation}</p>
                    </div>
                </div>
            `);
        });
    });
});
