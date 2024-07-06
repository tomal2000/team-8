<div>
    <form class="row g-3" id="{{ $user ? 'userUpdate':'userCreate' }}" method="POST" action="{{ $user ? route('admin.user.create'):route('admin.user.create') }}">
      @csrf

      <div class="col-md-6">
        <label for="first_name" class="form-label required">{{ __('First Name') }}</label>
        <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name ?? '' }}">
      </div>

      <div class="col-md-6">
        <label for="last_name" class="form-label">{{ __('Last Name') }}</label>
        <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name ?? '' }}">
      </div>

      <div class="col-md-6">
        <label for="mobile" class="form-label required">{{ __('Mobile') }}</label>
        <input type="text" class="form-control" id="mobile" name="mobile" value="{{ $user->last_name ?? '' }}">
      </div>
        <div class="col-md-6">
                <label for="role" class="form-label required">{{ __('Role') }}</label>
                <select name="role" id="role" class="form-control">
                    <option value="">--Select--</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                    @endforeach
                </select>
        </div>
        <div class="col-md-6">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="true" id="isPaymentCollector" name="is_payment_collector" value="1">
                <label class="form-check-label" for="isPaymentCollector">
                 Is Payment Collector
                </label>
              </div>
        </div>
        <div class="text-center">
            {{-- <a href="{{ route('admin.setup.department.index') }}" class="btn btn-danger"><i class="bi bi-arrow-counterclockwise"></i> Cancel</a> --}}
            <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Submit</button>
        </div>
      </form>
</div>
@push('scripts')
<script>
$("#userCreate").validate({
rules: {
    first_name: {
      required: true
    },
    mobile: {
      required: true,
      exactLengthMobile: true,
      exactStartingMobile: true

    },
    role: {
      required: true
    }
  },
  submitHandler: function(form) {
    form.submit();
  }
 });
</script>
@endpush
