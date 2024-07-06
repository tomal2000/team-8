<x-app-layout>
            <!-- Modal -->
<div class="modal fade" id="profitShereConfirmModal" tabindex="-1" aria-labelledby="profitShereConfirmModalLabel" aria-hidden="true">
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
<div class="modal fade" id="profitShereModal" tabindex="-1" aria-labelledby="profitShereModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      <form id="userDisbursementForm" action="{{ route('admin.user.distributeProfit') }}" method="POST">
        <div class="modal-body">
          <div class="row g-3">
                @csrf
            <div class="col-12">
              <label for="amount" class="form-label required">Amount</label>
              <input type="text" class="form-control amount" id="amount" name="amount">
            </div>
            <div class="col-12">
              <label for="narration" class="form-label required">Narration</label>
              <input type="text" class="form-control" id="narration" name="narration">
            </div>
        </div>
      </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary submit-button">Submit <div class="spinner-border spinner-border-sm loading-section" role="status" style="display: none">
            <span class="visually-hidden">Loading...</span>
          </div>
          </button>
        </div>
    </form>
      </div>
    </div>
  </div>
    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      <form id="userDepositForm" action="{{ route('admin.user.deposit') }}" method="POST">
        <div class="modal-body">
          <div class="row g-3">
            <input type="hidden" class="form-control" id="id" name="id">
                @csrf
            <div class="col-12">
              <label for="unique_id" class="form-label">Unique Id</label>
              <input type="text" class="form-control" id="unique_id" name="unique_id" disabled>
            </div>
            <div class="col-12">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" id="name" name="name" disabled>
            </div>
            <div class="col-12">
              <label for="amount" class="form-label required">Amount</label>
              <input type="text" class="form-control amount" id="amount" name="amount">
            </div>
            <div class="col-12">
              <label for="fee" class="form-label required">Fee</label>
              <input type="text" class="form-control amount" id="fee" name="fee" value="0.00">
            </div>
            <div class="col-12">
              <label for="narration" class="form-label required">Narration</label>
              <input type="text" class="form-control" id="narration" name="narration">
            </div>
        </div>
      </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary submit-button">Submit <div class="spinner-border spinner-border-sm loading-section" role="status" style="display: none">
            <span class="visually-hidden">Loading...</span>
          </div>
          </button>
        </div>
    </form>
      </div>
    </div>
  </div>
    <section class="section">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Users <a href="{{ route('admin.user.create') }}" class="btn btn-primary">Create New</a> <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#profitShereModal">Proffit Disbursment</button></h5>
              <div class="table-responsive">
                  <!-- Table with hoverable rows -->
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Designation</th>
                        <th scope="col">Balance</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $user->unique_id }}</td>
                            <td>{{ $user->first_name.' '.$user->last_name }}</td>
                            <td>{{ $user->mobile }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->roles->first()->display_name }}</td>
                            <td>{{ $user->balance }}</td>
                            <td><button data-user="{{ $user->setVisible(['id', 'first_name','last_name','unique_id','mobile']) }}" class="btn btn-primary deposit_modal" type="button">Deposit</button></td>
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
      @push('scripts')
      <script>
        const profitModal = new bootstrap.Modal('#profitShereConfirmModal', {
                keyboard: false
            });
        const profitShereModal = new bootstrap.Modal('#profitShereModal', {
            keyboard: false
        });
      </script>
      <script>
         $("#userDisbursementForm").validate({
        rules: {
            amount: {
              required: true,
              number: true
            },
            narration: {
              required: true
            }
          },
          submitHandler: function(form) {
            $(".submit-button").attr("disabled", true);
            $(".loading-section").show();

            $.ajax({
                url: "{{ route('admin.user.calculateProfit') }}",
                type: "POST",
                data: $(form).serialize(),
                success: function(response) {
                    //$("#form").trigger("reset"); // to reset form input fields
                    console.log(response);
                    var tableBody = $('#profit-table-body');
                    response.forEach(function(item) {
                var row = `<tr>
                            <td>${item.unique_id}</td>
                            <td>${item.name}</td>
                            <td>${item.balance}</td>
                             <td>${item.profit_share}</td>
                           </tr>`;
                tableBody.append(row);
            });
            $('#exampleModal').modal('hide');
            profitShereModal.hide();
            profitModal.show();
            $(".confirm-submit-button").click(function() {
                form.submit();
            });

                },
                error: function(e) {
                    console.log(e);
                }
            });
            return false;
            //form.submit();
          }
         });
      </script>
      <script>
        $( ".deposit_modal" ).click(function() {
            const myModal = new bootstrap.Modal('#exampleModal', {
                keyboard: false
            });
            var data = $(this).data('user')
            var form = $('#userDepositForm');
            form.trigger("reset");
            $('#name').val(data.first_name+' '+data.last_name);
            $('#unique_id').val(data.unique_id);
            $('#id').val(data.id);
            myModal.show();
        });
      </script>
      <script>
        $("#userDepositForm").validate({
        rules: {
            amount: {
              required: true,
              number: true
            },
            fee: {
              required: true,
              number: true

            },
            narration: {
              required: true
            }
          },
          submitHandler: function(form) {
            $(".submit-button").attr("disabled", true);
            $(".loading-section").show();
            form.submit();
          }
         });
        </script>
      @endpush
</x-app-layout>
