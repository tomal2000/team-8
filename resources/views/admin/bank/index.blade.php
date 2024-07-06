<x-app-layout>
                <!-- Modal -->
<div class="modal fade" id="createBankModal" tabindex="-1" aria-labelledby="createBankModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <div class="table-responsive">
            <!-- Table with hoverable rows -->
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Name</th>
                  <th scope="col">Balance</th>
                  <th scope="col">Profit Amount</th>
                </tr>
              </thead>
              <tbody id="profit-table-body">

              </tbody>
            </table>
            <!-- End Table with hoverable rows -->
          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary confirm-submit-button">Confirm <div class="spinner-border spinner-border-sm confirm-loading-section" role="status" style="display: none">
              <span class="visually-hidden">Loading...</span>
            </div>
            </button>
          </div>
      </div>
    </div>
  </div>
        <!-- Modal -->
    <section class="section">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Banks <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createBankModal">Create New</button></h5>
              <div class="table-responsive">
          `        <!-- Table with hoverable rows -->
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Account No</th>
                        <th scope="col">Balance</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($banks as $key => $bank)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $bank->name }}</td>
                            <td>{{ $bank->account_no }}</td>
                            <td>{{ $bank->balance }}</td>
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
