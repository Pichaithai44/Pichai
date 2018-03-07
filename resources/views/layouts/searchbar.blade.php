@section('searchbar')
  <div class="form-group row">
      <form class="form-inline">
          <div class="col-4">
              <input class="form-control" type="text" name="search" placeholder="ค้นหาจากรายชื่อ..." value="{{ old('search') }}">
          </div>
          <div class="col-6">
              <div class="form-group row">
                  <label for="example-text-input" class="col-2 col-form-label">วันที่ :</label>
                  <div class="col-8">
                      <div id="datepicker">
                          <div class="form-group row">
                              <div class="col-6">
                                  <input type="text" name="date_start" class="actual_range form-control">
                              </div>
                              <div class="col-6">
                                  <input type="text" name="date_end" class="actual_range form-control">
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-2">
                      <button class="btn btn-success m-2" type="submit">ค้นหา</button>      
                  </div>
              </div>
          </div>
      </form>
      <div class="col-2">
          <button class="btn btn-success btn-ymt-create" onclick="location='{{ route('pages.customer.create') }}'" id="create">เพิ่ม</button>
      </div>
  </div>
@endsection