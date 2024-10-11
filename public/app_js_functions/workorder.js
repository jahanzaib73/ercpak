$(document).ready(function () {
    var counter = 1;
    console.log(tasks);
    $("#addrow").on("click", function () {
        var newRow = $("<tr>");
        var cols = "";
        var selectOptions = '';
        for (var i = 0; i < tasks.length; i++) {
            selectOptions += '<option value="' + tasks[i].id + '">' + tasks[i].title + '</option>';
        }

        cols += `<td><select type="dropdown" class="form-control" name="tasks[]">
            <option value=""> Chosse...</option>
            ${selectOptions}
        </select>
        <p class="text-danger" id="tasks.${counter}"></p>
        </td>`;

        cols +=
            `<td><input type="text" class="form-control" name="remarks[]"/><p class="text-danger" id="remarks.${counter}"></p></td>`;

        cols +=
            '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td>';
        newRow.append(cols);
        $("table.task-list").append(newRow);
        counter++;
    });

    $("table.task-list").on("click", ".ibtnDel", function (event) {
        $(this).closest("tr").remove();
        counter -= 1
    });


});

function calculateRow(row) {
    var price = +row.find('input[name^="price"]').val();

}

function calculateGrandTotal() {
    var grandTotal = 0;
    $("table.task-list").find('input[name^="price"]').each(function () {
        grandTotal += +$(this).val();
    });
    $("#grandtotal").text(grandTotal.toFixed(2));
}


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
                    var img = $("<img class='mb-2 mt-2 mr-2'>");
                    img.attr("src", e.target.result);
                    img.attr("width", "10%");
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
