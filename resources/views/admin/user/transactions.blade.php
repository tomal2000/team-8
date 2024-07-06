<x-app-layout>
    <section class="section">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Users Tansactions</h5>
              <div class="table-responsive">
                  <!-- Table with hoverable rows -->
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">Date Time</th>
                        <th scope="col">User Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Narration</th>
                        <th scope="col">Description</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Fee</th>
                        <th scope="col">Remain Balance</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $key => $transaction)
                        <tr>
                            <td>{{ $transaction->transaction_at }}</td>
                            <td>{{ $transaction->transactionable->unique_id }}</td>
                            <td>{{ $transaction->transactionable->first_name.' '.$transaction->transactionable->last_name }}</td>
                            <td>{{ $transaction->narration }}</td>
                            <td>{{ $transaction->description }}</td>
                            <td>{{ $transaction->principal_amount }}</td>
                            <td>{{ $transaction->fee }}</td>
                            <td>{{ $transaction->remain_balance }}</td>
                            <td>{{ Str::upper($transaction->status) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                  <!-- End Table with hoverable rows -->
                </div>
                {{ $transactions->links() }}
                </div>
              </div>
          </div>
        </div>
      </section>
      @push('scripts')
      @endpush
</x-app-layout>
