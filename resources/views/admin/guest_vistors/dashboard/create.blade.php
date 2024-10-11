<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<div class="container-fluid">
    <div class="container mt-4">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add New Data</h4>

                   <form action="{{ route('store.data') }}" method="POST" class="forms-sample"
                      enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                        <label for="picture">Upload Image</label>
                        <input type="file" name="image" class="form-control" id="customFile">
                      </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Name</label>
                      <input type="text" class="form-control" name="name"  id="exampleInputName1"  />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Date</label>
                        <input type="date" class="form-control" name="date"  id="exampleInputName1" />
                      </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Time In</label>
                      <input type="time" class="form-control" name="time_in"  id="exampleInputName1"  />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Time Out</label>
                        <input type="time" class="form-control" name="time_out"  id="exampleInputName1"  />
                      </div>

                    <div class="form-group">
                      <label for="exampleInputEmail3">Destination</label>
                      <input type="text" class="form-control" name="destination"  id="exampleInputName1"  />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Distance</label>
                        <input type="text" class="form-control" name="distance"  id="exampleInputName1"  />
                      </div>


                    </div>
                    <button type="submit" class="btn btn-primary mr-2"> Add </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
    </div>
</div>
</body>
</html>
