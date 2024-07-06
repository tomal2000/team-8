<x-app-layout>
    <section class="section">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Designations <button class="btn btn-primary">Create New</button></h5>
              <div class="table-responsive">
          `        <!-- Table with hoverable rows -->
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($designations as $key => $designation)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $designation->unique_id }}</td>
                            <td>{{ $designation->name }}</td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                  <!-- End Table with hoverable rows -->
                </div>
                </div>
              </div>
          </div>
        </div>
      </section>
</x-app-layout>
