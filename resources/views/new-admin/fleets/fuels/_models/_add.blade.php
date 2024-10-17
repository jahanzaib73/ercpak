<div class="modal fade" id="addFuelLabel" tabindex="-1" aria-labelledby="addFuelLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-content">
                <div class="modal-body pb-5 px-sm-5 pt-50">
                    <div class="text-center mb-2">
                        <h1 class="mb-1" id="addTripLabel">Add Fuel</h1>
                        <p>Please fill in the details below.</p>
                    </div>
                    <form class="row gy-1 pt-75" id="fuel_add_form" enctype="multipart/form-data">
                        <!-- Step 1: Trip, Vehicle, and Outsource Options -->
                        <div class="form-step" id="step-1">
                            <div class="row mb-2 mt-3">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="trip_id" class="form-label">Trip</label>
                                        <select name="trip_id" id="trip_id"
                                            class="form-control select2 custom-select">
                                            <option value="">Trip</option>
                                            @foreach ($trips as $trip)
                                                <option data-type="trip" value="{{ $trip->id }}">{{ $trip->id }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <h6 class="mt-2 light-dark text-center">OR</h6>
                                    <div class="form-group">
                                        <label for="vehicle_id" class="form-label">Vehicle</label>
                                        <select name="vehicle_id" id="vehicle_id"
                                            class="form-control select2 custom-select">
                                            <option value="">Vehicle</option>
                                            @foreach ($vheicles as $vehicle)
                                                <option data-type="vehicle" value="{{ $vehicle->id }}">
                                                    {{ $vehicle->vehicle_number }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <h6 class="mt-2 light-dark text-center">OR</h6>
                                    <div class="form-group text-center">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#outsource"
                                            class="btn btn-primary btn-sm">Outsource Vehicle</a>
                                    </div>
                                </div>

                                <!-- Vehicle Details Display -->
                                <div class="col-md-3 text-center pt-2">
                                    <h3 id="fuel_vehicle_number">XX-XXXX</h3>
                                    <h6 id="fuel_vehicle_model">XXXXX</h6>
                                </div>

                                <!-- Vehicle Image -->
                                <div class="col-md-5">
                                    <div class="d-flex justify-content-end">
                                        <img id="blah" width="200" height="200"
                                            class="vehicle_image img-fluid" src="http://placehold.it/180"
                                            alt="your image">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary" disabled>Previous</button>
                                <button type="button" class="btn btn-primary next-button">Next</button>
                            </div>
                        </div>

                        <!-- Step 2: Driver, Official, and Cost Center Selection -->
                        <div class="form-step d-none" id="step-2">
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="driver_id" class="form-label">Driver</label>
                                        <select name="driver_id" id="driver_id"
                                            class="form-control select2 custom-select" required>
                                            <option value="">Driver</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="official_id" class="form-label">Official</label>
                                        <select name="official_id" id="official_id"
                                            class="form-control select2 custom-select" required>
                                            <option value="">Official</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cost_center_id" class="form-label">Cost Center</label>
                                        <select name="cost_center_id" id="cost_center_id"
                                            class="form-control select2 custom-select" required>
                                            <option value="">Cost Center</option>
                                            @foreach ($costCenters as $cost)
                                                <option value="{{ $cost->id }}">{{ $cost->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary previous-button">Previous</button>
                                <button type="button" class="btn btn-primary next-button">Next</button>
                            </div>
                        </div>

                        <!-- Step 3: Purchase Order and Work Order Selection -->
                        <div class="form-step d-none" id="step-3">
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="purchase_order_id" class="form-label">Purchase Order</label>
                                        <select name="purchase_order_id" id="purchase_order_id"
                                            class="form-control select2 custom-select">
                                            <option value="">Purchase Order</option>
                                            @foreach ($purchaseOrder as $po)
                                                <option value="{{ $po->id }}">{{ $po->id }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="work_order_id" class="form-label">Work Order</label>
                                        <select name="work_order_id" id="work_order_id"
                                            class="form-control select2 custom-select">
                                            <option value="">Work Order</option>
                                            @foreach ($workorders as $wo)
                                                <option value="{{ $wo->id }}">{{ $wo->id }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary previous-button">Previous</button>
                                <button type="button" class="btn btn-primary next-button">Next</button>
                            </div>
                        </div>

                        <!-- Step 4: Fuel Details -->
                        <div class="form-step d-none" id="step-4">
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exit_datetime" class="form-label">Date & Time</label>
                                        <input name="exit_datetime" type="datetime-local" class="form-control"
                                            id="exit_datetime" placeholder="Date & Time" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fuel_tank_id" class="form-label">Fuel Tank</label>
                                        <select name="fuel_tank_id" id="fuel_tank_id"
                                            class="form-control select2 custom-select" required>
                                            <option value="">Fuel Tank</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fuel_type_id" class="form-label">Fuel Type</label>
                                        <select name="fuel_type_id" id="fuel_type_id"
                                            class="form-control select2 custom-select" required>
                                            <option value="">Fuel Type</option>
                                            @foreach ($fuelTypes as $fuelType)
                                                <option value="{{ $fuelType->id }}">{{ $fuelType->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary previous-button">Previous</button>
                                <button type="button" class="btn btn-primary next-button">Next</button>
                            </div>
                        </div>

                        <!-- Step 5: Price, Upload, and Fuel Man -->
                        <div class="form-step d-none" id="step-5">
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price" class="form-label">Price</label>
                                        <input name="price" type="number" class="form-control" id="price"
                                            placeholder="Price" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="qty" class="form-label">QTY</label>
                                        <input name="qty" type="number" class="form-control" id="qty"
                                            placeholder="QTY" required>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary previous-button">Previous</button>
                                <button type="button" class="btn btn-primary next-button">Next</button>
                            </div>
                        </div>

                        <!-- Step 6: Meter Reading and Trip Details -->
                        <div class="form-step d-none" id="step-6">
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vehicle_meter_reading" class="form-label">Meter Reading</label>
                                        <input name="vehicle_meter_reading" type="number" class="form-control"
                                            id="vehicle_meter_reading" placeholder="Meter Reading" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fuel_man_id" class="form-label">Fuel Man</label>
                                        <select name="fuel_man_id" id="fuel_man_id"
                                            class="form-control select2 custom-select" required>
                                            <option value="">Fuel Man</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="notes" class="form-label">Trip Details</label>
                                        <textarea name="notes" id="notes" cols="10" rows="3" class="form-control"
                                            placeholder="Enter trip details" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-5">
                                <button type="button" class="btn btn-secondary previous-button">Previous</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@section('page-script')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let currentStep = 0;
            const formSteps = document.querySelectorAll('.form-step');
            const nextButtons = document.querySelectorAll('.next-button');
            const previousButtons = document.querySelectorAll('.previous-button');

            function showStep(step) {
                formSteps.forEach((formStep, index) => {
                    formStep.classList.toggle('d-none', index !== step);
                });
            }

            function validateStep(step) {
                // Add your validation logic for each step here
                // For example:
                const inputs = formSteps[step].querySelectorAll('input, select');
                let isValid = true;

                inputs.forEach((input) => {
                    if (input.value.trim() === '' && input.hasAttribute('required')) {
                        isValid = false;
                        input.classList.add('is-invalid');
                    } else {
                        input.classList.remove('is-invalid');
                    }
                });

                return isValid;
            }

            nextButtons.forEach((button, index) => {
                button.addEventListener('click', () => {
                    if (validateStep(currentStep)) {
                        currentStep++;
                        showStep(currentStep);
                    }
                });
            });

            previousButtons.forEach((button) => {
                button.addEventListener('click', () => {
                    currentStep--;
                    showStep(currentStep);
                });
            });

            showStep(currentStep);
        });
    </script>
@endsection
